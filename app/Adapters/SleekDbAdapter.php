<?php

namespace App\Adapters;

use SleekDB\Store;

class SleekDbAdapter implements PointRegisterInterface
{
    private readonly string $databaseDirectory;
    private Store $col;

    public function __construct()
    {
        $this->databaseDirectory = storage_path('points/records');
        $this->col = new Store("news", $this->databaseDirectory);
    }

    public function find(string $cpf): array
    {
        $cpf = preg_replace('/\D/', '', $cpf);
        $user = $this->col->findBy(["cpf", '=', $cpf], limit: 1);
        return $user[0] ?? [];
    }

    public function save(string $cpf): void
    {
        $user = $this->find($cpf);
        $today = date("Y-m-d");
        $now = date("H:i:s");

        if (empty($user)) {
            $data = [
                "cpf" => $cpf,
                "points" => [
                    $today => [$now],
                ],
            ];
            $this->col->insert($data);
            return;
        }

        if (isset($user['points'][$today])) {

            if (count($user['points'][$today]) >= 4) {
                throw new \Exception('Maximo de registros atingido no dia!');
            }
            $user['points'][$today][] = $now;
        } else {
            $user['points'][$today] = [$now];
        }

        $data = $user;
        unset($data['_id']);
        $this->col->updateById($user['_id'], $data);
    }
}
