<?php 
require_once "../../Controller/consultar.php";

$query = new Consultar();
$query->queryRelacional("usuarios","funcionarios","situacao");

//Como o retorno vem pela mesma função para não da conflito separei os resultado
//resultado_queryr é o retorno da queryRelacional
$resultado_queryr = $query->resultado();

session_start();

if(!isset($_SESSION['logado'])){
  header("location: login.php");
}
if($_SESSION['perfil'] == "User" || $_SESSION['perfil'] == "user"){
  header("location: registrar-ponto.php");
}

$matricula = $_SESSION['matricula'];

$query->queryOne("funcionarios","matricula", $matricula);
//result é o retorno da queryOne 
$result = $query->resultado();
$dadosfunc = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Ponto Digital - Alterar Dados</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-parking"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Ponto Digital</div>
      </a>


        
      <!-- Divider -->
      <hr class="sidebar-divider">



      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="cadastro-funcionario.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Cadastrar funcionário</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="consultar-ponto.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Consutar ponto</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="alterar-dados.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Alterar</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-table"></i>
          <span>Gerar PDF</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logdeacesso.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Log de Acesso</span></a>
      </li>
         
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <div class="input-group-append">
                
              </div>
            </div>
          </form>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $dadosfunc['nome']?></span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
          <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Tabela de Funcionários</h6>
            </div>
            <div class="card-body">
              <div class="" id="alterar-custom">
                <form method="POST" class="user">
                  <div class="form-group">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 align-items-center">
                      <input type="text" class="form-control form-control-user align-items-center margin-form-custom" id="nome" placeholder="Nome Completo">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 align-items-center">
                      <input type="text" class="form-control margin-form-custom form-control-user align-items-center" id="matricula" value="<?php echo $dadosfunc['matricula'];?>" disabled>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 align-items-center">
                      <input type="text" class="form-control margin-form-custom form-control-user align-items-center" id="setor" placeholder="Setor">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 align-items-center">
                      <input type="text" class="form-control margin-form-custom form-control-user align-items-center" id="cargo" placeholder="Cargo">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="float: left; margin-left: 0%;">
                      <button id="btn_salvaralt" id-func-alterar="" class="btn btn-user btn-block btn-primary">Salvar</button>
                    </div>
                  </div>

                </form>
              </div>
              
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nome Completo</th>
                      <th>Matricula</th>
                      <th>Setor</th>
                      <th>Cargo</th>
                      <th>Situação</th>
                      <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while( $dadosfunc = mysqli_fetch_array($resultado_queryr) ){ ?>
                      <tr class="table_hover">
                        
                        <td><?php echo $dadosfunc['nome']; ?></td>
                        <td><?php echo $dadosfunc['matricula'] ?></td>
                        <td><?php echo $dadosfunc['setor'] ?></td>
                        <td><?php echo $dadosfunc['cargo'] ?></td>
                        <td><?php echo $dadosfunc['situacao'] ?></td>
                        
                        <td style="text-align: center;">
                          <button id="" class="btn_alterar btn btn-warning" id-func="<?php echo $dadosfunc['id_funcionario']?>">Alterar</button>
                          <button id="" class="btn_des-ativar btn btn-danger" id-matricula="<?php echo $dadosfunc['matricula'] ?>" id-situacao="<?php echo $dadosfunc['situacao']?>" id-nome="<?php echo $dadosfunc['nome'] ?>">Ativar/Desativar</button>
                        </td>

                      </tr>
                    <?php }?>
                  </tbody>
                  
                  <tfoot>
                    <tr>
                      <th>Nome Completo</th>
                      <th>Matricula</th>
                      <th>Setor</th>
                      <th>Cargo</th>
                      <th>Situação</th>
                      <th>#</th>
                    </tr>
                  </tfoot>

                </table>
              </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script type="text/javascript">
    
    $(document).ready(function(){
      $('#alterar-custom').hide();
    });

    $(".btn_alterar").click(function(){
      $('#alterar-custom').show();
      
      var id_funcionario = $(this).attr("id-func");
      
      $("#btn_salvaralt").attr("id-func-alterar", id_funcionario);
      
      var dados = {
        id_funcionario: id_funcionario
      }
      
      $.ajax({
        url: "../../Modal/buscar_funcionario.php",
        type: "POST",
        data: dados,
        dataType: 'json',
        success:function(resposta){
          // console.log(resposta);
          $("#nome").val(resposta.nome);
          $("#setor").val(resposta.setor);
          $("#cargo").val(resposta.cargo);
        }

      })//fim do ajax;
    });
    $("#btn_salvaralt").click(function(e){
      e.preventDefault();

      var id = $(this).attr("id-func-alterar");
      var nome = $("#nome").val();
      var setor = $("#setor").val();
      var cargo = $("#cargo").val();
      
      var dados = {
        id_funcionario: id,
        nome: nome,
        setor: setor,
        cargo: cargo
      }

      // console.log(dados);
      
      $.ajax({
        url: "../../Modal/alterar.php",
        type: "POST",
        data: dados,
        dataType: 'json',
        success:function(resposta){
          if(resposta.retorno == true){
            alert(resposta.message);
            location.reload();
          }else{
            alert(resposta.message);
          }
        }

      })//fim do ajax;
    
    });

    $(".btn_des-ativar").click(function(){

      var matricula = $(this).attr("id-matricula");
      var situacao = $(this).attr("id-situacao");
      var nome = $(this).attr("id-nome");
      var des_ativar = "";
      
      if(situacao == "Ativo" || situacao == "ativo"){
        situacao = "Inativo";
        des_ativar = "Inativar";
      }else{
        situacao = "Ativo";
        des_ativar = "Ativar";
      }

      var dados = {
        matricula: matricula,
        situacao: situacao,
        nome: nome
      }

      // console.log(dados);

      var confirmacao = confirm("Você realmente deseja " + des_ativar + " o funcionário " + nome);
      console.log(confirmacao);

      if(confirmacao == true){
      
        $.ajax({
          url: "../../Modal/desativar_ativar.php",
          type: "POST",
          data: dados,
          dataType: 'json',
          success:function(resposta){
            if(resposta.retorno == true){
              alert(resposta.message);
              location.reload();
            }else{
              alert(resposta.message);
            }
          }
        });//fim do ajax
      
      }else{
        
      }
      

 


    });
        

  </script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
