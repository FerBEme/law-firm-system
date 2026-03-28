<?php
namespace App\Interfaces\Repositories;
use App\Models\CaseModel;
// Esta interfaz define el "contrato" que cualquier repositorio de casos debe cumplir
// Es decir, obliga a que exista cierta funcionalidad (métodos) para manejar casos
interface CaseRepositoryInterface {
    public function all(); // Devuelve todos los casos
    // Busca un caso por su ID, Devuelve:
    // - Objeto CaseModel si lo encuentra
    // - null si no existe
    public function findById(int $id): ?CaseModel;
    // Crea un nuevo caso con los datos proporcionados, Devuelve el objeto CaseModel recién creado
    public function create(array $data): CaseModel;
    // Actualiza un caso existente, Devuelve:
    // - true si la actualización fue exitosa
    // - false si falló o no encontró el caso
    public function update(int $id, array $data): bool;
    // Elimina un caso existente, Devuelve:
    // - true si se eliminó correctamente
    // - false si falló o no encontró el caso
    public function delete(int $id): bool;
}