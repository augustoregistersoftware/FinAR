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
                        <a onclick="controleDialog2()" class="btn btn-primary btn-sm btn-warning"><i class="fa-solid fa-circle-exclamation"></i></a>
                    <?php else : ?>
                        <a id="btn_dialog" onclick="controleDialog()" class="btn btn-sm btn-success"><i class="fa-regular fa-thumbs-up"></i></a>
                    <?php endif; ?>
                    <th><?= $compra['id_solicitacao']?></th>
                    <td><?= $compra['descricao']?></td>
                    <td><?= $compra['data_pedido']?></td>
                    <td><?= $compra['data_entrega']?></td>
                    <th>R$ <?= number_format($compra['valor'],2,",",".")?></th>
                    <td><?= $compra['nome_pagamento']?>/<?= $compra['nome_banco']?></td>
                    <?php if($compra['status'] == 'F') : ?>
				        <td><span class="badge badge-pill pull-right" style="background-color: #f28b05; color: #fff;     padding: 8px 10px; margin-top: 5px;">Em Aberto</span></td>
			        <?php else :?>
				        <td><span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff;     padding: 8px 10px; margin-top: 5px;">Fechado</span></td>
			        <?php endif ; ?>
                    <th><?= strtoupper($compra['nome_fornecedor'])?></th>
                    <td> 
                        <?php if($compra['status'] == 'F') : ?>
                            <a title="Produtos Vinculados" href="#" class="btn btn-primary btn-sm btn-primary" data-toggle="modal" data-target="#myModal" id="<?php echo $compra['id_solicitacao']; ?>"><i class="fa-solid fa-bottle-water"></i></a>
                            <a title="Fechar Solicitação" href="javascript:goAtiva(<?= $compra['id_solicitacao']?>)" class="btn btn-success btn-sm btn-success"><i class="fa-solid fa-check"></i></a>
                            <a title="Documentos Solicitação" href="javascript:goDocumentos(<?= $compra['id_solicitacao']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-file"></i></a>    
                        <?php else :?>
                            <a title="Produtos Vinculados" href="#" class="btn btn-primary btn-sm btn-primary" data-toggle="modal" data-target="#myModal" id="<?php echo $compra['id_solicitacao']; ?>"><i class="fa-solid fa-bottle-water"></i></a>
                            <a title="Abrir Solicitação" href="javascript:goInativa(<?= $compra['id_solicitacao']?>)" class="btn btn-primary btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></a>
                            <a title="Documentos Solicitação" href="javascript:goDocumentos(<?= $compra['id_solicitacao']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-file"></i></a>
                        <?php endif ; ?>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        new DataTable('#compras')
    </script>
    
</main>

<!-- Aqui começa a montagem da modal -->
<dialog id="d1">
<div class="popup center">
	<div class="icon2">
	<i class="fa-solid fa-check"></i>		
	</div>
			<h3>Pedido Em Dia!!</h3>
			<p>Seu Pedido Ainda esta em dia com a data</p>
			<div class="dismiss-btn">	
			<button id="dismiss-popup-btn" onclick="fecharDialog()">
				OK
			</button>
			</div>
	</div>
</dialog>

<dialog id="d2">
<div class="popup center">
	<div class="icon">
	<i class="fa-solid fa-x"></i>		
	</div>
			<h3>Pedido Atrasado!!</h3>
			<p>Seu Pedido esta atrasado entre em contato</p>
			<div class="dismiss-btn">	
			<button id="dismiss-popup-btn" onclick="fecharDialog2()">
				OK
			</button>
			</div>
	</div>
</dialog>

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
		const button = document.getElementById("btn_dialog")
		const modal = document.querySelector("dialog")
		modal.showModal()
	}

	function fecharDialog(){
		const modal =document.querySelector("dialog")
		modal.close()
	}

	function controleDialog2(){
		const button = document.getElementById("btn_dialog")
		const modal = document.getElementById("d2")
		modal.showModal()
	}

	function fecharDialog2(){
		const modal = document.getElementById("d2")
		modal.close()
	}

</script>
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
p{
	color: #FF3333;
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

.popup .icon2{
	margin:5px 0px;
	width: 50px;
	height: 50px;
	border: 2px solid #34f234;
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
