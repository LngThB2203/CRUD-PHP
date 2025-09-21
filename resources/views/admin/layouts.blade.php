<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Trang Quản Trị')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      background-color: #f4f6f9;
    }

    header {
      width: 100%;
      background-color: #343a40;
      color: white;
      padding: 20px;
    }

    .sidebar {
      width: 220px;
      background-color: #212529;
      min-height: 100vh;
      float: left;
      padding-top: 1rem;
    }

    .sidebar a {
      color: #adb5bd;
      padding: 10px 20px;
      display: block;
      text-decoration: none;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #495057;
      color: #fff;
    }

    main {
      margin-left: 20px;
      padding: 20px;
    }

    footer {
      width: 100%;
      background-color: #343a40;
      color: white;
      text-align: center;
      padding: 15px 0;
      clear: both;
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <header>
    <h4 class="mb-0">Trang Quản Trị Admin</h4>
  </header>

  <!-- SIDEBAR + MAIN -->
  <div class="d-flex">
    <div class="sidebar">
      <a href="{{ route('product/home') }}">Trang chủ</a>
      <a href="{{ route('product') }}">Sản phẩm</a>
      <a href="{{ route('category') }}">Danh mục</a>
      <a href="#">Giảm giá</a>
    </div>

    <main class="flex-grow-1">
      <div class="container-fluid">
        @yield('content')
      </div>
    </main>
  </div>

  <!-- FOOTER -->
  <footer>
    &copy; {{ date('Y') }} Admin Panel - Dev by Lng Th B
  </footer>

</body>
</html>
