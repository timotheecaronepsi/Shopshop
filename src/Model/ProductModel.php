<?php

declare (strict_types = 1);

namespace MyApp\Model;

use MyApp\Entity\Product;
use MyApp\Entity\Type;
use PDO;

class ProductModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllProducts(): array
    {
        $sql = "SELECT p.id as idProduit, name, description, price, stock, t.id as idType, label
FROM Product p inner join Type t on p.idType = t.id order by name";

        $stmt = $this->db->query($sql);

        $products = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $type = new Type($row['idType'], $row['label']);
            $products[] = new Product($row['id'], $row['name'], $row['description'], $row['price'], $row['stock'], $type);
        }

        return $products;
    }

    public function createProduct(Product $product): bool
    {
        $sql = "INSERT INTO Product (name, description, price, stock, idType) VALUES (:name, :description, :price, :stock, :idType)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $product->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':description', $product->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(':price', $product->getPrice(), PDO::PARAM_STR);
        $stmt->bindValue(':stock', $product->getStock(), PDO::PARAM_INT);
        $stmt->bindValue(':idType', $product->getType()->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getallproductbytype (Type $type): array{
        
    }









}
