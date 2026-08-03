<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Tahoma, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            color: #333;
        }
        .email-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }
        .header {
            font-size: 20px;
            font-weight: bold;
            color: #2a9d8f;
            margin-bottom: 20px;
        }
        .content {
            font-size: 16px;
            line-height: 1.8;
        }
        .code {
            font-size: 18px;
            color: #e63946;
            font-weight: bold;
            margin-top: 10px;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            ایجاد آگهی
        </div>

        <div class="content">
            <p>کاربر {{ $user->name }} گرامی،</p>

            <p>آگهی <span style="color:#e63946; font: size 20px;">{{$title}}</span> با موفقیت ایجاد شد</p>

            <p class="content">پس از تایید تیم مدیریت آگهی نمایش داده خواهد شد</p>

            <div class="footer">
                این ایمیل به صورت خودکار ارسال شده است، لطفاً به آن پاسخ ندهید.<br>
                  سایت دیوار
            </div>
        </div>
    </div>
</body>
</html>
