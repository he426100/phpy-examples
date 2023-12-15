<?php

/**
 * @link https://modelscope.cn/models/damo/cv_convnextTiny_ocr-recognition-licenseplate_damo/summary
 */
require __DIR__ . '/../bootstrap.php';

use function python\import;
use function python\import_sub;

extract(import_sub('modelscope.pipelines', 'pipeline'));
extract(import_sub('modelscope.utils.constant', 'Tasks'));
extract(import('cv2'));

$model_path = ms_hub_download('damo/cv_convnextTiny_ocr-recognition-licenseplate_damo');
$ocr_recognition = $pipeline($Tasks->ocr_recognition, model: $model_path);

### 使用url
$img_url = 'http://duguang-labelling.oss-cn-shanghai.aliyuncs.com/mass_img_licenseplate//ocr_recognition_licenseplate.jpg';
$result = $ocr_recognition($img_url);
print($result . "\n");

### 使用图像文件
### 请准备好名为'ocr_recognition_licenseplate.jpg'的图像文件
# img_path = 'ocr_recognition_licenseplate.jpg'
# img = cv2.imread(img_path)
# result = ocr_recognition(img)
# print(result)