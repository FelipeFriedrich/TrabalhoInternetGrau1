class TabelaProdutos{
    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }
    
    montarTabela(produtos){
        var str=`
        <h2>Tabela de Produtos</h2>
        <a id="novo" href="#">Novo</a>
        <div id="tabela">
        <table>
            <tr>
                <th style='text-align: left;'>Id</th>
                <th style='text-align: left;'>Nome</th>
                <th style='text-align: left;'>Preço</th>
                <th colspan="2">Ação</th>
            </tr>

        ${produtos.map(function(produto) {
            return `
            <tr id=${produto.id}>
                <td>${produto.id}</td>
                <td>${produto.nome}</td>
                <td>${produto.preco}</td>
                <td><a class="edit" href="#">Editar</a></td>
                <td><a class="delete" href="#">Deletar</a></td>    
            </tr>
            `;                
        }).join("")}
        </table>
        </div>        
        `;

        var tabela = document.querySelector(this.seletor);
        tabela.innerHTML = str;


        const self = this;
        const linkNovo = document.querySelector("#novo");
        linkNovo.onclick = function(event){
            self.controller.carregarFormulario(event);
        }

        const linksDelete = document.querySelectorAll(".delete");
        for(let linkDelete of linksDelete)
        {
            const id = linkDelete.parentNode.parentNode.id;
            linkDelete.onclick = function(event){
                self.controller.deletarProduto(id);
            }
        }

        const linksEdit = document.querySelectorAll(".edit");
        for(let linkEdit of linksEdit)
        {
            const id = linkEdit.parentNode.parentNode.id;
            //Outra forma de tratar o evento (click) - nesse caso deve ter bind
            linkEdit.addEventListener("click",this.controller.carregaFormularioComProduto.bind(this.controller,id));
        }

    }

}