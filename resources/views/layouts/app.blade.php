<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class=" bg-white shadow">
                    <div class="max-w-7xl mx-auto sm:ml-64 py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="sm:ml-64">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"></script>
    
    <script>

            Livewire.on('success',function(message){
                const Toast1 = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            color:'#FFFFFF',
            iconColor:'#FFFFFF',
            timer: 7000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            Toast1.fire({
            icon: 'success',
            background: '#28a745',
            title: message
            })
            });

          

            Livewire.on('error',function(message){
                Swal.fire({
                icon: 'error',
                title: message,
 
                })
            
            });

           Livewire.on('error-sunat',function(message,id){
                Swal.fire({
                icon: 'error',
                title: message,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href ="{{url('/')}}"+"/admin/proof/"+id+"/show";
                    }
                })
            
            }); 
      

            Livewire.on('obs',function(message){
                Swal.fire({
                icon: 'warning',
                title: message,
                })
            
            
            
            
            });

            Livewire.on('acept',function(message){
                Swal.fire({
                icon: 'success',
                title: message,
                })
            });
       

     </script>

         @stack('js')
</html>
