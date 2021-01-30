<?php

namespace App\Policies;

use App\User;
use App\UserRight;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookAuthorsPolicy
{
    use HandlesAuthorization;

    const MODAL_NAME = 'author';

    public function __construct(){}

    private function checkRight(User $user, String $right){
        return UserRight::where('user_id', $user->id)->where('right', $right)->where('model', self::MODAL_NAME)->exists();
    }
    public function add(User $user){
        return $this->checkRight($user, 'add');
    }
    public function view(User $user){
        return $this->checkRight($user, 'view');
    }
    public function update(User $user){
        return $this->checkRight($user, 'update');
    }
    public function delete(User $user){
        return $this->checkRight($user, 'delete');
    }
}
