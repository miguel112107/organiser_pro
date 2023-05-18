<x-app-layout>
    <header class="container bg-white border-5 border-bottom border-dark-subtle">
        <div class="row py-4">
            <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto text-center">
                <div class="main-logo">
                    <img class="img-fluid" src="/images/upload-images/{{$customer->logo}}" alt="Your customer logo" />
                </div>
                <div class="brand-title">
                    <h2 class="text-capitalize mb-lg-0 fs-4">
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
                        <h3>{{$archive ? "Your Client Archives" : "Home: Your Client List"}}</h3>
                        <p>
                            Invite your event clients to enter their timeline and notes here in their personalized Event Organizer.
                        </p>

                        <div class="d-flex justify-content-between align-items-center">
                            <p>
                                These are your <span class="fs-6 fw-bold">{{$clientCount}}</span> active clients.
                            </p>
                            <p class="d-none">
                                These are your <span class="fs-6 fw-bold">222</span> archived clients.
                            </p>

                            <form action="/{{$url_handle}}/client-details/create">
                                <button type="submit" class="btn btn-secondary py-1 ">
                                    <i class="fa-solid fa-square-plus me-2"></i>
                                    Add New Client
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Client list table -->
                    <div class="client-list-table border border-2 rounded-3 p-3 mt-4">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-capitalize fs-6 fw-bold fst-italic">
                                        Client name <span class="UX_note">Click to View/Edit</span>
                                    </th>
                                    <th scope="col" class="text-capitalize fs-6 fw-bold fst-italic ">
                                        {{$archive ? "Archived Date" : "Last Login Date"}}
                                    </th>
                                    <th scope="col" class="text-capitalize fs-6 fw-bold fst-italic">
                                        Status <span class="UX_note">{{$archive ? "View Record to Change Status" : "Toggle Lock Status"}}</span>
                                    </th>
                                    @if($archive)
                                    <th scope="col" class="text-capitalize fs-6 fw-bold fst-italic">
                                        Delete <span class="UX_note">Delete Event</span>
                                    </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($weddings as $wedding)
                                <tr>
                                    <td class="fs-6">
                                        <a role="link" href="/{{$url_handle}}/client-details/{{$wedding->url_handle}}">{{$wedding->person1_firstname}} & {{$wedding->person2_firstname}}</a>
                                    </td>
                                    <td class="fs-6 fst-italic date-created">
                                        {{$archive ? ($wedding->archived_date ? date("Y/m/d", strtotime($wedding->archived_date)) : "") : (date_format($wedding->created_at, "Y/m/d"))}}
                                    </td>
                                    <td class="fs-6">
                                        @if($archive)
                                        Archived <i class="fa-solid fa-box-archive"></i>
                                        @else
                                        <form method="POST" action="/timeline/{{$wedding->id}}/lock">
                                            {{ csrf_field() }}
                                            @method('PUT')
                                            <button class="btn-link p-1 m-0  bg-white border-0 text-decoration-none "><i class='{{$wedding->is_locked ? "fa-solid fa-lock" : ""}}'></i> {{ $wedding->is_locked ? 'Locked' : 'Active'}} </button>
                                        </form>
                                        @endif
                                    </td>
                                    @if($archive)
                                    <td class="fs-6">
                                        <form method="POST" action="/timeline/{{$wedding->id}}/delete">
                                            {{ csrf_field() }}
                                            @method('PUT')
                                            <button class="btn-link p-1 m-0  bg-white border-0 text-decoration-none "><i class='fa-solid fa-trash'></i> </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($archive)
                    <div class=" my-4">
                        <p class="UX_note">
                            An archived client cannot be edited by the client or your staff admins. <strong>Unarchive</strong> a client to make edits if necessary, then re-archive them.</p>

                        <p>
                            Return to your <a href="/{{$url_handle}}/index">Client Portal home</a>.
                        </p>

                    </div>
                    @else
                    <div class=" my-4">
                        <p class="UX_note">
                            <strong>Lock</strong> a client when their event date is so near that changes on their side are not allowed. Your admins can unlock a client to make edits, then should re-lock them.
                        </p>
                        <p>
                            You can add unlimited clients. Customizable report data gives
                            you insights into your business.
                        </p>

                        <!-- archived link loads this same layout template,  only showing the archived clients -->
                        @if(!$archive)
                        <p>
                            You have
                            @if($archiveCount == 0)
                            {{$archiveCount}} archived clients</a>
                            @elseif($archiveCount > 0)
                            <a href="/{{$url_handle}}/index/archive">{{$archiveCount}} archived clients</a>
                            @endif
                            . When an event is completed, archive them for better organization.
                        </p>
                        @else
                        <p>
                            <a href="/{{$url_handle}}/index">View active clients</a>
                        </p>
                        @endif
                        <hr>
                        <p>
                            <a href="/customer-client/manage">Manage your account here</a>. Add authorized staff, change your subscription, and manage your billing information.
                        </p>

                    </div>
                    @endif
                </div>
            </div>
        </section>

    </main>
</x-app-layout>