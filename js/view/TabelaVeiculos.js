class TabelaVeiculos{
    constructor(controller, seletor){
        this.controller = controller;
        this.seletor = seletor;
    }
    
    montarTabela(veiculos){
        var str=`
        <h2>Tabela de Veiculos</h2>
        <a id="novo" href="#">Novo</a>
        <div id="tabela">
        <table>
            <tr>
                <th style='text-align: left;'>Id</th>
                <th style='text-align: left;'>Chassi</th>
                <th style='text-align: left;'>Situacao</th>
                <th style='text-align: left;'>Preço</th>
                <th style='text-align: left;'>Modelo</th>
                <th colspan="2">Ação</th>
            </tr>

        ${veiculos.map(function(veiculo) {
            return `
            <tr id=${veiculo.id}>
                <td>${veiculo.id}</td>
                <td>${veiculo.chassi}</td>
                <td>${veiculo.situacao}</td>
                <td>${veiculo.preco}</td>
                <td>${veiculo.modelo}</td>
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
                self.controller.deletarVeiculo(id);
            }
        }

        const linksEdit = document.querySelectorAll(".edit");
        for(let linkEdit of linksEdit)
        {
            const id = linkEdit.parentNode.parentNode.id;
            //Outra forma de tratar o evento (click) - nesse caso deve ter bind
            linkEdit.addEventListener("click",this.controller.carregaFormularioComVeiculo.bind(this.controller,id));
        }

    }

}