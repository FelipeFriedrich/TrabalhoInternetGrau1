class FormVeiculos {
    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }

    montarForm(veiculo){
        if(!veiculo){
            veiculo = new Veiculo();
        }
        var str = `
        <h2>Formulario de Veiculo</h2>
        <form id="formulario">
            <input type="hidden" id="id" value="${veiculo.id}" />
            <label for="txtnome">Chassi:</label>
            <input type="text" id="txtchassi" value="${veiculo.chassi ?veiculo.chassi :''}">
            <br />
            <label for="txtuso">Situacao:</label>
            <input type="text" id="txtsituacao" value="${veiculo.situacao ?veiculo.situacao :''}">
            <br />
            <label for="txtuso">Preço:</label>
            <input type="text" id="txtpreco" value="${veiculo.preco ?veiculo.preco :''}">
            <br />
            <label for="txtuso">Modelo:</label>
            <input type="text" id="txtmodelo" value="${veiculo.modelo ?veiculo.modelo :''}">
            <br />
            <br />
            <input type="submit" id="btnsalvar" value="Salvar">
            <input type="reset" value="Cancelar">
            <br />
        </form>
        `;
        var containerForm = document.querySelector(this.seletor);
        containerForm.innerHTML = str; 

        var form = document.querySelector("#formulario");
        const self = this;
        form.onsubmit = function(event){
            if(!veiculo.id){
                self.controller.salvar(event);
            }
            else{
                self.controller.editar(veiculo.id,event);
            }
            //this.controller.salvar.bind(this.controller,event);
        }        
        form.onreset = function(event){
            self.controller.limpar(event);
            //this.controller.salvar.bind(this.controller,event);
        }        
    }

    limparFormulario(){
        document.querySelector("#txtchassi").value="";
        document.querySelector("#txtsituacao").value="";
        document.querySelector("#txtpreco").value="";
        document.querySelector("#txtmodelo").value="";
    }

    getDataVeiculo(){
        let veiculo = new Veiculo();
        if(!document.querySelector("#id").value)
        veiculo.id = document.querySelector("#id").value;
        veiculo.chassi = document.querySelector("#txtchassi").value;
        veiculo.situacao = document.querySelector("#txtsituacao").value;
        veiculo.preco = document.querySelector("#txtpreco").value;
        veiculo.modelo = document.querySelector("#txtmodelo").value;
        return veiculo;        
    }



}