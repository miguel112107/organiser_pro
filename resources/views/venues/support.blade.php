<x-app-layout>
    <header class="container bg-white border-5 border-bottom border-dark-subtle">
        <div class="row py-4">
            <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto text-center">
                <div class="main-logo">
                    <img class="img-fluid" src="/images/upload-images/{{$venue->logo}}" alt="Your customer logo" />
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
        <!-- Client list -->
        <section class="container py-lg-5 py-3">
            <div class="row">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                    <div class="heading-area">
                        <h3>Support</h3>
                        <p> You're at the right place for support. We want to help you be successful with our software.&nbsp;</p>
                        <p>Hours of operation are 9am–6pm Eastern. </p>
                    </div>
                    <fieldset class="fieldset">
                        <h4>Billing</h4>
                        <p>Your subscription's billing cycle is monthly/annual.</p>
                        <p><a href="mailto:eventorganizerpro@gmail.com">Email Us</a> or text us for text support. (207) xxx-yyyy </p>
                    </fieldset>
                    <fieldset class="fieldset">
                        <h4>Tech support</h4>
                        <p><a href="mailto:eventorganizerpro@gmail.com">Email Us</a> or text us for text support at: (207) xxx-yyyy. </p>
                    </fieldset>
                    <fieldset class="fieldset">
                        <h4>Upgrades</h4>
                        <p><a href="mailto:eventorganizerpro@gmail.com">Email Us</a> or call (207) xxx-yyyy if you would like to add a new module.</p>
                    </fieldset>
                    <p>Return to your <a href="/{{$url_handle}}/index">Client Portal home</a>.</p>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>