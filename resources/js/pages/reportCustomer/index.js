import handleCustomerAddressSelectionByCustomerSelect from "../../operations/handleCustomerAddressSelectionByCustomerSelect";
import handleCustomerAddressOsSelection from "../../operations/handleCustomerAddressOsSelection";

import Multiselect from '../../utils/multiselect';

const createOsOptions = multiselect => (options) => {
    const optionsTemplate = options
        .map(({id, title, status}) =>
            `<option value="${id}">
                ${title}
            </option>`
        );

    multiselect.setOptions(optionsTemplate);
    multiselect.refresh();
}

const reportOs = () => {
    const multiselect = Multiselect('oss_id');
    const config = {
        createOsOptions: createOsOptions(multiselect),
    }

    handleCustomerAddressSelectionByCustomerSelect();
    handleCustomerAddressOsSelection(null, config)
}

export default reportOs;
