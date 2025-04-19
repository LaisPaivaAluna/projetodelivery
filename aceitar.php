<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Atualiza o status do pedido para 'Aceito'
    $conn->query("UPDATE pedidos SET status = 'Aceito' WHERE id = $id");

    // Recupera os dados do pedido
    $result = $conn->query("SELECT * FROM pedidos WHERE id = $id");
    $pedido = $result->fetch_assoc();

    // Exibe a nota e imprime via JavaScript
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Nota de Pedido</title>
        <style>
            body { font-family: Arial, sans-serif; padding: 20px; }
            .nota { border: 1px solid #000; padding: 20px; width: 400px; }
        </style>
    </head>
    <body onload="window.print(); setTimeout(() => { window.location.href='adm.php'; }, 1000)">
        <div class="nota">
            <h2>Nota de Pedido</h2>
            <p><strong>Nome:</strong> <?= $pedido['nome'] ?></p>
            <p><strong>Endereço:</strong> <?= $pedido['endereco'] ?></p>
            <p><strong>Forma de Pagamento:</strong> <?= $pedido['pagamento'] ?></p>
            <p><strong>Produtos:</strong><br><?= nl2br($pedido['produtos']) ?></p>
            <p><strong>Status:</strong> <?= $pedido['status'] ?></p>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "ID não encontrado.";
}
?>
