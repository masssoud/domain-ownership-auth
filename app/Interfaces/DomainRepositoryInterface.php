<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/11/2019
 * Time: 5:40 PM
 */

namespace App\Interfaces;


interface DomainRepositoryInterface
{
    public function getAllItems();
    public function getItem($id);
}