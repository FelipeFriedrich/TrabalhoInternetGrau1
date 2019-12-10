class VeiculoController {
    
    constructor(){
        this.veiculoService = new VeiculoAPIService();
        this.tabelaVeiculos = new TabelaVeiculos(this,"main");
        this.formVeiculos = new FormVeiculos(this,"main");

    }

    carregarFormulario(event){
        event.preventDefault();
        this.formVeiculos.montarForm();
    }
    carregarVeiculos() {
        const self = this;
        //definição da função que trata o buscar Veiculos em caso de sucesso        
        const sucesso = function(veiculos){
            console.log(self);
            self.tabelaVeiculos.montarTabela(veiculos);
        }
        //definição da função que trata o erro ao buscar Veiculos  
        const trataErro = function(statusCode){
            console.log("Erro: "+statusCode)
        }

        this.veiculoService.listarVeiculos(sucesso, trataErro);
        
    }

    salvar(event){
        event.preventDefault();
        var veiculo = this.formVeiculos.getDataVeiculo();        
        this.salvarVeiculo(veiculo);    
    }

    salvarVeiculo(veiculo){
        const self = this;

        const sucesso = function(veiculoSalvo) {                
            console.log(veiculoSalvo);
            self.carregarVeiculos();
            self.formVeiculos.limparFormulario();
        }

        const trataErro = function(statusCode) {
            console.log("Erro: "+statusCode)
        }

        this.veiculoService.inserirVeiculo(veiculo, sucesso, trataErro);       
    }

    limpar(event){
        this.formVeiculos.limparFormulario();
        this.carregarVeiculos();
    }

    deletarVeiculo(id, event){
        const self = this;
        this.veiculoService.deletarVeiculo(id, 
            //colocar direto a funcao no parametro
            //nao precisa criar a variavel ok e erro
            function() {
                self.carregarVeiculos();
            },
            function(status) { 
                console.log(status);
            }
        );
    }

    carregaFormularioComVeiculo(id, event){
        event.preventDefault();             
        
        const self = this;
        const ok = function(veiculo){
            self.formVeiculos.montarForm(veiculo);
        }
        const erro = function(status){
            console.log(status);
        }

        this.veiculoService.buscarVeiculo(id,ok,erro);   
    }

    editar(id,event){
        event.preventDefault();
    
        let veiculo = this.formVeiculos.getDataVeiculo();
        
        const self = this;

        this.veiculoService.atualizarVeiculo(id,veiculo, 
            function() {
                self.formVeiculos.limparFormulario();
                self.carregarVeiculos();
            },
            function(status) {
                console.log(status);
            } 
        );

    }

}

