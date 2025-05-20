<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
            background: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            display: flex;
            width: 68vw;   /* dikurangi dari 90vw jadi 80vw */
            height: 68vh;  /* dikurangi dari 90vh jadi 80vh */
            max-width: 1200px;
            max-height: 700px;
            box-shadow: 0 4px 25px rgb(0 0 0 / 0.15);
            border-radius: 15px;
            overflow: hidden;
            background: white;
        }
        .login-image {
            flex: 1.2;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .login-image img {
            width: 95%;
            height: auto;
            object-fit: contain;
            user-select: none;
        }
        .login-form {
            flex: 0.8;
            background: linear-gradient(135deg,rgb(0, 115, 209),rgb(78, 175, 254));
            color: white;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
        }
        .login-form h2 {
            font-weight: 600;
            margin-bottom: 45px;
            text-align: center;
            letter-spacing: 3px;
            font-size: 1.8rem;
        }
        .form-control {
            border-radius: 30px;
            height: 45px;
            border: none;
            padding-left: 20px;
            font-size: 15px;
        }
        .form-control:focus {
            box-shadow: none;
            border: none;
        }
        .btn-submit {
            background: #4caf50;
            border: none;
            border-radius: 30px;
            font-weight: 700;
            letter-spacing: 3px;
            height: 45px;
            margin-top: 25px;
            transition: background 0.3s ease;
            font-size: 1rem;
        }
        .btn-submit:hover {
            background: #43a047;
        }
        .input-group {
            margin-bottom: 18px;
        }
        .alert-danger {
            border-radius: 10px;
            font-size: 14px;
        }
        @media (max-width: 768px) {
            .login-card {
                flex-direction: column;
                height: auto;
                width: 95vw;
            }
            .login-image, .login-form {
                flex: none;
                border-radius: 0;
                padding: 30px 20px;
            }
            .login-form {
                border-radius: 0 0 15px 15px;
                background: #2196f3;
            }
            .login-form h2 {
                font-size: 1.5rem;
                margin-bottom: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-card" role="main">
        <div class="login-image">
            <img src="{{ asset('uploads/login.png') }}" alt="Login Illustration" draggable="false" />
        </div>
        <div class="login-form">
        <h1 style="text-align: center; font-size: 3rem; margin-bottom: 30px;">Selamat Datang</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <input type="email" name="email" placeholder="Username" class="form-control" required autofocus />
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="••••••••" class="form-control" required />
                </div>
                <button type="submit" class="btn btn-submit w-100">SUBMIT</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
