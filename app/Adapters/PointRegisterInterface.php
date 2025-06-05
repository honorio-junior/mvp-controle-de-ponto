<?php
namespace App\Adapters;

interface PointRegisterInterface
{
    public function find(string $cpf): array;
    public function save(string $cpf): void;
    public function all(): array;
}
