<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegistationOtp;
use App\Models\EmailOtp;
use App\Models\User;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterController extends Controller {

    use ApiResponse;

    /**
     * Send a Register (OTP) to the user via email.
     *
     * @param  \App\Models\User  $user
     * @return void
     */

    private function sendOtp($user) {
        $code = rand(1000, 9999);

        // Store verification code in the database
        $verification = EmailOtp::updateOrCreate(
            ['user_id' => $user->id],
            [
                'verification_code' => $code,
                'expires_at'        => Carbon::now()->addMinutes(15),
            ]
        );

        Mail::to($user->email)->send(new RegistationOtp($user, $code));
    }

    /**
     * Register User
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request with the register query.
     * @return \Illuminate\Http\JsonResponse  JSON response with success or error.
     */

    public function userRegister(Request $request) {

        $validator = Validator::make($request->all(), [
            'first_name'           => 'required|string|max:255',
            'last_name'            => 'required|string|max:255',
            'phone'                => 'required|numeric',
            'avatar'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email'          => 'required|email|unique:users,email',
            'password'       => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'password.min' => 'The password must be at least 8 characters long.',
            'gender.in'    => 'The selected gender is invalid.',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), "Validation Error", 422);
        }

        if($request->hasFile('avatar')) {
            $image     = $request->file('avatar');
            $imageName = uploadImage($image, 'users');
        }

        try {

            // Find the user by ID
            $user                 = new User();
            $user->first_name           = $request->input('first_name');
            $user->last_name            = $request->input('last_name');
            $user->phone                 = $request->input('phone');
            $user->avatar               = $imageName;
            $user->email          = $request->input('email');
            $user->password       = Hash::make($request->input('password')); 

            $user->save();

            // Generate a JWT token for the user
            $token = JWTAuth::fromUser($user);

            // Add the token to the user object
            $user->setAttribute('token', $token);


            return $this->success($user, 'User registered successfully', 201);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Verify the OTP sent to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function otpVerify(Request $request) {

        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric|digits:4',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), "Validation Error", 422);
        }

        try {
            // Retrieve the user by email
            $user = User::where('email', $request->input('email'))->first();

            $verification = EmailOtp::where('user_id', $user->id)
            ->where('verification_code', $request->input('otp'))
            ->where('expires_at', '>', Carbon::now())
            ->first();


            if ($verification) {

                $user->email_verified_at = Carbon::now();
                $user->save();

                $verification->delete();

                $token = JWTAuth::fromUser($user);

                $user->setAttribute('token', $token);

                return $this->success($user, 'OTP verified successfully', 200);
            } else {

                return $this->error([], 'Invalid or expired OTP', 400);
            }
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }

    /**
     * Resend an OTP to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function otpResend(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors(), "Validation Error", 422);
        }

        try {
            // Retrieve the user by email
            $user = User::where('email', $request->input('email'))->first();

            $this->sendOtp($user);

            return $this->success($user, 'OTP has been sent successfully.', 200);
        } catch (\Exception $e) {
            return $this->error([], $e->getMessage(), 500);
        }
    }
}
