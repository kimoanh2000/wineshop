@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="fw-bold mb-4">Giỏ hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart) || count($cart) == 0)
        <p>Giỏ hàng đang trống.</p>
    @else

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                @php $total = 0; @endphp

                @foreach($cart as $productId => $item)
                    @php 
                        $total += $item['price'] * $item['quantity'];
                    @endphp

                    <tr>
                        <td width="120">
                            <img src="/uploads/{{ $item['image'] }}" width="100">
                        </td>

                        <td>{{ $item['name'] }}</td>

                        <td>{{ number_format($item['price']) }} ¥</td>

                        <td width="120">
                            <form action="{{ route('cart.update', $productId) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" 
                                       value="{{ $item['quantity'] }}" 
                                       min="1" class="form-control d-inline-block" 
                                       style="width:80px;">

                                <button class="btn btn-sm btn-info mt-2">Cập nhật</button>
                            </form>
                        </td>

                        <td>{{ number_format($item['price'] * $item['quantity']) }} ¥</td>

                        <td>
                            <form action="{{ route('cart.remove', $productId) }}" 
                                  method="POST">
                                @csrf
                                <button onclick="return confirm('Xóa sản phẩm?')" 
                                        class="btn btn-danger btn-sm">
                                    Xóa
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="text-end">Tổng tiền: 
            <b class="text-danger">{{ number_format($total) }} ¥</b>
        </h4>
        <div class="text-end mt-3">
    <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">
        Tiến hành thanh toán
    </a>
</div>

    @endif
</div>

@endsection
