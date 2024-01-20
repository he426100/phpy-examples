<?php

/**
 * 翻译自pyautogui_win.py
 */
class Phpautogui
{
    public const MINIMUM_DURATION = 0.1;
    public const MINIMUM_SLEEP = 0.05;
    public const PAUSE = 0.1;
    public const DARWIN_CATCH_UP_TIME = 0.01;

    # Constants for the mouse button names:
    public const LEFT = "left";
    public const MIDDLE = "middle";
    public const RIGHT = "right";
    public const PRIMARY = "primary";
    public const SECONDARY = "secondary";

    public const MOUSEEVENTF_MOVE = 0x0001;
    public const MOUSEEVENTF_LEFTDOWN = 0x0002;
    public const MOUSEEVENTF_LEFTUP = 0x0004;
    public const MOUSEEVENTF_LEFTCLICK = self::MOUSEEVENTF_LEFTDOWN + self::MOUSEEVENTF_LEFTUP;
    public const MOUSEEVENTF_RIGHTDOWN = 0x0008;
    public const MOUSEEVENTF_RIGHTUP = 0x0010;
    public const MOUSEEVENTF_RIGHTCLICK = self::MOUSEEVENTF_RIGHTDOWN + self::MOUSEEVENTF_RIGHTUP;
    public const MOUSEEVENTF_MIDDLEDOWN = 0x0020;
    public const MOUSEEVENTF_MIDDLEUP = 0x0040;
    public const MOUSEEVENTF_MIDDLECLICK = self::MOUSEEVENTF_MIDDLEDOWN + self::MOUSEEVENTF_MIDDLEUP;

    public const MOUSEEVENTF_ABSOLUTE = 0x8000;
    public const MOUSEEVENTF_WHEEL = 0x0800;
    public const MOUSEEVENTF_HWHEEL = 0x01000;

    # Documented here: http://msdn.microsoft.com/en-us/library/windows/desktop/ms646304(v=vs.85).aspx
    public const KEYEVENTF_KEYDOWN = 0x0000; # Technically this constant doesn't exist in the MS documentation. It's the lack of KEYEVENTF_KEYUP that means pressing the key down.
    public const KEYEVENTF_KEYUP = 0x0002;

    # Documented here: http://msdn.microsoft.com/en-us/library/windows/desktop/ms646270(v=vs.85).aspx
    public const INPUT_MOUSE = 0;
    public const INPUT_KEYBOARD = 1;

