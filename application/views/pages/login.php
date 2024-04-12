<!DOCTYPE html>
<html lang="pt=br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="<?= base_url('application/css/styles_login.css') ?>">
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
