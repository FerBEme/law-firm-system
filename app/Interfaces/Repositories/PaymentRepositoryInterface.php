<?php
namespace App\Interfaces\Repositories;
use App\Models\Payment;
// Esta interfaz define el "contrato" que cualquier repositorio de pagos debe cumplir.
// Es decir, obliga a que exista cierta funcionalidad (métodos) para manejar pagos
interface PaymentRepositoryInterface {
    // Método para buscar un pago por su ID, Recibe un entero (id) y devuelve:
    // - Un objeto Payment si lo encuentra
    // - null si no existe
    public function findById(int $id): ?Payment;
    // Método para crear un nuevo pago, Recibe un array con los datos del pago, Devuelve el objeto Payment ya creado (guardado en la BD)
    public function create(array $data): Payment;
    // Método para actualizar un pago existente, Recibe:
    // - ID del pago a actualizar
    // - Array con los nuevos datos
    // Devuelve:
    // - true si la actualización fue exitosa
    // - false si falló
    public function update(int $id, array $data): bool;
}
