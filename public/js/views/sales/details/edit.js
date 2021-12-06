const renderProducts = (products, oldProduct) => {
  const productsContainer = document.getElementById('products');
  productsContainer.innerHTML = '';
  productsContainer.style.gap = '0.5rem';
  productsContainer.classList = 'd-flex';

  products.forEach((product) => {
    const productElement = document.createElement('div');

    const price = Intl.NumberFormat('es-AR', {
      style: 'currency',
      currency: 'ARS',
    }).format(product.quotas[0].quota_amount);

    const checked = oldProduct == product.id ? 'checked' : false;
    checked && renderAll(product);

    productElement.innerHTML = `
          <input type="radio" class="d-none products" name="product_d" id="product.${product.id}" value="${product.id}" ${checked}>
          <label for="product.${product.id}" class="radio--container">
          <p class="my-1 radio--title">
              <strong>${product.name}</strong>
          </p>
          <p class="my-1 radio--info">${price}</p>
          </label>
          `;

    productElement.addEventListener('change', onProductChange);
    productsContainer.appendChild(productElement);
  });
};

const renderColorPicker = (colors) => {
  const oldColor = oldInput.color ? oldInput.color : currentDetail.color;

  const colorPickerContainer = document.getElementById('colors');
  const colorPickerContainerParent = document.getElementById('color-picker');

  colorPickerContainer.style.gap = '0.5rem';
  colorPickerContainerParent.classList.remove('d-none');
  colorPickerContainer.innerHTML = '';

  colors.forEach((color, index) => {
    const checked = oldColor == color ? 'checked' : false;

    const colorElement = document.createElement('div');
    colorElement.innerHTML = `
          <input type="radio" class="d-none" name="color" id="color.${index}" value="${color}" ${checked}>
          <label class="text-white radio--container" for="color.${index}"
              style="background-color: ${color}">
          </label>
          `;

    colorPickerContainer.appendChild(colorElement);
  });
};

const renderAll = (product) => {
  renderColorPicker(product.colors);
};

onProductChange = (event) => {
  const product = products.find((product) => product.id == event.target.value);
  renderAll(product);
};

window.addEventListener('load', () => {
  renderProducts(products, oldInput.product_id || currentDetail.product_id);
});
