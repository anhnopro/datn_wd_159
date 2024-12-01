const priceInput = document.getElementById('price');

    priceInput.addEventListener('input', function (e) {
        let value = this.value.replace(/\D/g, ''); // Loại bỏ tất cả ký tự không phải số
        if (value) {
            value = parseInt(value).toLocaleString('vi-VN'); // Thêm dấu chấm phân cách theo định dạng Việt Nam
        }
        this.value = value;
    });

    priceInput.addEventListener('blur', function () {
        // Xóa khoảng trống khi mất focus
        this.value = this.value.trim();
    });
