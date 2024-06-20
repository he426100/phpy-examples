<?php

$dashscope = PyCore::import('dashscope');

$SpeechSynthesizer = $dashscope->audio->tts->SpeechSynthesizer;

$dashscope->api_key = 'sk-0d6bef4ee95c45ad9393';
$result = $SpeechSynthesizer->call(model: "sambrt-ff202440e3b04-ft-202440e3163b-e8cb", text: "打开那些继续演奏的旋律逐渐地沉寂在眼眸上仿佛这浓烈的酒杯被投进另一种酒而不由一抹回忆整个肌肤散发着淡淡的透露出每次用眸子看玉兰照镜子的时候的小缝隙里藏着的是真心的双重享受", sample_rate: 24000);
if ($result->get_audio_data()) {
    file_put_contents('output1111.wav', $result->get_audio_data());
}
PyCore::print('get response:' . $result->get_response());
