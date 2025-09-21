<!-- admin-products.html -->
@extends('admin.layouts')
@section('title')

@section('content')

    <div class="container py-4">
        <h1 class="mb-3">Quản lý sản phẩm</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Danh mục</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->category_name }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <img src="{{ storage($product->image) }}" width="200px" height="100px" alt="">
                        </td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            @if ($product->status == 1)
                                <span>Còn hàng</span>
                            @else
                                <span>Hết hàng</span>
                            @endif
                        <td>
                            <a href="{{ route('product/edit/{id}', ['id' => $product->id]) }}"><button>Sửa</button></a>
                            <a href="{{ route('product/delete/{id}', ['id' => $product->id]) }}"><button>Xóa</button></a>
                        </td>
                    </tr>
                @endforeach
                <!-- thêm dòng khác -->
            </tbody>
        </table>
        <a href="{{ route('product/create') }}" class="btn btn-success mb-3">+ Thêm sản phẩm</a>
        <a href="{{ route('category') }}" class="btn btn-success mb-3">Quản lý danh mục</a>
    </div>
@endsection
