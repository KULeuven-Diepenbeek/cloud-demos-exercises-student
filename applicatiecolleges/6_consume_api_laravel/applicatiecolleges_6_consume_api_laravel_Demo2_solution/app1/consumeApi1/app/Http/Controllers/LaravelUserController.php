<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LaravelUser;

class LaravelUserController extends Controller
{
    // Get all laravelUsers
    public function getLaravelUsers(Request $request)
    {
        $pwd = $request->query('pwd');
        if ($pwd == 'mypassword') {
            $laravelUsers = LaravelUser::all();
            return response()->json($laravelUsers, 200);
        } else {
            return response()->json(['message' => 'Wrong password mate'], 403);
        }
    }

    // Get a single laravelUser by ID
    public function getLaravelUser($id)
    {
        $laravelUser = LaravelUser::find($id);
        if ($laravelUser) {
            return response()->json($laravelUser, 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    // Create a new laravelUser
    public function createLaravelUser(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');

        if (!$name || !$email) {
            return response()->json(['error' => 'Name and email required'], 400);
        }

        try {
            $laravelUser = new LaravelUser();
            $laravelUser->name = $name;
            $laravelUser->email = $email;
            $laravelUser->save();

            return response()->json(['message' => 'User created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Delete a laravelUser
    public function deleteLaravelUser($id)
    {
        $laravelUser = LaravelUser::find($id);
        if (!$laravelUser) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $laravelUser->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
