      
<div class="grid grid-cols-6 gap-6">


                <div class="col-span-6 sm:col-span-3">
                  <label  for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                  <input wire:model.defer="name" type="text" id="name"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('name')
                    <h1 class="text-red-500">{{$message}}</h1>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3 ">
                  <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                  <input wire:model.defer="price" type="text" id="price"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                  @error('price')
                  <h1 class="text-red-500">{{$message}}</h1>
                  @enderror
                </div>
                <div class="col-span-6">
                  <label for="description" class="block text-sm font-medium text-gray-700">Descripcion</label>
                  <input wire:model.defer="description" type="text" id="description"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                  @error('description')
                  <h1 class="text-red-500">{{$message}}</h1>
                  @enderror
                </div>
            

             
                
  

  
                
</div>
      
          


  

  