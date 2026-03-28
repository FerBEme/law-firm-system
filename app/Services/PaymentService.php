<?php

namespace App\Services;

use App\Interfaces\Repositories\PaymentRepositoryInterface;

// Este servicio maneja la lógica de pagos (Payment) antes de interactuar con la base de datos
// Se encarga de crear y actualizar pagos usando el repositorio
class PaymentService
{
    // Guardamos una instancia del repositorio de pagos
    protected $paymentRepository;

    // Inyectamos el repositorio de pagos mediante el constructor (Dependency Injection)
    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    // Método para crear un nuevo pago
    // Recibe un array con los datos del pago
    // Devuelve el objeto Payment recién creado
    public function createPayment(array $data)
    {
        return $this->paymentRepository->create($data);
    }

    // Método para actualizar un pago existente
    // Recibe:
    // - ID del pago a actualizar
    // - Array con los nuevos datos
    // Devuelve true/false según resultado de la actualización
    public function updatePayment(int $id, array $data)
    {
        return $this->paymentRepository->update($id, $data);
    }
}