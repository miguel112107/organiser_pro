<x-guest-layout>
    <header class="container header-area bg-white py-5">
        <div class="row">
            <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto text-center">
                <div class="welcome-notes">
                    <h2>Welcome to</h2>
                    <h1 class="fw-bold">
                        <img src="/images/event-calander.png" alt="Event Organizer Pro Logo" class="img-fluid" />
                        Event Organizer Pro</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- Main area starts -->
    <main>
        <!-- Sign In -->
        <section class="container customer-login pt-3">
            <div class="row">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                    <h3 class="fw-bold">Password Change Form</h3>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <div class="mb-3">
                            <p>You have confirmed your email request. You can now set a new Password. It must have a <strong>minimum length of any 12 characters</strong>.
                            </p>
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <label for="new-password-input-field" class="form-label">
                                Email:
                            </label>

                            <x-input id="email" class="form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="new-password-input-field" class="form-label">
                                New Password:
                            </label>

                            <x-input id="password" class="form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" type="password" name="password" required />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="new-password-input-field" class="form-label">
                                Repeat New Password:
                            </label>

                            <x-input id="password_confirmation" class="form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" type="password" name="password_confirmation" required />
                        </div>


                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary mb-3 fs-5 text-capitalize">
                                Save New Password
                            </button>

                            <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <h4>New Password saved successfully!</h4>
                                <p>Now you can <a href="customer-login.html">return to the Login Screen</a>. A confirmation email will be sent to you for your records.
                                </p>
                            </div> -->
                            <!-- Note: this email will just say "Hello! You have successfully changed your Password at <strong>Event Organizer Pro</strong>. If this was not you please contact <a>Support</a> immediately."  -->

                            <p class="UX_note">If you need additional help, please <a href="/support">contact Event Organizer Pro Support</a>.
                            </p>

                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</x-guest-layout>