

# https://www.paddlepaddle.org.cn/documentation/docs/zh/practices/quick_start/hello_paddle.html

import paddle
print("paddle " + paddle.__version__)

# 准备数据
x_data = paddle.to_tensor([[1.], [3.0], [5.0], [9.0], [10.0], [20.0]])
y_data = paddle.to_tensor([[12.], [16.0], [20.0], [28.0], [30.0], [50.0]])

# 用飞桨定义模型的计算
# $y_predict = w * x + b

# 用飞桨定义模型的计算（行驶里程和总费用是线性的）
linear = paddle.nn.Linear(in_features=1, out_features=1)

# 准备好运行飞桨
w_before_opt = linear.weight.numpy().item()
b_before_opt = linear.bias.numpy().item()

print("w before optimize: {}".format(w_before_opt))
print("b before optimize: {}".format(b_before_opt))

# 告诉飞桨怎么样学习
mse_loss = paddle.nn.MSELoss()
sgd_optimizer = paddle.optimizer.SGD(learning_rate=0.001, parameters = linear.parameters())

# 运行优化算法
total_epoch = 5000
for i in range(total_epoch):
    y_predict = linear(x_data)
    loss = mse_loss(y_predict, y_data)
    loss.backward()
    sgd_optimizer.step()
    sgd_optimizer.clear_grad()
    
    if i%1000 == 0:
        print("epoch {} loss {}".format(i, loss.item()))
        
print("finished training， loss {}".format(loss.item()))

# 机器学习出来的参数
w_after_opt = linear.weight.numpy().item()
b_after_opt = linear.bias.numpy().item()

print("w after optimize: {}".format(w_after_opt))
print("b after optimize: {}".format(b_after_opt))
