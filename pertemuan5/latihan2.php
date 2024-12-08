<?php
// pengulangan pada array
// far /foreach
$angka = [3,2,15,20,11,88,1,45];
?>
<!DOCTYPE html
<html>
<head>
    <title>latihan 2</title>
    <style>
        .kotak {
            width: 50px;
            height: 50x;
            background-color: salmon;
            text-align: center;
            line-height: 50px;
            margin: 3px;
            float: left;
        }
        .clear { clear: both; }
    </style>
</head>
<body>

<?php for( $i = 0; $i < count($angka); $i++ ) { ?>
    <div class="kotak"><?php echo $angka[$i]; ?></div>
<?php } ?>

<div  class="clear"></div>

<?php foreach( $angka as $a ) { ?>
    <div class="kotak"><?php echo $a; ?></div>
<?php } ?>

<div class="clear"></div>

<?php foreach( $angka as $a  ) : ?>
    <div class="kotak"><?= $a; ?></div>
<?php endforeach; ?>