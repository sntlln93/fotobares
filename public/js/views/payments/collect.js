const collectPaymentButton = document.getElementById("collectPaymentButton");
const postponePaymentButton = document.getElementById("postponePaymentButton");

onTabClicked = () => {
    const collectPaymentForm = document.getElementById("collectPaymentForm");
    const postponePaymentForm = document.getElementById("postponePaymentForm");

    collectPaymentForm.classList.toggle("d-none");
    postponePaymentForm.classList.toggle("d-none");

    collectPaymentButton.classList.toggle("active");
    postponePaymentButton.classList.toggle("active");
};

collectPaymentButton.addEventListener("click", onTabClicked);
postponePaymentButton.addEventListener("click", onTabClicked);
