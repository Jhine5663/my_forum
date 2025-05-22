@extends('layouts.app')

@section('content')
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold pixel-font text-blue-400 glow-text mb-4">Chỉnh sửa hồ sơ</h1>
        <div class="bg-gray-800 p-4 rounded-lg shadow-md border border-blue-500/20">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <x-form-input name="user_name" label="Tên người dùng" :value="$user->user_name" required />
                <x-form-input name="email" label="Email" type="email" :value="$user->email" required />
                <x-form-button label="Cập nhật" />
            </form>
        </div>
    </div>
@endsection