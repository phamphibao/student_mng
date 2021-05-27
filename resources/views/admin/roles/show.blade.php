@extends('home')

@section('content-main')
<div class="card">
    <div class="card-header">Chi tiết vai trò</div>
    <div class="button-group d-flex mt-1 ml-1 ">
        <a href="{{ route('roles.edit',['role' => $roles->id]) }}" class="btn btn-info text-light">Chỉnh sửa</a>
        <form action="{{ route('roles.destroy', ['role'=>$roles->id]) }}" method="post" class="ml-2">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="Xóa">
        </form>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Tên:</b> {{ $roles->name }}</li>
                    <li class="list-group-item"><b>Vai trò:</b> {{ $roles->detail }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><b>Những quyền hạn được cấp</b></li>
                        <li class="list-group-item">
                            @foreach ($roles->permission as $per)
                                {{ $per->name }} <br>
                            @endforeach
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection