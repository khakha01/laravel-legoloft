<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legoloft phản hồi mail</title>
</head>

<body>
    <h1>Chào bạn, {{ $contact->name }}</h1>
    <p>Chúng tôi đã tiếp nhận được phản hồi của bạn:</p>
    {{-- @php
    dd($messageK)
    @endphp --}}
    <p>{{ $messageK }}</p>
    <p>Cảm ơn bạn đã gửi liên hệ với chúng tôi. Nếu có thêm câu hỏi nào, đừng ngần ngại liên hệ lại!</p>
    <p>Trân trọng,</p>
    <p>Đội ngũ LegoLoft</p>
</body>

</html>
