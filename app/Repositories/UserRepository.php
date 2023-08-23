<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface 
{
    /**
     * @return array
     */
    public function index(Request $request) {
        $users = User::all();
        return $users;
    } 

    /**
     * @param int $id
     * @return ?User
     */
    public function show(int $id) {
        $user = User::findOrFail($id);
        return $user;
    }
}