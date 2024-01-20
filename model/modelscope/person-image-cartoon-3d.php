<?php

/**
 * @link https://modelscope.cn/models/damo/cv_unet_person-image-cartoon-3d_compound-models/summary
 */
require __DIR__ . '/../bootstrap.php';

use function python\import;
use function python\import_from;

extract(import('cv2'));
extract(import_from('modelscope.outputs', 'OutputKeys'));
extract(import_from('modelscope.pipelines', 'pipeline'));
extract(import_from('modelscope.utils.constant', 'Tasks'));

$img_cartoon = $pipeline($Tasks->image_portrait_stylization, model: ms_hub_download('damo/cv_unet_person-image-cartoon-3d_compound-models'));
# 图像本地路径
#img_path = 'input.png'
# 图像url链接
$img_path = $argv[1] ?? 'https://modelscope.oss-cn-beijing.aliyuncs.com/demo/image-cartoon/cartoon.png';
$result = $img_cartoon($img_path);
$cv2->imwrite($argv[2] ?? 'result.png', $result[$OutputKeys->OUTPUT_IMG]);
print("finished!\n");
