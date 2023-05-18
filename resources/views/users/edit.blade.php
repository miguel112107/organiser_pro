<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
            <x-slot name="header">
                <h2 class="page-title max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">Edit User</h2>
            </x-slot>
            <!-- Validation Errors -->


            <form method="POST" action="{{ route('user.update',$user->id) }}">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required />
                </div>

                <div class="mt-4">
                    <x-label for="cell" :value="__('Cell')" />

                    <x-input id="cell" class="block mt-1 w-full" type="text" name="cell" value="{{ old('cell', $user->cell ?? '') }}" required />
                </div>

                <!-- Role -->
                @if(Auth::user()->role === "admin")
                <div className="mt-4">
                    <x-label for="role" :value="__('Role')" />
                    <select name="role" /* make sure this and data.role is the same */ id="role" className="block w-full mt-1 rounded-md" onChange={onHandleChange}>
                        <option {{$user->role==="user" ? "selected" : ''}} value="user">User</option>
                        <option {{$user->role==="owner" ? "selected" : ''}} value="owner">Owner</option>
                        <option {{$user->role==="admin" ? "selected" : ''}} value="admin">Admin</option>
                    </select>
                </div>

                <div className="mt-4">
                    <x-label for="venue" :value="__('Venue')" />
                    <select name="venue" /* make sure this and data.role is the same */ id="role" className="block w-full mt-1 rounded-md" onChange={onHandleChange}>
                        <option value="0">No Venue</option>
                        @foreach($venues as $venue)
                        <option value="{{$venue->id}}" {{$user->venue === $venue->id ? "selected": ""}}>{{$venue->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endIf

                <!-- Reset Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Reset Password')" />

                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <input type="submit" value="Submit" class="btn btn-success" />
                </div>
            </form>
        </div>
    </div>
</x-app-layout>