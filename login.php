<?php
session_start();
$usuario = "admin";
$senha = "1234";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["usuario"] === $usuario && $_POST["senha"] === $senha) {
        $_SESSION["logado"] = true;
        header("Location: adm.php");
        exit();
    } else {
        $erro = "Usuário ou senha incorretos!";
    }
}
?>

<form method="POST">
  <input type="text" name="usuario" placeholder="Usuário">
  <input type="password" name="senha" placeholder="Senha">
  <button type="submit">Entrar</button>
  <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
</form>
