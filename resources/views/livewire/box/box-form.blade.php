      
<div class="grid grid-cols-6 gap-6">

                <div class="col-span-3">
            
                    <label class="block text-sm font-medium text-gray-700">Usuario :</label>

                          <select  wire:model.defer="user"class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                              <option value="" selected>Seleccione...</option>
                              @foreach ($users as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                              @endforeach
                                                          
                          </select>               
             

                    @error('user')
                        <h1 class="text-red-500">{{$message}}</h1>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                  <label   class="block text-sm font-medium text-gray-700">Monto Inicial</label>
                  <input wire:model.defer="mount" type="number"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('mount')
                    <h1 class="text-red-500">{{$message}}</h1>
                    @enderror
                </div> 
                
                <div class="col-span-6 ">
                  <label  class="block text-sm font-medium text-gray-700">Observaciones</label>
                  <input wire:model.defer="observation" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('observation')
                    <h1 class="text-red-500">{{$message}}</h1>
                    @enderror
                </div>

  
                
</div>
      
          


  

  