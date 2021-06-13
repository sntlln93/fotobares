//stepper
const stepperEl = document.querySelector(".bs-stepper");
var stepper = new Stepper(stepperEl, {
    linear: false,
    animation: true,
    selectors: {
        steps: ".step",
        trigger: ".step-trigger",
        stepper: ".bs-stepper",
    },
});

const nextStepBtn = document.getElementById("next-step");
const prevStepBtn = document.getElementById("prev-step");
const submitBtn = document.getElementById("submit");

nextStepBtn.addEventListener("click", (e) => {
    e.preventDefault();
    stepper.next();
});

prevStepBtn.addEventListener("click", (e) => {
    e.preventDefault();
    stepper.previous();
});

stepperEl.addEventListener("show.bs-stepper", function (event) {
    if (event.detail.indexStep + 1 === 5) {
        submitBtn.classList.remove("d-none");
        nextStepBtn.classList.add("d-none");
    } else {
        submitBtn.classList.add("d-none");
        nextStepBtn.classList.remove("d-none");
    }
});

//geolocalization
const locationFeedback = document.getElementById("locationFeedback");

const success = (location) => {
    const coordinates = location.coords;
    const latInput = document.getElementById("latInput");
    const lonInput = document.getElementById("lonInput");

    locationFeedback.innerHTML =
        'Ubicación guardada con éxito <i class="fas fa-check-circle"></i>';
    locationFeedback.classList.add("text-success");
    latInput.value = coordinates.latitude;
    lonInput.value = coordinates.longitude;
};

const error = (error) => {
    locationFeedback.innerHTML = `No se pudo guardar tu ubicación. <i class="fas fa-exclamation-circle"></i>`;
    locationFeedback.classList.add("text-danger");
    console.warn("ERROR(" + error.code + "): " + error.message);
};

const saveCoordinates = (e) => {
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
