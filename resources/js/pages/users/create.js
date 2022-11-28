import addressFiller from "../../utils/addressFiller";
import handleCustomerAddressSelectionByCustomerSelect from "../../operations/handleCustomerAddressSelectionByCustomerSelect";

const selector = document.querySelector.bind(document);

const handleAddressFormSection = () => {
    const filler = addressFiller();
    const cepInput = selector('#cep');
    cepInput?.addEventListener('blur', ({ target: { value = '' } }) => filler(value));
}

const renderAllocationWhenRoleIsCustomerEmployee = (customerEmployeeRoles = []) => {
    const roleSelect = selector('#role');
    const allocationFormSection = selector('#allocation-form-section');

    const toggleAllocationFormSection = (value) => {
        if (!value) return;

        const isCustomerEmployeeRole = customerEmployeeRoles.includes(+value)

        if (isCustomerEmployeeRole) {
            allocationFormSection.classList.remove('hidden', 'opacity-0');
        } else {
            allocationFormSection.classList.add('opacity-0', 'hidden');
        }
    }

    toggleAllocationFormSection(roleSelect.value);

    roleSelect.addEventListener('change', ({ target: { value }}) => toggleAllocationFormSection(value))
}



const create = (customerEmployeeRoles = [], initialCustomerAddressSelectValue = null) => {
    handleAddressFormSection();

    if (customerEmployeeRoles.length) {
        renderAllocationWhenRoleIsCustomerEmployee(customerEmployeeRoles);
        handleCustomerAddressSelectionByCustomerSelect(initialCustomerAddressSelectValue);
    }
}

export default create;
