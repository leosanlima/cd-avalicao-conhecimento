import loadingBar from "../utils/loading-bar";

import { getCustomerAddressOs } from "../api/os";

const handleCustomerAddressOsSelection = (initialCustomerAddressSelectValue, config) => {
    const selector = document.querySelector.bind(document);
    const customerAddressSelect = selector('#customer_address_id');
    const osSelect = selector('#oss_id');

    const disableOsSection = () => {
        osSelect.disabled = true;
        osSelect.innerHTML = '<option value="">Selecione uma OS.</option>';
    }

    const createOsOptions = (options) => {
        const initialOption = ``;
        const optionsTemplate = options
            .map(({id, title, status}) =>
                `<option value="${id}"
                ${
                    initialCustomerAddressSelectValue?.find(el => el == id) ?
                    'selected' :
                    ''
                }
                >
                    ${title}
                </option>`)

        osSelect.innerHTML = [initialOption, ...optionsTemplate].join(' ');
    }

    const fillOsSelectOptions = async (customerId) => {
        loadingBar.show();

        const options = await getCustomerAddressOs(customerId);

        if (config?.createOsOptions && typeof config.createOsOptions === 'function') {
            config.createOsOptions(options);
        } else {
            createOsOptions(options);
            osSelect.disabled = false;
        }

        loadingBar.hide();
    }

    const onChangeCustomerSelect = ({ target: { value }}) => {
        if (!value) {
            disableOsSection();
            return;
        }
        fillOsSelectOptions(value);
    }

    customerAddressSelect.addEventListener('change', onChangeCustomerSelect);

    if (customerAddressSelect.value) {
        fillOsSelectOptions(customerAddressSelect.value)
            .then(() => {
                if (initialCustomerAddressSelectValue) {
                    customerAddressSelect.value = initialCustomerAddressSelectValue;
                }
            });
    }
}

export default handleCustomerAddressOsSelection;
