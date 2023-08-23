<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{  
    private UserRepositoryInterface $userRepository;
    private UserServiceInterface $userService;
    
    /**
     * @param UserRepository $userRepository
     */
    public function __construct (UserRepositoryInterface $userRepository, UserServiceInterface $userService){
        $this->userRepository = $userRepository;
        $this->userService = $userService;
    }

    /**
      * @param $request
     * @return array
     */
    public function index(Request $request) {
        return $this->userRepository->index($request);
    }

    /**
      * @param int $id
     * @return ?User
     */
    public function show(int $id) {
        return $this->userRepository->show($id);
    }

    /**
     * Store user
     * @param $request
     * @return JsonResponse
     */
    public function store(Request $request) {
        return $this->userService->store($request);
    }
    
    /**
     * Login user
     * @param $request
     * @return JsonResponse
     */
    public function login(Request $request) {
        return $this->userService->login($request);
    }

    /**
     * Logout user
     * @return JsonResponse
     */
    public function logout() {
        return $this->userService->logout();
    }
} 