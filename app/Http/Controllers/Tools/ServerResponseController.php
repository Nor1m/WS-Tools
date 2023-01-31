<?php

namespace App\Http\Controllers\Tools;

use App\Exceptions\Tools\ToolServerException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tools\ServerResponseRequest;
use App\Services\Response\ToolJsonResponse;
use App\Services\Tools\ServerResponse\ServerResponseTool;
use App\Services\Tools\ServerResponse\View\ServerResponseHtmlView;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\View;

class ServerResponseController extends Controller
{
    private string $toolKey = 'server_response';
    private ServerResponseTool $toolService;
    private ToolJsonResponse $responseService;
    private ServerResponseHtmlView $viewService;

    public function __construct(
        ServerResponseTool $toolService,
        ToolJsonResponse $responseService,
        ServerResponseHtmlView $viewService
    ) {
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
        $view = toolSettings($this->toolKey, 'page_view_path');
        return View::make($view, [
            'title' => __(toolSettings($this->toolKey, 'title')),
            'icon' => toolSettings($this->toolKey, 'icon'),
        ]);
    }
}
