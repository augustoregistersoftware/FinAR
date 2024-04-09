<!DOCTYPE html>
<html lang="pt-BR">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Negado</title>
</head>
<body>
    <div class="container">
        <div class="page"></div>
    </div>
</body>
</html>

<script>
    function alerta(){
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Você não possui permissã para acessar esse modulo, por favor entre em contato com seu supervisor",
        footer: '<a href="<?= base_url() ?>dashboard">Voltar</a>'
    });
    }

    window.addEventListener("load", alerta);
   
</script>