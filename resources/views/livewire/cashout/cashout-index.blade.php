<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Arqueos de Caja
        </h2>
    </x-slot>


        <div class="py-12">
            <div class=" container mx-auto px-4 {{-- sm:px-6 lg:px-8 --}}">
                <div class="bg-white shadow-lg p-4 ">
                    <div class="grid grid-cols-4 gap-x-8 ">
                        <div class="">
            
                            <label class="block text-sm font-medium text-gray-700">Servicio: </label>
        
                                  <select  wire:model.lazy="user"class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                      <option value="" selected>Seleccione...</option>
                                      @foreach ($users as $item)
                                        <option value="{{$item->id}}">{{$item->name}} </option>
                                    
                                        @endforeach
                                                                  
                                  </select>               
                     
        
                            @error('user')
                                <h1 class="text-red-500">{{$message}}</h1>
                            @enderror
                        </div>
                        <div class="">
                            <label  for="inicio" class="block text-sm font-medium text-gray-700">Fecha inicial</label>
                            <input wire:model.lazy="start" type="date" id="inicio"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                              @error('start')
                              <h1 class="text-red-500">{{$message}}</h1>
                              @enderror
                          </div>
                          <div class="">
                            <label  for="final" class="block text-sm font-medium text-gray-700">Fecha final</label>
                            <input wire:model.lazy="final" type="date" id="final"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                              @error('final')
                              <h1 class="text-red-500">{{$message}}</h1>
                              @enderror
                          </div>

                          <div class=" flex items-center justify-around   ">
                            @if ($user>0 && $start !=null && $final!=null)
                            <button class="px-3 py-2 {{-- text-xs font-medium  --}}text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 "  wire:click.prevent="query" >Consultar</button>
                            @endif
                            @if ($total>0)
                            <button class="px-3 py-2 {{-- text-xs font-medium --}} text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300  " wire:click.prevent="imprimir">Imprimir</button>
                            @endif
                        
                        </div>
                    </div>
                    <div class="mt-8 grid grid-cols-3 gap-x-8">
                       <div>
                         <div class="border rounded-md  bg-[#0e1726] text-white p-3" >
                            <div class="grid grid-cols-2">
                                <p>VENTAS TOTALES:  </p> 
                                <p >{{number_format($total,2)}}</p>
                      
                                <p>IMPUESTOS TOTALES:  </p>
                                <p>{{number_format($tax,2)}}</p>
                             {{--    <hr> --}}
                                <p>TOTAL NETO:  </p>
                                <p>{{number_format($net,2)}} </p>
                            </div>
                           
                              
                        
                  
                         </div>

                         <div class="border rounded-md  bg-[#0e1726] text-white p-3 mt-2" >
                            <div class="grid grid-cols-2">
                                <p>VENTAS CONCRETADAS:  </p> 
                                <p >{{$salemade}}</p>
                      
                                <p>VENTAS ANULADAS:  </p>
                                <p>{{$salecanceled}}</p>

                
                          
                            </div>
                           
                              
                        
                  
                         </div>
                         
                       </div>
                        
                        <div class="col-span-2">
                            <div class="overflow-x-auto">
   
                                @if (count($sales))
                                        <table class="min-w-max w-full table-auto">
                                                <thead>
                                                    <tr class="bg-[#0e1726] text-white uppercase text-sm leading-normal">
                                                        <th class="py-3 px-6 text-center">Numero</th>
                                                        <th class="py-3 px-6 text-center">Total</th>
                                                   {{--      <th class="py-3 px-6 text-left">Descuento</th> --}}
                                                        <th class="py-3 px-6 text-center">Estado</th>
                                                        <th class="py-3 px-6 text-center">Tipo</th>
                                                        <th class="py-3 px-6 text-center">Fecha</th>
                                                        <th class="py-3 px-6 text-center">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody class=" text-sm font-light">
                                                    @foreach ($sales as $item)   
                                                        <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                                                           
                                                            <td class="py-3 px-6 text-center ">
                                                   
                                                                    <h1 class="font-medium">#00{{$item->id}}</h1>
                                                              
                                                            </td>
                                                            <td class="py-3 px-6 text-center ">
                                                   
                                                                <h1 class="font-medium">{{number_format($item->total,2)}}</h1>
                                                          
                                                            </td>

                                                          
                                                            @if($item->status==1)
                                                            <td class="py-3 px-6 text-center">
                                                                <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Registrado</span>
                                                            </td>
                                                            @endif
                                                            @if($item->status==2)
                                                            <td class="py-3 px-6 text-center">
                                                                <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">Anulado</span>
                                                            </td>
                                                            @endif
                                                            @if($item->status==3)
                                                            <td class="py-3 px-6 text-center">
                                                                <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">Facturado</span>
                                                            </td>
                                                            @endif
                                                            @if($item->type==1)
                                                            <td class="py-3 px-6 text-center">
                                                                <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Libre</span>
                                                            </td>
                                                            @else
                                                            <td class="py-3 px-6 text-center">
                                                                <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">Tecero</span>
                                                            </td>
                                                            @endif

                                                            <td class="py-3 px-6 text-center ">
                                                   
                                                                <h1 class="font-medium">{{$item->created_at}}</h1>
                                                          
                                                            </td>
            
            
                                                            
                                                            
                                                            <td class="py-3 px-6 text-center">
                                                                <div class="flex item-center justify-center">
                                                                    
                                                                    <div wire:click="detail({{$item}})" class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-125 cursor-pointer">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                        </svg>
                                                                    </div>
                                                                   
                                                                </div> 
                                                             
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                          
                                                 
                                            </tbody>
                                        </table>
                                @else
                                        <h6 class="text-center my-5">Ningun registro encontrado</h6>
                                @endif
                            </div>
                           
                            <div class="overflow-x-auto">
   
                                @if (count($salescanceled))
                                <p class="text-center bg-red-600 text-white">VENTAS CANCELADAS</p>
                                        <table class="min-w-max w-full table-auto">
                                                <thead>
                                                    <tr class="bg-[#0e1726] text-white uppercase text-sm leading-normal">
                                                        <th class="py-3 px-6 text-center">Numero</th>
                                                        <th class="py-3 px-6 text-center">Total</th>
                                                   {{--      <th class="py-3 px-6 text-left">Descuento</th> --}}
                                                        <th class="py-3 px-6 text-center">Estado</th>
                                                        <th class="py-3 px-6 text-center">Tipo</th>
                                                        <th class="py-3 px-6 text-center">Fecha</th>
                                                        <th class="py-3 px-6 text-center">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody class=" text-sm font-light">
                                                    @foreach ($salescanceled as $item)   
                                                        <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                                                           
                                                            <td class="py-3 px-6 text-center ">
                                                   
                                                                    <h1 class="font-medium">#00{{$item->id}}</h1>
                                                              
                                                            </td>
                                                            <td class="py-3 px-6 text-center ">
                                                   
                                                                <h1 class="font-medium">{{number_format($item->total,2)}}</h1>
                                                          
                                                            </td>

                                                          
                                                            @if($item->status==1)
                                                            <td class="py-3 px-6 text-center">
                                                                <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Registrado</span>
                                                            </td>
                                                            @endif
                                                            @if($item->status==2)
                                                            <td class="py-3 px-6 text-center">
                                                                <span class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs">Anulado</span>
                                                            </td>
                                                            @endif
                                                            @if($item->status==3)
                                                            <td class="py-3 px-6 text-center">
                                                                <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">Facturado</span>
                                                            </td>
                                                            @endif
                                                            @if($item->type==1)
                                                            <td class="py-3 px-6 text-center">
                                                                <span class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs">Libre</span>
                                                            </td>
                                                            @else
                                                            <td class="py-3 px-6 text-center">
                                                                <span class="bg-yellow-200 text-yellow-600 py-1 px-3 rounded-full text-xs">Tecero</span>
                                                            </td>
                                                            @endif

                                                            <td class="py-3 px-6 text-center ">
                                                   
                                                                <h1 class="font-medium">{{$item->created_at}}</h1>
                                                          
                                                            </td>
            
            
                                                            
                                                            
                                                      
                                                            <td class="py-3 px-6 text-center">
                                                                <div class="flex item-center justify-center">
                                                                    
                                                                    <div wire:click="detail({{$item}})" class="w-4 mr-2 transform hover:text-yellow-500 hover:scale-125 cursor-pointer">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                        </svg>
                                                                    </div>
                                                                   
                                                                </div> 
                                                             
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                          
                                                 
                                            </tbody>
                                        </table>
                                @else
                                        <h6 class="text-center my-5">Ningun registro encontrado</h6>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

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
</div>
