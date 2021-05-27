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
                   <th>image</th>
                   <th>Chi tiết</th>
               </tr>
           </thead>
           <tbody>
              @foreach ($users as $user)
                <tr>
                    <td scope="row">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <img src="{{ asset('upload/'.$user->image) }}" alt="" width="150">
                    </td>
                    <td><a class="btn btn-info text-light" href="{{ route('student.show', ['student'=>$user->id]) }}">Chi tiết</a></td>
                </tr>
              @endforeach
           </tbody>
       </table>
    </div>
</div>
@endsection