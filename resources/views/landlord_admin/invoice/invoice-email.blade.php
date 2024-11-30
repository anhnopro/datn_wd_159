<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn tiền trọ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-box {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            max-width: 700px;
            margin: auto;
            background-color: #f9f9f9;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            color: #333;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .total-amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #d9534f;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <!-- Header -->
        <div class="invoice-header">
            <h2>HÓA ĐƠN TIỀN TRỌ</h2>
            <p>Ngày: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
        <hr>

        <!-- Thông tin khách hàng -->
        <div class="section-title">Thông tin khách hàng</div>
        <p><strong>Khách hàng:</strong> {{ $booking->username }}</p>
        <p><strong>Email:</strong> {{ $booking->email }}</p>
        <p><strong>Số điện thoại:</strong> {{ $booking->phonenumber }}</p>

        <!-- Thông tin phòng -->
        <div class="section-title">Thông tin phòng</div>
        <p><strong>Tên phòng:</strong> {{ $room->name }}</p>
        <p><strong>Giá tiền phòng:</strong> {{ number_format($room->price) }} VND</p>
        <p><strong>Dịch vụ:</strong> {{ $room->service->service_type }}</p>
        <p><strong>Diện tích:</strong> {{ $room->area }} m²</p>

        <!-- Thông tin sử dụng -->
        <div class="section-title">Thông tin sử dụng</div>
        <p><strong>Số điện:</strong> {{ $electricity }} kWh</p>
        <p><strong>Tiền điện:</strong> {{ number_format($electricity * 3500) }} VND</p>
        <p><strong>Số nước:</strong> {{ $water }} m³</p>
        <p><strong>Tiền nước:</strong> {{ number_format($water * 15000) }} VND</p>

        <!-- Tổng cộng -->
        <div class="section-title">Tổng cộng</div>
        <div class="total-amount">
            {{ number_format($totalPrice) }} VND
        </div>
    </div>
</body>
</html>
