<?php
declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    /**
     * Store user
     * @param $request
     * @return JsonResponse
     */
    public function store(Request $request);

    /**
     * Login user
     * @param $request
     * @return JsonResponse
     */
    public function login(Request $request);
    
    /**
     * Logout user
     * @return JsonResponse
     */
    public function logout();

}