<?php

namespace App\Interfaces\Repositories;

use App\Models\File;

// Esta interfaz define el "contrato" que cualquier repositorio de archivos debe cumplir.
// Obliga a que exista cierta funcionalidad (métodos) para manejar archivos.
interface FileRepositoryInterface
{
    // Busca un archivo por su ID
    // Devuelve:
    // - Objeto File si lo encuentra
    // - null si no existe
    public function findById(int $id): ?File;

    // Crea un nuevo archivo con los datos proporcionados
    // Devuelve el objeto File recién creado
    public function create(array $data): File;

    // Elimina un archivo existente
    // Devuelve:
    // - true si se eliminó correctamente
    // - false si falló o no encontró el archivo
    public function delete(int $id): bool;
}