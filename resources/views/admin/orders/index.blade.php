@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Danh sách đơn hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Khách hàng</th>
                <th>SĐT</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Chi tiết</th>
            </tr>
        </thead>

        <tbody>
        @if ($orders->count())
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer_name }}</td>
                <td>{{ $order->customer_phone }}</td>
                <td>{{ number_format($order->total) }} ¥</td>
                <td>
                    @if ($order->status === 'pending')
                        <span class="badge bg-warning">Chờ xử lý</span>
                    @elseif ($order->status === 'processing')
                        <span class="badge bg-info">Đang xử lý</span>
                    @elseif ($order->status === 'completed')
                        <span class="badge bg-success">Hoàn thành</span>
                    @else
                        <span class="badge bg-secondary">{{ $order->status }}</span>
                    @endif
                </td>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}"
                       class="btn btn-sm btn-primary">
                        Xem
                    </a>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center">
                    Chưa có đơn hàng
                </td>
            </tr>
        @endif
        </tbody>
    </table>

    {{ $orders->links() }}
</div>
@endsection
