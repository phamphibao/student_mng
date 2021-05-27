@extends('home')

@section('content-main')
<div class="card">
    <div class="card-header">Quản lý người dùng</div>
    <div class="card-body">
        <div class="row">
            @if (Session('success'))
                <div class="alert alert-success col-12">
                    {{ Session('success') }}
                </div>
            @endif
            <div class="col-12 d-flex justify-content-end">
                <a href="{{ route('student.edit', ['student'=>$user->id]) }}" class="btn btn-info text-light">Chỉnh sửa</a>

                <form action="{{ route('student.destroy', ['student'=>$user->id]) }}" method="post" class="ml-2">
                    @csrf
                    @method('DELETE')
                    <input type="submit" name="submit" value="Xóa" class="btn btn-danger">
                </form>

            </div>
            <div class="col-4">
                <div class="image mx-auto" style="background-image: url({{ asset('upload/'.$user->image) }}) "> </div>
            </div>
            <div class="col-5">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Họ tên:</b> {{ $user->name }}</li>
                    <li class="list-group-item"><b>Email:</b> {{ $user->email }}</li>
                    <li class="list-group-item"><b>Số điện thoại</b> {{ $user->phone }}</li>
                    <li class="list-group-item"><b>Ngày sinh:</b> {{ $user->birth_day }}</li>
                    <li class="list-group-item"><b>Giới tính:</b> 
                      @switch($user->gender)
                          @case(1)
                              Nam
                              @break
                          @case(2)
                              Nữ
                              @break
                          @case(2)
                              Khác
                          @break
                          @default
                              
                      @endswitch
                    </li>
                    <li class="list-group-item d-flex last"><b>Vai trò:</b> 
                        @foreach ($user->roles as $roles)
                        &nbsp;&nbsp;<p>{{ $roles->name }} <span class="comma">,</span></p> 
                        @endforeach
                    </li>
                    @if ($user->class_id)
                    <li class="list-group-item"><b>Lớp:</b> {{ $user->ClassStudent->name }}   
                    </li>
                    @endif
                    
                  </ul>
                
            </div>
           
        </div>
    </div>
</div>
@endsection