@extends('admin/common/master')
@section('title','显示用户')
@section('class','body')
@section('content')
<blockquote class="layui-elem-quote layui-text">
    根据手机号码即可查询到该用户的信息
</blockquote>
<!-- 工具集 -->
<div class="my-btn-box">
    <span class="fl">
    	<a class="layui-btn btn-add btn-default" id="btn-check">点击刷新数量<span class="layui-badge layui-bg-orange">{{@$count}}</span></a>
        
    </span>
    <span class="fr">
        <span class="layui-form-label">搜索号码：</span>
        <div class="layui-input-inline">
            <input type="text" autocomplete="off" placeholder="请输入搜索号码" class="layui-input" value="">
        </div>
        <button class="layui-btn mgl-20 search">查询</button>
    </span>
</div>
<fieldset class="layui-elem-field layui-field-title" >
    <legend>用户展示区</legend>
</fieldset>
<table class="layui-table" lay-even lay-skin="line">
	<colgroup>
		<col width="50">
		<col>
		<col>
		<col>
		<col>
		<col>
        <col>
		<col>
		<col width="200">
		<col width="200">
	</colgroup>
	<thead>
		<tr>
			<th>ID</th>
			<th>账号</th>
			<th>密码</th>
			<th>手机号码</th>
			<th>提款密码</th>
			<th>余额</th>
            <th>登入链接</th>
			<th>备注</th>
			<th>创建时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<!-- 数据存放区 -->
	</tbody>
</table>
@endsection
@section('my-js')
<script type="text/javascript">

    // layui方法
    layui.use(['table', 'form', 'layer'], function () {

        // 操作对象
        var form = layui.form
                , layer = layui.layer
                , $ = layui.jquery;

        //搜索功能
        $('.search').click(function(){
        	var keyword = $('input[type="text"]').val();
        	//ajax
        	console.log(keyword);
        	$.ajax({
        		url:'{{url("/user/search")}}',
        		data:{keyword:keyword},
        		dataType:'json',
        		type:'post',
        		headers:{
        			'X-CSRF-TOKEN':'{{csrf_token()}}'
        		},
        		success:function(data){
        			$('tbody').html('');
        			if(data.code ==1){
        				//有数据
        				$('tbody').append(data.data);
        			}else if(data.code == 0){
        				layer.msg('无数据');
        			}
        		}
        	})
        })

        // 编辑用户
        $('tbody').on('click','.go-btn',function(){
        	var u_id = $(this).attr('data-id');
        	var _this = $(this);
        	var index = layer.open({
		      type: 2,
		      title: '用户编辑',
		      shadeClose: true,
		      shade: false,
		      maxmin: true, //开启最大化最小化按钮
		     
		      content: '{{url("/user/edit")}}'+'/'+u_id
		    });
		    layer.full(index);
        })

        //删除用户
        $('tbody').on('click','.del-btn',function(){
        	var u_id = $(this).attr('data-id');
        	var _this = $(this);
        	//ajax
        	$.ajax({
        		url:'{{url("/user/destroy")}}',
        		data:{u_id:u_id},
        		dataType:'json',
        		type:'post',
        		headers:{
        			'X-CSRF-TOKEN':'{{csrf_token()}}'
        		},
        		success:function(data){
        			if(data.code == 1){
        				_this.parent().parent().parent().remove();
        			}
        		}
        	})
        })

        //刷新
        $('#btn-check').click(function(){
        	window.location.reload();
        });
    });
</script>
@endsection