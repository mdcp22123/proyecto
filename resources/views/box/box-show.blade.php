<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span class="font-black">DETALLE DE CAJA</span> {{ $box->id }}
        </h2>
    </x-slot>

    
    <div class="py-12">
        <div class=" container mx-auto px-4 {{-- sm:px-6 lg:px-8 --}}">
            <div class="bg-white shadow-lg ">
               <div class="flex items-center justify-between p-5">
                 <h1 class="flex-1 text-lg">MOVIMIENTOS DE CAJA</h1>
               

                   <div class="space-x-2">
                        
                            <a href="{{route('generate.ticket.box-ult',$box->id)}}" target="_blank"  class=" px-6 py-2.5 bg-cyan-600 text-white font-bold text-sm  uppercase rounded  hover:bg-cyan-700 hover:shadow-lg   ">
                                Imprimir
                             <a>
    
                    
                    
                    
                       
                   </div>

               </div>
               <h1 class="px-4 text-lg">ESTADO: @if($box->status==1) <span class="text-lg text-green-500 font-bold"> ABIERTO</span> @else <span class="text-lg text-yellow-500 font-bold"> CERRADO</span> @endif </h1>
               <hr>
        
               <div class="grid grid-cols-2" >
                <div class="py-5 px-10 ">
                    <div class="border border-b-0 pl-8 pr-3 py-1 border-gray-400  ">
                        <p class="inline-block"> MONTO INICIAL </p> <span class="float-right">{{$box->initial}}</span>
                    </div>
                    <div class="border border-b-0 pl-8 pr-3 py-1 border-gray-400 ">
                        <p  class="inline-block">INGRESOS</p> <span class="float-right">{{$box->income}}</span>
                    </div>
                    <div class="border border-b-0 pl-8 pr-3 py-1 border-x-2 border-gray-400  ">
                        <p  class="inline-block">GASTOS</p> <span class="float-right">{{$box->expenses}}</span>
                    </div>
                    <div class="border border-b-0  pl-8 pr-3 py-1  border-gray-400 "> 
                        <p  class="inline-block text-2xl text-green-600 font-extrabold">INGRESOS TOTALES</p> <span class="float-right text-2xl text-green-600 font-extrabold">{{$box->income}}</span>
                    </div>
                    <div class="border border-b-0 pl-8 pr-3 py-1  border-gray-400 ">
                        <p  class="inline-block text-2xl text-red-600 font-extrabold">EGRESOS TOTALES</p> <span class="float-right text-2xl text-red-600 font-extrabold">{{$box->expenses}}</span>
                    </div>
                    <div class="border border-b-0 pl-8 pr-3 py-1  border-gray-400 ">
                        <p  class="inline-block text-2xl  font-extrabold">SALDO</p> <span class="float-right text-2xl  font-extrabold">{{$box->balance}}</span>
                    </div>
                    <div class="border pl-8 pr-3 py-1  border-gray-400 ">
                        <p  class="inline-block text-2xl text-cyan-600 font-extrabold">MONTO INICIAL + SALDO</p> <span class="float-right text-2xl text-cyan-600 font-extrabold">{{$box->final}}</span>
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
              
              </div>
           
               
            </div>
        </div>
    </div>
</x-app-layout>