    # Documented here: https://learn.microsoft.com/en-us/windows/win32/inputdev/virtual-key-codes
    public const VK_LBUTTON = 0x01;
    public const VK_RBUTTON = 0x02;
    public const VK_CANCEL = 0x03;
    public const VK_MBUTTON = 0x04;
    public const VK_XBUTTON1 = 0x05;
    public const VK_XBUTTON2 = 0x06;
    public const VK_BACK = 0x08;
    public const VK_TAB = 0x09;
    public const VK_CLEAR = 0x0C;
    public const VK_RETURN = 0x0D;
    public const VK_SHIFT = 0x10;
    public const VK_CONTROL = 0x11;
    public const VK_MENU = 0x12;
    public const VK_PAUSE = 0x13;
    public const VK_CAPITAL = 0x14;
    public const VK_KANA = 0x15;
    public const VK_HANGUL = 0x15;
    public const VK_IME_ON = 0x16;
    public const VK_JUNJA = 0x17;
    public const VK_FINAL = 0x18;
    public const VK_HANJA = 0x19;
    public const VK_KANJI = 0x19;
    public const VK_IME_OFF = 0x1A;
    public const VK_ESCAPE = 0x1B;
    public const VK_CONVERT = 0x1C;
    public const VK_NONCONVERT = 0x1D;
    public const VK_ACCEPT = 0x1E;
    public const VK_MODECHANGE = 0x1F;
    public const VK_SPACE = 0x20;
    public const VK_PRIOR = 0x21;
    public const VK_NEXT = 0x22;
    public const VK_END = 0x23;
    public const VK_HOME = 0x24;
    public const VK_LEFT = 0x25;
    public const VK_UP = 0x26;
    public const VK_RIGHT = 0x27;
    public const VK_DOWN = 0x28;
    public const VK_SELECT = 0x29;
    public const VK_PRINT = 0x2A;
    public const VK_EXECUTE = 0x2B;
    public const VK_SNAPSHOT = 0x2C;
    public const VK_INSERT = 0x2D;
    public const VK_DELETE = 0x2E;
    public const VK_HELP = 0x2F;
    public const VK_LWIN = 0x5B;
    public const VK_RWIN = 0x5C;
    public const VK_APPS = 0x5D;
    public const VK_SLEEP = 0x5F;
    public const VK_NUMPAD0 = 0x60;
    public const VK_NUMPAD1 = 0x61;
    public const VK_NUMPAD2 = 0x62;
    public const VK_NUMPAD3 = 0x63;
    public const VK_NUMPAD4 = 0x64;
    public const VK_NUMPAD5 = 0x65;
    public const VK_NUMPAD6 = 0x66;
    public const VK_NUMPAD7 = 0x67;
    public const VK_NUMPAD8 = 0x68;
    public const VK_NUMPAD9 = 0x69;
    public const VK_MULTIPLY = 0x6A;
    public const VK_ADD = 0x6B;
    public const VK_SEPARATOR = 0x6C;
    public const VK_SUBTRACT = 0x6D;
    public const VK_DECIMAL = 0x6E;
    public const VK_DIVIDE = 0x6F;
    public const VK_F1 = 0x70;
    public const VK_F2 = 0x71;
    public const VK_F3 = 0x72;
    public const VK_F4 = 0x73;
    public const VK_F5 = 0x74;
    public const VK_F6 = 0x75;
    public const VK_F7 = 0x76;
    public const VK_F8 = 0x77;
    public const VK_F9 = 0x78;
    public const VK_F10 = 0x79;
    public const VK_F11 = 0x7A;
    public const VK_F12 = 0x7B;
    public const VK_F13 = 0x7C;
    public const VK_F14 = 0x7D;
    public const VK_F15 = 0x7E;
    public const VK_F16 = 0x7F;
    public const VK_F17 = 0x80;
    public const VK_F18 = 0x81;
    public const VK_F19 = 0x82;
    public const VK_F20 = 0x83;
    public const VK_F21 = 0x84;
    public const VK_F22 = 0x85;
    public const VK_F23 = 0x86;
    public const VK_F24 = 0x87;
    public const VK_NUMLOCK = 0x90;
    public const VK_SCROLL = 0x91;
    public const VK_LSHIFT = 0xA0;
    public const VK_RSHIFT = 0xA1;
    public const VK_LCONTROL = 0xA2;
    public const VK_RCONTROL = 0xA3;
    public const VK_LMENU = 0xA4;
    public const VK_RMENU = 0xA5;
    public const VK_BROWSER_BACK = 0xA6;
    public const VK_BROWSER_FORWARD = 0xA7;
    public const VK_BROWSER_REFRESH = 0xA8;
    public const VK_BROWSER_STOP = 0xA9;
    public const VK_BROWSER_SEARCH = 0xAA;
    public const VK_BROWSER_FAVORITES = 0xAB;
    public const VK_BROWSER_HOME = 0xAC;
    public const VK_VOLUME_MUTE = 0xAD;
    public const VK_VOLUME_DOWN = 0xAE;
    public const VK_VOLUME_UP = 0xAF;
    public const VK_MEDIA_NEXT_TRACK = 0xB0;
    public const VK_MEDIA_PREV_TRACK = 0xB1;
    public const VK_MEDIA_STOP = 0xB2;
    public const VK_MEDIA_PLAY_PAUSE = 0xB3;
    public const VK_LAUNCH_MAIL = 0xB4;
    public const VK_LAUNCH_MEDIA_SELECT = 0xB5;
    public const VK_LAUNCH_APP1 = 0xB6;
    public const VK_LAUNCH_APP2 = 0xB7;
    public const VK_OEM_1 = 0xBA;
    public const VK_OEM_PLUS = 0xBB;
    public const VK_OEM_COMMA = 0xBC;
    public const VK_OEM_MINUS = 0xBD;
    public const VK_OEM_PERIOD = 0xBE;
    public const VK_OEM_2 = 0xBF;
    public const VK_OEM_3 = 0xC0;
    public const VK_OEM_4 = 0xDB;
    public const VK_OEM_5 = 0xDC;
    public const VK_OEM_6 = 0xDD;
    public const VK_OEM_7 = 0xDE;
    public const VK_OEM_8 = 0xDF;
    public const VK_OEM_102 = 0xE2;
    public const VK_PROCESSKEY = 0xE5;
    public const VK_PACKET = 0xE7;
    public const VK_ATTN = 0xF6;
    public const VK_CRSEL = 0xF7;
    public const VK_EXSEL = 0xF8;
    public const VK_EREOF = 0xF9;
    public const VK_PLAY = 0xFA;
    public const VK_ZOOM = 0xFB;
    public const VK_NONAME = 0xFC;
    public const VK_PA1 = 0xFD;
    public const VK_OEM_CLEAR = 0xFE;

