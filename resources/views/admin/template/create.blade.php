@extends('admin/common/master')
@section('title','模板添加')
@section('class','body')
@section('content')
<form class="layui-form" >
    <div class="layui-form-item">
        <label class="layui-form-label">模板标题</label>
        <div class="layui-input-block">
            <input type="text" name="title"  placeholder="请输入模板标题" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">客服连接</label>
        <div class="layui-input-block">
            <input type="text" name="kfline"  placeholder="请输入客服连接"  class="layui-input">
        </div>
    </div>
 	<div class="layui-form-item">
        <label class="layui-form-label">App地址</label>
        <div class="layui-input-block">
            <input type="text" name="appload"  placeholder="请输入App地址"  class="layui-input">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">游戏规则</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入游戏规则" name="gamedesc" class="layui-textarea"></textarea>
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">活动描述</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入活动描述" name="hdesc" class="layui-textarea"></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
@endsection
@section('my-js')
<script>
    layui.use(['form', 'layedit', 'laydate'], function(){
        var form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit
                ,$ = layui.$;

      
        //监听提交
        form.on('submit(demo1)', function(data){
        	//ajax
        	$.ajax({
        		url:'{{url("/template/store")}}',
        		data:data.field,
        		dataType:'json',
        		type:'post',
        		headers:{
        			'X-CSRF-TOKEN':'{{csrf_token()}}'
        		},
        		success:function(data){
        			if(data.code == 1){
        				layer.alert('添加成功',function(){
        					parent.window.location.href = parent.window.location.href;
        				})
        			}
        		},
        		error:function(jqXHR, textStatus, errorThrown){
        			var msg = '';
        			$.each(jqXHR.responseJSON,function(i,n){
        				msg += n;
        			});
        			if(msg != ''){
        				layer.msg(msg);
        			}
        		}
        	})
  
            return false;
        });


    });
</script>
@endsection