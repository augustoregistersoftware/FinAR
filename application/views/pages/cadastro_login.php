<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastros de Usuario</h1>
        <div class="btn-group mr-2">
            <a href="<?= base_url() ?>localizacao/new" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Usuario</a>
            <a href="<?= base_url() ?>localizacao/new" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Perfil</a>
            <a onclick="controleDialog()" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-file-excel"></i> Excel</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="row-border" id="localizacao">
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
                        <a title="Editar Login" href="javascript:goInativa(<?= $cadastro_login['id_login']?>)" class="btn btn-primary btn-sm btn-warning"><i class="fa-solid fa-pencil"></i></a>
                        <a title="Permissões Login" href="javascript:goInativa(<?= $cadastro_login['id_login']?>)" class="btn btn-primary btn-sm btn-primary"><i class="fa-solid fa-key"></i></a>
                        <a title="Senha" href="javascript:goValida(<?= $cadastro_login['id_login']?>)" class="btn btn-primary btn-sm btn-secondary"><i class="fa-solid fa-circle-info"></i></a>
                        <a title="Deletar Login" href="javascript:goInativa(<?= $cadastro_login['id_login']?>)" class="btn btn-primary btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        new DataTable('#localizacao')
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



</script>

<style>
    body {
        font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 
    }
</style>
