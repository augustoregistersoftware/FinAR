<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">]
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastros de Documentos</h1>
        <div class="btn-group mr-2">
            
        </div>
    </div>

    <div class="table-responsive">
    <a href="<?= base_url() ?>fornecedor/new_documentos" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Documento</a>
        <table class="row-border" id="documentos">
            
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome Documento</th>
                    <th>Fornecedor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($documentos as $documentos) : ?>   
                <tr>
                    <th><?= $documentos['id_documento_fornc']?></th>
                    <td><?= $documentos['nome']?></td>
                    <td><?= $documentos['razao_social']?></td>
                    <td> 
                        <a title="Abrir Documento" href="javascript:goAbrir(<?= $documentos['id_documento_fornc']?>)" class="btn btn-info btn-sm btn-info"><i class="fa-solid fa-folder-open"></i></a>
                        <a title="Deletar Documento" href="javascript:goDelete(<?= $documentos['id_documento_fornc']?>)" class="btn btn-danger btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></a>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
		<div class="form-group">
			<a href="<?= base_url() ?>fornecedor" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
		</div>			
	</div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        new DataTable('#documentos')
    </script>
    
</main>

<script>

function goAbrir(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'fornecedor/abir_documento/' + id;
        window.location.href = myUrl;
}

function goDelete(id) {

    swal({
        title: "Deseja Realmente Deletar Esse Documento?",
        text: "Essa Ação terá impacto em outras situações",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            swal("Feito, Documento Deletado !", {
                icon: "success",
            }).then(() => {
                var baseUrl = '<?php echo base_url(); ?>';
                var myUrl = baseUrl + 'fornecedor/delete_documento/' + id;
                window.location.href = myUrl;
            });
        } else {
            return false;
        }
    });
    
}

</script>
