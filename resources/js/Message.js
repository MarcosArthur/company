class Message extends Toast {

    constructor() {

        super()

        this._ERROR_TYPE = {
            DANGER: 'danger',
            PRIMARY: 'primary'
        }
    }

    getErros(error) {
        return Object.keys(error.errors).map(key => `<p>${error.errors[key]}</p>`).join('')
    }

    getMessage(message) {
        if ('success' in message) return this.getAlert(this._ERROR_TYPE.PRIMARY, message.success.message)
        return this.getAlert(this._ERROR_TYPE.DANGER, this.getErros(message));
    }

    getAlert(type, message) {
        return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              `
    }
}