const veiculoController = new VeiculoController();

var body = document.querySelector("body");
body.onload = function () {
    veiculoController.carregarVeiculos();
}

