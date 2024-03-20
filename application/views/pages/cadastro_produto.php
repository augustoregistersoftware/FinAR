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
							<a href="<?= base_url() ?>produto" class="btn btn-warning btn-xs"><i class="fas fa-pencil"></i> Editar Fornecedor</a>
							<a href="<?= base_url() ?>produto" class="btn btn-warning btn-xs"><i class="fas fa-pencil"></i> Editar Empresa</a>
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

<dialog id="d1">
<div class="popup center">
	<div class="icon2">		
	</div>
			<h3>Aviso!</h3>
			<p>O Codigo Auxiliar é utilizado para você saber que são o mesmo Produto
            so que estão em empresas distintas
            </p>
			<div class="dismiss-btn">	
			<button id="dismiss-popup-btn" onclick="fecharDialog()">
				OK
			</button>
			</div>
	</div>
</dialog>

<!-- Aqui começa o CSS da modal -->
<style> 
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");
dialog{
    padding: 0;
	border: 0;
	border-radius: 7px;
	box-shadow: 0 0 10px black;
	flex-direction: column;
}

dialog::backdrop{
	background-color: rgba(0, 0, 0, 0.5);
}

.title{
	background-color: #eee;
	border-top-right-radius: inherit;
	border-top-left-radius: inherit;
	padding: 7px;
	display: flex;
	align-items: center;
	border-bottom: 1px solid #aaa;
	height: 40px;
}

.popup{
	width: 350px;
	height: 280px;
	padding: 30px 20px;
	background: #f5f5f5;
	border-radius: 10px;
	background-color: #fff;
	box-sizing: border-box;
	z-index: 2;
	text-align: center;
}

.popup .icon{
	margin:5px 0px;
	width: 50px;
	height: 50px;
	border: 2px solid #FF3333;
	text-align: center;
	display: inline-block;
	border-radius: 50%;
	line-height: 60px;
}

.popup .icon i.fa{
	font-size: 30px;
	color: #FF3333;

}
.popup .title{
	margin: 5px 0px;
	font-size: 30px;
	font-weight: 600;
}

.popup .dismiss-btn{
	margin-top: 15px;
}

.popup .dismiss-btn button{
	padding: 10px 20px;
	background: #111;
	color: #f5f5f5;
	border: 2px solid #111;
	font-size: 16px;
	font-weight: 600;
	outline: none;
	border-radius: 10px;

}

</style>

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
function controleDialog(){
		const button = document.getElementById("btn_dialog")
		const modal = document.querySelector("dialog")
		modal.showModal()
	}

	function fecharDialog(){
		const modal =document.querySelector("dialog")
		modal.close()
	}

</script>

