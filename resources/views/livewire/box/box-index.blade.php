<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$componentName}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" container mx-auto px-4 {{-- sm:px-6 lg:px-8 --}}">
            <div class="bg-white shadow-lg ">
                <div class="grid grid-cols-1 lg:grid-cols-3 p-4">
                    <div class="flex items-center justify-center pb-2 lg:mb-0 lg:justify-start">
                        <span class=" text-sm font-medium text-gray-900">Mostrar</span>
                        <select wire:model="cant"
                            class="mx-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  ">
                            <option selected>10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>

                        </select>
                        <span>entradas</span>

                    </div>
                    <div class="relative mx-auto  mb-2 ">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <input wire:model="search" type="text" id="table-search-users"
                            class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Buscar">
                    </div>
                    <div class="text-center lg:text-end">
                        <button wire:click="$set('modal' ,true)" type="button"
                            class=" px-6 py-2.5 bg-green-600 text-white font-bold text-sm  uppercase rounded  hover:bg-green-700 hover:shadow-lg   ">
                            APERTURAR NUEVA CAJA
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
   
                    @if (count($boxes))
                            <table class="{{-- min-w-max   --}} w-full table-auto">
                                    <thead>
                                        <tr class="bg-[#0e1726] text-white uppercase text-sm leading-normal">
                                            <th class="py-3 px-6 text-center">ID</th>
                                            <th class="py-3 px-6 text-center">Apertura</th>
                                            <th class="py-3 px-6 text-center">Cierre</th>
                                            <th class="py-3 px-6 text-left">Usuario</th>
                                            <th class="py-3 px-6 text-center">S. Inicial</th>
                                            <th class="py-3 px-6 text-center">S. Final</th>
                                            <th class="py-3 px-6 text-center">Estado</th>
                                            <th class="py-3 px-6 text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" text-sm font-light">
                                        @foreach ($boxes as $item)   
                                            <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                                                <td class="py-3 px-6 text-center">
                                                    <h1 class="font-medium"> {{ $item->id}}</h1>
                                                </td>
                                                <td class="py-3 px-6 text-center ">                                     
                                                    <h1 class="font-medium">{{$item->opening->format('d/m/Y h:i A') }}</h1> 
                                                </td>
                                                <td class="py-3 px-6 text-center">
                                                    <h1 class="font-medium">{{$item->closing ? $item->closing->format('d/m/Y h:i A') : '-' }}</h1>
                                                </td>
                                                <td class="py-3 px-6 text-left">
                                                    <h1 class="font-medium">{{$item->user->name}}</h1>
                                                </td>
                                                <td class="py-3 px-6 text-center">
                                                    <h1 class="font-medium">{{$item->initial}}</h1>
                                                </td>
                                                <td class="py-3 px-6 text-center">
                                                    <h1 class="font-medium">{{$item->final}}</h1>
                                                </td>
                                             
             

                                                <td class="py-3 px-6 text-center">
                                                    @if ($item->status == 1)
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium  px-2.5 py-0.5 rounded  border border-green-400">ABIERTO</span>
                                                     @endif
                                                   
                                                    @if ( $item->status == 2)
                                                        <span class="bg-red-100 text-red-800 text-xs font-medium  px-2.5 py-0.5 rounded  border-red-400">CERRADO</span>

                                                    @endif
                                                   
                                                   

                                                </td>

                                                <td class="py-3 px-6 text-center">
                                                    <div class="flex item-center justify-center">
                                                        <a href="{{route('box.show',$item->id)}}" class="w-4 mr-2 transform hover:text-blue-500 hover:scale-125 cursor-pointer">
                                               
                                                                <svg xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"   stroke-width="2" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                                                  </svg>
                                                        
                                                        </a>
                                                        @if ($item->status == 1)
                                                        <div wire:click="edit({{$item}})" class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-125 cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                            </svg>
                                                        </div>
                                        
                                                       

                             
                                                        <div  wire:click="close({{$item}})" class="w-4 mr-2 transform hover:text-red-500 hover:scale-125 cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                              </svg>
                                                              
                                                        </div>
                                                        @endif

                                                        @if($item->motions->count()<1)
                                                        <div wire:click="$emit('deleteBox',{{$item->id}})" class="w-4 mr-2 transform hover:text-red-500 hover:scale-125 cursor-pointer">
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
                @if ($boxes->hasPages())
                <div class="p-6">
                    {{$boxes->links()}}
            
                </div>
                @endif 

                 
            </div>
              
        
              
        </div>
    </div>


    <x-modal-form :head='$componentName' :id='$selected_id'>
        @include('livewire.box.box-form')
    </x-modal-form>
 @push('js')


    <script>
        Livewire.on('deleteBox',boxId=>{
          Swal.fire({
                  title: '¿Estas seguro?',
                  text: "¡No podras revertir esta accion!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Eliminar',
                  padding: '2em'
                  }).then(function(result) {
                  if (result.value) {
                      Livewire.emitTo('box.box-index','delete',boxId);
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
