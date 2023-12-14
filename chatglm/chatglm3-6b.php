<?php

/**
 * @link https://modelscope.cn/models/ZhipuAI/chatglm3-6b/summary
 */
require __DIR__ . '/../vendor/autoload.php';

use function python\import_sub;

extract(import_sub('modelscope', 'AutoTokenizer,AutoModel'));
$tokenizer = $AutoTokenizer->from_pretrained("/mnt/g/ai/modelscope/chatglm3-6b", trust_remote_code: true);
$model = $AutoModel->from_pretrained("/mnt/g/ai/modelscope/chatglm3-6b", trust_remote_code: true)->half()->cuda();
$model = $model->eval();
[$response, $history] = $model->chat($tokenizer, "你好", history: []);
print($response . "\n");
[$response, $history] = $model->chat($tokenizer, "晚上睡不着应该怎么办", history: $history);
print($response . "\n");
