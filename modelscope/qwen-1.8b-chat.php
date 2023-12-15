<?php
/**
 * @link https://modelscope.cn/models/qwen/Qwen-1_8B-Chat/summary
 */

require __DIR__ . '/../bootstrap.php';

use function python\import_sub;
use function Laravel\Prompts\text;
use function Laravel\Prompts\info;
use function Laravel\Prompts\error;

extract(import_sub('modelscope', 'AutoModelForCausalLM,AutoTokenizer,GenerationConfig'));

$model_path = ms_hub_download('qwen/Qwen-1_8B-Chat');
# Note: The default behavior now has injection attack prevention off.
$tokenizer = $AutoTokenizer->from_pretrained($model_path, revision: 'master', trust_remote_code: true);
$model = $AutoModelForCausalLM->from_pretrained($model_path, revision: 'master', device_map: "auto", trust_remote_code: true)->eval();

$welcome = '欢迎使用 通义千问-1_8B-Chat 模型，输入内容即可进行对话，clear 清空对话历史，stop 终止程序';

$history = [];

info($welcome);
while (true) {
    $query = text('用户：');
    if (trim($query) == 'stop') {
        break;
    } elseif (trim($query) == 'clear') {
        $history = null;
        info("\033c");
        info($welcome);
        continue;
    }
    info('Qwen: ');
    try {
        [$response, $history] = PyCore::scalar($model->chat($tokenizer, $query, history: $history));
        info($response);
    } catch (\Throwable $e) {
        error($e->getMessage() ?: '执行出错了');
    }
}
