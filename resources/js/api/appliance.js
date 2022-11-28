

export const getCustomerAddressAppliance = id => fetch(
    `/enderecos/${id}/aparelhos`,
    { headers: { 'Content-Type': 'application/json'} }
)
    .then(response => response.json());
