<?php

namespace App\Http\Controllers;

use App\Models\Venue as Venue;
use App\Models\User as User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Timeline;
use Illuminate\Support\Str;
use Auth;
use Exception;

class VenuesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = array();
        $totalPrice = 0;
        $loggedUser = Auth::user();
        if ($loggedUser->role === "admin") {
            $venueList = Venue::where('is_active', '=', 1)->get();
            foreach ($venueList as $venue) {
                $owner = User::where('id', $venue->owner)->first();
                $clientCount = Timeline::where('venue', $venue->id)->count();
                $venue->owner = $owner;
                $venue->client_count = $clientCount;
                array_push($venues, $venue);
                $totalPrice += intval($venue->plan_price);
            }
        }
        return view('venues.index')->with('venues', $venues)->with('user', $loggedUser)->with('totalPrice', $totalPrice);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $loggedUser = Auth::user();
        if ($loggedUser->role === "admin") {
            $owners = User::where('role', 'owner')->get();

            return view('venues.create')->with('owners', $owners)->with('venue', null);
        } else {
            return redirect("/events");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loggedUser = Auth::user();
        if ($loggedUser->role === "admin") {
            $this->validate($request, [
                'name' => 'required',
                'owner_name' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                'email' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->image != null) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/upload-images'), $imageName);
            }

            $venue = new Venue;
            $user = new User;
            $venue->name = $request->name;
            $venue->phone = $request->phone;
            $venue->email = $request->email;
            $venue->url_handle = $request->url_handle;
            $venue->logo = $request->image == null ? $venue->logo : $imageName;
            $venue->timeline_organizer = $request->timeline_organizer == 1 ? 1 : 0;
            $venue->menu_designer = $request->menu_designer == 1 ? 1 : 0;
            $venue->owner = 0;
            $user->name = $request->owner_name;
            $user->cell = $request->phone;
            $user->email = $request->email;
            $randomPass = Str::random(12);
            $user->password = Hash::make($randomPass);
            $user->role = "owner";
            $user->primary_user = 1;
            $user->venue = 0;
            $user->save();
            $venue->save();

            $this->updateVenueOwner($venue, $user, $randomPass);
            return redirect('/admin/index');
        } else {
            return redirect('/');
        }
    }

    /**
     * Helper method update venue and owner values
     */
    public function updateVenueOwner(Venue $venue, User $owner, String $userPass)
    {
        $updatedVenue = Venue::find($venue->id);
        $updatedUser = User::find($owner->id);

        $updatedVenue->owner = $updatedUser->id;
        $updatedUser->venue = $updatedVenue->id;


        if ($updatedVenue->save() && $updatedUser->save()) {
            (new NotificationController)->customerWelcomeNotification($updatedUser, $userPass, $updatedVenue->url_handle);
            return redirect('/events')->with('success', 'New Customer was succesfully created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loggedUser = Auth::user();
        if ($loggedUser->role === "user") {
            return redirect("/events");
        }

        $venue = Venue::find($id);
        return view('venues.show')->with('venue', $venue);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($url_handle)
    {
        $customer = Venue::where('url_handle', $url_handle)->first();
        $loggedUser = Auth::user();
        $owner = User::find($customer->owner);

        if ($loggedUser->role === "user") {
            return redirect("/events")->with('error', 'User not authorized');
        }

        if ($loggedUser->role === "owner" && $loggedUser->venue == $customer->id) {
            return redirect("/events")->with('error', 'User not authorized');
        }

        if ($loggedUser->role === "admin") {
            if ($customer == null) {
                return redirect("/admin/index")->with('error', "Client not found");
            }
            $owners = User::where('role', 'owner')->get();

            return view('venues.edit')->with('venue', $customer)->with('owner', $owner);
        } else {
            return redirect("/admin/index");
        }
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
        $loggedUser = Auth::user();
        if ($loggedUser->role === "user") {
            return redirect("/events");
        }
        $venue = Venue::find($id);

        if ($loggedUser->role === "admin" || $loggedUser->id == $venue->owner) {
            $this->validate($request, [
                'name' => 'required',
                'owner_name' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                'email' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->image != null) {
                $imageName = time() . '.' . $request->image->extension();
                
                // Public Folder
                $request->image->move(public_path('images/upload-images'), $imageName);
            }

            $ownerUpdate = User::find($venue->owner);
            $ownerUpdate->venue = $venue->id;
            $ownerUpdate->name = $request->owner_name;
            $ownerUpdate->cell = $request->phone;
            $ownerUpdate->email = $request->email;
            $venue->name = $request->name;
            $venue->phone = $request->phone;
            $venue->email = $request->email;
            $venue->url_handle = $request->url_handle;
            $venue->timeline_organizer = $request->timeline_organizer == 1 ? 1 : 0;
            $venue->menu_designer = $request->menu_designer == 1 ? 1 : 0;
            $venue->logo = $request->image == null ? $venue->logo : $imageName;
            $venue->save();
            $ownerUpdate->save();
        }
        return redirect('/admin/index')->with('success', 'Venue was succesfully updated.');
    }

    public function support()
    {
        $loggedUser = Auth::user();
        if($loggedUser->role !== 'owner'){
            return redirect()->back();
        }

        $venue = Venue::find($loggedUser->venue);
        $url_handle = $venue->url_handle;
        $count = Timeline::where([['venue', $venue->id], ['is_archived', 0], ['is_active', 1]])->count();
        $archiveCount = Timeline::where([['venue', $venue->id], ['is_archived', 1], ['is_active', 1]])->count();

        return view('venues.support')->with('venue', $venue)->with('count', $count)->with('archiveCount', $archiveCount)->with('url_handle', $url_handle);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    /**
     * Soft Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $venue = Venue::find($id);
        $owner = User::find($venue->owner);
        $loggedUser = Auth::user();
        if (!$request->verify) {
            return redirect()->back()->with('error', 'Please check box to authorize Customer Disable');
        }
        if ($loggedUser->role == "admin" && $request->verify) {
            $venue->is_active = 0;
            $owner->is_active = 0;
            $venue->save();
            $owner->save();
            return redirect('/admin/index')->with('success', 'Venue was succesfully deleted.');
        } else {
            return redirect()->back()->with('error', 'User not authorized to delete venue');
        }
    }

    /**
     * Reset password for customer admin (primary owner) account
     */
    public static function pwReset(Request $request, $url_handle)
    {
        $loggedUser = Auth::user();
        $venue = Venue::where('url_handle', $url_handle)->first();
        $primaryOwner = User::where([['venue', $venue->id], ['primary_user', 1]])->first();
        if ($loggedUser->role != 'admin') {
            return redirect('/events')->with('error', 'User not authorized to reset password');
        }
        //Safety Case check. This case should not happen, handled by button validation.
        if (!$request->confirm_reset) {
            return redirect()->back()->with('error', 'Please verify password reset by checking appropriate checkbox');
        }

        $randomPass = Str::random(12);
        $primaryOwner->password = Hash::make($randomPass);

        if ($primaryOwner->save()) {
            (new MailController)->passwordReset($randomPass,  $primaryOwner->email);
            return redirect()->back()->with('success', 'Customer Password Succesfully Reset');
        }
        return redirect()->back()->with('error', 'Unable to reset password. Please try reset action again or contact an administrator');
    }

    public function contactEmail(Request $request)
    {
        try {
            (new MailController)->contactForm($request->name, $request->email, $request->message);
            return redirect()->back()->with('success', 'Message to Admin team was sent successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Unable to send email at this time. Please try again late');
        }
    }
}
