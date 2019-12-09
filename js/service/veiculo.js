class VeiculoAPIService{
    uri = "http://localhost:8080/api/veiculos";

    listarVeiculos(ok, erro){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            //Se finalizou a comunicacao
            if(this.readyState === 4){
                if (this.status === 200) {
                    //Vai chamar o método sucesso definido no controller
                    ok(JSON.parse(this.responseText));
                }
                else{
                    //Vai chamar o método trataErro definido no controller
                    erro(this.status);
                }
            }
        };
        xhttp.open("GET", this.uri , true);
        xhttp.send();
    }

    inserirVeiculo(veiculo, ok, erro){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            //Se finalizou a comunicacao
            if(this.readyState === 4){
                    if (this.status === 201) {
                    ok(JSON.parse(this.responseText));
                }
                else{
                    erro(this.status);
                }
            }
        };
        xhttp.open("POST", this.uri, true);
        xhttp.setRequestHeader("Content-Type","application/json");
        xhttp.send(JSON.stringify(veiculo));
        
    }

    deletarVeiculo(id,ok,error) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                ok(JSON.parse(this.responseText));          
            }
            else if(this.status !== 200){
                error(this.status);
            }
        };
        xhttp.open("DELETE", this.uri+'/'+id, true);
        xhttp.send();
    }

    buscarVeiculo(id,ok,error) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                ok(JSON.parse(this.responseText));          
            }
            else if(this.status !== 200){
                error(this.status);
            }
        };
        xhttp.open("GET", this.uri+'/'+id, true);
        xhttp.send();
    }

    atualizarVeiculo(id,veiculo,ok,error) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                ok(JSON.parse(this.responseText));          
            }
            else if(this.status !== 200){
                error(this.status);
            }
        };
        xhttp.open("PUT", this.uri+'/'+id, true);
        xhttp.setRequestHeader("Content-Type","application/json")
        xhttp.send(JSON.stringify(veiculo));
    }
}