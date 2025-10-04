<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Forum Blog')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: row;
        }
        .sidebar {
            min-width: 220px;
            max-width: 220px;
            background: #343a40;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            flex: 1;
            padding: 20px;
        }

        /* Post images */
        img.post-image {
            max-width: 100%;
            height: auto;
        }

        /* Responsive Comment Boxes */
        textarea.form-control {
            resize: vertical;
            font-size: 0.9rem;
            padding: 4px;
        }

        @media(max-width: 768px) {
            body {
                flex-direction: column;
            }
            .sidebar {
                min-width: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h3 class="text-center py-3">Admin</h3>
    <a href="{{ route('admin.posts.index') }}">Posts</a>
    <a href="{{ route('admin.comments.index') }}">Comments</a>
    <a href="{{ route('logout') }}" 
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
       Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>

<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
