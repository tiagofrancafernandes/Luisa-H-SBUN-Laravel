export const applyPattern = (element) => {
    if (!element) {
        return;
    }

    // let pattern = '[0-9]+';
    let pattern = element?.dataset?.onInputPattern;

    pattern = pattern ? new RegExp(pattern, 'ig') : null;

    if (!pattern) {
        return;
    }

    let newValue = (element?.value).match(pattern);

    newValue = newValue ? newValue[0] : '';
    element.value = `${newValue}`.trim();
}

export const onInputValidator = (event) => {
    if (!event || !event?.target) {
        return;
    }

    let element = event.target;

    if (!element) {
        return;
    }

    applyPattern(element);
}

export const listenValidator = () => {
    document.querySelectorAll('[data-on-input-pattern]')
        .forEach(element => {
            if (element?.getAttribute('data-on-input-pattern-started')) {
                return;
            }

            element.setAttribute('data-on-input-pattern-started', true);
            element.addEventListener('input', event => onInputValidator(event));
            applyPattern(element);
        });
}

export const setup = () => {
    document.addEventListener('DOMContentLoaded', () => listenValidator());
    window.addEventListener('load', () => listenValidator());
}

/**
 * USAGE
 * <input type="text" data-on-input-pattern="[0-9]+">
 */
