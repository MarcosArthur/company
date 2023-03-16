class Toast {

    constructor() {
        this.toastContainer = document.querySelector('.toast')
        this.toastBody = document.querySelector('.toast-body')
    }

    _show(message) {
        const toast = new bootstrap.Toast(this.toastContainer)
        this.toastBody.innerHTML = message
        toast.show()

    }

}

