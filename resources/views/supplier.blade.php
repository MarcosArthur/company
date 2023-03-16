@extends('layouts.app')

@section('title', 'Fornecedores')

@section('content')
<style>
  .container-phone-item:first-child {
    margin-bottom: 10px;
  }

  .container-phone-item:first-child>.btn-c>button {
    display: none;
  }
</style>
<div class="container mb-3">
  <div class="row">
    <div class="col">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-register" data-bs-whatever="@mdo">Cadastro de Forecedor</button>

      <div class="modal fade" id="modal-register" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Empresa</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form id="supplier-register" action="/api/store">
                <input type="hidden" name="company_id" class="input" value="{{$company_id}}">
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Nome:</label>
                  <input type="text" name="name" class="form-control input">
                </div>

                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Tipo de Documento:</label>
                  <select class="form-select input document-type" name="document_type" aria-label="Selecione Estado">
                    <option selected value="legal">CNPJ</option>
                    <option value="physical">CPF</option>
                  </select>
                </div>

                <div class="container-info-extra d-none">

                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Data De Nascimento:</label>
                    <input type="date" name="birt_date" class="form-control input">
                  </div>

                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">RG:</label>
                    <input type="text" name="rg" class="form-control input">
                  </div>

                </div>

                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label mr-5">Novo Telefone</label>
                  <button class="btn btn-primary new-phone">+</button>
                </div>

                <div class="container-phone">

                  <div class="container-phone-item row g-3">
                    <div class="col-auto">
                      <label for="inputPassword2" class="visually-hidden">Telefone</label>
                      <input type="text" name="phones[]" class="form-control phones" required placeholder="Telefone">
                    </div>

                    <div class="col-auto btn-c">
                      <button class="btn btn-danger mb-3 btn-delete-phone" onclick="c.removePhone(this)"><i class="bi bi-trash"></i></button>
                    </div>
                  </div>

                </div>
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">CNPJ/CPF:</label>
                  <input type="text" name="document" class="form-control input" id="recipient-name">
                </div>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
              <button type="submit" form="supplier-register" class="btn btn-primary">Salvar</button>
            </div>

            <div class="information container">


            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>


<div class="modal fade modal-lg" id="modal-view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Distribuidor</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">

            <div class="col-6">
              <p>Nome: <small class="name"></small></p>
            </div>

            <div class="col-6">
              <p>Documento: <small class="document-view"></small></p>
            </div>
          </div>

          <div class="row d-none infor-extra">

            <div class="col-6">
              <p>RG: <small class="rg"></small></p>
            </div>

            <div class="col-6">
              <p>Data De Nascimento: <small class="birt-date"></small></p>
            </div>

          </div>

          <hr>


          <div class="row">



          </div>

         <div>
            <h6>Contatos</h4>
            <hr>
            <div class="phones-container">
              <p>Nenhum Contato Encontrado</p>
            </div>
         </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
      </div>

      <div class="information container">


      </div>
    </div>

  </div>



</div>


@if ($suppliers->count())
<div class="container">

  <div class="row">
    <div class="col">
      <form action="" class="col-4">
        <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Buscar</label>
          <input type="text" name="name" class="form-control input" onkeyup="supplier.filter(this)">
        </div>
      </form>
    </div>
  </div>


  <div class="row">
    <div class="col">
      <table class="table text-center">
        <thead>
          <tr class="table-dark">
            <td>Nome</td>
            <td>Documento</td>
            <td>Criação</td>
            <td>Ações</td>
          </tr>
        </thead>
        <tbody class="table-body">
          @foreach ($suppliers as $supplier)
          <tr>
            <td>{{$supplier->name}}</td>
            <td>{{$supplier->document}}</td>
            <td>{{$supplier->created_at}}</td>
            <td>

              <button class="btn btn-primary" data-view-id="{{$supplier->id}}">
                <i class="bi bi-eye"></i>
              </button>

              <button class="btn btn-danger" data-delete-id="{{$supplier->id}}">
                <i class="bi bi-trash"></i>
              </button>

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@else
<div class="alert alert-danger" role="alert">
  Nenhum fornercedor cadastrado
</div>
@endif


<div class="toast-container position-fixed bottom-0 end-0 p-3" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast">
    <div class="toast-header">
      <strong class="me-auto">Alerta</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">

    </div>
  </div>

</div>


@endsection('content')

@section('scripts')

<script src="/js/Toast.js"></script>
<script src="/js/Message.js"></script>
<script src="/js/Supplier.js"></script>
<script>
  let supplier = new Supplier(<?php echo $suppliers; ?>);
</script>

@endsection('scripts')