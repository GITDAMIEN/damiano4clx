<?php

namespace Controllers;

use App\Exceptions\RequestException;
use App\Http\Validators\UserSearchRequest;
use App\Providers\UserService;
use InvalidArgumentException;
use Throwable;

class UserController
{
    public function showUserAction()
    {
        try {
            $request = new UserSearchRequest($_POST);
            if (!$request->validate()) {
                throw new RequestException($request->getError());
            }
            $filteredUsers = UserService::filterUsers($request);
            if (!count($filteredUsers)) {
                throw new InvalidArgumentException('No users found');
            }
            return $filteredUsers;
        } catch (InvalidArgumentException | RequestException $e) {
            echo $e->getMessage();
        } catch (Throwable $th) {
            echo 'Unhandled error: ' . $th->getMessage();
        }
    }
}
