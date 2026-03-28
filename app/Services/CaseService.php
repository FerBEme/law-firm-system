<?php
namespace App\Services;
use App\Interfaces\Repositories\CaseRepositoryInterface;
// Este servicio actúa como capa intermedia entre los controladores y el repositorio de casos.
// Su función principal es manejar la lógica de negocio antes de interactuar con la base de datos.
class CaseService {    
    protected $caseRepository; // Guardamos una instancia del repositorio de casos
    public function __construct(CaseRepositoryInterface $caseRepository) { // Inyectamos el repositorio de casos mediante el constructor (Dependency Injection)
        $this->caseRepository = $caseRepository;
    }
    public function getAllCases() { // Obtiene todos los casos, simplemente delega la llamada al repositorio
        return $this->caseRepository->all();
    }
    public function createCase(array $data) { // Crea un nuevo caso con los datos proporcionados, y delegamos al repositorio y devolvemos el objeto CaseModel creado
        return $this->caseRepository->create($data);
    }
    // Actualiza un caso existente
    // Recibe ID del caso y datos nuevos
    // Delegamos al repositorio, devuelve true/false según resultado
    public function updateCase(int $id, array $data) {
        return $this->caseRepository->update($id, $data);
    }
    public function deleteCase(int $id) { // Elimina un caso por su ID, y delegamos al repositorio, devuelve true/false según resultado
        return $this->caseRepository->delete($id);
    }
}