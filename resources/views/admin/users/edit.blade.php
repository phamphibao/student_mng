@extends('home')

@section('content-main')
<div class="card">
    <div class="card-header">Thêm mới</div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('user.show',['user'=>$user_edit->id]) }}" class="btn btn-info">Hủy</a>
            </div>
            <div class="col-10 mx-auto">
                @if (Session('success'))
                    <div class="alert alert-success">{{ Session('success') }}</div>
                @endif
                <form action="{{ route('user.update',['user' => $user_edit->id ]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for=""><b>Tên người dùng</b></label>
                      @error('name')
                        <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                      @enderror
                      <input type="text" name="name" id="name" value="{{ $user_edit->name }}" class="form-control input-control" placeholder="Nhập tên người mới">
                    </div>
                    <div class="form-group">
                        <label for=""><b>email</b></label>
                        @error('email')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <input type="text" name="email" id="email"  value="{{ old('email', $user_edit->email  ) }}" class="form-control input-control" placeholder="email@gmail.com">
                    </div>

                    <div class="form-group">
                        @error('password')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <label for=""><b>Mật khẩu</b></label>
                        <input type="password" name="password" id="password" class="form-control input-control" placeholder="Thay đổi mật khẩu">
                    </div>
                    <div class="form-group">
                        @error('password_confirmation')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <label><b>Xác nhận mật khẩu</b></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-control" placeholder="Thay đổi mật khẩu">
                    </div>
                    <div class="form-group">
                        @error('phone')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <label for=""><b>Số điện thoại</b></label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $user_edit->phone)}}" placeholder="098-xxx-xxxx"  class="form-control input-control">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Ảnh đại diện</b></label>
                        <input type="file" name="image" id="image" class="form-control input-control" onchange="loadFile(event)">
                        @if ($user_edit->image != null)
                        <img class="mt-1" src="{{ asset('upload/'.$user_edit->image) }}" id="output" width="200"/>
                        @else
                        <img class="mt-1" id="output" width="200"/>
                        @endif
                       
                    </div>
                    <div class="form-group">
                        @error('date')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <label for=""><b>Ngày tháng năm sinh</b></label>
                        <input type="date" name="date" value="{{ $user_edit->birth_day }}" id="date" class="form-control input-control">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Giới tính</b></label>
                        @error('gender')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <select name="gender" id="gender" class="form-control input-control">
                            @switch($user_edit->gender)
                                @case(1)
                                <option value="1">Nam</option>
                                    @break
                                @case(2)
                                <option value="2">Nữ</option>
                                @break
                                @case(3)
                                <option value="3">Khác</option>
                                @break
                                @default
                            @endswitch
                            <option value="1" >Nam</option>
                            <option value="2">Nữ</option>
                            <option value="3">Khác</option>
                        </select>
                    </div>
                    @can('isAdmin')
                        <div class="form-group ">
                            <label for=""><b>Vai trò</b></label>
                            @error('gender')
                                <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                            @enderror
                            <select class="form-control select-option select-js" name="roles[]" id="roles" onchange="onChangeRoles()" multiple="multiple">
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ ($roles_of_user->contains($role->id) ? 'selected' : "") }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>  
                    @endcan

                    <div class="form-group" id="group-class" style="display: none;">
                        <label for=""><b>Lớp:</b></label>
                        <select class="form-control input-control select-option" id="classes" name="classes">
                                <option value="">Chọn...</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ ($class->id == $user_edit->class_id) ? 'selected' : "" }}>{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info text-light" value="Cập nhật">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection