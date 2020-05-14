<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('Contatos', 'Contatos') }}</title>
{{--    FONT-AWESOME   --}}
        <script src="https://kit.fontawesome.com/84b849e3cd.js" crossorigin="anonymous"></script>
{{--    BOOTSTRAP      --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <style type="text/css">
            .inputForm{
                border-radius:10px 10px 10px 10px;
            }
            .titleInput{
                font-size: 12px;
                color: #8D8D8D;
            }
            .btnSubmit{
                background-color: #FFA700;
                color: #FFFFFF;
                border-radius: 30px 30px 30px 30px;
            }
            .btnCancel{
                color: #8D8D8D;
                border-radius: 30px 30px 30px 30px;
            }
            .inputEmail{
                border-style: dashed;
                border-width: medium;
                height: 60px;
            }
            .fa-level-down-alt{
                color: #1f648b;
            }
        </style>
        <script>
            var cnt = 1;
            var arrayContatos = [];
            function forArrayContatos(){
                console.log(this.arrayContatos.length);
                for (i=1; i <= this.arrayContatos.length; i++) {
                    var txt = document.getElementById('contato' + (i-1));
                    txt.value = this.arrayContatos[i-1];
                }
            }
            function onChangeContatos(){
                var input = document.getElementById('contato'+(cnt-1)).value;
                var inputEnviarBack = document.getElementById('contato');
                this.arrayContatos[cnt-1] = input;
                inputEnviarBack.value = this.arrayContatos;
            }
            function component(){
                var div = document.getElementById('emails');
                // console.log("array: "+this.arrayContatos.length);
                // console.log("cnt: "+(cnt-1));
                if((cnt-1) <= this.arrayContatos.length){
                    var span = document.getElementById('span'+(cnt-1));
                    span.innerHTML = '<i class="fas fa-times-circle" data-cnt="'+(cnt-1)+'" id="contatoDiv'+(cnt-1)+'" onclick="excluiCont(this.id, this)"></i>';

                    var html = '<div id="contatoDiv'+(cnt)+'"><div class="input-group mb-3"><input type="text" class="form-control inputForm inputEmail" onkeyup="onChangeContatos()" placeholder="Adicionar contato (Telefone, email, twitter, facebook)" id="contato'+cnt+'"> <div class="input-group-append"><span class="input-group-text" id="span'+cnt+'"><i class="fas fa-level-down-alt" onclick="component()"></i></span></div></div></div>';
                    div.innerHTML += html;
                    cnt++;
                    forArrayContatos();
                }else{
                    var html = '<div id="contatoDiv'+(cnt)+'"><div class="input-group mb-3" id="contatoDiv'+(cnt)+'"><input type="text" class="form-control inputForm inputEmail" onkeyup="onChangeContatos()" placeholder="Adicionar contato (Telefone, email, twitter, facebook)" id="contato'+cnt+'"> <div class="input-group-append"><span class="input-group-text" id="span'+cnt+'"><i class="fas fa-level-down-alt" onclick="component()"></i></span></div></div></div>';
                    div.innerHTML += html;
                    cnt++;
                    forArrayContatos();
                }

            }
            function cancelar(){
                var nome = document.getElementById('nome');
                var sobrenome = document.getElementById('sobrenome');
                var email = document.getElementById('contato');
                var divEmail = document.getElementById('emails');
                this.arrayContatos = [];
                nome.value = "";
                sobrenome.value = "";
                email.value = "";
                divEmail.innerHTML = "";
                cnt=0;
                component();
            }
            function excluiCont(id, count){
                var div = document.getElementById(id);
                console.log(div);
                console.log(id);
                console.log(count.getAttribute("data-cnt"));
                div.innerHTML = "";
                div.innerText = "";

                if(this.arrayContatos.length > 1){
                    if(this.arrayContatos.length != count.getAttribute("data-cnt")) {
                        // this.arrayContatos.splice((count.getAttribute("data-cnt")), 1)
                        this.arrayContatos[count.getAttribute("data-cnt")] = " ";
                        console.log(this.arrayContatos);
                    }else if(this.arrayContatos.length == count.getAttribute("data-cnt")){
                        this.arrayContatos[count.getAttribute("data-cnt")] = " ";
                        // this.arrayContatos.splice((count.getAttribute("data-cnt")-this.arrayContatos.length), 1)
                        console.log(this.arrayContatos);
                    }
                }else{
                    // this.arrayContatos.splice((count.getAttribute("data-cnt")-1), 1)
                    this.arrayContatos[count.getAttribute("data-cnt")] = " ";
                    console.log(this.arrayContatos);
                }

                var inputEnviarBack = document.getElementById('contato');
                inputEnviarBack.value = this.arrayContatos;

                this.cnt-1;
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h4>MEUS CONTATOS</h4>
                            <br>
                            <form action="/new" method="POST">
                                {{ csrf_field() }}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="titleInput">Nome</label>
                                        <input type="text" class="form-control inputForm" id="nome" name="nome" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="titleInput">Sobrenome</label>
                                        <input type="text" class="form-control inputForm" id="sobrenome" name="sobrenome" required>
                                    </div>
                                </div>

                                <div id="emails">
                                    <div id="contatoDiv0">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control inputForm inputEmail" onkeyup="onChangeContatos()" required placeholder="Adicionar contato (Telefone, email, twitter, facebook)" id="contato0" name="contato0">
                                            <div class="input-group-append">
                                                <span class="input-group-text"  id="span0"><i class="fas fa-level-down-alt" onclick="component()"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <input type="hidden" id="contato" name="contato">
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <button type="submit" class="btn btn-block btn-warning btnSubmit">Salvar</button>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <a onclick="cancelar()">
                                            <button type="button" class="btn btn-light btn-block btnCancel">Cancelar</button>
                                        </a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>