@extends('admin.layouts')
@section('title')

@section('content')
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
  <div class="container py-4">
    <h1 class="mb-4">Sửa danh mục</h1>
    <form action="{{ route('category/edit/{id}', ['id' => $category->id]) }}" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="categoryName" class="form-label">Tên danh mục</label>
        <input type="text" class="form-control" name="name" value="Điện thoại">
      </div>
      <div class="mb-3">
            <label class="form-label">Hình ảnh danh mục</label><br>
            <img src="{{ storage($category->image) }}" alt="Ảnh sản phẩm" width="100px" height="100px"><br>
            <input type="file" class="form-control" name="image">
        </div>
      <button type="submit" name="btnSave" value="save" class="btn btn-primary">Cập nhật</button>
      <a href="{{ route('category') }}" class="btn btn-secondary">Hủy</a>
    </form>
  </div>

@endsection