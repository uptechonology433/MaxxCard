<?php

namespace App\DAO\VeroCard\Production;

use App\DAO\VeroCard\Connection;


class ProductionDAO extends Connection
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProductsInProductionChip(): array
    {
        $products = $this->pdo
            ->query("SELECT * from view_megavale_production_chip;")->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($products as &$product) {
            $product['dt_processamento'] = date('d/m/Y', strtotime($product['dt_processamento']));
        }

        return $products;
    }

    public function getAllProductsInProductionElo(): array
    {
        $products = $this->pdo
            ->query("SELECT * FROM view_megavale_production_elo;")->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($products as &$product) {
            $product['dt_processamento'] = date('d/m/Y', strtotime($product['dt_processamento']));
        }

        return $products;
    }
}
