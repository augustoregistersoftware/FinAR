<script>
function goEmpresa(id) {
    var baseUrl = '<?php echo base_url(); ?>';
    var myUrl = baseUrl + 'produto/produto_empresa/' + id;
    window.location.href = myUrl;
}

function goFoto(id){
	var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'produto/fotos_produto/' + id;

	window.location.href =myUrl;
}

function goInativa(id) {
    swal({
        title: "Deseja Realmente Inativar Esse Produto?",
        text: "Essa Ação terá impacto em outras situações",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            swal("Feito, Produto Desativado !", {
                icon: "success",
            }).then(() => {
                var baseUrl = '<?php echo base_url(); ?>';
                var myUrl = baseUrl + 'produto/inativa/' + id;
                window.location.href = myUrl;
            });
        } else {
            return false;
        }
    });
    
}

let rocketVisible = true;

function toggleRocket() {
    const rocket = document.getElementById('flash');
    rocketVisible = !rocketVisible;
    rocket.style.display = rocketVisible ? 'block' : 'none';
}

function goHistorico(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'produto/historico_produto/' + id;
    window.location.href = myUrl;
}

function goAtiva(id) {
    swal({
        title: "Deseja Realmente Ativar Esse Produto?",
        text: "Essa Ação terá impacto em outras situações",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            swal("Feito, Produto Ativado !", {
                icon: "success",
            }).then(() => {
                var baseUrl = '<?php echo base_url(); ?>'; 
                var myUrl = baseUrl + 'produto/ativa/' + id;
                window.location.href = myUrl;
            });
        } else {
            return false;
        }
    });
}


function goEdit(id) {
    swal({
        title: "Deseja Realmente Editar Esse Produto?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var baseUrl = '<?php echo base_url(); ?>'; 
            var myUrl = baseUrl + 'produto/editar/' + id;
                window.location.href = myUrl;
        } else {
            return false;
        }
    })
}

function controleDialog(){
    swal("Parabéns", "Seu Produto esta com estoque", "success");
	}

	function controleDialog2(){
		swal("Opss...", "Seu Produto esta com estoque abaixo =(", "warning");
	}


    
</script>