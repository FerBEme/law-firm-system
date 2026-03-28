<?php
namespace App\Repositories\Eloquent;
use App\Models\Payment;
use App\Interfaces\Repositories\PaymentRepositoryInterface;
// Este repositorio maneja todas las operaciones sobre pagos (Payment)
// Implementa la interfaz PaymentRepositoryInterface, por lo que debe cumplir con sus métodos
class PaymentRepository implements PaymentRepositoryInterface {
    // Busca un pago por su ID, Devuelve:
    // - Objeto Payment si lo encuentra
    // - null si no existe
    public function findById(int $id): ?Payment {
        return Payment::find($id);
    }
    public function create(array $data): Payment { // Crea un nuevo pago con los datos proporcionados,y devuelve el objeto Payment recién creado
        return Payment::create($data);
    }
    // Actualiza un pago existente
    // 1. Busca el pago por su ID
    // 2. Si lo encuentra, actualiza los datos y devuelve true
    // 3. Si no lo encuentra, devuelve false
    public function update(int $id, array $data): bool {
        $payment = $this->findById($id);
        return $payment ? $payment->update($data) : false;
    }
}