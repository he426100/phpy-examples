<?php

require '../vendor/autoload.php';

$sys = PyCore::import('sys');
$sys->path->append('.');

$QtCore = PyCore::import('PySide6.QtCore');
$QtWidgets = PyCore::import('PySide6.QtWidgets');

$app = $QtWidgets->QApplication($sys->argv);
$dialog = $QtWidgets->QDialog();
$ui = PyCore::import('ui_dialog')->Ui_Dialog();
$ui->setupUi($dialog);

// 设置命令和参数
$process = $QtCore->QProcess();
$process->setWorkingDirectory('D:\phpy\phpy');
$process->setEnvironment(['PATH' => 'D:\phpy\phpy-php8.1.27-py3.12.1-pyside6']);
$process->setProgram('php.exe');
$process->setArguments(['vendor\bin\phpunit', '--bootstrap', 'tests/bootstrap.php', '-c', 'phpunit.xml', '--colors=always']);

// 监听 QProcess 的 readyReadStandardOutput 信号
$processReadyReadStandardOutputSlot = function () use ($process, $ui) {
    // 获取命令的实时输出
    $output = $process->readAllStandardOutput()->toStdString();
    $ui->textBrowser->append($output); // 在光标位置插入文本
};
$process->readyReadStandardOutput->connect($processReadyReadStandardOutputSlot);
$process->finished->connect(function ($exitCode, $exitStatus) use ($process, $ui) {
    PyCore::print($exitCode, $exitStatus);
});

$ui->buttonBox->accepted->connect(function () use ($process, $ui) {
    $process->start();
    // $dialog->accept(); 
});
$ui->buttonBox->rejected->connect(function () use ($dialog) {
    $dialog->reject();
});

$dialog->show();
exit($app->exec());
