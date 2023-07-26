


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet"> --}}
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
    margin: 10px 0;
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
           <p>--------------------------------</p>
       </div>
       <div >
           <div >
               <div>
                <center>
                   <div >
                       <h4 style="margin-top:-12px;font-weight:bold">TICKET</h4>
                   </div>
                   <div >
                       <h2 style="margin-top:-22px;font-weight:bold">T001-{{str_pad($sale->id, 7, "0", STR_PAD_LEFT)}}</h2>
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
                       <p style="font-weight:bold">Cliente: {{$sale->patient->name}}  </p>
                   </div>
                   <div class="item__page-info">
                       <p style="font-weight:bold">Documento: {{$sale->patient->number}} </p>
                   </div>
              {{--      <div class="item__page-info">
                       <p>Direcion: Jr: Los angeles 133</p>
                   </div>
               
                   <div class="item__page-info">
                       <p>Lugar:Puno</p>
                   </div>
                   <div class="item__page-info">
                       <p>Vendedor:{{$sale->user->name}}</p>
                   </div> --}}
            
                 
               </div>
           </div>
       </div>
       
   
     {{--   <div class="separator">
           <p>***********************************</p>
       </div>
       <div class="page-info">
           <div class="item__page-info">
               <p><span>Fecha de Emision: </span>{{$sale->created_at->format('d/m/Y')}}</p>
           </div>
     
       </div>
   
       <div class="separator">
           <p>***********************************</p>
       </div> --}}
      
     <!--  table  -->
       <div style="margin-top: 5px">
           <div >
             <div class="page-description">
               <table style="            border-spacing: 0;" >
               <thead style="border-top: 1px solid black; border-bottom: 1px solid black" >
                 <tr  >
                 
                   <th style="text-align: start ; " >DESCRIPCION</th>
                   <th  >CANT</th>
                   <th >VALOR</th>
                 </tr>
               </thead>
               <tbody>
                   @foreach ($sale->details as $item)
                        <tr>
                    
                   <td {{-- style="text-align: start ;border-top: 1px solid black;  " --}} >
                     <p style="color: ;text-transform: uppercase; ">{{$item->name}}</p> 
                     <p style="font-weight:normal; text-transform: uppercase; " >{{$item->description}}</p>
                  
                   </td>
                   <td style="font-weight:bold">{{$item->quantity}}</td>
                   <td style="font-weight:bold">{{round($item->price,2)}}</td>
                 </tr> 
                   @endforeach
                
             
                 {{--  <tr >
             
                   <td  colspan="2" style="text-align: start" >OP. GRAVADAS:</td>
                   <td style="text-align: right;" >{{number_format(round($sale->net,2),2)}}</td>
                 </tr> 
                 <tr >
                   <td colspan="2" style="text-align: start" >IGV:</td>
                   <td  style="text-align: right;">{{number_format(round($sale->tax,2),2)}}</td>
                 </tr>  
                 <tr >
                    <td  colspan="2" style="text-align: start" >DESCUENTO:</td>
                    <td  style="text-align: right;">{{$sale->discount}}</td>
                  </tr>
                  <tr >
                    <td  colspan="2" style="text-align: start" >SUBTOTAL:</td>
                    <td  style="text-align: right;">{{number_format(round($sale->subtotal,2),2)}}</td>
                  </tr>
                 <tr >
             
                   <td  colspan="2" style="text-align: start" >RENDEO A FAVOR:</td>
                   <td style="text-align: right;" >-{{$sale->rounding}}</td>
                 </tr> --}}
                 <tr style="border-top: 1px solid #dee2e6"> 
            {{--         <td  colspan="2">------------------------------------</td> --}}
                    <td  colspan="2" style="text-align: start; font-weight:bold" >TOTAL</td>
                    <td  style="text-align: right; font-weight:bold">{{number_format(round($sale->subtotal,2),2)}}</td>
                  </tr> 
                  <td  colspan="2">------------------------------------</td>
                  <tr > 
                    <td  colspan="2" style="text-align: start; font-weight:bold" >EFECTIVO:</td>
                        <td  style="text-align: right; font-weight:bold">{{$sale->cash}}</td> 
                    </tr> 
                    <tr > 
                        <td  colspan="2" style="text-align: start; font-weight:bold" >CAMBIO:</td>
                        <td  style="text-align: right; font-weight:bold">{{$sale->change}}</td>
                    </tr>
                
               </tbody>
             </table>
             </div>
           </div>
       </div>
     
 
   
       <!--  warranty  -->
       <div class="row" style="padding-top: px">
           <div class="col-12">
               <div class="page-warranty">
                       <center>
                      
            
              
                   <div class="item__page-info">
                       <p style="text-transform: uppercase; font-weight:bold">SON:{{convertNumberToText(number_format(round($sale->subtotal,2),2))}} NUEVOS SOLES
                       </p>
                   </div>
                  
               </center>
               </div>
           </div>
       </div>
   
       <div class="separator">
           <p>------------------------------------</p>
       </div>
   
       <div >
           <center>
           <div >

   
{{-- 
               <div class="page-header__nit">
                           <h3 style="margin-top: -10px" >C M San Jose S.C.R.L</h3>
          
               </div> --}}
               <div class="page-header__nit">

                       <h2 style="margin-top: -10px">Gracias poR su preferencia</h2>
           
               </div>
              
           </div>
       </center>
       </div>
 
   
   </div>
   <div style="page-break-before: always;">
    <img src="{{asset('img/tk3.svg')}}" width="360px" alt="insertar SVG con la etiqueta image">
</div>
</body>
</html>