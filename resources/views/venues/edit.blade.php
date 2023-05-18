<script>
    function copyText() {

        /* Copy text into clipboard */
        navigator.clipboard.writeText("https://eventorganizer.pro/{{$venue->url_handle}}/");
    }
</script>
<x-app-layout>
    <header class="container bg-white border-5 border-bottom border-secondary-subtle">
        <div class="row py-4">
            <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto d-flex align-items-center gap-lg-4 gap-3">
                <div class="event-logo">
                    <img class="img-fluid" src="/images/event-calander.png" alt="Event Calander" />
                </div>
                <div class="brand-title">
                    <h2 class="fw-bold text-capitalize mb-lg-0">Event Organizer Pro</h2>
                    <h3 class="text-capitalize mb-lg-0">Admin manager</h3>
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- Breadcrumb -->
        <div class="container">
            <div class="row">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto py-4">
                    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="fs-6 text-dark fw-bold" href="/admin/index">All Customers</a>
                            </li>
                            <li class="breadcrumb-item active fs-6 text-dark fw-bold " aria-current="page">
                                Barn Lights Events and Weddings, LLC
                                <!-- truncate dynamically to be responsive to viewport no wrapping to 2nd line -->
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Customer Editor form -->
        @if ($errors->any())
        <div class="alert alert-danger" id="alert" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('venue.update',$venue->id) }}" method="Post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <section class="container">
                <!-- Customer editor -->
                <div class="row mt-8 mb-4 py-4">
                    <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                        <div class="heading-area admin-font">
                            <h3 class="text-capitalize">Customer editor
                                <!-- Change H3 if this is a new record -->
                            </h3>
                        </div>
                        <div class="mb-3">
                            <label for="company_name" class="form-label fw-bold text-capitalize fs-6">
                                Company Name
                            </label>
                            <input type="text" class="@error('name') is-invalid @enderror form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" id="company_name" placeholder="Company name" name="name" value="{{ old('name', $venue->name ?? '') }}" />
                        </div>
                        <div class="mb-3 w-50">
                            <label for="url_handle" class="form-label fw-bold text-capitalize fs-6">
                                Handle for the Custom URL Path
                            </label>
                            <p class="UX_note">
                                Verify: https://eventorganizer.pro/{{$venue->url_handle}}/ &nbsp; <i onclick="copyText()" class="copy-url fa-regular fa-copy fs-6"></i><!-- enable copy/paste button only when form is saved -->
                            </p>
                            <input type="text" class="form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" id="url_handle" name="url_handle" placeholder="" value="{{ old('url_handle', $venue->url_handle ?? '') }}" />
                            <p class="UX_note">
                                25 chars max.
                            </p>
                        </div>

                        <!-- primary staff admin -->
                        <fieldset class="fieldset">
                            <div class="mb-3">
                                <i class="fa-solid fa-user-circle"></i>
                                <label for="owner" class="form-label fw-bold text-capitalize fs-6">
                                    Company's Primary Admin contact
                                </label>
                                <input type="text" class="@error('owner_name') is-invalid @enderror form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" id="owner" name="owner_name" placeholder="First & Last" value="{{ $owner->name ?? ''}}" />
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label fw-bold text-capitalize fs-6 ">
                                    Company Phone
                                </label>
                                <input type="tel" class="@error('phone') is-invalid @enderror form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" id="phone" name="phone" placeholder="Ideally a mobile phone" value="{{ old('phone', $venue->phone ?? '') }}" />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold text-capitalize fs-6">
                                    Contact's Email
                                </label>
                                <input type="email" class="@error('email') is-invalid @enderror form-control bg-secondary-subtle border-1 py-3 fs-6 text-dark" id="email" name="email" placeholder="" value="{{ old('email', $venue->email ?? '') }}" />
                            </div>
                        </fieldset>

                        <div class="mb-3">
                            <fieldset class="fieldset">
                                <label for="company_logo_file" class="form-label fw-bold text-capitalize fs-6">
                                    Company Logo
                                </label>
                                <!-- Show logo image if uploaded already -->
                                <div class="input-group mb-3">
                                    <div class="company-photo">
                                        <img src="/images/upload-images/{{ old('logo', $venue->logo ?? '') }}" alt="Client Logo" class="company-logo" width="200" height="100">
                                    </div>
                                    <input type="file" value="test" class="form-control d-inline-block file-hide border-0 p-0 rounded-3 w-25" name="image" id="company_logo_file" />

                                    <label id="browse" class="input-group-text ms-3 mb-2 mt-2 bg-secondary rounded-3 text-white fw-bold px-3" for="company_logo_file">
                                        Browse for Photo
                                    </label>
                                </div>
                                <p class="UX_note">
                                    Accepts JPG, PNG, or SVG. Resized to 300px W x *H
                                </p>
                            </fieldset>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            @include('components.subscriptions')
        </form>
        <!-- end row -->
        @include('components.password-reset')
        @include('components.disable-customer')
    </main>
    <script>
        let input = document.getElementById("company_logo_file");
        let imageName = document.getElementById("browse")

        input.addEventListener("change", () => {
            let inputImage = document.querySelector("input[type=file]").files[0];

            imageName.innerText = inputImage.name;
        })
    </script>
</x-app-layout>