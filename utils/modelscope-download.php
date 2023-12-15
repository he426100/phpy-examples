<?php

/**
 * @link https://modelscope.cn/docs/%E6%A8%A1%E5%9E%8B%E7%9A%84%E4%B8%8B%E8%BD%BD
 */
require __DIR__ . '/../bootstrap.php';

$snapshot_download = PyCore::import('modelscope.hub.snapshot_download')->snapshot_download;
echo $snapshot_download($argv[1], cache_dir: getenv('MS_CACHE') ?: null), PHP_EOL;
