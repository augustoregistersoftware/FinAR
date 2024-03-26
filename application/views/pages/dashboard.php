<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Dashboard</h1>
		<div class="btn-group mr-2">
		
		</div>
	</div>

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2 class="h2">Financeiro Por Empresa</h2>
</div>

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2 class="h2">5 Ultimos Clientes Cadastrados</h2>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Nome</th>
					<th>CPF</th>
					<th>CEP</th>
					<th>Endereço</th>
					<th>Numero</th>
          <th>Bairro</th>
          <th>Complemento</th>
          <th>Telefone</th>
          <th>Email</th>
          <th>Empresa</th>
				</tr>
			</thead>
			<tbody>
      <?php foreach($clientes as $clientes) : ?>
          <tr>
            <td><?= $clientes['nome']?></td>
            <td><?= $clientes['cpf']?></td>
            <td><?= $clientes['cep']?></td>
            <td><?= $clientes['endereco']?></td>
            <td><?= $clientes['numero']?></td>
            <td><?= $clientes['bairro']?></td>
            <td><?= $clientes['complemento']?></td>
            <td><?= $clientes['telefone']?></td>
            <td><?= $clientes['email']?></td>
            <th><?= $clientes['empresa']?></th>
          </tr>
        <?php endforeach;?>
			</tbody>
		</table>
	</div>

	<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h2 class="h2">5 Ultimos Produtos Cadastrados</h2>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>Codigo Auxiliar</th>
					<th>Codigo De Barras</th>
					<th>Descrição</th>
          <th>Quantidade em Estoque</th>
          <th>Quantidade Minima</th>
          <th>Custo</th>
          <th>Empresa</th>
				</tr>
			</thead>
			<tbody>
      <?php foreach($produtos as $produtos) : ?>
          <tr>
            <td><?= $produtos['cod_aux']?></td>
            <td><?= $produtos['cod_barras']?></td>
            <td><?= $produtos['descricao']?></td>
            <td><?= $produtos['estoque_atual']?></td>
            <td><?= $produtos['estoque_minimo']?></td>
			      <td style="color: green;">R$ <?= number_format($produtos['custo'],2,",",".")?></td>
            <th><?= $produtos['razao_social']?></th>
          </tr>
        <?php endforeach;?>
			</tbody>
		</table>
  
	</div>

    <div class="cardBox">

        <!-- Card de Lucro -->
    <a href="<?= base_url() ?>dashboard" class="card-link">
      <div class="card">
          <img src="\finar\imagens\blueberry-online-meeting-via-group-call.gif" alt="Imagem de perfil" style="width: 100%; height: auto;">
          <div class="cardName">Bem-Vindo, Augusto</div>
          <p>Dashboard</p>
      </div>
      <div class="iconBx">
          <ion-icon name="eye-outline"></ion-icon>
      </div>
    </a>

    <!-- Card de Cobranças -->
    <a href="<?= base_url() ?>cobranca" class="card-link">
        <div class="card">
		<?php foreach($total_cobranca as $total_cobranca) : ?>
            <div class="numbers"><?= $total_cobranca['quantidade']?></div>
		<?php endforeach;?>
            <div class="cardName">Total de Cobranças</div>
        </div>
        <div class="iconBx">
            <ion-icon name="eye-outline"></ion-icon>
        </div>
    </a>
    
    <!-- Card de Compras -->
    <a href="<?= base_url() ?>solicitacao_compra" class="card-link">
        <div class="card">
		<?php foreach($total_compra as $total_compra) : ?>
            <div class="numbers"><?= $total_compra['quantidade']?></div>
		<?php endforeach;?>
            <div class="cardName">Total de Vendas</div>
        </div>
        <div class="iconBx">
            <ion-icon name="cart-outline"></ion-icon>
        </div>
    </a>


    <!-- Card de Lucro -->
    <a href="<?= base_url() ?>bancos" class="card-link">
        <div class="card">
		<?php foreach($total_receber as $total_receber) : ?>
            <div class="numbers">R$ <?= number_format($total_receber['total_receber'],2,",",".")?></div>
		<?php endforeach;?>
            <div class="cardName">Lucro De Todos os Bancos</div>
        </div>
        <div class="iconBx">
            <ion-icon name="cash-outline"></ion-icon>
        </div>
    </a>
</div>



	<div class="table-responsive" >
	<table class="table table-bordered table-hover">
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Produtos', 'Estoque'],
          <?php foreach ($produtos_grafico as $produtos_grafico) : ?>
          ['<?php echo $produtos_grafico['descricao']?>',  <?php echo $produtos_grafico['estoque_atual']?>],
          <?php endforeach;?>
        ]);

      var options = {
        legend: 'none',
        pieSliceText: 'label',
        title: 'Estoque Produto Agrupado',
        pieStartAngle: 100,
      };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
	</table>
	</div>
	<body>
	<div id="piechart" style="width: 900px; height: 500px;"></div>
	</body>
</main>


<script>
	function abrirGraficoEstoque(){
		document.getElementById("d1").setAttribute("open","");
	}
</script>



<style>
	/* ======================= Cards ====================== */

.card-link {
  text-decoration: none;
  color: inherit;
    /* Adicione quaisquer outros estilos necessários para manter a aparência do seu card */
}
.cardBox {
  position: relative;
  width: 100%;
  padding: 20px;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  grid-gap: 30px;
}

.cardBox .card {
  position: relative;
  background: var(--white);
  padding: 30px;
  border-radius: 20px;
  display: flex;
  justify-content: space-between;
  cursor: pointer;
  box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
}

.cardBox .card .numbers {
  position: relative;
  font-weight: 500;
  font-size: 2.5rem;
  color: var(--blue);
}

.cardBox .card .cardName {
  color: var(--black2);
  font-size: 1.1rem;
  margin-top: 5px;
}

.cardBox .card .iconBx {
  font-size: 3.5rem;
  color: var(--black2);
}

.cardBox .card:hover {
  background: var(--blue);
}
.cardBox .card:hover .numbers,
.cardBox .card:hover .cardName,
.cardBox .card:hover .iconBx {
  color: var(--white);
}


</style>