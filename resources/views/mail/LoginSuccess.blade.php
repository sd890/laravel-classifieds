<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Tahoma, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            background-color: #ffffff;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .header {
            font-size: 22px;
            font-weight: bold;
            color: #264653;
            margin-bottom: 20px;
        }
        .message {
            font-size: 16px;
            line-height: 1.6;
        }
        .button {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 24px;
            background-color: #2a9d8f;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }
        .button:hover {
            background-color: #21867a;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            سلام {{ $user->name }},
        </div>

        <div class="message">
            <p>🎉 شما با موفقیت وارد حساب کاربری شدید.</p>
            <p>شما میتوانید از طریق لینک زیر وارد حساب کاربری شوید:</p>

            <a href="{{ url('/admin/profile/' . $user->id) }}" class="button">حساب کاربری</a>
        </div>
    </div>
</body>
</html>
