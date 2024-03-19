<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	  <?php if(isset($localizacao_editar)) : ?>
					
			<h1 class="h2">Alterar Localização</h1>
            <script>
                alert("Não Esqueça de Verificar a empresa no cadastro");
            </script>
				<?php else : ?>
					<h1 class="h2">Cadastro de Localização</h1>
				<?php endif; ?>
      
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
          </div>
        </div>
      </div>

			<div class="col-md-12">
			<?php if(isset($localizacao_editar)) : ?>
					
					<form action="<?= base_url() ?>localizacao/update/<?= $localizacao_editar['id_localizacao'] ?>" method="post">
				<?php else : ?>
					<form action="<?= base_url() ?>localizacao/inserte" method="post" enctype="multipart/form-data">
				<?php endif; ?>

				<form action="" method="post" enctype="multipart/form-data">
					<div class="col-md-6">
						<div class="form-group">
							<label for="nome_loc">Nome Localização</label>
							<input type="text" class="form-control" name="nome_loc" id="nome_loc" placeholder="Nome Da Localização" value="<?= isset($localizacao_editar) ? $localizacao_editar["nome"] : "" ?>">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
						<label for="empresa">Empresa</label>
							<select name="empresa" id="empresa" class="form-control pesquisa__select col-12 selectCustom">
                                <?php foreach($empresa as $empresa) : ?>
                                <option value="<?= $empresa["id_empresa"] ?>"><?php echo $empresa["razao_social"]; ?></option>
                                <?php endforeach;?> 
							</select>
						</div>
					</div>

                    <?php if(isset($localizacao_editar)) : ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label style="color:'red'" for="empresa_cadastrada">Empresa Cadastrada</label>
                                <input style="color:'red'" type="text" class="form-control" name="empresa_cadastrada" id="empresa_cadastrada" placeholder="Nome Da Empresa" value="<?= isset($localizacao_editar) ? $localizacao_editar["razao_social"] : "" ?>" disabled>
                            </div>
                        </div>
                    <?php else : ?>

                    <?php endif; ?>

						

					<div class="col-md-6">
						<div class="form-group">
							<button type="submit" class="btn btn-success btn-xs"><i class="fas fa-check"></i> Save</button>
							<a href="<?= base_url() ?>localizacao" class="btn btn-danger btn-xs"><i class="fas fa-times"></i> Cancel</a>
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
