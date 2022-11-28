import handleCustomerAddressSelectionByCustomerSelect from "../../operations/handleCustomerAddressSelectionByCustomerSelect";
import handleCustomerAddressAppliancesSelection from "../../operations/handleCustomerAddressAppliancesSelection";

const create = () => {
    handleCustomerAddressAppliancesSelection()
    handleCustomerAddressSelectionByCustomerSelect();
}

export default create;
