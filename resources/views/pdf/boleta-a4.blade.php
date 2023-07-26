
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FACTURA A4</title>
    <style>
                         *{
                   margin: 0;
                   box-sizing: border-box;

                 }

                 #invoiceholder{
                   width:100%;
                   height:100% ;
                 }

                 #invoice{

                   background: #FFF;
                   padding: 15px;
                 }

                 #invoice-top{min-height: 120px;}
                 #invoice-mid{min-height: 120px;}

                 .logo{
                   float: left;
                   height: 60px;
                   width: 60px;
                   background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
                   background-size: 60px 60px;
                 }
                 .info2{
                   display: flex;
                   float:left;
                   margin-left: 20px;
                 }
                 .title{
                   float: right;
                   border-style: solid ;
                 }
                 .title2{
                     margin: 30px;
                 }
                 table{
                   border-collapse: collapse;
                   border-spacing: 0;
                   width: 100%;
                 }
                 .tableitems{
                   text-align: center;
                 }
                 th{
                   border-top: 1px solid rgb(0, 0, 0); 
                   border-bottom: 1px solid rgb(0, 0, 0);
                   background: rgb(245, 244, 244)
                 }
                 .fila{
                   border-bottom: 1px solid rgb(0, 0, 0);
                 } 
                 .itemtext{font-size: .9em;
                     font-family:Arial, Helvetica, sans-serif;
                 }
                 .itemtext2{font-size: .7em;
                             font-family:Arial, Helvetica, sans-serif;
                             line-height:20px;
                 }
                 .itemtext3{font-size: .9em;
                             font-family:Arial, Helvetica, sans-serif;
                             font-weight: bolder;
                 }
                 #legalcopy{
                   font-family:Arial, Helvetica, sans-serif;
                   margin-top: 15px;
                 }
                 .legal{
                   width:70%;
                 }
    </style>
