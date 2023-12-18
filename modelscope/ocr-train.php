<?php

/**
 * @link https://modelscope.cn/models/damo/cv_convnextTiny_ocr-recognition-licenseplate_damo/summary
 */
require __DIR__ . '/../bootstrap.php';

use function python\import;
use function python\import_from;

extract(import('os'));
extract(import('tempfile'));

extract(import_from('modelscope.hub.snapshot_download', 'snapshot_download'));
extract(import_from('modelscope.metainfo', 'Trainers'));
extract(import_from('modelscope.msdatasets', 'MsDataset'));
extract(import_from('modelscope.trainers', 'build_trainer'));
extract(import_from('modelscope.utils.config', 'Config,ConfigDict'));
extract(import_from('modelscope.utils.constant', 'ModelFile,DownloadMode'));

### 请确认您当前的modelscope版本，训练/微调流程在modelscope==1.4.0及以上版本中 

$model_id = 'damo/cv_convnextTiny_ocr-recognition-licenseplate_damo';
$cache_path = $snapshot_download($model_id); # 模型下载保存目录
$config_path = $os->path->join($cache_path, $ModelFile->CONFIGURATION); # 模型参数配置文件，支持自定义
$cfg = $Config->from_file($config_path);

# 构建数据集，支持自定义 damo/ICDAR13_HCTR_Dataset WIRD9090/ocr_plate
$train_data_cfg = $ConfigDict(
    name: 'ICDAR13_HCTR_Dataset', 
    split: 'test',
    namespace: 'damo',
    test_mode: false
);

$train_dataset = $MsDataset->load( 
    dataset_name: $train_data_cfg->name,
    split: $train_data_cfg->split,
    namespace: $train_data_cfg->namespace,
    download_mode: $DownloadMode->REUSE_DATASET_IF_EXISTS,
);

# damo/ICDAR13_HCTR_Dataset
$test_data_cfg = $ConfigDict(
    name: 'ICDAR13_HCTR_Dataset', 
    split: 'validation',
    namespace: 'damo',
    test_mode: false
);

$test_dataset = $MsDataset->load(
    dataset_name: $test_data_cfg->name,
    split: $test_data_cfg->split,
    namespace: $test_data_cfg->namespace,
    download_mode: $DownloadMode->REUSE_DATASET_IF_EXISTS
);

$tmp_dir = '/mnt/g/python/' . $tempfile->TemporaryDirectory()->name; # 模型文件和log保存位置，默认为"work_dir/"

# 自定义参数，例如这里将max_epochs设置为15，所有参数请参考configuration.json
$_cfg_modify_fn = PyCore::fn(function($cfg) {
    $cfg->train->max_epochs = 15;
    return $cfg;
});

####################################################################################

$kwargs = [
    'model' => $model_id,
    'train_dataset' => $train_dataset,
    'eval_dataset' => $test_dataset,
    'work_dir' => $tmp_dir,
    'cfg_modify_fn' => $_cfg_modify_fn
];

# 模型训练
$trainer = $build_trainer(name: $Trainers->ocr_recognition, default_args: $kwargs);
$trainer->train();
