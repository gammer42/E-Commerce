<?php 
    use \Milon\Barcode\DNS1D;
    use \Milon\Barcode\DNS2D;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
   </head>
<body>
<div class="container text-center">
<h2>One-Dimensional (1D) Barcode Types</h2><br/>
   <div>{!!DNS2D::getBarcodeHTML(8889899, 'QRCODE')!!} 8889899</div></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br></br>
   <div>{!!DNS1D::getBarcodeHTML(5436564, 'C39')!!} 5436564</div></br></br></br></br></br></br></br></br></br></br></br></br>
   <div>{!!DNS1D::getBarcodeHTML(77656765, 'I25')!!} 77656765</div></br></br></br></br></br></br></br></br></br></br></br></br>
   <div>{!!DNS1D::getBarcodeHTML(25547, 'I25')!!} 25547</div></br></br></br></br></br></br></br></br></br></br></br></br>
 </div>
</body>
</html>