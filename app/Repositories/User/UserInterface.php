<?php 

namespace App\Repositories\User;


interface UserInterface {

    public function reg($data);

    public function getAll();

    public function find($id);

    public function checkUserWithEmail($email);

    public function delete($id);
}