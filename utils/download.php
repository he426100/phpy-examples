<?php

/**
 * @link https://modelscope.cn/docs/%E6%A8%A1%E5%9E%8B%E7%9A%84%E4%B8%8B%E8%BD%BD
 */
require __DIR__ . '/../bootstrap.php';

if (($argv[2] ?? '') == 'hf') {
    echo hf_hub_download($argv[1]), PHP_EOL;
} else {
    echo ms_hub_download($argv[1]), PHP_EOL;
}
