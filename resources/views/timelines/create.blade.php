<script>
    let counter = 0;

    function counterCheck() {
        if (counter > 9) {
            document.getElementById('vendor-form').style.display = "none";
            document.getElementById('addVendor').style.display = "none";
        }
    }

    function createVendorComponent(type) {
        if (counter <= 9) {
            type = type || null;
            var rootElement = document.createElement('div');
            var contents = '<input type="hidden" value=-1 name="vendor_id[]"><label for="vendor-new" class="form-label fw-bold text-capitalize fs-6">New Vendor: (Name and Description)</label><span class="UX_note">Leave blank if you do not have any. Their contact info is optional.</span><input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="vendor-name" name="new_vendor[]" /> <div class="row mb-0" name="vendor group 1"><div class="col"><label for="vendor-email" class="form-label fw-bold text-capitalize fs-6">Email:</label><input type="email" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="vendor-email" name="vendor_email[]"/></div><div class="col"><label for="vendor-phone" class="form-label fw-bold text-capitalize fs-6">Mobile Phone:</label><input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="vendor-phone" name="vendor_phone[]"/></div></div>';
            rootElement.innerHTML = contents;
            document.getElementById('new-vendor').appendChild(rootElement);
        }
    }

    function incrementVendorCount() {
        counter = counter + 1;
        if (counter === 9) {
            document.getElementById('addVendor').disabled = true;
        }
    }
