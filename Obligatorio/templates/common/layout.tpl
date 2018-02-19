<html>
    <head>
        <meta charset="UTF-8">
        <title>Obligatorio</title>
         <link rel="stylesheet" href="resources/css/bootstrap.css">
         <link rel="stylesheet" href="resources/css/layout.css">
       
    </head>
    <body>
        {include file="common/cabezal.tpl"}
        <div class="container-fluid">
           <div class="row">
                {include file="common/menu.tpl"}
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                    {block name=cuerpo}{/block}
                </main>
                
            </div>
        </div>
        {include file="common/pie.tpl"} 
        <script src="resources/js/bootstrap.js"></script>
        <script src="resources/js/jquery.js"></script>
    </body>
</html>