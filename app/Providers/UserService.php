<?php

namespace App\Providers;

use App\Http\Validators\UserSearchRequest;
use App\Models\ClxUser;

class UserService
{
    /**
     * DO NOT MODIFY THIS METHOD
     * ONLY THIS METHOD CAN READ data.txt
     */
    protected function getAllUsers()
    {
        $file = 'data/data.txt';

        $data = json_decode(file_get_contents($file));

        return $data;
    }
    /**
     * Returns an array of objects of all users.
     *
     * @return ClxUser[]
     */
    public static function getUsersObjs(): array
    {
        $usersObjs = [];
        foreach ((new self)->getAllUsers() as $user) {
            $usersObjs[] = new ClxUser($user->id, $user->name, $user->surname, $user->active, $user->last_login, $user->picture, $user->rating);
        }
        return $usersObjs;
    }
    /**
     * Returns an array of the filtered users.
     *
     * @param UserSearchRequest $request
     * @return ClxUser[]
     */
    public static function filterUsers(UserSearchRequest $request): array
    {
        $usersCollection = collect(self::getUsersObjs());
        return $usersCollection->all();
    }
}
