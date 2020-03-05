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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="reservas.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-parking"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Ponto Digital</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
        
      <!-- Divider -->
      <hr class="sidebar-divider">



      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="cadastro-funcionario.html">
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
              <div class="row" id="alterar-custom">
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 align-items-center">
                  <input type="text" class="form-control form-control-user align-items-center margin-form-custom" id="nome" placeholder="Nome Completo">
                </div>
                
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 align-items-center">
                  <input type="text" class="form-control margin-form-custom form-control-user align-items-center" id="matricula" placeholder="Matricula">
                </div>

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 align-items-center">
                  <input type="text" class="form-control margin-form-custom form-control-user align-items-center" id="cpf" placeholder="cpf">
                </div>

                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 align-items-center">
                  <input type="text" class="form-control margin-form-custom form-control-user align-items-center" id="cargo" placeholder="Cargo">
                </div>
                <div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <button onclick="sumirrdiv()" style="float: right; margin: 20px;" class="btn btn-success">Salvar</button>
                </div>
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
                          <button onclick="exibirdiv()" class="btn btn-warning">Alterar</button>
                          <button class="btn btn-danger">Excluir</button>
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
    
    $('#alterar-custom').hide();

    function exibirdiv(){
        $('#alterar-custom').show();
      }

      function sumirrdiv(){
        $('#alterar-custom').hide();
      }

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
