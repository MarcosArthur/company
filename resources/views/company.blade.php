@extends('layouts.app')

@section('title', 'Company')

@section('content')

<!-- MODAL CADASTRO DA EMPRESA -->
<div class="container mb-3">
  <div class="row">
    <div class="col">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-register" data-bs-whatever="@mdo">Cadastro de empresa</button>

      <div class="modal fade" id="modal-register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Empresa</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="company-register" action="/api/store">
                @csrf
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Nome Fantasia:</label>
                  <input type="text" name="name" class="form-control" id="recipient-name">
                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">CNPJ:</label>
                  <input type="text" name="document" class="form-control" id="recipient-name">
                </div>

                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Estado:</label>
                  <select class="form-select state" name="uf" aria-label="Selecione Estado">
                    <option selected>Selecione Estado</option>
                  </select>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
              <button type="submit" form="company-register" class="btn btn-primary">Salvar</button>
            </div>

            <div class="information container">


            </div>
          </div>

        </div>



      </div>
    </div>
  </div>
</div>
<!-- FINAL DO MODAL DE CADATRO DA EMPRESA -->

<!-- TABELA COM LISTAGEM DE EMPRESAS -->
<div class="container">
  <div class="row">
    <div class="col">
      <table class="table text-center">
        <thead>
          <tr class="table-dark">
            <th>NOME FANTASIA</th>
            <th>ESTADO</th>
            <th>CNPJ</th>
            <th>AÇÕES</th>
          </tr>
        </thead>

        <tbody>

          @foreach ($companies as $company)
          <tr>
            <td>{{$company->name}}</td>
            <td>{{$company->uf}}</td>
            <td>{{$company->document}}</td>
            <td>
              <a class="btn btn-primary" href='{{ url("suppliers/{$company->id} ") }}'>Fornecedores</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
{{ $companies->links() }}
<!-- FINAL DA TABELA COM LISTAGEMD E EMPRESAS -->

@endsection

@section('scripts')

<script src="/js/Toast.js"></script>
<script src="/js/Message.js"></script>
<script src="/js/Company.js"></script>
<script src="/js/State.js"></script>


<script defer>
  // class Message {
  //   constructor() {
  //     this._ERROR_TYPE = {
  //       DANGER: 'danger',
  //       PRIMARY: 'primary'
  //     }
  //   }

  //   getErros(error) {
  //     return Object.keys(error.errors).map(key => `<p>${error.errors[key]}</p>`).join('')
  //   }

  //   getMessage(message) {
  //     if ('success' in message) return this.getAlert(this._ERROR_TYPE.PRIMARY, response.success.data.message)
  //     return this.getAlert(this._ERROR_TYPE.DANGER, this.getErros(message));
  //   }

  //   getAlert(type, message) {
  //     return `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
  //               ${message}
  //             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  //             </div>
  //             `
  //   }
  // }


  // class Company extends Message {

  //   constructor() {
  //     super()
  //     this._BASE_URL = "./api/company/store";
  //     this.formCompany = document.querySelector("#company-register")
  //     this.information = document.querySelector(".information")
  //     this.submitForm.bind(this)
  //     this.init()
  //   }

  //   init() {
  //     this.submitForm()
  //   }

  //   submitForm() {
  //     this.formCompany.addEventListener('submit', event => {
  //       this.clearInfomation()
  //       event.preventDefault();

  //       fetch(this._BASE_URL, {
  //           method: "POST",
  //           headers: {
  //             "Accept": "application/json"
  //           },
  //           body: new FormData(this.formCompany)
  //         })
  //         .then(response => response.json())
  //         .then(response => {

  //           this.information.innerHTML = this.getMessage(response)

  //           if ('success' in response) {
  //             this.clearInfomation()
  //             this.clearInputs()
  //             this.addRow(response.success.data);
  //           }

  //         })
  //         .catch(e => {
  //           this.information.innerHTML = this.getAlert(this._ERROR_TYPE.DANGER, e.message)
  //         })
  //     })
  //   }

  //   addRow(data) {
  //     document.querySelector('tbody').innerHTML += `
  //         <tr>
  //           <td>${data.name}</td>
  //           <td>${data.uf}</td>
  //           <td>${data.document}</td>
  //           <td><a class="btn btn-primary" href='./suppliers/${data.id}'>Fornecedores</a></td>
  //         </tr>
  //       `
  //   }

  //   clearInfomation() {
  //     this.information.textContent = ""
  //   }

  //   clearInputs() {
  //     this.formCompany.reset();
  //   }


  // }

  // class State {

  //   constructor() {
  //     this.uf = [];
  //     this.templeite = " ";
  //     this.select = document.querySelector('.state');
  //     this.getUfArray();

  //   }

  //   mountTempleite() {
  //     this.uf.forEach(e => {
  //       this.templeite += `<option value="${e.sigla}">${e.sigla}</option>`;
  //     })

  //     this.select.innerHTML += this.templeite;

  //   }

  //   getUfArray() {
  //     fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
  //       .then(response => response.json())
  //       .then(response => {
  //         this.uf = response;
  //         this.mountTempleite();
  //       })
  //       .catch(() => {
  //         new Error('Erro ao solicitar Dados Ao Servidor');
  //       })
  //   }

  // }

  let c = new Company();
  let e = new State();
</script>
@endsection('scripts')