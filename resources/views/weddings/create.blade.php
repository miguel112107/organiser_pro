<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">Create Wedding</h2>
    </x-slot>
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="well">
                    <div class="p-6 bg-white">
                        <form action="{{ route('wedding.store') }}" method="Post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="venue" value="{{$venueId}}">
                            <div class="form-group">
                                <label for="name">Wedding Name</label>
                                <input name="name" class="input-field" type="text" id="name" required>

                                <label for="email">Email</label>
                                <input name="email" class="input-field" type="text" id="email" required>

                                <label for="date">Wedding Date</label>
                                <input name="date" class="input-field" type="date" id="date" required>

                                <label for="person1_firstname">Person 1 First Name</label>
                                <input name="person1_firstname" type="text" class="input-field" id="person1_firstname" required>

                                <label for="person1_lastname">Person 1 Last Name</label>
                                <input name="person1_lastname" type="text" class="input-field" id="person1_lastname" required>

                                <label for="person2_firstname">Person 2 First Name</label>
                                <input name="person2_firstname" type="text" class="input-field" id="person2_firstname" required>

                                <label for="person2_lastname">Person 2 Last Name</label>
                                <input name="person2_lastname" type="text" class="input-field" id="person2_lastname" required>

                                <label for="package">Package</label>
                                @foreach($packages as $package)
                                <div class="radio-block">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="package_choice" id="package_choice" value="{{$package->id}}">
                                        <label class="form-check-label" for="package_choice">{{$package->name}} </label>
                                    </div>
                                </div>
                                @endforeach

                                <input type="submit" value="Submit" class="btn btn-success" />
                            </div>
                            <form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>