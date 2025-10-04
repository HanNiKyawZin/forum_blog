<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <div id="sidebar" class="d-flex flex-column p-3 bg-dark text-white" style="min-width: 220px;">
            <h3 class="text-center">Admin Panel</h3>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->is('admin/posts*') ? 'active' : '' }}">Posts</a>
                </li>
                <li>
                    <a href="{{ route('admin.comments.index') }}" class="nav-link {{ request()->is('admin/comments*') ? 'active' : '' }}">Comments</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger w-100 mt-3">Logout</button>
                    </form>
                </li>
            </ul>
        </div>

        <div class="content flex-grow-1 p-3">
            @yield('content')
        </div>
    </div>
</body>
</html>
