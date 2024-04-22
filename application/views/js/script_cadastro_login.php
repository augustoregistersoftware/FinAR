<script>
console.log("Script loaded");

function goValida(id) {
    (async () => {
        var id_login = id;
         const { value: password } = await Swal.fire({
            title: "Digite A Senha",
            input: "password",
            inputLabel: "Password",
            inputPlaceholder: "Enter your password",
            inputAttributes: {
            maxlength: "10",
            autocapitalize: "off",
            autocorrect: "off"
            }
        });
        if (password === "9846") {
            senha(id_login);
        }else{
            Swal.fire({
            title: "Oops...",
            text: "Senha Incorreta!",
            icon: "error"
            });
        }
    })()
}

function goInativa(id) {
    Swal.fire({
        title: "Deseja Deletar?",
        text: "Após deletar o LOGIN não sera possivel recuperar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, delete!"
        }).then((result) => {
        if (result.isConfirmed) {
            var baseUrl = '<?php echo base_url(); ?>'; 
            var myUrl = baseUrl + 'cadastro_login/deletar/' + id;
            window.location.href = myUrl;
        }
        });
    }



function senha(id_login) {
    $.ajax({
        url: "<?php echo site_url('cadastro_login/obter_senha'); ?>",
        type: 'GET',
        dataType: 'json',
        data: { id_login: id_login },
        success: function(data) {
            Swal.fire("Senha:", data.senha);
        }
    });
}


function goEdit(id) {
    var baseUrl = '<?php echo base_url(); ?>';
    var myUrl = baseUrl + 'localizacao/editar/' + id;
    if (confirm("Deseja realmente Editar?")) {
        window.location.href = myUrl;
    } else {
        return false;
    }
}
</script>


