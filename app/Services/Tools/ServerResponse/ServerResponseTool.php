<?php

namespace App\Services\Tools\ServerResponse;

use App\Exceptions\Tools\ToolServerException;
use App\Services\Utils\UrlService;
use CurlHandle;

class ServerResponseTool implements ServerResponseToolInterface
{
    private string $toolKey = 'server_response';
    private int $maxCurlRequests = 15;
    private array $redirectCodes = [301,302,303];
    private array $baseServerInfo = [];
    private int $curlLoops = 0;
    private array $curlServerResponses = [];
    private float $totalTime = 0;

    public function __construct()
    {
        $this->maxCurlRequests = toolSettings($this->toolKey, 'max_curl_requests', $this->maxCurlRequests);
        $this->redirectCodes = toolSettings($this->toolKey, 'curl_redirects_codes', $this->redirectCodes);
    }

    /**
     * @throws ToolServerException
     */
    public function run(string $url): ServerResponseResultDTO
    {
        $url = $this->prepareUrl($url);

        if (!UrlService::checkServerAvailability($url)) {
            throw new ToolServerException(__('response.server_is_not_responding'));
        }

        $this->startCurlParsing($url);

        return new ServerResponseResultDTO(
            totalTime: $this->totalTime,
            primaryIp: $this->baseServerInfo['primary_ip'],
            localIp: $this->baseServerInfo['local_ip'],
            contentType: $this->baseServerInfo['content_type'],
            curlServerResponses: $this->curlServerResponses,
        );
    }

    protected function prepareUrl(string $url): string
    {
        return addProtocolIfNotExists(punycodeEncode($url));
    }

    protected function startCurlParsing(string $url): void
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $this->curlRedirectWalk($ch, $url);
        curl_exec($ch);
        $info = curl_getinfo($ch);

        $this->baseServerInfo = [
            'primary_ip' => $info['primary_ip'],
            'local_ip' => $info['local_ip'],
            'content_type' => $info['content_type'],
        ];

        curl_close($ch);
    }

    protected function curlRedirectWalk(CurlHandle $ch, string $url): void
    {
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $header = curl_exec($ch);
        $info = curl_getinfo($ch);

        $httpCode = $info['http_code'];
        $this->totalTime += $info['total_time'];

        $locationUrl = $this->getLocationFromHeader($header);

        $this->curlServerResponses[] = new ServerResponseCurlItemResultDTO(
            url: $url,
            httpCode: $httpCode,
            response: $header,
            totalTime: $info['total_time']
        );

        if ($locationUrl && in_array($httpCode, $this->redirectCodes)) {
            if ($this->curlLoops != $this->maxCurlRequests) {
                $this->curlLoops += 1;
                $nextUrl = $this->getNextCurlUrl($locationUrl, $info['redirect_url']);
                curl_setopt($ch, CURLOPT_URL, $nextUrl);
                $this->curlRedirectWalk($ch, $nextUrl);
            }
        }
    }

    protected function getLocationFromHeader(string $header): ?string
    {
        $matches = [];
        preg_match('/location:(.*?)\n/i', $header, $matches);
        return empty($matches) ? null : trim(array_pop($matches));
    }

    protected function getNextCurlUrl(string $url, string $nextUrl = ""): string
    {
        if ($url)
            $url = parse_url($url);

        if ($nextUrl)
            $nextUrl = parse_url($nextUrl);

        if (!isset($url['scheme']))
            $url['scheme'] = $nextUrl['scheme'];

        if (!isset($url['host']))
            $url['host'] = $nextUrl['host'];

        if (!isset($url['path']))
            $url['path'] = $nextUrl['path'];

        return $url['scheme'] . '://' . $url['host'] . $url['path'] . ( isset($url['query']) ? '?' . $url['query'] : '' );
    }
}