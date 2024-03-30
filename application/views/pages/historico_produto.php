<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Historico Do Produto</h1>
    </div>

    <div class="table-responsive">
        <table class="row-border" id="empresa">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Quantidade Anterior</th>
                    <th>Quantidade Atual</th>
                    <th>Quatidade Movimentada</th>
                    <th>Data e Hora da Atualização</th>
                    <th>Status da Operação</th>
                    <th>Operação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($historico as $historico) : ?>   
                <tr>
                    <th><?= $historico['id_historico']?></th>
                    <th><?= $historico['descricao']?></th>
                    <td><?= number_format($historico['Quantidade Anterior'],2,",",".")?></td>
                    <td><?= number_format($historico['Quantidade Atual'],2,",",".")?></td>
                    <td class="<?= ($historico['Quantidade Movimentada'] < 0) ? 'text-danger' : (($historico['Quantidade Movimentada'] > 0) ? 'text-success' : '') ?>">
                        <?= number_format($historico['Quantidade Movimentada'], 2, ",", ".") ?>
                    </td>
                    <td><?= $historico['Data da Atualizacao']?>  <?= $historico['Hora da Atualizacao']?></td>
                    <td><?= $historico['Tipo da Operação']?></td>
                    <?php if($historico['Status Operação'] == 'Baixa De Estoque') : ?>
                        <th><img src="\finar\imagens\negative_minimize_icon_208693.png"> <?= $historico['Status Operação']?></th>
                    <?php elseif($historico['Status Operação'] == 'Aumento De Estoque') : ?>
                        <th><img src="\finar\imagens\add_icon-icons.com_74429.png"> <?= $historico['Status Operação']?></th>
                    <?php else : ?>
                        <th><?= $historico['Status Operação']?></th>	
                    <?php endif; ?>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <div class="col-md-6">
			<div class="form-group">
			<a href="<?= base_url() ?>produto" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
		    </div>			
		</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        new DataTable('#empresa')
    </script>
    
</main>

