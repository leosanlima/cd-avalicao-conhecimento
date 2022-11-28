

export const getCustomerAddressesByCustomerId = id => fetch(
    `/clientes/${id}/enderecos`,
    { headers: { 'Content-Type': 'application/json'} }
)
    .then(response => response.json());
