<?php

namespace App\Services;

use App\Interfaces\Repositories\FileRepositoryInterface;
use Illuminate\Support\Facades\Storage;

// Este servicio maneja la lógica de archivos (File) antes de interactuar con la base de datos
// Aquí se hace la subida a almacenamiento y la eliminación física y de registro en BD
class FileService
{
    // Guardamos una instancia del repositorio de archivos
    protected $fileRepository;

    // Inyectamos el repositorio de archivos mediante el constructor (Dependency Injection)
    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    // Método para subir un archivo
    // Recibe:
    // - $file: archivo subido desde un formulario
    // - $folderId: ID de la carpeta donde se guardará
    // - $userId: ID del usuario que sube el archivo
    public function uploadFile($file, $folderId, $userId)
    {
        // Guardamos el archivo en la carpeta 'cases' del disco 'public' de Laravel
        $path = $file->store('cases', 'public');

        // Creamos un registro en la base de datos con la info del archivo
        return $this->fileRepository->create([
            'folder_id'   => $folderId,                 // Carpeta asociada
            'name'        => $file->getClientOriginalName(), // Nombre original del archivo
            'file_path'   => $path,                     // Ruta donde se guardó
            'file_type'   => $file->getClientMimeType(),// Tipo MIME del archivo
            'file_size'   => $file->getSize(),         // Tamaño en bytes
            'uploaded_by' => $userId,                  // Usuario que subió el archivo
        ]);
    }

    // Método para eliminar un archivo
    // Recibe ID del archivo
    public function deleteFile(int $id)
    {
        // Buscamos el archivo en la base de datos
        $file = $this->fileRepository->findById($id);

        if ($file) {
            // Eliminamos el archivo físico del almacenamiento 'public'
            Storage::disk('public')->delete($file->file_path);

            // Eliminamos el registro en la base de datos
            return $this->fileRepository->delete($id);
        }

        // Si no se encontró el archivo, devolvemos false
        return false;
    }
}