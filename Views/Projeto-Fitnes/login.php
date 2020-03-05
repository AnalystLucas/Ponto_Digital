<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Ponto Digital - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bem Vindo!</h1>
                  </div>
                  <form method="POST" class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="matricula" name="matricula" placeholder="Digite sua Matricula">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="senha" name="senha" placeholder="Digite sua Senha">
                    </div>
                    
                    <!-- <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Lembre-me</label>
                      </div>
                    </div> -->

                    <button class="btn btn-primary btn-user btn-block" id="btn_login">
                      Login
                    </button>
                    <!-- <hr> -->
                    <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Entre com o Google
                    </a> -->
                    <!-- <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Entre com o Facebook
                    </a> -->
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Esqueceu sua senha?</a>
                  </div>
                  <!-- <div class="text-center">
                    <a class="small" href="register.html">Crie sua conta!</a>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  
  <script>
    $(document).ready(function(){
      
      $("#btn_login").click(function(e){
        e.preventDefault();

        var matricula = $("#matricula").val();
        var senha = $("#senha").val();

        var dadoslogin = {
          matricula: matricula,
          senha: senha
        }

        $.ajax({
          url: "../../modal/logar.php",
          type: "POST",
          data: dadoslogin,
          dataType: "json",
          success:function(resposta){
            // console.log(resposta);

            if(resposta.retorno == true && resposta.perfil == true){
              alert(resposta.message);
              //Redirecionando para o index
              index = "cadastro-funcionario.php";
              $(window.document.location).attr('href', index);

            }else if(resposta.retorno == true && resposta.perfil == false){
              alert(resposta.message);
              menufunc = "registro_ponto.php";
              $(window.document.location).attr("href", menufunc);
              
            }else{
              alert(resposta.message);
            };
          }
        })//Fim do ajax;

      })//Fim do click;

    });

  </script>

</body>

</html>
