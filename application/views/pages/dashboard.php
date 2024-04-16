<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
		<h1 class="h2">Dashboard</h1>
		<div class="btn-group mr-2">
		
		</div>

    <div class="info">
            <p>Olá, <b><?php echo $this->session->userdata('name'); ?></b></p>
            <small class="text-muted"><?php echo $this->session->userdata('profile'); ?></small>
        </div>
	</div>
  <div class="cardBox">

    <!-- Card de Cobranças -->
    <a href="<?= base_url() ?>cobranca" class="card-link">
        <div class="card">
		<?php foreach($total_cobranca as $total_cobranca) : ?>
            <div class="numbers"><?= $total_cobranca['quantidade']?></div>
		<?php endforeach;?>
            <div class="cardName">Total de Cobranças</div>
            <p>Esse mês</p>
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
            <p>Esse mês</p>
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
            <p>Esse mês</p>
        </div>
        <div class="iconBx">
            <ion-icon name="cash-outline"></ion-icon>
        </div>
    </a>

    <!-- Card de Despesa -->
    <a href="<?= base_url() ?>bancos" class="card-link">
        <div class="card">
		<?php foreach($total_devendo as $total_devendo) : ?>
            <div class="numbers">R$ <?= number_format($total_devendo['total_confirmado'],2,",",".")?></div>
		<?php endforeach;?>
            <div class="cardName">Depesa De Todos os Bancos</div>
            <p>Esse mês</p>
        </div>
        <div class="iconBx">
            <ion-icon name="cash-outline"></ion-icon>
        </div>
    </a>
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

  <h2>Métricas</h2>  
<div class="dashboard">
<div class="metrics-container">
  <div class="metric">
    <div class="icon icon-online">📦</div>
    <div class="metric-description">
      <div>Compras Mercadoria - Fechada e Cancelada</div>
      <?php if($diferenca_compra['diferenca_percentual'] > 0) : ?>
        <div class="percentage positive">+<?= number_format($diferenca_compra['diferenca_percentual'],2,",",".")?>%</div>
        <div class="number"><?= $diferenca_compra['quantidade_hoje']?></div>
      <?php else :?>
        <div class="percentage negative"><?= number_format($diferenca_compra['diferenca_percentual'],2,",",".")?>%</div>
        <div class="number"><?= $diferenca_compra['quantidade_hoje']?></div>
      <?php endif ; ?>  
      <div>últimas 24 horas</div>
    </div>
  </div>
  <div class="metric">
    <div class="icon icon-offline">🛍️</div>
    <div class="metric-description">
      <div>Vendas</div>
      <div class="percentage negative">-17%</div>
      <div class="number">1100</div>
      <div>últimas 24 horas</div>
    </div>
  </div>
  <div class="metric">
    <div class="icon icon-new">👥</div>
    <div class="metric-description">
      <div>Novos Clientes</div>
      <div class="percentage positive">+25%</div>
      <div class="number">849</div>
      <div>últimas 24 horas</div>
    </div>
  </div>
</div>
</div>

<h2>Pagamentos</h2>  
<div class="dashboard">
  <div class="metrics-container">
    <!-- métricas existentes -->
    <div class="metric">
      <div class="icon icon-new">ℹ️</div>
      <div class="metric-description">
        <div>Forma De Pagamento - Lucro e Despesa</div>
        <div class="percentage positive">+50%</div>
        <div class="number">1234</div>
        <div>últimas 24 horas</div>
      </div>
    <!-- você pode adicionar mais métricas aqui -->
  </div>
    
  </div>
  <div class="metrics-container">
    <!-- nova métrica aqui -->
    
    <div class="metric">
      <div class="icon icon-new">ℹ️</div>
      <div class="metric-description">
        <div>Cobrança Paga</div>
        <div class="percentage positive">+50%</div>
        <div class="number">1234</div>
        <div>últimas 24 horas</div>
      </div>
    </div>
    <!-- você pode adicionar mais métricas aqui -->
  </div>
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

  function boas_vindas(){
    Swal.fire({
  title: "Olá,<?php echo $this->session->userdata('name'); ?>",
  text: "Seja muito bem-vindo(a)! Hoje, vamos nos aventurar juntos em uma jornada cheia de possibilidades. Estou ansioso(a) para explorar, aprender e criar momentos inesquecíveis ao seu lado. Vamos fazer deste dia algo extraordinário!",
  imageUrl: "https://ouch-cdn2.icons8.com/JlfQgQozPSgBq00v8E7N2L96CLHslRQofr_gnO39aRY/rs:fit:608:456/extend:false/wm:1:re:0:0:0.8/wmid:ouch/czM6Ly9pY29uczgu/b3VjaC1wcm9kLmFz/c2V0cy9zdmcvNzMx/LzM1MDcyODA3LTky/NmYtNGM5Mi1hZjQw/LTgyNmI0MjQ5MWJi/OS5zdmc.png",
  imageWidth: 400,
  imageHeight: 200,
  imageAlt: "Custom image"
});
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
          boas_vindas();
        }
    });
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


body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f0f0f0;
  margin: 0;
  padding: 20px;
}
.dashboard {
  display: flex;
  justify-content: space-between; /* Espaço entre as colunas de métricas */
}
.metrics-container {
  text-align: center;
  width: calc(50% - 10px); /* Ajusta a largura para duas colunas */
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin-bottom: 10px;
}
  .metric {
    display: flex;
    align-items: center;
    background: #fff;
    margin-bottom: 10px;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
  }
  .metric:hover {
    transform: translateY(-5px);
  }
  .icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
  }
  .metric-description {
    flex-grow: 1;
    text-align: left;
  }
  .percentage {
    font-size: 1.2em;
    font-weight: bold;
  }
  .number {
    font-size: 1.5em;
    font-weight: bold;
  }
  .positive { color: #4CAF50; }
  .negative { color: #F44336; }
  .icon-online { background: #E8F5E9; color: #4CAF50; }
  .icon-offline { background: #FFEBEE; color: #F44336; }
  .icon-new { background: #E3F2FD; color: #2196F3; }
  .main-content {
    flex-grow: 1; /* Ocupa o espaço restante */
    padding-left: 20px;
  }


</style>