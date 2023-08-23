<?php
declare(strict_types=1);

namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface ProductServiceInterface
{
    /**
     * Store product
     * @param $request
     * @return JsonResponse
     */
    public function store(Request $request);

     /**
     * Update product
     * @param $request, $id
     * @return JsonResponse
     */
    public function update(Request $request, string $id);

    /**
     * Destroy product
     * @param $id
     * @return JsonResponse
     */
    public function destroy(string $id);
}