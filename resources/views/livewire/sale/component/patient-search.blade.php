<div class="relative w-full z-50">
    
    <input wire:model="query"  type="text" placeholder="Buscar..." class="mt-1 block w-full   border  border-gray-300 shadow-sm focus:border-transparent focus:ring-indigo-500 sm:text-sm" >
    @if($patients)
        <ul class="absolute bg-white border-2 rounded-lg border-black w-full mt-1 overflow-hidden ">
         
                
            @forelse ($patients as $item)
                <li wire:click="selectPatient({{$item->id}})" class="leading-8 px-3   cursor-pointer rounded-lg hover:bg-gray-100">
                    <p class="text-sm">
                        {{$item->number}} - {{$item->name}}  {{$item->surname}}
                    </p>
                    
                </li>
                @empty
                <li class="leading-8 px-3 uppercase  rounded-lg ">
                    ----No encontrado----
                </li>
            @endforelse
        </ul>
    @endif
   
</div>