    protected array $keyboardMapping = [
        'backspace' => 0x08, # VK_BACK
        '\b' => 0x08, # VK_BACK
        'super' => 0x5B, #VK_LWIN
        'tab' => 0x09, # VK_TAB
        '\t' => 0x09, # VK_TAB
        'clear' => 0x0c, # VK_CLEAR
        'enter' => 0x0d, # VK_RETURN
        '\n' => 0x0d, # VK_RETURN
        'return' => 0x0d, # VK_RETURN
        'shift' => 0x10, # VK_SHIFT
        'ctrl' => 0x11, # VK_CONTROL
        'alt' => 0x12, # VK_MENU
        'pause' => 0x13, # VK_PAUSE
        'capslock' => 0x14, # VK_CAPITAL
        'kana' => 0x15, # VK_KANA
        'hanguel' => 0x15, # VK_HANGUEL
        'hangul' => 0x15, # VK_HANGUL
        'junja' => 0x17, # VK_JUNJA
        'final' => 0x18, # VK_FINAL
        'hanja' => 0x19, # VK_HANJA
        'kanji' => 0x19, # VK_KANJI
        'esc' => 0x1b, # VK_ESCAPE
        'escape' => 0x1b, # VK_ESCAPE
        'convert' => 0x1c, # VK_CONVERT
        'nonconvert' => 0x1d, # VK_NONCONVERT
        'accept' => 0x1e, # VK_ACCEPT
        'modechange' => 0x1f, # VK_MODECHANGE
        ' ' => 0x20, # VK_SPACE
        'space' => 0x20, # VK_SPACE
        'pgup' => 0x21, # VK_PRIOR
        'pgdn' => 0x22, # VK_NEXT
        'pageup' => 0x21, # VK_PRIOR
        'pagedown' => 0x22, # VK_NEXT
        'end' => 0x23, # VK_END
        'home' => 0x24, # VK_HOME
        'left' => 0x25, # VK_LEFT
        'up' => 0x26, # VK_UP
        'right' => 0x27, # VK_RIGHT
        'down' => 0x28, # VK_DOWN
        'select' => 0x29, # VK_SELECT
        'print' => 0x2a, # VK_PRINT
        'execute' => 0x2b, # VK_EXECUTE
        'prtsc' => 0x2c, # VK_SNAPSHOT
        'prtscr' => 0x2c, # VK_SNAPSHOT
        'prntscrn' => 0x2c, # VK_SNAPSHOT
        'printscreen' => 0x2c, # VK_SNAPSHOT
        'insert' => 0x2d, # VK_INSERT
        'del' => 0x2e, # VK_DELETE
        'delete' => 0x2e, # VK_DELETE
        'help' => 0x2f, # VK_HELP
        'win' => 0x5b, # VK_LWIN
        'winleft' => 0x5b, # VK_LWIN
        'winright' => 0x5c, # VK_RWIN
        'apps' => 0x5d, # VK_APPS
        'sleep' => 0x5f, # VK_SLEEP
        'num0' => 0x60, # VK_NUMPAD0
        'num1' => 0x61, # VK_NUMPAD1
        'num2' => 0x62, # VK_NUMPAD2
        'num3' => 0x63, # VK_NUMPAD3
        'num4' => 0x64, # VK_NUMPAD4
        'num5' => 0x65, # VK_NUMPAD5
        'num6' => 0x66, # VK_NUMPAD6
        'num7' => 0x67, # VK_NUMPAD7
        'num8' => 0x68, # VK_NUMPAD8
        'num9' => 0x69, # VK_NUMPAD9
        'multiply' => 0x6a, # VK_MULTIPLY  ??? Is this the numpad *?
        'add' => 0x6b, # VK_ADD  ??? Is this the numpad +?
        'separator' => 0x6c, # VK_SEPARATOR  ??? Is this the numpad enter?
        'subtract' => 0x6d, # VK_SUBTRACT  ??? Is this the numpad -?
        'decimal' => 0x6e, # VK_DECIMAL
        'divide' => 0x6f, # VK_DIVIDE
        'f1' => 0x70, # VK_F1
        'f2' => 0x71, # VK_F2
        'f3' => 0x72, # VK_F3
        'f4' => 0x73, # VK_F4
        'f5' => 0x74, # VK_F5
        'f6' => 0x75, # VK_F6
        'f7' => 0x76, # VK_F7
        'f8' => 0x77, # VK_F8
        'f9' => 0x78, # VK_F9
        'f10' => 0x79, # VK_F10
        'f11' => 0x7a, # VK_F11
        'f12' => 0x7b, # VK_F12
        'f13' => 0x7c, # VK_F13
        'f14' => 0x7d, # VK_F14
        'f15' => 0x7e, # VK_F15
        'f16' => 0x7f, # VK_F16
        'f17' => 0x80, # VK_F17
        'f18' => 0x81, # VK_F18
        'f19' => 0x82, # VK_F19
        'f20' => 0x83, # VK_F20
        'f21' => 0x84, # VK_F21
        'f22' => 0x85, # VK_F22
        'f23' => 0x86, # VK_F23
        'f24' => 0x87, # VK_F24
        'numlock' => 0x90, # VK_NUMLOCK
        'scrolllock' => 0x91, # VK_SCROLL
        'shiftleft' => 0xa0, # VK_LSHIFT
        'shiftright' => 0xa1, # VK_RSHIFT
        'ctrlleft' => 0xa2, # VK_LCONTROL
        'ctrlright' => 0xa3, # VK_RCONTROL
        'altleft' => 0xa4, # VK_LMENU
        'altright' => 0xa5, # VK_RMENU
        'browserback' => 0xa6, # VK_BROWSER_BACK
        'browserforward' => 0xa7, # VK_BROWSER_FORWARD
        'browserrefresh' => 0xa8, # VK_BROWSER_REFRESH
        'browserstop' => 0xa9, # VK_BROWSER_STOP
        'browsersearch' => 0xaa, # VK_BROWSER_SEARCH
        'browserfavorites' => 0xab, # VK_BROWSER_FAVORITES
        'browserhome' => 0xac, # VK_BROWSER_HOME
        'volumemute' => 0xad, # VK_VOLUME_MUTE
        'volumedown' => 0xae, # VK_VOLUME_DOWN
        'volumeup' => 0xaf, # VK_VOLUME_UP
        'nexttrack' => 0xb0, # VK_MEDIA_NEXT_TRACK
        'prevtrack' => 0xb1, # VK_MEDIA_PREV_TRACK
        'stop' => 0xb2, # VK_MEDIA_STOP
        'playpause' => 0xb3, # VK_MEDIA_PLAY_PAUSE
        'launchmail' => 0xb4, # VK_LAUNCH_MAIL
        'launchmediaselect' => 0xb5, # VK_LAUNCH_MEDIA_SELECT
        'launchapp1' => 0xb6, # VK_LAUNCH_APP1
        'launchapp2' => 0xb7, # VK_LAUNCH_APP2
    ];

