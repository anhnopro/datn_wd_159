function formatPrice(input) {
    // Loại bỏ các ký tự không phải số
    let value = input.value.replace(/\D/g, '');

    // Định dạng số với dấu chấm phân cách
    input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

// Đồng bộ giá trị không định dạng vào input ẩn
function syncHiddenInput() {
    const formattedInput = document.getElementById('formatted-price');
    const hiddenInput = document.getElementById('price');

    // Loại bỏ các dấu chấm từ giá trị định dạng
    hiddenInput.value = formattedInput.value.replace(/\./g, '');
}
