<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastros de Localizações</h1>
        <div class="btn-group mr-2">
            
        </div>
    </div>

    <div class="table-responsive">
        <a href="<?= base_url() ?>localizacao/new" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Localização</a>
        <a onclick="controleDialog()" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-file-excel"></i> Excel</a>
        <table class="row-border" id="localizacao">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome Localização</th>
                    <th>Nome Fantasia Empresa</th>
                    <th>CNPJ</th>
                    <th>CEP</th>
                    <th>Cidade</th>
                    <th>Endereço</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($localizacao as $localizacao) : ?>   
                <tr>
                    <th><?= $localizacao['id_localizacao']?></th>
                    <td><?= $localizacao['nome']?></td>
                    <td><?= $localizacao['nome_fantasia']?></td>
                    <th><?= $localizacao['cnpj']?></th>
                    <td><?= $localizacao['cep']?></td>
                    <td><?= $localizacao['cidade']?></td>
                    <td><?= $localizacao['endereco']?></td>
                    <?php if($localizacao['status'] == 'F') : ?>
				        <td><span class="badge badge-pill pull-right" style="background-color: #f28b05; color: #fff;     padding: 8px 10px; margin-top: 5px;">Inativo</span></td>
			        <?php else :?>
				        <td><span class="badge badge-pill pull-right" style="background-color: #03ab14; color: #fff;     padding: 8px 10px; margin-top: 5px;">Ativo</span></td>
			        <?php endif ; ?>
                    <td> 
                            <a title="Editar Localizacao" href="javascript:goEdit(<?= $localizacao['id_localizacao']?>)" class="btn btn-warning btn-sm btn-info"><i class="fa-solid fa-pencil"></i></a>
                            <?php if($localizacao['status'] == 'F') : ?>
                                <a title="Ativar Localizacao" href="javascript:goAtiva(<?= $localizacao['id_localizacao']?>)" class="btn btn-success btn-sm btn-success"><i class="fa-solid fa-check"></i></a>    
                            <?php else :?>    
                                <a title="Inativar Localizacao" href="javascript:goInativa(<?= $localizacao['id_localizacao']?>)" class="btn btn-primary btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></a>
                            <?php endif ; ?>
                                <a title="Documentos Localização" href="javascript:goDocumentos(<?= $localizacao['id_localizacao']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-file"></i></a>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
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
