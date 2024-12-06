<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login e Cadastro</title>
    <link rel="stylesheet" href="../assets/css/loginCadastro.css">
    <link rel="icon" href="../assets/img/icon/VOTE (1).png">
</head>

<body>
    <script src="../assets/js/teste.js"></script>
    <header>
        <div class="menu__home_login">
           
            <img src="../assets/img/img-logo/1.jpg" class="img__menu">
                </div>
    </header>
    <div class="estrutura">
        <div class="slide-titulo">
            <div class="titulo login">
                Login
            </div>
            <div class="titulo cadastro">
                Crie sua conta
            </div>
        </div>
        <div class="form-container">
            <div class="slide-controles" onclick="handlerTab(this, event)">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide-botão login">Login</label>
                <label for="signup" class="slide-botão signup">Cadastro</label>
                <div class="slider-button-tab"></div>
            </div>
            <div class="form-interno">
                <form class="login" action="index.html" method="post">
                    <div class="quadro">
                        <input type="email" placeholder="E-mail" name="emaillogin" required>
                    </div>
                    <div class="quadro">
                        <input type="password" placeholder="Senha" name="senhalogin" required>
                    </div>
                    <div class="btn-senha">
                        <a href="./esqsenha.php">Esqueceu a senha?</a>
                    </div>
                    <div class="quadro btn">
                        <input type="submit" value="Entrar">
                    </div>
                    <div class="contato">
                        Não tem conta?<a href="">Crie agora</a>
                    </div>
                    </form>
                <form class="signup" action="loginCadastro.php" method="post">
                    <div class="quadro">
                        <input type="text" placeholder="Nome" name="nome"  required>
                    </div>
                    <div class="quadro">
                        <input type="email" placeholder="E-mail" name="email" required>
                    </div>
                    <div class="quadro">
                        <input type="password" placeholder="Senha" name="senha" id="senha" required>
                    </div>
                    <div class="quadro">
                        <input type="password" placeholder="Confirme sua senha" name="confirmarsenha" id="confirmarsenha" required>
                    </div>
                    <div class="quadro btn">
                        <input type="submit" value="Entrar">
                    </div>
                </form>
            </div>
            <div class="requisito">
                <div class="sub-requisito">
                    <input type="checkbox" required>
                    <p>Eu concordo com os termos de segurança, e estou ciente de que meus resultados serão visualizados pela equipe VOTE.F para pesquisas com relação aos meus votos.</p>
                </div>
                <div class="sub-requisito">
                    <input type="checkbox" required> 
                    <p>Quero que meus votos sejam anônimos, sem aparecerem nas pesquisas da VOTE.F.</p>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer-container">
            <!--  -->
            <div class="footer-section contact">
                <h3>Contato</h3>
                <p>Telefone: (11) 1234-5678</p>
                <p>Email: vote.f@outlook.com</p>
                <p>Endereço: R. Santo André, 680 - Boa Vista, São Caetano do Sul - SP, 09572-000</p>
            </div>

            <!--  -->
            <div class="footer-section links">
                <h3>Links</h3>
                <ul>
                    <li><a href="#">Início</a></li>
                    <li><a href="#">Sobre Nós</a></li>
                    <li><a href="#">Serviços</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Contato</a></li>
                </ul>
            </div>

            <!--  -->
            <div class="footer-section social">
                <h3>Siga-nos</h3>
                <a href="#" target="_blank">Facebook</a> |
                <a href="#" target="_blank">Instagram</a> |
                <a href="#" target="_blank">LinkedIn</a> |
                <a href="#" target="_blank">X</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 vote.f. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>


<?php

// Caminho do arquivo de dados
$arquivoCadastro = "cadastro.txt";

// Cadastro de novo usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['confirmarsenha'])) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $confirmarSenha = trim($_POST['confirmarsenha']);

    // Validações básicas
    if ($senha !== $confirmarSenha) {
        echo "<script>alert('As senhas não coincidem.');</script>";
        return;
    }

    // Verifica se o e-mail já está cadastrado
    if (file_exists($arquivoCadastro)) {
        $usuarios = file($arquivoCadastro, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($usuarios as $usuario) {
            $dados = explode(",", $usuario);
            if ($dados[1] === $email) {
                echo "<script>alert('E-mail já cadastrado.');</script>";
                return;
            }
        }
    }

    // Salva o novo usuário
    $dados = $nome . "," . $email . "," . $senha . "\n";
    file_put_contents($arquivoCadastro, $dados, FILE_APPEND);
    echo "<script>alert('Cadastro realizado com sucesso!');</script>";
}

// Login do usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['emaillogin'], $_POST['senhalogin'])) {
    $emailLogin = trim($_POST['emaillogin']);
    $senhaLogin = trim($_POST['senhalogin']);

    // Verifica credenciais no arquivo
    if (file_exists($arquivoCadastro)) {
        $usuarios = file($arquivoCadastro, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($usuarios as $usuario) {
            $dados = explode(",", $usuario);
            if ($dados[1] === $emailLogin && $dados[2] === $senhaLogin) {
                echo "<script>alert('Login realizado com sucesso!');</script>";
                return;
            }
        }
    }
    echo "<script>alert('Usuário ou senha incorretos.');</script>";
}


?>

<script>
        // alert();
        // Função JavaScript para validar os requisitos da senha
        function validarFormulario() {
            var senha = document.getElementById('senha');
            var confirmarsenha = document.getElementById('confirmarsenha').value;

            if (senha.value != "") {
                // Função para validar os requisitos da senha
                function validarInput(senha) {
                    var temDigitos = /\d/.test(senha.value) && (senha.value.match(/\d/g) || []).length >= 3;
                    var temCaracteresEspeciais = /[^a-zA-Z0-9]/.test(senha.value) && (senha.value.match(/[^a-zA-Z0-9]/g) || []).length >= 2;
                    var temLetras = /[a-zA-Z]/.test(senha.value) && (senha.value.match(/[a-zA-Z]/g) || []).length >= 5;

                    return temDigitos && temCaracteresEspeciais && temLetras;
                }

                // Verifica os requisitos da senha
                if (!validarInput(senha.value)) {
                    alert('A senha deve conter: \n- Pelo menos 3 dígitos \n- Pelo menos 2 caracteres especiais \n- Pelo menos 5 letras');
                    senha.value = "";
                    senha.focus();
                    return false;
                }
            }
            // Se passar em todas as validações, o formulário é enviado
            return true;
        }

        function validarConfirmar() {
            var senha = document.getElementById('senha').value;
            var confirmarsenha = document.getElementById('confirmarsenha');

            if (confirmarsenha.value != '') {
                // Verifica se as senhas são iguais
                if (senha !== confirmarsenha.value) {
                    alert("As senhas não são iguais.");
                    confirmarsenha.value = "";
                    confirmarsenha.focus();
                    return false;
                }

            }
            // Se passar em todas as validações, o formulário é enviado
            return true;
        }
    </script>