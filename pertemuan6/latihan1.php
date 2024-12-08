<!DOCTYPE html>
<html iang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>latihan array</title>
    <style>
        .kotak {
            width: 30px;
            height: 30px;
            background-color:pink;
            text-align: center;
            line-height: 30px;
            margin: 30px;
            float: left;
            transition: 1s;
        }
        .kotak:hover{
            transform: rotate(360deg);
            border-radius: 50%;
        }
        .clear{
            clear:both;
        }
    </style>
</head>
<body>

<?php
$angka = [
    [1,2,3],
    [4,5,6],
    [7,8,9],
    [10,11,12],
    [13,14,15],
    [16,16,18],
    [18,19,20],
];
?>
 <?php foreach($angka as $a ): ?>
    <?php foreach($a as $b):?>
<div class="kotak"><?= $b; ?></div>
<?php endforeach;?>
    <div class="clear"></div>
    <?php endforeach; ?>


    </body>
    </html>