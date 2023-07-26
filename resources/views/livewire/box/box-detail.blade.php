<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Movimientos de Caja
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class=" container mx-auto px-4 {{-- sm:px-6 lg:px-8 --}}">
            <div class="bg-white shadow-lg ">
               <div class="flex items-center justify-between p-5">
                 <h1 class="flex-1 text-lg">Administrar Caja</h1>

                   <div class="space-x-2">
                    @can('box-exist')
                        <button wire:click="$set('modal' ,true)" type="button"  class=" px-6 py-2.5 bg-green-600 text-white font-bold text-sm  uppercase rounded  hover:bg-green-700 hover:shadow-lg   ">
                            Aperturar Caja
                        </button>
                    @endcan
                    
                    
                        @can('box-asing')
                        
                            <a href="{{route('generate.ticket.box',$box->id)}}" target="_blank"  class=" px-6 py-2.5 bg-cyan-600 text-white font-bold text-sm  uppercase rounded  hover:bg-cyan-700 hover:shadow-lg   ">
                                Imprimir
                             <a>
                                
                            <button wire:click="$set('modal3' ,true)" type="button"  class=" px-6 py-2.5 bg-yellow-600 text-white font-bold text-sm  uppercase rounded  hover:bg-yellow-700 hover:shadow-lg   ">
                                    Registrar Gasto
                            <button>

                                <button   wire:click="$set('modal2' ,true)" type="button"  class=" px-6 py-2.5 bg-red-600 text-white font-bold text-sm  uppercase rounded  hover:bg-red-700 hover:shadow-lg   ">
                                    Cerrar Caja
                                 <button>
                        @endcan
                    
                    
                    
                       
                   </div>

               </div>
               <hr>
               @can('box-asing')
               <div class="grid grid-cols-2" >
                <div class="py-5 px-10 ">
                    <div class="border border-b-0 pl-8 pr-3 py-1 border-gray-400  ">
                        <p class="inline-block"> MONTO INICIAL </p> <span class="float-right">{{$box->initial}}</span>
                    </div>
                    <div class="border border-b-0 pl-8 pr-3 py-1 border-gray-400 ">
                        <p  class="inline-block">INGRESOS</p> <span class="float-right">{{number_format($box->motions()->where('type',1)->sum('amount'),2)}}</span>
                    </div>
                    <div class="border border-b-0 pl-8 pr-3 py-1 border-x-2 border-gray-400  ">
                        <p  class="inline-block">GASTOS</p> <span class="float-right">{{number_format($box->motions()->where('type',2)->sum('amount'),2)}}</span>
                    </div>
                    <div class="border border-b-0  pl-8 pr-3 py-1  border-gray-400 "> 
                        <p  class="inline-block text-2xl text-green-600 font-extrabold">INGRESOS TOTALES</p> <span class="float-right text-2xl text-green-600 font-extrabold">{{number_format($box->motions()->where('type',1)->sum('amount'),2)}}</span>
                    </div>
                    <div class="border border-b-0 pl-8 pr-3 py-1  border-gray-400 ">
                        <p  class="inline-block text-2xl text-red-600 font-extrabold">EGRESOS TOTALES</p> <span class="float-right text-2xl text-red-600 font-extrabold">{{number_format($box->motions()->where('type',1)->sum('amount'),2)}}</span>
                    </div>
                    <div class="border border-b-0 pl-8 pr-3 py-1  border-gray-400 ">
                        <p  class="inline-block text-2xl  font-extrabold">SALDO</p> <span class="float-right text-2xl  font-extrabold">{{number_format((($box->motions()->where('type',1)->sum('amount'))-($box->motions()->where('type',2)->sum('amount'))),2)}}</span>
                    </div>
                    <div class="border pl-8 pr-3 py-1  border-gray-400 ">
                        <p  class="inline-block text-2xl text-cyan-600 font-extrabold">MONTO INICIAL + SALDO</p> <span class="float-right text-2xl text-cyan-600 font-extrabold">{{ number_format($box->initial+(($box->motions()->where('type',1)->sum('amount'))-($box->motions()->where('type',2)->sum('amount'))),2)}}</span>
                    </div>
                </div>
                <div  x-data="{activeTab: 1}">
                    

         
          <div class="w-full">
            <div class="p-1 pt-4">
 
              <!-- tabs -->
              <div class="relative">
                <header class="flex items-end border-b border-black ">
                  <button
                    class="px-3 py-1 z-50 "
                    :class="activeTab===1 ? 'font-semibold border-x border-t border-black  ' : ''"
                    @click="activeTab=1"
                  >
                  
                    Ingresos
                    <span class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-white bg-green-600 ">
                         {{$box->motions()->where('type',1)->count()}}
                    </span>
                  </button>
                  <button
                    class="  px-3 py-1 "
                    :class="activeTab===2 ? 'font-semibold border-x border-t border-black ' : ''"
                    @click="activeTab=2"
                  >
                    Gastos
                    <span class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-white bg-yellow-600 ">
                        {{$box->motions()->where('type',2)->count()}}
                      </span>
                  </button>
             
                </header>
                <div
                  class=" p-2 l"
                  id="tabs-contents"
                >
                  <div x-show="activeTab===1">
                    <table class="{{-- min-w-max   --}} w-full table-auto">
                        <thead>
                            <tr class=" uppercase text-sm border-b  leading-normal">
                                <th class="py-3 px-6 text-left">Descripcion</th>
                                <th class="py-3 px-6 text-center">Monto</th>
                            
                            </tr>
                        </thead>
                        <tbody class=" text-sm font-light">
                            @foreach ($box->motions()->where('type',1)->get() as $item)   
                                <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                                  
                                    <td class="py-3 px-6 text-left ">                                     
                                        <h1 class="font-medium">{{$item->description}}  #{{$item->sale_id}}</h1> 
                                    </td>
                                    <td class="py-3 px-6 text-center ">                                     
                                        <h1 class="font-medium">{{$item->amount}}</h1> 
                                    </td>
                                   
                                  
                                 
 

                                    

                                </tr>
                            @endforeach
                  
                         
                        </tbody>
                </table>
                   
                  </div>
                  <div x-show="activeTab===2">
                    <table class="{{-- min-w-max   --}} w-full table-auto">
                        <thead>
                            <tr class=" uppercase text-sm border-y-2 leading-normal">
                                <th class="py-3 px-6 text-left">Descripcion</th>
                                <th class="py-3 px-6 text-center">Monto</th>
                            
                            </tr>
                        </thead>
                        <tbody class=" text-sm font-light">
                            @foreach ($box->motions()->where('type',2)->get() as $item)   
                                <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                                  
                                    <td class="py-3 px-6 text-left ">                                     
                                        <h1 class="font-medium">{{$item->description}}  #{{$item->sale_id}}</h1> 
                                    </td>
                                    <td class="py-3 px-6 text-center ">                                     
                                        <h1 class="font-medium">{{$item->amount}}</h1> 
                                    </td>
                                   
                                  
                                 
 

                                    

                                </tr>
                            @endforeach
                  
                         
                    </tbody>
                </table>
                  </div>
           
                </div>
              </div>
            </div>
          </div>
   

                </div>
               {{--  <div class="relative">
                    <div class='flex items-center justify-center '>
                        <ul class="mx-auto grid max-w-full w-full grid-cols-3 gap-x-5 px-8">
                          <li class="">
                            <input class="peer sr-only" type="radio" value="yes" name="answer" id="yes" checked />
                            <label class="flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-indigo-500 transition-all duration-500 ease-in-out" for="yes">Details</label>
                        
                                <div class=" absolute bg-white shadow-lg left-0 p-6 border mt-2 border-indigo-300 rounded-lg W-full mx-auto transition-all duration-500 ease-in-out translate-x-40 opacity-0 invisible peer-checked:opacity-100 peer-checked:visible peer-checked:translate-x-1">
                              Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatum! Sequi consequatur error nulla quaerat rem fugit provident tempore nihil a aspernatur ad laboriosam, dolor nisi qui? Esse, mollitia? Nostrum?
                            </div>
                          </li>
                        
                          <li class="">
                            <input class="peer sr-only" type="radio" value="no" name="answer" id="no" />
                            <label class="flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-indigo-500 transition-all duration-500 ease-in-out" for="no">About</label>
                        
                                <div class="absolute bg-white shadow-lg left-0 p-6 border mt-2 border-indigo-300 rounded-lg w-full mx-auto transition-all duration-500 ease-in-out translate-x-40 opacity-0 invisible peer-checked:opacity-100 peer-checked:visible peer-checked:translate-x-1">
                              Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatum! Sequi consequatur error nulla quaerat rem fugit provident tempore nihil a aspernatur ad laboriosam, dolor nisi qui? Esse, mollitia? Nostrum?
                              Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatum! Sequi consequatur error nulla quaerat rem fugit provident tempore nihil a aspernatur ad laboriosam, dolor nisi qui? Esse, mollitia? Nostrum?
                            </div>
                          </li>
                        
                          <li class="">
                            <input class="peer sr-only" type="radio" value="yesno" name="answer" id="yesno" />
                            <label class="flex justify-center cursor-pointer rounded-full border border-gray-300 bg-white py-2 px-4 hover:bg-gray-50 focus:outline-none peer-checked:border-transparent peer-checked:ring-2 peer-checked:ring-indigo-500 transition-all duration-500 ease-in-out " for="yesno">Something</label>
                        
                                <div class="absolute bg-white shadow-lg left-0 p-6 border mt-2 border-indigo-300 rounded-lg w-full mx-auto transition-all duration-500 ease-in-out translate-x-40 opacity-0 invisible peer-checked:opacity-100 peer-checked:visible peer-checked:translate-x-1">
                              Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatum! Sequi consequatur error nulla quaerat rem fugit provident tempore nihil a aspernatur ad laboriosam, dolor nisi qui? Esse, mollitia? Nostrum?
                              Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatum! Sequi consequatur error nulla quaerat rem fugit provident tempore nihil a aspernatur ad laboriosam, dolor nisi qui? Esse, mollitia? Nostrum?
                              Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatum! Sequi consequatur error nulla quaerat rem fugit provident tempore nihil a aspernatur ad laboriosam, dolor nisi qui? Esse, mollitia? Nostrum?
                              Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatum! Sequi consequatur error nulla quaerat rem fugit provident tempore nihil a aspernatur ad laboriosam, dolor nisi qui? Esse, mollitia? Nostrum?
                            </div>
                          </li>
                        </ul>
                        
                        </div>
                </div> --}}

              </div>
               @endcan
               
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="modal" >
        <x-slot:title >
           Aperturar Caja
        </x-slot:title>
        <x-slot:content>
            <label  class="block text font-medium text-gray-700">Monto Incial</label>
            <input wire:model.defer="amount" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              @error('amount')
              <h1 class="text-red-500">{{$message}}</h1>
              @enderror

              <label  class="block pt-4 text font-medium text-gray-700">Observaciones:</label>
              <input wire:model.defer="observation" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('observation')
                <h1 class="text-red-500">{{$message}}</h1>
                @enderror            
        </x-slot:content>
        <x-slot:footer>

    
        <x-jet-secondary-button wire:click="$set('modal' ,false)"  wire:loading.attr="disabled">
            {{ __('Cancelar') }}
         </x-jet-secondary-button>
            <x-jet-button wire:click="open" class="ml-2" >
                APERTURAR
            </x-jet-button>
         
        
        </x-slot:footer>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="modal3" >
        <x-slot:title >
           Registrar Nuevo Gasto de Efectivo de Caja
        </x-slot:title>
        <x-slot:content>
       

            <label  class="block text font-medium text-gray-700">Monto </label>
            <input wire:model.defer="amount_spent" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
              @error('amount_spent')
              <h1 class="text-red-500">{{$message}}</h1>
              @enderror

              <label  class="block pt-4 text font-medium text-gray-700">Descripcion de Movimiendo:</label>
              <input wire:model.defer="description_spent" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('description_spent')
                <h1 class="text-red-500">{{$message}}</h1>
                @enderror
   
       
             
        </x-slot:content>
        <x-slot:footer>

    
        <x-jet-secondary-button wire:click="$set('modal3' ,false)"  wire:loading.attr="disabled">
            {{ __('Cancelar') }}
         </x-jet-secondary-button>
            <x-jet-button wire:click="spent" class="ml-2" >
                GUARDAR
            </x-jet-button>
         
        
        </x-slot:footer>
    </x-jet-dialog-modal>

    <x-jet-confirmation-modal wire:model="modal2" class="">
        <x-slot name="title">
           {{ __('Cerra Caja') }}
        </x-slot>
     
        <x-slot name="content">
           {{ __('¿Estas seguro de CERRAR caja?') }}
        </x-slot>
     
        <x-slot name="footer">
           <x-jet-secondary-button wire:click="$set('modal2' ,false)"  wire:loading.attr="disabled">
              {{ __('Cancelar') }}
           </x-jet-secondary-button>
     
           <x-jet-danger-button class="ml-2 " wire:click="close" wire:loading.attr="disabled">

              {{ __('Cerrar') }}
             

           </x-jet-danger-button>
        </x-slot>
     </x-jet-confirmation-modal>
</div>
