<html>
    <head>
        <meta charset="UTF-8">
        <title>Obligatorio</title>
         <link rel="stylesheet" href="resources/css/bootstrap.css">
         <link rel="stylesheet" href="resources/css/layout.css">
          
    </head>
    <body>
        {include file="common/cabezal.tpl"}
       <div class="container">
		<div class="row row align-items-center">
                    <div class="col">
                        {block name=cuerpo}{/block} 
                </div>
            </div>
               
        </div>
       
       {include file="common/pie.tpl"} 
        
       
        <script src="resources/js/bootstrap.js"></script>
        <script src="resources/js/jquery.js"></script>
        <script src="resources/js/common.js"></script> 
        <script src="resources/js/registrarPublicacion.js"></script> 
      
        
        
    </body>
    {block name=js}{/block}
    
</html>