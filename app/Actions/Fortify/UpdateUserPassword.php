<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        $attributeNames = array(
            'current_password' => __('Current Password'),
            'password' => __('New Password'),
            'password_confirmation' => __('Password Confirmation'),
        );

        $validator = Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
        ], [
            'current_password.current_password' => __('The provided password does not match your current password.'),
            'password.confirmed' => __('Password confirmation does not match.')
            /* 'current_password.required' => __('Current password is required.'),
            'password.required' => __('New password is required.'), */
        ]);

        $validator->setAttributeNames($attributeNames)->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        if (auth()->user() === $user) {
            session()->flash('flash.banner', __('Your password has been changed.'));
        } else {
            session()->flash('flash.banner', __('Users password has been changed.'));
        }
    }
}
