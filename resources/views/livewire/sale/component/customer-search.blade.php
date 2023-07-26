<div class="mt-5">
    <button wire:click="$set('modal',true)"   class="p-2 mt-1 ml-2 text-sm font-medium text-white bg-blue-700 r border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </button>

        <x-jet-dialog-modal wire:model="modal" >
            <x-slot:title >
            BUSCAR CLIENTE POR DNI
            </x-slot:title>
            <x-slot:content>
                <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6">
                        
                                <label class="block text-sm font-medium text-gray-700">Documento :</label>
                                <div class="flex items-center">   
                                    <input type="text" class="w-20  rounded-md block bg-gray-200 border-gray-300 shadow-sm py-2 mt-1 mr-2 pl-5 pr-7 text-gray-500  sm:text-sm" disabled value="DNI">                                  
                                        <input wire:model.defer="number" type="text" id="simple-search" class="mt-1 block w-full   rounded-md   border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Numero" required>
                                    <button wire:click="searchDocument"  class="p-2 mt-1 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 "><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
                                </div>
                                @error('number')
                                    <h1 class="text-red-500">{{$message}}</h1>
                                @enderror
                            
                            
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label  for="names" class="block text-sm font-medium text-gray-700">Nombre:</label>
                            <input wire:model.defer="name" type="text" id="names"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                @error('name')
                                <h1 class="text-red-500">{{$message}}</h1>
                                @enderror
                        </div>



                    
    
    
                            
                       
                        
                      
    
                            
                </div>
            </x-slot:content>
            <x-slot:footer>
                <x-jet-secondary-button wire:click="closemodal" wire:loading.attr="disabled">
                    Cancelar
                </x-jet-secondary-button>
        
            
                <x-jet-button  wire:click="nice" wire:loading.attr="disabled" class="ml-2" >
                    Listo
                </x-jet-button>
            
            
            </x-slot:footer>
        </x-jet-dialog-modal>
</div>
