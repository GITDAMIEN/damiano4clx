<?php

namespace App\Http\Controllers;

use App\Exceptions\RequestException;
use Throwable;
use App\Providers\UserService;
use InvalidArgumentException;
use App\Http\Validators\UserSearchRequest;
use App\Exceptions\Loggers\MyLogger;

class UserController
{
    public function showUserAction()
    {
        $request = new UserSearchRequest($_POST);

        try {
            if (!$request->validate()) {
                throw new RequestException($request->getError());
            }

            $filteredUsers = UserService::filterUsers($request);

            if (!count($filteredUsers)) {
                throw new InvalidArgumentException('No users found');
            }

            $view = $request->getView();
            $viewLoad = $view === 'thumb' ? 'components.usersThumbnails' : 'components.usersTable';

            return view($viewLoad, compact('filteredUsers'));
        } catch (InvalidArgumentException | RequestException $e) {
            // Here I'm managing the handled exceptions giving the user a valid error message
            return view('components.error', ['error' => $e->getMessage()]);
        } catch (Throwable $th) {
            // Here I'm managing the unhandled exceptions separately in order not to give a bad error message to the user
            MyLogger::log($th);

            return view('components.error', ['error' => 'Something went wrong. Please try again or contact the admin.']);
        }
    }
}
