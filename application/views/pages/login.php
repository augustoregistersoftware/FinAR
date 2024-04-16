<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<<<<<<< HEAD
    <link rel="stylesheet" type="text/css" href="<?= base_url('application/css/styles_login.css') ?>">
=======
>>>>>>> f7ba4e79aca16440ee40ede07342091367a9f934
    <link rel="icon" type="image/x-icon" href="/finar/imagens/icone.png">

    <title>Login - FinAR</title>
</head>
<body>
<form action="<?= base_url() ?>login/auth/" method="post">
    <div id="container">
        <div class="banner">
            <img src="/finar/imagens/clip-financial-report.gif" alt="imagem-login">
            <p style="color: #fff; font-weight: 400;">
                Seja bem vindo ao FinAR, acesse e aproveite todo o conteúdo,
                <br>somos uma equipe de profissionais empenhados em
                <br>trazer o melhor conteúdo direcionado a você, usuário. 
            </p>
        </div>

        <div class="box-login">
            <h1>
                Olá!<br>
                Seja bem vindo de volta.
            </h1>

            <div class="box">
                <h2>faça o seu login agora</h2>
                <?php if($this->input->cookie('checked') == 'on'): ?>
                    <input type="text" name="username" id="username" placeholder="username" value="<?= $this->input->cookie('username') ?>">
                    <input type="password" name="password" id="password" placeholder="password">

                    <label for="remember_me" style="display: inline-block; margin-right: 10px; color: black;">
                        <input type="checkbox" id="remember_me" name="remember_me" style="transform: scale(0.8);" checked > Lembrar login
                    </label>
                <?php else: ?>
                    <input type="text" name="username" id="username" placeholder="username">
                    <input type="password" name="password" id="password" placeholder="password">

                    <label for="remember_me" style="display: inline-block; margin-right: 10px; color: black;">
                        <input type="checkbox" id="remember_me" name="remember_me" style="transform: scale(0.8);" > Lembrar login
                    </label>
                <?php endif; ?>

                <a href="<?= base_url() ?>login/password/">
                    <p>Esqueceu a sua senha?</p>
                </a>
                
                <button type="submit">Login</button>
            </div>
        </div>
    </div>
</body>
</html>
<<<<<<< HEAD
=======


<script>
    function boas_vindas()
    {
        const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
        });
        Toast.fire({
        icon: "success",
        title: "E-mail, Enviado com sucesso!"
        });
    }

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
        if (avisoParam === 'envio') {
          boas_vindas();
        }
    });
</script>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');

* {
    margin: 0;
    padding: 0;

    font-family: 'Roboto', sans-serif;
    font-size: 14px;
    color: #fff;
}

p {
    cursor: pointer;
    font-weight: 600;
    color: slateblue;
}

h1 {
    font-size: 1.8em;
    color: slateblue;
    padding: 0px 0px 35px 15px;
}

h2 {
    font-size: 1.4em;
    color: slateblue;
}

input {
    width: 80%;
    height: 30px;
    border: none;
    border-bottom: 1px solid silver;
    outline: none;
    font-weight: 600;
    color: #1c1c1c;
    padding-left: 3px;
}

button {
    cursor: pointer;
    width: 120px;
    height: 35px;
    border: none;
    border-radius: 5px;
    background: slateblue;
}

body {
    width: 100%;
    height: 100vh;
    background-image: url('/finar/imagens/fundo.png');
    background-repeat: no-repeat;
    background-size: 100%;
    
    display: flex;
    justify-content: center;
    align-items: center;
}

    #container {
        width: 320px;
        height: 520px;
        border-radius: 10px;
        -webkit-box-shadow: 0px 0px 6px -1px #000000; 
        box-shadow: 0px 0px 6px -1px #000000;
        background: #785eef;

        display: flex;
        align-items: center;
    }   

        #container .banner {
            width: 520px;
            height: 520px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            background: #785eef;

            display: none;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }

        #container .box-login {
            width: 320px;
            height: 520px;
            border-radius: 10px;
            background: #fff;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

            .box-login .box {
                width: 80%;
                height: 320px;

                display: flex;
                flex-direction: column;
                justify-content: space-around;
                align-items: center;
            }

                .box .social {
                    width: 240px;
                    height: 42px;

                    display: flex;
                    justify-content: space-evenly;
                    align-items: center;
                }

                    .social img {
                        cursor: pointer;
                    }

            .box-login .box-account {
                width: 80%;
                height: 360px;

                display: flex;
                flex-direction: column;
                justify-content: space-around;
                align-items: center;
            }
    
    #bubble {
        cursor: pointer;
        position: absolute;
        width: 50px;
        height: 50px;
        right: 15px;
        bottom: 15px;
        border-radius: 50%;
        border: 1px solid #483D8B;
        background: slateblue;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    @media (min-width: 1024px) {
        #container {
            width: 902px;
            justify-content: space-between;
        }  

            #container .banner {
                display: flex;
            }

            #container .box-login {
                width: 385px;
                border-radius: 10px 10px 10px 0px;
            }
}
</style>
>>>>>>> f7ba4e79aca16440ee40ede07342091367a9f934
