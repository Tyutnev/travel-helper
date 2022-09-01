<?php

namespace App\Http\Controllers\API\v1\Registration;

use App\Http\Controllers\BaseController;
use App\Http\Requests\API\v1\Registration\RegistrationRequest;
use App\Http\Utility\ResponseFactory;
use App\TravelHelper\User\Action\UserCreateAction;
use Exception;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    private UserCreateAction $userCreateAction;
    private ResponseFactory  $responseFactory;

    public function __construct(UserCreateAction $userCreateAction, ResponseFactory $responseFactory)
    {
        $this->userCreateAction = $userCreateAction;
        $this->responseFactory  = $responseFactory;
    }

    public function run(RegistrationRequest $request): JsonResponse
    {
        $userDto = $request->getData();

        try {
            $this->userCreateAction->run($userDto);
            return $this->responseFactory->success('Successful registered');
        } catch (Exception $e) {
            return $this->responseFactory->error($e->getMessage());
        }
    }
}
