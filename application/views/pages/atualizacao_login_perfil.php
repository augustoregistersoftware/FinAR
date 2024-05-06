<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2">Alterar Perfil Login</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          </div>
        </div>
      </div>

			<div class="col-md-12">
					<form action="<?= base_url() ?>cadastro_login/update_perfil/<?= $login_perfil_editar['id_login'] ?>" method="post">
                <div class="col-md-6">
						<div class="form-group">
							<label for="empresa_atual">Perfil Atual</label>
							<input type="text" class="form-control" name="empresa_atual" id="empresa_atual" placeholder="Empresa" value="<?= isset($login_perfil_editar) ? $login_perfil_editar["nome_permissao"] : "" ?>" disabled>
						</div>
				</div>

					<div class="col-md-6">
							<div class="form-group">
							<label for="empresa">Perfis</label>
								<select name="empresa" id="empresa" class="form-control pesquisa__select col-12 selectCustom">
								<?php foreach($perfil as $perfil) : ?>
								<option value="<?= $perfil["id_permissao"] ?>"><?php echo $perfil["nome_permissao"]; ?></option>
								<?php endforeach;?>
								</select>
							</div>
						</div>

					<div class="col-md-6">
						<div class="form-group">	
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
							<a href="<?= base_url() ?>cadastro_login" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
						</div>			
					</div>
				</form>
			</div>
    </main>
  </div>
</div>


