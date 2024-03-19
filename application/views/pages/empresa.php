<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastros de Empresas</h1>
        <div class="btn-group mr-2">
            <a href="<?= base_url() ?>empresa/new" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Empresa</a>
            <a onclick="controleDialog()" class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-file-excel"></i> Excel</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="row-border" id="empresa">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Razão Social</th>
                    <th>Nome Fantasia</th>
                    <th>CNPJ</th>
                    <th>CEP</th>
                    <th>Endereço</th>
                    <th>Numero</th>
                    <th>Bairro</th>
                    <th>Complemento</th>
                    <th>Cidade</th>
                    <th>UF</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($empresa as $empresa) : ?>   
                <tr>
                    <th><?= $empresa['id_empresa']?></th>
                    <td style="color: <?= ($empresa['situacao'] == 'T') ? 'green' : 'red'; ?>"><?= $empresa['razao_social']?></td>
                    <td style="color: <?= ($empresa['situacao'] == 'T') ? 'green' : 'red'; ?>"><?= $empresa['nome_fantasia']?></td>
                    <th><?= $empresa['cnpj']?></th>
                    <td><?= $empresa['cep']?></td>
                    <td><?= $empresa['endereco']?></td>
                    <td><?= $empresa['numero']?></td>
                    <td><?= $empresa['bairro']?></td>
                    <td><?= $empresa['complemento']?></td>
                    <td><?= $empresa['cidade']?></td>
                    <td><?= $empresa['uf']?></td>
                    <td><?= $empresa['telefone']?></td>
                    <td> 
                        <?php if($empresa['situacao'] == 'T') : ?>
                            <a title="Editar Empresa" href="javascript:goEdit(<?= $empresa['id_empresa']?>)" class="btn btn-warning btn-sm btn-info"><i class="fa-solid fa-pencil"></i></a>
                            <a title="Inativar Empresa" href="javascript:goInativa(<?= $empresa['id_empresa']?>)" class="btn btn-primary btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></a>
                        <?php else : ?>
                            <a title="Editar Empresa" href="javascript:goEdit(<?= $empresa['id_empresa']?>)" class="btn btn-warning btn-sm btn-info"><i class="fa-solid fa-pencil"></i></a>
                            <a title="Ativar Empresa" href="javascript:goAtiva(<?= $empresa['id_empresa']?>)" class="btn btn-success btn-sm btn-success"><i class="fa-solid fa-check"></i></a>
                        <?php endif; ?>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        new DataTable('#empresa')
    </script>
    
</main>

<script>
function goEdit(id) {
    var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
    var myUrl = baseUrl + 'empresa/editar/' + id;
    if (confirm("Deseja realmente Editar?")) {
        window.location.href = myUrl;
    } else {
        return false;
    }
}

function goAtiva(id) {
    var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
    var myUrl = baseUrl + 'empresa/ativa/' + id;
    if (confirm("Deseja realmente ativar essa empresa?")) {
        window.location.href = myUrl;
    } else {
        return false;
    }
}

function goInativa(id) {
    var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
    var myUrl = baseUrl + 'empresa/inativa/' + id;
    if (confirm("Deseja realmente inativar essa empresa?")) {
        window.location.href = myUrl;
    } else {
        return false;
    }
}

</script>
