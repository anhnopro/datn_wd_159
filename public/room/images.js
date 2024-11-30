$(document).ready(function() {

    // Hiển thị hình ảnh mới được chọn
    document.getElementById('images').addEventListener('change', function(event) {
        const previewContainer = document.getElementById('preview-images');
        previewContainer.innerHTML = ''; // Xóa ảnh cũ
        const files = event.target.files;

        if (files.length > 0) {
            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const col = document.createElement('div');
                        col.classList.add('col-md-3');
                        col.innerHTML = `
                            <div class="card shadow-sm">
                                <img src="${e.target.result}" class="card-img-top" alt="Hình ảnh ${index + 1}">
                                <div class="card-body text-center">
                                    <p class="small mb-0 text-truncate">${file.name}</p>
                                </div>
                            </div>
                        `;
                        previewContainer.appendChild(col);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });


});
