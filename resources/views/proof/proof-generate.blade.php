<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           GENERAR BOLETA DE LECTRONIDA DE LA VENTA  : {{ $sale->id}}
        </h2>
    </x-slot>

    
    <div class="py-12">
        <div class=" container mx-auto px-4 {{-- sm:px-6 lg:px-8 --}}">
        
            <div class=" overflow-hidden ">
                <livewire:proof.proof-generate :sale="$sale" >
            </div>
        </div>
    </div>
</x-app-layout>
