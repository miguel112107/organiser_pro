<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class CustomAuthController extends Controller
{
    public function index($url_handle)
    {
        $clientOrCustomer = (Venue::where('url_handle', $url_handle)->first()) ?? (Timeline::where('url_handle', $url_handle)->first()) ?? null;
        $type = $clientOrCustomer->owner != null ? "venue" : "client";

        $venue = $type == "venue" ? $clientOrCustomer : Venue::find($clientOrCustomer->venue);
        return view('auth.login')->with('venue', $venue)->with("type", $type);
    }

    public function customLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        if ($user->role == "admin") {
            return redirect('/$url_handle')->with('error', 'Please log in using the administrator login page');
        }
        else {
            $request->authenticate();
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect("admin/index");
    }
}
