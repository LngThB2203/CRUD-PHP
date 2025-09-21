@extends('admin.layouts')
@section('title', 'Sửa sản phẩm')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Sửa sản phẩm</h1>

    {{-- Hiển thị lỗi --}}
    @if (isset($_SESSION['errors']) && isset($_GET['msg']))
        <div class="alert alert-danger">
            <ul>
                @foreach ($_SESSION['errors'] as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Hiển thị thông báo thành công --}}
    @if (isset($_SESSION['success']) && isset($_GET['msg']))
        <div class="alert alert-success">
            {{ $_SESSION['success'] }}
        </div>
    @endif

    <form action="{{ route('product/edit/{id}', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="text" class="form-control" name="price" value="{{ $product->price }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Hình ảnh sản phẩm</label><br>
            <img src="{{ storage($product->image) }}" alt="Ảnh sản phẩm" width="100px" height="100px"><br>
            <input type="file" class="form-control" name="image">
        </div>

        <div class="mb-3">
            <label class="form-label">Trạng thái sản phẩm</label>
            <select name="status" class="form-select">
                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Còn hoạt động</option>
                <option value="2" {{ $product->status == 2 ? 'selected' : '' }}>Dừng hoạt động</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Số lượng</label>
            <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}">
        </div>
        <div class="mb-3">
                <label for="category" class="form-label">Danh mục</label>
                <select class="form-select" name="category_id">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                    @endforeach
                </select>
            </div>
        <button type="submit" name="btnSave" value="save" class="btn btn-primary">Gửi</button>
        <a href="{{ route('product') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
