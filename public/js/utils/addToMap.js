const addToMap = ({ target }) => {
  const clientToAdd = target.dataset.mapModel;

  const clients = localStorage.getItem('clients')
    ? JSON.parse(localStorage.getItem('clients'))
    : [];

  if (!clients.find((client) => client === clientToAdd)) {
    localStorage.setItem('clients', JSON.stringify([...clients, clientToAdd]));
  }
};
