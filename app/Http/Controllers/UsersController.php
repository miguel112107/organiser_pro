<?php

namespace App\Http\Controllers;

use App\Models\User as User;
use App\Models\Venue as Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedUser = Auth::user();

        if ($loggedUser->role == "admin") {
            $users = User::where('is_active', 1)->get();
            return view('users.index')->with('users', $users);
        }

        return redirect("/");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userManagement()
    {
        $loggedUser = Auth::user();
        if ($loggedUser->role != "owner") {
            return redirect('/events');
        }

        $venue = Venue::find($loggedUser->venue);
        $primaryUser = User::where([['venue', $venue->id], ['primary_user', 1]])->first();
        $allUsers = User::where([['venue', $venue->id], ['role', 'owner'], ['primary_user', 0], ['is_active', 1]])->get();

        return view("users.customer-account")
            ->with('venue', $venue)
            ->with('primaryUser', $primaryUser)
            ->with('allUsers', $allUsers);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function weddingUsers()
    {
        $loggedUser = Auth::user();

        if ($loggedUser->role == "owner") {
            $users = User::where('venue', '=', $loggedUser->venue)->where([['role', '=', 'user'], ['is_active', 1]])->get();
            return view('users.index')->with('users', $users);
        }

        return redirect("/");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loggedUser = Auth::user();
        $user = User::find($id);

        if ($user == null || !$user->is_active) {
            return redirect("/users")->with('error', 'User not found');
        }

        $venues = Venue::all();

        if ($loggedUser->role == 'admin') {
            return view('users.edit')->with('user', $user)->with('venues', $venues);
        } else if ($loggedUser->role == 'owner' && $user->venue == $loggedUser->venue) {
            return view('users.edit')->with('user', $user);
        } else if ($loggedUser->role == 'user' && $user->id == $loggedUser->id)
            return view('users.edit')->with('user', $user);

        return redirect('/events');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);

        if ($request->verify) {
            $this->delete($id);
            return redirect()->back()->with('success', 'User was succesfully deleted');
        }

        $user = User::find($id);
        $oldPassword = $user->password;
        if ($request->password_confirmation) {
            $user->password = $request->password_confirmation == $request->password ? Hash::make($request->password) : null;
        }
        if ($request->password_confirmation != $request->password) {
            return redirect()->back()->with('warning', "Passwords don't match. Please try again");
        }

        $loggedUser = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cell = $request->cell;

        if ($loggedUser->role == 'admin') {
            $user->save();
        } else if ($loggedUser->role == 'owner'  && $user->venue == $loggedUser->venue) {
            $user->save();
        } else if ($loggedUser->role == 'user' && $user->id == $loggedUser->id) {
            $user->save();
        }

        if($oldPassword !== $user->password){
            (new NotificationController)->resetSuccessNotification($user);
        }

        return redirect()->back()->with('success', 'User was succesfully updated');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $loggedUser = Auth::user();
        $venue = Venue::find($loggedUser->venue);
        $user->name = $request->name;
        $user->cell = $request->cell;
        $user->email = $request->email;
        $randomPass = Str::random(12);
        $user->password = Hash::make($randomPass);
        $user->role = "owner";
        $user->venue = $loggedUser->venue;
        $user->primary_user = 0;
        $user->is_active = 1;
        if ($user->save()) {
            (new NotificationController)->customerWelcomeNotification($user, $randomPass, $venue->url_handle);
            return redirect()->back()->with('success', 'New Customer was succesfully created');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Reset password for staff accounts account
     */
    public static function pwReset(Request $request, $id)
    {
        $loggedUser = Auth::user();
        $user = User::find($id);
        if ($loggedUser->role != 'owner') {
            return redirect('/events')->with('error', 'User not authorized to reset password');
        }

        //Safety Case check. This case should not happen, handled by button validation.
        if (!$request->confirm_reset) {
            return redirect()->back()->with('error', 'Please verify password reset by checking appropriate checkbox');
        }

        $randomPass = Str::random(12);
        $user->password = Hash::make($randomPass);


        if ($user->save()) {
            (new NotificationController)->randomizedPasswordResetNotification($user, $randomPass);
            return redirect()->back()->with('success', 'Customer Password Succesfully Reset');
        }
        return redirect()->back()->with('error', 'Unable to reset password. Please try reset action again or contact an administrator');
        
    }

    /**
     * Reset password for staff accounts account
     */
    public static function pwResetRequest(Request $request)
    {
        $loggedUser = Auth::user();
        $user = User::where('email', $request->email);
        if ($loggedUser->role != 'owner') {
            return redirect('/events')->with('error', 'User not authorized to reset password');
        }

        //Safety Case check. This case should not happen, handled by button validation.
        if (!$request->confirm_reset) {
            return redirect()->back()->with('error', 'Please verify password reset by checking appropriate checkbox');
        }

        $randomPass = Str::random(12);
        $user->password = Hash::make($randomPass);


        if ($user->save()) {
            (new MailController)->passwordReset($randomPass,  $user->email);
            return redirect()->back()->with('success', 'Customer Password Succesfully Reset');
        }
        return redirect()->back()->with('error', 'Unable to reset password. Please try reset action again or contact an administrator');
        
    }

    /**
     * Soft Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::find($id);
        $loggedUser = Auth::user();
        if ($loggedUser->role == "admin") {
            $user->is_active = 0;
            $user->save();
            return redirect('/users')->with('success', 'User was succesfully deleted.');
        } else if ($loggedUser->role == "owner") {
            $venueId = $user->venue;
            if ($loggedUser->venue == $venueId) {
                $user->is_active = 0;
                $user->save();
                return redirect()->back()->with('success', 'User was succesfully deleted');
            } else {
                return redirect()->back()->with('error', 'User not authorized to delete user');
            }
        } else {
            return redirect()->back()->with('error', 'User not authorized to delete user');
        }
    }
}
