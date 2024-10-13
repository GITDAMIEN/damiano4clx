<?php

namespace App\Http\Controllers;

use App\Exceptions\RequestException;
use Throwable;
use App\Providers\UserService;
use InvalidArgumentException;
use App\Http\Validators\UserSearchRequest;

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

            $view = $request->getView();
            $viewLoad = $view === 'thumb' ? 'components.usersThumbnails' : 'components.usersTable';
            $filters = $request->getValues();

            return view('welcome', compact('filteredUsers', 'view', 'viewLoad', 'filters'));
        } catch (InvalidArgumentException | RequestException $e) {
            return view('welcome', ['error' => $e->getMessage()]);
        } catch (Throwable $th) {
            return view('welcome', ['error' => 'Something went wrong. Please try again or contact the admin.']);
        }
    }
}
