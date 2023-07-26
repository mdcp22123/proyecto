
   <div class=" bg-white shadow-md ">
      <div class="flex  px-10">
         <div class="flex-1 p-5">
           <div class="flex">
             <div >
                <img src="{{asset('img/logo.webp')}}" class="h-32" alt="">
             </div>
             <div class="pl-9 pt-4" >
                <p class="text-xl font-extrabold" >CENTRO MEDICO SAN JOSE</p>
                <P class="text-base text-gray-500">CENTO DE SERVICIOS MEDICOS SAN JOSE E.I.R.L</P>
                <p class="text-sm text-gray-500">JR: Lima N° 123 Puno - Puno - Puno</p>
               <p class="text-sm text-gray-500">Telefono: 051- 51- 51</p>

             </div>
           </div>
         </div>
         <div class="p-5">
            <div class="text-center border-dashed border space-y-2 p-6 border-black">
               <p class=" font-extrabold"> R.U.C N° 20000000000</p>
               <p class="font-extrabold">BOLETA DE VENTA ELECTRONICA</p>
               <p>B001 - {{$correlative}}</p>
            </div>
         </div>
      </div>

      <div class="px-5">
         <div class="grid grid-cols-3">

            
               <div class=" col-span-2 mr-2 ">
                  <div class="w-full">
                     <label for="names" class="block text-sm font-medium text-gray-700">Cliente: </label> 
                        <input type="text" wire:model="customer"
                           class="mt-1 block w-full     bg-gray-200 border  border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           disabled>
                  </div>
               </div>
                  <div class=" col-span-1  ">
                  <div class="flex">
                     
                  
                     <div class="w-full ">
                        
                        <label for="names" class="block text-sm font-medium text-gray-700">Numero: </label> 
                           <input type="text"  wire:model="number"
                              class="mt-1 block w-full     bg-gray-200 border  border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                              disabled>
                     </div>
                     <x-jet-secondary-button class="mt-5 ml-2 rounded-none mx-0" wire:click="customerFrecuent">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                        </svg>
                        
                     </x-jet-secondary-button>
                     <livewire:sale.component.customer-search>
                  
                  </div> 
               </div>


               <div class=" col-span-2 pt-4 mr-2 ">
                  <div class="w-full ">
                     <label for="names" class="block text-sm font-medium text-gray-700">Direccion: </label> 
                        <input type="text" wire:model="address" placeholder="Ingrese la direccion del cliente"
                           class="mt-1 block w-full      border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           >
                  </div>
               </div>

                  <div class="col-span-1 pt-4 ">
                  
                  <div class="  ">
                     
                     <label for="names" class="block text-sm font-medium text-gray-700">Fecha: </label> 
                        <input type="text" id="simple-search"
                           class="mt-1 block w-full     bg-gray-200 border  border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           value="{{now()->format('d/m/Y')}}" disabled>
                  </div>

                  </div>
            
        
          </div>
      </div>

      <div class="overflow-x-auto pt-4">

         <table class="min-w-max w-full table-auto">
                 <thead>
                     <tr class="bg-[#0e1726] text-white uppercase text-sm leading-normal">
                      
                         <th class="py-3 px-6 text-center">Medida</th>
                          <th class="py-3 px-6 text-center">Codigo</th>
                          <th class="py-3 px-6 text-left">Descripcion</th>
                          <th class="py-3 px-6 text-center">QTY</th>
                          <th class="py-3 px-6 text-center">P. UNIT</th>
                         <th class="py-3 px-6 text-center">TOTAL</th>
                      {{--    <th class="py-3 px-6 text-left">Nombre</th>
                         <th class="py-3 px-6 text-center">Precio</th>
                         <th class="py-3 px-6 text-center">Cantidad</th>
                         <th class="py-3 px-6 text-center">IGV</th>
                         <th class="py-3 px-6 text-center">GRAVADA</th>
                         <th class="py-3 px-6 text-center">DESCUENTO</th>
                         <th class="py-3 px-6 text-center">Total</th>

                         <th class="py-3 px-6 text-center">GRAVADA TOTAL</th>
                         <th class="py-3 px-6 text-center">IGV TOTAL</th>
                         <th class="py-3 px-6 text-center">IMPORTE TOTAL</th> --}}


                     </tr>
                 </thead>
                 <tbody class=" text-sm font-light">
                     @foreach ($sale->details as $item)   
                         <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                        
                             <td class="py-3 px-6 text-center">
                                                
                                 <h1 class="font-medium">Unidad</h1>
                             </td>
                             <td class="py-3 px-6 text-center">
                                                
                              <h1 class="font-medium">{{$item->service_id}}</h1>
                          </td>
                             <td class="py-3 px-6 text-left ">
                                 <h1 class="font-medium"> 
                                     <span class=" uppercase font-bold mr-1 ">{{$item->name}}</span>
                                   
                                 </h1>
                                     <h1 class="font-medium  ">{{-- {{$item->options->description}} --}} {{ Str::limit($item->description, 20)}}</h1>
                               
                             </td>
                             <td class="py-3 px-6 text-center">
                                                
                                 <h1 class="font-medium">{{$item->quantity }}</h1>
                             </td>
                             <td class="py-3 px-6 text-center">
                                                
                                 <h1 class="font-medium">{{ number_format(round($item->price_u,2),2)  }}</h1>
                             </td>

                             <td class="py-3 px-6 text-center">
                                
                                 <h1 class="font-medium">{{ number_format(round($item->price_t,2),2) }}</h1>
                             </td>
                          
                         </tr>
                     @endforeach
           
                  
             </tbody>
         </table>


      </div>



         <div class="  grid grid-cols-2 pb-5 ">
         
               <div class="grid grid-cols-2 m-5 p-3 border-2 rounded-md gap-y-3">
                     <div>
                        <P class="text-base font-extrabold">Moneda: <span class="font-thin text-gray-600">PEN (SOLES)</span> </P>
                     </div>
                     <div>
                        <P class="text-base font-extrabold">IGV: <span class="font-thin text-gray-600">18%</span> </P>
                     </div>
         
                     <div class="">
                        <P class="text-base font-extrabold">Condicion de pago: <span class="font-thin text-gray-600">Contado</span> </P>
                     </div>
                     <div>
                        <P class="text-base font-extrabold">Metodo de pago: <span class="font-thin text-gray-600">Efectivo</span> </P>
                     </div>
                     <div class="px-5 py-4 text-red-500">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
               </div>
            <div class="font-black font-mono mt-5 ml-60 mr-16">
                              
            
         
               <div class="flex justify-between  ">
                  <h1>O. GRAVADA</h1>
                  <h1>{{number_format(round($sale->net,2),2)}}</h1> 
            
            
               </div>
               <div class="flex justify-between ">
                  <h1>IGV 18%</h1>
                  <h1>{{number_format(round($sale->tax,2),2)}}</h1> 
            
               </div>
         
         
            
         
               <div class="flex justify-between border-t-2  border-black py-1">
                  <h1>TOTAL A PAGAR</h1>
                  <h1>{{number_format(round($sale->total+$sale->rounding,2),2)}}</h1>
               </div>
         
            </div>
         
         </div>


      <div class="flex flex-row justify-end px-6 py-4  text-right ">
            <button wire:click="generate" class="  p-2 text-base  text-white bg-green-700 hover:bg-green-800 focus:ring-green-300 ">
               GENERAR BOLETA DE VENTA
               
            </button>
      </div>

      <x-jet-dialog-modal wire:model="modalresp" >
         <x-slot:title >
            ENVIADO A SUNAT
         </x-slot:title>
         <x-slot:content>
         @if($respuesta)
            <div class="flex p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert">
               <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>

               <div>
               <span class="font-medium">RESPUESTA SUNAT: </span>   {{$respuesta}}
               </div>
            </div>
         @endif
          
        
               @if ($observaciones)
               <div class="flex p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                  <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>

                  <div>
                    <span class="font-medium">OBSERVACIONES!</span> Tener en cuenta en las siguientes BOLTEAS
                    <ul class="mt-1.5 ml-4 list-disc list-inside">
                     @foreach ($observaciones as $item)
                     <li class="font-extrabold">{{$item}}</li> 
                     @endforeach 
                
                 </ul>
                  </div>


                </div>
     
               @endif
             
            
        
         
         </x-slot:content>
         <x-slot:footer>
 
     
          
             <a href="{{route('proof.show',$proof_id)}}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition" >
                 Ver detalles
             </a>
             <x-jet-button wire:click="$set('modalresp' ,false)" class="ml-2" >
                 Imprimir
             </x-jet-button>
          
         
         </x-slot:footer>
     </x-jet-dialog-modal>
      
      <x-jet-confirmation-modal wire:model="modal" class="">
         <x-slot name="title">
            {{ __('Enviar') }}
         </x-slot>
      
         <x-slot name="content">
            {{ __('¿Estas seguro de enviar a SUNAT este comprobante?') }}
         </x-slot>
      
         <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('modal' ,false)"  wire:target="sendSunat" {{-- wire:loading.class="hidden"  --}}wire:loading.attr="disabled">
               {{ __('Cancelar') }}
            </x-jet-secondary-button>
      
            <x-jet-danger-button class="ml-2 " wire:click="sendSunat" wire:loading.attr="disabled">

               <svg wire:loading wire:target="sendSunat" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
               {{ __('enviar a   SUNAT') }}
              

            </x-jet-danger-button>
         </x-slot>
      </x-jet-confirmation-modal>

   
 
   </div>

      
     

