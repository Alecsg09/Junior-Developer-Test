<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0/css/bootstrap.min.css">
    
    <style>
        .navbar {
            margin-top: 40px;
        }
        .product {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
        }
        .product-details {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="brand">Products</div>
        <div class="buttons">
            <a href="add_form.php" class="add-button">ADD</a>
            <button class="delete-button" onclick="deleteSelectedProducts()"> MASS DELETE</button>
        </div>
    </div>

    <div class="container">
        <form id="deleteForm" action="delete_product.php" method="POST">
            <div class="row product-list">
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

                    $stmt = $connection->prepare("SELECT * FROM products");
                    $stmt->execute();
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($products as $product) {
                        echo "<div class='col-lg-4 col-md-6 col-sm-12'>";
                        echo "<div class='product'>";
                        echo "<div class='delete-checkbox'><input type='checkbox' name='delete-checkbox[]' id='delete-checkbox' value='" . $product['id'] . "'></div>";
                        echo "<div class='product-details'>";

                        if ($product['productType'] === 'Book') {
                            $book = new Book($product['sku'], $product['name'], $product['price'], $product['weight']);
                            $book->showDetails();
                        } elseif ($product['productType'] === 'DVD') {
                            $dvd = new DVD($product['sku'], $product['name'], $product['price'], $product['size']);
                            $dvd->showDetails();
                        } elseif ($product['productType'] === 'Furniture') {
                            $furniture = new Furniture($product['sku'], $product['name'], $product['price'], $product['width'], $product['height'], $product['length']);
                            $furniture->showDetails();
                        }

                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }

                } catch (PDOException $e) {
                    echo "Connection error: " . $e->getMessage();
                }
                ?>
            </div>
            <input type="hidden" name="redirect" value="index.php">
        </form>
    </div>

    <script>
        function deleteSelectedProducts() {
            const checkboxes = document.querySelectorAll('.delete-checkbox input[type="checkbox"]:checked');
            if (checkboxes.length > 0) {
                document.getElementById('deleteForm').submit();
            } else {
                alert('No products selected.');
            }
        }

    </script>

    <footer>
        <div class="footer-content">
            Scandiweb Project Test
        </div>
    </footer>
</body>
</html>
