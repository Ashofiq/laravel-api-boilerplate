<?php

namespace App\Repositories\User;

use App\Repositories\User\UserInterface as UserInterface;
use App\Models\User;


class UserRepository implements UserInterface
{
    public $user;

    function __construct(User $user) {
	    $this->user = $user;
    }

    public function reg($data)
    {
        return $this->user->reg($data);
    }

    public function getAll()
    {
        return $this->user->getAll();
    }

    public function find($id)
    {
        return $this->user->findUser($id);
    }

    public function checkUserWithEmail($email)
    {
        return $this->user->checkUserWithEmail($email);
    }

    public function delete($id)
    {
        return $this->user->deleteUser($id);
    }
}