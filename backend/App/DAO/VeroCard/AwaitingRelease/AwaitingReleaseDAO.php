<?php

namespace App\DAO\VeroCard\AwaitingRelease;
use App\DAO\VeroCard\Connection;


class AwaitingReleaseDAO extends Connection{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllAwaitingReleaseChip() : array {

        $productsAwaitingRelease = $this -> pdo
            ->query("SELECT  * FROM view_max_card_awaitingrelease_chip") 
            ->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($productsAwaitingRelease as &$product) {
                $product['dt_processamento'] = date('d/m/Y', strtotime($product['dt_processamento']));
              
            }

            return $productsAwaitingRelease;

    }

    public function getAllAwaitingReleaseElo() : array {

        $productsAwaitingRelease = $this -> pdo
            ->query("SELECT * from view_max_card_awaitingrelease_elo;") 
            ->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($productsAwaitingRelease as &$product) {
                $product['dt_processamento'] = date('d/m/Y', strtotime($product['dt_processamento']));
              
            }

            return $productsAwaitingRelease;

    }


}