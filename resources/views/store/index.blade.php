<x-app-layout>
    <div class="container py-4">

        <h2 class="mb-4">ワイン一覧</h2>

        <div class="row">
            @foreach ($products as $p)
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <img src="/uploads/{{ $p->image }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $p->name }}</h5>
                            <p class="card-text">{{ $p->price }} ¥</p>
                            
                            <a href="{{ route('store.detail', $p->id) }}" 
                               class="btn btn-primary btn-sm">
                               詳細を見る
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