</head>
<body>
   <div id="invoiceholder">
       <div id="invoice" >
         <div id="invoice-top">
           <div class="logo"></div>
           <div class="info2">
             <h2>CENTRO MEDICO SAN JOSE</h2>
             <h5>CENTRO DE CETVICIOS MEDICOS SAN JOSE E.R.L</h5>
             <H5>JR: Lima #123 Puno - Puno - Puno </H5>
             <H6>Telefono: 951-5185422 </H6>
           </div>
           <div class="title">
               <div class="title2">
               <center>
                <h4>R.U.C N° 20000000000</h4>
             <h5>BOLETA DE VENTA ELECTRONICA</h5>
             <h3>{{$proof->serie}}-{{$proof->correlative}} </h3></center>
            </div>
           </div>
         </div>
         <div id="invoice-mid">
           <div class="info">
             <p  class="itemtext2">FECHA DE EMICION<span style="margin-left: 50px">: </span> {{$proof->created_at->format('d/m/Y')}}  </p>
             <p  class="itemtext2">FECHA DE VENCIMIENTO<span style="margin-left: 20px">: </span> {{-- {{$sale->created_at->addDay(5)->format('d/m/Y')}}  --}}</p>
             <p  class="itemtext2">CLIENTE<span style="margin-left: 110px">: </span> {{$proof->name}}  </p>
             <p  class="itemtext2">DOCUMENTO<span style="margin-left: 84px">: </span> {{$proof->number}}  </p>
             <p  class="itemtext2">DIRECCIÓN<span style="margin-left: 94px">: </span> {{$proof->address}} </p>
           </div>
         </div>
         <div>
                <div id="table">
                    <table>
                    <tr class="tableitems" >
                        <th ><p class="itemtext3">UNIDAD</p></th>
                        <th ><p class="itemtext3">DESCRIPCION</p></th>
                        <th ><p class="itemtext3">P.UNIT</p></th>
                        <th ><p class="itemtext3">CANTIDAD</p></th>
                        <th ><p class="itemtext3">TOTAL</p></th>
                    </tr>
                    @foreach ($proof->sale->details as $item)
                    <tr class="tableitems">
                        <td class="fila" ><p class="itemtext">Uni</p></td>
                        <td class="fila" ><p class="itemtext">{{ $item->name}} - {{$item->description}}</p></td>
                        <td class="fila" ><p class="itemtext"> {{ number_format(round($item->price_u, 2), 2) }}</p></td>
                        <td class="fila" ><p class="itemtext">{{number_format($item->quantity,2)}}</p></td>
                        <td class="fila" ><p class="itemtext">{{ number_format(round($item->price_t, 2), 2) }}</p></td>
                    </tr>  
                    @endforeach
                        
                    <tr  >
                        <td></td>
                        <td style="text-align:right;"   colspan="2"><p class="itemtext3">OP. GRAVADAS: S/.</p></td>
                        <td></td>
                        <td style="text-align:right; "><p class="itemtext3" >{{number_format(round($proof->sale->net,2),2)}}</p></td>
                    </tr> 
                    <tr  >
                        <td></td>
                        <td style="text-align:right;"  colspan="2" ><p class="itemtext3">IGV: S/.</p></td>
                        <td></td>
                        <td style="text-align:right;" ><p class="itemtext3">{{number_format(round($proof->sale->tax,2),2)}}</p></td>
                    </tr>
                 {{--    <tr  >
                      <td></td>
                      <td style="text-align:right;"  colspan="2" ><p class="itemtext3">DESCUENTO S/.</p></td>
                      <td></td>
                      <td style="text-align:right;" ><p class="itemtext3">{{$proof->sale->discount}}</p></td>
                  </tr> --}}
                  <tr  >
                    <td></td>
                    <td style="text-align:right;"  colspan="2" ><p class="itemtext3">Sub Total S/.</p></td>
                    <td></td>
                    <td style="text-align:right;" ><p class="itemtext3">{{number_format(round($proof->sale->subtotal,2),2)}}</p></td>
                </tr>
                <tr  >
                  <td></td>
                  <td style="text-align:right;"  colspan="2" ><p class="itemtext3">Redondeo S/.</p></td>
                  <td></td>
                  <td style="text-align:right;" ><p class="itemtext3">-{{$proof->sale->rounding}}</p></td>
              </tr>
                    <tr  >
                        <td></td>
                        <td colspan="2" style="text-align:right;" ><p class="itemtext3">TOTAL A PAGAR: S/.</p></td>
                        <td></td>
                        <td style="text-align:right;"><p class="itemtext3">{{number_format(round($proof->sale->total,2),2)}}</p></td>
                    </tr> 
                    </table>
                </div>
                <div> 
                <div id="legalcopy">
                    <h5 class="legal" style="text-transform: uppercase;">Son:<strong> {{convertNumberToText(number_format(round($proof->sale->total,2),2))}} NUEVOS SOLES</strong>
                    </h5>
                </div>
                          <div style="float: right;">
                  {{--               {!! QrCode::format('png')->generate($qr); !!} --}}
                                <img src="data:image/png;base64, {!! base64_encode(QrCode::format('svg')->size(100)->merge('\public\img\log.png')->generate( $qr)) !!} ">
                            <h6 style="margin-left: -80px">Código Hash: {{$proof->hash}}</h6>
                          </div>
                        </div>
                        <div style="margin-top: 150px" >
                            <p><strong>Moneda: </strong> PEN(SOLES)</p>
                            <p><strong> IGV: </strong> 18%</p>
                            <p><strong> Condicion de Pago: </strong> Contado</p>
                            <p><strong> Metodo de pago: </strong> Efectivo</p>
                            
                        </div>
                        <div style="margin-top: 50px;border:solid 1px rgb(0, 0, 0)" >
                        <div style="margin: 5px;margin-bottom:50px">
                        <p><strong>OBSERVACIONES :</strong>Consulte este docuemnto en wwww.sunat.gob.pe No se aceptan Cambios ni devoluciones  --Gracias Por su preferencia-- </p>
                        </div>
                    </div>
           
         </div>
       </div>
     </div>
</body>
</html>