<?php
declare(strict_types=1);

namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface OrderServiceInterface 
{
    /**
     * Store order
     * @param $request
     * @return JsonResponse
     */
    public function store(Request $request);
    
    /**
     * Destroy order
     * @param $request
     * @return JsonResponse
     */
    public function destroy(string $id);
}