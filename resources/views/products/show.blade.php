@extends('layouts.app')

@section('content')

<h2>{{ $product->name }}</h2>

<p>{{ number_format($product->price) }} ¥</p>

<img src="/uploads/{{ $product->image }}" width="200">

<form action="{{ route('cart.add', $product->id) }}" method="POST">
    @csrf
    <input type="number" name="quantity" value="1" min="1">
    <button class="btn btn-primary">Thêm vào giỏ</button>
</form>

@endsection
