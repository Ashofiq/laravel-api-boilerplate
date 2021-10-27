<?php

namespace App\Repositories\User\UserTypes;

use App\Repositories\User\UserTypes\UserTypeInterface as UserTypeInterface;
use App\Models\UserTypes\UserTypes;


class UserTypeRepository implements UserTypeInterface
{
    public $UserType;

    function __construct(UserTypes $UserType) {
	    $this->UserType = $UserType;
    }

    public function addType($data)
    {
        return $this->UserType->addType($data);
    }

    
}