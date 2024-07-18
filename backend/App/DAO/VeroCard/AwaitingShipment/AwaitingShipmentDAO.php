<?php

namespace App\DAO\VeroCard\AwaitingShipment;
use App\DAO\VeroCard\Connection;


class AwaitingShipmentDAO extends Connection{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllAwaitingShipmentChip() : array {

        $productsAwaitingShipment = $this -> pdo
            ->query("SELECT  * FROM view_max_card_AwaitingShipment_chip;") 
            ->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($productsAwaitingShipment as &$product) {
                $product['dt_processamento'] = date('d/m/Y', strtotime($product['dt_processamento']));
                
                switch ($product['id_tipo_material']) {
                    case 1:
                        $product['id_tipo_material'] = 'PLÁSTICO';
                        break;
                    case 2:
                        $product['id_tipo_material'] = 'FOLHETERIA';
                        break;
                    default:
                        $product['id_tipo_material'] = 'desconhecido';
                        break;
                }
              
            }

            return $productsAwaitingShipment;

    }

    
  

    public function getAllAwaitingShipmentElo() : array {

        $productsAwaitingShipment = $this -> pdo
            ->query(" SELECT * from view_max_card_AwaitingShipment_elo;") 
            ->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($productsAwaitingShipment as &$product) {
                $product['dt_processamento'] = date('d/m/Y', strtotime($product['dt_processamento']));
              
            }

            return $productsAwaitingShipment;

    }


}