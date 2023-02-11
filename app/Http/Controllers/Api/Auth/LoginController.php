<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Translator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{


    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'             => 'required|string|email|max:255',
            'password'          => 'required|string|min:8',
        ]);
        if (!$validator->fails()) {
            $user = Translator::whereEmail($request->post('email'))->first();
            if (!$user) {
                return response()->json(
                    ['code' => Response::HTTP_NOT_FOUND, 'status' => 'true', 'message' => 'المستخدم غير موجود'],
                    Response::HTTP_NOT_FOUND
                );
            }
            // return $user;
            if (Hash::check($request->post('password'), $user->password)) {

                $token = $user->createToken('Login-Api')->accessToken;

                return response()->json([
                    'code' => Response::HTTP_OK,
                    'success' => true,
                    'data' => $token,
                    'message' => 'User login successfully',
                    'object' => $user
                ], Response::HTTP_OK);
            } else {
                return response()->json(['success' => 'false', 'message' => 'فشل تسجيل الدخول, حاول مرة أخرى'], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
