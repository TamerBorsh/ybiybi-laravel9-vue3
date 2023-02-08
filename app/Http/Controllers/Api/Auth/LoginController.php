<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
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
            $user = User::whereEmail($request->post('email'))->first();
            if (!$user) {
                return response()->json(
                    ['code' => Response::HTTP_NOT_FOUND, 'status' => 'true', 'message' => 'المستخدم غير موجود'],
                    Response::HTTP_NOT_FOUND
                );
            }
            // return $user;
            if (Hash::check($request->post('password'), $user->password)) {
                $token = $user->createToken('Login-Api');
                $user->fcm_token = $request->fcm_token;
                $user->save();
                $user->setAttribute('token', $token->accessToken);

                // return response()->json(
                //     ['code' => Response::HTTP_OK, 'success' => 'true', 'message' => 'تم تسجيل الدخول بنجاح', 'object' => $user],
                //     Response::HTTP_OK
                // );
                
            

                return response()->json([
                    'code' => Response::HTTP_OK,
                    'success' => true,
                    'data' => $token,
                    'message' => 'User login successfully'
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
