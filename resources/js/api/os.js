
export const getCustomerAddressOs = id => fetch(
    `/enderecos/${id}/os`,
    { headers: { 'Content-Type': 'application/json'} }
)
    .then(response => response.json());
