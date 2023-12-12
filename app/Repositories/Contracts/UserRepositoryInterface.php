<?php
declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Http\Request;

interface UserRepositoryInterface {
    
    /**
     * @return array
     */
    public function index(Request $request);

     /**
     * @return ?User
     */
    public function show(int $id);
}