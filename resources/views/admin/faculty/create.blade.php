@extends('home')

@section('content-main')
    <div class="card">
        <div class="card-header">Thêm mới</div>
        <div class="card-body">
            <div class="row">
                <div class="col-10 mx-auto">
                    <form action="{{ route('faculty.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="title-input" for="">Tên khoa</label>
                            @error('name')
                                <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                            @enderror
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="form-control input-control" placeholder="Nhập tên khoa">
                        </div>
                        <div class="form-group">
                            <label class="title-input" for="">Số điện thoại</label>
                            @error('phone')
                                <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                            @enderror
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                class="form-control input-control" placeholder="+999-xxx-xxxx">
                        </div>

                        <div class="form-group">
                            <label class="title-input" for="">email</label>
                            @error('email')
                                <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                            @enderror
                            <input type="text" name="email" id="phone" value="{{ old('email') }}"
                                class="form-control input-control" placeholder="example@mail.com">
                        </div>

                        <div class="form-group">
                          <label for="">Trưởng khoa</label>
                          @error('dean_id')
                            <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                          @enderror
                          <select class="form-control input-control" name="dean_id" id="dean_id">
                            @foreach ($user as $us)
                                <option value="{{ $us->id }}">{{ $us->name }}</option>
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