    protected $ffi;

    public function __construct()
    {
        # There are other virtual key constants that are not used here because the printable ascii keys are
        # handled in the following `for` loop.
        # The virtual key constants that aren't used are:
        # VK_OEM_1, VK_OEM_PLUS, VK_OEM_COMMA, VK_OEM_MINUS, VK_OEM_PERIOD, VK_OEM_2, VK_OEM_3, VK_OEM_4,
        # VK_OEM_5, VK_OEM_6, VK_OEM_7, VK_OEM_8, VK_PACKET, VK_ATTN, VK_CRSEL, VK_EXSEL, VK_EREOF,
        # VK_PLAY, VK_ZOOM, VK_NONAME, VK_PA1, VK_OEM_CLEAR

        # Populate the basic printable ascii characters.
        # https://docs.microsoft.com/en-us/windows/win32/api/winuser/nf-winuser-vkkeyscana

        # https://learn.microsoft.com/en-us/windows/win32/api/windef/ns-windef-point
        # https://learn.microsoft.com/en-us/windows/win32/api/windef/ns-windef-rect
        # https://learn.microsoft.com/en-us/windows/win32/api/winuser/nf-winuser-getdesktopwindow
        # https://learn.microsoft.com/en-us/windows/win32/api/winuser/nf-winuser-getcursorpos
        # https://learn.microsoft.com/en-us/windows/win32/api/winuser/nf-winuser-getwindowrect

        $this->ffi = FFI::cdef(
            "
            typedef unsigned char BYTE;
            typedef unsigned long ULONG;
            typedef unsigned long DWORD;
            typedef int BOOL;
            typedef unsigned int UINT;
            typedef long LONG;
            typedef unsigned long ULONG_PTR;
            typedef void* HWND;
            typedef char CHAR;
            typedef short SHORT;
            typedef unsigned short wchar_t;
            typedef wchar_t WCHAR;
            typedef void VOID;
        
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

            void keybd_event(
                BYTE bVk, 
                BYTE bScan, 
                DWORD dwFlags, 
                ULONG_PTR dwExtraInfo
            );

            void mouse_event(
                DWORD dwFlags, 
                DWORD dx, 
                DWORD dy, 
                DWORD dwData, 
                ULONG_PTR dwExtraInfo
            );

            HWND GetDesktopWindow();
            BOOL GetCursorPos(POINT *lpPoint);
            BOOL SetCursorPos(int X, int Y);
            BOOL GetWindowRect(HWND hWnd, RECT *lpRect);
            int GetSystemMetrics(int nIndex);
            SHORT VkKeyScanA(CHAR ch);
            ",
            'user32.dll'
        );

        for ($c = 32; $c < 128; $c++) {
            $chr = chr($c);
            $vkCode = $this->ffi->VkKeyScanA($chr);
            if ($vkCode != -1) { // VkKeyScanA返回-1表示无法找到映射
                $this->keyboardMapping[$chr] = $vkCode;
            }
        }
    }

