<x-guest-layout>
    <x-auth-session-status class="" :status="session('status')" />
    <!-- Header starts -->
    <header class="container header-area bg-white py-5">
        <div class="row">
            <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto text-center">
                <div class="header-logo pb-4">
                    <img class="img-fluid" src="images/event_organizer_pro_logo.png" alt="Barn Lights" />
                </div>
                <div class="welcome-notes">
                    <h2>Welcome to</h2>
                    <h1 class="fw-bold">Event Organizer Pro</h1>
                </div>
            </div>
        </div>
    </header>
    <!-- Main area starts -->
    <main>
        <!-- Sign In -->
        <section class="container login pt-3">
            <div class="row">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                    <h3 class="fw-bold cursive-font">Please Sign in…</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Sign in with your email</label>
                            <x-input id="email" class="form-control py-3" type="email" name="email" :value="old('email')" required autofocus />
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Password</label>
                            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary fs-5 text-capitalize">
                                Enter
                            </button>
                            <p class="mt-4">
                                <small>Authorized users only. All IPs recorded.</small>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</x-guest-layout>