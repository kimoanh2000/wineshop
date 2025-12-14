@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>

    <hr>

    <h4>Thông tin khách hàng</h4>
    <p><strong>Tên:</strong> {{ $order->customer_name }}</p>
    <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
    <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
    <p><strong>Email:</strong> {{ $order->customer_email }}</p>

    <hr>
    <hr>

<h4>Cập nhật trạng thái đơn hàng</h4>

<form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
    @csrf
    @method('PUT')

    <select name="status" class="form-control" style="width: 200px; display:inline-block;">
        <option value="pending"    {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
        <option value="confirmed"  {{ $order->status == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
        <option value="shipping"   {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao</option>
        <option value="completed"  {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
        <option value="cancelled"  {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
    </select>

    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>

    <h4>Sản phẩm đã đặt</h4>

    <table class="table table-bordered mt-3">
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tạm tính</th>
        </tr>

        @foreach ($order->items as $item)
        <tr>
            <td>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</td>
            <td>{{ number_format($item->price) }}₫</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->subtotal) }}₫</td>
        </tr>
        @endforeach
    </table>

    <h3 class="text-end">Tổng tiền: {{ number_format($order->total) }}₫</h3>

</div>
@endsection
