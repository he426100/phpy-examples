### phpy示例

- modelscope
  - 一键验证环境  
  ```sh
  php -r "PyCore::print(PyCore::import('modelscope.pipelines')->pipeline('word-segmentation')('今天天气不错，适合 出去游玩'));"
  ```
  - [通义千问-1_8B](https://github.com/he426100/phpy-examples/blob/main/modelscope/qwen-1.8b.php)
  - [通义千问-1_8B-chat](https://github.com/he426100/phpy-examples/blob/main/modelscope/qwen-1.8b-chat.php)
  - [读光-文字识别-行识别模型-中英-通用领域](https://github.com/he426100/phpy-examples/blob/main/modelscope/ocr_recognition.php)
  - [读光-文字识别-行识别模型-中英-车牌文本领域](https://github.com/he426100/phpy-examples/blob/main/modelscope/ocr-recognition-licenseplate.php)
  - [DCT-Net人像卡通化](https://github.com/he426100/phpy-examples/blob/main/modelscope/person-image-cartoon.php)
  - [DCT-Net人像卡通化-3D](https://github.com/he426100/phpy-examples/blob/main/modelscope/person-image-cartoon-3d.php)
  - [卡通系列文生图模型](https://github.com/he426100/phpy-examples/blob/main/modelscope/cartoon_stable_diffusion_design.php)
  - [中文StableDiffusion-通用领域](https://github.com/he426100/phpy-examples/blob/main/modelscope/chinese_stable_diffusion.php)
  - [模型训练](https://github.com/he426100/phpy-examples/blob/main/modelscope/ocr-train.php)

- chatglm
  - [cli_demo](https://github.com/he426100/phpy-examples/blob/main/chatglm/cli_demo.php)

- paddle
  - [一键UIE预测](https://github.com/he426100/phpy-examples/blob/main/paddlenlp/test.php)
  - [hello](https://github.com/he426100/phpy-examples/blob/main/paddlenlp/hello.php)
  - [mnist](https://github.com/he426100/phpy-examples/blob/main/paddlenlp/mnist.php)

### 安装python
- [https://docs.conda.io/projects/miniconda/en/latest/](https://docs.conda.io/projects/miniconda/en/latest/)
- [https://docs.anaconda.com/free/anaconda/install/linux/](https://docs.anaconda.com/free/anaconda/install/linux/)

### 加速pip
- 阿里源
```sh
pip config set global.index-url https://mirrors.aliyun.com/pypi/simple 
pip config set install.trusted-host mirrors.aliyun.com
```

### 安装环境
- [魔塔modelscope](https://modelscope.cn/docs/%E7%8E%AF%E5%A2%83%E5%AE%89%E8%A3%85)
- [飞浆paddle](https://www.paddlepaddle.org.cn/install/quick)
- [huggingface](https://huggingface.co/docs/huggingface_hub/quick-start) ([huggingface镜像站](https://hf-mirror.com/))
- [transformers](https://huggingface.co/docs/transformers/installation)

### 安装驱动
- [cuda](https://developer.nvidia.com/cuda-downloads)
- [cudnn](https://docs.nvidia.com/deeplearning/cudnn/install-guide/index.html#installlinux-tar)
- [tensorrt](https://docs.nvidia.com/deeplearning/tensorrt/install-guide/index.html#installing-tar)

### 安装php和phpy扩展
- 参考[Dockerfile](https://github.com/he426100/phpy-examples/blob/main/Dockerfile)

### wsl2环境变量参考
```sh
# cuda
export PATH=$PATH:/usr/local/cuda-12.3/bin
export LD_LIBRARY_PATH=/usr/local/cuda-12.3/lib64
export CUDA_HOME=/usr/local/cuda

# wsl
export LD_LIBRARY_PATH="/usr/lib/wsl/lib:$LD_LIBRARY_PATH"

# tensorrt
export LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/usr/src/TensorRT-8.6.1.6/lib
```