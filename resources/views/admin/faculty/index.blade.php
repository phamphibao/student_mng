@extends('home')

@section('content-main')
<div class="card">
    <div class="card-header">Quản lý khoa</div>
    <div class="button-group d-flex mt-1 ml-1 ">
        <a href="{{ route('faculty.create') }}" class="btn btn-info text-light">Thêm mới</a>
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
                   <th>email</th>
                   <th>Trưởng khoa</th>
               </tr>
           </thead>
           <tbody>
              @foreach ($faculty as $fac)
                <tr>
                    <td scope="row">{{ $fac->id }}</td>
                    <td>{{ $fac->name }}</td>
                    <td>{{ $fac->phone }}</td>
                    <td>{{ $fac->email }}</td>
                    <td>{{ $fac->dean->name }}</td>
                    <td>
                        <a class="btn btn-info text-light w-100" href="{{ route('faculty.edit', ['faculty'=>$fac->id]) }}">Chỉnh sửa</a>
                        <form action="{{ route('faculty.destroy', ['faculty'=>$fac->id]) }}" method="post" class="mt-1">
                            @csrf
                            @method("DELETE")
                            <input type="submit" name="submit" value="Xóa" class="btn btn-danger w-100">
                        </form>
                    </td>
                </tr>
              @endforeach
           </tbody>
       </table>
       {{ $faculty->links() }}
    </div>
</div>
@endsection