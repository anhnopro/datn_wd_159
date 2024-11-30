<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hủy yêu cầu đặt phòng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Hủy yêu cầu đặt phòng</h2>
            </div>
            <div class="card-body">
                <h4 class="card-title">Xin chào <strong>{{ $booking->username }}</strong>,</h4>
                <p class="card-text">
                    Yêu cầu đặt phòng của bạn cho phòng <strong>{{ $booking->room->name }}</strong> vào ngày
                    <strong>{{ $booking->created_at }}</strong>
                    <span class="text-danger">đã bị hủy</span>.
                </p>
                <div class="alert alert-danger">
                    <p>Lí do hủy: {{$booking->cancel_reason}}</p>
                </div>
                <div class="alert alert-danger">
                    <p>Rất tiếc, phòng đã không thể được xác nhận.</p>
                </div>
                
                <p>Trân trọng,<br>
                    <strong>Đội ngũ Friendly Motel!</strong>
                </p>
            </div>
            <div class="card-footer text-center text-muted">
                <small>Email tự động. Vui lòng không trả lời email này.</small>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
