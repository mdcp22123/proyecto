<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nueva Venta
        </h2>
    </x-slot>
    <div class="py-12">
        <div class=" container mx-auto px-4 {{-- sm:px-6 lg:px-8 --}}">
            <div class="bg-white shadow-lg  ">
               <div class="grid grid-cols-3 ">
                    <div class="p-3 col-span-2">
                        <div class="bg-cyan-700 rounded shadow-md py-1 px-2 uppercase text-white font-bold">
                             Items y costos 
                        </div>
                        <div class="my-3 flex justify-end">
                           <button wire:click="$set('modal' ,true)" type="button"  class="  px-6 py-2.5 bg-purple-800 text-white font-bold text-sm  uppercase rounded  hover:bg-purple-700 hover:shadow-lg   ">
                            Agregar Item
                          </button> 
                        </div>

                        <div class="overflow-x-auto">

                                    <table class="min-w-max w-full table-auto">
                                            <thead>
                                                <tr class="bg-[#0e1726] text-white uppercase text-sm leading-normal">
                                                    <th class="py-3 px-6 text-center" style="width: 5px" >*</th>
                                                    <th class="py-3 px-6 text-center">P. INIC</th>
                                                    <th class="py-3 px-6 text-left">Descripcion</th>
                                                  {{--   <th class="py-3 px-6 text-center">Precio</th> --}}
                                              {{--       <th class="py-3 px-6 text-center">Cantidad</th>
                                                    <th class="py-3 px-6 text-center">IGV</th>
                                                    <th class="py-3 px-6 text-center">GRAVADA</th>
                                                    <th class="py-3 px-6 text-center">DESCUENTO</th>
                                                    <th class="py-3 px-6 text-center">Total</th> --}}
                {{--                                     <th class="py-3 px-6 text-center">O.G. UNIT</th> --}}
                                                     <th class="py-3 px-6 text-center ">QTY</th>
                                                    <th class="py-3 px-6 text-center">P. UNIT</th>
                                                    <th class="py-3 px-6 text-center">TOTAL</th>
                               {{--                      <th class="py-3 px-6 text-center">IGV TOTAL</th>
                                                    <th class="py-3 px-6 text-center">IMPORTE TOTAL</th> --}}


                                                </tr>
                                            </thead>
                                            <tbody class=" text-sm font-light">
                                                @foreach (Cart::instance('salecreate')->content() as $item)   
                                                    <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                                                        <td   class="py-3 px-6 text-center">
                                                            <button wire:click="deleteItem('{{$item->rowId}}')" wire:loading.attr='disabled' class="p-1 text-base font-normal  text-black hover:bg-red-500 hover:text-white  rounded-lg  cursor-pointer ">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                            </button>
                            
                                                        </td>

                                                        <td class="py-3 px-6 text-center">
                                                           
                                                            <h1 class="font-medium">{{number_format(round($item->price,2),2) }}</h1>
                                                        </td>
                                                        <td class="py-3 px-6 text-left ">
                                                            <h1 class="font-medium"> 
                                                                <span class=" uppercase font-bold mr-1 ">{{$item->name}}</span>
                                                              
                                                            </h1>
                                                                <h1 class="font-medium  ">{{-- {{$item->options->description}} --}} {{ Str::limit($item->options->description, 20)}}</h1>
                                                          
                                                        </td>

                                                        {{-- <td class="py-3 px-6 text-center">
                                                            <h1 class="font-medium"> {{ (($item->tax*$item->qty)+$item->subtotal)/$item->qty  }}</h1>
                                                        </td> --}}
                                                        <td class="py-3 px-6 text-center">
                                                            
                                                           <button class="bg-[#0e1726] text-white text-lg font-bold mr-2 px-2"  wire:click="decrementqty('{{$item->rowId}}')">
                                                             - 
                                                            </button> 
                                                            <span class="font-medium">{{$item->qty }}</span>  
                                                            <button class="bg-[#0e1726] text-white text-lg font-bold ml-2 px-2" wire:click="incrementqty('{{$item->rowId}}')"> 
                                                                + 
                                                            </button>
                                                        </td> 
                                                     {{--    <td class="py-3 px-6 text-center">
                                                           
                                                            <h1 class="font-medium">{{round($item->tax,2 )}}</h1>
                                                        </td> --}}

                                                        <td class="py-3 px-6 text-center">
                                                           
                                                            <h1 class="font-medium">{{   number_format(round((($item->tax*$item->qty)+$item->subtotal)/$item->qty,2),2)  }}</h1>
                                                        </td>

                                                        <td class="py-3 px-6 text-center">
                                                           
                                                            <h1 class="font-medium">{{ number_format(round(($item->tax*$item->qty)+$item->subtotal,2),2) }}</h1>
                                                        </td>
                                                      
                                                        {{-- <td class="py-3 px-6 text-center">
                                                           
                                                            <h1 class="font-medium">{{ round(((($item->tax*$item->qty)+$item->subtotal)/$item->qty)-$item->tax,2)  }}</h1>
                                                        </td>
                                                        <td class="py-3 px-6 text-center">
                                                           
                                                            <h1 class="font-medium">{{round($item->discount,2) }}</h1>
                                                        </td>
                                                        <td class="py-3 px-6 text-center">
                                                            <h1 class="font-medium"> {{ round($item->qty * $item->price)}}</h1>
                                                        </td>
                                                        <td class="py-3 px-6 text-center">
                                                           
                                                            <h1 class="font-medium">{{round($item->subtotal,2 )}} - {{$item->subtotal}}</h1>
                                                        </td>

                                                        <td class="py-3 px-6 text-center">
                                                           
                                                            <h1 class="font-medium">{{ round((($item->tax*$item->qty)/* +$item->subtotal */)/* -$item->subtotal */,2) }}</h1>
                                                        </td>

                                                        <td class="py-3 px-6 text-center">
                                                           
                                                            <h1 class="font-medium">{{($item->tax*$item->qty)+$item->subtotal }}</h1>
                                                        </td> --}}
                                                     {{--    <td class="py-3 px-6 text-center">
                                                           
                                                            <h1 class="font-medium">{{round($item->price-($item->qty * ($item->subtotal + $item->tax))) }}</h1>
                                                        </td> --}}
                                                   
                                        
                                                    </tr>
                                                @endforeach
                                      
                                             
                                        </tbody>
                                    </table>
                        </div>

                        <div class="  grid grid-cols-2">
                            <div class="  font-black font-mono mt-5 ml-16 mr-3">
                                
                               
                               
                                
                                <div class="flex justify-between   border-black py-1">
                                    <h1>SUBTOTAL</h1>
                     
                                    <h1>{{Cart::instance('salecreate')->total(2)}}</h1> 
                   
                                </div>
                                <div class="flex justify-between  ">
                                    <h1>O. GRAVADA</h1>
                                    <h1>{{Cart::instance('salecreate')->subtotal(2)}}</h1> 
                              {{--   <h1>{{ number_format(Cart::subtotal(2)/1.18,2) }}</h1>  --}}
                            
                                </div>
                                <div class="flex justify-between ">
                                    <h1>IGV</h1>
                                    {{Cart::instance('salecreate')->tax(2)}}
                                 {{--    <h1>{{ number_format(Cart::subtotal(2)-(Cart::subtotal(2)/1.18),2)}}</h1> --}}
                                </div>
                              
                               {{--  <div class="flex justify-between">
                                    <h1>REDONDEO A FAVOR</h1> 
                         
                                    @php
                       
                                 $d=Cart::instance('salecreate')->total()*10;  
  
                                    $d=round($d,1,PHP_ROUND_HALF_UP ); 
                                    $c=floor($d)/10;
                                    $t=Cart::instance('salecreate')->total()-$c; 

                                    echo '-'.number_format(round($t,2),2); 
                           

                                @endphp 
                   
                                </div> --}}

                             
                             
                    
                                <div class="flex justify-between border-t-2  border-black py-1">
                                    <h1>TOTAL FONDOS</h1>
                                    {{Cart::instance('salecreate')->total(2)}}
                                    {{-- @php
                                   
                                        $d=Cart::instance('salecreate')->total()*10;
                                        $c=floor($d)/10;
                                        $t=Cart::instance('salecreate')->total()-$c;
                                        $x=Cart::instance('salecreate')->total()-$t;
                                        echo number_format($x,2);
                               

                                    @endphp  --}}
                            {{--    <h1>{{ /* number_format( */round(Cart::subtotal(2),1,PHP_ROUND_HALF_ODD),2/* ) */ }}</h1>  --}}
                                 
                           
                         
                                </div>
                    
                            </div>

                            <div class="  font-black font-mono mt-5 ml-16 mr-3">
                                
                                <div class="flex justify-between   ">
                                    <h1>TOTAL INICIAL</h1>
                                    <h1>{{Cart::instance('salecreate')->initial(2)}}</h1> 
                              {{--   <h1>{{ number_format(Cart::subtotal(2)/1.18,2) }}</h1>  --}}
                            
                                </div>

                                <div class="flex justify-between">
                                    <h1>DESCUENTOS{{--  ({{round($aux,2) }} %) --}} </h1>
                                    <h1>-{{/* Cart::discount(2) */ number_format($aux,2)}}</h1>
                                </div>

                                
                                <div class="flex justify-between border-t-2  border-black py-1">
                                    <h1></h1>
                     
                                    <h1>{{Cart::instance('salecreate')->total(2)}}</h1> 
                   
                                </div>


                                <div class="flex justify-between border-t-2  border-black py-1">
                                    <h1>A PAGAR</h1>
                     
                                    <h1>{{Cart::instance('salecreate')->initial(2)}}</h1> 
                   
                                </div>
                               
                              
                               {{--  <div class="flex justify-between">
                                    <h1>REDONDEO A FAVOR</h1> 
                         
                                    @php
                       
                                 $d=Cart::instance('salecreate')->total()*10;  
  
                                    $d=round($d,1,PHP_ROUND_HALF_UP ); 
                                    $c=floor($d)/10;
                                    $t=Cart::instance('salecreate')->total()-$c; 

                                    echo '-'.number_format(round($t,2),2); 
                           

                                @endphp 
                   
                                </div> --}}

                             
                             
                    
                              
                    
                            </div>


                            
                        </div>
                        
                        
                    </div>
                    
                    <div class="p-3">

                        <div class="bg-cyan-700 rounded shadow-md py-1 px-2 uppercase text-white font-bold">
                            COBRO Y REGISTRO
                        </div>

                        <label class="block text-sm font-medium text-gray-700  pt-4 ">PACIENTE:</label>
                        <div class=" pb-3 flex ">
                    
                            @if ($patient)
                                {{--  <div class="flex w-full"> --}}
                                <input type="text"
                                    class="mt-1 block w-full  bg-gray-200 border border-gray-300  shadow-sm focus:border-transparent focus:ring-indigo-500 sm:text-sm cursor-not-allowed"
                                    value=" {{ $patient->number }}-{{ $patient->name }} {{ $patient->surname }}" disabled>
                    
                                <span>
                                    <button wire:click="removePatient"
                                        class="p-2 mt-1 ml-2 text-sm font-medium text-white bg-red-700  border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9.75L14.25 12m0 0l2.25 2.25M14.25 12l2.25-2.25M14.25 12L12 14.25m-2.58 4.92l-6.375-6.375a1.125 1.125 0 010-1.59L9.42 4.83c.211-.211.498-.33.796-.33H19.5a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25h-9.284c-.298 0-.585-.119-.796-.33z" />
                                        </svg>
                    
                                    </button>
                                </span>
                                {{--   </div>  --}}
                            @else
                                @livewire('sale.component.patient-search', ['event' => 'setPatient'])
                                <livewire:sale.component.patient-add>
                            @endif
                    
                    
                    
                    
                        </div>

                        <div class="grid grid-cols-3 pt-3 ">
                            <div class="pr-4">
                                <label for="type" class="block text-sm font-medium text-gray-700">Cliente tipo:</label>
                                <x-jet-label>
                                    <input wire:model="type" type="radio" name="type" value="1" class="mr-2">
                                    Libre
                                </x-jet-label>
                                <x-jet-label>
                                    <input wire:model="type" type="radio" name="type" value="2" class="mr-2">
                                    Tecero
                                </x-jet-label>
                            </div>
                            <div class="pr-4">
                                <label for="names" class="block text-sm font-medium text-gray-700">Comprobante:</label>
                                <x-jet-label>
                                    <input wire:model="status" type="radio" name="status" value="1" class="mr-2">
                                    No
                                </x-jet-label>
                                <x-jet-label>
                                    <input wire:model="status" type="radio" name="status" value="2" class="mr-2">
                                    Si
                                </x-jet-label>
                              
                            </div>
                            <div class="pr-4">
                                <label for="names" class="block text-sm font-medium text-gray-700">Correlativo</label>
                                <input wire:model="serie_correlative" type="text" id="names"
                                    class="mt-1 block w-full  bg-gray-200 border border-gray-300  shadow-sm focus:border-transparent focus:ring-indigo-500 text-xs cursor-not-allowed"
                                    disabled>
                    
                            </div>
                            {{-- <div class="">
                                <label for="date" class="block text-sm font-medium text-gray-700">Fecha Emision</label>
                                <input type="date" id="date" value="{{today()->toDateString();}}" disabled
                                    class="mt-1 block w-full  bg-gray-200 border border-gray-300  shadow-sm focus:border-transparent focus:ring-indigo-500 sm:text-sm cursor-not-allowed">
                    
                            </div> --}}
                        </div>

                        {{-- <div class="px-5 pt-4 {{ $voucher != 2 ? 'hidden' : 'block' }}">
                            <label for="names" class="block text-sm font-medium text-gray-700">Nombre / Razon
                                Social</label> 
                            <div class="flex items-center">
                                <input type="text" id="simple-search"
                                    class="mt-1 block w-full     bg-gray-200 border  border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                    value="{{ $number }} - {{ $name }}" disabled>
                    
                                @if ($name)
                                    <button wire:click="removeCompany"
                                        class="p-2 mt-1 ml-2 text-sm font-medium text-white bg-red-700  border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9.75L14.25 12m0 0l2.25 2.25M14.25 12l2.25-2.25M14.25 12L12 14.25m-2.58 4.92l-6.375-6.375a1.125 1.125 0 010-1.59L9.42 4.83c.211-.211.498-.33.796-.33H19.5a2.25 2.25 0 012.25 2.25v10.5a2.25 2.25 0 01-2.25 2.25h-9.284c-.298 0-.585-.119-.796-.33z" />
                                        </svg>
                    
                    
                                    </button>
                                @else
                                    <livewire:sale.component.customer-search>
                                @endif
                    
                    
                    
                            </div>
                        </div> --}}

                        <div class="grid grid-cols-3 pt-8 ">
                            <div class="pr-4">
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
                                        value="{{Cart::instance('salecreate')->initial(2)}} {{-- @php
                                   
                                        $d=Cart::instance('salecreate')->total(2)*10;
                                        $c=floor($d)/10;
                                        $t=Cart::instance('salecreate')->total(2)-$c;
                                        $x=Cart::instance('salecreate')->total(2)-$t;
                                        echo number_format($x,2);
                               

                                    @endphp --}}"
                                        disabled>
                    
                                </div>
                    
                            </div>
                            <div class="pr-4">
                                <label class="block text-sm font-medium text-gray-700  ">Efectivo Recibido </label>
                                <div class="relative block">
                                    <span class="absolute inset-y-0 left-0 flex items-center px-1 border border-gray-300   ">
                                        +
                    
                                    </span>
                                    <input type="number"  wire:model.lazy="cash" 
                                        class=" py-2 pl-7 pr-5 mt-1 block w-full   border border-gray-300  shadow-sm focus:border-transparent focus:ring-indigo-500 sm:text-sm"  placeholder="0.00"           >
                                    <span class="absolute inset-y-0 right-0 flex items-center px-1 border border-gray-300 ">
                                        -
                    
                                    </span>
                                </div>
                    
                            </div>
                    
                            <div class="">
                                <label class="block text-sm font-medium text-gray-700">Cambio </label>
                                <div class="relative block">
                                    <span class="absolute inset-y-0 left-0 flex items-center border-gray-300 px-1 border ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                        </svg>
                    
                    
                                    </span>
                                    <input type="" wire:model.defer="change" placeholder="0.00"
                                        class="mt-1 py-2 pl-12  block w-full cursor-not-allowed  bg-gray-200 border border-gray-300  shadow-sm   sm:text-sm"
                                        disabled {{-- value="{{ number_format($change, 2) }}" --}}  
                                        >
                    
                                </div>
                    
                            </div>
                        </div>

                       
                            @if ($type==2)
                            <div class="grid grid-cols-6 pt-8  ">
                                {{--  <div class="pr-4 col-span-2">
                                     <label class="block text-sm font-medium text-gray-700">Metodo de Pago </label>
                                     <select 
                                         class="mt-1 block w-full  border border-gray-300  py-2 px-3 shadow-sm focus:border-transparent  focus:ring-indigo-500 sm:text-sm">
                                         <option>EFECTIVO</option>
                                         <option>YAPE</option>
                                         <option>TRASFERENCIA</option>
                                     </select>
                         
                                 </div> --}}
                            <div class="pr-4 col-span-3 ">
                                <label class="block text-sm font-medium text-gray-700">Descuento/Comicion:</label>
                                <div class="relative block">
                                    <span class="absolute inset-y-0 left-0 flex items-center border-gray-300 px-1 border ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                          </svg>                   
                                    </span> 
                                    <input  type="number" wire:model.defer="discount" placeholder="0.00"
                                        class="  py-2 pl-12 mt-1 block w-full   border border-gray-300  shadow-sm focus:border-transparent focus:ring-indigo-500 sm:text-sm ">
                                      
                    
                                </div>
                            </div>
                            <div class="pt-5">

                                @if ($discount>0)
                                        <button wire:click="discount(0)"
                                        class="p-2 mt-1 ml-2 text-sm font-medium text-white bg-red-700  border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                        Quitar
                                   @else 
                                    <button wire:click="discount(1)"
                                    class="p-2 mt-1 ml-2 text-sm font-medium text-white bg-yellow-700  border border-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                    Aplicar
                                        </button>
                                @endif
                             
                             </div>
                            
                             </div>
                            @endif
                         

                           
                    

                        <div class="px-5 py-4 text-red-500">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="grid grid-cols-3  ">
                            <div class="pr-4 col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Observacion </label>
                                <input wire:model.defer="observation"  type="text"  class="mt-1 block w-full   border  border-gray-300 shadow-sm focus:border-transparent focus:ring-indigo-500 sm:text-sm" >
                    
                            </div>
                            
                    
                            <div class=" pt-6 ">
                                <button wire:click="saveSale" class="  w-full px-3 py-2 text-sm font-medium text-center text-white bg-green-700  hover:bg-green-800 focus:ring-2   focus:ring-green-300">
                                    Cobrar
                                </button>
                               
                    
                            </div>

                          
                        </div>
                        
                    </div>
               </div>
            </div>
        </div>
    </div>

    {{-- modal items --}}
    <x-jet-dialog-modal wire:model="modal" >
        <x-slot:title >
            Agregar Servicio
        </x-slot:title>
        <x-slot:content>
            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
            
                    <label class="block text-sm font-medium text-gray-700">Servicio: </label>

                          <select  wire:model.defer="service"class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                              <option value="" selected>Seleccione...</option>
                              @foreach ($services as $item)
                                <option value="{{$item->id}}"  {{$item->checked==1 ? 'disabled': ''}}>{{$item->name}} || S/.{{$item->price}} </option>
                            
                                @endforeach
                                                          
                          </select>               
             

                    @error('service')
                        <h1 class="text-red-500">{{$message}}</h1>
                    @enderror
                </div>
    
                  <div class="col-span-1">
                    <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                    <input wire:model.defer="price" type="number" name="price" id="price"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="0.00">
                    @error('price')
                    <h1 class="text-red-500">{{$message}}</h1>
                    @enderror
                  </div>     
                  <div class="col-span-1">
                    <label for="cant" class="block text-sm font-medium text-gray-700">Cantidad</label>
                    <input  type="number" name="cant" id="cant"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="1" disabled >
                  </div>   
            </div>
        {{--     <div class="overflow-x-auto">

                <table class="w-full text-sm text-left text-gray-900 ">
                    <thead class="text-xs text-white uppercase bg-[#0e1726] ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Descripcion
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Stock 
                            </th>  
                            <th scope="col" class="px-6 py-3">
                                + 
                            </th>      
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $item)
                            <tr class=" border-b  hover:bg-gray-50">

                                <td class="px-6 py-4">
                                    {{$item->name}}
                                </td>
                                <td class="px-6 py-4">
                                    
                                    {{$item->description}}
                                </td>          
                                <td class="px-6 py-4 ">
                                    {{$item->price}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$item->stock}}
                                </td>
                                <td class="px-6 py-4">
                                    <input  type="checkbox" class="{{$item->checked==1 ? 'disabled: border-gray-300 text-gray-300 cursor-not-allowed ': ''}}" wire:change="serviceAdd($('#v'+{{$item->id}}).is(':checked'),'{{$item->id}}')"
                                            id="v{{$item->id}}" {{$item->checked==1 ? 'disabled checked': ''}}   wire:loading.attr="disabled" wire:target="serviceAdd" >
                          
                                        </td>

                            </tr>
                        @endforeach
                    
        
        
                    </tbody>
                </table>
             
        
            </div> --}}
        
        </x-slot:content>
        <x-slot:footer>
      
            <x-jet-secondary-button wire:click="closemodal" wire:loading.attr="disabled">
                Cancelar
            </x-jet-secondary-button>
         
            <x-jet-button wire:click="serviceAdd" class="ml-2" >
                Agregar
            </x-jet-button>
         
        
        </x-slot:footer>
    </x-jet-dialog-modal>


    
    {{-- modal facura --}}
    <x-jet-dialog-modal wire:model="modalpdf" >
        <x-slot:title >
           VISTA TICKET DE VENTA
        </x-slot:title>
        <x-slot:content>
           <div>
             <object  width="100%" height="400px" type="application/pdf" title="Assembly" data="{{route('generate.ticket.sale',$saleId)}}?#zoom=75&scrollbar=1&toolbar=1&navpanes=1">
                 <p>System Error - This PDF cannot be displayed, please contact IT.</p>
             </object> 
           </div>
         {{--   <div class="grid grid-cols-4 mt-2 gap-2">
                <div class="">
                    <a href="{{route('generate.ticket-sale',$saleId)}}" class="block w-full px-3 py-2 text-sm font-medium text-center text-white bg-green-700  hover:bg-green-800 focus:ring-2   focus:ring-green-300">
                        Descargar A4
                    </a>
                </div>
                <div class="">
                    <button  class="w-full px-3 py-2 text-sm font-medium text-center text-white bg-blue-700  hover:bg-blue-800 focus:ring-2   focus:ring-blue-300">
                        Descargar CDR
                    </button>
                </div>
                <div class="">
                    <button  class="w-full px-3 py-2 text-sm font-medium text-center text-white bg-yellow-700  hover:bg-yellow-800 focus:ring-2   focus:ring-yellow-300">
                        Descargar XML
                    </button>
                </div>
                <div class="">
                    <button wire:click="print" class="w-full px-3 py-2 text-sm font-medium text-center text-white bg-cyan-700  hover:bg-cyan-800 focus:ring-2   focus:ring-cyan-300">
                        ENVIAR
                    </button>
                </div>
           </div> --}}
        </x-slot:content>
        <x-slot:footer>

    
         
            <a href="{{route('create')}}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition" >
                Nueva venta 
            </a>
            <x-jet-button wire:click="$set('modalpdf' ,false)" class="ml-2" >
                Imprimir
            </x-jet-button>
         
        
        </x-slot:footer>
    </x-jet-dialog-modal>
    
</div>
