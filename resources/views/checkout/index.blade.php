@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Thanh toán</h2>

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <!-- Form thông tin người nhận -->
        <div class="col-md-6">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Họ và tên</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email (tuỳ chọn)</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email ?? '') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Địa chỉ</label>
                    <textarea name="address" rows="4" class="form-control" required>{{ old('address') }}</textarea>
                </div>

                <button class="btn btn-success">Xác nhận đặt hàng</button>
            </form>
        </div>

        <!-- Tóm tắt giỏ hàng -->
        <div class="col-md-6">
            <h5>Đơn hàng</h5>
            <table class="table">
                <tbody>
                @php $sum = 0; @endphp
                @foreach($cart as $item)
                    @php
                        $price = $item['price'] ?? 0;
                        $qty   = $item['quantity'] ?? 0;
                        $subtotal = $price * $qty;
                        $sum += $subtotal;
                    @endphp
                    <tr>
                        <td style="width:80px;">
                            @if(!empty($item['image']))
                                <img src="/uploads/{{ $item['image'] }}" class="img-fluid" style="max-width:70px;">
                            @endif
                        </td>
                        <td>{{ $item['name'] }}<br><small>{{ $qty }} × {{ number_format($price) }} ¥</small></td>
                        <td class="text-end">{{ number_format($subtotal) }} ¥</td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="2" class="text-end"><strong>Tổng</strong></td>
                        <td class="text-end"><strong>{{ number_format($sum) }} ¥</strong></td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('checkout.index') }}" class="btn btn-success mt-3">Tiến hành đặt hàng</a>
        </div>
    </div>
</div>
@endsection
