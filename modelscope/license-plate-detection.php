<?php

/**
 * @link https://modelscope.cn/models/damo/cv_resnet18_license-plate-detection_damo/files
 */
require __DIR__ . '/../bootstrap.php';

use function python\import_sub;

extract(import_sub('modelscope.pipelines', 'pipeline'));
extract(import_sub('modelscope.utils.constant', 'Tasks'));

$model_path = getenv('MS_CACHE') . 'damo/cv_resnet18_license-plate-detection_damo';
$license_plate_detection = $pipeline($Tasks->license_plate_detection, model: $model_path);
$result = $license_plate_detection('https://modelscope.oss-cn-beijing.aliyuncs.com/test/images/license_plate_detection.jpg');
print($result . "\n");
