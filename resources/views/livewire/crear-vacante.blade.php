<form action="" class="md:w-1/2 space-y-5" wire:submit.prevent='crearVacante'>

    <div>
        <x-label for="titulo" :value="__('Titulo Vacante')" />

        <x-input 
        id="titulo" 
        class="block mt-1 w-full" 
        type="text" wire:model="titulo" 
        :value="old('titulo')" 
        placeholder="Titulo de vacante"
         />
         @error("titulo")
            <livewire:mostrar-alerta :message="$message" />
         @enderror
    </div>

    <div>
        <x-label for="salario" :value="__('Salario Mensual')" />

        <select wire:model="salario" id="salario" 
            class="w-full rounded-md shadow-sm border-gray-300 
            focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">--Seleccione--</option>
            @foreach ($salarios as $salario)
            <option value="{{$salario->id}}">{{$salario->salario}}</option>
                
            @endforeach
        </select>
        @error("salario")
            <livewire:mostrar-alerta :message="$message" />
         @enderror
    </div>

    <div>
        <x-label for="categoria" :value="__('Categoria')" />

        <select wire:model="categoria" id="categoria" 
            class="w-full rounded-md shadow-sm border-gray-300 
            focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">--Seleccione--</option>
            @foreach ($categorias as $categoria)
            <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                
            @endforeach
        </select>
        @error("categoria")
            <livewire:mostrar-alerta :message="$message" />
         @enderror
    </div>

    <div>
        <x-label for="empresa" :value="__('Empresa')" />

        <x-input 
        id="empresa" 
        class="block mt-1 w-full" 
        type="text" wire:model="empresa" 
        :value="old('empresa')" 
        placeholder="Empresa: ej Netflix, Uber, etc"
         />
         @error("empresa")
            <livewire:mostrar-alerta :message="$message" />
         @enderror
    </div>

    <div>
        <x-label for="ultimo_dia" :value="__('Último día de Postulación')" />

        <x-input 
        id="ultimo_dia" 
        class="block mt-1 w-full" 
        type="date" wire:model="ultimo_dia" 
        :value="old('ultimo_dia')" 
         />
         @error("ultimo_dia")
            <livewire:mostrar-alerta :message="$message" />
         @enderror
    </div>

    <div>
        <x-label for="descripcion" :value="__('Descripción del puesto')" />

        <textarea wire:model="descripcion" 
        placeholder="Descripción general del puesto" 
        id="descripcion" class="w-full rounded-md shadow-sm border-gray-300 
        focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full h-72"></textarea>
        @error("descripcion")
            <livewire:mostrar-alerta :message="$message" />
         @enderror
    </div>

    <div>
        <x-label for="imagen" :value="__('Imagen de la vacante')" />

        <x-input 
        id="imagen" 
        class="block mt-1 w-full" 
        type="file" wire:model="imagen"
        accept="image/*"  
         />

         <div class="my-5 w-96">
            @if ($imagen)
                Imagen:
                <img src="{{$imagen->temporaryUrl()}}">
            @endif
         </div>

         @error("imagen")
            <livewire:mostrar-alerta :message="$message" />
         @enderror
    </div>

    <x-button>
        Crear Vacante
    </x-button>

</form>
