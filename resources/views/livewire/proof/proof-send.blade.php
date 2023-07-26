<div>
    <div class="absolute  inset-x-0 bottom-0">
        <button wire:click="generate"  class="flex-1 px-3 w-full py-2 text-sm font-medium text-center text-white bg-green-700 rounded-sm hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">ENVIAR BOLETA {{$proof->id}}</button>
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

    
         
            <a href="{{route('proof.show',$proof->id)}}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition" >
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