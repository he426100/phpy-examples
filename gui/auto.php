<?php

require 'Phpautogui.php';

$auto = new Phpautogui();
$auto->press('win');
usleep(0.1 * 1000_000);

$auto->typewrite('notepad.exe', 0.1);
usleep(0.1 * 1000_000);

$auto->press('enter');
usleep(2 * 1000_000);

$auto->typewrite('PHP is the best language.', 0.1);
