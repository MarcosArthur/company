class Supplier extends Message {
    constructor(suppliers) {

        super()

        this._BASE_URL = "/api/supplier/"
        this.inputBaseForm = document.querySelectorAll('.input')
        this.phones = document.querySelectorAll('.phones')
        this.optionDocumentType = document.querySelector('.document-type')
        this.containerInfoExtra = document.querySelector('.container-info-extra')
        this.btnAddNewPhone = document.querySelector('.new-phone')
        this.containerPhone = document.querySelector('.container-phone')
        this.containerPhoneitem = document.querySelector('.container-phone-item')
        this.btnRemovePhone = document.querySelector('.remove-item-phone')
        this.information = document.querySelector('.information')
        this.btnDelete = document.querySelectorAll('[data-delete-id]')
        this.btnView = document.querySelectorAll('[data-view-id]')
        this.formSupplierRegister = document.querySelector('#supplier-register')
        this.modalView = document.querySelector('#modal-view')
        this.lista = JSON.stringify(suppliers);
        this.table = document.querySelectorAll(".table-body tr")

        this.inforExtra = document.querySelector('.infor-extra')
        this.rg = document.querySelector('.rg')
        this.birtDate = document.querySelector('.birt-date')

        this.phonesContainer = document.querySelector('.phones-container')
        this.name = document.querySelector('.name')
        this.documento = document.querySelector('.document-view')


        this.init()

    }

    init() {
        this.eventClickDelete()
        this.eventChangeDocumentType()
        this.eventSubmitForm()
        this.addNewPhone()
        this.viewSupplier()
        this.closeModelView()
    }

    getModal(modal) {
        return new bootstrap.Modal(modal, {
            keyboard: true
        });
    }

    eventClickDelete() {
        this.btnDelete.forEach(btn => {
            btn.addEventListener('click', event => {
                event.preventDefault();
                let id = btn.dataset.deleteId

                const swalWithBootstrapButtons = Swal.mixin({
                    buttonsStyling: true
                  })
                  
                  swalWithBootstrapButtons.fire({
                    title: 'Deseja remover o fornecedor ?',
                    text:"",
                    icon: 'warning',
                    padding: '3em',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, Delete isso!',
                    cancelButtonText: 'Não, Cancelar!',
                    reverseButtons: true
                  }).then((result) => {
                    if (result.isConfirmed) {

                        fetch(`/api/supplier/delete/${id}`)
                        .then(response => response.json())
                        .then(response => {
                           if ('success' in response) {
                            swalWithBootstrapButtons.fire(
                                'Deletado!',
                                'Registro Deletado com sucesso',
                                'success'
                              )
                            
                            this.removeRow(btn)
                            } else {
                                swalWithBootstrapButtons.fire(
                                    'Error',
                                    response.errors.error,
                                    'error'
                                  )
                            }
                        })

                       
                     
                    } else if (
                      /* Read more about handling dismissals below */
                      result.dismiss === Swal.DismissReason.cancel
                    ) {
                      swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'Operação cancelada com sucesso',
                        'error'
                      )
                    }
                  })
                
               
            })
        })
    }

    eventChangeDocumentType() {
        this.optionDocumentType.addEventListener('change', option => {
            this.containerInfoExtra.classList.toggle('d-none');
        })
    }

    eventSubmitForm() {
        this.formSupplierRegister.addEventListener('submit', event => {
            event.preventDefault();

            fetch("/api/supplier/store", {
                method: "POST",
                headers: {
                    "Accept": "application/json"
                },
                body: this.getFormValues()
            })
                .then(response => response.json())
                .then(response => {
                    this.information.innerHTML = this.getMessage(response)

                    if ('success' in response) {
                        this.clearInputs(this.formSupplierRegister)
                    }

                })
                .catch(e => {
                    this.information.innerHTML = this.getAlert(this._ERROR_TYPE.DANGER, e.message)
                })
        })
    }

    addNewPhone() {
        this.btnAddNewPhone.addEventListener('click', event => {
            event.preventDefault()
            this.containerPhone.innerHTML += this.containerPhoneitem.outerHTML
        })
    }

    viewSupplier() {
        this.btnView.forEach(btn => {
            btn.addEventListener('click', event => {
                event.preventDefault()

                let id = btn.dataset.viewId
                fetch(`/api/supplier/show/${id}`)
                    .then(response => response.json())
                    .then(response => {
                        this.clerInfoSupplier();
                        this.setInforSupplier(response)
                        this.openModelView()
                    })
            })
        })
    }

    removePhone(element) {
        element.parentNode.parentNode.remove()
    }

    getFormValues() {
        let formData = new FormData();

        this.inputBaseForm.forEach(input => {
            formData.append(input.name, input.value);
        })

        formData.append('phones', this.getPhones())

        return formData
    }

    openModelView() {
        const modal = this.getModal('#modal-view')

        modal.show(this.modalView)

    }

    clerInfoSupplier() {
        this.inforExtra.classList.add('d-none')
        this.name.textContent = ''
        this.documento.textContent = ''
        this.rg.textContent = ''
        this.birtDate.textContent = ''
        this.phonesContainer.innerHTML = ''
    }

    setInforSupplier(response) {

        this.name.textContent = response.data.supplier.name
        this.documento.textContent = response.data.supplier.document

        if (response.data.supplier.document_type.includes('physical')) {
            this.inforExtra.classList.remove('d-none')
            this.rg.textContent = response.data.supplier.rg
            this.birtDate.textContent = response.data.supplier.birt_date
        }

        let phones = response.data.supplier.phones;
        this.phonesContainer.innerHTML += `
        
        ${(phones.length ?
                phones.map(e => {
                    return `
                    <div>
                        ${e.phone}
                    </div>
                    <hr>
                    `}).join('') : '<p>Nenhum Contato Encontrado</p>')}

      `;

    }


    closeModelView() {
        const modal = document.querySelector('#modal-view')
        modal.addEventListener('hidden.bs.modal', event => {
            this.clearInputs(this.formSupplierRegister)
        })

    }


    getPhones() {
        let objectPhone = [];

        this.phones.forEach(phone => {
            objectPhone.push({
                'phone': phone.value
            })
        })

        return JSON.stringify(objectPhone)
    }

    clearInputs(form) {
        form.reset(this.formSupplierRegister);
    }

    removeRow(element) {
        element.parentNode.parentNode.remove()
    }

    filter(element) {

        let value = element.value

        this.table.forEach(e => {

            if (!value) {
                e.style.display = 'table-row';
                return
            }

            if (value.length > 4) {
                if (e.outerText.trim().includes(value)) {
                    e.style.display = 'table-row';
                } else {
                    e.style.display = 'none';
                }
            }
        })

    }

}

