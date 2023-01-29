<?php

namespace App\Http\Controllers\Tools;

use App\Exceptions\Tools\ToolServerException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tools\ServerResponseRequest;
use App\Services\Response\ToolJsonResponseInterface;
use App\Services\Tools\ServerResponse\ServerResponseToolInterface;
use App\Services\Tools\ServerResponse\View\ServerResponseHtmlViewInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\View;

class ServerResponseController extends Controller
{
    private string $toolKey = 'server_response';
    private ServerResponseToolInterface $toolService;
    private ToolJsonResponseInterface $responseService;
    private ServerResponseHtmlViewInterface $viewService;

    /**
     * @param ServerResponseToolInterface $toolService
     * @param ToolJsonResponseInterface $responseService
     * @param ServerResponseHtmlViewInterface $viewService
     */
    public function __construct(ServerResponseToolInterface $toolService, ToolJsonResponseInterface $responseService, ServerResponseHtmlViewInterface $viewService)
    {
        $this->toolService = $toolService;
        $this->responseService = $responseService;
        $this->viewService = $viewService;
    }

    public function run(ServerResponseRequest $request): JsonResponse
    {
        try {
            $dto = $this->toolService->run($request->validated('url'));
            return $this->responseService->response([
                'resultHtml' => $this->viewService->response($dto),
            ]);
        } catch (ToolServerException $exception) {
            return $this->responseService->response([], 'error', $exception->getMessage(), $exception->getCode());
        } catch (Exception $exception) {
            return $this->responseService->response([], 'error', __('response.something_went_wrong'), 500);
        }
    }

    public function show(): \Illuminate\Contracts\View\View
    {
        return View::make('panel.tools.server.server_response', [
            'title' => __(toolSettings($this->toolKey, 'title')),
            'icon' => toolSettings($this->toolKey, 'icon'),
        ]);
    }
}
