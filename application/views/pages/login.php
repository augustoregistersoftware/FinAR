<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/finar/imagens/icone.png">

    <title>Login - FinAR</title>
</head>
<body>
    <div id="container">
        <div class="banner">
            <img src="/finar/imagens/login.png" alt="imagem-login">
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
                <input type="text" name="username" id="username" placeholder="username">
                <input type="password" name="password" id="password" placeholder="password">

                <a href="<?= base_url() ?>login/password/">
                    <p>Esqueceu a sua senha?</p>
                </a>
                
                <button>Login</button>
                
            </div>
        </div>
    </div>
</body>
</html>


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