<script>
    function goFecha(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
        title: "Deseja Realmente Fechar Esse Pedido?",
        text: "Confira Tudo antes de fechar, essa ação tera grande impacto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim, Fechar!",
        cancelButtonText: "Não, cancelar!",
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
            var myUrl = baseUrl + 'compra/fechar/' + id;
            window.location.href = myUrl;
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            return false;
        }
        });


}

function goCancela(id) {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
        title: "Deseja Realmente Cancelar Esse Pedido?",
        text: "Confira Tudo antes de cancelar, essa ação tera grande impacto",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sim, Fechar!",
        cancelButtonText: "Não, cancelar!",
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
            var myUrl = baseUrl + 'compra/cancela/' + id;
            window.location.href = myUrl;
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            return false;
        }
        });
}

function goDocumentos(id) {
    var baseUrl = '<?php echo base_url(); ?>'; 
    var myUrl = baseUrl + 'compra/documentos/' + id;
    window.location.href = myUrl;
}

function controleDialog(){
    Swal.fire({
        title: "Ebaa!!",
        text: "Seu Pedido esta normal =)",
        icon: "success"
    });
	}

	function controleDialog2(){
        Swal.fire({
        title: "Oops...",
        text: "Seu Pedido esta atrasado =(",
        icon: "warning"
    });
	}

	function controleDialog3(){
        Swal.fire({
        title: "Parabéns",
        text: "Seu Pedido esta finalizado =)",
        icon: "success"
    });
	}

	function controleDialog4(){
        Swal.fire({
        title: "Cancelado",
        text: "Seu Pedido esta cancelado !!",
        icon: "error"
    });
	}
</script>