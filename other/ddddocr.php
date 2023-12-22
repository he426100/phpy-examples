<?php
/**
 * @link https://github.com/sml2h3/ddddocr
 */
$ddddocr = PyCore::import('ddddocr');

// 保存到文件不是必须的，这里只是为了人工验证
$file = './captcha.png';
file_put_contents($file, file_get_contents('https://camo.githubusercontent.com/2e91e61d29b4310981f2b22783317dbc78ef954072df4b8f8e1c58ecde1177a9/68747470733a2f2f63646e2e77656e616e7a68652e636f6d2f696d672f612e706e67'));

$img_bytes = PyCore::bytes(file_get_contents($file));
// 参考 https://github.com/sml2h3/ddddocr/blob/master/ddddocr/__init__.py
$ocr = $ddddocr->DdddOcr(show_ad: false);
$res = $ocr->classification($img_bytes);
echo $res, PHP_EOL;
