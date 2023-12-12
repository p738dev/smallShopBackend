<?php 
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserService implements UserServiceInterface
{

    /**
     * Store user
     * @param $request
     * @return JsonResponse
     */
    public function store(Request $request) {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'name' => 'required', 
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'role_id' => 'required',
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'is_success' => false,
                    'message' => 'Błąd walidacji usera',
                    'errors' => $validateUser->errors()
                ], 400);
            };

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = $request->role_id;
            $user->save();

            $user_with_role  = User::with('role')
                ->where('id', $user->id)
                ->first();
        
            return response()->json([
                'is_success' => true,
                'message' => 'Poprawnie zapisano usera',
                'user' => $user_with_role,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'is_success' => false,
                'message' => 'Nie można nawiązać połączenia z serwerem'
            ], 500);
        }
    }

    /**
     * Login user
     * @param $request
     * @return JsonResponse
     */
    public function login(Request $request) {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validateUser->fails()) {
                return response()->json([
                    'is_success' => false,
                    'message' => 'Błąd logowania użytkownika!',
                    'errors' => $validateUser->errors()
                ], 401);
            };
        
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'is_success' => false,
                    'message' => 'Niepoprawne dane logowania!',
                ], 400);
            }

            $user = User::where('email', $request->email)
                ->first();

            $role_name = $user->role->role_name;
            
            $name = $user->name;

            $token = $user->createToken('token')->plainTextToken;

            $cookie = cookie('token', $token, 60*24);

            return response([
                'is_success' => true,
                'message' => 'User poprawnie zalogowany!',
                'token' => $token,
                'role_name' => $role_name,
                'name' => $name
            ], 200)->withCookie($cookie);

        } catch (\Throwable $th) {
            return response()->json([
                'is_success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Logout user
     * @return JsonResponse
     */
    public function logout() {
        Auth::logout();
        
        $cookie = Cookie::forget('token');
        
        return response([
            'message' => "Logout successfully",
        ], 200)->withCookie($cookie);
    }
}