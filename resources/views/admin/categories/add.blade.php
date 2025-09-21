<!-- add-category.html -->
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thêm danh mục</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-4">
    <h1 class="mb-4">Thêm danh mục</h1>
    <form  action="{{ route('category/store') }}" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="categoryName" class="form-label">Tên danh mục</label>
        <input type="text" class="form-control" name="name" placeholder="Nhập tên danh mục">
      </div>
      <button type="submit" class="btn btn-success">Lưu</button>
      <a href="{{ route('category') }}" class="btn btn-secondary">Hủy</a>
    </form>
  </div>
</body>
</html>
