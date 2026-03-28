<?php
namespace App\Repositories\Eloquent;
use App\Models\CaseModel;
use App\Interfaces\Repositories\CaseRepositoryInterface;
// Este repositorio se encarga de manejar todas las operaciones sobre "cases"
// Implementa la interfaz CaseRepositoryInterface, por lo que debe cumplir con los métodos definidos allí
class CaseRepository implements CaseRepositoryInterface {
    public function all() { // Devuelve todos los casos de la base de datos
        return CaseModel::all(); // Retorna una colección de todos los registros
    }
    public function findById(int $id): ?CaseModel { // Busca un caso por su ID, y devuelve el objeto CaseModel si lo encuentra, o null si no existe
        return CaseModel::find($id);
    }
    public function create(array $data): CaseModel { // Crea un nuevo caso con los datos proporcionados, y devuelve el objeto CaseModel recién creado
        return CaseModel::create($data);
    }
    // Actualiza un caso existente
    // 1. Busca el caso por su ID
    // 2. Si lo encuentra, actualiza los datos y devuelve true
    // 3. Si no lo encuentra, devuelve false
    public function update(int $id, array $data): bool {
        $case = $this->findById($id);
        return $case ? $case->update($data) : false;
    }
    // Elimina un caso existente
    // 1. Busca el caso por su ID
    // 2. Si lo encuentra, lo elimina y devuelve true
    // 3. Si no lo encuentra, devuelve false
    public function delete(int $id): bool {
        $case = $this->findById($id);
        return $case ? $case->delete() : false;
    }
}