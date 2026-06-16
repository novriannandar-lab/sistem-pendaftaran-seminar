// Validasi berkas upload pada sisi client-side
document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("bukti_transfer");
    const previewNameDisplay = document.getElementById("file-preview-name");

    if (fileInput) {
        fileInput.addEventListener("change", function () {
            if (this.files && this.files.length > 0) {
                const file = this.files[0];
                const fileSizeMB = file.size / (1024 * 1024);
                
                // Validasi ukuran berkas maksimal 2MB
                if (fileSizeMB > 2) {
                    alert("Gagal: Ukuran file bukti transfer melebihi batas 2 MB.");
                    this.value = ""; 
                    previewNameDisplay.textContent = "";
                    return;
                }

                // Munculkan nama berkas jika lolos validasi
                previewNameDisplay.textContent = "Berkas Siap di-Upload: " + file.name + " (" + fileSizeMB.toFixed(2) + " MB)";
            }
        });
    }
});