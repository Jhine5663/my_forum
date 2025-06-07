@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <x-notification /> 

        <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-3/4"> 
                @yield('forum-content') 
            </div>

            <aside class="md:w-1/4 space-y-6">
                <x-sidebar />
                @yield('sidebar_specific_content')
            </aside>
        </div>
    </div>
@endsection