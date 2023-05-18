<x-app-layout>
    <header class="container bg-white border-5 border-bottom border-dark-subtle">
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
                                <a href="/admin/index" class="fs-lg-4 fs-6 text-dark fw-bold">All Customers</a>
                            </li>
                            <li class="breadcrumb-item active fs-lg-4 fs-6 text-dark fw-bold" aria-current="page">
                                {{$venue->name}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Client list -->
        <section class="container">
            <div class="row">
                <div class="col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                    <div class="heading-area">
                        <h3>{{$venue->name}} Client List</h3>
                        <p>
                            These are the <strong>{{$count}}</strong> event clients created by this <a href="/admin/customer-details/{{$url_handle}}" title="Edit this Customer's record">Customer</a>. We can see this info to help us with data analytics.
                        </p>
                    </div>

                    <ul>
                        <li><strong>Customer's Primary Admin:</strong> {{$admin->name}}
                        <li><strong>Email:</strong> <a href="mailto:{{$admin->email}}">{{$admin->email}}</a>
                        <li><strong>Phone:</strong> {{$admin->cell}}
                        <li><strong>Last login:</strong> {{date("M n Y", strtotime($admin->last_login))}}
                    </ul>

                    <!-- Client list table -->
                    <div class="client-list-table border border-2 rounded-3 p-3 pb-0 ">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-capitalize fs-6 fw-bold fst-italic">
                                        <i class="fa-solid fa-user-edit"></i> Client name
                                    </th>
                                    <th scope="col" class="text-capitalize fs-6 fw-bold fst-italic  ">
                                        Date created
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                <tr>
                                    <td class="fs-6">
                                        <a role="link" href="/{{$url_handle}}/client-details/{{$event->url_handle}}" aria-disabled="true">{{$event->person1_firstname}} & {{$event->person2_firstname}}</a>
                                    </td>
                                    <td class="fs-5 fst-italic date-created">{{date_format($event->created_at, "Y/m/d")}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="mt-3">
                        Notes here.
                        <p>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>