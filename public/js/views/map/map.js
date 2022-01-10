const options = {
  center: { lat: -29.3832685, lng: -66.8146771 },
  zoom: 14,
  disableDefaultUI: true,
  styles: [
    {
      featureType: 'poi',
      stylers: [
        {
          visibility: 'off',
        },
      ],
    },
  ],
};

const renderClientInfo = (sale, clientInfo) => {
  const details = sale.details.reduce((acc, detail) => {
    acc += `<span class="badge badge-light border--transparent">
    ${detail.product.name} (${detail.description})
    <i class="fas fa-circle color-indicator" style="color: ${detail.color}; background-color: ${detail.color}"></i>
</span>`;
    return acc;
  }, '');

  const paymentsInfo = (payments) => {
    const paidCount = payments.filter((payment) => payment.paid_at).length;
    const nextPayment = payments.find((payment) => payment.paid_at === null);

    return `
      <p>
        <b>Pagado:</b>
        <span>${paidCount} de ${payments.length}</span>
      </p>
      <p>
        <b>Vencimiento:</b>
        <span>${getFormattedDate(nextPayment.due_date)}</span>
      </p>
      `;
  };
  const dates = sale.delivered_at
    ? paymentsInfo(sale.payments)
    : `<p>
      <b>Fecha de entrega:</b>
      <span>${getFormattedDate(sale.deliver_on)}</span>
    </p>`;

  const phones = sale.client.phones.reduce((acc, phone) => {
    acc += `<a class="btn btn-sm btn-success"
      href="${routes.whatsapp.replace(':phone', phone.id)}">
      <i class="fab fa-whatsapp"></i>
      </a>`;

    return acc;
  }, '');

  const isDelivery = sale.payments.every((payment) => payment.paid_at === null);

  /*
  MISSING BUTTONS (both are modals
    )

    this will toggle house photo visibility
  <button class="btn btn-sm btn-warning">
                <i class="fas fa-home"></i>
            </button>

            this will toggle product photo visibility and only will be shown on deliveries
  <button type="button" class="btn btn-sm btn-primary" data-open="modal"
                        data-target="#photo${ sale.id }"><i class="fas fa-image"></i></button>
  */

  clientInfo.innerHTML = `
    <button class="btn client__close"><i class="fas fa-times"></i></button>
    <div class="client__info">
        <div class="client__header">
            ${
              isDelivery
                ? `<button type="button" class="btn btn-sm btn-primary" data-open="modal" data-target=""><i
                  class="fas fa-image"></i></button>`
                : ''
            }
            
            ${phones}
            <a href="${routes.sales.recalculate.replace(
              ':sale',
              sale.id
            )}" class="btn btn-sm btn-dark"><i
                    class="fas fa-credit-card"></i></a>
            <a href="${routes.sales.show.replace(
              ':sale',
              sale.id
            )}" class="text-uppercase btn btn-sm btn-info"><i
                    class="fas fa-eye"></i> Ver</a>
            <button class="btn btn-sm border--transparent" data-remove="clients" data-map-model="${
              sale.client.id
            }"><i class="fas fa-trash"></i></button>
        </div>

        <div class="client__content">
            <div class="client__house">
            <img src="${routes.images.replace(
              ':path',
              sale.client.address.photo
            )}" alt="${sale.client.name}" class="client__avatar">
            </div>
            <p>
                <b>Cliente:</b>
                ${sale.client.full_name}
            </p>
            <p>
                <b>Producto:</b>
                ${details}
            </p>
            <p>
                <b>Dirección:</b>
                <span>${sale.client.address.formatted_address}</span>
            </p>
            ${dates}
        </div>
        <a class="w-100 btn btn-primary"
          href="${routes.sales.collect.replace(':sale', sale.id)}">
          ${sale.delivered_at ? 'Cobrar' : 'Entregar'}
        </a>
        </div>`;

  document.body.appendChild(clientInfo);
};

const openClientInfo = (client) => {
  let clientInfo =
    document.querySelector('.client') ?? document.createElement('div');
  clientInfo.classList = 'client';

  fetch(`${BASE_URL}/map/client/${client.id}`)
    .then((response) => response.json())
    .then((sale) => renderClientInfo(sale, clientInfo))
    .catch((error) => {
      console.error(error);
    });
};

const drawClients = (clients, map) => {
  clients.forEach((client) => {
    const clientCoords = {
      lat: parseFloat(client.address.lat),
      lng: parseFloat(client.address.lon),
    };

    clientMarker = new google.maps.Marker({
      position: clientCoords,
      map: map,
    });

    clientMarker.setIcon(`../../../images/map_markers/client_marker.png`);
    clientMarker.addListener('click', () => {
      map.setCenter(clientMarker.getPosition());
      map.setZoom(16);
      openClientInfo(client);
    });
  });
};

function initMap(clients) {
  const mapContainer = document.getElementById('map');
  mapContainer.innerHTML = '';
  if (!navigator.geolocation) {
    mapContainer.innerHTML =
      'Servicios de geolocalización no soportados por tu navegador';
    return;
  }

  map = new google.maps.Map(mapContainer, options);

  userMarker = new google.maps.Marker({
    position: options.center,
    map: map,
  }).setIcon('../../../images/map_markers/user_marker.png');

  clients && drawClients(clients, map);
}

document.addEventListener('click', (event) => {
  const target = event.target;

  if (target.classList.contains('client__close')) {
    target.parentElement.remove();
  } else if (target.hasAttribute('data-remove')) {
    const clientToRemove = target.dataset.mapModel;

    const clients = JSON.parse(localStorage.getItem('clients'));
    if (!clients) return;

    const newClients = clients.filter((client) => client !== clientToRemove);

    localStorage.setItem('clients', JSON.stringify(newClients));

    document.querySelector('.client').remove();

    fetch(`${BASE_URL}/map/?clients=${localStorage.getItem('clients')}`)
      .then((response) => response.json())
      .then((clients) => initMap(clients))
      .catch((error) => console.error(error));
  }
});
