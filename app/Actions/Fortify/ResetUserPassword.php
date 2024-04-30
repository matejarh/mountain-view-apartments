<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  array<string, string>  $input
     */
    public function reset(User $user, array $input): void
    {
        $attributeNames = array(
            'password' => __('New Password'),
            'password_confirmation' => __('Password Confirmation'),
        );

        $validator = Validator::make($input, [
            'password' => $this->passwordRules(),
        ]);

        $validator->setAttributeNames($attributeNames)->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
