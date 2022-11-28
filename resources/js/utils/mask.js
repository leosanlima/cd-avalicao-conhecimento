import IMask from "imask";
import moment from "moment";
import Inputmask from "inputmask";

const applyMask = mask => selector => (
    IMask(
        document.querySelector(selector),
        {
            mask
        }
    )
)

const applyNumberMask = () => (selector) => (
    IMask(
        document.querySelector(selector),
        {
            mask: Number,
            scale: 2,
            signed: false,
            thousandsSeparator: '.',
            normalizeZeros: true,
            min: 0
        }
    )
)

const applyDateMask = (dateFormat) => (selector) => (
    IMask(
        document.querySelector(selector),
        {
            mask: Date,
            pattern: dateFormat,
            min: new Date(1500, 1, 1),
            max: new Date(9999, 12, 31),
            autofix: true,
            parse: function (str) {
                return moment(str, dateFormat);
            },
            format: function (date) {
                document.querySelector(selector).classList.remove('border-red-800');
                const momentDate = moment(date);

                if(!momentDate._isValid)
                    document.querySelector(selector).classList.add('border-red-800');

                return momentDate.format(dateFormat);
            },
            blocks: {
                YYYY: {
                    mask: IMask.MaskedRange,
                    from: 1500,
                    to: 9999
                },
                MM: {
                    mask: IMask.MaskedRange,
                    from: 1,
                    to: 12
                },
                DD: {
                    mask: IMask.MaskedRange,
                    from: 1,
                    to: 31
                }
            }
        }
    )
)

const applyDecimalMask = () => (selector) => {
    Inputmask("(.999){+|1}.00", {
        positionCaretOnClick: "radixFocus",
        radixPoint: ".",
        _radixDance: true,
        numericInput: true,
        placeholder: "0",
        definitions: {
            "0": {
                validator: "[0-9\uFF11-\uFF19]"
            }
        }
    }).mask(document.querySelector(selector));
}

export const cnpj = applyMask('00.000.000/0000-00');
export const cep = applyMask('00000-000');
export const cpf = applyMask('000.000.000-00');
export const number = applyNumberMask();
export const date = applyDateMask('DD/MM/YYYY');
export const decimal = applyDecimalMask();
