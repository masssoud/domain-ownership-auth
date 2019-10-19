<?php

namespace App\Http\Controllers;

use App\DTOs\JsonUserDataTransformer;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Services\UserLoginService;
use App\Services\UserSignUpService;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private $userRepository;
    /**
     * UserController constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticate(UserLoginRequest $request)
    {
        $user_object = (new UserLoginService($this->userRepository,new JsonUserDataTransformer()))->execute($request);
        $token = $user_object->userDataTransformer()->getToken();
        return response()->json(compact('token'));
    }

    public function register(UserStoreRequest $request)
    {
        $user_object = (new UserSignUpService($this->userRepository,new JsonUserDataTransformer()))->execute($request);
        $data = $user_object->userDataTransformer()->read();
        $token = $user_object->userDataTransformer()->getToken();
        return response()->json(compact('data','token'),Response::HTTP_CREATED);
    }
}
