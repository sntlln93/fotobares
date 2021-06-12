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
    console.warn(event.detail);
});
