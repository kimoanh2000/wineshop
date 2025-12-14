@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Danh sách sản phẩm</h2>

    <div class="row">

        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">

                    @if($product->image)
                        <img src="/uploads/{{ $product->image }}"
                             class="card-img-top"
                             style="height:220px;object-fit:contain">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="fw-bold">{{ number_format($product->price) }} ¥</p>

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-success w-100">
                                Thêm vào giỏ hàng
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach

    </div>

</div>

@endsection
