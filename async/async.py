import asyncio

def wget(host):
    print('wget %s...' % host)
    # 正确引用 asyncio.open_connection()
    connect = yield from asyncio.open_connection(host, 80)
    reader, writer = connect
    header = 'GET / HTTP/1.0\r\nHost: %s\r\n\r\n' % host
    writer.write(header.encode('utf-8'))
    yield from writer.drain()

    while True:
        line = yield from reader.readline()
        if line == b'\r\n':
            break
        print('%s header > %s' % (host, line.decode('utf-8').rstrip()))

    # 忽略主体，关闭套接字
    writer.close()

# 创建并运行任务
loop = asyncio.get_event_loop()
tasks = [asyncio.Task(wget(host)) for host in ['www.sina.com.cn', 'www.sohu.com', 'www.163.com']]
try:
    # 运行直到完成所有任务
    loop.run_until_complete(asyncio.wait(tasks))
finally:
    # 关闭事件循环
    loop.close()