    /**
     * Performs a keyboard key press down, followed by a release.
     * @param string|array $keys The key to be pressed. The valid names are listed in KEYBOARD_KEYS, Can also be a list of such strings.
     * @param int $presses The number of press repetitions. 1 by default, for just one press.
     * @param float $interval How many seconds between each press. 0.0 by default, for no pause between presses.
     * @return void 
     */
    public function press($keys, $presses = 1, $interval = 0.0)
    {
        $keys = array_map(fn ($e) => [$e, strtolower($e)][strlen($e) > 1], (array)$keys);
        for ($i = 0; $i < $presses; $i++) {
            foreach ($keys as $k) {
                $this->keyDown($k);
                $this->keyUp($k);
            }
            usleep($interval * 1_000_000);
        }
    }

    /**
     * Performs a keyboard key press down, followed by a release, for each of the characters in message.
     * @param string|array $message If a string, then the characters to be pressed. If a list, then the key names of the keys to press in order. The valid names are listed in KEYBOARD_KEYS
     * @param float $interval The number of seconds in between each press. 0.0 by default, for no pause in between presses.
     * @return void 
     */
    public function typewrite($message, $interval = 0.0)
    {
        foreach (str_split($message) as $key) {
            if (strlen($key) > 1) {
                $key = strtolower($key);
            }
            $this->press($key);
            usleep($interval * 1000_000);
        }
    }

