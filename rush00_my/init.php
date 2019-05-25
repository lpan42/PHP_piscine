<?php
$product_file = fopen("data/product.csv", "r");
$product_format = fgets($product_file);
$format = explode(";", trim($product_format));
//print_r($format);
$i = 0;
while($fp = fgets($product_file))
{
    $product_arr = explode(";", trim($fp));
    $j = 0;
    foreach ($format as $key) {
        $products[$i][$key] = $product_arr[$j];
        $j++;
    }
    $i++;
}
print_r($products);
file_put_contents("data/product.data", serialize($products));
?>