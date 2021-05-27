@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div class="group-button">
                        <ul class="list-group list-group-flush">
                            @can('view-student')
                                <li class="list-group-item"><a href="{{ route('student.index') }}">Học sinh</a></li>
                            @endcan
                            @can('view-class')
                                <li class="list-group-item"><a href="{{ route('class.index') }}">Lớp</a></li>
                            @endcan
                            @can('view-teacher')
                                <li class="list-group-item"><a href="{{ route('teacher.index') }}">Giáo viên</a></li>
                            @endcan

                            @can('view-faculty')
                                <li class="list-group-item"><a href="{{ route('faculty.index') }}">Khoa</a></li>
                            @endcan

                            {{-- @can('isAdmin') --}}
                                <li class="list-group-item"><a href="{{ route('user.index') }}">Quản lý tài khoản</a></li>
                            {{-- @endcan
                            @can('isAdmin') --}}
                                <li class="list-group-item"><a href="{{ route('roles.index') }}">Quản lý vai trò</a></li>
                            {{-- @endcan --}}
                            
                          </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
          @yield('content-main')
        </div>
    </div>
</div>
@endsection
