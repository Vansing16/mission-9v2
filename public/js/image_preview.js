document.addEventListener('DOMContentLoaded', function() {
    function previewImage(event) {
        var reader = new FileReader();
        var imageField = document.getElementById('imagePreview');
        imageField.style.display = 'block';

        reader.onload = function() {
            if (reader.readyState == 2) {
                imageField.src = reader.result;
            }
        }

        reader.readAsDataURL(event.target.files[0]);
    }

    // Attach the previewImage function to the change event of the file input
    var fileInput = document.getElementById('image');
    if (fileInput) {
        fileInput.addEventListener('change', previewImage);
    } else {
        console.error('No file input element with ID "image" found.');
    }
});
