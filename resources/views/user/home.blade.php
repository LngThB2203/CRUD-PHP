@extends('user.layouts')

@section('title', 'Trang Chủ')

@section('content')
<h1 class="text-center mb-4">Danh sách sản phẩm</h1>
<div class="row">
  @foreach ($products as $product)
    <div class="col-md-4 mb-4">
      <div class="card h-100 text-center">
        <img src="{{ storage($product->image) }}" class="card-img-top" alt="Sản phẩm" style="height: 200px; object-fit: cover;">
        <div class="card-body">
          <h5 class="card-title">{{ $product->name }}</h5>
          <p class="card-text text-danger bold fw-bold">{{ number_format($product->price) }}₫</p>
          <p class="card-text">
            @if ($product->status == 1)
              <span class="text-success">Còn hàng</span>
            @else
              <span class="text-danger">Hết hàng</span>
            @endif
          </p>
          <a href="{{ route('product/detail/{id}', ['id' => $product->id]) }}" class="btn btn-primary">Xem chi tiết</a>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endsection
