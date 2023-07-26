
<div class="grid grid-cols-1 lg:grid-cols-3 p-4">
    <div class="flex items-center justify-center pb-2 lg:mb-0 lg:justify-start">
        <span  class=" text-sm font-medium text-gray-900">Mostrar</span>
        <select wire:model="cant" class="mx-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  ">
          <option selected>10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
     
        </select>
        <span>entradas</span>
        
    </div>
    <div class="relative mx-auto  mb-2 ">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
        </div>
        <input wire:model="search" type="text" id="table-search-users" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar">
    </div>
    <div class="text-center lg:text-end">
        <button wire:click="$set('modal' ,true)" type="button"  class=" px-6 py-2.5 bg-green-600 text-white font-bold text-sm  uppercase rounded  hover:bg-green-700 hover:shadow-lg   ">
            {{ $boton_name}}
          </button>
    </div>
</div>