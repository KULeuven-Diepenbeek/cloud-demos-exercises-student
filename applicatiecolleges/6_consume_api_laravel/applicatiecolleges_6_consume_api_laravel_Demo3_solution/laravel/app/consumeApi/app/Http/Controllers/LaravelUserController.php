<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaravelUser;

class LaravelUserController extends Controller
{
    /**
     * @group Laravel Users
     * Haal alle gebruikers op.
     *
     * Dit endpoint geeft een lijst terug van alle Laravel-gebruikers als JSON.
     *
     * @queryParam pwd string Vereist. Wachtwoord om toegang te krijgen. Voorbeeld: mypassword
     * @response 200 scenario="Succesvol" {"id": 1, "name": "John Doe", "email": "john@example.com"}
     * @response 403 scenario="Verkeerd wachtwoord" {"message": "Wrong password mate"}
     */
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

    /**
     * @group Laravel Users
     * Haal een specifieke gebruiker op.
     *
     * Geeft de gegevens van een gebruiker terug op basis van zijn ID.
     *
     * @urlParam id integer Vereist. De ID van de gebruiker. Example: 1
     * @response 200 {"id": 1, "name": "John Doe", "email": "john@example.com"}
     * @response 404 {"message": "User not found"}
     */
    public function getLaravelUser($id)
    {
        $laravelUser = LaravelUser::find($id);
        if ($laravelUser) {
            return response()->json($laravelUser, 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }

    /**
     * @group Laravel Users
     * Maak een nieuwe gebruiker aan.
     *
     * @bodyParam name string Vereist. De naam van de gebruiker. Example: John Doe
     * @bodyParam email string Vereist. Het e-mailadres van de gebruiker. Example: john@example.com
     * @response 201 {"message": "User created successfully"}
     * @response 400 {"error": "Name and email required"}
     * @response 500 {"error": "Database error"}
     */
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

    /**
     * @group Laravel Users
     * Verwijder een gebruiker.
     *
     * @urlParam id integer Vereist. De ID van de gebruiker. Example: 3
     * @response 200 {"message": "User deleted successfully"}
     * @response 404 {"message": "User not found"}
     */
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