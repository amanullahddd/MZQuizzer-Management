<script>
    document.addEventListener("DOMContentLoaded", function () {
    const imageRadios = document.querySelectorAll('input[name="image"]');
    const imageFile = document.getElementById("imageFile");
    const audioRadios = document.querySelectorAll('input[name="audio"]');
    const audioFile = document.getElementById("audioFile");

    const imagePreview = document.getElementById('imagePreview');
    const audioPreview = document.getElementById('audioPreview');

    imageRadios.forEach(radio => {
        radio.addEventListener("change", function () {
            if (this.value === "1") {
                imageFile.removeAttribute("disabled"); // Hapus atribut disabled
            } else {
                imageFile.setAttribute("disabled", "true"); // Tambahkan atribut disabled
                imageFile.value = ""; // Hapus file yang mungkin sudah dipilih sebelumnya
                imagePreview.src = '';
                imagePreview.style.display = 'none';
            }
        });
    });

    audioRadios.forEach(radio => {
        radio.addEventListener("change", function () {
            if (this.value === "1") {
                audioFile.removeAttribute("disabled"); // Hapus atribut disabled
            } else {
                audioFile.setAttribute("disabled", "true"); // Tambahkan atribut disabled
                audioFile.value = ""; // Hapus file yang mungkin sudah dipilih sebelumnya
                audioPreview.src = '';
                audioPreview.style.display = 'none';
            }
    });
});
});
</script>