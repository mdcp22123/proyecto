<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PRUEBA') }}
        </h2>
    </x-slot>

    
    <div class="py-12">
        <div class=" container mx-auto  {{-- sm:px-6 lg:px-8 --}}">
        
            <div class="grid grid-cols-12  gap-4">
                    <div class="col-span-9 bg-white shadow-md ">

                            <div class="flex px-5 pt-5">
                                    <p class="text-xl font-mono font-black ">TICKET DE VENTA #T001-000001</p>
                                
                                    <p class="text-md font-bold  ml-auto">ESTADO:  <span class="bg-blue-100 text-blue-800 text-md font-medium  px-2.5 py-0.5 rounded  border border-blue-400">REGISTRADO</span> </p>
                                
                                
                            </div>

                            <div class="grid grid-cols-3 pl-4 pr-4 pt-4">
                                <div class="col-span-2 pt-3  ">
                                    <div>
                                        <P class="text-md font-medium text-gray-700">Paciente:</P>
                                        <p class="font-bold">MARLON DOUGLAS CALLA PEREZ</p>
                                       
                                    </div>
                                    <div class=pt-3>
                                        <P class="text-md font-medium text-gray-700">Documento:</P>
                                        <p class="font-bold">71548243</p>
                                       
                                    </div>
                                    <div class=pt-3>
                                        <P class="text-md font-medium text-gray-700">Fecha de Emision:</P> 
                                        <p class="font-bold">22/12/2001</p>
                                       
                                    </div>
                                    <div class="pt-3">
                                        <label class="block text-md font-medium text-gray-700  ">Observaciones:</label>
                                        <input type="text"
                                        class="mt-1 block w-11/12  border-gray-300  shadow-sm focus:border-transparent focus:ring-indigo-500 sm:text-sm"
                                        value="  " >
                                    </div>


                                    
                                </div>
                                <div class="pt-5">
                                    <div class="grid grid-cols-2">

                                        <div class="pr-1">
                                            <label class="block text-sm font-medium text-gray-700">A Pagar </label>
                                            <div class="relative block">
                                                <span class="absolute inset-y-0 left-0 flex border-gray-300 items-center px-1 border ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                
                                                </span>
                                                <input  
                                                    class="mt-1 py-2 pl-12  block w-full bg-gray-200   border border-gray-300  shadow-sm  sm:text-sm cursor-not-allowed"
                                                    value="255.00"
                                                    disabled>
                                
                                            </div>
                                
                                        </div>
                                        <div class="pl-1">
                                            <label class="block text-sm font-medium text-gray-700  ">Metodo de pago </label>
                                            <input type="text"
                                            class="mt-1 block w-full  bg-gray-200 border border-gray-300  shadow-sm focus:border-transparent focus:ring-indigo-500 sm:text-sm cursor-not-allowed"
                                            value=" EFECTVO " disabled>
                                
                                        </div>

                                        <div class="pr-1 pt-3">
                                            <label class="block text-sm font-medium text-gray-700  ">Efectivo Recibido </label>
                                            <div class="relative block">
                                                <span class="absolute inset-y-0 left-0 flex items-center px-1 border border-gray-300   ">
                                                    +
                                
                                                </span>
                                                <input type="number" {{--  value="{{$sale->cash}}"  --}} wire:model="cash"
                                                    class=" py-2 pl-7 pr-5 mt-1 block w-full   border border-gray-300  shadow-sm focus:border-transparent focus:ring-indigo-500 sm:text-sm"  placeholder="0.00"           >
                                                <span class="absolute inset-y-0 right-0 flex items-center px-1 border border-gray-300 ">
                                                    -
                                
                                                </span>
                                            </div>
                                
                                        </div>

                                        <div class="pl-1 pt-3">
                                            <label class="block text-sm font-medium text-gray-700">Cambio </label>
                                            <div class="relative block">
                                                <span class="absolute inset-y-0 left-0 flex items-center border-gray-300 px-1 border ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                                    </svg>
                                
                                
                                                </span>
                                                <input type="number" wire:model.defer="change" placeholder="0.00" {{-- value="{{$sale->change}}" --}}
                                                    class="mt-1 py-2 pl-12  block w-full cursor-not-allowed  bg-gray-200 border border-gray-300  shadow-sm   sm:text-sm"
                                                    disabled {{-- value="{{ number_format($change, 2) }}" --}}  
                                                    >
                                
                                            </div>
                                
                                        </div>

                                        <div class="pt-3 col-span-2 flex ">
                                           <div class="w-full">
                                             <label class="block text-sm font-medium text-gray-700">Descuento:</label>
                                             <div class="relative block">
                                                 <span class="absolute inset-y-0 left-0 flex items-center border-gray-300 px-1 border ">
                                                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                         <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                       </svg>
                                                       
                                            
                                            
                                                 </span> 
                                                 <input  type="number" id="cash" wire:model.defer="discount" placeholder="0.00"
                                                     class="  py-2 pl-12 mt-1 block w-full   border border-gray-300  shadow-sm focus:border-transparent focus:ring-indigo-500 sm:text-sm ">
                                                   
                                            
                                             </div>
                                           </div>
                                           <div class="pt-5">
                                            <button wire:click="discount(1)"
                                            class="p-2 mt-1 ml-2 text-sm font-medium text-white bg-yellow-700  border border-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                            Aplicar
                                                </button>
                                           </div>
                                
                                
                                        </div>


                             
                                    </div>

                                </div>
                            </div>

                            <div class="overflow-x-auto pt-4">
   
             
                                        <table class="min-w-max w-full table-auto">
                                                <thead>
                                                    <tr class="bg-[#0e1726] text-white uppercase text-sm leading-normal">
                 
                                                        <th class="py-3 px-6 text-left">Paciente</th>
            
                                                        <th class="py-3 px-6 text-left">Ticket</th>
                                                        <th class="py-3 px-6 text-center">Estado</th>
                                                        <th class="py-3 px-6 text-center">Total</th>
                                                        <th class="py-3 px-6 text-left">Observaciones</th>
                                                        <th class="py-3 px-6 text-left">Fecha</th>
                                                        <th class="py-3 px-6 text-center">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody class=" text-sm font-light">
                                             
                                                        <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                                                         
                                                            <td class="py-3 px-6 text-left ">
                                                   
                                                                    <h1 class="font-medium">hola</h1>
                                                              
                                                            </td>
            
                                                            
                                                        </tr>
                                                 
                                          
                                                 
                                            </tbody>
                                        </table>
                       
                            </div>
                    </div>
                    
                    <div class=" bg-white shadow-md col-span-3">
                        <form action="">

                               <div class="p-5 flex">
                                 <x-jet-label class="mt-2">
                                     <input type="radio" name="status" value="1">
                                     ANULAR
                                 </x-jet-label>
                                <x-jet-button class="ml-auto">
                                    Guardar
                                </x-jet-button>
                               </div>
                            
                        </form>

                        <div>
                            <a href="#" class="block py-2 mx-5 text-base text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 ">
                               GENERAR BOLETA DE VENTA
                            </a>
                         
                        </div>

                        <div class="pt-3">
                            <a href="#" class="block py-2 mx-5 text-base text-center text-black bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-100 ">
                              VER TICKET
                            </a>
                         
                        </div>

                        <div class="pt-3">
                            <a href="#" class="block py-2 mx-5 text-base text-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 ">
                              GUARDAR CAMBIOS
                            </a>
                         
                        </div>
                    </div>
              

              </div>
        </div>
    </div>
</x-app-layout>