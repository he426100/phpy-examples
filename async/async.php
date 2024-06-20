<?php

$asyncio = PyCore::import('asyncio');
$time = PyCore::import('time');

function main($loop)
{
    global $asyncio, $time;

    PyCore::print("started at ", $time->strftime('%X'));

    $future1 = $loop->create_future();
    $asyncio->ensure_future($asyncio->sleep(1), loop: $loop)->add_done_callback(fn ($fut) => $future1->set_result(null));
    $future1->add_done_callback(fn($fut) => PyCore::print('hello'));

    $future2 = $loop->create_future();
    $asyncio->ensure_future($asyncio->sleep(2), loop: $loop)->add_done_callback(fn ($fut) => $future2->set_result(null));
    $future2->add_done_callback(fn($fut) => PyCore::print('world'));

    $loop->call_later(3, function () use ($time, $loop, $future1, $future2) {
        if ($future1->done() && $future2->done()) {
            PyCore::print("finished at ", $time->strftime('%X'));
            $loop->stop();
        }
    });
}

$loop = $asyncio->get_event_loop();
try {
    main($loop);
    $loop->run_forever();
} catch (\Throwable $e) {
    echo $e->getMessage(), PHP_EOL;
} finally {
    $loop->close();
}
