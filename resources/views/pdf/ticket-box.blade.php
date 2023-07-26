


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .invoice {
/*     max-width: 350px;
    width: 100%;
    min-width: 300px; */
/*     margin-left:-9px;        */   
    font-size: 13px;
    padding: 12px;
/*     font-family:rovb; */
    font-family: 'Courier New', Courier, monospace;
/* font-family: Arial, sans-serif; */
/* font-family: Tahoma, sans-serif; */
/* font-family: 'Lucida Console', Monaco, monospace; */
/* font-family: 'DejaVu Sans', serif; */
/* font-family: American Typewriter, monospace; */

}
body{
   margin: -45px;
}
.invoice .separator {
    margin: 25px 0;
    text-align: center;
}
.invoice .separator p {
    margin: 0;
    margin-top:-15px; 
    margin-bottom: /* 20px */;
}

.page-header__title h1 {
/*     font-size: 1.5em; */
}

.page-header__nit h2 {
    font-size: 1em;
    margin: 0;
/*     line-height: 1; */
}

.item__page-info p {
    font-size: 0.9em;
    margin: 0;
    line-height: 1.8;
    
}


/* .logo{
                 
                   height: 60px;
                   width: 60px;
              
                 } */

    </style>
</head>
<body>
   <div class="invoice">
       <!--  header  -->
       <div >
           <div >
               <center>
               <div >
   
           

              {{--      <div class="page-header__title">
                               <h3 style="font-weight:bold" >CENTRO MEDICO SAN JOSE</h3>
              
                   </div> --}}
                   <div class="page-header__nit">

                           <h2 style="font-weight:bold">SERV. MEDICOS SAN JOSE SCRL</h2>
                           <h2 style="font-weight:bold"><span>RUC:</span>20608012177</h2>
               
                   </div>
                   <div class="page-header__nit">
                       <h2 style="font-weight:bold"><span>CAL:</span>LIMA NRO. 1023 URB. SAN ANTONIO </h2>
                   </div>
                   <div class="page-header__nit">
                       <h2 style="font-weight:bold">PUNO - PUNO - PUNO</h2>
                   </div>
                   <div class="page-header__nit">
                    <h2 style="font-weight:bold">TEL: 051-621146</h2>
                </div>
               </div>
           </center>
           </div>
       </div>
   
       <div class="separator">
           <p style="margin-top: -30px; margin-bottom: -20px">--------------------------------</p>
       </div>
       <div >
           <div >
               <div>
                <center>
                   <div >
                       <h4 style="margin-top:-12px;font-weight:bold">CAJA NRO.</h4>
                   </div>
                   <div >
                       <h2 style="margin-top:-22px;font-weight:bold">{{str_pad($box->id, 2, "0", STR_PAD_LEFT)}}</h2>
                   </div>
               </center>
               </div>
           </div>
       </div>
     
       <div style="margin-top: -15px;" >
           <div >
               <div class="page-info">
               
             {{--       <div class="item__page-info">
                       <p>Pago: Efectivo - Contado</p>
                   </div> --}}
                   <div class="item__page-info">
                       <p style="font-weight:bold">Cajero(a): {{$box->user->name}}  </p>
                   </div>
                   <div class="item__page-info">
                       <p style="font-weight:bold">Fecha Apertura: {{$box->opening}} </p>
                   </div>
                   <div class="item__page-info">
                    <p style="font-weight:bold">Fecha Cierre: {{$box->closing}} </p>
                   </div>
                   <div class="item__page-info">
                    <p style="font-weight:bold">Estado: @if($box->status==1)ABIERTO @else CERRADO @endif </p>
                </div>             
               </div>
           </div>
       </div>
       
   
       <div class="separator" >
        <p  >-------Detalle General--------</p>
    </div>
      

           <div >
         
                    <h4 style="margin-top: -10px">MONTO INICIAL <samp style="margin-left:30px">S/.{{$box->initial}}</samp></h4>
          
        
                <h4 style="margin-top: -10px">INGRESOS <samp style="margin-left:69px">S/.{{number_format($box->motions()->where('type',1)->sum('amount'),2)}}</samp></h4>
     
    
            <h4 style="margin-top: -10px">EGRESOS(GASTOS) <samp style="margin-left:15px">S/.{{number_format($box->motions()->where('type',2)->sum('amount'),2)}}</samp></h4>
  
           </div>
           <div class="separator">
            <p>---Detalle del cuadre Final---</p>
        </div>

        <div >
         
            <h4 style="margin-top: -10px">INGRESOS TOTALES <samp style="margin-left:20px">S/.{{number_format($box->motions()->where('type',1)->sum('amount'),2)}}</samp></h4>
  

        <h4 style="margin-top: -10px">EGRESOS TOTALES <samp style="margin-left:28px">S/.{{number_format($box->motions()->where('type',2)->sum('amount'),2)}}</samp></h4>


    <h4 style="margin-top: -10px">SALDO <samp style="margin-left:107px">S/.{{number_format((($box->motions()->where('type',1)->sum('amount'))-($box->motions()->where('type',2)->sum('amount'))),2)}}</samp></h4>
    <h5 style="margin-top: -10px">MONTO INICIAL+SALDO <samp style="margin-left:15px; font-size: 13px"> S/.{{ number_format($box->initial+(($box->motions()->where('type',1)->sum('amount'))-($box->motions()->where('type',2)->sum('amount'))),2)}}</samp></h5>

   </div>

   <div class="separator">
    <p>----------------------------</p>
</div>
<div >
         
    <h3 style="margin-top: -10px">TOTAL CUADRE <samp style="margin-left:30px">S/. {{ number_format($box->initial+(($box->motions()->where('type',1)->sum('amount'))-($box->motions()->where('type',2)->sum('amount'))),2)}}</samp></h3>

</div>
     
 
   
       <!--  warranty  -->
       <div class="row" style="padding-top: px">
           <div class="col-12">
               <div class="page-warranty">
                       <center>
                      
            
              
                   <div class="item__page-info">
                       <p style="text-transform: uppercase; font-weight:bold">SON:{{convertNumberToText( number_format($box->initial+(($box->motions()->where('type',1)->sum('amount'))-($box->motions()->where('type',2)->sum('amount'))),2))}} NUEVOS SOLES
                       </p>
                   </div>
                  
               </center>
               </div>
           </div>
       </div>
   
 
   
       <div >
           <center>
           <div >

   
{{-- 
               <div class="page-header__nit">
                           <h3 style="margin-top: -10px" >C M San Jose S.C.R.L</h3>
          
               </div> --}}
               {{-- <div class="page-header__nit">

                       <h2 style="margin-top: ">Gracias poo su preferencia</h2>
           
               </div> --}}
              
           </div>
       </center>
       </div>
 
   
   </div>
   {{-- <div style="page-break-before: always;">
    <img src="{{asset('img/tk3.svg')}}" width="360px" alt="insertar SVG con la etiqueta image">
</div> --}}
</body>
</html>