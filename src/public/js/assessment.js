document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('comment');
    const charCount = document.getElementById('char-count');

    textarea.addEventListener('input', function () {
        const currentLength = textarea.value.length;
        const maxLength = textarea.getAttribute('maxlength') || 400;
        charCount.textContent = `${currentLength}/${maxLength} 最大文字数`;
    });

    const initialLength = textarea.value.length;
    const maxLength = textarea.getAttribute('maxlength') || 400;
    charCount.textContent = `${initialLength}/${maxLength} 最大文字数`;

    const fileInput = document.getElementById('image');
    const fileNameDisplay = document.getElementById('file-name');
    const imagePreview = document.getElementById('image-preview');
    const dropArea = document.querySelector('.drop-area');

    const displayFile = (file) => {
        if (file) {
            fileNameDisplay.textContent = file.name;

            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    };

    fileInput.addEventListener('change', () => displayFile(fileInput.files[0]));

    ['dragover', 'dragleave', 'drop'].forEach(event => {
        dropArea.addEventListener(event, (e) => {
            e.preventDefault();
            dropArea.classList.toggle('dragover', event === 'dragover');
            if (event === 'drop') {
                const file = e.dataTransfer.files[0];
                fileInput.files = e.dataTransfer.files;
                displayFile(file);
            }
        });
    });
});