@foreach(['ueditor.config.js','ueditor.all.min.js','lang/zh-cn/zh-cn.js'] as $file)
    <script type="text/javascript" src="{{ config('ueditor.assets') }}{{ $file }}"></script>
@endforeach
<!--style给定宽度可以影响编辑器的最终宽度-->
<script type="text/plain"
        id="{{ $name ?? 'content' }}"
        name="{{ $name ?? 'content' }}"
        style="width:{{ $width ?? '100%' }};height:{{ $height ?? '480px' }};">{{ $slot }}</script>
<script type="text/javascript">
    var ueditor = UE.getEditor("{{ $name ?? 'content' }}", {
        serverUrl: '{{ route(config('ueditor.route.as')) }}'
    });
    ueditor.ready(function () {
        ueditor.execCommand('serverparam', '_token', $('meta[name="csrf-token"]').attr('content'));
    });
    //console.log(ueditor.options.serverUrl);
</script>