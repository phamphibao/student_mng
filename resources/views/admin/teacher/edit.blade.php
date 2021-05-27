@extends('home')

@section('content-main')
<div class="card">
    <div class="card-header">Cập nhật thông tin giáo viên</div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('teacher.show',['teacher'=>$user_edit->id]) }}" class="btn btn-info">Hủy</a>
            </div>
            <div class="col-10 mx-auto">
                @if (Session('success'))
                    <div class="alert alert-success">{{ Session('success') }}</div>
                @endif
                <form action="{{ route('teacher.update',['teacher' => $user_edit->id ]) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                      <label for=""><b>Tên người dùng</b></label>
                      @error('name')
                        <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                      @enderror
                      <input type="text" name="name" id="name" value="{{ old('name',$user_edit->name) }}" class="form-control input-control" placeholder="Nhập tên người mới">
                    </div>
                    <div class="form-group">
                        <label for=""><b>email</b></label>
                        @error('email')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <input type="text" name="email" id="email"  value="{{ old('email', $user_edit->email  ) }}" class="form-control input-control" placeholder="email@gmail.com">
                    </div>
                    <div class="form-group">
                        @error('phone')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <label for=""><b>Số điện thoại</b></label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone',$user_edit->phone) }}" placeholder="098-xxx-xxxx"  class="form-control input-control">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Ảnh đại diện</b></label>
                        @error('image')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
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
                        <input type="date" name="date" value="{{ old('date',$user_edit->birth_day)  }}" id="date" class="form-control input-control">
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
                    <div class="form-group ">
                        <label for=""><b>Vai trò</b></label>
                        @error('gender')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <select class="form-control select-option select-js" name="roles[]" multiple="multiple">
                            @foreach ($roles as $role)
                             <option value="{{ $role->id }}" {{ ($roles_of_user->contains($role->id) ? 'selected' : "") }}>{{ $role->name }}</option>
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