<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Cadastro De Foto Produto</h1>      

    </div>
			<div class="col-md-12">		
				<form action="<?= base_url() ?>produto/inserte_foto" method="post" enctype="multipart/form-data">

				<form action="" method="post" enctype="multipart/form-data">

                <div class="col-md-6">
						<div class="form-group">
							<label for="nome_documento">Nome Da Foto</label>
							<input type="text" class="form-control" name="nome_documento" id="nome_documento" placeholder="Nome Do Foto">
						</div>
				</div>
                <div class="col-md-6">
						<div class="form-group">
						<label for="produto">Nome Produto\Nome Empresa</label>
							<select name="produto" id="produto" class="form-control pesquisa__select col-12 selectCustom">
							<?php foreach($empresas_produto as $empresas_produto) : ?>
							<option value="<?= $empresas_produto["id_produto"] ?>"><?php echo $empresas_produto["descricao"]; ?>\<?php echo $empresas_produto["razao_social"]; ?></option>
							<?php endforeach;?>
							</select>
						</div>
					</div>
                
                <label>Arquivo</label>
                <input type="file" name="file" accept="image/*"><br><br>
						

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


