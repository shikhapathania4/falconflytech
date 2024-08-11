<x-app-layout>
    <x-slot name="header">
      
    </x-slot>
 
    <div class="main-content">
            <h2 class="mb-4">User and Vendor List</h2>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Change Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->phone }}</td>
                            <td> @if ($user->status == "Deactivated")
                                    <span class="text-danger">Deactivated</span>
                                @else
                                    <span class="text-success">Active</span>
                                @endif</td>
                            <td>
                                <form id="logout-form" action="{{ url('change-user-status/' . $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Change Status</button>
                                </form>                            
                            </td>                        
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
