class State {

    constructor() {
      this.uf = [];
      this.templeite = "";
      this.select = document.querySelector('.state');
      this.getUfArray();

    }

    mountTempleite() {
      this.select.innerHTML += `  
        ${this.uf.map(e => {
            return `<option value="${e.sigla}">${e.sigla}</option>`
        })}
    `.join('');

    }

    getUfArray() {
      fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
        .then(response => response.json())
        .then(response => {
          this.uf = response;
          this.mountTempleite();
        })
        .catch(() => {
          new Error('Erro ao solicitar Dados Ao Servidor');
        })
    }

  }