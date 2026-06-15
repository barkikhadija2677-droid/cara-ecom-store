<?php
$file = 'public/img/products/plain-white-shirt.png';
if (!file_exists($file)) {
    echo "File not found\n";
    exit;
}
$img = imagecreatefrompng($file);
$rgb = imagecolorat($img, 0, 0);
$colors = imagecolorsforindex($img, $rgb);
echo "Top-left pixel: alpha=" . $colors['alpha'] . " red=" . $colors['red'] . " green=" . $colors['green'] . " blue=" . $colors['blue'] . "\n";
