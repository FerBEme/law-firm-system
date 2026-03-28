<?php

namespace App\Services;

use App\Interfaces\Repositories\CaseRepositoryInterface;

// Este servicio actúa como capa intermedia entre los controladores y el repositorio de casos.
// Su función principal es manejar la lógica de negocio antes de interactuar con la base de datos.
class CaseService
{
    // Guardamos una instancia del repositorio de casos
    protected $caseRepository;

    // Inyectamos el repositorio de casos mediante el constructor (Dependency Injection)
    public function __construct(CaseRepositoryInterface $caseRepository)
    {
        $this->caseRepository = $caseRepository;
    }

    // Obtiene todos los casos
    // Simplemente delega la llamada al repositorio
    public function getAllCases()
    {
        return $this->caseRepository->all();
    }

    // Crea un nuevo caso con los datos proporcionados
    // Delegamos al repositorio y devolvemos el objeto CaseModel creado
    public function createCase(array $data)
    {
        return $this->caseRepository->create($data);
    }

    // Actualiza un caso existente
    // Recibe ID del caso y datos nuevos
    // Delegamos al repositorio, devuelve true/false según resultado
    public function updateCase(int $id, array $data)
    {
        return $this->caseRepository->update($id, $data);
    }

    // Elimina un caso por su ID
    // Delegamos al repositorio, devuelve true/false según resultado
    public function deleteCase(int $id)
    {
        return $this->caseRepository->delete($id);
    }
}