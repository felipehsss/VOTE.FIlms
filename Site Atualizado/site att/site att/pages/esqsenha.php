<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci a Senha</title>
    <link rel="stylesheet" href="../assets/css/esqsenha.css">
    <link rel="icon" href="../assets/img/icon/VOTE (1).png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<header>
        <div class="menu__home_login">
        <a href="../pages/loginCadastro.php">  
                <button type="button" class="btn btn-danger">VOLTAR</button>
            </a>
            <img src="../assets/img/img-logo/1.jpg" class="img__menu">
                </div>
    </header>
    <div class="container">
        <div class="container-title">
            <div class="title">
                <h1>Redefina sua senha</h1>
                <p>Crie uma senha nova que não seja a mesma que a anterior, possua pelo menos 3 digitos, 2 caracteres especiais e 5 letras. </p>
            </div>
        </div>
        <form class="form" action="./loginCadastro.php" method="post">
            <div class="quadro">
                <input class="style-email" type="email" placeholder="E-mail" name="email" required>
            </div>
            <div class="quadro">
                <input class="style-senha" onblur="validarFormulario()" type="password" placeholder="Senha" id="novaSenha" name="novaSenha" required>
            </div>
            <div class="quadro">
                <input class="conf-senha" onblur="validarConfirmar()" type="password" placeholder="Confirmar Senha" id="confirmarNovaSenha" name="confirmarNovaSenha" required>
            </div>
            <div class="quadro">
                <input class="style-enviar" type="submit" value="Enviar">
            </div>
        </form>
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
    <script>
        // alert();
        // Função JavaScript para validar os requisitos da senha
        function validarFormulario() {
            var novaSenha = document.getElementById('novaSenha');
            var confirmarNovaSenha = document.getElementById('confirmarNovaSenha').value;

            if (novaSenha.value != "") {
                // Função para validar os requisitos da senha
                function validarInput(senha) {
                    var temDigitos = /\d/.test(novaSenha.value) && (novaSenha.value.match(/\d/g) || []).length >= 3;
                    var temCaracteresEspeciais = /[^a-zA-Z0-9]/.test(novaSenha.value) && (novaSenha.value.match(/[^a-zA-Z0-9]/g) || []).length >= 2;
                    var temLetras = /[a-zA-Z]/.test(novaSenha.value) && (novaSenha.value.match(/[a-zA-Z]/g) || []).length >= 5;

                    return temDigitos && temCaracteresEspeciais && temLetras;
                }

                // Verifica os requisitos da senha
                if (!validarInput(novaSenha.value)) {
                    alert('A senha deve conter: \n- Pelo menos 3 dígitos \n- Pelo menos 2 caracteres especiais \n- Pelo menos 5 letras');
                    novaSenha.value = "";
                    novaSenha.focus();
                    return false;
                }
            }
            // Se passar em todas as validações, o formulário é enviado
            return true;
        }

        function validarConfirmar() {
            var novaSenha = document.getElementById('novaSenha').value;
            var confirmarNovaSenha = document.getElementById('confirmarNovaSenha');

            if (confirmarNovaSenha.value != '') {
                // Verifica se as senhas são iguais
                if (novaSenha !== confirmarNovaSenha.value) {
                    alert("As senhas não são iguais.");
                    confirmarNovaSenha.value = "";
                    confirmarNovaSenha.focus();
                    return false;
                }

            }
            // Se passar em todas as validações, o formulário é enviado
            return true;
        }
    </script>


    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $novaSenha = $_POST['novaSenha'];
        $confirmarNovaSenha = $_POST['confirmarNovaSenha'];

        // Validação da senha
        function validarSenha($senha)
        {
            if (strlen($senha) < 10) {
                return "A senha deve ter pelo menos 10 caracteres.";
            }
            if (preg_match_all("/[!@#$%^&*(),.?\":{}|<>]/", $senha) < 2) {
                return "A senha deve conter pelo menos 2 caracteres especiais.";
            }
            if (preg_match_all("/[a-zA-Z]/", $senha) < 5) {
                return "A senha deve conter pelo menos 5 letras.";
            }
            return true;
        }

        if ($novaSenha !== $confirmarNovaSenha) {
            die("As senhas não coincidem. <a href='javascript:history.back()'>Voltar</a>");
        }

        $validacao = validarSenha($novaSenha);
        if ($validacao !== true) {
            die($validacao . " <a href='javascript:history.back()'>Voltar</a>");
        }

        // Atualizar senha no arquivo
        $arquivoCadastro = "cadastro.txt";
        $linhas = file($arquivoCadastro, FILE_IGNORE_NEW_LINES);
        $usuarioEncontrado = false;

        foreach ($linhas as &$linha) {
            $dados = explode(",", $linha);
            if ($dados[1] === $email) {
                $dados[2] = $novaSenha; // Atualiza a senha
                $linha = implode(",", $dados);
                $usuarioEncontrado = true;
            }
        }

        if ($usuarioEncontrado) {
            file_put_contents($arquivoCadastro, implode("\n", $linhas));
            echo "<script>alert('Senha redefinida com sucesso!');</script>";
        } else {
            echo "<script>alert('E-mail não encontrado!');</script>";
        }
    }

    ?>