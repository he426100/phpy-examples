<?php

$request = PyCore::import('requests');
$response = $request->get('https://httpbin.org/get');
PyCore::print($response->text);
