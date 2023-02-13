<?php

namespace App\Services\Tools\ServerResponse;

use App\Exceptions\Tools\ToolServerException;
use App\Services\Utils\UrlService;
use Illuminate\Support\Facades\Http;

class ServerResponseToolImpl implements ServerResponseTool
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
            curlServerResponses: $this->curlServerResponses,
        );
    }

    protected function prepareUrl(string $url): string
    {
        return addProtocolIfNotExists(punycodeEncode($url));
    }

    protected function startCurlParsing(string $url): void
    {
        $this->curlRedirectWalk($url);
    }

    protected function curlRedirectWalk(string $url): void
    {
        $response = Http::withoutRedirecting()->get($url);
        $info = $response->transferStats->getHandlerStats();
        $headers = $response->headers();

        $httpCode = $info['http_code'];
        $this->totalTime += $info['total_time'];

        if (empty($this->baseServerInfo)) {
            $this->baseServerInfo = [
                'primary_ip' => $info['primary_ip'],
                'local_ip' => $info['local_ip'],
            ];
        }

        $this->curlServerResponses[] = new ServerResponseCurlItemResultDTO(
            url: $url,
            httpCode: $httpCode,
            response: $this->getHeadersString($headers),
            totalTime: $info['total_time']
        );

        if (isset($info['redirect_url']) && in_array($httpCode, $this->redirectCodes)) {
            if ($this->curlLoops != $this->maxCurlRequests) {
                $this->curlLoops += 1;
                $this->curlRedirectWalk($info['redirect_url']);
            }
        } else {
            $response->close();
        }
    }

    protected function getHeadersString(array $headers): string
    {
        $headersString = '';
        foreach ($headers as $key => $value) {
            $headersString .= "{$key}: {$value[0]}" . PHP_EOL;
        }

        return $headersString;
    }
}