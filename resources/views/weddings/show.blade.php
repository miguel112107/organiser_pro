<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">Wedding</h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 bg-white">
                    <div class="">
                        <h2>
                        </h2>
                        <div class="wedding-info">
                            <p>{{$wedding->person1_firstname}}</p>
                            <p>{{$wedding->person2_firstname}}</p>
                            <p>{{$package->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>