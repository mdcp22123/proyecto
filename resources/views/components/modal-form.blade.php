
@props(['head','id'])

@php
    if($id>0){
       $action='Editar';
    }else{
        $action='Crear';
    };
@endphp
<x-jet-dialog-modal wire:model="modal" >
    <x-slot:title >
        {{ $head }} | {{$action}}
    </x-slot:title>
    <x-slot:content>
       {{$slot}}
    </x-slot:content>
    <x-slot:footer>
        <x-jet-secondary-button wire:click="closemodal" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        @if ($id>0)
        <x-jet-button wire:click="update" class="ml-2" >
            Editar
        </x-jet-button>
        @else
        <x-jet-button  wire:click="save" wire:loading.attr="disabled" class="ml-2" >
            Crear
        </x-jet-button>
        @endif
    
    </x-slot:footer>
   </x-jet-dialog-modal>