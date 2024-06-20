<?php

echo PyCore::fileno(STDOUT), PHP_EOL;
echo PyCore::import('sys')->stdout->fileno(), PHP_EOL;
