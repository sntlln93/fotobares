const addToMap = ({ target }) => {
  const clientToAdd = {
    id: parseInt(target.dataset.mapModel),
    type: target.dataset.mapAdd,
  };

  const clients = localStorage.getItem('clients')
    ? JSON.parse(localStorage.getItem('clients'))
    : [];

  if (!clients.find((client) => client.id === clientToAdd.id)) {
    localStorage.setItem('clients', JSON.stringify([...clients, clientToAdd]));
  }
};

setClientContent = (client) => {
  const container = document.createElement('div');

  const heading = document.createElement('h4');
  heading.className = 'h4 text-gray-800';
  heading.innerText = client.name;
  container.appendChild(heading);

  if (client.address.photo) {
    const addressImg = document.createElement('img');
    addressImg.src = `${BASE_URL}/storage/${client.address.photo}`;
    addressImg.style.width = '200px';
    addressImg.style.height = '100px';
    addressImg.style.objectFit = 'contain';
    container.appendChild(addressImg);
  }

  const addressTitle = document.createElement('p');
  addressTitle.className = 'mb-0 font-weight-bold';
  addressTitle.innerText = 'Dirección';
  container.appendChild(addressTitle);

  const addressInfo = document.createElement('span');
  addressInfo.innerText = `${client.address.street} al ${client.address.number}`;
  container.appendChild(addressInfo);

  if (client.address.indications) {
    const indicationsTitle = document.createElement('p');
    indicationsTitle.className = 'mb-0 font-weight-bold';
    indicationsTitle.innerText = 'Indicaciones';
    container.appendChild(indicationsTitle);

    const indicationsInfo = document.createElement('span');
    indicationsInfo.innerText = client.address.indications;
    container.appendChild(indicationsInfo);
  }

  const actionsContainer = document.createElement('div');

  const collecBtn = document.createElement('a');
  collecBtn.className = 'btn btn-sm btn-primary my-2';
  collecBtn.href = `${BASE_URL}/payments/${client.sale_id}`;
  collecBtn.innerHTML = '<i class="fas fa-dollar-sign mr-1"></i> Cobrar';
  actionsContainer.appendChild(collecBtn);
  container.appendChild(actionsContainer);

  return container;
};

initMap = () => {
  let mapContainer = document.getElementById('map');

  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition((position) => {
      let options = {
        zoom: 16,
        center: {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        },
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

      //initialize a map
      let map = new google.maps.Map(mapContainer, options);

      //initialize user marker
      let userMarker = new google.maps.Marker({
        position: {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        },
        map: map,
      });
      userMarker.setIcon('../../../images/map_markers/user_marker.png');

      clients.forEach((client) => {
        let clientMarker = new google.maps.Marker({
          position: {
            lat: client.address.lat,
            lng: client.address.lon,
          },
          map: map,
        });
        clientMarker.setIcon('../../../images/map_markers/client_marker.png');

        //initialize a tooltip for a marker
        let clientInfoWindow = new google.maps.InfoWindow({
          content: setClientContent({
            id: client.id,
            name: client.name,
            sale_id: client.sale_id,
            address: {
              street: client.address.street,
              number: client.address.number ?? 'S/N',
              indications: client.address.indications,
              photo: client.address.photo,
            },
          }),
        });

        clientMarker.addListener('click', () => {
          clientInfoWindow.open(map, clientMarker);
        });
      });
    });
  } else {
    mapContainer.innerHTML =
      'Servicios de geolocalización no soportados por tu navegador';
  }
};
