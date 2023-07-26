


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .invoice {
    max-width: 350px;
    width: 100%;
    min-width: 300px;

    font-size: 16px;
    padding: 12px;
    font-family: 'Courier New', Courier, monospace;

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
}

.page-header__title h1 {
    font-size: 1.5em;
}

.page-header__nit h2 {
    font-size: 1em;
    margin: 0;
    line-height: 1;
}

.item__page-info p {
    font-size: 0.9em;
    margin: 0;
    line-height: 1.3;
}


.logo{
                 
                   height: 60px;
                   width: 60px;
              
                 }

    </style>
</head>
<body>
   <div class="invoice">
       <!--  header  -->
       <div >
           <div >
               <center>
               <div >
   
           

                   <div class="page-header__title">
                               <h1 >Centro Medico San Jose S.R.L</h1>
              
                   </div>
                   <div class="page-header__nit">

                           <h2><span>RUC:: </span>10234567895</h2>
               
                   </div>
                   <div class="page-header__nit">
                       <h2><span>Jr: </span>Lima #123</h2>
                   </div>
                   <div class="page-header__nit">
                       <h2>Puno-Puno-Puno</h2>
                   </div>
               </div>
           </center>
           </div>
       </div>
   
       <div class="separator">
           <p>*****************************</p>
       </div>
       <div >
           <div >
               <div>
                <center>
                   <div >
                       <h4 style="margin-top:-12px">BOLETA DE VENTA ELECTRONICA</h4>
                   </div>
                   <div >
                       <h2 style="margin-top:-12px">{{$proof->serie}}-{{$proof->correlative}}</h2>
                   </div>
               </center>
               </div>
           </div>
       </div>
     
       <div >
           <div >
               <div class="page-info">
               
             {{--       <div class="item__page-info">
                       <p>Pago: Efectivo - Contado</p>
                   </div> --}}
                   <div class="item__page-info">
                       <p>Cliente: {{$proof->name}}  </p>
                   </div>
                   <div class="item__page-info">
                       <p>Docuemnto: {{$proof->number}} </p>
                   </div>
                    <div class="item__page-info">
                       <p>Direcion: {{$proof->address}}</p>
                   </div>
               
                  {{-- <div class="item__page-info">
                       <p>Lugar:Puno</p>
                   </div>
                   <div class="item__page-info">
                       <p>Vendedor:{{$sale->user->name}}</p>
                   </div> --}}
            
                 
               </div>
           </div>
       </div>
   
       <div class="separator">
           <p>***********************************</p>
       </div>
       <div class="page-info">
           <div class="item__page-info">
               <p><span>Fecha de Emision: </span>{{$proof->created_at->format('d/m/Y')}}</p>
           </div>
           <div class="item__page-info">
               <p><span>Moneda: </span>PEN (SOLES)</p>
               <p><span>IGV: </span>18%</p>
               <p><span>Condicion de pago: </span>Contado</p>
               <p><span>Metodo de pago: </span>Efectivo</p>
           </div>
       </div>
   
       <div class="separator">
           <p>***********************************</p>
       </div>
      
     <!--  table  -->
       <div >
           <div >
             <div class="page-description">
               <table style="width:100%;             border-spacing: 0;" >
               <thead>
                 <tr>
                 
                   <th style="text-align: start" >DESCRIPCION</th>
                   <th >CANT</th>
                   <th >VALOR</th>
                   <th >TOTAL</th>
                 </tr>
               </thead>
               <tbody>
                   @foreach ($proof->sale->details as $item)
                  <tr>
                    
                   <td style="text-align: start ;border-top: 1px solid #dee2e6 " >
                     <p>{{$item->name}}-{{$item->description}}</p> 

                  
                   </td>
                   <td style="text-align: center ;border-top: 1px solid #dee2e6 ">{{$item->quantity}}</td>
                   <td style="text-align: center; border-top: 1px solid #dee2e6 ;">  {{ number_format(round($item->price_u, 2), 2) }}&nbsp;</td>
                   <td style="text-align: center ;border-top: 1px solid #dee2e6 ">{{ number_format(round($item->price_t, 2), 2) }}&nbsp;</td>
                  
                 </tr> 
                   @endforeach
                
             
                  <tr >
             
                   <td  colspan="3" style="text-align: start" >OP. GRAVADAS:</td>
                   <td style="text-align: right;" >{{number_format(round($proof->sale->net,2),2)}}</td>
                 </tr> 
                 <tr >
                   <td colspan="3" style="text-align: start" >IGV:</td>
                   <td  style="text-align: right;">{{number_format(round($proof->sale->tax,2),2)}}</td>
                 </tr>  
               {{--   <tr >
                    <td  colspan="3" style="text-align: start" >DESCUENTO:</td>
                    <td  style="text-align: right;">{{$proof->sale->discount}}</td>
                  </tr> --}}
                  <tr >
                    <td  colspan="3" style="text-align: start" >SUBTOTAL:</td>
                    <td  style="text-align: right;">{{number_format(round($proof->sale->subtotal,2),2)}}</td>
                  </tr>
                 <tr >
             
                   <td  colspan="3" style="text-align: start" >RENDEO A FAVOR:</td>
                   <td style="text-align: right;" >-{{$proof->sale->rounding}}</td>
                 </tr> 
                 <tr >
             
                    <td  colspan="3" style="text-align: start" >TOTAL A PAGAR:</td>
                    <td  style="text-align: right;">{{number_format(round($proof->sale->total,2),2)}}</td>
                  </tr> 
             
                
               </tbody>
             </table>
             </div>
           </div>
       </div>
     
 
   
       <!--  warranty  -->
       <div class="row" style="padding-top: 25px">
           <div class="col-12">
               <div class="page-warranty">
                       <center>

                        <div class="item__page-info">
                          <p style="text-transform: uppercase; margin-bottom: 10px">SON:{{convertNumberToText(number_format(round($proof->sale->total,2),2))}} NUEVOS SOLES
                          </p>
                      </div>
                       <img src="data:image/png;base64, {!! base64_encode(QrCode::format('svg')->size(100)->generate( $qr )) !!} "> 
            
                       <div class="item__page-info">
                        <p style=" margin-bottom: 10px;margin-top: 10px;">{{$proof->hash}}
                        </p>
                    </div>
              
              
                   <div class="item__page-info">
                       <p>Representacion impresa de la boleta electronica consulte en www.sunat.gob.pe</p>
                       <p>No se aceptan cambios ni devoluciones</p>
                   </div>
               </center>
               </div>
           </div>
       </div>
   
       <div class="separator">
           <p>*****************************</p>
       </div>
   
       <div >
           <center>
           <div >

               <div class="page-header__nit">

                       <h2 style="margin-top: -10px">Gracias pos su preferencia</h2>
           
               </div>
              
           </div>
       </center>
       </div>
 
   
   </div>
</body>
</html>