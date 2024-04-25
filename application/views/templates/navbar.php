<div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
            <li>
              <form class="form-inline mr-auto">
                <div class="search-element">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
                  <button class="btn" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        <?php if(isset($listagem)) : ?>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
              <span class="badge headerBadge1">
              <?= $quantidade_messagem['quantidade_messagem']?> </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Messages
                <div class="float-right">
                  <a href="<?php base_url(); ?>/finar/messages/ciencia_mensagem/">Marcar Como Lidas</a>
                </div>
              </div>  
              <div class="dropdown-list-content dropdown-list-message">
              <?php foreach($listagem as $listagem) : ?> 
                <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"><img alt="image" src="\finar\imagens\lagom-email.png" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user"><?= $listagem['nome']?></span>
                    <span class="time messege-text"><?= $listagem['conteudo']?></span>
                    <span class="time"><?= $listagem['tempo_passado']?> Ago</span>
                  </span>
                  <?php endforeach;?>
                </a>
              </div>
            </div>
          </li>
          <?php else : ?>

          <?php endif; ?>  
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="\finar\imagens\icone_u.png"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Olá,<?php echo $this->session->userdata('name'); ?>
              <br><small class="text-muted"><?php echo $this->session->userdata('profile'); ?></small></div>
              <a href="profile.html" class="dropdown-item has-icon"> <i class="far
										fa-user"></i> Profile
              </a> <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Activities
              </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url() ?>login" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="\finar\imagens\icone.png" class="header-logo" /> <span
                class="logo-name">FinAR</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="dropdown">
              <a href="<?= base_url() ?>dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="users"></i><span>Usuarios</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= base_url() ?>cadastro_login">Cadastro De Usuario</a></li>
                <li><a class="nav-link" href="widget-data.html">Cadastro De Perfil</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="<?= base_url() ?>clientes" class="nav-link"><i data-feather="user"></i><span>Clientes</span></a>
            </li>

            <li class="dropdown">
              <a href="<?= base_url() ?>produto" class="nav-link"><i data-feather="box"></i><span>Produtos</span></a>
            </li>

            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="truck"></i><span>Fornecedor</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= base_url() ?>fornecedor">Cadastro</a></li>
                <li><a class="nav-link" href="<?= base_url() ?>compra">Compras</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="<?= base_url() ?>localizacao" class="nav-link"><i data-feather="map-pin"></i><span>Localização</span></a>
            </li>


            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i
                  data-feather="dollar-sign"></i><span>Financeiro</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?= base_url() ?>fornecedor">Vendas</a></li>
                <li><a class="nav-link" href="<?= base_url() ?>compra">Cobrança</a></li>
                <li><a class="nav-link" href="<?= base_url() ?>compra">Viagem</a></li>
                <li><a class="nav-link" href="<?= base_url() ?>compra">Bancos</a></li>
                <li><a class="nav-link" href="<?= base_url() ?>compra">Forma De Pagamento</a></li>
                <li><a class="nav-link" href="<?= base_url() ?>compra">Status</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="<?= base_url() ?>empresa" class="nav-link"><i data-feather="hexagon"></i><span>Empresa</span></a>
            </li>

            <li class="dropdown">
              <a href="<?= base_url() ?>mensagem" class="nav-link"><i data-feather="mail"></i><span>Mensagem</span></a>
            </li>
            
          </ul>
        </aside>
      </div>