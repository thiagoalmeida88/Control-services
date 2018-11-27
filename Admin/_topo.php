<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>            
        </button>
        <a class="navbar-brand" href="index.php">Control Service</a> 
    </div> 
    <?php if(isset($_SESSION['email'])){ ?>
    <div style="color: white;
         padding: 15px 50px 5px 50px;
         float: right;
         font-size: 16px;"> Seja bem-vindo<?= $_SESSION['perfil'] == 2 ? ', <a href="alterar_cliente.php?cod=' . $_SESSION['cod'] . '">' . $_SESSION['email'] . '</a>': ', ' . $_SESSION['email'] ?> &nbsp; <a href="_menu.php?close=1" class="btn btn-danger square-btn-adjust">Sair</a> </div>
    <?php } ?>
</nav>


