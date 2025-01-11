<?php

namespace App\Services\Tools\ServerResponse;

use App\Exceptions\Tools\ToolServerException;
use App\Services\Utils\UrlService;
use Illuminate\Support\Facades\Http;

class ServerResponseToolImpl implements ServerResponseTool
{
    /**
     * @var string
     */
    private string $toolKey = 'server_response';
    /**
     * @var int|mixed
     */
    private int $maxCurlRequests = 15;
    /**
     * @var array|int[]|mixed
     */
    private array $redirectCodes = [301, 302, 303];
    /**
     * @var array
     */
    private array $baseServerInfo = [];
    /**
     * @var int
     */
    private int $curlLoops = 0;
    /**
     * @var array
     */
    private array $curlServerResponses = [];
    /**
     * @var float|int
     */
    private float|int $totalTime = 0;

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

    /**
     * @param string $url
     * @return string
     */
    protected function prepareUrl(string $url): string
    {
        return addProtocolIfNotExists(punycodeEncode($url));
    }

    /**
     * @param string $url
     * @return void
     */
    protected function startCurlParsing(string $url): void
    {
        $this->curlRedirectWalk($url);
    }

    /**
     * @param string $url
     * @return void
     */
    protected function curlRedirectWalk(string $url): void
    {
        $response = Http::withoutRedirecting()->get($url);
        $info = $response->transferStats->getHandlerStats();
        $headers = $response->headers();

        $httpCode = $info['http_code'] ?? $response->status();
        $this->totalTime += $info['total_time'] ?? 0;

        if (empty($this->baseServerInfo)) {
            $this->baseServerInfo = [
                'primary_ip' => $info['primary_ip'] ?? '',
                'local_ip' => $info['local_ip'] ?? '',
            ];
        }

        $this->curlServerResponses[] = new ServerResponseCurlItemResultDTO(
            url: $url,
            httpCode: $httpCode,
            response: $this->getHeadersString($headers),
            totalTime: $info['total_time'] ?? 0
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

    /**
     * @param array $headers
     * @return string
     */
    protected function getHeadersString(array $headers): string
    {
        $headersString = '';
        foreach ($headers as $key => $value) {
            $headersString .= "{$key}: {$value[0]}" . PHP_EOL;
        }

        return $headersString;
    }
}