<?php

namespace App\Repositories\Eloquent;

use App\Models\CaseModel;
use App\Interfaces\Repositories\CaseRepositoryInterface;

// Este repositorio se encarga de manejar todas las operaciones sobre "cases"
// Implementa la interfaz CaseRepositoryInterface, por lo que debe cumplir con los métodos definidos allí
class CaseRepository implements CaseRepositoryInterface
{
    // Devuelve todos los casos de la base de datos
    public function all()
    {
        return CaseModel::all(); // Retorna una colección de todos los registros
    }

    // Busca un caso por su ID
    // Devuelve el objeto CaseModel si lo encuentra, o null si no existe
    public function findById(int $id): ?CaseModel
    {
        return CaseModel::find($id);
    }

    // Crea un nuevo caso con los datos proporcionados
    // Devuelve el objeto CaseModel recién creado
    public function create(array $data): CaseModel
    {
        return CaseModel::create($data);
    }

    // Actualiza un caso existente
    // 1. Busca el caso por su ID
    // 2. Si lo encuentra, actualiza los datos y devuelve true
    // 3. Si no lo encuentra, devuelve false
    public function update(int $id, array $data): bool
    {
        $case = $this->findById($id);
        return $case ? $case->update($data) : false;
    }

    // Elimina un caso existente
    // 1. Busca el caso por su ID
    // 2. Si lo encuentra, lo elimina y devuelve true
    // 3. Si no lo encuentra, devuelve false
    public function delete(int $id): bool
    {
        $case = $this->findById($id);
        return $case ? $case->delete() : false;
    }
}