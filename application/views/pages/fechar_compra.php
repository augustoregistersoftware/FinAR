<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Fechar Pedido</h1>
    </div>

    <div class="table-responsive">
    <form action="<?= base_url() ?>compra/encerrar_fechar/<?= $id_pedido ?>" method="post">
        <table class="row-border" id="localizacao">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Codigo Auxiliar</th>
                    <th>Custo</th>
                    <th>Estoque Atual</th>
                    <th>Quantidade Solicitada</th>
                    <th>Quantidade Recebida</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produtos as $produtos) : ?>   
                <tr>
                    <th><?= $produtos['id_produto']?></th>
                    <td><?= $produtos['descricao']?></td>
                    <td><?= $produtos['cod_aux']?></td>
                    <th><?= number_format($produtos['custo'], 2, ",", ".")?></th>
                    <td><?= number_format($produtos['estoque_atual'], 2, ",", ".")?></td>
                    <td><?= number_format($produtos['quantidade'], 2, ",", ".")?></td>
                    <td><?= number_format($produtos['quantidade_recebida'], 2, ",", ".")?></td>
                <?php endforeach;?>
            </tbody>
        </table>
        <form action="" method="post" enctype="multipart/form-data">
        <div class="col-md-6">
			<div class="form-group">
				<label for="produto">Produtos A Confirmar</label>
					<select name="produto" id="produto" class="form-control pesquisa__select col-12 selectCustom">
                        <?php foreach($produtos_condicao as $produtos_condicao) : ?>
                            <option value="<?= $produtos_condicao["id_produto"] ?>"><?php echo $produtos_condicao["descricao"]; ?></option>
                        <?php endforeach;?> 
					</select>
			</div>
		</div>

        <div class="col-md-6">
			<div class="form-group">
				<label for="qtde_recebida">Informe a Quantidade Recebida:</label>
				<input type="number" class="form-control" name="qtde_recebida" id="qtde_recebida" placeholder="Quatidade Recebida" required>
			</div>
		</div>

        <div class="col-md-6">
			<div class="form-group">
				<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Confirmar</button>
				<a href="<?= base_url() ?>compra/end/<?= $id_pedido ?>" class="btn btn-success btn-xs"><i class="fa-solid fa-check-double"></i> Save</a>
				<a href="<?= base_url() ?>compra" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
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