    /**
     * Performs a keyboard key press without the release. This will put that
     * key in a held down state.
     * NOTE: For some reason, this does not seem to cause key repeats like would
     * happen if a keyboard key was held down on a text field.
     * @param string $key The key to be pressed down. The valid names are listed in KEY_NAMES.
     * @return void 
     */
    public function keyDown($key)
    {
        if (!isset($this->keyboardMapping[$key])) {
            return;
        }

        $needsShift = $this->isShiftCharacter($key);
        $divmod = fn ($x, $y) => [($x - ($x % $y)) / $y, $x % $y];
        [$mods, $vkCode] = $divmod($this->keyboardMapping[$key], 0x100);

        // #HANKAKU not supported! mods & 8
        $vk_mods = [
            [$mods & 4, 0x12],
            [$mods & 2, 0x11],
            [$mods & 1 || $needsShift, 0x10],
        ];
        foreach ($vk_mods as [$apply_mod, $vk_mod]) {
            if ($apply_mod) {
                $this->ffi->keybd_event($vk_mod, 0, self::KEYEVENTF_KEYDOWN, 0);
            }
        }
        $this->ffi->keybd_event($vkCode, 0, self::KEYEVENTF_KEYDOWN, 0);

        $vk_mods = [
            [$mods & 1 || $needsShift, 0x10],
            [$mods & 2, 0x11],
            [$mods & 4, 0x12]
        ];
        foreach ($vk_mods as [$apply_mod, $vk_modifier]) {
            if ($apply_mod) {
                $this->ffi->keybd_event($vk_modifier, 0, self::KEYEVENTF_KEYUP, 0);
            }
        }
    }

    /**
     * Performs a keyboard key release (without the press down beforehand).
     * @param string $key The key to be released up. The valid names are listed in KEY_NAMES.
     * @return void 
     */
    public function keyUp($key)
    {
        if (!isset($this->keyboardMapping[$key])) {
            return;
        }

        $needsShift = $this->isShiftCharacter($key);
        $divmod = fn ($x, $y) => [($x - ($x % $y)) / $y, $x % $y];
        [$mods, $vkCode] = $divmod($this->keyboardMapping[$key], 0x100);

        // #HANKAKU not supported! mods & 8
        $vk_mods = [
            [$mods & 4, 0x12],
            [$mods & 2, 0x11],
            [$mods & 1 || $needsShift, 0x10],
        ];
        foreach ($vk_mods as [$apply_mod, $vk_mod]) {
            if ($apply_mod) {
                $this->ffi->keybd_event($vk_mod, 0, self::KEYEVENTF_KEYDOWN, 0);
            }
        }
        $this->ffi->keybd_event($vkCode, 0, self::KEYEVENTF_KEYUP, 0);

        $vk_mods = [
            [$mods & 1 || $needsShift, 0x10],
            [$mods & 2, 0x11],
            [$mods & 4, 0x12]
        ];
        foreach ($vk_mods as [$apply_mod, $vk_modifier]) {
            if ($apply_mod) {
                $this->ffi->keybd_event($vk_modifier, 0, self::KEYEVENTF_KEYUP, 0);
            }
        }
    }

    public function position($x = null, $y = null)
    {
        [$posx, $posy] = $this->getCursorPos();
        if (isset($x)) {  # If set, the x parameter overrides the return value.
            $posx = ($x);
        }
        if (isset($y)) {  # If set, the y parameter overrides the return value.
            $posy = ($y);
        }
        return ['x' => (int)$posx, 'y' => (int)$posy];
    }

    public function size()
    {
        [$width, $height] = $this->getScreenSize();
        return ['width' => (int)$width, 'height' => (int)$height];
    }

    public function resolution()
    {
        return $this->size();
    }

    public function onScreen($x, $y = null)
    {
        [$x, $y] = $this->normalizeXYArgs($x, $y);
        [$width, $height] = $this->getScreenSize();
        return ($x >= 0 && $x < $width && $y >= 0 && $y < $height);
    }

