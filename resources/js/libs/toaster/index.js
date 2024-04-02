const Toaster = (config = {}) => {
    return {
        config,
        loadListener() {
            window.addEventListener('toast', event => {
                console.log('toast detail', event.detail);

                let type = event?.detail?.type;

                if (!type) {
                    return;
                }

                let detail = event?.detail || {};

                this.render(type, detail);
            })
        },
        render(type, detail) {
            let template = document.querySelector(`[data-template-id="toaster-${type}"]`);

            if (!template) {
                return false;
            }

            let container = document.querySelector(`[data-id="toaster-container"]`);

            if (!container) {
                return false;
            }

            template = template.outerHTML;
            template = template.replace(new RegExp('#MESSAGE#', 'ig'), detail.message);

            let element = document.createElement('div');

            element.innerHTML = template;

            element.setAttribute('data-type', 'toast-sub-container');

            container.prepend(element);

            let timeout = detail.timeout;
            timeout = !isNaN(parseInt(timeout)) && parseInt(timeout) > 0 ? parseInt(timeout) : null;

            if (timeout) {
                setTimeout(() => {
                    clearInterval(setInterval(() => {}, 1000));
                    element.remove();
                }, timeout);
            }
        },
        toastIt(type, message, showIcon = null, closable = null, timeout = null) {
            let event = new CustomEvent('toast', {
                detail: {
                    type,
                    message: `${message}`,
                    showIcon: showIcon || config?.showIcon || null,
                    closable: closable || config?.closable || null,
                    timeout: timeout || config?.timeout || null,
                }
            });

            window.dispatchEvent(event);
        },
        success(message, showIcon = null, closable = null, timeout = null) {
            return this.toastIt('success', message, showIcon, closable, timeout);
        },
        error(message, showIcon = null, closable = null, timeout = null) {
            return this.toastIt('danger', message, showIcon, closable, timeout);
        },
        danger(message, showIcon = null, closable = null, timeout = null) {
            return this.toastIt('danger', message, showIcon, closable, timeout);
        },
        info(message, showIcon = null, closable = null, timeout = null) {
            return this.toastIt('info', message, showIcon, closable, timeout);
        },
        warning(message, showIcon = null, closable = null, timeout = null) {
            return this.toastIt('warning', message, showIcon, closable, timeout);
        },
    }
}

export default Toaster
