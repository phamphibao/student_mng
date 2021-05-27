@extends('home')

@section('content-main')
    <div class="card">
        <div class="card-header">Thêm mới</div>
        <div class="card-body">
            <div class="row">
                <div class="col-10 mx-auto">
                    <form action="{{ route('roles.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="title-input" for="">Tên vai trò</label>
                            @error('name')
                                <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                            @enderror
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="form-control input-control" placeholder="Nhập tên vai trò mới">
                        </div>
                        <div class="form-group">
                            <label class="title-input" for="">Chi tiết vai trò</label>
                            @error('detail')
                                <div class="warning-danger"><i class="fas fa-exclamation-triangle"></i>{{ $message }}</div>
                            @enderror
                            <input type="text" name="detail" id="detail" value="{{ old('detail') }}"
                                class="form-control input-control" placeholder="Chi tiết vai trò">
                        </div>

                        @foreach ($permission as $per)
                        <div class="form-group">
                            <label class="title-input" for="{{  $per->name }}">{{ $per->name }}</label> 
                            <div class="group-check d-flex justify-content-between">
                                @foreach ($per->permissionChildent as $per_childent)
                                <div class="form-check form-check-inline col-3">
                                    <input class="form-check-input" name="permission[]" type="checkbox" id="{{  $per_childent->name }}" value="{{  $per_childent->id }}">
                                    <label class="form-check-label" for="{{  $per_childent->name }}">{{ $per_childent->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach

                        

                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-info text-light" value="Thêm mới">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
