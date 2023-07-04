<?php
require_once 'product.php';
require_once 'book.php';
require_once 'furniture.php';
require_once 'DVD.php';

$host = 'localhost';
$dbname = 'id20702494_test';
$username = 'id20702494_alecsg09';
$password = '@123456Ab';

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['productType'];

    if (empty($sku) || empty($name) || empty($price) || empty($type)) {
        header("Location: index.php?error=emptyfields");
        exit;
    }

   
    $stmt = $connection->prepare("SELECT COUNT(*) FROM products WHERE sku = :sku");
    $stmt->bindParam(':sku', $sku);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        header("Location: index.php?error=duplicatesku");
        exit;
    }

    $product = null;

    if ($type == "Book") {
        $weight = $_POST['weight'];
        if (empty($weight)) {
            header("Location: index.php?error=emptyweight");
            exit;
        }
        $product = new Book($sku, $name, $price, $weight);

    } elseif ($type == "DVD") {
        $size = $_POST['size'];
        if (empty($size)) {
            header("Location: index.php?error=emptysize");
            exit;
        }
        $product = new DVD($sku, $name, $price, $size);

    } elseif ($type == "Furniture") {
        $width = $_POST['width'];
        $height = $_POST['height'];
        $length = $_POST['length'];

        if (empty($width) || empty($height) || empty($length)) {
            header("Location: index.php?error=emptydimensions");
            exit;
        }
        $product = new Furniture($sku, $name, $price, $width, $height, $length);
    } else {
        header("Location: index.php?error=invalidtype");
        exit;
    }

    $stmt = $connection->prepare("INSERT INTO products (sku, name, price, productType, weight, size, width, height, length) VALUES (:sku, :name, :price, :productType, :weight, :size, :width, :height, :length)");

    $stmt->bindParam(':sku', $sku);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':productType', $type);

    if ($type == "Book") {
        $weight = $_POST['weight'];
        $stmt->bindParam(':weight', $weight);
        $stmt->bindValue(':size', null);
        $stmt->bindValue(':width', null);
        $stmt->bindValue(':height', null); 
        $stmt->bindValue(':length', null);
    } elseif ($type == "DVD") {
        $size = $_POST['size'];
        $stmt->bindParam(':size', $size);
        $stmt->bindValue(':weight', null);
        $stmt->bindValue(':width', null); 
        $stmt->bindValue(':length', null); 
    } elseif ($type == "Furniture") {
        $width = $_POST['width'];
        $height = $_POST['height'];
        $length = $_POST['length'];
        $stmt->bindParam(':width', $width);
        $stmt->bindParam(':height', $height);
        $stmt->bindParam(':length', $length);
        $stmt->bindValue(':weight', null); 
        $stmt->bindValue(':size', null);
    }

    $stmt->execute();

    header("Location: index.php?success=true");
    exit;
} catch (PDOException $e) {
    header("Location: index.php?error=databaseerror");
    exit;
}
?>
