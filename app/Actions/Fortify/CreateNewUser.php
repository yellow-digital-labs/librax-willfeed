<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserVerification;
use Illuminate\Support\Str;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'accountType' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $verification_token = Str::random(80);

        $res = User::create([
            'accountType' => $input['accountType'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'verification_token' => $verification_token,
            'varification_valid_till' => date('Y-m-d H:i:s')
        ]);

        $verificationUrl = route("verify-email-confirm", ["token" => $verification_token]);

        //send email
        $input['email'] = 'noreply@willfeed.it';
        Mail::to($input['email'])->send(new UserVerification([
            "accountTypeName" => $input['accountType'],
            "verificationUrl" => $verificationUrl
        ]));

        return $res;
    }
}
