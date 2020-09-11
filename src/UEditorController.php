<?php

namespace Jundayw\LaravelUEditor;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class UEditorController.
 */
class UEditorController extends Controller
{
    public function upload(Request $request)
    {
        $storage = app('ueditor.storage');
        $config  = config('ueditor.upload');

        switch ($request->get('action')) {
            // 配置
            case 'config':
                return config('ueditor.upload');
            // 列出指定目录下的图片
            case $config['imageManagerActionName']:
                return $storage->listFiles(
                    $config['imageManagerListPath'],
                    $request->get('start'),
                    $request->get('size'),
                    $config['imageManagerAllowFiles']);
            // 列出指定目录下的文件
            case $config['fileManagerActionName']:
                return $storage->listFiles(
                    $config['fileManagerListPath'],
                    $request->get('start'),
                    $request->get('size'),
                    $config['fileManagerAllowFiles']);
            // 抓取远程图片配置
            case $config['catcherActionName']:
                return $storage->fetch($request);
            default:
                return $storage->upload($request);
        }
    }
}
