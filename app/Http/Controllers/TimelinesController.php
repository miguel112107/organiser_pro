<?php

namespace App\Http\Controllers;

use App\Models\BarPlan as BarPlan;
use App\Models\DinnerStyle as DinnerStyle;
use App\Models\LinenChoice as LinenChoice;
use App\Models\Location as Location;
use App\Models\Package;
use App\Models\TableLayout as TableLayout;
use Illuminate\Http\Request;
use App\Models\Timeline as Timeline;
use App\Models\Venue;
use App\Models\User;
use App\Models\Vendor;
use App\Models\WeddingCoordinator;
use Illuminate\Support\Facades\Hash;
use Auth;

class TimelinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timelines = Timeline::all();
        return view('timelines.index')->with('timelines', $timelines);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($url_handle)
    {
        if (Auth::user()->role !== 'owner') {
            return redirect()->back()->with('warning', 'User access not authorized');
        }
        $venue = Venue::where('url_handle', $url_handle)->first();
        $locations = Location::all();
        $plans = BarPlan::all();
        $styles = DinnerStyle::all();
        $linens = LinenChoice::all();
        $layouts = TableLayout::all();
        $packages = Package::all();
        return view('timelines.create')
            ->with('locations', $locations)
            ->with('venue', $venue)
            ->with('plans', $plans)
            ->with('styles', $styles)
            ->with('linens', $linens)
            ->with('packages', $packages)
            ->with('layouts', $layouts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'checkin_date' => 'required',
        ]);

        $loggedUser = Auth::user();
        $venue = Venue::find($loggedUser->venue);

        $timeline = new Timeline;
        $user = new User;
        $timeline->url_handle = $request->person1_firstname . '-' . $request->person2_firstname . '-' . $request->wedding_date;
        $timeline->person1_firstname = $request->person1_firstname;
        $timeline->person1_lastname = $request->person1_lastname;
        $timeline->person2_firstname = $request->person2_firstname;
        $timeline->person2_lastname = $request->person2_lastname;
        $timeline->person1_email = $request->person1_email;
        $timeline->person2_email = $request->person2_email;
        $timeline->person1_cell = $request->person1_cell;
        $timeline->person2_cell = $request->person2_cell;
        $timeline->package_choice = $request->package_choice;
        $timeline->checkin_date = $request->checkin_date;
        $timeline->wedding_date = $request->wedding_date;
        $timeline->checkout_date = $request->checkout_date;
        $timeline->arrival_time_notes = $request->arrival_time_notes;
        $timeline->parent_names = $request->parent_names;
        $timeline->guest_headcount_adults = $request->guest_headcount_adults;
        $timeline->guest_headcount_children = $request->guest_headcount_children;
        $timeline->wedding_party_size = $request->wedding_party_size;
        $timeline->day_of_contact = $request->day_of_contact;
        $timeline->first_look = $request->first_look;
        $timeline->ceremony_location = $request->ceremony_location;
        $timeline->ceremony_notes = $request->ceremony_notes;
        $timeline->ceremony_time = $request->ceremony_time;
        $timeline->ceremony_length = $request->ceremony_length;
        $timeline->cocktail_reception_time = $request->cocktail_reception_time;
        $timeline->reception_notes = $request->reception_notes;
        $timeline->grand_entrance = $request->grand_entrance;
        $timeline->parent_child_dance = $request->parent_child_dance;
        $timeline->entertainment_notes = $request->entertainment_notes;
        $timeline->layout_notes = $request->layout_notes;
        $timeline->dance_floor_notes = $request->dance_floor_notes;
        $timeline->cake_display = $request->cake_display;
        $timeline->dessert_display = $request->dessert_display;
        $timeline->linens_napkins = $request->linens_napkins;
        $timeline->chargers = $request->chargers;
        $timeline->table_layout_couple = $request->table_layout_couple;
        $timeline->table_layout_guests = $request->table_layout_guests;
        $timeline->table_layout_notes = $request->table_layout_notes;
        $timeline->lawn_games = $request->lawn_games;
        $timeline->patio_fire_rings = $request->patio_fire_rings;
        $timeline->bar_plan = $request->bar_plan;
        $timeline->bar_service_pause = $request->bar_service_pause;
        $timeline->signature_cocktails = $request->signature_cocktails;
        $timeline->dinner_service_time = $request->dinner_service_time;
        $timeline->intro_speech_dance = $request->intro_speech_dance;
        $timeline->dinner_service_style = $request->dinner_service_style;
        $timeline->breakfast = $request->breakfast;
        $timeline->farewell_brunch = $request->farewell_brunch;
        $timeline->late_night_snack = $request->late_night_snack;
        $timeline->rehearsal_barn = $request->rehearsal_barn;
        $timeline->rehearsal_date = $request->rehearsal_date;
        $timeline->rehearsal_guests = $request->rehearsal_guests;
        $timeline->rehearsal_bar = $request->rehearsal_bar;
        $timeline->rehearsal_dinner_notes = $request->rehearsal_dinner_notes;
        $timeline->severe_allergies = $request->severe_allergies;
        $timeline->severe_allergy_notes = $request->severe_allergy_notes;
        $timeline->special_diet_needs = $request->special_diet_needs;
        $user->name = $request->person1_firstname . ' & ' . $request->person2_firstname;
        $user->email = $request->person1_email;
        $user->cell = $request->person1_cell;
        $userPass = $request->person1_lastname . '.' . $request->person2_lastname;
        $user->password = Hash::make($userPass);
        $user->role = "user";
        $user->venue = $loggedUser->venue;
        $user->save();
        $timeline->user = $user->id;
        $timeline->venue = $loggedUser->venue;

        // Determine is staff or client updated timeline and update stamps
        if ($loggedUser->role = "owner") {
            $timeline->staff_update_user = $loggedUser->id;
            $timeline->staff_update_date = date('Ymd');
        } else if ($loggedUser->role = 'user') {
            $timeline->user_update_date = date('Ymd');
        }
        if ($timeline->save()) {
            (new NotificationController)->customerWelcomeNotification($user, $userPass, $timeline->url_handle);
            $this->addVendors($request, $timeline->id);
            $this->addWC($request, $timeline->id);
            return redirect('/events')->with('success', 'Timeline was succesfully created');
        }

        return redirect()->back()->with('error', 'Error creating timeline');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($url_handle, $event_url_handle)
    {
        $event = Timeline::where('url_handle', $event_url_handle)->first();

        if ($event == null || !$event->is_active) {
            return redirect("events")->with('error', 'Timeline not found');
        }

        $user = User::find($event->user);
        $updateStaff = User::find($event->staff_update_user);
        $updateUser = User::find($event->user);
        $venue = Venue::find($event->venue);
        $locations = Location::all();
        $plans = BarPlan::all();
        $styles = DinnerStyle::all();
        $linens = LinenChoice::all();
        $layouts = TableLayout::all();
        $packages = Package::all();
        $loggedUser = Auth::user();
        $vendors = Vendor::where("timeline_id", $event->id)->get();
        $vendorCount = $vendors->count();
        $wc = WeddingCoordinator::where("timeline_id", $event->id)->first();

        if ($loggedUser->venue == $event->venue || $loggedUser->role == "admin") {
            return view('timelines.edit')
                ->with('locations', $locations)
                ->with('event', $event)
                ->with('plans', $plans)
                ->with('styles', $styles)
                ->with('linens', $linens)
                ->with('layouts', $layouts)
                ->with('user', $user)
                ->with('loggedUser', $loggedUser)
                ->with('packages', $packages)
                ->with('url_handle', $url_handle)
                ->with('loggedUser', $loggedUser)
                ->with('updateStaff', $updateStaff)
                ->with('updateUser', $updateUser)
                ->with('venue', $venue)
                ->with('vendors', $vendors)
                ->with('vendorCount', $vendorCount)
                ->with('wc', $wc);
        }

        return redirect("/events");
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
            'checkin_date' => 'required',
        ]);

        $loggedUser = Auth::user();
        $timeline = Timeline::find($id);
        $timeline->person1_firstname = $request->person1_firstname;
        $timeline->person1_lastname = $request->person1_lastname;
        $timeline->person2_firstname = $request->person2_firstname;
        $timeline->person2_lastname = $request->person2_lastname;
        $timeline->person1_email = $request->person1_email;
        $timeline->person2_email = $request->person2_email;
        $timeline->person1_cell = $request->person1_cell;
        $timeline->person2_cell = $request->person2_cell;
        $timeline->package_choice = $request->package_choice;
        $timeline->checkin_date = $request->checkin_date;
        $timeline->wedding_date = $request->wedding_date;
        $timeline->checkout_date = $request->checkout_date;
        $timeline->arrival_time_notes = $request->arrival_time_notes;
        $timeline->parent_names = $request->parent_names;
        $timeline->guest_headcount_adults = $request->guest_headcount_adults;
        $timeline->guest_headcount_children = $request->guest_headcount_children;
        $timeline->wedding_party_size = $request->wedding_party_size;
        $timeline->day_of_contact = $request->day_of_contact;
        $timeline->first_look = $request->first_look;
        $timeline->ceremony_location = $request->ceremony_location;
        $timeline->ceremony_notes = $request->ceremony_notes;
        $timeline->ceremony_time = $request->ceremony_time;
        $timeline->ceremony_length = $request->ceremony_length;
        $timeline->cocktail_reception_time = $request->cocktail_reception_time;
        $timeline->reception_notes = $request->reception_notes;
        $timeline->grand_entrance = $request->grand_entrance;
        $timeline->parent_child_dance = $request->parent_child_dance;
        $timeline->entertainment_notes = $request->entertainment_notes;
        $timeline->layout_notes = $request->layout_notes;
        $timeline->dance_floor_notes = $request->dance_floor_notes;
        $timeline->cake_display = $request->cake_display;
        $timeline->dessert_display = $request->dessert_display;
        $timeline->linens_napkins = $request->linens_napkins;
        $timeline->chargers = $request->chargers;
        $timeline->table_layout_couple = $request->table_layout_couple;
        $timeline->table_layout_guests = $request->table_layout_guests;
        $timeline->table_layout_notes = $request->table_layout_notes;
        $timeline->lawn_games = $request->lawn_games;
        $timeline->patio_fire_rings = $request->patio_fire_rings;
        $timeline->bar_plan = $request->bar_plan;
        $timeline->bar_service_pause = $request->bar_service_pause;
        $timeline->signature_cocktails = $request->signature_cocktails;
        $timeline->dinner_service_time = $request->dinner_service_time;
        $timeline->intro_speech_dance = $request->intro_speech_dance;
        $timeline->dinner_service_style = $request->dinner_service_style;
        $timeline->breakfast = $request->breakfast;
        $timeline->farewell_brunch = $request->farewell_brunch;
        $timeline->late_night_snack = $request->late_night_snack;
        $timeline->rehearsal_barn = $request->rehearsal_barn;
        $timeline->rehearsal_date = $request->rehearsal_date;
        $timeline->rehearsal_guests = $request->rehearsal_guests;
        $timeline->rehearsal_bar = $request->rehearsal_bar;
        $timeline->rehearsal_dinner_notes = $request->rehearsal_dinner_notes;
        $timeline->severe_allergies = $request->severe_allergies;
        $timeline->severe_allergy_notes = $request->severe_allergy_notes;
        $timeline->special_diet_needs = $request->special_diet_needs;

        // Determine is staff or client updated timeline and update stamps
        if ($loggedUser->role = "owner") {
            $timeline->staff_update_user = $loggedUser->id;
            $timeline->staff_update_date = date('Ymd');
        } else if ($loggedUser->role = "admin") {
            $timeline->superAdmin_update_date = date('Ymd');
        } else if ($loggedUser->role = 'user') {
            $timeline->user_update_date = date('Ymd');
        }

        // $this->addVendors($request->input('vendors', []), $timeline->id);

        $this->addVendors($request, $timeline->id);
        $this->addWC($request, $timeline->id);


        $timeline->save();

        return redirect()->back()->with('success', 'Timeline was succesfully updated');
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
     * Soft Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $timeline = Timeline::find($id);
        $loggedUser = Auth::user();
        if ($loggedUser->role == "admin") {
            $timeline->is_active = 0;
            $timeline->save();
            return redirect()->back()->with('success', 'Timeline was succesfully deleted.');
        } else if ($loggedUser->role == "owner") {
            $venueId = $timeline->venue;
            if ($loggedUser->venue == $venueId) {
                $timeline->is_active = 0;
                $timeline->save();
                return redirect()->back()->with('success', 'Timeline was succesfully deleted');
            } else {
                return redirect()->back()->with('error', 'User not authorized to delete timeline');
            }
        } else {
            return redirect()->back()->with('error', 'User not authorized to delete timeline');
        }
    }
    public function lock($id)
    {
        $timeline = Timeline::find($id);

        $timeline->is_locked ? $timeline->is_locked = 0 : $timeline->is_locked = 1;

        if ($timeline->save()) {
            return redirect()->back()->with('success', 'Client event has been locked');
        } else {
            return redirect()->back()->with('error', 'Client event could not be locked');
        }
    }
    public function archive($id)
    {
        $timeline = Timeline::find($id);

        $timeline->is_archived ? $timeline->is_archived = 0 : ($timeline->is_archived = 1) . ($timeline->is_locked = 1) . ($timeline->archived_date = date('Ymd'));

        if ($timeline->save()) {
            return redirect()->back()->with('success', 'Client event has been locked');
        } else {
            return redirect()->back()->with('error', 'Client event could not be locked');
        }
    }
    public function addVendors($request, $timeline_id)
    {
        $vendors = $request->input('new_vendor');
        $vendorIds = $request->input('vendor_id');
        $vendorEmails = $request->input('vendor_email');
        $vendorPhones = $request->input('vendor_phone');
        // dd($vendors, $vendorEmails, $vendorPhones, $vendorIds);
        foreach ($vendors as $index => $vendor) {
            if ($vendor) {
                // if($vendorEmails[$index] ?? null){
                //     dd($vendorEmails[$index]);
                // }
                $savedVendor = $vendorIds[$index] > 0 ? Vendor::find($vendorIds[$index]) : new Vendor;
                $savedVendor->name = $vendor;
                $savedVendor->email = $vendorEmails[$index] ?? null;
                $savedVendor->phone = $vendorPhones[$index] ?? null;
                $savedVendor->timeline_id = $timeline_id;
                $savedVendor->save();
            }
        }
    }
    public function addWC($request, $timeline_id)
    {
        $savedWC = $request->input('wc_id') ? WeddingCoordinator::find($request->input('wc_id')) : new WeddingCoordinator();
        if ($request->input('wedding_coordinator')) {
            $savedWC->name = $request->input('wedding_coordinator');
            $savedWC->email = $request->input('wedding_coordinator_email');
            $savedWC->phone = $request->input('wedding_coordinator_phone');
            $savedWC->timeline_id = $timeline_id;
            $savedWC->save();
        }
    }
}
