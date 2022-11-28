import { searchAddress } from '../api/zipcode';

const selector = document.querySelector.bind(document);
const defaultFieldsAttributesMap = {
    cep: 'cep',
    logradouro: 'street',
    localidade: 'city',
    bairro: 'neighborhood',
    uf: 'state',
    complemento: 'complement',
}

/**
 * Returns a object where the keys are the input id and the values are a reference to DOM input element
 * e.g.: {
 *   street: <input id="street" name="street" type="text" value="">
 *   ...others entries
 * }
 */
const getFormInputs = (fieldsAttributesMap) => Object
    .values(fieldsAttributesMap)
    .reduce((acc, formInputId) => ({ ...acc, [formInputId]: selector(`#${formInputId}`)}) , {});

const setAddressValueInputs = (zipCodeResponse, formAddressInputs) => Object
    .entries(defaultFieldsAttributesMap)
    .forEach(([attributeName, inputId]) => {
        const inputElement = formAddressInputs[inputId];
        inputElement.value = zipCodeResponse[attributeName] ?? inputElement.value;
    });

const filler = formAddressInputs => async (value) => {
    if (!value) return;

    const zipCode = value.replace('-', '');
    const zipCodeResponse = await searchAddress(zipCode);

    setAddressValueInputs(zipCodeResponse, formAddressInputs);
}

const addressFiller = (fieldsAttributesMap = defaultFieldsAttributesMap) => {
    const inputs = getFormInputs(fieldsAttributesMap);
    return filler(inputs);
}

export default addressFiller;
