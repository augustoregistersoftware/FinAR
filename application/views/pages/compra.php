<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastros de Compras</h1>
        <div class="btn-group mr-2">
            <a href="<?= base_url() ?>compra/new" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Compra</a>
            <a onclick="controleDialog()" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-file-excel"></i> Excel</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="row-border" id="compras">
            <thead>
                <tr>
                    <th>Situação</th>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Data Do Pedido</th>
                    <th>Data Da Entrega</th>
                    <th>Valor</th>
                    <th>Pagamento/Banco</th>
                    <th>Status</th>
                    <th>Fornecedor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($compra as $compra) : ?>   
                <tr>
                    <td>
                    <?php if($compra['situacao'] == 'Atrasado') : ?>
                        <a title="Pedido Atrasado" onclick="controleDialog2()" class="btn btn-primary btn-sm btn-warning"><i class="fa-solid fa-circle-exclamation"></i></a>
					<?php elseif($compra['situacao'] == 'Finalizado') : ?>
                        <a title="Pedido Finalizado" onclick="controleDialog3()" class="btn btn-primary btn-sm btn-primary"><i class="fa-solid fa-check-double"></i></a>
					<?php elseif($compra['situacao'] == 'Cancelado') : ?>
                        <a title="Pedido Cancelado" onclick="controleDialog4()" class="btn btn-primary btn-sm btn-danger"><i class="fa-solid fa-ban"></i></a>	
                    <?php else : ?>
                        <a id="btn_dialog" onclick="controleDialog()" class="btn btn-sm btn-success"><i class="fa-regular fa-thumbs-up"></i></a>
                    <?php endif; ?>
                    <th><?= $compra['id_solicitacao']?></th>
                    <td><?= $compra['descricao']?></td>
                    <td><?= $compra['data_pedido']?></td>
					<?php if($compra['situacao'] == 'Atrasado') : ?>
                    	<td><?= $compra['data_entrega']?>-<p style="color: #e81515;">Atrasado</p></td>
					<?php else : ?>
						<td><?= $compra['data_entrega']?></td>
					<?php endif; ?>
                    <th>R$ <?= number_format($compra['valor'],2,",",".")?></th>
					<?php if($compra['nome_pagamento'] == 'Pix') : ?>
						<td><?= $compra['nome_pagamento']?>/<?= $compra['nome_banco']?> <img src="\finar\imagens\pix_logo_icon_248846.png"></td>
					<?php elseif($compra['nome_pagamento'] == 'Boleto') : ?>
						<td>><?= $compra['nome_pagamento']?>/<?= $compra['nome_banco']?> <img src="\finar\imagens\barcode_icon_138897.png"</td>
					<?php elseif($compra['nome_pagamento'] == 'Cartão') : ?>
						<td><?= $compra['nome_pagamento']?>/<?= $compra['nome_banco']?> <img src="\finar\imagens\1495815230-jd11_84589.png"></td>
					<?php elseif($compra['nome_pagamento'] == 'Cheque') : ?>
						<td><?= $compra['nome_pagamento']?>/<?= $compra['nome_banco']?> <img src="\finar\imagens\Bank_Check_27026.png"></td>
					<?php else : ?>
						<td><?= $compra['nome_pagamento']?>/<?= $compra['nome_banco']?> <img src="\finar\imagens\cash_40532.png"></td>
					<?php endif; ?>
                    <?php if($compra['status'] == 'F') : ?>
				        <td><span class="badge badge-pill pull-right" style="background-color: #f28b05; color: #fff;     padding: 8px 10px; margin-top: 5px;">Em Aberto</span></td>
					<?php elseif($compra['status'] == 'C') : ?>
				        <td><span class="badge badge-pill pull-right" style="background-color: #ea0000; color: #fff;     padding: 8px 10px; margin-top: 5px;">Cancelado</span></td>
			        <?php else :?>
				        <td><span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff;     padding: 8px 10px; margin-top: 5px;">Fechado</span></td>
			        <?php endif ; ?>
                    <th><?= strtoupper($compra['nome_fornecedor'])?></th>
                    <td> 
                        <?php if($compra['status'] == 'F') : ?>
                            <a title="Produtos Vinculados" href="#" class="btn btn-primary btn-sm btn-primary" data-toggle="modal" data-target="#myModal" id="<?php echo $compra['id_solicitacao']; ?>"><i class="fa-solid fa-bottle-water"></i></a>
                            <a title="Fechar Solicitação" href="javascript:goAtiva(<?= $compra['id_solicitacao']?>)" class="btn btn-success btn-sm btn-success"><i class="fa-solid fa-check"></i></a>
                            <a title="Documentos Solicitação" href="javascript:goDocumentos(<?= $compra['id_solicitacao']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-file"></i></a>    
                            <a title="Cancelar Solicitação" href="javascript:goDocumentos(<?= $compra['id_solicitacao']?>)" class="btn btn-info btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>    
						<?php elseif($compra['status'] == 'C') : ?>
                            <a title="Produtos Vinculados" href="#" class="btn btn-primary btn-sm btn-primary" data-toggle="modal" data-target="#myModal" id="<?php echo $compra['id_solicitacao']; ?>"><i class="fa-solid fa-bottle-water"></i></a>
                            <a title="Abrir Solicitação" href="javascript:goAtiva(<?= $compra['id_solicitacao']?>)" class="btn btn-success btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></a>
                            <a title="Documentos Solicitação" href="javascript:goDocumentos(<?= $compra['id_solicitacao']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-file"></i></a> 	
                        <?php else :?>
                            <a title="Produtos Vinculados" href="#" class="btn btn-primary btn-sm btn-primary" data-toggle="modal" data-target="#myModal" id="<?php echo $compra['id_solicitacao']; ?>"><i class="fa-solid fa-bottle-water"></i></a>
                            <a title="Abrir Solicitação" href="javascript:goInativa(<?= $compra['id_solicitacao']?>)" class="btn btn-primary btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></a>
                            <a title="Documentos Solicitação" href="javascript:goDocumentos(<?= $compra['id_solicitacao']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-file"></i></a>
							<a title="Cancelar Solicitação" href="javascript:goDocumentos(<?= $compra['id_solicitacao']?>)" class="btn btn-info btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>    
                        <?php endif ; ?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        new DataTable('#compras')
    </script>
    
</main>


<script>
function goEdit(id) {
    var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
    var myUrl = baseUrl + 'localizacao/editar/' + id;
    if (confirm("Deseja realmente Editar?")) {
        window.location.href = myUrl;
    } else {
        return false;
    }
}


function goAtiva(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'localizacao/ativa/' + id;
    if (confirm("Deseja realmente ativar essa localizacao?")) {
        window.location.href = myUrl;
    } else {
        return false;
    }
}

function goInativa(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'localizacao/inativa/' + id;
    if (confirm("Deseja realmente inativar essa localizacao?")) {
        window.location.href = myUrl;
    } else {
        return false;
    }
}

function goDocumentos(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'localizacao/documentos/' + id;
    window.location.href = myUrl;
}

</script>

<script>
  function controleDialog(){
    swal("Ebaa!!", "Seu Pedido esta normal =)", "info");
	}

	function controleDialog2(){
		swal("Oops...", "Seu Pedido esta atrasado =(", "warning");
	}

	function controleDialog3(){
		swal("Parabéns", "Seu Pedido esta finalizado =)", "success");
	}

	function controleDialog4(){
		swal("Cancelado", "Seu Pedido esta cancelado !!", "error");
	}
</script>

