<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
            <x-slot name="header">
                <h2 class="page-title max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">Register New User</h2>
            </x-slot>
            <div class="register-logo container">
                <img class="row justify-content-md-center" src="/images/event_organizer_pro_logo.png" alt="event organizer pro logo">
            </div>
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />


            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <!-- Role -->
                <div className="mt-4">
                    <x-label for="role" :value="__('Role')" />

                    <select name="role" /* make sure this and data.role is the same */ id="role" className="block w-full mt-1 rounded-md" onChange={onHandleChange}>
                        <option value="user">User</option>
                        <option value="owner">Owner</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div className="mt-4">
                    <x-label for="venue" :value="__('Venue')" />

                    <select name="venue" /* make sure this and data.role is the same */ id="role" className="block w-full mt-1 rounded-md" onChange={onHandleChange}>
                        <option value="-1">No Venue</option>
                        @foreach($venues as $venue)
                        <option value="{{$venue->id}}">{{$venue->name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <!-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a> -->

                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>