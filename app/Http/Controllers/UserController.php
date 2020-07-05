<?php

namespace App\Http\Controllers;

use App\Country;
use App\Gender;
use App\State;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        $polls = $user->polls()->latest()->paginate(10, ['*'], 'polls_page');
        $votes = $user->votes()->latest()->paginate(10, ['*'], 'votes_page');
        $comments = $user->comments()->latest()->paginate(10, ['*'], 'comments_page');

        return view('users.show', compact(['user', 'polls', 'votes', 'comments']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $genders = Gender::all();
        $countries = Country::all();
        $states = State::all();

        $this->authorize('update', $user);

        return view('users.edit', compact(['user', 'genders', 'countries', 'states']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $updatedUser = $this->validateUser($user);

        // Don't keep the state if the user is not from the US
        if ($updatedUser['country_id'] !== '1') {
            $updatedUser['state_id'] = null;
        }

        // Handle avatar
        if (Arr::exists($updatedUser, 'avatar')) {
            $originalImage = $request->file('avatar');
            $originalPath = $originalImage->getPathName();
            $originalExtension = $originalImage->extension();
            $storagePath = storage_path('app/public/avatars/' . $user->id . '.' . $originalExtension);
            $croppedImage = Image::make($originalPath);
            $croppedImage = $croppedImage->fit(200);
            $croppedImage->save($storagePath);

            $updatedUser['avatar'] = 'avatars/' . $user->id . '.' . $originalExtension;
        }

        $updatedUser['updated_at'] = Carbon::now();

        $user->update($updatedUser);

        return redirect(route('users.show', $user));
    }

    public function updateSettings(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $updatedUser = $this->validateUserSettings($user);

        // Slugify any new username
        $username = $updatedUser['username'];
        $slug = Str::of($username)->slug();
        $updatedUser['slug'] = $slug;

        // Don't try to update the password if the user left those fields blank
        if (is_null($updatedUser['password'])) {
            Arr::forget($updatedUser, 'password');
        } else {
            $updatedUser['password'] = Hash::make($updatedUser['password']);
        }

        $updatedUser['updated_at'] = Carbon::now();

        $user->update($updatedUser);

        return redirect(route('users.show', $user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->update(['is_deleted' => true]);

        return redirect('/')->with(Auth::logout());
    }

    protected function validateUser()
    {
        return request()->validate([
            'avatar' => 'nullable|image',
            'description' => 'nullable|string|max:300',
            'age' => 'nullable|integer|min:13|max:99',
            'gender_id' => 'nullable|integer|exists:genders,id',
            'country_id' => 'nullable|integer|exists:countries,id',
            'state_id' => 'nullable|integer|exists:states,id',
        ]);
    }

    protected function validateUserSettings(User $user)
    {
        return request()->validate([
            'username' => 'required|string|alpha_dash|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    }
}
