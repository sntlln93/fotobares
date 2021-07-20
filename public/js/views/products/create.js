const quotas = document.getElementById('quotas');

const onQuotasChange = () => {
    const tbody = document.querySelector('tbody');
    tbody.innerHTML = "";
    
    for(let i = 0; i < quotas.value; i++) {
        const tr = document.createElement('tr');
        
        const quantityColumn = document.createElement('td');
        const quantityInput = document.createElement('input');
        quantityInput.className = "form-control";
        quantityInput.name = `quotas[${i}][quantity]`;
        quantityInput.value = i + 1;
        quantityInput.readOnly = true;
        quantityColumn.appendChild(quantityInput);
        tr.appendChild(quantityColumn);

        const amountColumn = document.createElement('td');
        const amountInput = document.createElement('input');
        amountInput.className = "form-control";
        amountInput.name = `quotas[${i}][quota_amount]`;
        amountColumn.appendChild(amountInput);
        tr.appendChild(amountColumn);

        tbody.appendChild(tr);
    }
}

quotas.addEventListener('change', onQuotasChange);