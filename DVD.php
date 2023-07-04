<?php
require_once 'product.php';

class DVD extends Product
{
    private $size;

    public function __construct($sku, $name, $price, $size)
    {
        parent::__construct($sku, $name, $price);
        $this->size = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function showDetails()
    {
        parent::showDetails();
        echo "Size: " . $this->size . "<br>";
    }
}
?>
