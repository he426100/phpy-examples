<?php

require __DIR__ . '/../bootstrap.php';

use function python\import;
use function python\import_sub;

extract(import('paddle'));
echo $paddle->__version__, PHP_EOL;

extract(import_sub('paddle.vision.transforms', 'Compose,Normalize'));

$transform = $Compose([$Normalize(mean: [127.5], std: [127.5], data_format: 'CHW')]);
# 使用transform对数据集做归一化
print("download training data and load training data\n");
$train_dataset = $paddle->vision->datasets->MNIST(mode: 'train', transform: $transform);
$test_dataset = $paddle->vision->datasets->MNIST(mode: 'test', transform: $transform);
print("load finished\n");

extract(import(['numpy' => 'np', 'matplotlib.pyplot' => 'plt']));

[$train_data0, $train_label_0] = [$train_dataset->__getitem__(0)[0], $train_dataset->__getitem__(0)[1]];
$train_data0 = $train_data0->reshape([28, 28]);
$plt->figure(figsize: PyCore::tuple([2,2]));
$plt->imshow($train_data0, cmap: $plt->cm->binary);
// $plt->imsave('./output/img.png', $train_data0);
print('train_data0 label is: ' . PyCore::str($train_label_0) . "\n");

PyCore::import('sys')->path->append(realpath('.'));
extract(import('LeNet'));
extract(import_sub('paddle.metric', 'Accuracy'));
$model = $paddle->Model($LeNet->LeNet());  # 用Model封装模型
$optim = $paddle->optimizer->Adam(learning_rate: 0.001, parameters: $model->parameters());

# 配置模型
$model->prepare(
    $optim,
    $paddle->nn->CrossEntropyLoss(),
    $Accuracy()
);

# 训练模型
$model->fit($train_dataset,
    epochs: 2,
    batch_size: 64,
    verbose: 1
);

# 预测模型
echo $model->evaluate($test_dataset, batch_size: 64, verbose: 1), PHP_EOL;
