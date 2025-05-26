<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Manajemen Rumah Sakit') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: rgba(255, 255, 255, .75);
            padding: .75rem 1rem;
            margin: 0 .5rem;
            border-radius: .5rem;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .1);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, .2);
        }

        .sidebar .nav-link i {
            margin-right: .5rem;
            width: 1.25rem;
            text-align: center;
        }

        .navbar {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            background: white;
        }

        main {
            padding-top: 1.5rem;
        }

        .card {
            border-radius: .75rem;
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        .btn {
            border-radius: .5rem;
            padding: .5rem 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .form-control, .form-select {
            border-radius: .5rem;
            padding: .5rem 1rem;
        }

        .table th {
            font-weight: 600;
            color: #4a5568;
        }

        .badge {
            padding: .5em .75em;
            font-weight: 500;
        }

        .alert {
            border-radius: .75rem;
            border: none;
        }

        .dropdown-menu {
            border-radius: .5rem;
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 767.98px) {
            .sidebar {
                position: static;
                padding: 1rem 0;
                margin-bottom: 1rem;
            }
        }
    </style>

    @stack('styles')
</head>
</rewritten_file> 