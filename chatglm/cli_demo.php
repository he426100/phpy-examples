<?php

require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/utils.php';

use function Laravel\Prompts\text;
use function Laravel\Prompts\info;
use function Laravel\Prompts\error;

$os = PyCore::import('os');
$platform = PyCore::import('platform');
$transformers = PyCore::import('transformers');
$AutoModel = $transformers->AutoModel;
$AutoTokenizer = $transformers->AutoTokenizer;
$torch = PyCore::import('torch');

$MODEL_PATH = (getenv('MODEL_PATH') ?: 'ZhipuAI') . '/chatglm3-6b';
$TOKENIZER_PATH = getenv("TOKENIZER_PATH") ?: $MODEL_PATH;
$DEVICE = $torch->cuda->is_available() ? 'cuda' : 'cpu';

$tokenizer = $AutoTokenizer->from_pretrained($TOKENIZER_PATH, trust_remote_code: true);
if ($DEVICE == 'cuda') {
    # AMD, NVIDIA GPU can use Half Precision
    // $model = $AutoModel->from_pretrained($MODEL_PATH, trust_remote_code: true)->to($DEVICE)->eval();
    $model = load_model_on_gpus($MODEL_PATH, $torch->cuda->device_count());
} else {
    # CPU, Intel GPU and other GPU can use Float16 Precision Only
    $model = $AutoModel->from_pretrained($MODEL_PATH, trust_remote_code: true)->float()->to($DEVICE)->eval();
}

$welcome = '欢迎使用 ChatGLM3-6B 模型，输入内容即可进行对话，clear 清空对话历史，stop 终止程序';

$past_key_values = null;
$history = [];
$stop_stream = false;

info($welcome);

while (true) {
    $query = text('用户：');
    if (trim($query) == 'stop') {
        break;
    } elseif (trim($query) == 'clear') {
        $past_key_values = null;
        $history = [];
        info("\033c");
        info($welcome);
        continue;
    }
    info('ChatGLM: ');
    try {
        $current_length = 0;
        $rs = $model->stream_chat(
            $tokenizer,
            $query,
            history: $history,
            top_p: 1,
            temperature: 0.01,
            past_key_values: $past_key_values,
            return_past_key_values: true
        );
        $it = PyCore::iter($rs);
        echo " \e[32m";
        while ($next = PyCore::next($it)) {
            if ($stop_stream) {
                $stop_stream = false;
                break;
            } else {
                list($response, $history, $past_key_values) = PyCore::scalar($next);
                echo mb_substr($response, $current_length);
                $current_length = mb_strlen($response);
            }
        }
        echo "\e[39m\n\n";
    } catch (\Throwable $e) {
        error($e->getMessage() ?: '执行出错了');
    }
}
