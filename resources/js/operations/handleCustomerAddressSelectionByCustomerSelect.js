import { isNumeric } from "alpinejs/src/utils";

import { getCustomerAddressesByCustomerId } from "../api/customerAddress";
import loadingBar from "../utils/loading-bar";

const handleCustomerAddressSelectionByCustomerSelect = (initialCustomerAddressSelectValue) => {
    const selector = document.querySelector.bind(document);
    const customerSelect = selector('#customer_id');
    const customerAddressSelect = selector('#customer_address_id');

    const disableCustomerAddressSelect = () => {
        customerAddressSelect.disabled = true;
        customerAddressSelect.innerHTML = '<option value="">Selecione um cliente.</option>';
    }

    const createCustomAddressOptions = (options) => {
        const initialOption = `<option value="">Selecione</option>`;
        const optionsTemplate = options
            .map(({id, street, address_number, neighborhood, city, state}) =>
                `<option value="${id}">${street}, ${address_number}, ${neighborhood}, ${city}, ${state}</option>`)

        customerAddressSelect.innerHTML = [initialOption, ...optionsTemplate].join(' ');
    }

    const fillCustomerAddressSelectOptions = async (customerId) => {
        if (!isNumeric(customerId)) return;

        loadingBar.show();

        const options = await getCustomerAddressesByCustomerId(customerId);
        createCustomAddressOptions(options);
        customerAddressSelect.disabled = false;

        loadingBar.hide();
    }

    const onChangeCustomerSelect = ({ target: { value }}) => {
        if (!value) {
            disableCustomerAddressSelect();
            return;
        }
        fillCustomerAddressSelectOptions(value);
    }

    customerSelect.addEventListener('change', onChangeCustomerSelect);

    if (customerSelect.value) {
        fillCustomerAddressSelectOptions(customerSelect.value)
            .then(() => {
                if (initialCustomerAddressSelectValue) {
                    customerAddressSelect.value = initialCustomerAddressSelectValue;
                    customerAddressSelect.dispatchEvent(new Event('change'));
                }
            });
    }
}

export default handleCustomerAddressSelectionByCustomerSelect;
