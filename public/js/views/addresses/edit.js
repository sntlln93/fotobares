//geolocalization
const locationFeedback = document.getElementById("locationFeedback");

success = (location) => {
    const coordinates = location.coords;
    const latInput = document.getElementById("latInput");
    const lonInput = document.getElementById("lonInput");

    locationFeedback.innerHTML =
        'Ubicación guardada con éxito <i class="fas fa-check-circle"></i>';
    locationFeedback.classList.add("text-success");
    latInput.value = coordinates.latitude;
    lonInput.value = coordinates.longitude;
};

error = (error) => {
    locationFeedback.innerHTML = `No se pudo guardar tu ubicación. <i class="fas fa-exclamation-circle"></i>`;
    locationFeedback.classList.add("text-danger");
    console.warn("ERROR(" + error.code + "): " + error.message);
};

saveCoordinates = (e) => {
    e.preventDefault();

    const options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0,
    };

    navigator.geolocation.getCurrentPosition(success, error, options);
};

const getLocationBtn = document.getElementById("btnLocation");
getLocationBtn.addEventListener("click", (e) => saveCoordinates(e));

//file input feedback
const housePhotoInput = document.getElementById("house_photo");
housePhotoInput.addEventListener("change", () => {
    const label = document.querySelector("label[for=photo]");
    console.log(housePhotoInput.files[0]);
    label.innerText = `${housePhotoInput.files.length} foto seleccionada`;
});
