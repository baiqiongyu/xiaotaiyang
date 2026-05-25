<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
<body style="font-family:'Inter','PingFang SC',sans-serif;padding:24px;background:#fff8f5;">
    <div style="max-width:600px;margin:0 auto;background:#fff;border-radius:16px;padding:32px;border:1px solid #fce4e0;">
        <div style="font-size:28px;margin-bottom:16px;">☀️ 小太阳幼教站</div>
        <p style="font-size:16px;color:#4a3728;font-weight:600;">收到一条新留言</p>

        <table style="width:100%;font-size:14px;color:#4a3728;border-collapse:collapse;">
            <tr><td style="padding:8px 0;color:#8b6f5e;width:80px;">姓名</td><td style="padding:8px 0;">{{ $contact->name }}</td></tr>
            <tr><td style="padding:8px 0;color:#8b6f5e;">邮箱</td><td style="padding:8px 0;">{{ $contact->email }}</td></tr>
            <tr><td style="padding:8px 0;color:#8b6f5e;">电话</td><td style="padding:8px 0;">{{ $contact->phone ?? '-' }}</td></tr>
            <tr><td style="padding:8px 0;color:#8b6f5e;">主题</td><td style="padding:8px 0;">{{ $contact->subject }}</td></tr>
        </table>

        <div style="margin-top:16px;padding:16px;background:#fff8f5;border-radius:12px;font-size:14px;color:#4a3728;line-height:1.6;">
            {{ $contact->message }}
        </div>

        <p style="margin-top:24px;font-size:12px;color:#8b6f5e;">发送时间：{{ $contact->created_at }}</p>
    </div>
</body>
</html>
