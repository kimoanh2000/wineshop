<x-app-layout>

<div class="container py-4">

    <div class="row">
        <div class="col-md-4">
            <img src="/uploads/{{ $product->image }}" class="img-fluid">
        </div>

        <div class="col-md-8">
            <h2>{{ $product->name }}</h2>

            <p class="text-muted">{{ $product->price }} ¥</p>

            <p>{{ $product->description }}</p>

            <button class="btn btn-success">
                カートに追加
            </button>
        </div>
    </div>

</div>

</x-app-layout>
