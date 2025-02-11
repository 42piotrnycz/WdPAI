function updateImagePreview(input) {
    const file = input.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = e.target.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    }
}