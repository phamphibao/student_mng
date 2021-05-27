@extends('home')

@section('content-main')
<div class="card">
    <div class="card-header">Chỉnh sửa thông tin học sinh</div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('student.show',['student'=>$student->id]) }}" class="btn btn-info">Hủy</a>
            </div>
            <div class="col-10 mx-auto">
                @if (Session('success'))
                    <div class="alert alert-success">{{ Session('success') }}</div>
                @endif
                <form action="{{ route('student.update',['student' => $student->id ]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for=""><b>Tên học sinh</b></label>
                      @error('name')
                        <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                      @enderror
                      <input type="text" name="name" id="name" value="{{ $student->name }}" class="form-control input-control" placeholder="Nhập tên người mới">
                    </div>
                    <div class="form-group">
                        <label for=""><b>email</b></label>
                        @error('email')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <input type="text" name="email" id="email"  value="{{ old('email', $student->email  ) }}" class="form-control input-control" placeholder="email@gmail.com">
                    </div>
                    
                    <div class="form-group">
                        @error('phone')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <label for=""><b>Số điện thoại</b></label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $student->phone)}}" placeholder="098-xxx-xxxx"  class="form-control input-control">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Ảnh đại diện</b></label>
                        <input type="file" name="image" id="image" class="form-control input-control" onchange="loadFile(event)">
                        @if ($student->image != null)
                        <img class="mt-1" src="{{ asset('upload/'.$student->image) }}" id="output" width="200"/>
                        @else
                        <img class="mt-1" id="output" width="200"/>
                        @endif
                       
                    </div>
                    <div class="form-group">
                        @error('date')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <label for=""><b>Ngày tháng năm sinh</b></label>
                        <input type="date" name="date" value="{{ $student->birth_day }}" id="date" class="form-control input-control">
                    </div>
                    <div class="form-group">
                        <label for=""><b>Giới tính</b></label>
                        @error('gender')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <select name="gender" id="gender" class="form-control input-control">
                            <option value="1" {{ ($student->gender == 1) ? 'selected' : "" }}>Nam</option>
                            <option value="2" {{ ($student->gender == 2) ? 'selected' : "" }}>Nữ</option>
                            <option value="3" {{ ($student->gender == 3) ? 'selected' : "" }}>Khác</option>
                        </select>
                    </div>
                   

                    <div class="form-group" id="group-class">
                        <label for=""><b>Lớp:</b></label>
                        @error('classes')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                        @enderror
                        <select class="form-control input-control select-option" id="classes" name="classes">
                            <option value="">Chọn...</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ ($class->id == $student->class_id) ? 'selected' : "" }}>{{ $class->name }}</option>
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