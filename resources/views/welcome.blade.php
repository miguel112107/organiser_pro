<x-guest-layout>
    <header class="container header-area bg-white py-5">
        <div class="row">
            <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto text-center">
                <div class="header-logo pb-4">
                    <img src="/images/event-calander.png" alt="Event Calander" />
                </div>
                <div class="welcome-notes">
                    <h2>Welcome to</h2>
                    <h1 class="fw-bold">Event Organizer Pro</h1>
                    <h3 class="px-1 mt-3">
                        The leading wedding and event management software
                    </h3>
                </div>
            </div>
        </div>
    </header>
    <main>
        <!-- Timeline Organizer -->
        <section class="container py-3">
            <div class="row">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                    <h3 class="text-capitalize fw-bold">Timeline Organizer</h3>
                    <p class="lg:py-2">
                        We enable venues, hotels, and event planners to empower their clients to organize their own timeline and all of the important details, including setup times, guest details, special notes, allergies, bar and food plans, and more.
                    </p>
                    <img class="img-fluid" src="/images/image-O38Id_cyV4M.jpg" alt="Image of special event by Lanty" />
                </div>
            </div>
        </section>
        <!-- Menu Builder -->
        <section class="container py-3">
            <div class="row">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                    <h3 class="text-capitalize fw-bold">
                        Menu Builder
                    </h3>
                    <p class="py-2">
                        This powerful catering planner enables caterers to empower their clients to design and budget their own event menu, with easy menu building and costing, right in their browser!
                    </p>
                    <img class="img-fluid" src="/images/image-y1XXWct5rBo.jpg" alt="Image of food by  yvonnemorgun" />
                </div>
            </div>
        </section>
        <!-- Contact us -->
        <section class="container py-3">
            <div class="row">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                    <h3 class="text-capitalize fw-bold">Contact us</h3>
                    <p>
                        Call or text us at:
                        <a class="text-dark text-decoration-none" href="tel:(207) xxx-xxyy">
                            (207) xxx-xxyy</a>
                    </p>
                    <p>
                        Or contact us by using our secure webform:
                    </p>

                    <form method="Post" action="/contact">
                        @csrf
                        <div class="mb-3">
                            <label for="name-input-field" class="form-label">
                                Your Name
                            </label>
                            <input name="name" type="text" class="form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" id="name-input-field" />
                        </div>
                        <div class="mb-3">
                            <label for="email-input-field" class="form-label">
                                Your Email
                            </label>
                            <input name="email" type="email" class="form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" id="email-input-field" />
                        </div>
                        <div class="mb-3">
                            <label for="form-message" class="form-label">
                                Your Message
                            </label>
                            <textarea name="message" class="form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" id="form-message" rows="5"></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary text-capitalize">
                                Send to us
                            </button>
                        </div>
                    </form>
                    <p class="UX_note">
                        You will receive a copy of this form by email. We will reply within 24 hours. If you need immediate relief from the burdens of client management, please call!
                    </p>
                    <p class="mt-3">
                        We look forward to speaking with you and helping your business lower its administrative costs and increase client satisfaction!
                    </p>
                </div>
            </div>
        </section>
    </main>
    </div>
    </x-simple-layout>