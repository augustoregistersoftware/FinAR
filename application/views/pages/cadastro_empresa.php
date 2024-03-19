<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	  <?php if(isset($empresa_editar)) : ?>
					
			<h1 class="h2">Alterar Empresa</h1>
				<?php else : ?>
					<h1 class="h2">Cadastro de Nova Empresa</h1>
				<?php endif; ?>
      
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          </div>
        </div>
      </div>

			<div class="col-md-12">
			<?php if(isset($empresa_editar)) : ?>
					
					<form action="<?= base_url() ?>empresa/update/<?= $empresa_editar['id_empresa'] ?>" method="post">
				<?php else : ?>
					<form action="<?= base_url() ?>empresa/inserte" method="post" enctype="multipart/form-data">
				<?php endif; ?>

				<form action="" method="post" enctype="multipart/form-data">
					<div class="col-md-6">
						<div class="form-group">
							<label for="razao_social">Razão Social</label>
							<input type="text" class="form-control" name="razao_social" id="razao_social" placeholder="Razão Social" value="<?= isset($empresa_editar) ? $empresa_editar["razao_social"] : "" ?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="nome_fantasia">Nome Fantasia</label>
							<input type="text" class="form-control" name="nome_fantasia" id="nome_fantasia" placeholder="Nome Fantasia" value="<?= isset($empresa_editar) ? $empresa_editar["nome_fantasia"] : "" ?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="cnpj">CNPJ</label>
							<input type="text" class="form-control" name="cnpj" id="cnpj" placeholder="CNPJ" value="<?= isset($empresa_editar) ? $empresa_editar["cnpj"] : "" ?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="cep">CEP *</label>
							<input type="text" class="form-control" name="cep" id="cep" placeholder="CEP" value="<?= isset($empresa_editar) ? $empresa_editar["cep"] : "" ?>" onblur="pesquisacep(this.value);" >
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="endereco">Endereço</label>
							<input type="text" class="form-control" name="endereco" id="endereco" placeholder="Endereço" value="<?= isset($empresa_editar) ? $empresa_editar["endereco"] : "" ?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="numero">Numero</label>
							<input type="text" class="form-control" name="numero" id="numero" placeholder="Numero" value="<?= isset($empresa_editar) ? $empresa_editar["numero"] : "" ?>">
						</div>
					</div>

                    <div class="col-md-6">
						<div class="form-group">
							<label for="bairro">Bairro</label>
							<input type="text" class="form-control" name="bairro" id="bairro" placeholder="Bairro" value="<?= isset($empresa_editar) ? $empresa_editar["bairro"] : "" ?>">
						</div>
					</div>

                    <div class="col-md-6">
						<div class="form-group">
							<label for="complemento">complemento</label>
							<input type="text" class="form-control" name="complemento" id="complemento" placeholder="complemento" value="<?= isset($empresa_editar) ? $empresa_editar["complemento"] : "" ?>">
						</div>
					</div>

                    <div class="col-md-6">
						<div class="form-group">
							<label for="cidade">Cidade</label>
							<input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" value="<?= isset($empresa_editar) ? $empresa_editar["cidade"] : "" ?>">
						</div>
					</div>

                    <div class="col-md-6">
						<div class="form-group">
							<label for="uf">UF</label>
							<input type="text" class="form-control" name="uf" id="uf" placeholder="UF" value="<?= isset($empresa_editar) ? $empresa_editar["uf"] : "" ?>">
						</div>
					</div>

                    <div class="col-md-6">
						<div class="form-group">
							<label for="telefone">Telefone</label>
							<input type="cell" class="form-control" name="telefone" id="telefone" placeholder="Telefone" value="<?= isset($empresa_editar) ? $empresa_editar["telefone"] : "" ?>">
						</div>
					</div>
						

					<div class="col-md-6">
						<div class="form-group">
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
							<a href="<?= base_url() ?>empresa" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
						</div>			
					</div>
				</form>
			</div>

    </main>
  </div>
</div>

<style>
	select.selectCustom:focus {
    box-shadow: 0 0 0 0;
    border: 1px solid #ccc;
    outline: 0;
}
select.selectCustom{
  border-radius: 30px !important
}

</style>

<script>
      function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('endereco').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('endereco').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('endereco').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = '//viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };
</script>
