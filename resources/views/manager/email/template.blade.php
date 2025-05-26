<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: #2563eb;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background: #fff;
            padding: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Sistem Management Alat Rumah Sakit</h2>
    </div>
    
    <div class="content">
        {!! nl2br(e($content)) !!}
    </div>
    
    <div class="footer">
        <p>Email ini dikirim dari Sistem Management Alat Rumah Sakit</p>
        <p>© {{ date('Y') }} Rumah Sakit.</p>
    </div>
</body>
</html> 