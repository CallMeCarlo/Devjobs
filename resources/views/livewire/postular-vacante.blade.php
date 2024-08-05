<div class="bg-gray-100 p-5 mt-10 flex flex-col justify-center items-center ">
    <h3 class="text-center text-2xl font-bold my-4">Postularme a esta vacante</h3>

    @if (session()->has('mensaje'))
        <div class="uppercase border border-green-600 bg-green-100 text-green-600
        font-bold p-2 my-5 text-sm rounded-lg">
            {{session("mensaje")}}
        </div>
    @else
        <form class="w-96 mt-5" wire:submit.prevent='postularme' enctype="multipart/form-data">
            <div class="mb-4">
                <div>
                    <x-label for="cv" :value="__('Curriculum u Hoja de Vida (PDF)')" />
                    <x-input id="cv" wire:model.defer="cv" class="block mt-1 w-full" type="file" name="cv" />
                </div>

                @error("cv")
                    <livewire:mostrar-alerta :message="$message">
                @enderror

                <x-button class="my-5 w-full justify-center items-center">
                    {{ __('Postularme') }}
                </x-button>
            </div>
        </form>
    @endif

    
</div>
