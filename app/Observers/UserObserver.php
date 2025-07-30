<?php

namespace App\Observers;
use App\Models\{User};

class UserObserver
{
    public function created(User $user)
    {
        $username = $user->first_name.' '.$user->last_name;
        $user = User::where('id',$user["id"])->update(["username" => $username]);
    }
}
