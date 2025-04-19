<?php
session_start();
if (!isset($_SESSION["logado"])) {
    header("Location: login.php");
    exit();
}

include 'conexao.php';

// Consulta os pedidos
$resultado = $conn->query("SELECT * FROM pedidos ORDER BY data_pedido DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel de Administração</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-4">
    <h1 class="text-center text-primary">Painel de Pedidos</h1>
    <?php if ($resultado->num_rows > 0): ?>
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Pagamento</th>
            <th>Produtos</th>
            <th>Data</th>
            <th>Status</th>
            <th>Aceitar</th>
            <th>Cancelar</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($linha = $resultado->fetch_assoc()): ?>
            <tr>
              <td><?= $linha['id'] ?></td>
              <td><?= htmlspecialchars($linha['nome']) ?></td>
              <td><?= htmlspecialchars($linha['endereco']) ?></td>
              <td><?= htmlspecialchars($linha['pagamento']) ?></td>
              <td><?= nl2br(htmlspecialchars($linha['produtos'])) ?></td>
              <td><?= date('d/m/Y H:i', strtotime($linha['data_pedido'])) ?></td>

              <!-- Adicionando a classe CSS dinamicamente para o Status -->
              <td>
                <?php 
                  $statusClass = strtolower($linha['status']); // Convertendo para minúsculo
                  $statusClass = preg_replace('/\s+/', '', $statusClass); // Removendo espaços em branco se existirem
                ?>
                <span class="status <?= $statusClass ?>">
                  <?= $linha['status'] ?>
                </span>
              </td>

              <td>
                <a href="aceitar.php?id=<?= $linha['id'] ?>" onclick="return confirm('Deseja aceitar e imprimir o pedido?')">Aceitar</a>
              </td>
              <td>
                <a href="cancelar.php?id=<?= $linha['id'] ?>" onclick="return confirm('Tem certeza?')">Cancelar Pedido</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="alert alert-warning text-center">Nenhum pedido encontrado.</div>
    <?php endif; ?>
  </div>
</body>
</html>
