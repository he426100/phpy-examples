<?php

/** @link https://www.paddlepaddle.org.cn/documentation/docs/zh/practices/quick_start/hello_paddle.html */

$paddle = PyCore::import('paddle');
print("paddle " . $paddle->__version__ . "\n");

# 准备数据
$x_data = $paddle->to_tensor([[1.], [3.0], [5.0], [9.0], [10.0], [20.0]]);
$y_data = $paddle->to_tensor([[12.], [16.0], [20.0], [28.0], [30.0], [50.0]]);

# 用飞桨定义模型的计算（行驶里程和总费用是线性的）
# $y_predict = w * x + b
$linear = $paddle->nn->Linear(in_features: 1, out_features: 1);

# 准备好运行飞桨
$w_before_opt = $linear->weight->numpy()->item();
$b_before_opt = $linear->bias->numpy()->item();

PyCore::print(PyCore::str("w before optimize: {}")->format($w_before_opt));
PyCore::print(PyCore::str("b before optimize: {}")->format($b_before_opt));

# 告诉飞桨怎么样学习
$mse_loss = $paddle->nn->MSELoss(); // 均方误差
$sgd_optimizer = $paddle->optimizer->SGD(learning_rate: 0.001, parameters: $linear->parameters()); // 优化算法

# 运行优化算法
$total_epoch = 5000;
$loss = null;
foreach (PyCore::scalar(PyCore::range($total_epoch)) as $i) {
    $y_predict = $linear->__call__($x_data); // $linear($x_data) 就行，不需要__call__，这么写只是更符合phper思维，毕竟它是个对象嘛
    $loss = $mse_loss($y_predict, $y_data);
    $loss->backward();
    $sgd_optimizer->step();
    $sgd_optimizer->clear_grad();

    if ($i % 1000 == 0) {
        print(PyCore::str("epoch {} loss {}")->format($i, $loss->item()) . "\n");
    }
}

print(PyCore::str("finished training， loss {}")->format($loss->item()) . "\n");

# 机器学习出来的参数
$w_after_opt = $linear->weight->numpy()->item();
$b_after_opt = $linear->bias->numpy()->item();

print(PyCore::str("w after optimize: {}")->format($w_after_opt) . "\n");
print(PyCore::str("b after optimize: {}")->format($b_after_opt) . "\n");
