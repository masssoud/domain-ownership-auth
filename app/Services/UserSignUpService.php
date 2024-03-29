<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/11/2019
 * Time: 10:09 PM
 */

namespace App\Services;


use App\Domain;
use App\Http\Requests\UserStoreRequest;
use App\Interfaces\DomainRepositoryInterface;
use App\Interfaces\UserDataTransformer;
use App\Interfaces\UserRepositoryInterface;
use http\Client\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserSignUpService
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
     * @param UserStoreRequest $request
     * @return UserSignUpService
     */
    public function execute(UserStoreRequest $request)
    {
        $user = $this->userRepository->create($request);

        $token = JWTAuth::fromUser($user);

        $this->dataTransformer->write($user,$token);

        return $this;
    }

    public function userDataTransformer(){
        return $this->dataTransformer;
    }
}