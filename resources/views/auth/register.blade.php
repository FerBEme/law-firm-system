@php
    // Este arreglo define TODOS los campos del formulario de manera dinámica
    // Cada elemento representa un input/select con sus configuraciones
    $fields = [
        // =======================
        // DATOS DESDE RENIEC (DNI)
        // =======================
        // Campo DNI (activa búsqueda automática)
        ['name' => 'dni', 'label' => 'DNI', 'type' => 'text', 'class' => '', 'is_dni' => true],
        // Estos campos se llenan automáticamente con datos de RENIEC
        ['name' => 'first_name', 'label' => 'Nombres', 'type' => 'text', 'class' => 'bg-gray-100'],
        ['name' => 'paternal_surname', 'label' => 'Apellido Paterno', 'type' => 'text', 'class' => 'bg-gray-100'],
        ['name' => 'maternal_surname', 'label' => 'Apellido Materno', 'type' => 'text', 'class' => 'bg-gray-100'],
        // =======================
        // CAMPOS NORMALES
        // =======================
        // Campo celular (solo números, máximo 9 dígitos)
        ['name' => 'phone', 'label' => 'Celular', 'type' => 'text', 'numeric' => true, 'maxlength' => 9],
        // Campo email
        ['name' => 'email', 'label' => 'Correo Electrónico', 'type' => 'email'],
        // =======================
        // SELECT (ROL)
        // =======================
        ['name' => 'role','label' => 'Rol','type' => 'select',
            // Opciones del select
            'options' => ['admin' => 'Administrador', 'lawyer' => 'Abogado', 'secretary' => 'Secretaria'],
        ],
        // =======================
        // CAMPOS CONDICIONALES
        // =======================
        // Solo se muestra si el rol es abogado
        ['name' => 'cal_number', 'label' => 'Número CAL', 'type' => 'text', 'show' => "role === 'lawyer'"],
        // Solo se muestra si el rol es secretaria
        ['name' => 'lawyer_id','label' => 'Asignar Abogado','type' => 'select-lawyers','show' => "role === 'secretary'"],
        // =======================
        // PASSWORDS
        // =======================
        ['name' => 'password', 'label' => 'Password', 'type' => 'password'],
        ['name' => 'password_confirmation', 'label' => 'Confirm Password', 'type' => 'password'],
    ];
@endphp

