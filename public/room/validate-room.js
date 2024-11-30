document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    // Biến cho các trường input
    const nameInput = document.querySelector('input[name="name"]');
    const nameError = document.querySelector('#name-error');



    const serviceInput = document.querySelector('select[name="service_id"]');
    const serviceError = document.querySelector('#service-error');

    const priceInput = document.querySelector('input[name="price"]');
    const priceError = document.querySelector('#price-error');

    const addressInput = document.querySelector('input[name="address"]');
    const addressError = document.querySelector('#address-error');

    const imagesInput = document.querySelector('#images');
    const imagesError = document.querySelector('#images-error');

    const descriptionInput = document.querySelector('textarea[name="description"]');
    const descriptionError = document.querySelector('#description-error');

    // Hàm validate
    function validateNameRoom() {
        nameInput.value = nameInput.value.trim();
        if (nameInput.value === '') {
            nameError.textContent = 'Bạn phải nhập tên phòng trọ';
            nameError.style.display = 'block';
        } else {
            nameError.style.display = 'none';
        }
    }



    function validateService() {
        if (serviceInput.value === '') {
            serviceError.textContent = 'Bạn phải chọn dịch vụ';
            serviceError.style.display = 'block';
        } else {
            serviceError.style.display = 'none';
        }
    }

    function validatePrice() {
        if (priceInput.value === '' || isNaN(priceInput.value) || priceInput.value <= 0) {
            priceError.textContent = 'Giá phải là số dương';
            priceError.style.display = 'block';
        } else {
            priceError.style.display = 'none';
        }
    }

    function validateAddress() {
        addressInput.value = addressInput.value.trim();
        if (addressInput.value === '') {
            addressError.textContent = 'Bạn phải nhập địa chỉ';
            addressError.style.display = 'block';
        } else {
            addressError.style.display = 'none';
        }
    }

    function validateImages() {
        if (imagesInput.files.length === 0) {
            imagesError.textContent = 'Bạn phải chọn ít nhất một hình ảnh';
            imagesError.style.display = 'block';
        } else {
            imagesError.style.display = 'none';
        }
    }

    function validateDescription() {
        const descriptionValue = descriptionInput.value.trim();
        if (descriptionValue === '') {
            descriptionError.textContent = 'Bạn phải nhập mô tả';
            descriptionError.style.display = 'block';
        } else {
            descriptionError.style.display = 'none';
        }
    }

    // Thêm sự kiện validate
    nameInput.addEventListener('blur', validateNameRoom);
    serviceInput.addEventListener('blur', validateService);
    priceInput.addEventListener('blur', validatePrice);
    addressInput.addEventListener('blur', validateAddress);
    imagesInput.addEventListener('change', validateImages);
    descriptionInput.addEventListener('blur', validateDescription);

    // Validate toàn bộ form khi submit
    form.addEventListener('submit', function (event) {
        validateNameRoom();
        validateService();
        validatePrice();
        validateAddress();
        validateImages();
        validateDescription();

        if (
            nameError.style.display === 'block' ||
            serviceError.style.display === 'block' ||
            priceError.style.display === 'block' ||
            addressError.style.display === 'block' ||
            imagesError.style.display === 'block' ||
            descriptionError.style.display === 'block'
        ) {
            event.preventDefault(); // Ngăn không cho form gửi nếu có lỗi
        }
    });
});
