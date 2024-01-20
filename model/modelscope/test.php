<?php
$pipeline = PyCore::import('modelscope.pipelines')->pipeline;
$word_segmentation = $pipeline('word-segmentation', model: 'damo/nlp_structbert_word-segmentation_chinese-base');

$input_str = '今天天气不错，适合出去游玩';
PyCore::print($word_segmentation($input_str));
// {'output': '今天 天气 不错 ， 适合 出去 游玩'}
