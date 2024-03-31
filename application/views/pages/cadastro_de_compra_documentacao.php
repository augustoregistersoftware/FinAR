<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Montagem De Compra - Documentação</h1>      

    </div>
			<div class="col-md-12">		
				<form action="<?= base_url() ?>compra/inserte_compra_documentacao" method="post" enctype="multipart/form-data">

				<form action="" method="post" enctype="multipart/form-data">

                <div class="col-md-6">
						<div class="form-group">
							<label for="descricao">Descrição Da Compra</label>
							<input type="text" class="form-control" name="descricao" id="descricao" placeholder="Descrição Da Compra" required>
						</div>
				</div>

                <div class="col-md-6">
					<div class="form-group">
						<label for="data_pedido">Data Do Pedido</label>
						<input type="date" name="data_pedido" id="data_pedido" name="trip-start" value="" min="1753-01-01" max="9998-12-31" class="form-control" required >
					</div>
				</div>

                <div class="col-md-6">
					<div class="form-group">
						<label for="data_entrega">Data Da Entrega</label>
						<input type="date" name="data_entrega" id="data_entrega" name="trip-start" value="" min="1753-01-01" max="9998-12-31" class="form-control" required >
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
                
                <label>Arquivo</label>
                <input type="file" name="file" id="file" accept="application/pdf" onchange="checkFileSize(this)"><br><br>
				<p>Tamanho máximo do arquivo: 900 KB</p>
						

					<div class="col-md-6">
						<div class="form-group">
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Proximo</button>
							<a href="<?= base_url() ?>compra" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
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
function checkFileSize(input) {
    // Verifica se um arquivo foi selecionado
    if (input.files.length > 0) {
        // Obtem o tamanho do arquivo em bytes
        var fileSize = input.files[0].size;
        // Tamanho máximo permitido em bytes (800 KB)
        var maxSize = 900 * 1024;
        // Verifica se o tamanho do arquivo excede o limite
        if (fileSize > maxSize) {
            alert("O tamanho do arquivo selecionado excede o limite de 900 KB.");
            // Limpa o campo de arquivo selecionado
            input.value = '';
        }
    }
}
</script>

