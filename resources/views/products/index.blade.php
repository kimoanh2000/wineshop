@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Danh sách sản phẩm</h2>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        Thêm sản phẩm
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="card-body p-0">
        <table class="table table-bordered table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th width="50">ID</th>
                    <th>Tên</th>
                    <th width="150">Giá</th>
                    <th width="120">Ảnh</th>
                    <th width="220">Hành động</th>
                </tr>
            </thead>

            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price) }} ¥</td>

                    <td>
                        @if($product->image)
                            <img src="/uploads/{{ $product->image }}" width="80">
                        @else
                            <span class="text-muted">Không có ảnh</span>
                        @endif
                    </td>

                    <td>
                        <!-- Sửa -->
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                           class="btn btn-warning btn-sm">
                            Sửa
                        </a>

                        <!-- Xóa -->
                        <form action="{{ route('admin.products.destroy', $product->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Xóa sản phẩm?')"
                                    class="btn btn-danger btn-sm">
                                Xóa
                            </button>
                        </form><a href="{{ route('admin.products.edit', $product->id) }}">


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
