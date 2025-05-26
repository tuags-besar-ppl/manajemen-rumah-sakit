<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Perawat')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background: #eaf1fb;
        }
        .header-bar {
            width: 100%;
            height: 58px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 36px 0 0;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 200;
            padding-left: 270px;
        }
        .header-bar .header-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #222;
            letter-spacing: 0.5px;
            text-align: left;
            margin-left: 24px;
        }
        .header-bar .header-actions {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .notif-bell {
            width: 42px;
            height: 42px;
            font-size: 1.25rem;
            color: #2563eb;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-right: 0;
            position: relative;
            border: none;
            cursor: pointer;
            transition: box-shadow 0.2s;
            padding: 0;
        }
        .notif-bell:hover {
            box-shadow: 0 4px 16px rgba(30,64,175,0.13);
        }
        .notif-bell i {
            font-size: 1.35rem;
            color: #2563eb;
        }
        .notif-badge {
            position: absolute;
            top: 3px;
            right: 3px;
            background: #ef4444;
            color: #fff;
            font-size: 0.75rem;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #fff;
            font-weight: 600;
        }
        .header-bar .logout-btn {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 22px;
            font-size: 1rem;
            font-weight: 500;
            transition: background 0.2s;
            box-shadow: 0 2px 8px rgba(30,64,175,0.08);
        }
        .header-bar .logout-btn:hover {
            background: #1e40af;
            color: #fff;
        }
        .sidebar {
            background: linear-gradient(180deg, #2563eb 0%, #1e40af 100%);
            min-height: 100vh;
            width: 270px;
            padding: 40px 0 0 0;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 8px rgba(0,0,0,0.04);
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 201;
            border-radius: 0;
        }
        .sidebar .user-avatar {
            width: 70px;
            height: 70px;
            background: #fff;
            color: #2563eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            box-shadow: 0 2px 12px rgba(30,64,175,0.10);
            margin-bottom: 10px;
            margin-top: 8px;
            border: 4px solid #3b82f6;
        }
        .sidebar .user-info {
            text-align: center;
            margin-bottom: 28px;
        }
        .sidebar .user-info .user-name {
            color: #fff;
            font-size: 1.15rem;
            font-weight: 500;
            margin-bottom: 2px;
            letter-spacing: 0.2px;
        }
        .sidebar .user-info .user-role {
            color: #dbeafe;
            font-size: 0.98rem;
            font-weight: 400;
            margin-bottom: 0;
            letter-spacing: 0.2px;
        }
        .sidebar .menu {
            width: 85%;
            margin-bottom: 20px;
        }
        .sidebar .menu a {
            display: flex;
            align-items: center;
            gap: 14px;
            color: #fff;
            font-weight: 600;
            font-size: 1.15rem;
            text-decoration: none;
            margin: 18px 0;
            padding: 10px 18px;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }
        .sidebar .menu a.active, .sidebar .menu a:hover {
            background: #3b82f6;
            color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        .sidebar .menu i {
            font-size: 1.3rem;
        }
        .main-content {
            margin-left: 270px;
            padding: 98px 60px 40px 60px;
            min-height: 100vh;
            background: #eaf1fb;
            transition: all 0.2s;
        }
        /* Tambahan styling yang umum jika ada */
    </style>
    @yield('head')
</head>
<body>
    <div class="header-bar">
        <div class="header-title">Sistem Management Alat Rumah Sakit</div>
        <div class="header-actions">
            <form action="/logout" method="POST" style="margin-bottom:0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <div class="sidebar">
        <div class="user-avatar">
            <i class="fa-solid fa-user"></i>
        </div>
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
        </div>
        <div class="menu">
            <a href="{{ route('dashboard') }}" class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>
            <a href="{{ route('pelaporan-alat') }}" class="{{ Request::routeIs('pelaporan-alat') ? 'active' : '' }}">
                <i class="fa-solid fa-clipboard-list"></i> Pelaporan Alat
            </a>
            <a href="{{ route('pinjam-alat') }}" class="{{ Request::routeIs('pinjam-alat') ? 'active' : '' }}">
                <i class="fa-solid fa-hand-holding-medical"></i> Form Pinjam Alat
            </a>
        </div>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
