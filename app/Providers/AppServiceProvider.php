<?php
namespace App\Providers;
use App\Interfaces\Repositories\CaseRepositoryInterface;
use App\Interfaces\Repositories\FileRepositoryInterface;
use App\Interfaces\Repositories\PaymentRepositoryInterface;
use App\Repositories\Eloquent\CaseRepository;
use App\Repositories\Eloquent\FileRepository;
use App\Repositories\Eloquent\PaymentRepository;
use Illuminate\Support\ServiceProvider;
// Este ServiceProvider se encarga de registrar los bindings (vinculaciones) de interfaces a implementaciones
// Básicamente le dice a Laravel: "Cuando alguien pida esta interfaz, dale esta clase concreta"
class AppServiceProvider extends ServiceProvider {
    public function register(): void { // Método donde se registran los servicios e interfaces
        $this->app->bind(CaseRepositoryInterface::class, CaseRepository::class); // Cada vez que se inyecte CaseRepositoryInterface, se instanciará CaseRepository
        $this->app->bind(FileRepositoryInterface::class, FileRepository::class); // Cada vez que se inyecte FileRepositoryInterface, se instanciará FileRepository
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class); // Cada vez que se inyecte PaymentRepositoryInterface, se instanciará PaymentRepository
    }
    // Método donde se pueden ejecutar tareas después de que todos los servicios han sido registrados
    // Actualmente está vacío porque no necesitamos bootstrapping adicional
    public function boot(): void { }
}