<html>
    <head>
        <meta charset="UTF-8">
        <title>Obligatorio</title>
         <link rel="stylesheet" href="resources/css/bootstrap.css">
         <link rel="stylesheet" href="resources/css/layout.css">
       
    </head>
    <body>
        {include file="common/privado/cabezal.tpl"}
       <div class="container">
		<div class="row mt-3">
                    <div class="col"> 
                        {block name=cuerpo}{/block} 
                </div>
            </div>
        </div>
        {include file="common/pie.tpl"} 
        
        <script src="resources/js/bootstrap.js"></script>
        <script src="resources/js/jquery.js"></script>
    </body>
</html>