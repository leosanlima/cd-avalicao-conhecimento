import handleCustomerAddressSelectionByCustomerSelect from "../../operations/handleCustomerAddressSelectionByCustomerSelect";
import handleCustomerAddressAppliancesSelection from "../../operations/handleCustomerAddressAppliancesSelection";

const create = (customerAddressId, appliancesId) => {
    handleCustomerAddressAppliancesSelection(appliancesId)
    handleCustomerAddressSelectionByCustomerSelect(customerAddressId);
}

export default create;
