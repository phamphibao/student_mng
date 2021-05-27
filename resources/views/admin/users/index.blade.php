@extends('home')

@section('content-main')
<div class="card">
    <div class="card-header">Quản lý người dùng</div>
    <div class="button-group d-flex mt-1 ml-1 ">
        <a href="{{ route('user.create') }}" class="btn btn-info text-light">Thêm mới</a>
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
                   <th>Số điện thoại</th>
                   <th>Ảnh đại diện</th>
                   <th>Chi tiết</th>
               </tr>
           </thead>
           <tbody>
              @foreach ($users as $us)
                <tr>
                    <td scope="row">{{ $us->id }}</td>
                    <td>{{ $us->name }}</td>
                    <td>{{ $us->phone }}</td>
                    <td><img src="{{ asset('upload/'.$us->image) }}" alt="" width="100"></td>
                    <td>
                        <a class="btn btn-info text-light" href="{{ route('user.show', ['user'=>$us->id]) }}">Chi tiết</a>
                    </td>
                </tr>
              @endforeach
           </tbody>
       </table>
       {{ $users->links() }}
    </div>
</div>
@endsection