<?php

namespace python {

    use PyCore;
    use PyModule;

    if (!function_exists('py')) {
        /**
         * 返回builtins
         * @return PyModule 
         */
        function py(): PyModule
        {
            return PyCore::import('builtins');
        }
    }

    if (!function_exists('import')) {
        /**
         * 批量导入python模块，可搭配extract使用
         * @param string|array $names 
         * @return array 
         */
        function import(string|array $names): array
        {
            if (is_string($names)) {
                $names = explode(',', $names);
            }
            return array_merge(...array_map(fn ($name, $alias) => [$alias => PyCore::import(is_int($name) ? $alias : $name)], array_keys($names), $names));
        }
    }

    if (!function_exists('import_sub')) {
        /**
         * 批量导入python模块，可搭配extract使用
         * @param mixed $name 
         * @param string|array $subs 
         * @return array 
         */
        function import_sub($name, string|array $subs): array
        {
            if (is_string($subs)) {
                $subs = explode(',', $subs);
            }
            $module = PyCore::import($name);
            return array_merge(...array_map(fn ($e) => [$e => $module->$e], $subs));
        }
    }
}

namespace modelscope {

    use PyCore;

    if (!function_exists('snapshot_download')) {
        /**
         * 使用ModelScope Library Hub下载模型
         * @param string $model 
         * @return string 
         */
        function snapshot_download(string $model): string
        {
            $snapshot_download = PyCore::import('modelscope.hub.snapshot_download')->snapshot_download;
            return $snapshot_download($model, cache_dir: getenv('MS_CACHE') ?: null);
        }
    }
}

namespace {

    use function modelscope\snapshot_download;

    if (!function_exists('ms_snapshot')) {
        /**
         * 使用ModelScope Library Hub下载模型
         * @param string $model 
         * @return string 
         */
        function ms_snapshot(string $model): string
        {
            return snapshot_download($model);
        }
    }
}
