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

//add phone row
createInputColumn = ({ className, value, disabled, id, name }) => {
    const column = document.createElement("td");
    const input = document.createElement("input");
    input.className = className;
    if (value) input.value = value;
    if (disabled) input.disabled = disabled;
    if (id) input.id = id;
    if (name) input.name = name;
    column.appendChild(input);

    return column;
};

createToggleSwitch = (index) => {
    const column = document.createElement("td");
    const div = document.createElement("div");

    div.className = "custom-control custom-switch h5";

    const toggleSwitch = document.createElement("input");
    toggleSwitch.className = "custom-control-input";
    toggleSwitch.id = `phones.${index}.has_whatsapp`;
    toggleSwitch.name = `phones[${index + 1}][has_whatsapp]`;
    toggleSwitch.type = "checkbox";

    div.appendChild(toggleSwitch);

    const labelSwitch = document.createElement("label");
    labelSwitch.innerText = "Sí";
    labelSwitch.className = "custom-control-label";
    labelSwitch.htmlFor = toggleSwitch.id;

    div.appendChild(labelSwitch);
    column.appendChild(div);

    return column;
};

createDeleteRowBtn = () => {
    const column = document.createElement("td");
    column.className = "text-center";

    const deleteRowButton = document.createElement("button");
    deleteRowButton.className = "btn btn-sm btn-danger deleteRowButton";
    deleteRowButton.innerHTML = '<i class="fas fa-trash"></i>';
    deleteRowButton.addEventListener("click", (event) =>
        onDeletePhoneRow(event)
    );

    column.appendChild(deleteRowButton);
    return column;
};

createPhoneRow = (phonesCount) => {
    const phoneRow = document.createElement("tr");

    phoneRow.appendChild(
        createInputColumn({
            value: "380",
            disabled: false,
            id: `phones.${phonesCount}.area_code`,
            className: "form-control",
            name: `phones[${phonesCount}][area_code]`,
        })
    );

    phoneRow.appendChild(
        createInputColumn({
            value: "",
            disabled: false,
            id: `phones.${phonesCount}.number`,
            className: "form-control",
            name: `phones[${phonesCount}][number]`,
        })
    );

    phoneRow.appendChild(createToggleSwitch(phonesCount));
    phoneRow.appendChild(createDeleteRowBtn());

    return phoneRow;
};

onAddPhone = (event) => {
    event.preventDefault();

    const phonesContainer = document.getElementById("phonesContainer");

    const newPhoneRow = createPhoneRow(phonesContainer.childElementCount);

    phonesContainer.appendChild(newPhoneRow);

    Array.from(document.querySelectorAll(".deleteRowButton")).forEach(
        (deleteBtn) => {
            deleteBtn.disabled = false;
        }
    );
};

reArrangingOrder = () => {
    Array.from(document.querySelectorAll(".order")).forEach(
        (orderInput, index) => (orderInput.value = index + 1)
    );
};

onDeletePhoneRow = (event) => {
    event.preventDefault();

    let parent = event.target.parentElement;

    while (parent.tagName != "TR") {
        parent = parent.parentElement;
    }

    parent.remove();
    reArrangingOrder();

    if (phonesContainer.childElementCount === 1) {
        document.querySelector(".deleteRowButton").disabled = true;
    }
};

document
    .getElementById("addPhone")
    .addEventListener("click", (event) => onAddPhone(event));
Array.from(document.querySelectorAll(".deleteRowButton")).forEach(
    (deleteBtn) => {
        deleteBtn.addEventListener("click", (event) => onDeletePhoneRow(event));
    }
);

//add total price calc based in what amount of quotas the user choose
const quotasContainer = document.getElementById("quota_id");

quotasContainer.addEventListener("change", (e) => {
    const option = e.target.options[e.target.selectedIndex];
    const quotas = parseInt(option.getAttribute("data-quota")) || 0;
    const price = parseFloat(option.getAttribute("data-price")) || 0;
    document.getElementById("total").value = price * quotas;
});

//fetch selected product's quotas
let BASE_URL = "";

const setBaseUrl = (url) => {
    BASE_URL = url;
};

getProducts = (productId, quotaId = null) => {
    fetch(`${BASE_URL}/sales/product/${productId}/quotas`)
        .then((response) => response.json())
        .then((quotas) => {
            quotasContainer.innerHTML = "<option></option>";

            quotas.forEach((quota) => {
                const option = document.createElement("option");
                option.value = quota.id;
                option.selected = quotaId === quota.id;
                option.setAttribute("data-quota", quota.quantity);
                option.setAttribute("data-price", quota.quota_amount);
                option.innerText = `${quota.quantity} cuotas | Valor de la cuota: ${quota.quota_amount}`;

                quotasContainer.appendChild(option);
            });

            quotasContainer.disabled = false;
        });
};

onProductChange = (event) => {
    const productId = event.target.value;
    getProducts(productId);
};

document
    .querySelectorAll(".products")
    .forEach((product) => product.addEventListener("change", onProductChange));

const housePhotoInput = document.getElementById("house_photo");

housePhotoInput.addEventListener("change", () => {
    const label = document.querySelector("label[for=photo]");
    const preview = document.querySelector(".img-fluid");
    const file = housePhotoInput.files[0];
    label.innerText = `${housePhotoInput.files.length} foto seleccionada`;

    const reader = new FileReader();

    reader.addEventListener(
        "load",
        function () {
            // convert image file to base64 string
            preview.src = reader.result;
            document.querySelector("input[name=house_photo]").value =
                reader.result;
        },
        false
    );

    if (file) {
        reader.readAsDataURL(file);
    }
});

onProductLoaded = () => {
    const products = document.querySelectorAll("input[name=product_id]");
    products.forEach((product) => {
        if (product.checked) getProducts(product.value, quotaId);
    });
};

window.onload = onProductLoaded;

const sellBtn = document.getElementById("sellBtn");
const toConfirmSaleBtn = document.getElementById("toConfirmSaleBtn");

const sellForm = document.getElementById("sellForm");
const toConfirmSaleForm = document.getElementById("toConfirmSaleForm");

sellBtn.addEventListener("click", () => {
    toConfirmSaleForm.classList.add("d-none");
    toConfirmSaleBtn.classList.remove("active");

    sellForm.classList.remove("d-none");
    sellBtn.classList.add("active");
});
toConfirmSaleBtn.addEventListener("click", () => {
    toConfirmSaleForm.classList.remove("d-none");
    toConfirmSaleBtn.classList.add("active");

    sellForm.classList.add("d-none");
    sellBtn.classList.remove("active");
});
