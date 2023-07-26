<div class="grid grid-cols-12  gap-4">
    
    <div class="col-span-9 bg-white shadow-md ">
        
        <div class="flex px-5 pt-5">
            <p class="text-xl font-mono font-black "> TICKET DE VENTA #T001-{{str_pad($sale->id, 7, "0", STR_PAD_LEFT)}}</p>
            @if ($sale->status==1)
            <p class="text-md font-bold  ml-auto">ESTADO:  <span class="bg-blue-100 text-blue-800 text-md font-medium  px-2.5 py-0.5 rounded  border border-blue-400">REGISTRADO</span> </p>
           
  
        
            @endif
            @if ($sale->status==2)
            <p class="text-md font-bold  ml-auto">ESTADO:  <span class="bg-red-100 text-red-800 text-md font-medium  px-2.5 py-0.5 rounded  border border-red-400">ANULADO</span> </p>

                
            @endif
          
        
        
        </div>
        <div class="grid grid-cols-3 pl-4 pr-4 pt-4">
            <div class="col-span-2 pt-3  ">
                <div>
                    <P class="text-md font-medium text-gray-700">Paciente:</P>
                    <p class="font-bold">{{ $sale->patient->name}}</p>
                   
                </div>
                <div class=pt-3>
                    <P class="text-md font-medium text-gray-700">Documento:</P>
                    <p class="font-bold">{{ $sale->patient->number}}</p>
                   
                </div>
                <div class=pt-3>
                    <P class="text-md font-medium text-gray-700">Fecha de Emision:</P> 
                    <p class="font-bold">{{$sale->created_at->format('Y-m-d')}}</p>
                   
                </div>
                <div class="pt-3">
                    <label class="block text-md font-medium text-gray-700  ">Observaciones:</label>
                    <input type="text" wire:model.defer="observation"
                    class="mt-1 block w-11/12  border-gray-300  shadow-sm focus:border-transparent focus:ring-indigo-500 sm:text-sm"
                    >
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
                                value="@php
                           
                                $d=Cart::instance('saleedit')->total(2)*10;
                                $c=floor($d)/10;
                                $t=Cart::instance('saleedit')->total(2)-$c;
                                $x=Cart::instance('saleedit')->total(2)-$t;
                                echo number_format($x,2);
                       

                            @endphp"
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
                             <input  type="number"  wire:model.defer="discount" placeholder="0.00"
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


         
                </div>

            </div>
        </div>

        <div class="overflow-x-auto pt-4">

                    <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-[#0e1726] text-white uppercase text-sm leading-normal">
                                 
                                    <th class="py-3 px-6 text-center">P. INIC</th>
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
                                @foreach (Cart::instance('saleedit')->content() as $item)   
                                    <tr class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100">
                                   
                                        <td class="py-3 px-6 text-center">
                                                           
                                            <h1 class="font-medium">{{$item->price }}</h1>
                                        </td>
                                        <td class="py-3 px-6 text-left ">
                                            <h1 class="font-medium"> 
                                                <span class=" uppercase font-bold mr-1 ">{{$item->name}}</span>
                                              
                                            </h1>
                                                <h1 class="font-medium  ">{{-- {{$item->options->description}} --}} {{ Str::limit($item->options->description, 20)}}</h1>
                                          
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                                           
                                            <h1 class="font-medium">{{$item->qty }}</h1>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                                           
                                            <h1 class="font-medium">{{(($item->tax*$item->qty)+$item->subtotal)/$item->qty  }}</h1>
                                        </td>

                                        <td class="py-3 px-6 text-center">
                                           
                                            <h1 class="font-medium">{{($item->tax*$item->qty)+$item->subtotal }}</h1>
                                        </td>
                                      {{--   <td class="py-3 px-6 text-left ">
                               
                                                <h1 class="font-medium">{{$item->name}}</h1>
                                          
                                        </td>

                                        <td class="py-3 px-6 text-center">
                                            <h1 class="font-medium"> {{ (($item->tax*$item->qty)+$item->subtotal)/$item->qty  }}</h1>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                           
                                            <h1 class="font-medium">{{$item->qty }}</h1>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                           
                                            <h1 class="font-medium">{{round($item->tax,2 )}}</h1>
                                        </td>
                                      
                                        <td class="py-3 px-6 text-center">
                                           
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
                                        </td> --}}

                            {{--             <td class="py-3 px-6 text-center">
                                           
                                            <h1 class="font-medium">{{ round((($item->tax*$item->qty)),2) }}</h1>
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

        <div class="  grid grid-cols-2 pb-5">

       
            <div class="col-start-2  font-black font-mono mt-5 ml-32 mr-16">
                                
                <div class="flex justify-between   ">
                    <h1>TOTAL INICIAL</h1>
                    <h1>{{Cart::instance('saleedit')->initial(2)}}</h1> 
              {{--   <h1>{{ number_format(Cart::subtotal(2)/1.18,2) }}</h1>  --}}
            
                </div>

                <div class="flex justify-between">
                    <h1>DESCUENTOS{{--  ({{round($aux,2) }} %) --}} </h1>
                    <h1>-{{/* Cart::discount(2) */ number_format($aux,2)}}</h1>
                </div>

                
                <div class="flex justify-between border-t-2  border-black py-1">
                    <h1>SUBTOTAL</h1>
     
                    <h1>{{Cart::instance('saleedit')->total(2)}}</h1> 
   
                </div>
                <div class="flex justify-between  ">
                    <h1>O. GRAVADA</h1>
                    <h1>{{Cart::instance('saleedit')->subtotal(2)}}</h1> 
              {{--   <h1>{{ number_format(Cart::subtotal(2)/1.18,2) }}</h1>  --}}
            
                </div>
                <div class="flex justify-between ">
                    <h1>IGV 18%</h1>
                    {{Cart::instance('saleedit')->tax(2)}}
                 {{--    <h1>{{ number_format(Cart::subtotal(2)-(Cart::subtotal(2)/1.18),2)}}</h1> --}}
                </div>
              
                <div class="flex justify-between">
                    <h1>REDONDEO A FAVOR</h1> 
         
                    @php
       
                 $d=Cart::instance('saleedit')->total()*10;  

                    $d=round($d,1,PHP_ROUND_HALF_UP ); 
                    $c=floor($d)/10;
                    $t=Cart::instance('saleedit')->total()-$c; 

                    echo '-'.number_format(round($t,2),2); 
           

                @endphp 
   
                </div>

             
             
    
                <div class="flex justify-between border-t-2  border-black py-1">
                    <h1>TOTAL A PAGAR</h1>
                    {{Cart::instance('saleedit')->total(2)}}
                  {{--   @php
                   
                        $d=Cart::instance('saleedit')->total()*10;
                        $c=floor($d)/10;
                        $t=Cart::instance('saleedit')->total()-$c;
                        $x=Cart::instance('saleedit')->total()-$t;
                        echo number_format($x,2);
               

                    @endphp  --}}
            {{--    <h1>{{ /* number_format( */round(Cart::subtotal(2),1,PHP_ROUND_HALF_ODD),2/* ) */ }}</h1>  --}}
                 
           
         
                </div>
    
            </div>
        </div>
        
        
    </div>

    <div class="bg-white shadow-md col-span-3">

        <form wire:submit.prevent="saveStatus">

            <div class="p-5 flex">
              <x-jet-label class="mt-2">
                  <input type="radio" name="status" value="1" wire.model="status">
                  ANULAR
              </x-jet-label>
             <x-jet-button class="ml-auto">
                 Guardar
             </x-jet-button>
            </div>
         
            </form>

            <div>
                <a href="{{route('proof.generate',$sale->id)}}" class="block py-2 mx-5 text-base text-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 ">
                   GENERAR BOLETA DE VENTA
                </a>
             
            </div>

            <div class="pt-3">
                <a href="#" class="block py-2 mx-5 text-base text-center text-black bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-100 ">
                  VER TICKET
                </a>
             
            </div>

            <div class="pt-3">
                <a  onclick="save()" class="block py-2 mx-5 text-base text-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 ">
                  GUARDAR CAMBIOS
                </a>
             
            </div>

            <div class="px-5 py-4 text-red-500">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

     
        
    </div>


    @push('js')


    <script>
       function save(){
        Swal.fire({
                title: '¿Estas segur@?',
                text: "¡No podras revertir esta accion!",
          /*       type: 'warning', */
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Guardar Cambios',
                padding: '2em'
                }).then(function(result) {
                if (result.value) {
                    Livewire.emitTo('sale.sale-edit','saveEdit');
                 /*    Swal.fire(
                    'EDITADO!',
                    'El registro fue editado correctamente',
                    'success'
                    ) */
                }
                })
            }
            
            
    </script>
    @endpush
</div>
