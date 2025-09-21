<!-- add-product.html -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container py-4">
        <h1 class="mb-4">Thêm sản phẩm</h1>
        @if (isset($_SESSION['errors']) && isset($_GET['msg']))
            <ul>
                @foreach ($_SESSION['errors'] as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        @if (isset($_SESSION['success']) && isset($_GET['msg']))
            <span>{{ $_SESSION['success'] }}</span>
        @endif
        <form action="{{ route('product/store') }}" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="productName" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm">
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Giá</label>
                <input type="text" class="form-control" name="price" placeholder="Nhập giá">
            </div>
            <div class="mb-3">
                <label for="productImage" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" name="image">
            </div>
            <div class="mb-3">
                <label for="productQuantity" class="form-label">Số lượng</label>
                <input type="number" class="form-control" name="quantity">
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
            <select name="status">
                <option value="1">Còn hoạt động</option>
                <option value="0">Dừng hoạt động</option>
            </select>
            <button type="submit" class="btn btn-success" name="btnSave" value="save">Lưu</button>

        </form>
        <a href="{{ route('product') }}" class="btn btn-secondary">Hủy</a>
    </div>
</body>

</html>
