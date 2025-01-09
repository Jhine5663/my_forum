@extends('layouts.app')

@section('content')
<div class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-10 rounded-lg shadow-lg">
        <form method="POST" action="/login">
            @csrf
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="email">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}" 
                    required 
                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                
                <!-- Hiển thị thông báo lỗi nếu có -->
                @if ($errors->has('email'))
                    <span class="text-red-500 text-xs italic">{{ $errors->first('email') }}</span>
                @endif
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="password">Mật khẩu</label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    required 
                    class="shadow appearance-none border rounded w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                
                <!-- Hiển thị thông báo lỗi nếu có -->
                @if ($errors->has('password'))
                    <span class="text-red-500 text-xs italic">{{ $errors->first('password') }}</span>
                @endif
            </div>
            
    
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">Đăng Nhập</button>
                <a href="/register" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">Đăng ký</a>
            </div>
        </form>
    </div>
</div>

@endsection
