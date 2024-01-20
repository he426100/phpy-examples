<?php

$paddle = PyCore::import('paddle');

# 模型组网并初始化网络
$lenet = $paddle->vision->models->LeNet(num_classes: 10);

# 可视化模型组网结构和参数
echo $paddle->summary($lenet, PyCore::tuple([1, 1, 28, 28])), PHP_EOL;
