<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Montagem De Compra - Produtos Escolhidos - Finalizar</h1>
    </div>

    <div class="table-responsive">
    <form action="<?= base_url() ?>compra/encerrar/" method="post">
        <table class="row-border" id="localizacao">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Codigo Auxiliar</th>
                    <th>Custo</th>
                    <th>Estoque Atual</th>
                    <th>Quantidade Solicitada</th>
                    <th>Total</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produtos_compra as $produtos_compra) : ?>   
                <tr>
                    <th><?= $produtos_compra['id_produto']?></th>
                    <td><?= $produtos_compra['descricao']?></td>
                    <td><?= $produtos_compra['cod_aux']?></td>
                    <th><?= number_format($produtos_compra['custo'], 2, ",", ".")?></th>
                    <td><?= number_format($produtos_compra['estoque_atual'], 2, ",", ".")?></td>
                    <td><?= number_format($produtos_compra['quantidade'], 2, ",", ".")?></td>
                    <td><?= number_format($produtos_compra['total'], 2, ",", ".")?></td>
                    <td> 
                        <a title="Excluir Produto" href="javascript:goDelete(<?= $produtos_compra['id_produto']?>)" class="btn btn-warning btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                <?php endforeach;?>
            </tbody>
        </table>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="col-md-6">
			<div class="form-group">
				<label for="nome_fornecedor">Subtotal:</label>
				<input type="text" class="form-control" name="nome_fornecedor" id="nome_fornecedor" placeholder="Nome Do Fornecedor" value="<?= isset($produtos_compra_subtotal) ? number_format($produtos_compra_subtotal["subtotal"], 2, ",", ".") : "" ?>" disabled>
			</div>
		</div>
        <div class="col-md-6">
			<div class="form-group">
				<label for="subtotal">Confirme Subtotal:</label>
				<input type="text" class="form-control" name="subtotal" id="subtotal" placeholder="Confirme Subtotal" required>
			</div>
		</div>

        <div class="col-md-6">
			<div class="form-group">
				<label for="pagamento">Forma De Pagamento</label>
				<select name="pagamento" id="pagamento" class="form-control pesquisa__select col-12 selectCustom">
						<?php foreach($forma_pagto as $forma_pagto) : ?>
							<option value="<?= $forma_pagto["id_forma_pagto"] ?>"><?php echo $forma_pagto["nome"]; ?>/<?php echo $forma_pagto["nome_banco"]; ?></option>
						<?php endforeach;?> 
				</select>
			</div>
		</div>

        <div class="col-md-6">
			<div class="form-group">
				<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
				<a href="<?= base_url() ?>fornecedor" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
			</div>			
		</div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        new DataTable('#localizacao')
    </script>
    
</main>

<script>
function goDelete(id) {
    swal({
        title: "Deseja Realmente Remover Esse Item desse Pedido?",
        text: "Confirme, essa ação tera grande impacto",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
            var myUrl = baseUrl + 'compra/remover_item/' + id;
            window.location.href = myUrl;
        } else {
            return false;
        }
    });
}
</script>
