<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastros de Fornecedor</h1>
        
        <div class="btn-group mr-2">
            <a href="<?= base_url() ?>fornecedor/new" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Fornecedor</a>
            <a onclick="controleDialog()" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-file-excel"></i> Excel</a>
        </div>
    </div>

    <!-- Formulário de Filtro -->
    <form id="filtroStatusForm" action="" method="GET">
        <div class="btn-group mr-2">
            <?php foreach($empresa_fornecedor as $empresa_fornecedor) : ?>   
                <a href="javascript:goEmpresa(<?= $empresa_fornecedor['id_empresa']?>)" class="btn btn-sm btn-outline-secondary"><?= $empresa_fornecedor['razao_social']?></a>
            <?php endforeach;?>
        </div>
    </form>

    <div class="table-responsive">
        <table class="row-border" id="produtos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome Fornecedor</th>
                    <th>CNPJ</th>
                    <th>CEP</th>
                    <th>Endereço</th>
                    <th>Bairro</th>
                    <th>Complemento</th>
                    <th>Cidade</th>
                    <th>Numero</th>
                    <th>IE</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Empresa</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($fornecedor as $fornecedor) : ?>   
                <tr>
                    <td><?= $fornecedor['id_fornecedor']?></td>
                    <td><?= $fornecedor['nome']?></td>
                    <th><?= $fornecedor['cnpj']?></th>
                    <td><?= $fornecedor['cep']?></td>
                    <td><?= $fornecedor['endereco']?></td>
                    <td><?= $fornecedor['bairro']?></td>
                    <td><?= $fornecedor['complemento']?></td>
                    <td><?= $fornecedor['cidade']?></td>
                    <td><?= $fornecedor['numero']?></td>
                    <td><?= $fornecedor['ie']?></td>
                    <td><?= $fornecedor['telefone']?></td>
                    <td><?= $fornecedor['email']?></td>
                    <th><?= strtoupper($fornecedor['nome_fantasia'])?></th>
                    <?php if($fornecedor['status'] == 'T') : ?>
                    <td><span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff; padding: 8px 10px; margin-top: 5px;">Ativo</span></td>
                    <?php else :?>
                    <td><span class="badge badge-pill pull-right" style="background-color: #f28b05; color: #fff; padding: 8px 10px; margin-top: 5px;">Desativado</span></td>
                    <?php endif ; ?>
                    <td>
                    <?php if($fornecedor['status'] == 'T') : ?>
                        <a title="Inativar Fornecedor" href="javascript:goInativa(<?= $fornecedor['id_fornecedor']?>)" class="btn-sm btn-danger"><i class="fa-solid fa-ban"></i></a>
                        <a title="Editar Fornecedor" href="javascript:goEdit(<?= $fornecedor['id_fornecedor']?>)" class="btn btn-warning btn-sm btn-info"><i class="fa-solid fa-pencil"></i></a>
                        <a title="Produtos Vinculados" href="#" class="btn btn-primary btn-sm btn-primary" data-toggle="modal" data-target="#myModal" id="<?php echo $fornecedor['id_fornecedor']; ?>"><i class="fa-solid fa-bottle-water"></i></a>
                        <a title="Documento Fornecedor" href="javascript:goDocumentos(<?= $fornecedor['id_fornecedor']?>)" class="btn btn-dark btn-sm btn-dark"><i class="fa-solid fa-folder-open"></i></a>
                        <a title="Pedido de Compra" href="javascript:goPedido(<?= $fornecedor['id_fornecedor']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-shopping-cart"></i></a>
                    <?php else :?>
                        <a title="Ativar Fornecedor" href="javascript:goAtiva(<?= $fornecedor['id_fornecedor']?>)" class="btn-sm btn-success"><i class="fa-solid fa-check"></i></a>
                        <a title="Editar Fornecedor" href="javascript:goEdit(<?= $fornecedor['id_fornecedor']?>)" class="btn btn-warning btn-sm btn-info"><i class="fa-solid fa-pencil"></i></a>
                        <a title="Produtos Vinculados" href="#" class="btn btn-primary btn-sm btn-primary" data-toggle="modal" data-target="#myModal" id="<?php echo $fornecedor['id_fornecedor']; ?>"><i class="fa-solid fa-bottle-water"></i></a>
                        <a title="Documento Fornecedor" href="javascript:goDocumentos(<?= $fornecedor['id_fornecedor']?>)" class="btn btn-dark btn-sm btn-dark"><i class="fa-solid fa-folder-open"></i></a>
                        <a title="Pedido de Compra" href="javascript:goPedido(<?= $fornecedor['id_fornecedor']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-shopping-cart"></i></a>
                    <?php endif ; ?>    
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        new DataTable('#produtos');
    </script>

<!-- Modal -->
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
                            <th>Preço Venda</th>
                            <th>Estoque</th>
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

function goEmpresa(id) {
    var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
    var myUrl = baseUrl + 'fornecedor/fornecedor_empresa/' + id;
    window.location.href = myUrl;
}

function goEdit(id) {

    swal({
        title: "Deseja Realmente Editar Esse Fornecedor?",
        text: "Essa Ação terá impacto em outras situações",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
            var myUrl = baseUrl + 'fornecedor/editar/' + id;
            window.location.href = myUrl;
        } else {
            return false;
        }
    });
}

function goDocumentos(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'fornecedor/documentos/' + id;
    window.location.href = myUrl;
}

function goInativa(id) {
    swal({
        title: "Deseja Realmente Inativar Esse Fornecedor?",
        text: "Essa Ação terá impacto em outras situações",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            swal("Feito, Fornecedor Desativado !", {
                icon: "success",
            }).then(() => {
                var baseUrl = '<?php echo base_url(); ?>';
                var myUrl = baseUrl + 'fornecedor/inativa/' + id;
                window.location.href = myUrl;
            });
        } else {
            return false;
        }
    });
    
}

function goAtiva(id) {
    swal({
        title: "Deseja Realmente Ativar Esse Fornecedor?",
        text: "Essa Ação terá impacto em outras situações",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            swal("Feito, Fornecedor Ativado !", {
                icon: "success",
            }).then(() => {
                var baseUrl = '<?php echo base_url(); ?>';
                var myUrl = baseUrl + 'fornecedor/ativa/' + id;
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


$(document).ready(function(){
    $("body").on("click", ".btn.btn-primary.btn-sm.btn-primary", function(e){
        e.preventDefault();
        
        var idDoFornecedor = $(this).attr("id");
        
        $.ajax({
            url: "<?php echo site_url('fornecedor/obter_dados');?>",
            type: 'GET',
            dataType: 'json',
            data: { idDoFornecedor: idDoFornecedor }, 
            success: function(data) {
                var html = '';
                $.each(data, function(key, item){
                    html += '<tr>';
                    html += '<td>'+item.id_produto+'</td>';
                    html += '<td>'+item.descricao+'</td>';
                    html += '<td>'+item.cod_aux+'</td>';
                    html += '<th>R$'+parseFloat(item.preco_venda).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</th>';
                    html += '<th>'+parseFloat(item.estoque_atual).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')+'</th>';
                    html += '</tr>';
                });
                $("#dados_grid").html(html);
                $("#myModal").modal('show'); 
            }
        });
    });
});

function aviso() {
        swal("Sucesso!", "Fornecedor Alterado", "success");
        
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
            aviso();
        }
    });

function aviso2() {
        swal("Sucesso!", "Fornecedor Cadastrado", "success");
        
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
        if (avisoParam === 'sucess') {
            aviso2();
        }
    });    
</script>

