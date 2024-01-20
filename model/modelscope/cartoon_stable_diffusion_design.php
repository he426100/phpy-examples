<?php

/**
 * @link https://modelscope.cn/models/damo/cv_cartoon_stable_diffusion_design/summary
 */
require __DIR__ . '/../bootstrap.php';

use function python\import;
use function python\import_from;

extract(import('cv2'));
extract(import_from('modelscope.pipelines', 'pipeline'));
extract(import_from('modelscope.utils.constant', 'Tasks'));

$pipe = $pipeline($Tasks->text_to_image_synthesis, model: ms_hub_download('damo/cv_cartoon_stable_diffusion_design'), model_revision: 'v1.0.0');
$output = $pipe(['text' => 'sks style, a portrait painting of Johnny Depp']);
$cv2->imwrite('result.png', $output['output_imgs'][0]);
print("Image saved to result.png\n");
print("finished!\n");

# 更佳实践
# $pipe = $pipeline($Tasks->text_to_image_synthesis, model: ms_hub_download('damo/cv_cartoon_stable_diffusion_design'), model_revision: 'v1.0.0');
// extract(import_from('diffusers.schedulers', 'EulerAncestralDiscreteScheduler'));
// $pipe->pipeline->scheduler = $EulerAncestralDiscreteScheduler->from_config($pipe->pipeline->scheduler->config);
// $output = $pipe(['text' => 'sks style, a portrait painting of Johnny Depp']);
// $cv2->imwrite('result2.png', $output['output_imgs'][0]);
// print("Image saved to result2.png\n");
// print("finished!\n");
