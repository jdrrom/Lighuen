<head>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<h1>Precios promedios</h1>
<?php
foreach ($response as $item) {
    ?>
    <div><?php echo $item["name"] ?></div>
    <div>Fecha de aparicion en mercado: <?php echo date("d/m/Y", $item["first_sale_date"]) ?></div>
    <div><img src="<?php echo $item["icon"] ?> " height=10% alt="Sorry! Image not available at this time"></div>
    <div><h2>El precio es: <?php echo $item["average_price"] ?></h2></div>
    <br>
    <?php
}

foreach ($falsos as $falso){?>
    <div><?php echo rawurlencode($falso["name"]) ?></div>
<?php }?>