    public function mouseDown($x, $y, $button = self::PRIMARY, $duration = 0.0)
    {
        $button = $this->normalizeButton($button);
        [$x, $y] = $this->normalizeXYArgs($x, $y);
        $this->setCursorPos($x, $y);
        $this->sendMouseDown($x, $y, $button);
    }

    public function normalizeXYArgs($x, $y)
    {
        if (!isset($x) && !isset($y)) {
            return $this->position();
        }
        if (!isset($x) && isset($y)) {
            return ['x' => $this->position()['x'], 'y' => (int)$y];
        }
        if (isset($x) && !isset($y)) {
            return ['x' => (int)$x, 'y' => $this->position()['y']];
        }
        if (is_array($x)) {
            $x = array_values($x);
            return ['x' => (int)$x[0], 'y' => (int)$x[1]]; 
        }
        return ['x' => (int)$x, 'y' => (int)$y];
    }

    public function normalizeButton($button)
    {
        $button = strtolower($button);
        if (!in_array($button, [self::LEFT, self::MIDDLE, self::RIGHT, self::PRIMARY, self::SECONDARY, 1, 2, 3])) {
            throw new InvalidArgumentException("button argument must be one of ('left', 'middle', 'right', 'primary', 'secondary', 1, 2, 3)");
        }
        if (in_array($button, [self::PRIMARY, self::SECONDARY])) {
            return $this->mouseIsSwapped() ? [self::LEFT, self::RIGHT][$button == self::PRIMARY]
                : [self::RIGHT, self::LEFT][$button == self::PRIMARY];
        }
        return [
            self::LEFT => self::LEFT,
            self::MIDDLE => self::MIDDLE,
            self::RIGHT => self::RIGHT,
            1 => self::LEFT,
            2 => self::MIDDLE,
            3 => self::RIGHT,
        ][$button];
    }

    public function getCursorPos()
    {
        $point = $this->ffi->new("POINT");
        $this->ffi->GetCursorPos(FFI::addr($point));

        return [$point->x, $point->y];
    }

    public function getScreenSize()
    {
        return [
            $this->ffi->GetSystemMetrics(0),
            $this->ffi->GetSystemMetrics(1)
        ];
    }

    public function setCursorPos($x, $y)
    {
        // 设置鼠标位置
        $this->ffi->SetCursorPos($x, $y);
    }

    /**
     * Send the mouse down event to Windows by calling the mouse_event() win32 function.
     * @param int $x The x position of the mouse event.
     * @param int $y The y position of the mouse event.
     * @param string $button The mouse button, either 'left', 'middle', or 'right'
     * @return void 
     */
    public function sendMouseDown($x, $y, $button)
    {
        if (!in_array($button, [self::LEFT, self::MIDDLE, self::RIGHT])) {
            throw new \Exception('button arg to _click() must be one of "left", "middle", or "right", not ', $button);
        }
        $EV = match ($button) {
            self::LEFT => self::MOUSEEVENTF_LEFTDOWN,
            self::MIDDLE => self::MOUSEEVENTF_MIDDLEDOWN,
            self::RIGHT => self::MOUSEEVENTF_RIGHTDOWN,
        };
        $this->sendMouseEvent($EV, $x, $y);
    }

    /**
     * Send the mouse up event to Windows by calling the mouse_event() win32 function.
     * @param int $x The x position of the mouse event.
     * @param int $y The y position of the mouse event.
     * @param string $button The mouse button, either 'left', 'middle', or 'right'
     * @return void 
     */
    public function sendMouseUp($x, $y, $button)
    {
        if (!in_array($button, [self::LEFT, self::MIDDLE, self::RIGHT])) {
            throw new \Exception('button arg to _click() must be one of "left", "middle", or "right", not ', $button);
        }
        $EV = match ($button) {
            self::LEFT => self::MOUSEEVENTF_LEFTUP,
            self::MIDDLE => self::MOUSEEVENTF_MIDDLEUP,
            self::RIGHT => self::MOUSEEVENTF_RIGHTUP,
        };
        $this->sendMouseEvent($EV, $x, $y);
    }

