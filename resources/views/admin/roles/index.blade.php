@extends('home')

@section('content-main')
<div class="card">
    <div class="card-header">Quản lý vai trò</div>
    <div class="button-group d-flex mt-1 ml-1 ">
        <a href="{{ route('roles.create') }}" class="btn btn-info text-light">Thêm mới</a>
    </div>
    <div class="card-body">
        @if (Session('success'))
            <div class="alert alert-success">{{ Session('success') }}</div>
        @endif
       <table class="table">
           <thead>
               <tr>
                   <th>id</th>
                   <th>Tên</th>
                   <th>Vai trò</th>
                   <th>Tùy chọn</th>
               </tr>
           </thead>
           <tbody>
              @foreach ($roles as $r)
                <tr>
                    <td scope="row">{{ $r->id }}</td>
                    <td>{{ $r->name }}</td>
                    <td>{{ $r->detail }}</td>
                    <td>
                        <a href="{{ route('roles.show', ['role'=>$r->id]) }}" class="btn btn-info text-light">Chi tiết</a>
                    </td>
                </tr>
              @endforeach
           </tbody>
       </table>
       {{ $roles->links() }}
    </div>
</div>
@endsection