<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/11/2019
 * Time: 10:09 PM
 */

namespace App\Services;


use App\Domain;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Interfaces\DomainRepositoryInterface;
use App\Interfaces\UserDataTransformer;
use App\Interfaces\UserRepositoryInterface;
use http\Client\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserLoginService
{
    private $userRepository;
    private $dataTransformer;

    /**
     * DomainAuthService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserDataTransformer $dataTransformer
     */
    public function __construct(UserRepositoryInterface $userRepository,UserDataTransformer $dataTransformer)
    {
        $this->userRepository = $userRepository;
        $this->dataTransformer = $dataTransformer;
    }


    /**
     * @param UserLoginRequest $request
     * @return UserLoginService
     */
    public function execute(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $this->dataTransformer->setToken($token);

        return $this;
    }

    public function userDataTransformer(){
        return $this->dataTransformer;
    }
}