<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            VISTA BOLETA ELECTRONICA : {{ $proof->serie }}-{{ $proof->correlative }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class=" container mx-auto px-4 {{-- sm:px-6 lg:px-8 --}}">

            <div class="overflow-hidden">
                <div class="grid grid-cols-12  gap-4">

                    <div class="col-span-9 bg-white shadow-md ">
                        <div class="flex  px-10">
                            <div class="flex-1 p-5">
                                <div class="flex">
                                    <div>
                                        <img src="{{ asset('img/logo.webp') }}" class="h-32" alt="">
                                    </div>
                                    <div class="pl-9 pt-4">
                                        <p class="text-xl font-extrabold">CENTRO MEDICO SAN JOSE</p>
                                        <P class="text-base text-gray-500">CENTO DE SERVICIOS MEDICOS SAN JOSE E.I.R.L
                                        </P>
                                        <p class="text-sm text-gray-500">JR: Lima N° 123 Puno - Puno - Puno</p>
                                        <p class="text-sm text-gray-500">Telefono: 051- 51- 51</p>

                                    </div>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="text-center border-dashed border space-y-2 p-6 border-black">
                                    <p class=" font-extrabold"> R.U.C N° 20000000000</p>
                                    <p class="font-extrabold">BOLETA DE VENTA ELECTRONICA</p>
                                    <p>B001 - {{ $proof->correlative }}</p>
                                </div>
                            </div>
                        </div>

                        <div class=" px-14">
                            <div class="flex flex-wrap justify-between mb-8">
                                <div class="w-full md:w-1/3 mb-2 md:mb-0">
                                    <label
                                        class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Cliente:</label>
                                    <input
                                        class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                                        value="{{ $proof->name }}" disabled>
                                    <label
                                        class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Documento:</label>
                                    <input
                                        class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                                        value="{{ $proof->number }}" disabled>
                                    <label
                                        class="text-gray-800 block mb-1 font-bold text-sm uppercase tracking-wide">Direccion:</label>
                                    <input
                                        class="mb-1 bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                                        value="{{ $proof->address }}" disabled>
                                </div>
                                <div class="w-full md:w-1/3">
                                    <div class="mb-2 md:mb-1 md:flex items-center">
                                        <label
                                            class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">FECHA</label>
                                        <span class="mr-4 inline-block hidden md:block">:</span>
                                        <div class="flex-1">
                                            <input
                                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                                                disabled value="{{ $proof->created_at->format('d/m/Y') }}">
                                        </div>
                                    </div>
                                    <div class="mb-2 mt-2 md:mb-1 ">
                                        <label
                                        class=" text-gray-800 block font-bold text-sm uppercase tracking-wide">RESPUESTA SUNAT:</label>
                                        <div class="flex p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800" role="alert">
                                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                            <div>
                                              <span class="font-medium">{{$proof->response}}</span>
                                            </div>
                                          </div>
                                          @if($proof->observation)
                                        <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                                            <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>

                                  
                                            <div>
                                              <span class="font-medium">Observaciones:</span>
                                                <ul class="mt-1.5 ml-4 list-disc list-inside">
                                                  <li>{{$proof->observation}}</li>
                                                  
                                              </ul>
                                            </div>
                                          
                                          </div>
                                          @endif
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



                                    </tr>
                                </thead>
                                <tbody class=" text-sm font-light">
                                    @foreach ($proof->sale->details as $item)
                                        <tr
                                            class="odd:bg-white even:bg-gray-50 border-b border-gray-200 hover:bg-gray-100">

                                            <td class="py-3 px-6 text-center">

                                                <h1 class="font-medium">Unidad</h1>
                                            </td>
                                            <td class="py-3 px-6 text-center">

                                                <h1 class="font-medium">{{ $item->service_id }}</h1>
                                            </td>
                                            <td class="py-3 px-6 text-left ">
                                                <h1 class="font-medium">
                                                    <span class=" uppercase font-bold mr-1 ">{{ $item->name }}</span>

                                                </h1>
                                                <h1 class="font-medium  "> {{ Str::limit($item->description, 60) }}
                                                </h1>

                                            </td>
                                            <td class="py-3 px-6 text-center">

                                                <h1 class="font-medium">{{ $item->quantity }}</h1>
                                            </td>
                                            <td class="py-3 px-6 text-center">

                                                <h1 class="font-medium">
                                                    {{ number_format(round($item->price_u, 3), 3) }}
                                                </h1>
                                            </td>

                                            <td class="py-3 px-6 text-center">

                                                <h1 class="font-medium">
                                                    {{ number_format(round($item->price_t, 3), 3) }}
                                                </h1>
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>


                        </div>



                        <div class="  grid grid-cols-2 pb-5 ">

                            <div class="grid grid-cols-2 m-5 p-3 border-2 rounded-md gap-y-3">
                                <div>
                                    <P class="text-base font-extrabold">Moneda: <span
                                            class="font-thin text-gray-600">PEN
                                            (SOLES)</span> </P>
                                </div>
                                <div>
                                    <P class="text-base font-extrabold">IGV: <span
                                            class="font-thin text-gray-600">18%</span> </P>
                                </div>

                                <div class="">
                                    <P class="text-base font-extrabold">Condicion de pago: <span
                                            class="font-thin text-gray-600">Contado</span> </P>
                                </div>
                                <div>
                                    <P class="text-base font-extrabold">Metodo de pago: <span
                                            class="font-thin text-gray-600">Efectivo</span> </P>
                                </div>

                            </div>
                            <div class="font-black font-mono mt-5 ml-60 mr-16">



                                <div class="flex justify-between  ">
                                    <h1>O. GRAVADA</h1>
                                    <h1>{{ number_format(round($proof->sale->net, 3), 3) }}</h1>


                                </div>
                                <div class="flex justify-between ">
                                    <h1>IGV 18%</h1>
                                    <h1>{{ number_format(round($proof->sale->tax, 3), 3) }}</h1>

                                </div>




                                <div class="flex justify-between border-t-2  border-black py-1">
                                    <h1>TOTAL A PAGAR</h1>
                                    <h1>{{ number_format(round($proof->sale->total + $proof->sale->rounding, 2), 2) }}
                                    </h1>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-span-3 relative p-5  space-y-2 bg-white shadow-md ">
                    
                            <div class="flex items-center justify-between mb-5 ">
                                <p class="">ESTADO:</p>
                                @if ($proof->status == 1)
                                <span class="bg-gray-100 text-gray-800 text-md font-medium mr-2 px-2.5 py-0.5 rounded border border-gray-400">PENDIENTE</span>
                                @endif
                                @if ($proof->status == 2 && $proof->observation)
                                    <span
                                        class="bg-yellow-100 text-yellow-800 text-md font-medium  px-2.5 py-0.5 rounded  border border-yellow-400">ACEPTADO</span>
                                @elseif($proof->status == 2)
                                    <span
                                        class="bg-green-100 text-green-800 text-md font-medium  px-2.5 py-0.5 rounded  border border-green-400">ACEPTADO</span>
                                @endif

                                @if ($proof->status == 3)
                                    <span
                                        class="bg-red-100 text-red-800 text-md font-medium  px-2.5 py-0.5 rounded border  border-red-400">RECHAZADO</span>
                                @endif
                                @if ($proof->status == 4)
                                    <span
                                        class="bg-red-100 text-red-800 text-md font-medium  px-2.5 py-0.5 rounded border border-red-400">EXECEPCION</span>
                                @endif
                                @if ($proof->status == 5)
                                    <span
                                        class="bg-red-100 text-red-800 text-md font-medium  px-2.5 py-0.5 rounded border border-red-400">ANULADO</span>
                                @endif


                            </div>

                            <a href="{{route('proof.dowloadxml',$proof->id)}}" class="inline-block px-3 w-full py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-sm hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">XML</a>
                            <a href="{{route('proof.dowloadcdr',$proof->id)}}"  class="inline-block px-3 w-full py-2 text-sm font-medium text-center text-white bg-cyan-700 rounded-sm hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300">CDR</a>
                            <a href="{{route('generate.boleta.a4',$proof->id)}}" target="_blank"  class="inline-block px-3 w-full py-2 text-sm font-medium text-center text-white bg-purple-700 rounded-sm hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300">PDF A4</a>
                            <a href="{{route('generate.boleta.ticket',$proof->id)}}" target="_blank"  class="inline-block px-3 w-full py-2 text-sm font-medium text-center text-white bg-yellow-700 rounded-sm hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300">PDF TICKET</a>
                        
                        @if ($proof->status == 1)
                           <livewire:proof.proof-send :proof="$proof">
                        @endif

                            

                    
                    </div>
                </div>



            </div>
        </div>
    </div>
</x-app-layout>
