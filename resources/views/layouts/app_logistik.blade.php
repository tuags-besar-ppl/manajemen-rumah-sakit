<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Perawat')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    @vite('resources/css/app.css')
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
        /* Notification Styles */
        .notification-item {
            padding: 16px;
            border-bottom: 1px solid #e5e7eb;
            transition: background 0.2s;
        }

        .notification-item:hover {
            background: #f9fafb;
        }

        .notification-item.unread {
            background: #eff6ff;
        }

        .notification-item.unread:hover {
            background: #dbeafe;
        }

        .notification-subject {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
        }

        .notification-message {
            color: #4b5563;
            font-size: 0.875rem;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .notification-time {
            color: #6b7280;
            font-size: 0.75rem;
        }

        .mark-read-btn {
            color: #2563eb;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.875rem;
            transition: background 0.2s;
        }

        .mark-read-btn:hover {
            background: #eff6ff;
        }
    </style>
    @yield('head')
</head>
<body>
    <div class="header-bar">
        <div class="header-title">Sistem Management Alat Rumah Sakit</div>
        <div class="header-actions">
            @if(in_array(auth()->user()->role, ['perawat', 'logistik']))
                <button id="notifButton" class="notif-bell" onclick="toggleNotifications()">
                    <i class="fa-solid fa-envelope"></i>
                    <span id="unreadCount" class="notif-badge" style="display: none;">0</span>
                </button>
                <!-- Notification Panel -->
                <div id="notifPanel" class="notification-panel" style="display: none; position: absolute; top: 60px; right: 120px; width: 380px; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); z-index: 1000;">
                    <div style="padding: 16px; border-bottom: 1px solid #e5e7eb;">
                        <h3 style="font-size: 1.1rem; font-weight: 600; color: #1f2937;">Notifikasi Email</h3>
                    </div>
                    <div id="notifList" style="max-height: 400px; overflow-y: auto;">
                        <!-- Notifications will be inserted here -->
                    </div>
                    <div style="padding: 12px; border-top: 1px solid #e5e7eb; background: #f9fafb; border-radius: 0 0 12px 12px;">
                        <button onclick="markAllAsRead()" 
                                style="width: 100%; text-align: center; color: #2563eb; font-size: 0.875rem; padding: 6px; border-radius: 6px; transition: background 0.2s;"
                                onmouseover="this.style.background='#f3f4f6'"
                                onmouseout="this.style.background='transparent'">
                            Tandai semua telah dibaca
                        </button>
                    </div>
                </div>
            @endif
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
        </div>
    </div>

    <!-- Email Notification Component -->
    <div id="emailNotifications" class="fixed top-4 right-4 z-50">
        @if(auth()->user() && in_array(auth()->user()->role, ['perawat', 'logistik']))
            <div class="relative">
                <button id="notifButton" 
                        onclick="toggleNotifications()"
                        class="bg-white p-2 rounded-full shadow-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-envelope text-gray-600"></i>
                    <span id="unreadCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                        0
                    </span>
                </button>

                <div id="notifPanel" 
                     class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200">
                    <div class="p-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Notifikasi Email</h3>
                    </div>
                    <div id="notifList" class="max-h-96 overflow-y-auto">
                        <!-- Notifications will be inserted here -->
                    </div>
                    <div class="p-4 border-t border-gray-200 bg-gray-50">
                        <button onclick="markAllAsRead()" 
                                class="w-full text-center text-sm text-blue-600 hover:text-blue-800">
                            Tandai semua telah dibaca
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    <script>
        let notifications = [];
        let unreadCount = 0;

        function toggleNotifications() {
            const panel = document.getElementById('notifPanel');
            panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
        }

        function formatTime(timestamp) {
            const date = new Date(timestamp);
            return date.toLocaleString('id-ID', { 
                day: 'numeric',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function renderNotifications() {
            const notifList = document.getElementById('notifList');
            const unreadCountElement = document.getElementById('unreadCount');
            
            if (notifications.length === 0) {
                notifList.innerHTML = `
                    <div style="padding: 24px 16px; text-align: center; color: #6b7280;">
                        Tidak ada notifikasi
                    </div>
                `;
            } else {
                notifList.innerHTML = notifications.map(notif => `
                    <div class="notification-item ${notif.read ? '' : 'unread'}">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div style="flex: 1;">
                                <div class="notification-subject">${notif.subject}</div>
                                <div class="notification-message">${notif.message}</div>
                                <div class="notification-time">${formatTime(notif.created_at)}</div>
                            </div>
                            ${!notif.read ? `
                                <button onclick="markAsRead('${notif.id}')" class="mark-read-btn">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            ` : ''}
                        </div>
                    </div>
                `).join('');
            }

            unreadCountElement.textContent = unreadCount;
            unreadCountElement.style.display = unreadCount > 0 ? 'flex' : 'none';
        }

        function markAsRead(notifId) {
            fetch(`/notifications/${notifId}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                if (response.ok) {
                    const notif = notifications.find(n => n.id === notifId);
                    if (notif && !notif.read) {
                        notif.read = true;
                        unreadCount--;
                        renderNotifications();
                    }
                }
            });
        }

        function markAllAsRead() {
            fetch('/notifications/mark-all-as-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                if (response.ok) {
                    notifications.forEach(notif => {
                        if (!notif.read) {
                            notif.read = true;
                        }
                    });
                    unreadCount = 0;
                    renderNotifications();
                }
            });
        }

        function pollNotifications() {
            fetch('/notifications')
                .then(response => response.json())
                .then(data => {
                    notifications = data.notifications;
                    unreadCount = data.unread_count;
                    renderNotifications();
                });
        }

        // Mulai polling setiap 30 detik
        pollNotifications();
        setInterval(pollNotifications, 30000);

        // Tutup panel notifikasi ketika klik di luar
        document.addEventListener('click', (event) => {
            const panel = document.getElementById('notifPanel');
            const button = document.getElementById('notifButton');
            if (panel && button && !panel.contains(event.target) && !button.contains(event.target)) {
                panel.style.display = 'none';
            }
        });
    </script>
</body>
</html>
