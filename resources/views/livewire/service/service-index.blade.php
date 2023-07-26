<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $componentName }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" container mx-auto px-4 {{-- sm:px-6 lg:px-8 --}}">
            <div class="bg-white shadow-lg ">
                <x-table-head>
                    <x-slot:boton_name>
                       Añadir Servicio
                    </x-slot:boton_name>
                </x-table-head>
                <div class="overflow-x-auto">
   
                    @if (count($services))
                            <table class="min-w-max w-full table-auto">
                                    <thead>
                                        <tr class="bg-[#0e1726] text-white uppercase text-sm leading-normal">
                                            <th class="py-3 px-6 text-center">Id</th>
                                            <th class="py-3 px-6 text-left">Nombre</th>
                                            <th class="py-3 px-6 text-left">Descripcion</th>
                                            <th class="py-3 px-6 text-center">Precio</th>
                                            <th class="py-3 px-6 text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" text-sm font-light">
                                        @foreach ($services as $item)   
                                            <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                                                <td class="py-3 px-6 text-center">
                                                    <h1 class="font-medium">{{$item->id }}</h1>
                                                </td>
                                                <td class="py-3 px-6 text-left ">
                                       
                                                        <h1 class="font-medium">{{$item->name}}</h1>
                                                  
                                                </td>
                                                <td class="py-3 px-6 text-left ">
                                       
                                                    <h1 class="font-medium">{{$item->description }}</h1>
                                              
                                            </td>
                                                <td class="py-3 px-6 text-center">
                                                    <h1 class="font-medium">{{$item->price }}</h1>
                                                </td>
                                     
                                                <td class="py-3 px-6 text-center">
                                                    <div class="flex item-center justify-center">
                                                        
                                                        <div wire:click="edit({{$item}})" class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-125 cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                            </svg>
                                                        </div>
                                                        @if($item->details->count()<1)
                                                        <div  wire:click="$emit('deleteService',{{$item->id}})" class="w-4 mr-2 transform hover:text-red-500 hover:scale-125 cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </div>
                                                        @endif

                                                   
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                              
                                     
                                </tbody>
                            </table>
                    @else
                            <h6 class="text-center my-5">Ningun registro encontrado para "{{$search}}"</h6>
                    @endif
                </div>
                @if ($services->hasPages())
                <div class="p-6">
                    {{$services->links()}}
             
                  </div>
                @endif
              
            </div>
        </div>
    </div>

     <x-modal-form :head='$componentName' :id='$selected_id'>
        @include('livewire.service.service-form')
    </x-modal-form> 
    

    @push('js')


    <script>
        Livewire.on('deleteService',servicetId=>{
        Swal.fire({
                title: '¿Estas segurobg?',
                text: "¡No podras revertir esta accion!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                padding: '2em'
                }).then(function(result) {
                if (result.value) {
                    Livewire.emitTo('service.service-index','delete',servicetId);
                    Swal.fire(
                    'Eliminado!',
                    'El registro fue eliminado correctamente',
                    'success'
                    )
                }
                })
        });
            
            
    </script>
    @endpush
   
    
</div>
