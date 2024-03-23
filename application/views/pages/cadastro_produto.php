<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	  <?php if(isset($produto_editar)) : ?>
					
			<h1 class="h2">Alterar Produto</h1>
				<?php else : ?>
					<h1 class="h2">Cadastro de Produto</h1>
				<?php endif; ?>
      
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          </div>
        </div>
      </div>

			<div class="col-md-12">
			<?php if(isset($produto_editar)) : ?>
					
					<form action="<?= base_url() ?>produto/update/<?= $produto_editar['id_produto'] ?>" method="post">
				<?php else : ?>
					<form action="<?= base_url() ?>produto/inserte" method="post" enctype="multipart/form-data">
				<?php endif; ?>

                <div class="col-md-6">
						<div class="form-group">
							<label for="descricao">Descrição Do Produto</label>
							<input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição Do Produto" value="<?= isset($produto_editar) ? $produto_editar["descricao"] : "" ?>">
						</div>
				</div>

                <div class="col-md-6">
						<div class="form-group">
							<label for="cod_barra">Código De Barras</label>
							<input type="number" class="form-control" name="cod_barra" id="cod_barra" placeholder="Código De Barras" value="<?= isset($produto_editar) ? $produto_editar["cod_barras"] : "" ?>">
						</div>
				</div>    

                <div class="col-md-6">
						<div class="form-group">
							<label for="cod_aux">Código Auxiliar *<a id="btn_dialog" onclick="controleDialog()" class="btn btn-sm btn-warning"><i class="fa-solid fa-exclamation"></i></a></label>
							<input type="text" class="form-control" name="cod_aux" id="cod_aux" placeholder="Código Auxiliar" required value="<?= isset($produto_editar) ? $produto_editar["cod_aux"] : "" ?>">
						</div>
				</div>


                <div class="col-md-6">
						<div class="form-group">
							<label for="custo">Custo</label>
							<input type="text" class="form-control" name="custo" id="custo" placeholder="R$ Custo" value="<?= isset($produto_editar) ? $produto_editar["custo"] : "" ?>">
						</div>
				</div>

                <div class="col-md-6">
						<div class="form-group">
							<label for="preco_venda">Preço De Venda *</label>
							<input type="text" class="form-control" name="preco_venda" id="preco_venda" placeholder="R$ Preço De Venda" required value="<?= isset($produto_editar) ? $produto_editar["preco_venda"] : "" ?>">
						</div>
				</div>

                <div class="col-md-6">
						<div class="form-group">
							<label for="estoque_atual">Estoque Atual *</label>
							<input type="number" class="form-control" name="estoque_atual" id="estoque_atual" placeholder="Estoque Atual" required value="<?= isset($produto_editar) ? $produto_editar["estoque_atual"] : "" ?>">
						</div>
				</div>

                <div class="col-md-6">
						<div class="form-group">
							<label for="estoque_minimo">Estoque Minimo *</label>
							<input type="number" class="form-control" name="estoque_minimo" id="estoque_minimo" placeholder="Estoque Minimo" required value="<?= isset($produto_editar) ? $produto_editar["estoque_minimo"] : "" ?>">
						</div>
				</div>
				<?php if(isset($produto_editar)) : ?>

				<?php else : ?>	

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
							<label for="fornecedor">Fornecedor</label>
								<select name="fornecedor" id="fornecedor" class="form-control pesquisa__select col-12 selectCustom">
								<?php foreach($fornecedor as $fornecedor) : ?>
								<option value="<?= $fornecedor["id_fornecedor"] ?>"><?php echo $fornecedor["nome"]; ?></option>
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
						
						
					<div class="col-md-6">
							<div class="form-group">
								<label for="nome_foto">Nome Da Foto</label>
								<input type="text" class="form-control" name="nome_foto" id="nome_foto" placeholder="Nome Da Foto" >
							</div>
					</div>
					<label>Arquivo</label>
					<input type="file" name="file" accept="image/*"><br><br>
				<?php endif; ?>
						

					<div class="col-md-6">
						<div class="form-group">
						<?php if(isset($produto_editar)) : ?>
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
							<a href="<?= base_url() ?>produto/form_update_localizacao/<?= $produto_editar['id_produto'] ?>" class="btn btn-warning btn-xs"><i class="fas fa-pencil"></i> Editar Localização</a>
							<a href="<?= base_url() ?>produto/form_update_fornecedor/<?= $produto_editar['id_produto'] ?>" class="btn btn-warning btn-xs"><i class="fas fa-pencil"></i> Editar Fornecedor</a>
							<a href="<?= base_url() ?>produto/form_update_empresa/<?= $produto_editar['id_produto'] ?>" class="btn btn-warning btn-xs"><i class="fas fa-pencil"></i> Editar Empresa</a>
							<a href="<?= base_url() ?>produto" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
						<?php else : ?>	
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
							<a href="<?= base_url() ?>produto" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
						<?php endif; ?>
						</div>			
					</div>
				</form>
			</div>

    </main>
  </div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
function controleDialog(){
	swal("Lembrete!", "O código auxiliar server para saber o relaciomento dos produtos entres as empresas", "info");
	}

</script>
