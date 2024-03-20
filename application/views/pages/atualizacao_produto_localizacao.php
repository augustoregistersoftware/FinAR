<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2">Alterar Localização Produto</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          </div>
        </div>
      </div>

			<div class="col-md-12">
					<form action="<?= base_url() ?>produto/update_localizacao/<?= $produto_localizacao_editar['id_produto'] ?>" method="post">
                <div class="col-md-6">
						<div class="form-group">
							<label for="localizacao_atual">Localização Atual</label>
							<input type="text" class="form-control" name="localizacao_atual" id="localizacao_atual" placeholder="Localização" value="<?= isset($produto_localizacao_editar) ? $produto_localizacao_editar["nome_localizacao"] : "" ?>" disabled>
						</div>
				</div>

					<div class="col-md-6">
							<div class="form-group">
							<label for="localizacao">localização</label>
								<select name="localizacao" id="localizacao" class="form-control pesquisa__select col-12 selectCustom">
								<?php foreach($localizacao as $localizacao) : ?>
								<option value="<?= $localizacao["id_localizacao"] ?>"><?php echo $localizacao["nome"]; ?></option>
								<?php endforeach;?>
								</select>
							</div>
						</div>

					<div class="col-md-6">
						<div class="form-group">	
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
							<a href="<?= base_url() ?>produto" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
						</div>			
					</div>
				</form>
			</div>
    </main>
  </div>
</div>


