import handleCustomerAddressSelectionByCustomerSelect from "../../operations/handleCustomerAddressSelectionByCustomerSelect";
import handleCustomerAddressAppliancesSelection from "../../operations/handleCustomerAddressAppliancesSelection";

import Multiselect from '../../utils/multiselect';

const createApplianceOptions = multiselect => (options) => {
    const optionsTemplate = options
        .map(({id, brand, description, code}) =>
           `<option value="${id}">
                ${brand}, ${description}, ${code}
            </option>`
        );

    multiselect.setOptions(optionsTemplate);
    multiselect.refresh();
}

const reportAppliance = () => {
    const multiselect = Multiselect('appliance_id');
    const config = {
        createApplianceOptions: createApplianceOptions(multiselect),
    }

    handleCustomerAddressSelectionByCustomerSelect();
    handleCustomerAddressAppliancesSelection(null, config)
}

export default reportAppliance;
