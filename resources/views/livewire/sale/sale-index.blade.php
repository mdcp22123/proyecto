<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $componentName }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" container mx-auto px-4 {{-- sm:px-6 lg:px-8 --}}">
            <div class="bg-white shadow-lg ">
                <div class="grid grid-cols-1 lg:grid-cols-3 p-4">
                    <div class="flex items-center justify-center pb-2 lg:mb-0 lg:justify-start">
                        <span  class=" text-sm font-medium text-gray-900">Mostrar</span>
                        <select wire:model="cant" class="mx-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  ">
                          <option selected>10</option>
                          <option value="25">25</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                     
                        </select>
                        <span>entradas</span>
                        
                    </div>
                    <div class="relative mx-auto  mb-2 ">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input wire:model="search" type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar">
                    </div>
                    <div class="text-center lg:text-end">
                        <a href="{{route('create')}}" type="button"  class=" px-6 py-2.5 bg-green-600 text-white font-bold text-sm  uppercase rounded  hover:bg-green-700 hover:shadow-lg   ">
                            Nueva Venta
                          </a>
                    </div>
                </div>
                 <div class="overflow-x-auto">
   
                    @if (count($sales))
                            <table class="min-w-max w-full table-auto">
                                    <thead>
                                        <tr class="bg-[#0e1726] text-white uppercase text-sm leading-normal">
                                            
                                            <th class="py-3 px-6 text-center">ID</th>
                                            <th class="py-3 px-6 text-left">Paciente</th>

                                            <th class="py-3 px-6 text-left">Ticket</th>
                                            <th class="py-3 px-6 text-center">Total</th>
          
                                            <th class="py-3 px-6 text-center">Estado</th>
                                            <th class="py-3 px-6 text-center">Tipo</th>
                          
                                            
                                           
                                            <th class="py-3 px-6 text-left">Fecha</th>
                                            <th class="py-3 px-6 text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class=" text-sm font-light">
                                        @foreach ($sales as $item)   
                                            <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                                             
                                                <td class="py-3 px-6 text-center">
                                                    <h1 class="font-medium"> {{$item->id}}</h1>
                                                </td>
                                                <td class="py-3 px-6 text-left ">
                                       
                                                        <h1 class="font-medium">{{$item->patient->name.' '.$item->patient->surname }}</h1>
                                                  
                                                </td>

                                                <td class="py-3 px-6 text-left">

                                                        <h1 class="font-medium">  T001-{{str_pad($item->id, 7, "0", STR_PAD_LEFT)}} </h1>
                                                      {{--   <h1 class="font-medium"> 
                                                            <span class=" text-xs font-medium mr-1 ">{{ $item->type_proof($item->proof->voucher)}}</span>
                                                          
                                                        </h1> --}}
                                                 
                                                </td>



                                                
                                      
                                           {{--      <td class="py-3 px-6 text-left">
                                                    <h1 class="font-medium">{{$item->user->name }}</h1>
                                                </td> --}}
                                                <td class="py-3 px-6 text-center">
                                                    <h1 class="font-medium"> {{ number_format(round($item->total,2),2)}}</h1>
                                                </td>

                                                
                                                <td class="py-3 px-6 text-center">
                                                    @if ($item->status == 1)
                                                        <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">REGISTRADO</span>
                                                   
                                                    @endif
                                                    
                                                    @if( $item->status == 2)
                                                        <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">ANULADO</span>
                                                    @endif
                                                    @if ( $item->status == 3)
                                                    <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">FACTURADO</span>

                                                    @endif
                                                   {{--  @if ($item->status == 1 && $item->proof )
                                                        regusrrad
                                                    @endif --}}
                                                </td>

                                                <td class="py-3 px-6 text-center">
                                                    @if ($item->type == 1)
                                                        <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">LIBRE</span>
                                             
                                                    @endif
                                                    
                                                    @if( $item->type == 2)
                                                        <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">TERCERO</span>
                                                    @endif
                                                  
                                                   {{--  @if ($item->status == 1 && $item->proof )
                                                        regusrrad
                                                    @endif --}}
                                                </td>
                                           
                                             
                                              <td class="py-3 px-6 text-left ">                                     
                                                    <h1 class="font-medium">{{$item->created_at->format('d/m/Y') }}</h1> 
                                                </td>
                                                <td class="py-3 px-6 text-center">
                                                    <div class="flex item-center justify-center">
                                                        <div wire:click="details({{$item->id}})"  class="w-4 mr-2 transform hover:text-blue-500 hover:scale-125 cursor-pointer">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                            </svg>
                                                              
                                                              
                                                        </div>

                                                        @if ($item->status == 1 && !$item->proof)
                                                            <div  class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-125 cursor-pointer">
                                                                <a href="{{route('sale.edit',$item->id)}}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                            <div  class="w-4 mr-2 transform hover:text-blue-500 hover:scale-125 cursor-pointer">
                                                                <a href="{{route('proof.generate',$item->id)}}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                                                  </svg>
                                                                </a>
                                                                  
                                                                  
                                                            </div>
                                                        @endif
                                                        
                                                           @if($item->details->count()<1 && $item->proof->count()<1)
                                                            <div wire:click="$emit('deletePatient',{{$item->id}})" class="w-4 mr-2 transform hover:text-red-500 hover:scale-125 cursor-pointer">
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
                    @if ($sales->hasPages())
                    <div class="p-6">
                        {{$sales->links()}}
                
                    </div>
                    @endif 
              
            </div>
        </div>
    </div>

  {{--   <x-modal-form :head='$componentName' :id='$selected_id'>
        @include('livewire.patient.patient-form')
    </x-modal-form> --}}
    @if ($detail)
    <x-jet-dialog-modal wire:model="modal" >
        <x-slot:title >
           <div class="flex">
            <div class="flex-1">
              <p class="font-black"> Detalle de venta  ID: {{$detail->id}}</p>
              <p class="font-bold">Ticket: T001-{{str_pad($detail->id, 7, "0", STR_PAD_LEFT)}} </p> 
            </div>
           <div>
            @if ($detail->status==1)
            <p class="text-md font-bold  ml-auto">ESTADO:  <span class="bg-blue-100 text-blue-800 text-md font-medium  px-2.5 py-0.5 rounded  border border-blue-400">REGISTRADO</span> </p>
               
           @endif
            @if ($detail->status==2)
            <p class="text-md font-bold  ml-auto">ESTADO:  <span class="bg-red-100 text-red-800 text-md font-medium  px-2.5 py-0.5 rounded  border border-red-400">ANULADO</span> </p>

   
            @endif
            @if ($detail->status==3)
            <p class="text-md font-bold  ml-auto">ESTADO:  <span class="bg-green-100 text-green-800 text-md font-medium  px-2.5 py-0.5 rounded  border border-green-400">FACTURADO</span> </p>
            @endif
            @if ($detail->type==1)
            <p class="text-sm font-bold  ml-auto mt-2">TIPO:  <span class="bg-green-100 text-green-800 text-md font-medium  px-2.5 py-0.5 rounded  border border-green-400">LIBRE</span> </p>
            @endif
            @if ($detail->type==2)
            <p class="text-sm font-bold  ml-auto mt-2">TIPO:  <span class="bg-yellow-100 text-yellow-800 text-md font-medium  px-2.5 py-0.5 rounded  border border-yellow-400">TERCERO</span> </p>
            @endif
           </div>
           </div>
            
             
           
        </x-slot:title>
        <x-slot:content>
           <div class="flex">
            <div class="flex-1" >
              <div>
                 
                  <P class="text-md font-medium text-gray-700">Paciente:</P>
                  <p class="font-bold">{{ $detail->patient->name}}{{ $detail->patient->surname}}</p>
                 
              </div>
              <div class=pt-3>
                  <P class="text-md font-medium text-gray-700">Documento:</P>
                  <p class="font-bold">{{ $detail->patient->number}}</p>
                 
              </div>
            </div >
            <div  >
                <div class=pt-3>
                    <P class="text-md font-medium text-gray-700">Efectivo Recibido: <span class="font-bold">{{ $detail->cash}}</span></P>
                </div>
                <div class=pt-3>
                    <P class="text-md font-medium text-gray-700">Cambio (vuelto): <span class="font-bold">{{ $detail->change}}</span></P>
                </div>

                <div class=pt-3>
                    <P class="text-md font-medium text-gray-700">Descuento: <span class="font-bold">{{ $detail->discount}}</span></P>
                </div>
                
                
            </div >
           </div>
           <div class=pt-3>
            <P class="text-md font-medium text-gray-700">Observaciones: <span class="font-bold">{{ $detail->observation}}</span></P>
        </div>
      
      
            <div class="overflow-x-auto">

                <table class="w-full text-sm text-left text-gray-900 ">
                    <thead class="text-xs text-white uppercase bg-[#0e1726] ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Inicial
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cantidad 
                            </th>  
                            <th scope="col" class="px-6 py-3">
                                Total
                            </th>      
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detail->details as $item)
                            <tr class=" border-b  hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    {{$item->name}}
                                </td>
                                <td class="px-6 py-4">
                                    {{number_format(round($item->price,2),2)}}
                                </td>
                                <td class="px-6 py-4">
                                    {{number_format(round($item->price_u,2),2)}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$item->quantity }}
                                </td>
                                <td class="px-6 py-4">
                                    {{$item->price_u * $item->quantity}}
                                </td>
                

                            </tr>
                        @endforeach
                    
        
        
                    </tbody>
                </table>
                <div class="  grid grid-cols-2">
                    <div class=" font-black font-mono mt-5  mr-3">
                     
      
                        <div class="flex justify-between ">
   
                            <h1>TOTAL INICIAL</h1>
                            <h1>{{number_format(round($detail->subtotal,2),2)}}</h1> 
                      {{--   <h1>{{ number_format(Cart::subtotal(2)/1.18,2) }}</h1>  --}}
                    
                        </div>
                        <div class="flex justify-between ">
   
                            <h1>DESCUENTO</h1>
                            <h1>-{{number_format(round($detail->discount,2),2)}}</h1> 
                      {{--   <h1>{{ number_format(Cart::subtotal(2)/1.18,2) }}</h1>  --}}
                    
                        </div>
                       {{-- <div class="flex justify-between ">
                            <h1>DESCUENTO</h1>
                            <h1>{{$detail->discount}}</h1> 
          
                    
                        </div> --}}

                


                  
            
                        <div class="flex justify-between border-t-2  border-black py-1">
   
                                <h1></h1>
                                <h1>{{number_format(round($detail->total,2),2)}}</h1> 
                          {{--   <h1>{{ number_format(Cart::subtotal(2)/1.18,2) }}</h1>  --}}
                        
                            </div>
                 
        
            
                    </div>

                    <div class=" font-black font-mono mt-5 ml-16 mr-3">
                     
      
                        <div class="flex justify-between ">
                            <h1>O. GRAVADA</h1>
                            <h1>{{number_format(round($detail->net,2),2)}}</h1> 
                      {{--   <h1>{{ number_format(Cart::subtotal(2)/1.18,2) }}</h1>  --}}
                    
                        </div>
                        <div class="flex justify-between ">
                            <h1>IGV 18%</h1>
                            <h1>{{number_format(round($detail->tax,2),2)}}</h1> 
                      {{--   <h1>{{ number_format(Cart::subtotal(2)/1.18,2) }}</h1>  --}}
                    
                        </div>
                       {{-- <div class="flex justify-between ">
                            <h1>DESCUENTO</h1>
                            <h1>{{$detail->discount}}</h1> 
          
                    
                        </div> --}}

                


                  
            
                        <div class="flex justify-between border-t-2  border-black py-1">
   
                                <h1>TOTAL NETO</h1>
                                <h1>{{number_format(round($detail->total,2),2)}}</h1> 
                          {{--   <h1>{{ number_format(Cart::subtotal(2)/1.18,2) }}</h1>  --}}
                        
                            </div>
                 
        
            
                    </div>
                </div>
        
            </div>
        </x-slot:content>
        <x-slot:footer>
        
            <x-jet-secondary-button wire:click="$set('modal',false)"  wire:loading.attr="disabled">
                Cancelar
            </x-jet-secondary-button>
    
        
        </x-slot:footer>
       </x-jet-dialog-modal>
    @endif


    @push('js')


<script>
    Livewire.on('deletePatient',patientId=>{
      Swal.fire({
              title: '¿Estas segurobg?',
              text: "¡No podras revertir esta accion!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Eliminar',
              padding: '2em'
              }).then(function(result) {
              if (result.value) {
                  Livewire.emitTo('sale.sale-index','delete',patientId);
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
