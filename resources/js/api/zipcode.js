const getZipCodeApiUrl = zipcode => `https://viacep.com.br/ws/${zipcode}/json/`;

export const searchAddress = value => fetch(
    getZipCodeApiUrl(value),
    { headers: { 'Content-Type': 'application/json'} }
)
    .then(response => response.json());
