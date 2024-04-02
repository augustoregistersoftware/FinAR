<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastros de Compras</h1>
        <div class="btn-group mr-2">
            <a href="<?= base_url() ?>compra/new_compra" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Compra</a>
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
                    <th>Valor Dos Produtos</th>
                    <th>Valor Total Conferido</th>
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
                    <th>R$ <?= number_format($compra['valor_confirmado'],2,",",".")?></th>
					<?php if($compra['nome_pagamento'] == 'Pix') : ?>
						<td><?= $compra['nome_pagamento']?>/<?= $compra['nome_banco']?> <img src="\finar\imagens\pix_logo_icon_248846.png"></td>
					<?php elseif($compra['nome_pagamento'] == 'Boleto') : ?>
						<td><?= $compra['nome_pagamento']?>/<?= $compra['nome_banco']?> <img src="\finar\imagens\barcode_icon_138897.png"</td>
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
                            <a title="Fechar Solicitação" href="javascript:goFecha(<?= $compra['id_solicitacao']?>)" class="btn btn-success btn-sm btn-success"><i class="fa-solid fa-check"></i></a>
                            <a title="Documentos Solicitação" href="javascript:goDocumentos(<?= $compra['id_solicitacao']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-file"></i></a>    
                            <a title="Cancelar Solicitação" href="javascript:goCancela(<?= $compra['id_solicitacao']?>)" class="btn btn-info btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>    
						<?php elseif($compra['status'] == 'C') : ?>
                            <a title="Produtos Vinculados" href="#" class="btn btn-primary btn-sm btn-primary" data-toggle="modal" data-target="#myModal" id="<?php echo $compra['id_solicitacao']; ?>"><i class="fa-solid fa-bottle-water"></i></a>
                            <a title="Documentos Solicitação" href="javascript:goDocumentos(<?= $compra['id_solicitacao']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-file"></i></a> 	
                        <?php else :?>
                            <a title="Produtos Vinculados" href="#" class="btn btn-primary btn-sm btn-primary" data-toggle="modal" data-target="#myModal" id="<?php echo $compra['id_solicitacao']; ?>"><i class="fa-solid fa-bottle-water"></i></a>
                            <a title="Documentos Solicitação" href="javascript:goDocumentos(<?= $compra['id_solicitacao']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-file"></i></a>
							<a title="Cancelar Solicitação" href="javascript:goCancela(<?= $compra['id_solicitacao']?>)" class="btn btn-info btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>    
                        <?php endif ; ?>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <div class="flash" id="flash">
            <i title="Dica de Cadastro" class="fas fa-bell"></i>
            <div class="notification-badge"><span>2</span></div>
            <div class="notification-badge"></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        new DataTable('#compras')
    </script>
    
    <div class="modal fade custom-modal" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document"> <!-- Adicione a classe modal-lg para aumentar a largura da modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Produtos Vinculados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Cod Aux</th>
                            <th>Custo</th>
                            <th>Estoque</th>
                            <th>Qtd Comprada</th>
                            <th>Qtd Recebida</th>
                        </tr>
                    </thead>
                    <tbody id="dados_grid">
                        <!-- Os dados da grid serão inseridos aqui via JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
</main>


<script>
function goFecha(id) {

    swal({
        title: "Deseja Realmente Fechar Esse Pedido?",
        text: "Confira Tudo antes de fechar, essa ação tera grande impacto",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
            var myUrl = baseUrl + 'compra/fechar/' + id;
            window.location.href = myUrl;
        } else {
            return false;
        }
    });
}

function goCancela(id) {
    swal({
        title: "Deseja Realmente Cancelar Esse Pedido?",
        text: "Confira Tudo antes de cancelar, essa ação tera grande impacto",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
            var myUrl = baseUrl + 'compra/cancela/' + id;
            window.location.href = myUrl;
        } else {
            return false;
        }
    });
}

function goDocumentos(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'localizacao/documentos/' + id;
    window.location.href = myUrl;
}

$(document).ready(function(){
    $("body").on("click", ".btn.btn-primary.btn-sm.btn-primary", function(e){
        e.preventDefault();
        
        var idDoPedido = $(this).attr("id");
        
        $.ajax({
            url: "<?php echo site_url('compra/obter_dados');?>",
            type: 'GET',
            dataType: 'json',
            data: { idDoPedido: idDoPedido }, 
            success: function(data) {
                var html = '';
                $.each(data, function(key, item){
                    html += '<tr>';
                    html += '<td>'+item.id_produto+'</td>';
                    html += '<td>'+item.descricao+'</td>';
                    html += '<td>'+item.cod_aux+'</td>';
                    html += '<th>R$'+parseFloat(item.custo).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</th>';
                    html += '<th>'+parseFloat(item.estoque_atual).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</th>';
                    html += '<th>'+parseFloat(item.qtd_comprada).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</th>';
                    html += '<th>'+parseFloat(item.qtd_recebida).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</th>';
                    html += '</tr>';
                });
                $("#dados_grid").html(html);
                $("#myModal").modal('show'); 
            }
        });
    });
});

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

    const flash = document.getElementById('flash');
    flash.addEventListener('click', () => {
        aviso();
        toggleRocket();
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Acessa a variável PHP $atrasado definida na view
        var atrasado = <?php echo json_encode($atrasado); ?>;

        if (atrasado && atrasado.atrasada > 0) {
            // Faça algo se 'atrasada' for maior que zero
        } else {
            // Caso contrário, chame a função toggleRocket()
            toggleRocket();
        }
    });

    let rocketVisible = true;

    function toggleRocket() {
    const rocket = document.getElementById('flash');
    rocketVisible = !rocketVisible;
    rocket.style.display = rocketVisible ? 'block' : 'none';
}

    function aviso() {
        var atrasado = <?php echo json_encode($atrasado); ?>;
        swal("Aviso!!", "Você tem" + atrasado.atrasada + "pedidos atrasados por favor verifique com seu fornecedor!", "warning");
    }
</script>

<style>

.flash {
    width: 60px; /* Largura da div */
    height: 60px; /* Altura da div */
    background-color: blue; /* Cor de fundo da div */
    border-radius: 50%; /* Torna a div redonda */
    position: fixed; /* Posição fixa */
    bottom: 20px; /* Distância do fundo */
    right: 20px; /* Distância da direita */
    display: flex; /* Para centralizar o ícone */
    justify-content: center; /* Para centralizar o ícone */
    align-items: center; /* Para centralizar o ícone */
    cursor: pointer; /* Mostrar o cursor como um ponteiro */
}

.flash i {
    font-size: 2.5em; /* Tamanho do ícone */
    color: white; /* Cor do ícone */
    display: flex; /* Para centralizar o ícone */
    justify-content: center; /* Para centralizar o ícone */
    animation: pulse 1s infinite;
}

.flash .notification-badge {
    position: absolute;
    top: -5px; /* Ajuste para meio em cima */
    right: 0; /* Ajuste para meio em cima */
    width: 20px;
    height: 20px;
    background-color: red; /* Cor vermelha */
    color: white;
    font-size: 12px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.flash .notification-badge span {
    color: white; /* Cor do número */
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

</style>