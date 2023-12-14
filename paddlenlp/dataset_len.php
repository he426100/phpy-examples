<?php

$paddle = PyCore::import('paddle');
$Normalize = PyCore::import('paddle.vision.transforms')->Normalize;

$transform = $Normalize(mean: [127.5], std: [127.5], data_format: 'CHW');
# 下载数据集并初始化 DataSet
$train_dataset = $paddle->vision->datasets->MNIST(mode: 'train', transform: $transform);
$test_dataset = $paddle->vision->datasets->MNIST(mode: 'test', transform: $transform);

# 打印数据集里图片数量
PyCore::print(PyCore::str('{} images in train_dataset, {} images in test_dataset')->format(PyCore::len($train_dataset), PyCore::len($test_dataset)));
