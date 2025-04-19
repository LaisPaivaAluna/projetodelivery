<?php
include 'conexao.php';

// Pegando os dados do formulário
$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$pagamento = $_POST['pagamento'];
$produtos = $_POST['produtos'];

// Prepara a query para inserir os dados de maneira segura
$stmt = $conn->prepare("INSERT INTO pedidos (nome, endereco, pagamento, produtos) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nome, $endereco, $pagamento, $produtos);

// Executa a query
if ($stmt->execute()) {
    echo "Pedido realizado com sucesso!";
} else {
    echo "Erro: " . $stmt->error;
}

// Fecha a conexão
$stmt->close();
$conn->close();
?>