<x-guest-layout>
    {{-- Formulario principal --}}
    <form method="POST" action="{{ route('register') }}" x-data="{ ...dniLookup(), role: '{{ old('role') }}' }">
        {{-- x-data inicializa Alpine.js con: - funciones del DNI (dniLookup) - el rol seleccionado previamente --}}
        @csrf {{-- Token de seguridad de Laravel --}}
        {{-- Recorremos todos los campos definidos arriba --}}
        @foreach ($fields as $field)
            <div class="mt-4"
            {{-- Si el campo tiene condición "show", se aplica con Alpine --}}
            @isset($field['show'])
                x-show="{{ $field['show'] }}" {{-- Mostrar/Ocultar --}}
                x-transition {{-- Animación --}}
                x-cloak {{-- Evita parpadeo inicial --}}
            @endisset>
                {{-- Label del campo --}}
                <x-input-label for="{{ $field['name'] }}" value="{{ $field['label'] }}" />
                {{-- =======================
                     CAMPO DNI
                   ======================= --}}
                @if (isset($field['is_dni']))
                    <x-text-input
                        id="{{ $field['name'] }}"
                        name="{{ $field['name'] }}"
                        type="text"
                        class="block mt-1 w-full"
                        x-model="dni" {{-- Enlazado con Alpine --}}
                        @input.debounce.500ms="buscarDni" {{-- Espera 500ms para consultar --}}
                        maxlength="8"
                        inputmode="numeric"
                        pattern="[0-9]*"                        
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" {{-- Solo permite números --}}
                        required
                    />
                {{-- =======================
                     CAMPOS RENIEC AUTO
                   ======================= --}}
                @elseif(in_array($field['name'], ['first_name', 'paternal_surname', 'maternal_surname']))
                    <x-text-input
                        id="{{ $field['name'] }}"
                        name="{{ $field['name'] }}"
                        type="text"
                        class="block mt-1 w-full {{ $field['class'] }}"
                        x-model="{{ $field['name'] }}" {{-- Se llena desde API --}}
                        x-bind:readonly="{{ $field['name'] }} !== ''" {{-- Si ya tiene valor, se bloquea --}}
                        style="text-transform: uppercase;"                        
                        oninput="this.value = this.value.toUpperCase()" {{-- Convierte a mayúsculas --}}
                        required
                    />

                {{-- =======================
                     INPUT NORMAL
                   ======================= --}}
                @elseif(in_array($field['type'], ['text', 'email', 'password']))
                    @if (isset($field['numeric']))
                        {{-- Input solo numérico --}}
                        <x-text-input
                            id="{{ $field['name'] }}"
                            name="{{ $field['name'] }}"
                            type="{{ $field['type'] }}"
                            class="block mt-1 w-full {{ $field['class'] ?? '' }}"
                            :value="old($field['name'])"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            maxlength="{{ $field['maxlength'] }}"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            required
                        />
                    @else
                        {{-- Input normal --}}
                        <x-text-input
                            id="{{ $field['name'] }}"
                            name="{{ $field['name'] }}"
                            type="{{ $field['type'] }}"
                            class="block mt-1 w-full {{ $field['class'] ?? '' }}"
                            :value="old($field['name'])"
                            required
                        />
                    @endif
                @endif
                {{-- =======================
                     SELECT NORMAL (ROL)
                   ======================= --}}
                @if (isset($field['type']) && $field['type'] === 'select')
                    <select
                        name="{{ $field['name'] }}"
                        id="{{ $field['name'] }}"
                        x-model="role" {{-- Controla visibilidad de otros campos --}}
                        class="block mt-1 w-full border-gray-300 rounded-md"                    >
                        <option value="">Seleccione</option>
                        {{-- Recorre opciones --}}
                        @foreach ($field['options'] as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                @endif
                {{-- =======================
                     SELECT DE ABOGADOS
                   ======================= --}}
                @if (isset($field['type']) && $field['type'] === 'select-lawyers')
                    <select name="lawyer_id" id="lawyer_id"
                        class="block mt-1 w-full border-gray-300 rounded-md">
                        <option value="">Seleccione un abogado</option>
                        {{-- Lista de abogados desde el controlador --}}
                        @foreach ($lawyers as $lawyer)
                            <option value="{{ $lawyer->id }}" {{ old('lawyer_id') == $lawyer->id ? 'selected' : '' }}>
                                {{ $lawyer->first_name }}
                                {{ $lawyer->paternal_surname }}
                                {{ $lawyer->maternal_surname }}
                            </option>
                        @endforeach
                    </select>
                @endif
                {{-- Muestra errores de validación --}}
                <x-input-error :messages="$errors->get($field['name'])" class="mt-2" />
            </div>
        @endforeach
        {{-- Botones --}}
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm" href="{{ route('login') }}">
                Ya estás registrado?
            </a>
            <x-primary-button class="ms-4">
                Registrar
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script>
    // Función que maneja la lógica del DNI (Alpine.js)
    function dniLookup() {
        return {
            // Valores iniciales (si hubo error en el form)
            dni: '{{ old('dni') }}',
            first_name: '{{ old('first_name') }}',
            paternal_surname: '{{ old('paternal_surname') }}',
            maternal_surname: '{{ old('maternal_surname') }}',
            lastDni: '', // Para evitar repetir consultas
            async buscarDni() {
                // Si no tiene 8 dígitos o es el mismo, no hace nada
                if (this.dni.length !== 8 || this.dni === this.lastDni) return;
                this.lastDni = this.dni;
                try {
                    // Llamada a tu API Laravel
                    let res = await fetch(`/api/dni/${this.dni}`);
                    let json = await res.json();
                    // Si hay datos válidos
                    if (json.success && json.data) {
                        // Asigna valores en mayúsculas
                        this.first_name = (json.data.nombres ?? '').toUpperCase();
                        this.paternal_surname = (json.data.apellido_paterno ?? '').toUpperCase();
                        this.maternal_surname = (json.data.apellido_materno ?? '').toUpperCase();
                    }
                } catch (e) {
                    console.error(e); // Error en consola
                }
            }
        }
    }
</script>