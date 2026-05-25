<?php

require_once "models/Product.php";

class ProductController {

    private $productModel;

    public function __construct($pdo) {
        $this->productModel = new Product($pdo);
    }

    public function index() {
        $products = $this->productModel->getAll();
        return $products;
    }
}