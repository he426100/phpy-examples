<?php

/**
 * @link https://modelscope.cn/models/damo/multi-modal_chinese_stable_diffusion_v1.0/summary
 */
require __DIR__ . '/../bootstrap.php';

use function python\import;
use function python\import_sub;

extract(import('torch,cv2'));
extract(import_sub('modelscope.pipelines', 'pipeline'));
extract(import_sub('modelscope.utils.constant', 'Tasks'));

$task = $Tasks->text_to_image_synthesis;
$model_id = ms_hub_download('damo/multi-modal_chinese_stable_diffusion_v1.0');
# 基础调用
$pipe = $pipeline(task: $task, model: $model_id);
$output = $pipe(['text' => $argv[1] ?? '中国山水画']);
$cv2->imwrite('result1.png', $output['output_imgs'][0]);
# 输出为opencv numpy格式，转为PIL.Image
# from PIL import Image
# img = $output['output_imgs'][0]
# img = Image.fromarray(img[:,:,::-1])
# img.save('result.png')

# 更多参数
$pipe = $pipeline(task: $task, model: $model_id, torch_dtype: $torch->cuda->is_available() ? $torch->float16 : $torch->float32);
$output = $pipe(['text' => $argv[1] ?? '中国山水画', 'num_inference_steps' => 50, 'guidance_scale' => 7.5, 'negative_prompt' => '模糊的']);
$cv2->imwrite('result2.png', $output['output_imgs'][0]);

# 采用DPMSolver
extract(import_sub('diffusers.schedulers', 'DPMSolverMultistepScheduler'));
$pipe = $pipeline(task: $task, model: $model_id, torch_dtype: $torch->cuda->is_available() ? $torch->float16 : $torch->float32);
$pipe->pipeline->scheduler = $DPMSolverMultistepScheduler->from_config($pipe->pipeline->scheduler->config);
$output = $pipe(['text' => $argv[1] ?? '中国山水画', 'num_inference_steps' => 25]);
$cv2->imwrite('result3.png', $output['output_imgs'][0]);
