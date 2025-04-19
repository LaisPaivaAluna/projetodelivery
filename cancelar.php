<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Você pode alterar o status do pedido para "Cancelado" no banco de dados
    $conn->query("UPDATE pedidos SET status = 'Cancelado' WHERE id = $id");
    
    // Redireciona de volta para a página de administração
    header("Location: adm.php");
    exit();
}
?>