</script>
<x-app-layout>
    <header class="container bg-white border-5 border-bottom border-secondary-subtle">
        <div class="row py-4">
            <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto text-center">
                <div class="main-logo">
                    <img class="img-fluid" src="/images/upload-images/{{$venue->logo}}" alt="{{$venue->name}}" />
                </div>
                <div class="brand-title">
                    <h2 class="text-capitalize mb-lg-0">
                        Welcome to <span class="fw-bold">Event Organizer Pro</span>
                    </h2>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto py-4">
                    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="fs-lg-4 fs-6 text-dark fw-bold" href="customer-portal-home.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active fs-lg-4 fs-6 text-dark fw-bold" aria-current="page">
                                Your Client Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="container">
            <!-- Client detail record -->
            <div class="row">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                    <div class="heading-area">
                    </div>
                    <!-- Start Event Details all (3) tabs -->
                    <div class="event-tabs">
                        <ul class="nav nav-tabs border-5 border-bottom">
                            <li class="nav-item pb-3">
                                <a class="nav-link active text-capitalize fw-bold border-0 text-dark fs-5 p-0" href="#eventDetails" data-bs-toggle="tab">
                                    Event Details
                                </a>
                            </li>
                            <li class="nav-item pb-3">
                                <a class="nav-link text-capitalize fw-bold border-0 text-dark fs-5 p-0" href="#layout" data-bs-toggle="tab">
                                    Layout & Decor
                                </a>
                            </li>
                            <li class="nav-item pb-3">
                                <a class="nav-link text-capitalize fw-bold border-0 text-dark fs-5 p-0" href="#foodDrink" data-bs-toggle="tab">
                                    Food & Drink
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- All content for (3) tabs -->
                            <div class="tab-pane active py-lg-5 py-2" id="eventDetails">
                                <div class="row">
                                    <div class="col-12">

                                        <!-- Event details form -->
                                        <form action="{{ route('timeline.store') }}" method="Post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row mb-3">
                                                <div class="col-5">
                                                    <label for="url" class="form-label fw-bold text-capitalize fs-6">
                                                        URL <span class="UX_note">(Auto-generated)</span>
                                                    </label>
                                                    <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark" id="url" placeholder="{URL to couple's page'}" disabled readonly />
                                                </div>
                                                <!-- end mini Row -->
                                            </div>

                                            <fieldset class="fieldset">
                                                <div class="mb-3">
                                                    <i class="fa-solid fa-user-edit"></i>
                                                    <label for="couplename" class="form-label fw-bold text-capitalize fs-6">
                                                        Couple's names
                                                    </label>
                                                    <div class="row g-3 mb-3">
                                                        <!-- 1st person -->
                                                        <label for="person1_name" class="form-label  fs-6">
                                                            Person 1:
                                                        </label>
                                                        <div class="col-5 mt-0">
                                                            <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark" aria-label="First name" placeholder="First" id="person1_firstname" name="person1_firstname" />
                                                        </div>
                                                        <div class="col-7 mt-0">
                                                            <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark" aria-label="Last name" placeholder="Last" id="person1_lastname" name="person1_lastname" />
                                                        </div>
                                                    </div>
                                                    <div class="row g-3 mb-3">
                                                        <!-- 2nd person -->
                                                        <label for="person2_ame" class="form-label  fs-6">
                                                            Person 2:
                                                        </label>
                                                        <div class="col-5 mt-0">
                                                            <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark" aria-label="First name" placeholder="First" id="person2_firstname" name="person2_firstname" />
                                                        </div>
                                                        <div class="col-7 mt-0">
                                                            <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark" aria-label="Last name" placeholder="Last" id="person2_lastname" name="person2_lastname" />
                                                        </div>
                                                        <!--end row -->
                                                    </div>
                                                    <!-- end couple name -->
                                                </div>

                                                <div class="row g-3 mb-3">
                                                    <label for="couple_email" class="form-label fw-bold  fs-6">
                                                        Couple's Emails:
                                                        <br />
                                                        <span class="UX_note">Both are required to receive the emailed e-sign contracts</span>
                                                    </label>
                                                    <div class="col-6 mt-0">
                                                        <label for="person1_email" class="form-label  fs-6">
                                                            Person 1:
                                                        </label>
                                                        <input type="email" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="person1_email" name="person1_email" />
                                                    </div>
                                                    <div class="col-6 mt-0">
                                                        <label for="person2_email" class="form-label  fs-6">
                                                            Person 2:
                                                        </label>
                                                        <input type="email" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark" id="person2_email" name="person2_email" />
                                                    </div>
                                                    <!-- close row -->
                                                </div>

                                                <div class="row g-3 mb-3">
                                                    <label class="form-label fw-bold  fs-6">
                                                        Cell phones:
                                                        <br />
                                                        <span class="UX_note">At least one mobile phone is required to receive texts</span>
                                                    </label>
                                                    <div class="col-6 mt-0">
                                                        <label for="person1_cell" class="form-label  fs-6">
                                                            Person 1:
                                                        </label>
                                                        <input type="phone" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="person1_cell" name="person1_cell" />
                                                    </div>
                                                    <div class="col-6 mt-0">
                                                        <label for="person2_cell" class="form-label  fs-6">
                                                            Person 2:
                                                        </label>
                                                        <input type="phone" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark" id="person1_firstname" name="person2_cell" />
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <div class="mb-3">
                                                <!-- Dev Note: Package Choice is set by the staff, then locked "disabled" on the customer end-user side so it can't be changed. Enable for Staff Admin... disable for end-user customer -->
                                                <label for="package_choice" class="form-label fw-bold text-capitalize fs-5">
                                                    Package choice: &nbsp;
                                                </label>
                                                @foreach($packages as $package)
                                                <div class="form-check  form-check-inline">
                                                    <input name="package_choice" id="package_choice" class="form-check-input" type="radio" value="{{$package->id}}">
                                                    <label class="form-check-label" for="Package_1">
                                                        {{$package->name}}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>

                                            <fieldset class="fieldset">

                                                <div class="row g-3 mb-3">

                                                    <div class="col-4 mt-3">
                                                        <label for="checkin_date" class="form-label fw-bold text-capitalize fs-6">Check-in date</label>
                                                        <input type="date" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="checkin_date" name="checkin_date" />
                                                    </div>
                                                    <div class="col-4 mt-3">
                                                        <label for="wedding_date" class="form-label fw-bold text-capitalize fs-6">Wedding Date</label>
                                                        <input type="date" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="wedding_date" name="wedding_date" />
                                                    </div>
                                                    <div class="col-4 mt-3 ">
                                                        <label for="checkout_date" class="form-label fw-bold text-capitalize fs-6">Check-out date</label>
                                                        <input type="date" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="checkout_date" name="checkout_date" />
                                                    </div>
                                                    <div class="col-12 mb-0">
                                                        <label for="arrival_time_notes" class="form-label fw-bold text-capitalize fs-6">
                                                            Arrival time notes
                                                        </label>
                                                        <textarea class="form-control bg-secondary-subtle border-1" rows="4" id="arrival_time_notes" name="arrival_time_notes"></textarea>
                                                    </div>
                                                    <!--End time and date info -->
                                                </div>
                                            </fieldset>

                                            <fieldset class="fieldset">
                                                <div class="mt-3">
                                                    <label for="parent_names" class="form-label fw-bold text-capitalize fs-6">
                                                        Parents' Names
                                                    </label>
                                                    <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="parent_names" name="parent_names" />
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <label for="wedding_party_size" class="form-label fw-bold text-capitalize fs-6">
                                                            Wedding Party Size
                                                        </label>
                                                        <input type="number" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="wedding_party_size" name="wedding_party_size" />
                                                    </div>
                                                    <div class="col"">
                                                        <label for=" guest_headcount_adults" class="form-label fw-bold text-capitalize fs-6">
                                                        Guest Count: Adults
                                                        </label>
                                                        <input type="number" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="guest_headcount_adults" name="guest_headcount_adults" />
                                                    </div>
                                                    <div class="col">
                                                        <label for="guest_headcount_children" class="form-label fw-bold text-capitalize fs-6">
                                                            Children under 12yo
                                                        </label>
                                                        <input type="number" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="guest_headcount_children" name="guest_headcount_children" />
                                                    </div>
                                                    <!--end row -->
                                                </div>

                                                <div class="">
                                                    <label for="day_of_contact" class="form-label fw-bold  fs-6">
                                                        Wedding Day-of Contact Person
                                                        <br />
                                                        <span class="UX_note">If our manager has questions and cannot reach you, this person has your authority to make last-minute decisions!</span>
                                                    </label>
                                                    <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="day_of_contact" name="day_of_contact" />
                                                </div>

                                            </fieldset>
                                            <!-- new fields for Wedding Coordinator April 14, 2023 -->
                                            <fieldset class="fieldset">
                                                <input type="hidden" value="" name="wc_id">
                                                <div class="my-2">
                                                    <label for="wedding-coordinator" class="form-label fw-bold text-capitalize fs-6">
                                                        Wedding Coordinator's Name:
                                                    </label>
                                                    <span class="UX_note">Leave blank if you do not have one. Their contact info is optional.</span>
                                                    <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="wedding-coordinator" name="wedding_coordinator"  />

                                                    <div class="row mb-0">
                                                        <div class="col">
                                                            <label for="wedding-coordinator-email" class="form-label fw-bold text-capitalize fs-6">
                                                                Email:
                                                            </label>
                                                            <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="wedding-coordinator-email" name="wedding_coordinator_email"  />
                                                        </div>
                                                        <div class="col">
                                                            <label for="wedding-coordinator-phone" class="form-label fw-bold text-capitalize fs-6">
                                                                Mobile Phone:
                                                            </label>
                                                            <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="wedding-coordinator-phone" name="wedding_coordinator_phone"  />
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>

                                            <!-- new fields for vendors April 14, 2023-->
                                            <!-- new fields for vendors April 14, 2023-->
                                            <fieldset class="fieldset">
                                                <div id="vendor-form" class="my-2">
                                                    <h4>Add New Vendors</h4>
                                                    <input type="hidden" value=-1 name="vendor_id[]">
                                                    <label for="vendor-new" class="form-label fw-bold text-capitalize fs-6">
                                                        New Vendor: (Name and Description)
                                                    </label>
                                                    <span class="UX_note">Leave blank if you do not have any. Their contact info is optional.</span>
                                                    <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="vendor-name" name="new_vendor[]" />

                                                    <div class="row mb-0" name="vendor group 1">
                                                        <div class="col">
                                                            <label for="vendor-email" class="form-label fw-bold text-capitalize fs-6">
                                                                Email:
                                                            </label>
                                                            <input type="email" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="vendor-email" name="vendor_email[]" />
                                                        </div>
                                                        <div class="col">
                                                            <label for="vendor-phone" class="form-label fw-bold text-capitalize fs-6">
                                                                Mobile Phone:
                                                            </label>
                                                            <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="vendor-phone" name="vendor_phone[]" />
                                                        </div>
                                                    </div>
                                                    <div id="new-vendor"></div><!-- end the vendor group row -->
                                                </div>
                                                <button type="button" onclick="createVendorComponent(); incrementVendorCount()" id="addVendor" class="btn btn-secondary py-1">
                                                    <i class="fa-solid fa-square-plus me-1"></i> Add Another Vendor
                                                </button> <span class="UX_note"> Add up to 10</span>
                                            </fieldset>

                                            <fieldset class="fieldset">
                                                <div class="mt-3 mb-3">
                                                    <label for="first-look" class="form-label fw-bold text-capitalize fs-6">
                                                        First Look: &nbsp;
                                                    </label>
                                                    <div class="form-check  form-check-inline">
                                                        <input class="form-check-input" type="radio" name="first_look" id="first_look" value="0">
                                                        <label class="form-check-label" for="first_look_yes">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check  form-check-inline">
                                                        <input class="form-check-input" type="radio" name="first_look" id="first_look" value="1">
                                                        <label class="form-check-label" for="first_look_no">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="location" class="form-label fw-bold text-capitalize fs-6">
                                                        Ceremony location &nbsp;
                                                    </label>
                                                    @foreach($locations as $location)
                                                    <div class="form-check  form-check-inline">
                                                        <input class="form-check-input" type="radio" name="ceremony_location" value="{{$location->id}}" id="ceremony_wooded">
                                                        <label class="form-check-label" for="ceremony_wooded">
                                                            {{$location->name}}
                                                        </label>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <p class="UX_note">There is a large clearing between the Barn and Saltbox for a tent up to 40'x60'. Wedding Tents are not allowed on the ceremony lawn.</p>
                                                <!--End ceremony location-->

                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="ceremony_time" class="form-label fw-bold text-capitalize fs-6">Ceremony time</label>
                                                        <input type="time" name="ceremony_time" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="ceremony_time" />
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="ceremony_length" class="form-label fw-bold text-capitalize fs-6">Ceremony length</label>
                                                        <input name="ceremony_length" type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="ceremony_length" />
                                                    </div>
                                                    <!--end row -->
                                                </div>
                                                <div class="mb-3">
                                                    <label for="ceremony_notes" class="form-label fw-bold text-capitalize fs-6">Ceremony notes</label>
                                                    <textarea name="ceremony_notes" class="form-control bg-secondary-subtle border-1" id="ceremony_notes" rows="4"></textarea>
                                                </div>
                                            </fieldset>

                                            <fieldset class="fieldset">
                                                <div class="mb-3">
                                                    <label for="cocktail_reception_time" class="form-label fw-bold text-capitalize fs-6">Cocktail Reception: Time</label>
                                                    <input name="cocktail_reception_time" type="time" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="cocktail_reception_time" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="reception_notes" class="form-label fw-bold text-capitalize fs-6">Cocktail Reception: Notes</label>
                                                    <textarea name="reception_notes" class="form-control bg-secondary-subtle border-1" id="reception_notes" rows="4"></textarea>
                                                </div>
                                            </fieldset>

                                            <fieldset class="fieldset">
                                                <div class="mb-3">
                                                    <label for="grand_entrance" class="form-label fw-bold text-capitalize fs-6">
                                                        Grand Entrance
                                                    </label>
                                                    <div class="form-check  form-check-inline">
                                                        <input class="form-check-input" type="radio" name="grand_entrance" id="grand_entrance" value='0'>
                                                        <label class="form-check-label" for="grand_entrance">
                                                            Yes
                                                        </label>
                                                    </div>
                                                    <div class="form-check  form-check-inline">
                                                        <input class="form-check-input" type="radio" name="grand_entrance" id="grand_entrance" value='1'>
                                                        <label class="form-check-label" for="grand_entrance">
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="intro-speech-dance" class="form-label fw-bold text-capitalize fs-6">
                                                        Introductions, Speeches & Dances
                                                    </label>
                                                    <textarea class="form-control bg-secondary-subtle border-1" id="intro-speech-dance" name="intro_speech_dance" rows="4"></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="parent_child_dance" class="form-label fw-bold text-capitalize fs-6">
                                                        Parent/Child Dances
                                                    </label>
                                                    <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="parent_child_dance" name="parent_child_dance" />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="entertainments_notes" class="form-label fw-bold text-capitalize fs-6">DJ or Band - Entertainment notes
                                                    </label>
                                                    <textarea class="form-control bg-secondary-subtle border-1" rows="4" id="entertainment_notes" name="entertainment_notes"></textarea>
                                                </div>
                                            </fieldset>
                                            <!-- Button -->
                                            <div class="col-12 mt-lg-5 mt-3">
                                                <button type="submit" class="btn btn-primary text-capitalize">
                                                    Save Changes (Event Details)
                                                </button>
                                            </div>
                                            <p class="mt-2 UX_note">Saves all 3 tab's info</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end 1st tab -->

                            <!-- 2nd Tab layout -->
                            <div class="tab-pane py-lg-5 py-2" id="layout">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Layout & decor form -->

                                        <fieldset class="fieldset">
                                            <div class="mb-3">
                                                <label for="layout_notes" class="form-label fw-bold text-capitalize fs-6">Layout & Decor Notes</label>
                                                <textarea class="form-control bg-secondary-subtle border-1" id="layout_notes" name="layout_notes" rows="4"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="dance_floor_notes" class="form-label fw-bold text-capitalize fs-6">
                                                    Dance floor notes
                                                </label>
                                                <textarea class="form-control bg-secondary-subtle border-1" id="dance_floor_notes" name="dance_floor_notes" rows="4"></textarea>
                                            </div>
                                        </fieldset>
                                        <fieldset class="fieldset">
                                            <div class="mb-3">
                                                <label for="cake_display" class="form-label fw-bold text-capitalize fs-6">
                                                    Cake Display
                                                </label>
                                                <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="cake_display" name="cake_display" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="dessert_display" class="form-label fw-bold text-capitalize fs-6">
                                                    Dessert Display
                                                </label>
                                                <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="dessert_display" name="dessert_display" />
                                            </div>
                                        </fieldset>
                                        <fieldset class="fieldset">
                                            <div class="mb-3">
                                                <label for="linens_napkins" class="form-label fw-bold text-capitalize fs-6 d-block">
                                                    Linens (Cloth Napkins) Choice: &nbsp;
                                                </label>
                                                @foreach($linens as $linen)
                                                <div class="form-check  form-check-inline">
                                                    <input class="form-check-input" type="radio" name="linens_napkins" id="linens_napkins" value="{{$linen->id}}">
                                                    <label class="form-check-label" for="grand_entrance_yes">
                                                        {{$linen->color}}
                                                    </label>
                                                </div>
                                                @endforeach
                                                <!--End napkins -->
                                            </div>
                                            <div class="mb-3">
                                                <label for="chargers" class="form-label fw-bold text-capitalize fs-6">
                                                    Place-setting Chargers? <span class="UX_note">We have gold chargers you can use</span>
                                                </label>
                                                <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="chargers" name="chargers" />
                                            </div>
                                            <div class="mb-3">
                                                <i class="fa-solid fa-chair"></i>
                                                <label for="table_layout_couple" class="form-label fw-bold text-capitalize fs-6">
                                                    Table Layout - Couple and wedding party:
                                                </label>
                                                <br />
                                                @foreach($layouts as $layout)
                                                @if($layout->type == "Couple")
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="table_layout_couple" value="{{$layout->id}}" id="table_layout_couple">
                                                    <label class="form-check-label" for="table_layout_sweetheart">
                                                        {{$layout->layout}}
                                                    </label>
                                                </div>
                                                @endif
                                                @endforeach
                                                <!--End couple tables -->
                                            </div>

                                            <div class="mb-3">
                                                <label for="table_layout_guests" class="form-label fw-bold text-capitalize fs-6 d-block">
                                                    Table Layout - Guests: &nbsp;
                                                </label>
                                                @foreach($layouts as $layout)
                                                @if($layout->type == "Guest")
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="table_layout_guests" value="{{$layout->id}}" id="table_layout_guests">
                                                    <label class="form-check-label" for="table_layout_sweetheart">
                                                        {{$layout->layout}}
                                                    </label>
                                                </div>
                                                @endif
                                                @endforeach
                                                <!--End guest table layouts-->
                                            </div>

                                            <div class="mb-3">
                                                <label for="table_layout_notes" class="form-label fw-bold text-capitalize fs-6">
                                                    Table layout - Overall Notes
                                                </label>
                                                <textarea class="form-control bg-secondary-subtle border-1" id="table_layout_notes" name="table_layout_notes" rows="3"></textarea>
                                            </div>
                                            <p class="UX_note">
                                                All of these options will be discussed during your onsite visits.
                                            </p>
                                        </fieldset>

                                        <fieldset class="fieldset">
                                            <div class="mb-3">
                                                <label for="lawn_games" class="form-label fw-bold text-capitalize fs-6">Lawn Games Notes</label>
                                                <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="lawn_games" name="lawn_games" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="patio_fire_rings" class="form-label fw-bold text-capitalize fs-6">Patio Fire Notes</label>
                                                <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="patio_fire_rings" name="patio_fire_rings" />
                                            </div>
                                        </fieldset>
                                        <!-- Button -->
                                        <div class="col-12 mt-lg-5 mt-3">
                                            <button type="submit" class="btn btn-primary text-capitalize">
                                                Save Changes (Layout & Decor)
                                            </button>
                                            <p class="mt-2 UX_note">Saves all 3 tab's info</p>
                                        </div>
                                        <!-- end 2nd tab form -->
                                    </div>
                                </div>
                                <!-- end 2nd Tab -->
                            </div>

                            <!-- 3rd Tab Food and Drink -->
                            <div class="tab-pane py-lg-5 py-2" id="foodDrink">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Food & drink form -->

                                        <fieldset class="fieldset">
                                            <div class="mb-3">
                                                <i class="fa-solid fa-glass-martini-alt"></i>
                                                <label for="bar_plan" class="form-label fw-bold text-capitalize fs-6">
                                                    Bar Plan Notes
                                                </label>
                                                <textarea class="form-control bg-secondary-subtle border-1" id="bar_plan" name="bar_plan" rows="3"></textarea>
                                                <p class="UX_note d-none">
                                                    Options include: cash & credit only (guests purchases their own); limited prepaid open tab; full prepaid open bar tab; drink tokens; and combinations of any of these!
                                                </p>
                                            </div>
                                            <div class="mb-3">
                                                <label for="bar_service_pause" class="form-label fw-bold  fs-6">
                                                    Bar Service - Pauses? <span class="UX_note">Pause service during key moments</span>
                                                </label>
                                                <input type="text" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="bar_service_pause" name="bar_service_pause" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="bar-signature-cocktails" class="form-label fw-bold text-capitalize fs-6">
                                                    Signature cocktails <span class="UX_note">Optional</span>
                                                </label>
                                                <textarea class="form-control bg-secondary-subtle border-1" id="bar-signature-cocktails" name="signature_cocktails" rows="2"></textarea>
                                            </div>
                                        </fieldset>
                                        <fieldset class="fieldset">

                                            <div class="mb-3">
                                                <i class="fa-solid fa-utensils"></i>
                                                <label for="service" class="form-label fw-bold text-capitalize fs-6  ">
                                                    Dinner (Or Main Meal) Service style
                                                </label>
                                                <br />
                                                @foreach($styles as $style)
                                                <div class="form-check  form-check-inline">
                                                    <input class="form-check-input" type="radio" name="dinner_service_style" value="{{$style->id}}" id="service-{{$style->style}}">
                                                    <label class="form-check-label" for="service={{$style->style}}">
                                                        {{$style->style}}
                                                    </label>
                                                </div>
                                                @endforeach
                                                <p class="UX_note">For guidelines on using an outside catering vendor, see <a href="https://barnlightsweddingevents.com/catering-service/" target="_blank">our website</a>.</p>
                                                <!-- DEV: this would need to be a variable set in the Client Admin setting page. or else we need to hardcode the URLs for our clients  -->
                                                <!--End catering plan choices-->
                                            </div>

                                            <div class="mb-3">
                                                <label for="dinner-service-time" class="form-label fw-bold text-capitalize fs-6">Dinner/Meal Service Time</label>
                                                <input type="time" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="dinner-service-time" name="dinner_service_time" />
                                            </div>

                                            <div class="mb-3">
                                                <label for="breakfast" class="form-label fw-bold text-capitalize fs-6">
                                                    Day of breakfast or brunch?
                                                </label>
                                                <textarea class="form-control bg-secondary-subtle border-1" id="breakfast" name="breakfast" rows="2"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="late-night" class="form-label fw-bold text-capitalize fs-6">
                                                    Late Night Snack?
                                                </label>
                                                <textarea class="form-control bg-secondary-subtle border-1" id="late-night" name="late_night_snack" rows="2"></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="farewell-brunch" class="form-label fw-bold text-capitalize fs-6">
                                                    Farewell Brunch? <span class="UX_note">Usually on check-out day</span>
                                                </label>
                                                <textarea class="form-control bg-secondary-subtle border-1" id="farewell-brunch" name="farewell_brunch" rows="2"></textarea>
                                            </div>
                                        </fieldset>

                                        <fieldset class="fieldset">
                                            <div class="mb-3">
                                                <i class="fa-solid fa-utensils"></i>
                                                <label for="rehearsal-dinner" class="form-label fw-bold text-capitalize fs-6">
                                                    Rehearsal Dinner in Barn ?
                                                </label>
                                                <div class="form-check  form-check-inline">
                                                    <input class="form-check-input" type="radio" id="rehearsal_dinner_bar_yes" name="rehearsal_barn" value="1">
                                                    <label class="form-check-label" for="rehearsal_dinner_bar_yes">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check  form-check-inline">
                                                    <input class="form-check-input" type="radio" id="rehearsal_dinner_bar_no" name="rehearsal_barn" value="0">
                                                    <label class="form-check-label" for="rehearsal_dinner_bar_no">
                                                        No
                                                    </label>
                                                </div>
                                                <p class="UX_note">The barn is available the night before for your rehearsal dinner with Packages 2-R & 3. For Package 1 or 2, please inquire.</p>


                                            </div>

                                            <div class="row">
                                                <div class="col mb-3">
                                                    <label for="rehearsal_dinner_date" class="form-label fw-bold text-capitalize fs-6">
                                                        Rehearsal Dinner Date
                                                    </label>
                                                    <input type="date" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="rehearsal_dinner_date" name="rehearsal_date" />
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="rehearsal-dinner-guest-count" class="form-label fw-bold text-capitalize fs-6">
                                                        Rehearsal Dinner: Guest count
                                                    </label>
                                                    <input type="number" class="form-control bg-secondary-subtle border-1 py-2 fs-6 text-dark mb-3" id="rehearsal_dinner_guest_count" name="rehearsal_guests" />
                                                </div>
                                                <!--end row -->
                                            </div>
                                            <div class="mb-3">
                                                <label for="rehearsal_dinner-bartender" class="form-label fw-bold text-capitalize fs-6">
                                                    Rehearsal Dinner: Bartender needed: &nbsp;
                                                </label>
                                                <div class="form-check  form-check-inline">
                                                    <input class="form-check-input" type="radio" id="rehearsal_dinner_bar_yes" name="rehearsal_bar" value="1">
                                                    <label class="form-check-label" for="rehearsal_dinner_bar_yes">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check  form-check-inline">
                                                    <input class="form-check-input" type="radio" id="rehearsal_dinner_bar_no" name="rehearsal_bar" value="0">
                                                    <label class="form-check-label" for="rehearsal_dinner_bar_no">
                                                        No
                                                    </label>
                                                </div>
                                                <p class="UX_note">Our bartender is required if alcohol is served</p>
                                                <!--end row -->
                                            </div>

                                            <div class="mb-3">
                                                <label for="rehearsal-dinner-bar-notes" class="form-label fw-bold text-capitalize fs-6">
                                                    Rehearsal Dinner and Bar Notes
                                                </label>
                                                <textarea class="form-control bg-secondary-subtle border-1" id="rehearsal-dinner-bar-notes" name="rehearsal_dinner_notes" rows="4"></textarea>
                                            </div>
                                        </fieldset>
                                        <fieldset class="fieldset">
                                            <div class="mb-3">
                                                <label for="severe-allergies" class="form-label fw-bold text-capitalize fs-6">
                                                    Severe Allergies (Couple or Guests): &nbsp;
                                                </label>
                                                <div class="form-check  form-check-inline">
                                                    <input class="form-check-input" type="radio" id="severe-allergies-yes" name="severe_allergies" value="1">
                                                    <label class="form-check-label" for="severe-allergies-yes">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check  form-check-inline">
                                                    <input class="form-check-input" type="radio" id="severe-allergies-no" name="severe_allergies" value="0">
                                                    <label class="form-check-label" for="severe-allergies-no">
                                                        No
                                                    </label>
                                                </div>
                                                <p class="UX_note">If anyone has life-threatening allergies we require that those meals be prepared in certified facilities by external provider, for their safety. Our kitchen is not certified 100% allergen-free. </p>
                                                <!--end row -->
                                            </div>

                                            <div class="mb-3">
                                                <label for="severe-allergies-notes" class="form-label fw-bold text-capitalize fs-6">
                                                    Severe Allergies Notes
                                                </label>
                                                <textarea class="form-control bg-secondary-subtle border-1" id="severe-allergies-notes" name="severe_allergy_notes" rows="4"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="special-dietary-needs" class="form-label fw-bold text-capitalize fs-6">Special Dietary Needs:</label>
                                                <textarea class="form-control bg-secondary-subtle border-1" id="special-dietary-needs" name="special_diet_needs" rows="4"></textarea>
                                            </div>
                                        </fieldset>
                                        <!-- Button -->
                                        <div class="col-12 mt-lg-5 mt-3">
                                            <button type="submit" class="btn btn-primary">
                                                Save Changes (Food & Drink)
                                            </button>
                                        </div>
                                        <p class="mt-2 UX_note">Saves all 3 tab's info</p>

                                        <!-- end form-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>