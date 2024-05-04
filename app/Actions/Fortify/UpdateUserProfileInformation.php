<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        $attributeNames = array(
            'name' => __('Name'),
            'email' => __('Email'),
            'first_name' => __('First Name'),
            'last_name' => __('Last Name'),
            'phone' => __('Phone'),
            'address' => __('Address'),
            'country' => __('Country'),
            'photo' => __('Photo'),
         );
        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'first_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:2', 'min:2'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png,svg', 'max:1024'],
        ]);

        $validator->setAttributeNames($attributeNames)->validateWithBag('updateProfileInformation');

        if (isset($input['country'])) {
            $input['country']=str($input['country'])->lower();
        }

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'phone' => $input['phone'],
                'address' => $input['address'],
                'country' => $input['country'],
            ])->save();

            if (auth()->user() === $user) {
                session()->flash('flash.banner', __('Your info has been saved.'));
            } else {
                session()->flash('flash.banner', __('User info has been saved.'));
            }
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'phone' => $input['phone'],
            'address' => $input['address'],
            'country' => $input['country'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();

        if (auth()->user() === $user) {
            session()->flash('flash.banner', __('Your info has been saved.') . ' ' . __('Email verification notification has been sent.'));
        } else {
            session()->flash('flash.banner', __('User info has been saved.') . ' ' . __('Email verification notification has been sent.'));
        }
    }
}
