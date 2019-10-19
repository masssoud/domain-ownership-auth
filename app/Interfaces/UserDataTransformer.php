<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/11/2019
 * Time: 5:40 PM
 */

namespace App\Interfaces;


use App\User;

interface UserDataTransformer
{
    public function write(User $user,$token);
    public function read();
}