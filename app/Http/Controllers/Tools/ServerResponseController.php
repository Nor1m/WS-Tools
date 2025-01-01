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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class ServerResponseController extends Controller
{
    /**
     * @var string
     */
    private string $toolKey = 'server_response';
    /**
     * @var ServerResponseTool
     */
    private ServerResponseTool $toolService;
    /**
     * @var ToolJsonResponse
     */
    private ToolJsonResponse $responseService;
    /**
     * @var ServerResponseHtmlView
     */
    private ServerResponseHtmlView $viewService;

    /**
     * @param ServerResponseTool $toolService
     * @param ToolJsonResponse $responseService
     * @param ServerResponseHtmlView $viewService
     */
    public function __construct(
        ServerResponseTool     $toolService,
        ToolJsonResponse       $responseService,
        ServerResponseHtmlView $viewService
    )
    {
        $this->toolService = $toolService;
        $this->responseService = $responseService;
        $this->viewService = $viewService;
    }

    /**
     * @param ServerResponseRequest $request
     * @return JsonResponse
     */
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
            Log::error('ServerResponseController::run', ['error' => $exception->getMessage()]);
            return $this->responseService->response([], 'error', __('response.something_went_wrong'), 500);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function show(): \Illuminate\Contracts\View\View
    {
        $view = toolSettings($this->toolKey, 'page_view_path');
        return View::make($view, [
            'title' => __(toolSettings($this->toolKey, 'title')),
            'icon' => toolSettings($this->toolKey, 'icon'),
        ]);
    }
}
