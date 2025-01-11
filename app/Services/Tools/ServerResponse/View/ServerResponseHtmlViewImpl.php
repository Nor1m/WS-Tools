<?php

namespace App\Services\Tools\ServerResponse\View;

use App\Services\Tools\ServerResponse\ServerResponseResultDTO;

class ServerResponseHtmlViewImpl implements ServerResponseHtmlView
{
    /**
     * @var string
     */
    private string $toolKey = 'server_response';

    /**
     * @param ServerResponseResultDTO $dto
     * @return string
     */
    public function response(ServerResponseResultDTO $dto): string
    {
        $viewKey = toolSettings($this->toolKey, 'items_view_path', '');
        $maxUrlLen = toolSettings($this->toolKey, 'max_url_len', 30);
        $items = [];

        foreach ($dto->curlServerResponses as $key => $responseItem) {
            $response = trim($responseItem->response) ?? __('response.no_response_received');
            $time = round($responseItem->totalTime, 3);
            $httpCode = $responseItem->httpCode;
            $url = $responseItem->url;
            if (mb_strlen($url) >= $maxUrlLen) {
                $url = mb_substr($url, 0, $maxUrlLen) . '...';
            }
            $items[] = [
                'class' => 'status-' . "$httpCode"[0],
                'url' => $url,
                'textHttpCode' => getHttpTextByCode($httpCode, '...'),
                'httpCode' => $httpCode,
                'info' => getTimeStatusInfo($time),
                'time' => $time,
                'response' => $response,
            ];
        }

        $totalTime = round($dto->totalTime, 3);
        $totalTimeInfo = getTimeStatusInfo($totalTime);

        return view($viewKey, [
            'statusClass' => $totalTimeInfo['statusClass'],
            'statusText' => $totalTimeInfo['statusText'],
            'totalTime' => $totalTime,
            'primaryIp' => $dto->primaryIp,
            'localIp' => $dto->localIp,
            'items' => $items,
            'count' => count($items),
        ])->render();
    }
}