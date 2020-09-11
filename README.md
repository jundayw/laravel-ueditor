# 安装方法
命令行下, 执行 composer 命令安装:
````
composer require jundayw/laravel-ueditor
````

# 参考
https://github.com/overtrue/laravel-ueditor

# 使用方法
authentication package that is simple and enjoyable to use.

# 方法
导出配置信息
````
php artisan vendor:publish --tag=ueditor-config
````
导出 ueditor 资源文件
````
php artisan vendor:publish --tag=ueditor-assets
````
导出视图文件
````
php artisan vendor:publish --tag=ueditor-views
````
导出语言包
````
php artisan vendor:publish --tag=ueditor-lang
````
视图调用
````
@component('components.ueditor')
    @slot('name','content')
    @slot('width','100%')
    @slot('height','480px')
    默认值
@endcomponent
````
或者
````
@component('components.ueditor',['name' => 'content'])
    默认值
@endcomponent
````