@extends('admin.layouts.app')
@section('content')
<h2 class="text-xl font-bold mb-4">User Management</h2>
<table class="table-auto w-full bg-white shadow rounded">
    <thead>
        <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td class="border px-4 py-2">{{ $user->id }}</td>
            <td class="border px-4 py-2">{{ $user->user_name }}</td>
            <td class="border px-4 py-2">{{ $user->email }}</td>
            <td class="border px-4 py-2">
                <a href="#" class="text-blue-500">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
