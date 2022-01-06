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