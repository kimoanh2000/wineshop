<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Wine Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">Wine Shop</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/products">Sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link" href="/cart">Giỏ hàng</a></li>

                @auth
                    <li class="nav-item"><a class="nav-link" href="/admin/products">Admin</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    {{-- Nội dung trang --}}
    @yield('content')
</div>

</body>
</html>
