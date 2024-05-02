<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					
			<h1 class="h2">/h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          </div>
        </div>
      </div>

			<div class="col-md-12">
					
					<form action="<?= base_url() ?>produto/update/" method="post">

                <div class="col-md-6">
						<div class="form-group">
							<label for="mensagem">Conteudo Da Mensagem</label>
							<textarea type="text" class="form-control" name="mensagem" id="mensagem" placeholder="Mensagem"></textarea>
						</div>
				</div>   

					<div class="col-md-6">
							<div class="form-group">
							<label for="localizacao">Colaborador</label>
								<select name="localizacao" id="localizacao" class="form-control pesquisa__select col-12 selectCustom">
								<?php foreach($localizacao as $localizacao) : ?>
								<option value="<?= $localizacao["id_localizacao"] ?>"><?php echo $localizacao["nome"]; ?></option>
								<?php endforeach;?>
								</select>
							</div>
						</div>			

					<div class="col-md-6">
						<div class="form-group">
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
							<a href="<?= base_url() ?>produto" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
						</div>			
					</div>
				</form>
			</div>

	<!-- Card -->
	<a href="#" id="ajudaLink" class="card-link">
    <div class="card">
        <img src="/finar/imagens/photo_message.gif" alt="imagem-login">
        <div class="iconBx">
            <ion-icon name="eye-outline"></ion-icon>
        </div>
    </div>
</a>

    </main>
  </div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	document.getElementById('ajudaLink').addEventListener('click', function(e) {
		e.preventDefault(); // Impede que o link siga a URL
		ajuda();
	});

	function ajuda() {
        Swal.fire({
        title: "Help",
        text:  "pedidos atrasados por favor verifique com seu fornecedor!",
        icon: "info"
        });
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
  grid-gap: 20px; /* Espaçamento reduzido */
}

.card img {
  max-width: 90%; /* Garantir que a imagem não ultrapasse o tamanho do card */
  height: auto; /* Manter proporção */
}

.iconBx ion-icon {
  font-size: 20px; /* Reduzir o tamanho do ícone */
}

.card .numbers, .card .cardName, .card .iconBx {
  font-size: 0.8rem; /* Reduzir o tamanho da fonte */
}

.card {
  padding: 5px; /* Redução adicional do padding */
  width: 250px; /* Definindo uma largura específica que pode ser ajustada conforme necessário */
  height: 200px; /* Altura definida para manter a proporção */
  border-radius: 10px; /* Ajuste conforme necessário para estética */
  box-shadow: 0 3px 40px rgba(0, 0, 0, 0.1);
}

.card-link {
  font-size: 0.8rem; /* reduzir o tamanho da fonte para elementos de texto dentro do link */
}

.iconBx {
  font-size: 2rem; /* reduzir o tamanho do ícone */
}

.cardBox .card {
  padding: 10px; /* Padding reduzido */
  border-radius: 8px; /* Border-radius reduzido */
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
}

.cardBox .card .iconBx {
  font-size: 2.5rem; /* Tamanho do ícone reduzido */
}


body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f0f0f0;
  margin: 0;
  padding: 20px;
}



</style>
