### phpy例子

- chatglm
  - [cli_demo](https://github.com/he426100/phpy-examples/blob/main/chatglm/cli_demo.php)

- paddle
  - [一键UIE预测](https://github.com/he426100/phpy-examples/blob/main/paddlenlp/test.php)
  - [hello](https://github.com/he426100/phpy-examples/blob/main/paddlenlp/hello.php)
  - [mnist](https://github.com/he426100/phpy-examples/blob/main/paddlenlp/mnist.php)

- modelscope
  - 一键验证环境
  - [通义千问-1_8B](https://github.com/he426100/phpy-examples/blob/main/modelscope/qwen-1.8b.php)
  ```
  php -r "PyCore::print(PyCore::import('modelscope.pipelines')->pipeline('word-segmentation')('今天天气不错，适合 出去游玩'));"
  ```
