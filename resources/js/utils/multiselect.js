const dispatchMultiselectRefresh = (multiSelect) => () => {
    const event = new CustomEvent('multiselect-refresh');
    multiSelect.dispatchEvent(event);
}

const setOptions = nativeElement => options => {
    nativeElement.innerHTML = options.join(' ');
}

const getMultiSelect = elementId => document.querySelector(`#${elementId}`);
const getNativeSelect = nativeSelectId => document.querySelector(`#${nativeSelectId}`);

const Multiselect = elementId => {
    const nativeSelectId = `x-${elementId}-select`;
    const multiSelect = getMultiSelect(elementId);
    const nativeSelect = getNativeSelect(nativeSelectId);

    return {
        refresh: dispatchMultiselectRefresh(multiSelect),
        setOptions: setOptions(nativeSelect),
    }
}

export default Multiselect;
