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
                        <p style="color: red;">Produto Solicitado para Compra</p>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        new DataTable('#produtos');
    </script>
    
</main>

<script>

function goEmpresa(id) {
    var baseUrl = '<?php echo base_url(); ?>';
    var myUrl = baseUrl + 'produto/produto_empresa/' + id;
    window.location.href = myUrl;
}

function goFoto(id){
	var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'produto/fotos_produto/' + id;

	window.location.href =myUrl;
}

function goInativa(id) {
    swal({
        title: "Deseja Realmente Inativar Esse Produto?",
        text: "Essa Ação terá impacto em outras situações",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            swal("Feito, Produto Desativado !", {
                icon: "success",
            }).then(() => {
                var baseUrl = '<?php echo base_url(); ?>';
                var myUrl = baseUrl + 'produto/inativa/' + id;
                window.location.href = myUrl;
            });
        } else {
            return false;
        }
    });
    
}

function goHistorico(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'produto/historico_produto/' + id;
    window.location.href = myUrl;
}

function goAtiva(id) {
    swal({
        title: "Deseja Realmente Ativar Esse Produto?",
        text: "Essa Ação terá impacto em outras situações",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            swal("Feito, Produto Desativado !", {
                icon: "success",
            }).then(() => {
                var baseUrl = '<?php echo base_url(); ?>'; 
                var myUrl = baseUrl + 'produto/ativa/' + id;
                window.location.href = myUrl;
            });
        } else {
            return false;
        }
    });
}


function goEdit(id) {
    swal({
        title: "Deseja Realmente Editar Esse Produto?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var baseUrl = '<?php echo base_url(); ?>'; 
            var myUrl = baseUrl + 'produto/editar/' + id;
                window.location.href = myUrl;
        } else {
            return false;
        }
    })
}
</script>




<script>
 function controleDialog(){
    swal("Parabéns", "Seu Produto esta com estoque", "success");
	}

	function controleDialog2(){
		swal("Opss...", "Seu Produto esta com estoque abaixo =(", "warning");
	}
    // Na sua função de visualização
    function aviso() {
        swal("Sucesso!", "Produto Cadastrado", "success");
        
        // Limpa o parâmetro 'aviso' da URL
        limparParametroURL('aviso');
    }

    // Função para limpar um parâmetro da URL
    function limparParametroURL(nomeParametro) {
        if (history.replaceState) {
            // Obtém a URL atual sem os parâmetros de consulta
            const novaURL = window.location.protocol + "//" + window.location.host + window.location.pathname;

            // Substitui a URL atual sem o parâmetro especificado
            history.replaceState({}, document.title, novaURL);
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Verifica se o parâmetro 'aviso' está presente na URL
        const urlParams = new URLSearchParams(window.location.search);
        const avisoParam = urlParams.get('aviso');

        // Se o parâmetro 'aviso' for 'sucesso', exibe a modal
        if (avisoParam === 'sucesso') {
            aviso();
        }
    });

    function aviso2() {
        swal("Sucesso!", "Produto Alterado", "success");
        
        // Limpa o parâmetro 'aviso' da URL
        limparParametroURL('aviso');
    }

    // Função para limpar um parâmetro da URL
    function limparParametroURL(nomeParametro) {
        if (history.replaceState) {
            // Obtém a URL atual sem os parâmetros de consulta
            const novaURL = window.location.protocol + "//" + window.location.host + window.location.pathname;

            // Substitui a URL atual sem o parâmetro especificado
            history.replaceState({}, document.title, novaURL);
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Verifica se o parâmetro 'aviso' está presente na URL
        const urlParams = new URLSearchParams(window.location.search);
        const avisoParam = urlParams.get('aviso');

        // Se o parâmetro 'aviso' for 'sucesso', exibe a modal
        if (avisoParam === 'updt') {
            aviso2();
        }
    });
</script>




