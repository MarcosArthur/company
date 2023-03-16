class Company extends Message {

    constructor() {
        super()
        this._BASE_URL = "./api/company/store";
        this.formCompany = document.querySelector("#company-register")
        this.information = document.querySelector(".information")
        this.submitForm.bind(this)
        this.init()
    }

    init() {
        this.submitForm()
    }

    submitForm() {
        this.formCompany.addEventListener('submit', event => {
            this.clearInfomation()
            event.preventDefault();

            fetch(this._BASE_URL, {
                method: "POST",
                headers: {
                    "Accept": "application/json"
                },
                body: new FormData(this.formCompany)
            })
                .then(response => response.json())
                .then(response => {

                    this.information.innerHTML = this.getMessage(response)

                    if ('success' in response) {
                        this.clearInfomation()
                        this.clearInputs()
                        this.addRow(response.success.data);
                    }

                })
                .catch(e => {
                    this.information.innerHTML = this.getAlert(this._ERROR_TYPE.DANGER, e.message)
                })
        })
    }

    addRow(data) {
        document.querySelector('tbody').innerHTML += `
          <tr>
            <td>${data.name}</td>
            <td>${data.uf}</td>
            <td>${data.document}</td>
            <td><a class="btn btn-primary" href='./suppliers/${data.id}'>Fornecedores</a></td>
          </tr>
        `
    }

    clearInfomation() {
        this.information.textContent = ""
    }

    clearInputs() {
        this.formCompany.reset();
    }


}