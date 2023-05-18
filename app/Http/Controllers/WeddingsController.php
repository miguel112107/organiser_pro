<?php

namespace App\Http\Controllers;

use App\Models\Timeline as Timeline;
use App\Models\User as User;
use App\Models\Venue;
use Auth;

class WeddingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedUser = Auth::user();
        if ($loggedUser->role === "admin") {
            return redirect('/admin/index');
        } elseif ($loggedUser->role === "owner") {
            $venue = Venue::find($loggedUser->venue);
            return redirect('/'. $venue->url_handle .'/index');
        }else{
            $venue = Venue::find($loggedUser->venue);
            $timeline= Timeline::where('user', $loggedUser->id)->first();
            return redirect('/' . $venue->url_handle . '/client-details/' . $timeline->url_handle);
        }
    }

    /**
     * Display a listing of the weddings per venue.
     *
     * @return \Illuminate\Http\Response
     */
    public function venueWeddings($url_handle, $archive = null)
    {
        $customer = Venue::where('url_handle', $url_handle)->first();
        $loggedUserID = Auth::user()->id;
        $loggedUser = Auth::user();
        $newVenueId = $customer->id;
        $owner = User::find($customer->owner);

        if(($loggedUser->role === "user")||$loggedUser->role === "owner" && $loggedUser->venue != $newVenueId){
            return redirect()->back()->with('warning', 'User not authorized to view customer page');
        }


        if ($loggedUser->role === "admin") {
            $weddings = Timeline::where([
                ['venue', $newVenueId],
                ['is_active', 1]
            ])->get();
        } if($loggedUser->role === "owner") {
            $archiveCount = Timeline::where([
                ['venue', $newVenueId],
                ['is_archived', 1],
                ['is_active', 1]
            ])->count();
            $weddings = Timeline::where([
                ['venue', $newVenueId],
                ['is_archived', $archive == 'archive' && $archiveCount != 0 ? 1 : 0],
                ['is_active', 1]
            ])->get();
            $clientCount = $weddings->count();
            
        } 

        return view('weddings.index')
            ->with('weddings', $weddings)
            ->with('admin', $owner)
            ->with("customer", $customer)
            ->with('clientCount', $clientCount)
            ->with('url_handle', $url_handle)
            ->with('archiveCount', $archiveCount)
            ->with('archive', $archive);
    }

    /**
     * Display a listing of the weddings per venue.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminVenueWeddings($url_handle = null)
    {
        $venue = Venue::where('url_handle', $url_handle)->first();
        $loggedUserID = Auth::user()->id;
        $loggedUser = Auth::user();
        $newVenueId = $venue->id == null ? $loggedUser->venue : $venue->id;
        $owner = User::find($venue->owner);
        if ($loggedUser->role === "admin") {
            $count = Timeline::where([
                ['venue', $newVenueId],
                ['is_active', 1]
            ])->count();
            $events = Timeline::where([
                ['venue', $newVenueId],
                ['is_active', 1]
            ])->get();
        } elseif ($loggedUser->role === "owner") {
            $events = Timeline::where([
                ['venue', $newVenueId],
                ['is_active', 1]
            ])->get();
        } else {
            $events = Timeline::where([
                ['venue', $newVenueId],
                ['user', $loggedUserID],
                ['is_active', 1]
            ])->first();
        }
        return view('weddings.adminIndex')->with('events', $events)->with('url_handle', $url_handle)->with('admin', $owner)->with('count', $count)->with('venue', $venue);
    }
}
