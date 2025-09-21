@extends('admin.layouts')
@section('title')

@section('content')

    <div class="container py-4">
        <h1 class="mb-3">Quản lý sản phẩm</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <img src="{{ storage($category->image) }}" width="200px" height="100px" alt="">
                        </td>
                        
                        <td>
                            <a href="{{ route('category/edit/{id}', ['id' => $category->id]) }}"><button>Sửa</button></a>
                            <a href="{{ route('category/delete/{id}', ['id' => $category->id]) }}"><button>Xóa</button></a>
                        </td>
                    </tr>
                @endforeach
                <!-- thêm dòng khác -->
            </tbody>
        </table>
        <a href="{{ route('category/create') }}" class="btn btn-success mb-3">+ Thêm danh mục</a>
        <a href="{{ route('product') }}" class="btn btn-success mb-3">Quản lý sản phẩm</a>
    </div>
@endsection
