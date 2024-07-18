<?php

namespace App\DAO\VeroCard\Dispatched;
use App\DAO\VeroCard\Connection;


class DispatchedDAO extends Connection{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllDispatchedChip() : array {

        $productsDispatched = $this -> pdo
            ->query("SELECT  * FROM view_max_card_dispatched_chip;") 
            ->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($productsDispatched as &$product) {
                $product['dt_processamento'] = date('d/m/Y', strtotime($product['dt_processamento']));
                $product['dt_expedicao'] = date('d/m/Y', strtotime($product['dt_expedicao']));
                
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

            return $productsDispatched ;

    }

    //

    public function getAllDispatchedElo() : array {

        $productsDispatched  = $this -> pdo
            ->query("SELECT * from view_max_card_dispatched_elo;") 
            ->fetchAll(\PDO::FETCH_ASSOC);

            foreach ($productsDispatched as &$product) {
                $product['dt_processamento'] = date('d/m/Y', strtotime($product['dt_processamento']));
                $product['dt_expedicao'] = date('d/m/Y', strtotime($product['dt_expedicao']));

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

            return $productsDispatched ;

    }


}