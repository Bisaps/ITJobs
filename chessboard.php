<!DOCTYPE html>
<html>
<head>
<style>
    .chessboard {
        width: 320px;
        height: 320px;
        display: grid;
        grid-template-columns: repeat(8, 1fr);
        border: 1px solid black;
    }
    
    .square {
        width: 40px;
        height: 40px;
    }

    .white {
        background-color: white;
    }
    
    .black {
        background-color: black;
    }
</style>
</head>
<body>

<div class="chessboard">
    <?php
    for ($row = 1; $row <= 8; $row++) {
        for ($col = 1; $col <= 8; $col++) {
            $colorClass = ($row + $col) % 2 === 0 ? "black" : "white";
            echo '<div class="square ' . $colorClass . '"></div>';
        }
    }
    ?>
</div>

</body>
</html>
<!--  -->