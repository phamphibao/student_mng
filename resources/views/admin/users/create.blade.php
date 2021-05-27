@extends('home')

@section('content-main')
<div class="card">
    <div class="card-header">Thêm mới</div>
    <div class="card-body">
        <div class="row">
            <div class="col-10 mx-auto">
                <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for=""><b>Tên người dùng</b></label>
                      @error('name')
                        <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                      @enderror
                      <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control input-control" placeholder="Nhập tên người mới">
                    </div>
                    <div class="form-group">
                        <label for=""><b>email</b></label>
                        @error('email')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <input type="text" name="email" id="email"  value="{{ old('email') }}" class="form-control input-control" placeholder="email@gmail.com">
                    </div>
                    <div class="form-group">
                        @error('password')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <label for=""><b>Mật khẩu</b></label>
                        <input type="password" name="password" id="password" placeholder="Mặc định: 123456789"  class="form-control input-control">
                    </div>
                    <div class="form-group">
                        @error('password')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <label for=""><b>Xác thực mật khẩu</b></label>
                        <input type="password" name="password_confirm" id="password_confirm" placeholder="Mặc định: 123456789"  class="form-control input-control">
                    </div>
                    <div class="form-group">
                        @error('phone')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <label for=""><b>Số điện thoại</b></label>
                        <input type="text" name="phone" id="phone" placeholder="098-xxx-xxxx"  class="form-control input-control">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Ảnh đại diện</b></label>
                        <input type="file" name="image" id="image" class="form-control input-control" onchange="loadFile(event)">
                        <img class="mt-1" id="output" width="200"/>
                    </div>
                    <div class="form-group">
                        @error('date')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <label for=""><b>Ngày tháng năm sinh</b></label>
                        <input type="date" name="date" value="{{ old('date') }}" id="date" class="form-control input-control">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Giới tính</b></label>
                        @error('gender')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <select name="gender" id="gender" class="form-control input-control">
                            <option value="">Chọn...</option>
                            <option value="1">Nam</option>
                            <option value="2">Nữ</option>
                            <option value="3">Khác</option>
                        </select>
                    </div>
                    <div class="form-group ">
                        <label for=""><b>Vai trò</b></label>
                        @error('roles')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <select class="form-control select-option select-js" id="roles" name="roles[]" onchange="onChangeRoles()"  multiple="multiple">
                            @foreach ($roles as $role)
                                @if (collect(old('roles'))->contains($role->id))
                                    <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                                @else
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="group-class" style="display: none;">
                        <label for=""><b>Lớp:</b></label>
                        <select class="form-control input-control select-option" id="classes" name="classes">
                                <option value="">Chọn...</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-info text-light" value="Thêm mới">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
       
</script>
@endsection