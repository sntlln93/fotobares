const photoInput = document.getElementById("photo");

onPhotoSelected = () => {
    const photoPreview = document.getElementById("photo-preview");

    photoPreview.innerHTML = "";

    const image = new Image();
    image.src = URL.createObjectURL(photoInput.files[0]);
    image.className = "img-fluid";

    photoPreview.appendChild(image);

    document.querySelector("label[for=photo]").innerText =
        photoInput.files[0].name;
};

photoInput.addEventListener("change", onPhotoSelected);
