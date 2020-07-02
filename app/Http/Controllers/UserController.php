<?php

namespace App\Http\Controllers;

use App\Country;
use App\Gender;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $polls = $user->polls()->latest()->paginate(10);
        $votes = $user->votes()->latest()->paginate(10);
        $comments = $user->comments()->latest()->paginate(10);

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

        if ($updatedUser['country_id'] !== '1') {
            $updatedUser['state_id'] = null;
        }

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
        //
    }

    protected function validateUser()
    {
        return request()->validate([
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
