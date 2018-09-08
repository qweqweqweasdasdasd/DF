@extends('admin/common/master')
@section('title','用户编辑')
@section('class','body')
@section('content')
<form class="layui-form">
	<input type="hidden" name="u_id" value="{{$info->u_id}}">
    <div class="layui-form-item">
        <label class="layui-form-label">用户账号(disabled)</label>
        <div class="layui-input-block">
            <input type="text" name="username" placeholder="请输入用户账号" disabled class="layui-input" value="{{$info->username}}">
        </div>
    </div>
   	<div class="layui-form-item">
        <label class="layui-form-label">密码(disabled)</label>
        <div class="layui-input-block">
            <input type="text" name="password" placeholder="请输入密码" disabled class="layui-input" value="{{$info->password}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">手机号码</label>
        <div class="layui-input-block">
            <input type="text" name="tel" placeholder="请输入手机号码" class="layui-input" value="{{$info->tel}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">提款密码(disabled)</label>
        <div class="layui-input-block">
            <input type="text" name="tpasspwd" placeholder="请输入提款密码" disabled class="layui-input" value="{{$info->tpasspwd}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">余额</label>
        <div class="layui-input-block">
            <input type="text" name="sum" placeholder="请输入余额" class="layui-input" value="{{$info->sum}}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">登入连接</label>
        <div class="layui-input-block">
            <input type="text" name="link" placeholder="请输入登录链接" class="layui-input" value="{{$info->link}}">
        </div>
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">备注</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入需要备注的内容" class="layui-textarea" name="desc">{{$info->desc}}</textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
        </div>
    </div>
</form>
@endsection
@section('my-js')
<script>
    layui.use(['layer','form'], function(){
        var $ = layui.$
        	,form = layui.form
            ,layer = layui.layer;


        //监听提交
        form.on('submit(demo1)', function(data){
        	var u_id = $('input[name="username"]').val();
        	//ajax
        	$.ajax({
        		url:'{{url("/user/update")}}',
        		data:data.field,
        		type:'post',
        		dataType:'json',
        		headers:{
        			'X-CSRF-TOKEN':'{{csrf_token()}}'
        		},
        		success:function(data){
        			if(data.code == 1){
        				parent.window.location.href = parent.window.location.href;
        			}
        		}
        	})
            return false;
        });


    });
</script>
@endsection