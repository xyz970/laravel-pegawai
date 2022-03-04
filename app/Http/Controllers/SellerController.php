<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\Seller\LoginRequest;
use App\Http\Requests\API\Seller\RegisterRequest;
use App\Http\Requests\API\Seller\SettingsRequest;
use App\Models\Seller;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

use function PHPUnit\Framework\isNull;

class SellerController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $registerRequest)
    {
        $registerRequest->validated();
        Seller::create($registerRequest->validated());
        // $seller = new Seller;
        // $seller['firstname'] = $registerRequest->firstname;
        // $seller['lastname'] = $registerRequest->lastname;
        // $seller['email'] = $registerRequest->email;
        // $seller['password'] = $registerRequest->password;
        // $seller['store_name'] = $registerRequest->store_name;
        // $seller->save();
        return $this->successResponse('','Anda Berhasil mendaftar..');
    }

    public function login(LoginRequest $loginRequest)
    {
        $check = Seller::where('email','=',$loginRequest->email)->first();
        if ($check == '') {
           return $this->errorResponse("User Tidak ditemukan",404);
        }
        config()->set('auth.defaults.guard', 'sellers');
        Config::set('jwt.user', 'App\Models\Seller');
        Config::set('auth.providers.user.model', App\Models\Seller::class);
        $credentials = $loginRequest->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
              return  $this->errorResponse('Mohon cek kembali email dan password anda');
            }
        } catch (JWTException $e) {
          return  $this->errorResponse('Token tidak dapat dibuat',500);
        }
        return response()->json([
            'token' => $token,
            'user' =>Auth::guard('sellers')->user(),
        ]);
    }

    public function check()
    {
        $user = Auth::guard('sellers')->user();
        return $this->successResponse(['user'=>$user],'Success');
    }

    public function settings(SettingsRequest $settingsRequest)
    {
        $user = Auth::guard('sellers')->user();
        
    }
}
