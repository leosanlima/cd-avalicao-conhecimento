import loadingBar from "../utils/loading-bar";

import { getCustomerAddressAppliance } from "../api/appliance";

const handleCustomerAddressAppliancesSelection = (initialCustomerAddressSelectValue, config) => {
    const selector = document.querySelector.bind(document);
    const customerAddressSelect = selector('#customer_address_id');
    const applianceSelect = selector('#appliance_id');

    const disableApplianceSection = () => {
        applianceSelect.disabled = true;
        applianceSelect.innerHTML = '<option value="">Selecione um aparelho.</option>';
    }

    const createApplianceOptions = (options) => {
        const initialOption = ``;
        const optionsTemplate = options
            .map(({id, brand, description, code}) =>
                `<option value="${id}"
                ${
                    initialCustomerAddressSelectValue?.find(el => el == id) ?
                    'selected' :
                    ''
                }
                >
                    ${code} - ${brand}
                </option>`)

        applianceSelect.innerHTML = [initialOption, ...optionsTemplate].join(' ');
    }

    const fillApplianceSelectOptions = async (customerId) => {
        loadingBar.show();

        const options = await getCustomerAddressAppliance(customerId);

        if (config?.createApplianceOptions && typeof config.createApplianceOptions === 'function') {
            config.createApplianceOptions(options);
        } else {
            createApplianceOptions(options);
            applianceSelect.disabled = false;
        }

        loadingBar.hide();
    }

    const onChangeCustomerSelect = ({ target: { value }}) => {
        if (!value) {
            disableApplianceSection();
            return;
        }
        fillApplianceSelectOptions(value);
    }

    customerAddressSelect.addEventListener('change', onChangeCustomerSelect);

    if (customerAddressSelect.value) {
        fillApplianceSelectOptions(customerAddressSelect.value)
            .then(() => {
                if (initialCustomerAddressSelectValue) {
                    customerAddressSelect.value = initialCustomerAddressSelectValue;
                }
            });
    }
}

export default handleCustomerAddressAppliancesSelection;
