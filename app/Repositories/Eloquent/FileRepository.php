<?php

namespace App\Repositories\Eloquent;

use App\Models\File;
use App\Interfaces\Repositories\FileRepositoryInterface;

// Este repositorio maneja todas las operaciones sobre archivos (File)
// Implementa la interfaz FileRepositoryInterface, por lo que debe cumplir con sus métodos
class FileRepository implements FileRepositoryInterface
{
    // Busca un archivo por su ID
    // Devuelve:
    // - Objeto File si lo encuentra
    // - null si no existe
    public function findById(int $id): ?File
    {
        return File::find($id);
    }

    // Crea un nuevo archivo con los datos proporcionados
    // Devuelve el objeto File recién creado
    public function create(array $data): File
    {
        return File::create($data);
    }

    // Elimina un archivo existente
    // 1. Busca el archivo por su ID
    // 2. Si lo encuentra, lo elimina y devuelve true
    // 3. Si no lo encuentra, devuelve false
    public function delete(int $id): bool
    {
        $file = $this->findById($id);
        return $file ? $file->delete() : false;
    }
}