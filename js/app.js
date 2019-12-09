const produtoController = new ProdutoController();

var body = document.querySelector("body");
body.onload = function () {
    produtoController.carregarProdutos();
}

