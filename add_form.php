<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Add Product</title>
</head>
<body>

<div class="navbar">
    <div class="brand">Add Products</div>
    <div class="buttons">
        <button id="addProductButton" class="btn btn-primary">Save</button>
        <button id="cancelButton" class="btn btn-secondary">CANCEL</button>
    </div>
</div>

<form action="add_product.php" method="POST" style="margin-top: 50px; width: 500px; margin-left:30px;" id="product_form">
    <label for="sku">SKU:</label>
    <input type="text" name="sku" id="sku" required><br><br>

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required><br><br>

    <label for="price">Price:</label>
    <input type="text" name="price" id="price" required><br><br>

    <label for="productType">Type:</label>
    <select name="productType" id="productType" required>
        <option value="hidden"></option>
        <option value="Book">Book</option>
        <option value="Furniture">Furniture</option>
        <option value="DVD">DVD</option>
    </select><br><br>

    <div id="specificFields">
        
    </div>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function showSpecificFields() {
            var type = document.getElementById("productType").value;
            var specificFields = document.getElementById("specificFields");

            if (type === "Book") {
                specificFields.innerHTML = `
                    <label for="weight">Weight in Kg:</label>
                    <input type="text" name="weight" id="weight" required><br><br>
                `;
            } else if (type === "DVD") {
                specificFields.innerHTML = `
                    <label for="size">Size in Gb:</label>
                    <input type="text" name="size" id="size" required><br><br>
                `;
            } else if (type === "Furniture") {
                specificFields.innerHTML = `
                    <label for="width">Width:</label>
                    <input type="text" name="width" id="width" required><br><br>

                    <label for="height">Height:</label>
                    <input type="text" name="height" id="height" required><br><br>

                    <label for="length">Length:</label>
                    <input type="text" name="length" id="length" required><br><br>
                `;
            }
        }

        document.getElementById("productType").addEventListener("change", showSpecificFields);

        var addProductButton = document.getElementById("addProductButton");
        addProductButton.addEventListener("click", function() {
            document.getElementById("product_form").submit();
        });

        var cancelButton = document.getElementById("cancelButton");
        cancelButton.addEventListener("click", function() {
            window.location.href = "index.php";
        });
    });
</script>

<footer>
    <div class="footer-content">
        Scadinweb Project Test
    </div>
</footer>

</body>
</html>
