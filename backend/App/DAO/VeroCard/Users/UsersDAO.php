<?php

namespace App\DAO\VeroCard\Users;

use App\DAO\VeroCard\Connection;
use App\Models\UsersModel;

class UsersDAO extends Connection
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUserByName(string $name): ?UsersModel // Alterado o nome do método para getUserByName
    {
        $statement = $this->pdo
            ->prepare('SELECT id ,nome, email, senha , admin FROM usuarios_max_card WHERE nome = :nome;'); // Alterado para buscar pelo nome

        $statement->bindParam('nome', $name); // Alterado para bind pelo nome

        $statement->execute();

        $users = $statement->fetchAll(\PDO::FETCH_ASSOC);

        if (count($users) === 0)
            return null;

        $usuario = new UsersModel();

        $usuario->
        setId($users[0]['id'])
            ->setNome($users[0]['nome'])
            ->setEmail($users[0]['email'])
            ->setSenha($users[0]['senha'])
            ->setAdmin($users[0]['admin']);

        return $usuario;
    }

}
?>
