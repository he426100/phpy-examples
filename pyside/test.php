<?php

$globals = new PyDict();
PyCore::exec('
from PySide6.QtCore import (QCoreApplication, QDate, QDateTime, QLocale,
    QMetaObject, QObject, QPoint, QRect,
    QSize, QTime, QUrl, Qt)
from PySide6.QtGui import (QBrush, QColor, QConicalGradient, QCursor,
    QFont, QFontDatabase, QGradient, QIcon,
    QImage, QKeySequence, QLinearGradient, QPainter,
    QPalette, QPixmap, QRadialGradient, QTransform)
from PySide6.QtWidgets import (QAbstractButton, QApplication, QDialog, QDialogButtonBox,
    QListView, QSizePolicy, QWidget)

class Ui_Dialog(object):
    def setupUi(self, Dialog):
        if not Dialog.objectName():
            Dialog.setObjectName(u"Dialog")
        Dialog.resize(400, 300)
        self.buttonBox = QDialogButtonBox(Dialog)
        self.buttonBox.setObjectName(u"buttonBox")
        self.buttonBox.setGeometry(QRect(30, 240, 341, 32))
        self.buttonBox.setOrientation(Qt.Horizontal)
        self.buttonBox.setStandardButtons(QDialogButtonBox.Cancel|QDialogButtonBox.Ok)
        self.listView = QListView(Dialog)
        self.listView.setObjectName(u"listView")
        self.listView.setGeometry(QRect(60, 30, 256, 192))

        self.retranslateUi(Dialog)

        QMetaObject.connectSlotsByName(Dialog)
    # setupUi

    def retranslateUi(self, Dialog):
        Dialog.setWindowTitle(QCoreApplication.translate("Dialog", u"Dialog", None))
    # retranslateUi
', $globals);

$sys = PyCore::import('sys');
$QtCore = PyCore::import('PySide6.QtCore');
$QtWidgets = PyCore::import('PySide6.QtWidgets');

$app = $QtWidgets->QApplication($sys->argv);
$dialog = $QtWidgets->QDialog();
$ui = $globals['Ui_Dialog']();
$ui->setupUi($dialog);
$dialog->model = $QtCore->QStringListModel();
$ui->listView->setModel($dialog->model);
$ui->buttonBox->accepted->connect(function () use ($dialog) {
    $current_list = $dialog->model->stringList();  # 获取当前模型中的列表
    $current_list->append(file_get_contents(__FILE__));  # 向列表末尾追加新文本
    $dialog->model->setStringList($current_list);  # 将更新后的列表设置回模型
    // $dialog->accept();
    echo 'accept', PHP_EOL;
});
$ui->buttonBox->rejected->connect(function () use ($dialog) {
    $dialog->reject();
    echo 'reject', PHP_EOL;
});

$dialog->show();
exit($app->exec());
