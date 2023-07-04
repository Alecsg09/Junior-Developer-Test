<?php
require_once 'product.php';

class Furniture extends Product
{
    private $width;
    private $height;
    private $length;

    public function __construct($sku, $name, $price, $width, $height, $length)
    {
        parent::__construct($sku, $name, $price);
        $this->width = $width;
        $this->height = $height;
        $this->length = $length;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function showDetails()
    {
        parent::showDetails();
        echo "Width: " . $this->width . "<br>";
        echo "Height: " . $this->height . "<br>";
        echo "Length: " . $this->length . "<br>";
    }
}
?>
