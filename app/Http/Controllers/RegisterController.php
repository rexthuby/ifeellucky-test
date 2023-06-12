<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\RegisterService;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, RegisterService $registerService): JsonResponse
    {
        $validData = $request->validated();
        $key = $registerService->register($validData);
        return response()->json(['key' => $key]);
    }
}
