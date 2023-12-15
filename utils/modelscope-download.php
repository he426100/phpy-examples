<?php

/**
 * @link https://modelscope.cn/docs/%E6%A8%A1%E5%9E%8B%E7%9A%84%E4%B8%8B%E8%BD%BD
 */
require __DIR__ . '/../bootstrap.php';

use function modelscope\snapshot_download;

echo snapshot_download($argv[1]), PHP_EOL;
