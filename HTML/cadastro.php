<?php 

if(isset($_POST['submit'])){
   print_r($_POST['email']);
  print_r($_POST['nome']);
  print_r($_POST['senha']);
  print_r($_POST['cpf']);

  include_once('cadastrar.php');
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $cpf = $_POST['cpf'];
  $senha = $_POST['senha'];

  $result = mysqli_query($conexao,"INSERT INTO usuarios(email,cpf,senha,nome) VALUES('$email','$cpf','$senha','$nome')");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/cadastro.css">
    <script>
        function somenteLetras() {
          const nome = document.getElementById('nome');
          nome.addEventListener('keypress', function (event) {
            const key = event.keyCode || event.which;
            const regex = /^[a-zA-Z\s]*$/;
            if (!regex.test(String.fromCharCode(key))) {
              event.preventDefault();
            }
          });
        }
      </script>
</head>
<body>
    <?php
include("ajax/conexao.php");
?>
    <header>
        <img src="../img/logomuvall.png" alt="">
    
            <nav>
                <div id="painel-menu">
    
                    <input type="checkbox" name="" id="">
    
                    <span></span>
                    <span></span>
                    <span></span>
    
    
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="lista-de-servicos.html">Lista de serviços</a></li>
                        <li><a href="perfil.html">Perfil Usuario</li>
                        <li><a href="cadastro-anunciante.html">Cadastro anunciante</a></li>
                        <li><a href="">Fale Conosco</a></li>
                        <li><a href="">Sobre nós</a></li>
                    </ul>
                </div>
            </nav>
    </header>
    <main>
        <form action="ajax/cadastrar.php" method="post"  onsubmit="validarFormulario()">
            <h2>Cadastro</h2><hr>
            <input type="email" name="email" placeholder="E-Mail" id="email" maxlength="50">
            <input type="text" name="nome" placeholder="Nome Completo" id="nome" onkeypress="somenteLetras()" maxlength="40">
            <input type="password" name="senha" placeholder="Senha" id="senha" maxlength="25">
            <input type="text" name="cpf" placeholder="CPF" id="cpf" oninput="this.value = formatCPF(this.value)">
            <button type="submit" id="submit" onkeypress="validarFormulario()">Cadastrar</button>
        </form>
    </main>
    <footer>
        <img src="../img/logomuvall.png" alt="">
        <p>Sobre nós</p>
        <a href="">Fale conosco</a>
        <p>Redes sociais</p>
    </footer>
</body>
<script>
    
    ction formatCPF(cpf) {
        cpf = cpf.replace(/\D/g, '');
        cpf = cpf.substring(0, 11); 

        if (!/^\d+$/.test(cpf)) { 
            return ''; 
        }

        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); 
        cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2'); 
        cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); 

        return cpf;
    }
    function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, ''); 
    if (cpf.length !== 11 || !/^\d{11}$/.test(cpf)) {
        return false;
    }
    
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = 11 - (soma % 11);
    let digitoVerificador1 = resto === 10 || resto === 11 ? 0 : resto;
    if (digitoVerificador1 !== parseInt(cpf.charAt(9))) {
        return false;
    }
    // Calcula o segundo dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = 11 - (soma % 11);
    let digitoVerificador2 = resto === 10 || resto === 11 ? 0 : resto;
    if (digitoVerificador2 !== parseInt(cpf.charAt(10))) {
        return false;
    }
    return true;
    }
</script>

<script>
    function validarEmail() {
  const email = document.getElementById('email').value;
  const regex = /\S+@\S+\.\S+/;
  if (!email || !regex.test(email)) {
    alert('Por favor, digite um e-mail válido.');
    return false;
  }
  return true;
}
</script>
<script>
    // Verifica se o campo de nome está vazio
    function validarNome() {
    const nome = document.getElementById('nome').value;
    if (!nome) {
        alert('Por favor, digite seu nome completo.');
    return false;
  }
  return true;
}
</script>

<script>
    const senhaInput = document.getElementById('senha');
  
    function validarSenha() {
      const senha = senhaInput.value;
      if (!senha) {
        alert('Por favor, digite uma senha.');
        return false;
      }
      if (/^[a-zA-Z]+$/.test(senha)) {
        alert('Sua senha deve conter pelo menos um caractere que não seja uma letra.');
        return false;
      }
      return true;
    }
  
    senhaInput.addEventListener('input', function() {
      if (this.value.length > 20) {
        this.value = this.value.slice(0, 20); // limita a 20 caracteres
      }
    });
  
    senhaInput.maxLength = 20;
  </script>

<script>
    function validarFormulario() {
    if (validarEmail() && validarNome() && validarSenha()) {
        document.getElementById('meu-formulario').submit();
    }
}
</script>

</html>

