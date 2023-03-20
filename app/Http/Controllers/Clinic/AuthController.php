<?php

namespace App\Http\Controllers\Clinic;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Clinic\LoginRequest;
use App\Http\Requests\Clinic\RegisterRequest;
use App\Http\Resources\ClinicResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        $clinic = Clinic::where('email', $data['email'])->first();

        if (!$clinic || !Hash::check($data['password'], $clinic->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.'
            ], 401);
        }
        $token = $clinic->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function register(RegisterRequest $request): JsonResource
    {
        $data = $request->validated();

        if ($data['password'] !== $data['password_confirmation'])
            return response()->json(
                [
                    'message' => 'The provided passwords are not the same.'
                ],
                401
            );

        $data['password'] = Hash::make($data['password']);
        $clinic = Clinic::create($data);

        return ClinicResource::make($clinic);
    }

    public function logout(Request $request): Response
    {
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
