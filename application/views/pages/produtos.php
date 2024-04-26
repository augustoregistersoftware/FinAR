<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('application/css/styles_produto.css') ?>">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
        <h1 class="h2">Cadastros de Produtos</h1>
        <div class="btn-group mr-2">
            
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
        <a href="<?= base_url() ?>produto/new_produto" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Produtos</a>
        <a onclick="controleDialog()" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-file-excel"></i> Excel</a>
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
                    <?php if($produtos['estoque_atual'] <= $produtos['estoque_minimo'] and $produtos['qtde_em_compra'] == 0) : ?>
                        <td><?= number_format($produtos['estoque_atual'],2,",",".")?>
                        <p style="color: red;">Produto Indicado a fazer compra</p>
                    <?php elseif($produtos['qtde_em_compra'] > 0 and $produtos['estoque_atual'] <= $produtos['estoque_minimo'] ) : ?>   
                        <td><?= number_format($produtos['estoque_atual'],2,",",".")?>
                        <p style="color: red;">Esse Produto foi pedido</p> 
                    <?php elseif($produtos['estoque_atual'] > $produtos['estoque_minimo']) : ?>
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
                        <a title="Editar Produto" href="javascript:goEdit(<?= $produtos['id_produto']?>)" class="btn btn-warning btn-sm btn-primary"><i class="fa-solid fa-pencil"></i></a>
                        <a title="Historico Produto" href="javascript:goHistorico(<?= $produtos['id_produto']?>)" class="btn btn-primary btn-sm btn-primary"><i class="fa-solid fa-clock"></i></a>
                        <a title="Foto Produto" href="javascript:goFoto(<?= $produtos['id_produto']?>)" class="btn btn-dark btn-sm btn-dark"><i class="fa-solid fa-camera-retro"></i></a>
                        <!-- <a title="Pedido De Compra" href="#" class="btn btn-info btn-sm btn-info" data-toggle="modal" data-target="#myModal" id="<?php echo $produtos['id_produto']; ?>"><i class="fa-solid fa-shopping-cart"></i></a> -->
                        <a title="Pedido De Compra" href="#" class="btn btn-info btn-sm btn-info" data-toggle="modal" data-target="#myModal" id="<?php echo $produtos['id_produto']; ?>"><i class="fa-solid fa-shopping-cart"></i></a>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <div class="toggle-switch">
            <input type="checkbox" id="toggle-rocket" class="toggle-input" onclick="toggleRocket()" checked>
            <label for="toggle-rocket" class="toggle-label"></label>
        </div>
        <div class="flash" id="flash">
            <i title="Dica de Cadastro" class="fas fa-rocket"></i>
            <div class="notification-badge"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        new DataTable('#produtos');
    </script>

<div class="modal fade custom-modal" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" role="document"> <!-- Adicione a classe modal-lg para aumentar a largura da modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pedido Vinculado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <table class="display compact" style="width:100%" id="pedidos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Data Pedido</th>
                            <th>Data Entrega</th>
                            <th>Situação</th>
                            <th>Fornecedor</th>
                            <th>Valor Confirmado</th>
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
      $(document).ready(function(){
    $("body").on("click", ".btn.btn-info.btn-sm.btn-info", function(e){
        e.preventDefault();
        
        var idDoProduto = $(this).attr("id");
        
        $.ajax({
            url: "<?php echo site_url('produto/obter_dados');?>",
            type: 'GET',
            dataType: 'json',
            data: { idDoProduto: idDoProduto }, 
            success: function(data) {
                var html = '';
                $.each(data, function(key, item){
                    html += '<tr>';
                    html += '<td>'+item.id_solicitacao+'</td>';
                    html += '<td>'+item.descricao+'</td>';
                    html += '<td>'+item.data_pedido+'</td>';
                    html += '<td>'+item.data_entrega+'</td>';
                    if (item.status == 'F') {
                        html += '<td><span class="badge badge-pill pull-right" style="background-color: #f28b05; color: #fff; padding: 8px 10px; margin-top: 5px;">Em Aberto</span></td>';
                    } else if (item.status == 'C') {
                        html += '<td><span class="badge badge-pill pull-right" style="background-color: #ea0000; color: #fff; padding: 8px 10px; margin-top: 5px;">Cancelado</span></td>';
                    } else {
                        html += '<td><span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff; padding: 8px 10px; margin-top: 5px;">Fechado</span></td>';
                    }
                    html += '<td>'+item.nome_fornecedor+'</td>';
                    html +=  '<th> R$'+parseFloat(item.valor_confirmado).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</th>';
                    html += '</tr>';
                });
                $("#dados_grid").html(html);
                new DataTable('#pedidos');
                $("#myModal").modal('show'); 
            }
        });
    });
});


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


    function aviso3() {
        swal("Sucesso!", "Empresa do Produto Alterada", "success");
        
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
        if (avisoParam === 'updt_empresa') {
            aviso3();
        }
    });


    function aviso4() {
        swal("Sucesso!", "Fornecedor do Produto Alterada", "success");
        
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
        if (avisoParam === 'updt_fornecedor') {
            aviso4();
        }
    });

    function aviso5() {
        swal("Sucesso!", "Localização do Produto Alterada", "success");
        
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
        if (avisoParam === 'updt_localizacao') {
            aviso5();
        }
    });


    function aviso6() {
        swal("Sucesso!", "Foto do Produto Excluida", "success");
        
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
        if (avisoParam === 'del_foto') {
            aviso6();
        }
    });



    const flash = document.getElementById('flash');
    flash.addEventListener('click', () => {
        ajuda();
    });

    function ajuda(){
        swal("Dica Para Montagem do seu Produto ;)", "DESCRIÇÃO: deixe uma descrição efetiva para simbolizar oque o produto é, CODIO AUXILIAR: Escolha um codigo auxiliar no qual voce sabe que vai exatamente aquele produto e que seja unico em ambas as empresas pois por ele que voce ira consultar");
    }
    // Na sua função de visualização


</script>






