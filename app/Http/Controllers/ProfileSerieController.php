<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Storage;


class ProfileSerieController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        try {
            $request->validateWithBag('userDeletion', [
                'password' => ['required', 'current_password'],
            ]);

            $user = $request->user();

            Auth::logout();

            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();


            return Redirect::to('/')->with('message.success', 'Profile deleted!');

        } catch (Exception $exception) {
            log::error('Error while deleting profile' . $exception->getMessage());
            return back()->withErrors('message.error', 'Error while deleting profile please try again');
        }

    }

    public function updatePhoto(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'profile_photo_path' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            ]);

            $user = $request->user();

            if ($request->hasFile('profile_photo_path')) {
                if ($user->profile_photo) {
                    Storage::disk('public')->delete($user->profile_photo);
                }

                $path = $request->file('profile_photo_path')->store('profile_photos', 'public');
                $user->update(['profile_photo_path' => $path]);
            }

            return back()->with('message.succsess', 'Photo updated successfully');

        } catch (Exception $exception) {
            log::error('message.error' . $exception->getMessage());
            return back()->withErrors('message.error', 'Error updating profile photo');
        }

    }

    public function destroyPhoto(Request $request)
    {
        try {
            $user = $request->user();

            if ($user->profile_photo_path) {

                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($user->profile_photo_path)) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }

                $user->update(['profile_photo_path' => null]);
            }

            return back()->with('message.success', 'Photo deleted successfully');
        } catch (Exception $exception) {
            log::error("Error while deleting Photo " . $exception->getMessage());
            return back()->withErrors('message.error', 'Error while deleting Photo, please try again');
        }
    }
}
