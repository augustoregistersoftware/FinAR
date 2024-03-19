<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <h1 class="h2">Cadastros de Produtos</h1>
        <div class="btn-group mr-2">
            <a href="<?= base_url() ?>produto/new_produto" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Produtos</a>
            <a onclick="controleDialog()" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-file-excel"></i> Excel</a>
        </div>
    </div>

    <!-- Formulário de Filtro -->
    <form id="filtroStatusForm" action="" method="GET">
        <div class="btn-group mr-2">
            <?php foreach($empresa_produtos as $empresa_produtos) : ?>   
                <a href="javascript:goEmpresa(<?= $empresa_produtos['id_empresa']?>)" class="btn btn-sm btn-outline-secondary"><?= $empresa_produtos['razao_social']?></a>
            <?php endforeach;?>
        </div>
    </form>

    <div class="table-responsive">
        <table class="row-border" id="produtos">
            <thead>
                <tr>
                    <th>Situação</th>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Código De Barras</th>
                    <th>Código Auxiliar</th>
                    <th>Custo</th>
                    <th>Preço De Venda</th>
                    <th>Estoque Atual</th>
                    <th>Estoque Minimo</th>
                    <th>Localização</th>
                    <th>Fornecedor</th>
                    <th>Empresa</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($produtos as $produtos) : ?>   
                <tr>
                    <td>
                    <?php if($produtos['estoque_atual'] <= $produtos['estoque_minimo']) : ?>
                        <a onclick="controleDialog2()" class="btn btn-primary btn-sm btn-warning"><i class="fa-solid fa-circle-exclamation"></i></a>
                    <?php else : ?>
                        <a id="btn_dialog" onclick="controleDialog()" class="btn btn-sm btn-success"><i class="fa-regular fa-thumbs-up"></i></a>
                    <?php endif; ?>
                    <th><?= $produtos['id_produto']?></th>
                    <td><?= $produtos['descricao']?></td>
                    <td><?= $produtos['cod_barras']?></td>
                    <td><?= $produtos['cod_aux']?></td>
                    <td style="color: #e81515;">R$ <?= number_format($produtos['custo'], 2, ",", ".")?></td>
                    <td style="color: #e81515;">R$ <?= number_format($produtos['preco_venda'],2,",",".")?></td>
                    <?php if($produtos['estoque_atual'] <= $produtos['estoque_minimo']) : ?>
                        <td><?= number_format($produtos['estoque_atual'],2,",",".")?>
                        <br/><p>Produto Solicitado para Compra</p></td>
                    <?php else : ?>
                        <td><?= number_format($produtos['estoque_atual'],2,",",".")?></td>
                    <?php endif; ?>
                    <td><?= number_format($produtos['estoque_minimo'],2,",",".")?></th>
                    <td><?= $produtos['nome_localizacao']?></td>
                    <th><?= strtoupper($produtos['nome_fornecedor'])?></th>
                    <th><?= $produtos['razao_social']?></th>
                    <?php if($produtos['status'] == 'T') : ?>
                    <td><span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff; padding: 8px 10px; margin-top: 5px;">Ativo</span></td>
                    <?php else :?>
                    <td><span class="badge badge-pill pull-right" style="background-color: #f28b05; color: #fff; padding: 8px 10px; margin-top: 5px;">Desativado</span></td>
                    <?php endif ; ?>
                    <td>
                        <?php if($produtos['status'] == 'T') : ?>
                            <a title="Inativar Produto" href="javascript:goInativa(<?= $produtos['id_produto']?>)" class="btn btn-primary btn-sm btn-danger"><i class="fa-solid fa-ban"></i></a>
                        <?php else :?>
                            <a title="Ativar Produto" href="javascript:goAtiva(<?= $produtos['id_produto']?>)" class="btn btn-primary btn-sm btn-success"><i class="fa-solid fa-check"></i></i></a>
                        <?php endif ; ?>    
                        <a title="Editar Produto" href="javascript:goEdit(<?= $produtos['id_produto']?>)" class="btn btn-warning btn-sm btn-info"><i class="fa-solid fa-pencil"></i></a>
                        <a title="Historico Produto" href="javascript:goHistorico(<?= $produtos['id_produto']?>)" class="btn btn-primary btn-sm btn-primary"><i class="fa-solid fa-clock"></i></a>
                        <a title="Foto Produto" href="javascript:goFoto(<?= $produtos['id_produto']?>)" class="btn btn-dark btn-sm btn-dark"><i class="fa-solid fa-camera-retro"></i></a>
                        <a title="Pedido De Compra" href="javascript:goFoto(<?= $produtos['id_produto']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-shopping-cart"></i></a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        new DataTable('#produtos');
    </script>
    
</main>

<script>

function goEmpresa(id) {
    var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
    var myUrl = baseUrl + 'produto/produto_empresa/' + id;
    window.location.href = myUrl;
}

function goFoto(id){
	var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'produto/fotos_produto/' + id;

	window.location.href =myUrl;
}

function goInativa(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'produto/inativa/' + id;
    if (confirm("Deseja realmente inativar esse produto?")) {
        window.location.href = myUrl;
    } else {
        return false;
    }
}

function goHistorico(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'produto/historico_produto/' + id;
    window.location.href = myUrl;
}

function goAtiva(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'produto/ativa/' + id;
    if (confirm("Deseja realmente ativar esse produto?")) {
        window.location.href = myUrl;
    } else {
        return false;
    }
}


function goEdit(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'produto/editar/' + id;
    if (confirm("Deseja realmente editar esse produto?")) {
        window.location.href = myUrl;
    } else {
        return false;
    }
}
</script>




<!-- Aqui começa a montagem da modal -->
<dialog id="d1">
<div class="popup center">
	<div class="icon2">
	<i class="fa-solid fa-check"></i>		
	</div>
			<h3>Produto Liberado!!</h3>
			<p>Produto Com Estoque Acima do Limite!</p>
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
			<h3>Produto Abaixo!!</h3>
			<p>Produto Com Estoque Limitado Cuidado!</p>
			<div class="dismiss-btn">	
			<button id="dismiss-popup-btn" onclick="fecharDialog2()">
				OK
			</button>
			</div>
	</div>
</dialog>


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
