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
        var baseUrl = '<?php echo base_url(); ?>'; 
        var myUrl = baseUrl + 'localizacao/inativa/' + id;
        if (confirm("Deseja realmente inativar essa localizacao?")) {
            window.location.href = myUrl;
        } else {
            return false;
        }
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
    var baseUrl = '<?php echo base_url(); ?>'; // Certifique-se de que base_url() está definido corretamente em seu código PHP
    var myUrl = baseUrl + 'localizacao/editar/' + id;
    if (confirm("Deseja realmente Editar?")) {
        window.location.href = myUrl;
    } else {
        return false;
    }
}
</script>


