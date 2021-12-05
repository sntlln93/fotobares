const quotas = document.getElementById('quotas');

const onQuotasChange = () => {
  const tbody = document.querySelector('tbody');
  tbody.innerHTML = '';

  for (let i = 0; i < quotas.value; i++) {
    const tr = document.createElement('tr');

    const quantityColumn = document.createElement('td');
    const quantityInput = document.createElement('input');
    quantityInput.className = 'form-control';
    quantityInput.name = `quotas[${i}][quantity]`;
    quantityInput.value = i + 1;
    quantityInput.readOnly = true;
    quantityColumn.appendChild(quantityInput);
    tr.appendChild(quantityColumn);

    const amountColumn = document.createElement('td');
    const amountInput = document.createElement('input');
    amountInput.className = 'form-control';
    amountInput.name = `quotas[${i}][quota_amount]`;
    amountColumn.appendChild(amountInput);
    tr.appendChild(amountColumn);

    tbody.appendChild(tr);
  }
};

quotas.addEventListener('change', onQuotasChange);

// color pickers
document.getElementById('addColorPicker').addEventListener('click', (event) => {
  event.preventDefault();

  const colorPickerRow = document.querySelector('.form-row.color-picker--row');
  const colorPicker = document.createElement('input');
  colorPicker.setAttribute('type', 'color');
  colorPicker.setAttribute('class', 'form-control color-picker');
  colorPicker.setAttribute('name', 'colors[]');
  colorPicker.setAttribute('value', '#000000');
  colorPickerRow.insertBefore(colorPicker, event.target);
});

document
  .getElementById('removeColorPicker')
  .addEventListener('click', (event) => {
    event.preventDefault();

    const colorPickerRow = document.querySelector(
      '.form-row.color-picker--row'
    );
    if (colorPickerRow.children.length <= 3) return;

    const toRemove =
      colorPickerRow.children[colorPickerRow.children.length - 3];
    colorPickerRow.removeChild(toRemove);
  });
