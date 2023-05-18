<x-app-layout>
    <x-slot name="header">
    </x-slot>
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
    <section class="container admin-login pt-5">
        <div class="row">
            <div class="admin-font col-11 m-auto col-md-10 m-md-auto col-lg-10 m-lg-auto">
                <h3>Our Customers</h3>
                <p>
                    Customers can include wedding barns, venues, hotels, caterers, and wedding coordinators.
                </p>

                <!-- Clients views -->
                <div class="customers border border-2 border-secondary-subtle rounded-3">

                    <table class="table table-borderless table-hover m-0">
                        <thead>
                            <th>Customer Name</th>
                            <th>Admin</th>
                            <th>Plan</th>
                            <th>Edit Customer</th>
                        </thead>
                        <tbody>
                            @foreach($venues as $venue)
                            <tr>
                                <td>
                                    <h5>{{$venue->name}}</h5>
                                    <a href="/admin/customer/clients/{{$venue->url_handle}}" class="text-dark fst-italic">View their {{$venue->client_count}} client(s)</a>
                                </td>
                                <td>
                                    {{$venue->owner->name}}
                                </td>
                                <td>
                                    ${{$venue->plan_price}}
                                </td>
                                <td class="">
                                    <a href="/admin/customer-details/{{$venue->url_handle}}" class="h5  m-0 bg-transparent" title="Edit this customer">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <th>
                                </th>
                                <th>
                                </th>
                                <th>
                                    Total Monthly: ${{$totalPrice}}
                                </th>
                                <th class="">
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="add-customer my-5">
                    <p>
                        Add new customers, manage their admins, view usage reports, and
                        other tasks
                    </p>
                    <!-- <button type="submit" class="btn btn-secondary">
                            <i class="fa-solid fa-square-plus me-2"></i>
                            Add Customer
                        </button> -->
                    <a href="create-customer-details" class="btn btn-secondary"><i class="fa-solid fa-square-plus me-2"></i>
                        Add Customer</a>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>