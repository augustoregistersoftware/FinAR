<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Montagem De Compra - Escolha De Produtos</h1>      

    </div>
			<div class="col-md-12">		
				<form action="<?= base_url() ?>fornecedor/inserte_documentos" method="post" enctype="multipart/form-data">

				<form action="" method="post" enctype="multipart/form-data">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

            <main class="container">
                <div class="row">
                    <?php foreach($produto as $produto) : ?>
                    <div class="col-md-4"> <!-- Dividindo em 3 colunas para ocupar 1/3 da largura -->
                        <div class="card">  
                            <div class="card-body">
                                <h5 class="card-title">Nome do Produto</h5>
                                <p class="card-text"><?= $produto['descricao']?></p>
                                <p clas="card-text">Ultimo Custo: R$ <?= number_format($produto['custo'],2,",",".")?></p>
                                <?php if($produto['estoque_atual'] <= $produto['estoque_minimo']) : ?>
                                    <p class="card-text">Estoque: <?= number_format($produto['estoque_atual'],2,",",".")?> -- Estoque Minimo: <?= number_format($produto['estoque_minimo'],2,",",".")?></p>
                                    <p style="color: red;">Produto Indicado a fazer compra</p>
                                <?php else : ?>    
                                    <p class="card-text">Estoque: <?= number_format($produto['estoque_atual'],2,",",".")?></p>
                                <?php endif; ?>    
                                <h6 class="card-text">Empresa: <?= $produto['razao_social']?></h6>
                                <div class="form-group">
                                    <label for="quantidade">Quantidade:</label>
                                    <input type="number" class="form-control" id="quantidade" name="quantidade" value="1" min="1">
                                </div>
                                <input type="hidden" name="id_produto" value="ID_DO_PRODUTO">
                                <button type="submit" class="btn btn-primary rounded-pill">
                                    <i class="fas fa-shopping-cart"></i> <!-- Ícone do carrinho -->
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
                <div class="row mt-4"> <!-- Adicionando margem superior para separar os botões -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <a href="<?= base_url() ?>" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Proximo</a>
                            <a href="<?= base_url() ?>compra" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
                        </div>			
                    </div>
                </div>
                <div class="toggle-switch">
                <input type="checkbox" id="toggle-rocket" class="toggle-input" onclick="toggleRocket()" checked>
                <label for="toggle-rocket" class="toggle-label"></label>
            </div>
            <div class="flash" id="flash">
                <i title="Dica de Cadastro" class="fas fa-rocket"></i>
                <div class="notification-badge"></div>
        </div>
            </main>
  </div>
</div>


<script>

let rocketVisible = true;

function toggleRocket() {
    const rocket = document.getElementById('flash');
    rocketVisible = !rocketVisible;
    rocket.style.display = rocketVisible ? 'block' : 'none';
}

const flash = document.getElementById('flash');
    flash.addEventListener('click', () => {
        ajuda();
    });

    function ajuda(){
        swal("Ajuda Na tela de Montagem", "Na tela de Montagem, você encontrará todos os produtos de todas as empresas, inclusive aqueles que estão com estoque baixo, implorando para serem comprados! Basta selecionar a quantidade desejada e clicar no ícone do carrinho para adicioná-los à sua lista de compras. É como uma caça ao tesouro virtual, onde cada clique nos aproxima um pouco mais da satisfação das nossas necessidades de compra!");
    }
</script>


<style>

.card {
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    max-width: 300px;
}

.card-img-top {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    max-width: 100%;
}

.card-body {
    padding: 20px;
}

.card-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.card-text {
    margin-bottom: 15px;
}

.form-group {
    margin-bottom: 20px;
}

.btn-primary {
            background-color: #007bff; /* Cor azul /
            border-color: #007bff; / Cor da borda igual ao fundo /
            border-radius: 20px; / Borda arredondada /
            padding: 10px 20px; / Espaçamento interno do botão /
        }

        .btn-primary:hover {
            background-color: #0056b3; / Cor azul escura no hover /
            border-color: #0041a2; / Cor da borda no hover /
        }

        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5); / Efeito de foco ao clicar /
        }

        .btn-primary i {
            margin-right: 5px; / Espaçamento entre o ícone e o texto */
        }

.flash {
    width: 60px; /* Largura da div */
    height: 60px; /* Altura da div */
    background-color: blue; /* Cor de fundo da div */
    border-radius: 50%; /* Torna a div redonda */
    position: fixed; /* Posição fixa */
    bottom: 20px; /* Distância do fundo */
    right: 20px; /* Distância da direita */
    display: flex; /* Para centralizar o ícone */
    justify-content: center; /* Para centralizar o ícone */
    align-items: center; /* Para centralizar o ícone */
    cursor: pointer; /* Mostrar o cursor como um ponteiro */
}

.flash i {
    font-size: 2.5em; /* Tamanho do ícone */
    color: white; /* Cor do ícone */
    display: flex; /* Para centralizar o ícone */
    justify-content: center; /* Para centralizar o ícone */
}

.toggle-switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.toggle-input {
  display: none;
}

.toggle-label {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  border-radius: 34px;
  transition: background-color 0.3s;
}

.toggle-label::after {
  content: "";
  position: absolute;
  top: 2px;
  left: 2px;
  width: 30px;
  height: 30px;
  background-color: white;
  border-radius: 50%;
  transition: transform 0.3s;
}

.toggle-input:checked + .toggle-label {
  background-color: #2196F3;
}

.toggle-input:checked + .toggle-label::after {
  transform: translateX(26px);
}
</style>

