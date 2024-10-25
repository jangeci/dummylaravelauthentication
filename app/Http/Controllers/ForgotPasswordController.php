<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $email = $request->email;
        if (User::where('email', $email)->doesntExist()) {
            return response([
                'message' => 'Email not found',
            ], 401);
        }

        //generate Random Token
        $token = rand(10, 100000);
        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
            ]);
            //Send mail to user
            Mail::to($email)->send(new ForgotPasswordMail($token));

            return response([
                'message' => 'Reset password link sent on your email',
            ], 200);

        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
            ], 400);
        }
    }

    public function resetPassword($token, ForgotPasswordRequest $request){

    }
}
