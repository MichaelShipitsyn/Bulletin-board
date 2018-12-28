<?php
namespace App\UseCases\Profile;
use App\Entity\User;
use App\Http\Requests\Auth\ProfileEditRequest;
class ProfileService
{
    public function edit($id, ProfileEditRequest $request): void
    {
        /** @var User $user */
        $user = User::findOrFail($id);

        $user->update($request->only('name', 'last_name'));
    }
}
