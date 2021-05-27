@extends('home')

@section('content-main')
    <div class="card">
        <div class="card-header">Chỉnh sửa lớp </div>
        <div class="card-body">
            <div class="row">
                <div class="col-10 mx-auto">
                    @if (Session('warning'))
                        <div class="alert alert-warning">
                            {{ Session('warning') }}
                        </div>
                    @endif
                    <form action="{{ route('class.update',['class' => $class->id]) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="title-input" for="">Tên lớp</label>
                            @error('name')
                                <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                            @enderror
                            <input type="text" name="name" id="name" value="{{ old('name', $class->name) }}"
                                class="form-control input-control" placeholder="Nhập tên lớp">
                        </div>
                     
                        <div class="form-group">
                          <label for="">Giáo viên chủ nhiệm</label>
                          @error('teacher_id')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                          @enderror
                          <select class="form-control input-control" name="teacher_id" id="teacher_id">
                            <option value="{{ old('teacher_id') }}">Chọn...</option>
                            
                            @foreach ($teachers as $teacher)
                                @if ($teacher->id == $class->teacher_id)
                                    <option value="{{$teacher->id }}" selected>{{ $teacher->name }}</option>
                                @elseif (old('teacher_id') == $teacher->id)
                                    <option value="{{$teacher->id }}" selected>{{ $teacher->name }}</option>
                                @else
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endif
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

@endsection
