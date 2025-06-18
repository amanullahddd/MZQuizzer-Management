<script>
    function previewFile(input, previewElementId) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imagePreview = document.getElementById(previewElementId);
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
</script>

<script>
    document.getElementById('audioFile').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const audioPreview = document.getElementById('audioPreview');
            const objectURL = URL.createObjectURL(file);
            audioPreview.src = objectURL;
            audioPreview.style.display = 'block';
        }
    });
</script>