$(document).ready(function() {
    // Khởi tạo CKEditor 5
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [
                'heading', '|',
                'bold', 'italic', 'underline', 'link', '|',
                'bulletedList', 'numberedList', '|',
                'blockQuote', 'insertTable', '|',
                'undo', 'redo'
            ],
            placeholder: 'Nhập mô tả chi tiết...',
            link: {
                decorators: {
                    openInNewTab: {
                        mode: 'manual',
                        label: 'Mở liên kết trong tab mới',
                        attributes: {
                            target: '_blank',
                            rel: 'noopener noreferrer'
                        }
                    }
                }
            }
        })
        .then(editor => {
            console.log('CKEditor 5 đã được khởi tạo:', editor);
        })
        .catch(error => {
            console.error('Lỗi khi khởi tạo CKEditor:', error);
        });
});
