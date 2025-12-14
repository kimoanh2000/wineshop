@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Sửa sản phẩm</h2>

    <div class="card p-4">

        <form action="{{ route('admin.products.update', $product->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- Tên --}}
            <div class="mb-3">
                <label class="form-label">Tên sản phẩm</label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $product->name) }}"
                       class="form-control"
                       required>
            </div>

            {{-- Giá --}}
            <div class="mb-3">
                <label class="form-label">Giá</label>
                <input type="number"
                       name="price"
                       value="{{ old('price', $product->price) }}"
                       class="form-control"
                       required>
            </div>

            {{-- Mô tả --}}
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description"
                          rows="3"
                          class="form-control">{{ old('description', $product->description) }}</textarea>
            </div>

            {{-- Ảnh --}}
            <div class="mb-3">
                <label class="form-label">Ảnh hiện tại</label><br>

                @if($product->image)
                    <img src="/uploads/{{ $product->image }}"
                         width="120"
                         class="mb-2 border rounded">
                @else
                    <p class="text-muted">Chưa có ảnh</p>
                @endif

                <input type="file" name="image" class="form-control mt-2">
            </div>

            <button class="btn btn-success px-4">
                Cập nhật
            </button>

        </form>

    </div>

</div>

@endsection
