<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'posts' => $request->user()->posts,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // delete old profile from public
        $currentProfileName = public_path('assets/profile_images/' . basename($user->profile_image));

        if (File::exists($currentProfileName)) {
            File::delete($currentProfileName);
        }

        $newProfileName = '';
        if ($request->hasFile('profile_image')) {
            $validate = $request->validate(['profile_image' => 'image|mimes:jpg,png,jpeg,svg,avif|max:2048']);

            $newProfileImage = $request->file('profile_image');
            $newProfileName = time() . '.' . $newProfileImage->getClientOriginalExtension();

            $newProfileImage->move(public_path('/assets/profile_images/'), $newProfileName);

            $newProfileName = $request->getSchemeAndHttpHost() . '/assets/profile_images/' . $newProfileName;
        }

        $user->profile_image = $newProfileName;
        $user->save();

        // $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // public function profileImage(Request $request)

    // {
    //     if (!$request->hasFile('profile_image')) {
    //         return
    //             Redirect::route('profile.edit')->with('error', 'No image provided');
    //     }

    //     $validate = $request->validate(['profile_image' => 'image|mimes:jpg,png,jpeg,svg|max:2048']);

    //     $profile_image = $request->file('profile_image');

    //     $profile_image_name = time() . '.' . $profile_image->getClientOriginalExtension();

    //     $profile_image->move(public_path('/assets/profile_images/'), $profile_image_name);

    //     $profile_image_name = $request->getSchemeAndHttpHost() . '/assets/profile_images/' . $profile_image_name;

    //     $user = $request->user();
    //     $user->profile_image = $profile_image_name;
    //     $user->save();

    //     return
    //         Redirect::route('profile.edit')->with('status', 'profile-image updated.');
    // }
}
