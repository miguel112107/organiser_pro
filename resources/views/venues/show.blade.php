<x-app-layout>
    <x-slot name="header">
    <h2 class="page-title max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">Venue</h2>
    </x-slot>

    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 bg-white">
                    <div class="well">
                        <h2>
                            {{$venue->name}}
                        </h2>
                        <div class="venue-info">
                            <p><span class="bold-font">Admin:</span> {{$venue->owner}}</p>
                            <p><span class="bold-font">Cell Phone:</span> {{$venue->phone}}</p>
                            <p><span class="bold-font">Logo:</span></p>
                            <img src="/images/upload-images/{{ old('logo', $venue->logo ?? '') }}" alt="Client Logo" width="200" height="100">
                            <a href="/venue/weddings/{{$venue->id}}" class="btn btn-light active" role="button" aria-pressed="true">Weddings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>