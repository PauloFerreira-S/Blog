  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-tema">
    <div class="col-md-6 mdnav">
      <a class="navbar-brand" href="/">
        <img src="/assets/img/logo_navbar.png" width="72" height="44" alt="logo navbar">
      </a>
      <a href="/">
      
      <!-- MUDE AQUI O NOME NA BARRA DE NAVEGAÇÃO, NA LINHA H1 O NOME COMPLETO NA LINHA A SPAN O NOME ABREVIADO AMBOS PODEM SER IGUAIS-->
        <h1 class='desktop-navbar h1navbar'>BLOG</h1>
        <span class="mobile-navbar h1navbar">BLOG</span>
      </a>
    </div>
    <button class="navbar-toggler text-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="col-md-6">
      <div class="collapse navbar-collapse" id="navbarResponsive">

        <?php if ($logado == "") { ?>

          <ul class="nav navbar-nav ml-auto">
            <li class="dropdown font-weight-bold">
              <a class="nav-link texto-navbar" href="/">Home</a>
            </li>
            <li class="dropdown font-weight-bold">
              <a class="nav-link texto-navbar" href="/entrar.php">Entrar</a>
            </li>
          </ul>

        <?php } else { ?>

          <ul class="nav navbar-nav ml-auto">
            <li class="dropdown font-weight-bold">
              <a class="nav-link texto-navbar" href="/">Home</a>
            </li>
            <li class="dropdown font-weight-bold">
              <a class="nav-link texto-navbar" href="/adm.php">Administração</a>
            </li>
            <li class="dropdown font-weight-bold">
              <a class="nav-link texto-navbar" href="/sair.php">Usúario <?php $user = strtoupper($logado);
                                                                        echo ($user); ?>, Sair</a>
            </li>
          </ul>

        <?php } ?>

      </div>
    </div>
  </nav>