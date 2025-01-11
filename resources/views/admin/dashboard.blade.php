@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <!-- Quản lý Người dùng -->
    <div>
    <a href="/users">Quản lí người dùng</a>
    </div>
    <!-- Quản lý Thể loại -->
    <div>
        <a href="/categories">Quản lý Thể loại</a>
    </div>
    <div>
    <!-- Quản lý Chủ đề -->
        <a href="/threads">Quản lý Chủ đề</a>
    </div>
    <!-- Quản lý Bài viết -->
    <div>
        <a href="/posts">Quản lý Bài viết</a>
    </div>
</div>
@endsection
