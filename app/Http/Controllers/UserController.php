<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit', [
            'user' => auth()->user()
        ]);;
    }

    public function update()
    {
        $attributes = $this->validateUser(auth()->user());

        if ($attributes['avatar'] ?? false) {
            $attributes['avatar'] = request()->file('avatar')->store('avatar');
        }

        auth()->user()->update($attributes);

        return back()->with('success', 'Your account has been updated!');
    }

    protected function validateUser(User $user): array
    {
        $attributes = request()->validate([
            'username' => ['required', Rule::unique('users', 'username')->ignore($user)],
            'avatar' => ['image'],
        ]);

        return $attributes;
    }
}
