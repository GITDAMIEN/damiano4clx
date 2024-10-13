<?php

namespace App\Providers;

use App\Http\Validators\UserSearchRequest;
use App\Models\ClxUser;
use DateTime;

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
     * I preferred to convert the users to ClxUser objects.
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
        $activeFilter = $request->getActive();
        $nameFilter = $request->getName();
        $surnameFilter = $request->getSurname();
        $fromFilter = $request->getFrom();
        $toFilter = $request->getTo();

        if ($activeFilter) {
            $usersCollection = $usersCollection->where('active', $activeFilter);
        }

        if ($nameFilter) {
            $usersCollection = $usersCollection->filter(function ($user) use ($nameFilter) {
                return substr($user->name, 0, strlen($nameFilter)) === $nameFilter;
            });
        }

        if ($surnameFilter) {
            $usersCollection = $usersCollection->filter(function ($user) use ($surnameFilter) {
                return substr($user->surname, 0, strlen($surnameFilter)) === $surnameFilter;
            });
        }

        if ($fromFilter) {
            $usersCollection = $usersCollection->filter(function ($user) use ($fromFilter) {
                return $user->last_login >= DateTime::createFromFormat('Y-m-d\TH:i:s', $fromFilter);
            });
        }

        if ($toFilter) {
            $usersCollection = $usersCollection->filter(function ($user) use ($toFilter) {
                return $user->last_login <= DateTime::createFromFormat('Y-m-d\TH:i:s', $toFilter);
            });
        }

        return $usersCollection->all();
    }
}
