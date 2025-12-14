@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">Thanh toán</h2>

    <p>Tổng số tiền: <b>{{ number_format($total) }} ¥</b></p>

    <form action="#" method="POST">
        @csrf
        <button class="btn btn-primary">Xác nhận thanh toán</button>
    </form>
</div>
@endsection
