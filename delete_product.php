<?php

if (isset($_POST['delete-checkbox'])) {
    $selectedProducts = $_POST['delete-checkbox'];

    $host = 'localhost';
    $dbname = 'id20702494_test';
    $username = 'id20702494_alecsg09';
    $password = '@123456Ab';

    try {
        $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach ($selectedProducts as $productId) {
            $stmt = $connection->prepare("DELETE FROM products WHERE id = :id");
            $stmt->bindParam(':id', $productId);
            $stmt->execute();
        }

        if (isset($_POST['redirect'])) {
            $redirect = $_POST['redirect'];
            header("Location: $redirect");
            exit;
        }
    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
    }
} else {
    echo "Choose a product to delete.";
}
?>
