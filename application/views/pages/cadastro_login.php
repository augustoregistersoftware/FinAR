<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
        <h1 class="h2">Cadastros de Usuarios</h1>
        <div class="btn-group mr-2">
            <a href="<?= base_url() ?>cadastro_login/new_login" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Usuario</a>
            <a onclick="controleDialog()" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-file-excel"></i> Excel</a>
        </div>
    </div>


    <div class="table-responsive">
        <table id="localizacao" class="display" style="width:100%">
        <div class="btn-group mr-2">
            <a href="<?= base_url() ?>cadastro_login/new_login" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Usuario</a>
            <a onclick="controleDialog()" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-file-excel"></i> Excel</a>
        </div>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Perfil</th>
                    <th>Empresa</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cadastro_login as $cadastro_login) : ?>   
                <tr>
                    <th><?= $cadastro_login['id_login']?></th>
                    <td><?= $cadastro_login['nome']?></td>
                    <th><?= $cadastro_login['email']?></th>
                    <th><?= strtoupper($cadastro_login['nome_permissao'])?></th>
                    <th><?= strtoupper($cadastro_login['nome_fantasia'])?></th>
                    <td> 
                        <a title="Editar Login" href="javascript:goEdit(<?= $cadastro_login['id_login']?>)" class="btn btn-primary btn-sm btn-warning"><i class="fa-solid fa-pencil"></i></a>
                        <a title="Permissões Login" href="#" class="btn btn-info btn-sm btn-info" data-toggle="modal" data-target="#myModal" id="<?php echo $cadastro_login['id_perfil']; ?>"><i class="fa-solid fa-key"></i></a>
                        <a title="Senha" href="javascript:goValida(<?= $cadastro_login['id_login']?>)" class="btn btn-primary btn-sm btn-secondary"><i class="fa-solid fa-circle-info"></i></a>
                        <a title="Deletar Login" href="javascript:goInativa(<?= $cadastro_login['id_login']?>)" class="btn btn-primary btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        new DataTable('#localizacao');
    </script>

<div class="modal fade custom-modal" id="myModal" role="dialog">
<div class="modal-dialog custom-modal-dialog" role="document"> <!-- Adicione a classe modal-lg para aumentar a largura da modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perfil De Permissões Vinculado</h5>
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
                            <th>Usuario</th>
                            <th>Cliente</th>
                            <th>Produto</th>
                            <th>Fornecedor</th>
                            <th>Compra</th>
                            <th>localização</th>
                            <th>Financeiro</th>
                            <th>Empresa</th>
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
        
        var idDoLogin = $(this).attr("id");
        
        $.ajax({
            url: "<?php echo site_url('cadastro_login/obter_dados');?>",
            type: 'GET',
            dataType: 'json',
            data: { idDoLogin: idDoLogin }, 
            success: function(data) {
                var html = '';
                $.each(data, function(key, item){
                    html += '<tr>';
                    html += '<td>' + item.id_permissao + '</td>';
                    html += '<th>' + item.nome_permissao + '</th>';
                    html += '<td>' + (item.usuario == 'F' ? '<span class="badge badge-pill pull-right" style="background-color: #ea0000; color: #fff; padding: 8px 10px; margin-top: 5px;">✖️</span>' : '<span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff; padding: 8px 10px; margin-top: 5px;">✔️</span>') + '</td>';
                    html += '<td>' + (item.cliente == 'F' ? '<span class="badge badge-pill pull-right" style="background-color: #ea0000; color: #fff; padding: 8px 10px; margin-top: 5px;">✖️</span>' : '<span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff; padding: 8px 10px; margin-top: 5px;">✔️</span>') + '</td>';
                    html += '<td>' + (item.produto == 'F' ? '<span class="badge badge-pill pull-right" style="background-color: #ea0000; color: #fff; padding: 8px 10px; margin-top: 5px;">✖️</span>' : '<span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff; padding: 8px 10px; margin-top: 5px;">✔️</span>') + '</td>';
                    html += '<td>' + (item.fornecedor == 'F' ? '<span class="badge badge-pill pull-right" style="background-color: #ea0000; color: #fff; padding: 8px 10px; margin-top: 5px;">✖️</span>' : '<span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff; padding: 8px 10px; margin-top: 5px;">✔️</span>') + '</td>';
                    html += '<td>' + (item.compra == 'F' ? '<span class="badge badge-pill pull-right" style="background-color: #ea0000; color: #fff; padding: 8px 10px; margin-top: 5px;">✖️</span>' : '<span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff; padding: 8px 10px; margin-top: 5px;">✔️</span>') + '</td>';
                    html += '<td>' + (item.localizacao == 'F' ? '<span class="badge badge-pill pull-right" style="background-color: #ea0000; color: #fff; padding: 8px 10px; margin-top: 5px;">✖️</span>' : '<span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff; padding: 8px 10px; margin-top: 5px;">✔️</span>') + '</td>';
                    html += '<td>' + (item.financeiro == 'F' ? '<span class="badge badge-pill pull-right" style="background-color: #ea0000; color: #fff; padding: 8px 10px; margin-top: 5px;">✖️</span>' : '<span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff; padding: 8px 10px; margin-top: 5px;">✔️</span>') + '</td>';
                    html += '<td>' + (item.empresa == 'F' ? '<span class="badge badge-pill pull-right" style="background-color: #ea0000; color: #fff; padding: 8px 10px; margin-top: 5px;">✖️</span>' : '<span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff; padding: 8px 10px; margin-top: 5px;">✔️</span>') + '</td>';
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
        Swal.fire({
            title: "Parabens",
            text: "Login Cadastrado",
            icon: "success"
        });
        
        // Limpa o parâmetro 'aviso' da URL
        limparParametroURL('aviso');
    }

function avisoDelete() {
        Swal.fire({
            title: "Parabens",
            text: "Login Deletado",
            icon: "success"
        });
        
        // Limpa o parâmetro 'aviso' da URL
        limparParametroURL('aviso');
    } 
    
    function avisoUpdate() {
        Swal.fire({
            title: "Parabens",
            text: "Login Alterado",
            icon: "success"
        });
        
        // Limpa o parâmetro 'aviso' da URL
        limparParametroURL('aviso');
    }  

    function avisoUpdateEmpresa() {
        Swal.fire({
            title: "Parabens",
            text: "Empresa Alterada",
            icon: "success"
        });
        
        // Limpa o parâmetro 'aviso' da URL
        limparParametroURL('aviso');
    }  

    function avisoUpdatePerfil() {
        Swal.fire({
            title: "Parabens",
            text: "Perfil Alterado",
            icon: "success"
        });
        
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
        if (avisoParam === 'delete') {
            avisoDelete();
        }
    });

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
            avisoUpdate();
        }
    });

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
            avisoUpdateEmpresa();
        }
    });

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
        if (avisoParam === 'updt_perfil') {
            avisoUpdatePerfil();
        }
    });
</script>


<style>
    .custom-modal-dialog {
        max-width: 990px; /* ou qualquer outra largura desejada */
    }
</style>



