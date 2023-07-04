<?php
require_once 'product.php';

class Book extends Product
{
    private $weight;

    public function __construct($sku, $name, $price, $weight)
    {
        parent::__construct($sku, $name, $price);
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function showDetails()
    {
        parent::showDetails();
        echo "Weight: " . $this->weight . "<br>";
    }
}
?>
