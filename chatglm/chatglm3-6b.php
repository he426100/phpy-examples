<?php

/**
 * @link https://modelscope.cn/models/ZhipuAI/chatglm3-6b/summary
 */
require __DIR__ . '/../bootstrap.php';

use function python\import_from;

extract(import_from('modelscope', 'AutoTokenizer,AutoModel'));

$model_path = ms_hub_download('ZhipuAI/chatglm3-6b');
$tokenizer = $AutoTokenizer->from_pretrained($model_path, trust_remote_code: true);
$model = $AutoModel->from_pretrained($model_path, trust_remote_code: true)->half()->cuda();
$model = $model->eval();
[$response, $history] = $model->chat($tokenizer, "你好", history: []);
print($response . "\n");
[$response, $history] = $model->chat($tokenizer, "晚上睡不着应该怎么办", history: $history);
print($response . "\n");
