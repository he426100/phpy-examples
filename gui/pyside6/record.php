<?php

require __DIR__ . '/../Phpautogui.php';

// 导入所需的 Python 模块
$sys = PyCore::import('sys');
$QtCore = PyCore::import('PySide6.QtCore');
$QtWidgets = PyCore::import('PySide6.QtWidgets');
$QtGui = PyCore::import('PySide6.QtGui');
$operator = PyCore::import('operator');

class AutomationTool
{
    protected $window;
    protected $centralWidget;
    protected $layout;
    protected $recordButton;
    protected $playButton;
    protected $listView;
    protected $model;
    protected $history = [];
    protected $recording = false;

    public function __construct()
    {
        global $QtWidgets;
        $this->window = $QtWidgets->QMainWindow();
        $this->initUI();
        $this->initEvents();
    }

    public function initUI()
    {
        global $QtCore, $QtWidgets;
        // 主窗口布局
        $this->centralWidget = $QtWidgets->QWidget($this->window);
        $this->window->setCentralWidget($this->centralWidget);
        $this->layout = $QtWidgets->QVBoxLayout($this->centralWidget);

        // 录制按钮
        $this->recordButton = $QtWidgets->QPushButton("录制", $this->window);
        $this->recordButton->clicked->connect(fn () => $this->toggleRecording());
        $this->layout->addWidget($this->recordButton);

        // 播放按钮
        $this->playButton = $QtWidgets->QPushButton("播放");
        $this->playButton->clicked->connect(fn () => $this->playEvents());
        $this->layout->addWidget($this->playButton);

        // 事件列表视图
        $this->listView = $QtWidgets->QListView($this->window);
        $this->layout->addWidget($this->listView);
        $this->model = $QtCore->QStringListModel();
        $this->listView->setModel($this->model);
    }

    public function initEvents()
    {
        $this->window->keyPressEvent = fn ($e) => $this->listenKeyPress($e);
    }

    public function listenKeyPress($event)
    {
        global $QtCore, $QtWidgets;

        if ($this->recording) {
            $key = $event->key();
            $modifiersValue = $event->modifiers()->value;
            $action = '';

            if ($QtCore->Qt->Key_A <= $key && $key <= $QtCore->Qt->Key_Z) {
                if ($modifiersValue & $QtCore->Qt->ShiftModifier->value) { # Shift 键被按下
                    $action = ' "Shift+' . chr($key) . '"';
                } elseif ($modifiersValue & $QtCore->Qt->ControlModifier->value) {  # Ctrl 键被按下
                    $action = ' "Control+' . chr($key) . '"';
                } elseif ($modifiersValue & $QtCore->Qt->AltModifier->value) {  # Alt 键被按下
                    $action = ' "Alt+' . chr($key) . '"';
                } else {
                    $action = ' ' . chr($key);
                }
            } elseif ($key == $QtCore->Qt->Key_Home) {
                $action = '"Home"';
            } elseif ($key == $QtCore->Qt->Key_End) {
                $action = '"End"';
            } elseif ($key == $QtCore->Qt->Key_PageUp) {
                $action = '"PageUp"';
            } elseif ($key == $QtCore->Qt->Key_PageDown) {
                $action = '"PageDown"';
            } else {
                // 其他未设定的情况
                $QtWidgets->QWidget->keyPressEvent($this->window, $event);  # 留给基类处理
            }

            // 将动作数组添加到 history，并创建新的QStandardItem插入到模型中
            $this->history[] = ['keyPress', $event->nativeVirtualKey(), $modifiersValue];
            $list = $this->model->stringList();
            $list->append($action . ' pressed');
            $this->model->setStringList($list);
        }
    }

    public function toggleRecording()
    {
        $this->recording = !$this->recording;
        if ($this->recording) {
            $this->recordButton->setText("停止录制");
        } else {
            $this->recordButton->setText("录制");
        }
    }

    public function playEvents()
    {
        global $QtCore;

        $i = 0;
        $j = count($this->history) - 1;
        $ffi = (new Phpautogui())->ffi();
        $process = function () use (&$process, &$i, $j, $QtCore, $ffi) {
            $event = $this->history[$i];
            $ffi->keybd_event($event[1], 0, Phpautogui::KEYEVENTF_KEYDOWN, 0);
            $ffi->keybd_event($event[1], 0, Phpautogui::KEYEVENTF_KEYUP, 0);
            if ($i < $j) {
                $i++;
                $QtCore->QTimer->singleShot(30, $process);
            }
        };
        exec('start notepad.exe');
        $QtCore->QTimer->singleShot(1_000, $process);
    }

    public function show()
    {
        $this->window->show();
    }
}

// 创建 QApplication 实例
$app = $QtWidgets->QApplication($sys->argv);
$tool = new AutomationTool();
$tool->show(); // 这里需要实现窗口的显示逻辑
exit($app->exec());
