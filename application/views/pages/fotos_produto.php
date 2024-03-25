<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Cadastros de Fotos Do Produto</h1>
        <div class="btn-group mr-2">
            <a href="<?= base_url() ?>produto/new_foto" class="btn btn-sm btn-outline-secondary"><i class="fas fa-plus-square"></i> Foto</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="row-border" id="documentos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome Do Arquivo</th>
                    <th>Nome Produto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($fotos as $fotos) : ?>   
                <tr>
                    <th><?= $fotos['id_documento_prod']?></th>
                    <td><?= $fotos['nome']?></td>
                    <th><?= strtoupper($fotos['descricao'])?></th>
                    <td> 
                    <a title="Abrir Foto" href="#" class="btn btn-info btn-sm btn-info abrir-foto" data-toggle="modal" data-target="#modalFoto" data-caminho="\finar\imagens\<?= $fotos['arquivo'] ?>"><i class="fa-solid fa-folder-open"></i></a>
                    <a title="Deletar Foto" href="javascript:goDelete(<?= $fotos['id_documento_prod']?>)" class="btn btn-danger btn-sm btn-danger"><i class="fa-solid fa-xmark"></i></a>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
		<div class="form-group">
			<a href="<?= base_url() ?>produto" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
		</div>			
	</div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        new DataTable('#documentos')
    </script>
    
</main>

<!-- Modal -->
<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="modalFotoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFotoLabel">Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="" class="img-fluid" id="fotoExibida">
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Ao clicar no link
    $('.abrir-foto').click(function() {
      // Obter o caminho da foto do atributo data-caminho
      var caminhoFoto = $(this).data('caminho');
      // Definir o src da imagem dentro da modal
      $('#fotoExibida').attr('src', caminhoFoto);
    });
  });
</script>
<!-- Fim Da Modal -->

<script>
function goDelete(id) {
    swal({
        title: "Deseja Realmente Deletar Essa Foto?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var baseUrl = '<?php echo base_url(); ?>'; 
            var myUrl = baseUrl + 'produto/delete_foto/' + id;
                window.location.href = myUrl;
        } else {
            return false;
        }
    })
}

</script>
