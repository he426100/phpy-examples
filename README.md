### phpy示例

- chatglm
  - [cli_demo](https://github.com/he426100/phpy-examples/blob/main/chatglm/cli_demo.php)

- paddle
  - [一键UIE预测](https://github.com/he426100/phpy-examples/blob/main/paddlenlp/test.php)
  - [hello](https://github.com/he426100/phpy-examples/blob/main/paddlenlp/hello.php)
  - [mnist](https://github.com/he426100/phpy-examples/blob/main/paddlenlp/mnist.php)

- modelscope
  - 一键验证环境  
  ```
  php -r "PyCore::print(PyCore::import('modelscope.pipelines')->pipeline('word-segmentation')('今天天气不错，适合 出去游玩'));"
  ```
  - [通义千问-1_8B](https://github.com/he426100/phpy-examples/blob/main/modelscope/qwen-1.8b.php)
  - [通义千问-1_8B-chat](https://github.com/he426100/phpy-examples/blob/main/modelscope/qwen-1.8b-chat.php)
  - [读光-文字识别-行识别模型-中英-通用领域](https://github.com/he426100/phpy-examples/blob/main/modelscope/ocr_recognition.php)

### 安装python
- [https://docs.conda.io/projects/miniconda/en/latest/](https://docs.conda.io/projects/miniconda/en/latest/)

### 加速pip
- 阿里源
```
pip config set global.index-url https://mirrors.aliyun.com/pypi/simple 

pip config set install.trusted-host mirrors.aliyun.com
```

### 环境安装
- [魔塔modelscope](https://modelscope.cn/docs/%E7%8E%AF%E5%A2%83%E5%AE%89%E8%A3%85)
- [飞浆paddle](https://www.paddlepaddle.org.cn/install/quick)
- [transformers](https://huggingface.co/docs/transformers/installation)