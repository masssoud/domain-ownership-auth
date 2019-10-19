<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/19/2019
 * Time: 9:26 PM
 */

namespace App\DTOs;


use App\Interfaces\UserDataTransformer;
use App\User;

class JsonUserDataTransformer implements UserDataTransformer
{
    /**
     * @var User
     */
    private $data;
    private $token;

    /**
     * @return User
     */
    public function getData(): User
    {
        return $this->data;
    }

    /**
     * @param User $data
     */
    public function setData(User $data): void
    {
        $this->data = $data;
    }

    /**
     * @param User $user
     */
    public function write(User $user,$token)
    {
        $this->token = $token;
        $this->data = $user;
    }

    /**
     * @return User
     */
    public function read()
    {
        return $this->data;
    }

    public function getToken(){
        return $this->token;
    }

    public function setToken($token){
        $this->token = $token;
    }

}