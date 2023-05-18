<script>
    function addAdmin() {
        let element = document.getElementById("createAdmin");
        element.style.display = 'block';
        element.scrollIntoView('true');
    }

    function deleteToggle(checkBox, id) {
        let button = document.getElementById("staffSave-" + id);
        if (checkBox.checked) {
            button.innerHTML = "Delete Staff";
            button.classList.add("btn-danger");
            // button.style.backgroundColor="red";
            // button.style.backgroundColor="red";
            // button.style.borderColor="red";
        }
        // alert(checkBox.checked)
        else {
            button.innerHTML = "Save changes";
            button.classList.remove("btn-danger");
        }
    }

    function enableEdit(id) {
        let section = document.getElementById("staff-" + id);
        let enableSection = document.getElementById("edit-permissions-" + id);
        section.disabled = section.disabled == true ? false : true;
        enableSection.style.display = section.disabled ? "none" : "block";
    }
</script>

<x-app-layout>
    <header class="container bg-white border-5 border-bottom border-dark-subtle">
        <div class="row py-4">
            <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto text-center">
                <div class="main-logo account-page">
                    <img class="img-fluid" src="/images/upload-images/{{$venue->logo}}" alt="Your customer logo" />
                </div>
                <div class="brand-title">
                    <h2 class="text-capitalize mb-lg-0 fs-4">
                        Welcome to <span class="fw-bold">Event Organizer Pro</span>
                    </h2>
                </div>
            </div>
        </div>
    </header>
    <!-- Main area starts -->
    <main>
        <!-- Subscription display -->
        <section class="container py-lg-5 py-3">
            <div class="row">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                    <div class="heading-area">
                        <h3>Your Account Manager</h3>
                        <p>
                            You can add and remove staff admins, and manage your subscription and billing information here. Please <a href="/support">contact us</a> if you have questions.
                        </p>
                    </div>

                    <fieldset class="fieldset">
                        <h5>
                            Your subscription plan:
                        </h5>
                        @if($venue->timeline_organizer)
                        <p>
                            <i class="fa-solid fa-check-circle me-2"></i>
                            Timeline Manager. <span class="UX_note ms-2">Monthly Unlimited Clients ${{$venue->plan_price}}/mo</span>
                        </p>
                        @endif
                        @if($venue->menu_designer)
                        <p>
                            <i class="fa-solid fa-check-circle me-2"></i>
                            Menu Quoting. <span class="UX_note ms-2">Monthly Clients ${{$venue->menu_plan_price}}/mo</span>
                        </p>
                        @endif
                    </fieldset>
                    <p class="text-secondary">
                        To upgrade, remove a module, or cancel your account, please <a href="/support">contact us</a>. Billing is monthly and cancellations take effect at the end of the month.
                    </p>
                </div>
            </div>
        </section>

        <!-- View and Add admins -->
        <section class="container mt-4 ">
            <!-- Hr line -->
            <div class="row pb-3">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                </div>
            </div>
            <div class="row">
                <div class="heading-area col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                    <h3 class="text-capitalize fs-2">
                        User Management
                    </h3>
                    <p>
                        This section shows your primary account owner and any staff admins who can interact with your clients, lock event forms, add new clients, and archive completed ones.
                    </p>
                    <fieldset class="fieldset" {{!Auth::user()->primary_user ? "disabled" : ''}}>
                        <form method="POST" action="{{ route('user.update',$primaryUser->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <i class="fa-solid fa-user-circle"></i>
                                <label for="staff-name" class="form-label fw-bold text-capitalize fs-6 fc-red">
                                    Staff Name <span class="text-primary">(Primary)</span>
                                </label>
                                <input type="text" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="name" value="{{ old('name', $primaryUser->name ?? '') }}" id="staff-name" placeholder="Staff member's name" />
                            </div>
                            <div class="mb-3">
                                <label for="staff-email" class="form-label fw-bold text-capitalize fs-6">
                                    Company Email
                                </label>
                                <input type="email" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="email" value="{{ old('email', $primaryUser->email ?? '') }}" id="staff-email" placeholder="email@example.com" />
                            </div>

                            <div class="mb-3">
                                <label for="staff-phone" class="form-label fw-bold text-capitalize fs-6">
                                    Cell Phone
                                </label>
                                <input type="tel" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="cell" value="{{ old('cell', $primaryUser->cell ?? '') }}" id="staff-phone" placeholder="Include area code" />
                            </div>
                            @if($primaryUser->id == Auth::user()->id)
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold text-capitalize fs-6">
                                    Change Password
                                </label>
                                <input type="password" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="password" id="password" placeholder="Password" />
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label fw-bold text-capitalize fs-6">
                                    Confirm New Password
                                </label>
                                <input type="password" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" />
                            </div>
                            @endif

                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-primary">
                                    Save changes
                                </button>
                                <!-- or use this button if no field was edited yet 
					<button type="submit" class="btn btn-primary disabled">
					No unsaved changes
					</button>
					-->
                            </div>
                        </form>
                        <p class="UX_note pt-3 ">
                            Note: This contact cannot be deleted, as it is the primary account holder. This contact info is shown to your clients in their Portal.
                        </p>
                    </fieldset>
                    <div class="add-btn text-end">
                        <!-- Add Admin btn -->
                        <button type="submit" onclick="addAdmin(); this.disabled=true" id="addAdmin" class="btn btn-secondary py-1">
                            <i class="fa-solid fa-square-plus me-2"></i>
                            Add new Staff Admin
                        </button>
                        <!-- auto-scroll to the new form which appeared below via JS -->
                    </div>
                    <!-- Add/Edit new admin form -->
                    @foreach($allUsers as $index => $user)
                    <fieldset class="fieldset" id="staff-{{$user->id}}" disabled>
                        <form method="POST" action="{{ route('user.update',$user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <i class="fa-solid fa-user-circle"></i>
                                <label for="staff-name-{{$user->id}}" class="form-label fw-bold text-capitalize fs-6">
                                    Staff Name {{$index + 2}}
                                </label>

                                <input type="text" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="name" value="{{ old('name', $user->name ?? '') }}" id="staff-name-{{$user->id}}" />
                            </div>
                            <div class="mb-3">
                                <label for="staff-email-{{$user->id}}" class="form-label fw-bold text-capitalize fs-6">
                                    Company Email
                                </label>
                                <input type="email" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="email" value="{{ old('email', $user->email ?? '') }}" id="staff-email-{{$user->id}}" />
                            </div>
                            <div class="mb-3">
                                <label for="staff-cell-{{$user->id}}" class="form-label fw-bold text-capitalize fs-6">
                                    Cell Phone
                                </label>
                                <input type="tel" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="cell" value="{{ old('cell', $user->cell ?? '') }}" id="staff-cell-{{$user->id}}" />
                            </div>
                            <div id="edit-permissions-{{$user->id}}" class="edit-permissions">
                                @if(Auth::user()->id == $user->id)
                                <div class="mb-3">
                                    <label for="staff-password-{{$user->id}}" class="form-label fw-bold text-capitalize fs-6">
                                        Change Password
                                    </label>
                                    <input type="password" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="password" id="staff-password-{{$user->id}}" placeholder="Password" />
                                </div>
                                <div class="mb-3">
                                    <label for="staff-confirmation-{{$user->id}}" class="form-label fw-bold text-capitalize fs-6">
                                        Confirm New Password
                                    </label>
                                    <input type="password" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="password_confirmation" id="staff-confirmation-{{$user->id}}" placeholder="Confirm Password" />
                                </div>
                                @endif
                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-primary staffSave" id="staffSave-{{$user->id}}">
                                        Save changes
                                    </button>

                                    <!-- or use this button if no field was edited yet 
                                <button type="submit" class="btn btn-primary disabled">
                                No unsaved changes
                                </button>
                                -->
                                </div>
                                <div class="form-check my-2">
                                    @if(Auth::user()->primary_user)
                                    <input onclick="deleteToggle(this, '{{$user->id}}')" class="form-check-input border-dark" type="checkbox" id="disable_staff" value="1" name="verify" />
                                    <label class="form-check-label fs-6" for="disable_customer">
                                        Check this box then delete this staff admin
                                    </label>
                                    @endif
                                </div>
                            </div>
                            @if(Auth::user()->primary_user || Auth::user()->id == $user->id)
                            <i onclick="enableEdit('{{$user->id}}')" id="staffEdit-{{$user->id}}" class="fa-solid fa-user-edit edit-user-btn text-primary-emphasis"></i>
                            @endif
                        </form>
                    </fieldset>
                    @endforeach
                    <div id="createAdmin">
                        <fieldset class="fieldset">
                            <form method="POST" action="{{ route('user.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <i class="fa-solid fa-user-circle"></i>
                                    <label for="exampleFormControlInput1" class="form-label fw-bold text-capitalize fs-6">
                                        Staff Name
                                    </label>
                                    <input type="text" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" id="exampleFormControlInput1" name="name" placeholder="Staff member's name" />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label fw-bold text-capitalize fs-6">
                                        Company Email
                                    </label>
                                    <input type="email" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="email" id="exampleFormControlInput1" placeholder="email@example.com" />
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label fw-bold text-capitalize fs-6">
                                        Cell Phone
                                    </label>
                                    <input type="tel" class="form-control bg-secondary-subtle border-0 py-3 fs-6 text-dark" name="cell" id="exampleFormControlInput1" placeholder="Include area code" />
                                </div>

                                <div class="col-12 mt-2">
                                    <button type="submit" class="btn btn-primary">
                                        Save changes
                                    </button>

                                    <!-- or use this button if no field was edited yet 
					<button type="submit" class="btn btn-primary disabled">
					No unsaved changes
					</button>
					-->
                                </div>
                            </form>
                        </fieldset>
                    </div>
                    <p class="UX_note"> The <strong>Primary admin</strong> can edit their own and any staff member's details. Staff-level Admins can edit only their own Name/Email/Cellphone.
</x-app-layout>