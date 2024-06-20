<?php

$appbuilder = PyCore::import('appbuilder');
$os = PyCore::import('os');

# 设置环境中的TOKEN，以下TOKEN为访问和QPS受限的试用TOKEN，正式使用请替换为您的个人TOKEN
$os->environ["APPBUILDER_TOKEN"] = "bce-v3/ALTAK-zxQQLYTUAtTzcxChyxHgi/69144aa054a32c9e746ce085e78ec5f97e864f32";
$models = $appbuilder->get_model_list(api_type_filter: ["chat"], is_available: true);
// PyCore::print(implode(', ', PyCore::scalar($models)));

# 相似问生成组件
$similar_q = $appbuilder->SimilarQuestion(model: "ERNIE Speed-AppBuilder");

# 定义输入，调用相似问生成
$input = $appbuilder->Message("我想吃冰淇淋，哪里的冰淇淋比较好吃？");
PyCore::print($similar_q($input));
