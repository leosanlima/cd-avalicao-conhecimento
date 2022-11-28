import addressFiller from "../../utils/addressFiller";

const selector = document.querySelector.bind(document);


const create = () => {
    const filler = addressFiller();
    const cepInput = selector('#cep');
    cepInput?.addEventListener('blur', ({ target: { value = '' } }) => filler(value));
}

export default create;


