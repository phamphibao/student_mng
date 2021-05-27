@extends('home')

@section('content-main')
<div class="card">
    <div class="card-header">Giáo viên</div>
   
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
                   <th>image</th>
                   <th>Chi tiết</th>
               </tr>
           </thead>
           <tbody>
              @foreach ($roles->users as $users)
                <tr>
                    <td scope="row">{{ $users->id }}</td>
                    <td>{{ $users->name }}</td>
                    <td>{{ $users->phone }}</td>
                    <td>{{ $users->image }}</td>
                    <td><a class="btn btn-info" href="{{ route('teacher.show', ['teacher'=>$users->id]) }}">Chi tiết</a></td>
                </tr>
              @endforeach
           </tbody>
       </table>
    </div>
</div>
@endsection