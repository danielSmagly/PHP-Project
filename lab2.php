<?php
    $nameVar = 'Name Variable';
    
    $numVar = 100-50;

    $salesTax = 0.08;
    
    echo $nameVar;
    echo '<br>';
    echo $numVar;
    echo '<br>';
    echo $salesTax;
    echo '<br>';

    $testNum = 100;
    $result = $testNum & 1;
    echo $result;
    echo '<br>';

    $numVar++;

    $newResult = $numVar > 50;
    echo $newResult;
    echo '<br>';

    $thirdBoolResult = ($numVar > 25) && ($numVar < 75);
    echo $thirdBoolResult;
    echo '<br>';

    echo 'My name is ____ and my local sales tax rate is '.$salesTax;

    
?>