    /**
     * Send the mouse click event to Windows by calling the mouse_event() win32 function.
     * @param int $x The x position of the mouse event.
     * @param int $y The y position of the mouse event.
     * @param string $button The mouse button, either 'left', 'middle', or 'right'
     * @return void 
     */
    public function sendClick($x, $y, $button)
    {
        if (!in_array($button, [self::LEFT, self::MIDDLE, self::RIGHT])) {
            throw new \Exception('button arg to _click() must be one of "left", "middle", or "right", not ', $button);
        }
        $EV = match ($button) {
            self::LEFT => self::MOUSEEVENTF_LEFTCLICK,
            self::MIDDLE => self::MOUSEEVENTF_MIDDLECLICK,
            self::RIGHT => self::MOUSEEVENTF_RIGHTCLICK,
        };
        $this->sendMouseEvent($EV, $x, $y);
    }

    public function mouseIsSwapped()
    {
        # 23 is SM_SWAPBUTTON: "Nonzero if the meanings of the left and right mouse buttons are swapped; otherwise, 0."
        return $this->ffi->GetSystemMetrics(23) != 0;
    }

    /**
     * The helper function that actually makes the call to the mouse_event() win32 function.
     * @param int $ev The win32 code for the mouse event. Use one of the MOUSEEVENTF_* constants for this argument.
     * @param int $x The x position of the mouse event.
     * @param int $y The y position of the mouse event.
     * @param int $dwData The argument for mouse_event()'s dwData parameter. So far this is only used by mouse scrolling.
     * @return void 
     */
    public function sendMouseEvent($ev, $x, $y, $dwData = 0)
    {
        assert(isset($x) && isset($y), 'x and y cannot be set to None');

        [$width, $height] = $this->getScreenSize();
        $convertedX = 65536 * $x; // width + 1
        $convertedY = 65536 * $y; // height + 1
        $this->ffi->mouse_event($ev, $convertedX, $convertedY, $dwData, 0);
    }

    /**
     * Send the mouse vertical scroll event to Windows by calling the mouse_event() win32 function.
     * @param int $clicks The amount of scrolling to do. A positive value is the mouse wheel moving forward (scrolling up), a negative value is backwards (down).
     * @param int $x The x position of the mouse event.
     * @param int $y The y position of the mouse event.
     * @return void 
     */
    public function sendScroll($clicks, $x = null, $y = null)
    {
        [$startx, $starty] = $this->getCursorPos();
        [$width, $height] = $this->getScreenSize();

        if (!isset($x)) {
            $x = $startx;
        } else {
            if ($x < 0) {
                $x = 0;
            } elseif ($x >= $width) {
                $x = $width - 1;
            }
        }
        if (!isset($y)) {
            $y = $starty;
        } else {
            if ($y < 0) {
                $y = 0;
            } elseif ($y >= $height) {
                $y = $height - 1;
            }
        }
        $this->sendMouseEvent(self::MOUSEEVENTF_WHEEL, $x, $y, dwData: $clicks);
    }

    /**
     * A wrapper for _scroll(), which does horizontal scrolling.
     * @param int $clicks 
     * @param int $x 
     * @param int $y 
     * @return void 
     */
    public function sendHscroll($clicks, $x, $y)
    {
        return $this->sendScroll($clicks, $x, $y);
    }

    /**
     * A wrapper for _scroll(), which does vertical scrolling.
     * @param int $clicks 
     * @param int $x 
     * @param int $y 
     * @return void 
     */
    public function sendVscroll($clicks, $x, $y)
    {
        return $this->sendScroll($clicks, $x, $y);
    }

    public function ffi()
    {
        return $this->ffi;
    }

    /**
     * Returns True if the ``character`` is a keyboard key that would require the shift key to be held down, such as
     * uppercase letters or the symbols on the keyboard's number row.
     * @param string $char 
     * @return bool 
     */
    public function isShiftCharacter($char)
    {
        # NOTE TODO - This will be different for non-qwerty keyboards.
        return ctype_upper($char) || in_array($char, str_split('~!@#$%^&*()_+{}|:"<>?'));
    }
}
