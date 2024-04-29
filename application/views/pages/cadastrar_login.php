<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	  <?php if(isset($login_editar)) : ?>
					
			<h1 class="h2">Alterar Login</h1>
				<?php else : ?>
					<h1 class="h2">Cadastro de Login</h1>
				<?php endif; ?>
      
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          </div>
        </div>
      </div>

			<div class="col-md-12">
			<?php if(isset($login_editar)) : ?>
					
					<form action="<?= base_url() ?>cadastro_login/editar/<?= $login_editar['id_login'] ?>" method="post">
				<?php else : ?>
					<form action="<?= base_url() ?>cadastro_login/inserte" method="post" enctype="multipart/form-data">
				<?php endif; ?>

				<form action="" method="post" enctype="multipart/form-data">
					<div class="col-md-6">
						<div class="form-group">
							<label for="nome">Nome</label>
							<input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" value="<?= isset($login_editar) ? $login_editar["nome"] : "" ?>">
						</div>
					</div>


					<div class="col-md-6">
						<div class="form-group">
							<label for="email">E-mail<a id="btn_dialog" onclick="controleDialog()" class="btn btn-sm btn-warning"><i class="fa-solid fa-exclamation"></i></a></label>
							<input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required value="<?= isset($login_editar) ? $login_editar["email"] : "" ?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="senha">Senha</label>
							<input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" value="<?php echo isset($login_editar) ? htmlspecialchars(openssl_decrypt($login_editar['senha'], 'AES-128-ECB', 'bNzLsJB3/H$dasrg654fg'), ENT_QUOTES, 'UTF-8') : ''; ?>">
						</div>
					</div>


					<?php if(isset($login_editar)) : ?>
						
					<?php else : ?>
						<div class="col-md-6">
							<div class="form-group">
								<label for="senha_confirma">Confirme a Senha</label>
								<input type="text" class="form-control" name="senha_confirma" id="senha_confirma" placeholder="Confirmar Senha" value="<?= isset($login_editar) ? $login_editar["senha"] : "" ?>" required>
							</div>
						</div>
					<?php endif; ?>

					<?php if(isset($login_editar)) : ?>

					<?php else : ?>
						<div class="col-md-6">
						<div class="form-group">
							<label for="perfil">Pefil</label>
							<select name="perfil" id="perfil" class="form-control pesquisa__select col-12 selectCustom">
							<?php foreach($perfil as $perfil) : ?>
							<option value="<?= $perfil["id_permissao"] ?>"><?php echo $perfil["nome_permissao"]; ?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div> 

					<div class="col-md-6">
						<div class="form-group">
							<label for="empresa">Empresa</label>
							<select name="empresa" id="empresa" class="form-control pesquisa__select col-12 selectCustom">
							<?php foreach($empresas as $empresas) : ?>
							<option value="<?= $empresas["id_empresa"] ?>"><?php echo $empresas["razao_social"]; ?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div>
					<?php endif; ?>
					
					<div class="col-md-6">
						<div class="form-group">
						<?php if(isset($login_editar)) : ?>
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
							<a href="<?= base_url() ?>cadastro_login" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
							<a href="<?= base_url() ?>cadastro_login" class="btn btn-warning btn-xs"><i class="fas fa-pencil"></i> Perfil</a>
							<a href="<?= base_url() ?>cadastro_login" class="btn btn-warning btn-xs"><i class="fas fa-pencil"></i> Empresa</a>
						<?php else : ?>
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
							<a href="<?= base_url() ?>cadastro_login" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
						<?php endif; ?>	
						</div>			
					</div>
				</form>
			</div>

    </main>
  </div>
</div>

<style>
	select.selectCustom:focus {
    box-shadow: 0 0 0 0;
    border: 1px solid #ccc;
    outline: 0;
}
select.selectCustom{
  border-radius: 30px !important
}

</style>

<script>
		document.getElementById('senha_confirma').addEventListener('change', function() {
        var senha = document.getElementById('senha').value;
        var senha_confirma = this.value;

        if (senha === senha_confirma) {
            
        } else {
            this.value = "";
            controleDialog1();
        }
    });
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
