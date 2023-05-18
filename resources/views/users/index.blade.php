<x-app-layout>
    <x-slot name="header">
        <h2 class="page-title max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">Users</h2>
    </x-slot>
    @if(count($users) > 0)
    @if(Auth::user()->role == 'admin')<a href="/register" class="btn btn-light">Create</a>@endif
    <div class="action-label">
        <span class="venue-label">Users</span>
        <span class="action-text">Tap to Manage</span>
    </div>
    <table class="user-table table table-bordered">
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td class="action-col"><a href="/user/{{$user->id}}/edit">edit</a> </td>
                <td class="action-col">
                    <form method="POST" action="/user/{{$user->id}}/delete">
                        {{ csrf_field() }}
                        @method('PUT')

                        <div class="form-group">
                            <input type="submit" class="delete-link" value="delete">
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</x-app-layout>