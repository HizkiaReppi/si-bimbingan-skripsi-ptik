<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminProfileUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\HeadOfDepartement;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        if($request->user()->role == 'admin'){
            $user = $request->user();
        } else if ($request->user()->role == 'student'){
            $user = Student::where('user_id', $request->user()->id)->first();
        } else if ($request->user()->role == 'lecturer'){
            $user = Lecturer::where('user_id', $request->user()->id)->first();
        } else if ($request->user()->role == 'HoD'){
            $user = HeadOfDepartement::where('user_id', $request->user()->id)->first();
        }

        return view('profile.edit', compact('user'));
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
     * Update the admin profile information.
     */
    public function update_admin(AdminProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('toast_success', 'Profil berhasil diupdate');
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

        if($user->role == 'admin' && User::where('role', 'admin')->count() <= 1){
            return Redirect::route('profile.edit')->with('toast_error', 'Admin tidak bisa dihapus');
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
