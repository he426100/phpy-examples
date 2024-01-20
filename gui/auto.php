<?php

// @link https://learn.microsoft.com/en-us/windows/win32/api/windef/ns-windef-point
// @link https://learn.microsoft.com/en-us/windows/win32/api/windef/ns-windef-rect
// @link https://learn.microsoft.com/en-us/windows/win32/api/winuser/nf-winuser-getdesktopwindow
// @link https://learn.microsoft.com/en-us/windows/win32/api/winuser/nf-winuser-getcursorpos
// @link https://learn.microsoft.com/en-us/windows/win32/api/winuser/nf-winuser-getwindowrect
$ffi = FFI::cdef(
    "
    typedef int BOOL;
    typedef unsigned int UINT;
    typedef unsigned long DWORD;
    typedef long LONG;
    typedef unsigned char BYTE;
    typedef unsigned int UINT;
    typedef unsigned long ULONG_PTR;
    typedef void* HWND;

    typedef struct tagRECT {
        LONG left;
        LONG top;
        LONG right;
        LONG bottom;
    } RECT, *PRECT, *NPRECT, *LPRECT;

    typedef struct tagPOINT {
        LONG x;
        LONG y;
    } POINT, *PPOINT, *NPPOINT, *LPPOINT;

    HWND GetDesktopWindow();
    BOOL GetCursorPos(POINT *lpPoint);
    BOOL SetCursorPos(int X, int Y);
    BOOL GetWindowRect(HWND hWnd, RECT *lpRect);
    int GetSystemMetrics(int nIndex);

    void keybd_event(
        BYTE bVk, 
        BYTE bScan, 
        DWORD dwFlags, 
        DWORD dwExtraInfo
    );
    void mouse_event(
        DWORD dwFlags, 
        DWORD dx, 
        DWORD dy, 
        DWORD dwData, 
        ULONG_PTR dwExtraInfo
    );
    ",
    'user32.dll'
);

// 获取屏幕分辨率
function screenSize()
{
    global $ffi;

    $hWnd = $ffi->GetDesktopWindow();
    $rect = $ffi->new("RECT"); // 创建 RECT 结构的实例
    $ffi->GetWindowRect($hWnd, FFI::addr($rect)); // 传递 RECT 结构的指针

    return ["width" => $rect->right - $rect->left, "height" => $rect->bottom - $rect->top];
}

// 获取鼠标位置
function mousePosition()
{
    global $ffi;

    $point = $ffi->new("POINT");
    $ffi->GetCursorPos(FFI::addr($point));

    return ["x" => $point->x, "y" => $point->y];
}

// 定义移动鼠标的函数
function moveTo($x, $y)
{
    global $ffi;

    // 设置鼠标位置
    $ffi->SetCursorPos($x, $y);
}

// 模拟 Python 代码中的 _keyDown 函数，接受字符作为输入
function _keyDown($char) {
    global $ffi;
    $vkCode = ord(strtolower($char)); // 获取小写字母的 ASCII 值
    if ($vkCode >= ord('a') &&$vkCode <= ord('z')) {
        $vkCode -= ord('a') - 0x41; // 将 ASCII 值转换为虚拟键码
    } elseif ($vkCode >= ord('0') &&$vkCode <= ord('9')) {
        $vkCode += ord('0') - 0x30; // 将 ASCII 值转换为虚拟键码
    }
    // 按下键
    $ffi->keybd_event($vkCode, 0, 0x0000, 0);
}

// 模拟 Python 代码中的 _keyUp 函数，接受字符作为输入
function _keyUp($char) {
    global $ffi;
    $vkCode = ord(strtolower($char)); // 获取小写字母的 ASCII 值
    if ($vkCode >= ord('a') &&$vkCode <= ord('z')) {
        $vkCode -= ord('a') - 0x41; // 将 ASCII 值转换为虚拟键码
    } elseif ($vkCode >= ord('0') &&$vkCode <= ord('9')) {
        $vkCode += ord('0') - 0x30; // 将 ASCII 值转换为虚拟键码
    }
    // 释放键
    $ffi->keybd_event($vkCode, 0, 0x0002, 0);
}

function write(string $input, float $interval)
{
    foreach (str_split($input) as $key) {
        _keyDown($key);
        _keyUp($key);
        usleep($interval * 1000_000);
    }
}

// 模拟按下 Windows 键
function pressWindowsKey() {
    global $ffi;
    $vkCode = 0x5B; // Windows 键的虚拟键码
    // 按下键
    $ffi->keybd_event($vkCode, 0, 0x0000, 0);
    // 释放键
    $ffi->keybd_event($vkCode, 0, 0x0002, 0);
}

// 模拟按下 Windows 键
pressWindowsKey();
usleep(0.1 * 1000_000);
write('notepad.exe', 0.5);
