      
<div class="grid grid-cols-6 gap-6">

                <div class="col-span-6">
            
                    <label class="block text-sm font-medium text-gray-700">Documento :</label>
                    <div class="flex items-center">   
                        <select  wire:model.defer="document" id="currency" name="currency" class="h-full rounded-md block border-gray-300 shadow-sm py-2 mt-1 mr-2 pl-2 pr-7 text-gray-500 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="" selected>Seleccione...</option>
                            <option value="1">DNI</option>
                            <option value="2">Carnet de Extrangeria</option>
                            <option value="2">Pasaporte</option>
            
                            
                        </select>
                        {{$document}}
                            <input wire:model.defer="number" type="text" id="simple-search" class="mt-1 block w-full   rounded-md   border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Numero" required>
                        <button wire:click="searchDocument"  class="p-2 mt-1 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 "><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
                    </div>

                    @error('document')
                        <h1 class="text-red-500">{{$message}}</h1>
                    @enderror
                    @error('number')
                        <h1 class="text-red-500">{{$message}}</h1>
                    @enderror
                 
                 
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label  for="names" class="block text-sm font-medium text-gray-700">Nombres</label>
                  <input wire:model.defer="name" type="text" id="names"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('name')
                    <h1 class="text-red-500">{{$message}}</h1>
                    @enderror
                </div>
  
                <div class="col-span-6 sm:col-span-3">
                  <label for="last-name" class="block text-sm font-medium text-gray-700">Apellidos</label>
                  <input wire:model.defer="surname" type="text" name="last-name" id="last-name"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                  @error('surname')
                  <h1 class="text-red-500">{{$message}}</h1>
                  @enderror
                </div>              
</div>
      
          


  

  