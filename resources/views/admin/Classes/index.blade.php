@extends('home')

@section('content-main')
    <div class="card">
        <div class="card-header">Quản lý khoa</div>
        <div class="button-group d-flex mt-1 ml-1 ">
            <a href="{{ route('class.create') }}" class="btn btn-info text-light">Thêm mới</a>
        </div>
        <div class="card-body">
            @if (Session('success'))
                <div class="alert alert-success">{{ Session('success') }}</div>
            @endif
            @if (Session('warning'))
                <div class="alert alert-warning">{{ Session('warning') }}</div>
            @endif
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên lớp</th>
                        <th>Giáo viên chủ nhiệm</th>
                        <th>Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $t = 1; ?>
                    @foreach ($classes as $class)
                        <tr>
                            <td>{{ $class->id }}</td>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->teacher->name }}</td>
                            <td class="text-center">
                                <a class="btn btn-info text-light w-50"
                                    href="{{ route('class.edit', ['class' => $class->id]) }}">Chỉnh sửa</a>
                                <form action="{{ route('class.destroy', ['class' => $class->id]) }}" method="post"
                                    class="mt-1 w-50 mx-auto">
                                    @csrf
                                    @method("DELETE")
                                    <input type="submit" name="submit" value="Xóa" class="btn btn-danger w-100">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $classes->links() }}
        </div>
    </div>
@endsection
