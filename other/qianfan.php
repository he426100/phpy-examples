<?php

$os = PyCore::import('os');
$os->environ["QIANFAN_ACCESS_KEY"]= "53b64e28f42249328ab78338eec7e261";
$os->environ["QIANFAN_SECRET_KEY"] = "7e3ebf9c8d2a44079bccb0ad5d07d9af";

$qianfan = PyCore::import('qianfan');

$chat_comp = $qianfan->ChatCompletion(model: "ERNIE-Bot");
$resp = $chat_comp->do(messages: [[
    "role" => "user",
    "content" => "你好，千帆"
]], top_p: 0.8, temperature: 0.9, penalty_score: 1.0);

echo $resp["result"], PHP_EOL;
