<?php

namespace App\Http\Controllers\API\v1\Login;

use App\Http\Requests\API\v1\Login\LoginRequest;
use App\Http\Utility\ResponseFactory;
use App\TravelHelper\Login\Action\LoginAction;
use App\TravelHelper\Login\Exception\LoginException;
use Exception;
use Illuminate\Http\JsonResponse;

class Controller
{
    private LoginAction     $loginAction;
    private ResponseFactory $responseFactory;

    public function __construct(LoginAction $loginAction, ResponseFactory $responseFactory)
    {
        $this->loginAction     = $loginAction;
        $this->responseFactory = $responseFactory;
    }

    public function run(LoginRequest $request): JsonResponse
    {
        try {
            $token = $this->loginAction->run($request->getData());
            return $this->responseFactory->success('Login', [
                'token' => $token,
            ]);
        } catch (LoginException|Exception $e) {
            return $this->responseFactory->error($e->getMessage());
        }
    }
}
