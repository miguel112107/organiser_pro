<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">Wedding</h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 bg-white">
                    <div class="well">
                        <h2>
                        </h2>
                        <div class="p-6 bg-white">
                            <form action="{{ route('wedding.update',$wedding->id) }}" method="Post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">

                                    <label for="date">Wedding Date</label>
                                    <input name="date" class="input-field" type="date" id="date" value="{{ old('date', $wedding->date ?? '') }}">

                                    <label for="person1_firstname">Person 1 First Name</label>
                                    <input name="person1_firstname" type="text" class="input-field" id="person1_firstname" value="{{ old('person1_firstname', $wedding->person1_firstname ?? '') }}">

                                    <label for="person1_lastname">Person 1 Last Name</label>
                                    <input name="person1_lastname" type="text" class="input-field" id="person1_lastname" value="{{ old('person1_lastname', $wedding->person1_lastname ?? '') }}">

                                    <label for="person2_firstname">Person 2 First Name</label>
                                    <input name="person2_firstname" type="text" class="input-field" id="person2_firstname" value="{{ old('person2_firstname', $wedding->person2_firstname ?? '') }}">

                                    <label for="person2_lastname">Person 2 Last Name</label>
                                    <input name="person2_lastname" type="text" class="input-field" id="person2_lastname" value="{{ old('person2_lastname', $wedding->person2_lastname ?? '') }}">

                                    <label for="package">Package</label>
                                    @foreach($packages as $package)
                                    <div class="radio-block">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="package_choice" id="package_choice" value="{{$package->id}}" {{$wedding->package_choice === $package->id ? "checked" : ''}}>
                                            <label class="form-check-label" for="package_choice">{{$package->name}} </label>
                                        </div>
                                    </div>
                                    @endforeach
                                    <input type="submit" value="Submit" class="btn btn-success" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>