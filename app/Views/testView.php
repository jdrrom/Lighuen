<h1>Precios promedios</h1>
<?php
    foreach ($response as $item){
?>
        <div><img src="<?php echo $item["icon"]?>"></div>
        <div><h2>El precio es: <?php echo $item["average_price"]?></h2></div>
        <br>

<?php
    }
?>