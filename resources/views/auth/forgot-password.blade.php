<x-guest-layout>
    <header class="container header-area bg-white py-5">
        <div class="row">
            <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto text-center">
                <!-- <div class="header-logo pb-4">
                    <img class="img-fluid" src="assets/images/client_logo_example.png" alt="Barn Lights" />
                </div> -->
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
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto admin-font">
                    <h3 class="fw-bold">Password Reset Form</h3>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email-input-field" class="form-label">
                                Enter your <strong>email</strong> to receive a password-reset link. You will be able to create a new password and sign in with it.
                            </label>
                            <x-input id="email" class="form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" type="email" name="email" :value="old('email')" required autofocus />
                            <!-- <input type="email" class="form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" id="email" :value="old('email')" required autofocus /> -->
                        </div>

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary mb-3 fs-5 text-capitalize">
                                Send Reset Now
                            </button>

                            <!-- future: we should use a Cloudflare Turnstiles free captcha to deter bots. -->

                            <!-- @include('layouts.flash-message') -->
                            <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <h4>Your reset link has been sent.</h4>
                                <p>If the email you entered does not exist in our system, nothing will be sent.
                                </p>
                            </div> -->
                            <!-- if you want to use this alert, it needs a JS plugin from https://getbootstrap.com/docs/5.0/components/alerts/  -->

                            <!-- Note: this email will just say "Hello! You have successfully changed your Password at <strong>Event Organizer Pro</strong>. If this was not you please contact <a>Support</a> immediately."  -->


                            <p class="UX_note">
                                If you do not receive an email from us within 1-10 minutes, please check your Spam folder (and consider adding our email to your contacts). </p>
                            <p class="UX_note">If you need additional help, please <a href="/support">contact Event Organizer Pro Support</a>.
                            </p>
                            <p class="UX_note"><a href="/login">Return to the Login Screen.</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <!-- Customer Footer starts (not signed in) -->
</x-guest-layout>