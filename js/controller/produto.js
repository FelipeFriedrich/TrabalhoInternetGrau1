class ProdutoController {
    
    constructor(){
        this.veiculoService = new ProdutoAPIService();
        this.tabelaProdutos = new TabelaProdutos(this,"main");
        this.formProdutos = new FormVeiculos(this,"main");

    }

    carregarFormulario(event){
        event.preventDefault();
        this.formProdutos.montarForm();
    }
    carregarProdutos() {
        const self = this;
        //definição da função que trata o buscar produtos em caso de sucesso        
        const sucesso = function(produtos){
            console.log(self);
            self.tabelaProdutos.montarTabela(produtos);
        }
        //definição da função que trata o erro ao buscar produtos  
        const trataErro = function(statusCode){
            console.log("Erro: "+statusCode)
        }

        this.veiculoService.buscarProdutos(sucesso, trataErro);
        
    }

    salvar(event){
        event.preventDefault();
        var produto = this.formProdutos.getDataProduto();        
        this.salvarProduto(produto);    
    }

    salvarProduto(produto){
        const self = this;

        const sucesso = function(produtoSalvo) {                
            console.log(produtoSalvo);
            self.carregarProdutos();
            self.formProdutos.limparFormulario();
        }

        const trataErro = function(statusCode) {
            console.log("Erro: "+statusCode)
        }

        this.veiculoService.enviarProduto(produto, sucesso, trataErro);       
    }

    limpar(event){
        this.formProdutos.limparFormulario();
        this.carregarProdutos();
    }

    deletarProduto(id, event){
        const self = this;
        this.veiculoService.deletarProduto(id, 
            //colocar direto a funcao no parametro
            //nao precisa criar a variavel ok e erro
            function() {
                self.carregarProdutos();
            },
            function(status) { 
                console.log(status);
            }
        );
    }

    carregaFormularioComProduto(id, event){
        event.preventDefault();             
        
        const self = this;
        const ok = function(veiculo){
            self.formVeiculos.montarForm(veiculo);
        }
        const erro = function(status){
            console.log(status);
        }

        this.veiculoService.buscarProduto(id,ok,erro);   
    }

    editar(id,event){
        event.preventDefault();
    
        let veiculo = this.formVeiculo.getDataVeiculo();
        
        const self = this;

        this.veiculoService.atualizarVeiculo(id,veiculo, 
            function() {
                self.formVeiculos.limparFormulario();
                self.carregarProdutos();
            },
            function(status) {
                console.log(status);
            } 
        );

    }

}

