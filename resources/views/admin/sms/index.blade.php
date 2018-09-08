@extends('admin/common/master')
@section('title','激活用户列表')
@section('class','body')
@section('content')
<link rel="stylesheet" type="text/css" href="/admin/page.css">
<blockquote class="layui-elem-quote layui-text">
    用户激活列表: 搜索可以使用手机号码和会员账号
</blockquote>
<form class="layui-form" action="">
	<!-- 工具集 -->
	<div class="my-btn-box">
	    <span class="fl">
	        <a class="layui-btn btn-add btn-default" id="btn-refresh"><i class="layui-icon">&#x1002;</i>点击刷新一下</a>
	    </span>
	    <span class="fr">
	        <span class="layui-form-label">搜索条件：</span>
	        <div class="layui-input-inline">
	            <input type="text" autocomplete="off" placeholder="请输入手机或者账号" class="layui-input" value="{{@$keyword}}" name="keyword">
	        </div>
	        <button class="layui-btn mgl-20 search">查询</button>
	    </span>
	</div>
</form>
<table class="layui-table" lay-even lay-skin="line">
	<colgroup>
		<col width="50">
		<col>
		<col>
		<col>
		<col>
		<col>
		<col width="150">
	</colgroup>
	<thead>
		<tr>
			<th>ID</th>
			<th>会员账号</th>
			<th>手机号码(验证)</th>
			<th>短信验证</th>
			<th>点击次数</th>
			<th>激活时间</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $v)
		<tr>
			<td>{{$v->s_id}}</td>
			<td>{{$v->username}}</td>
			<td>{{$v->tel}}</td>
			<td>{{$v->s_message}}</td>
			<td>{{$v->s_count}}</td>
			<td>{{$v->created_at}}</td>
			@if($v->is_activate == 1)
			<td><button class="layui-btn layui-btn-mini layui-btn-warm table-list-status" >激活</button></td>
			@else
			<td><button class="layui-btn layui-btn-mini layui-btn-warm table-list" >未激活</button></td>
			@endif
			<td>
				<div class="layui-inline">
					
					<button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="{{$v->s_id}}" >
					<i class="layui-icon">&#xe640;</i>删除</button>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<span class="fr">
	{{ $data->appends('keyword')->links() }}
</span>
@endsection
@section('my-js')
<script>
    layui.use(['form', 'layedit'], function(){
        var form = layui.form
                ,layer = layui.layer
                ,layedit = layui.layedit
                ,$ = layui.$;

        //刷新
        $('#btn-refresh').click(function(){
        	window.location.reload();
        })

        //删除
        $('.del-btn').click(function(){
        	var s_id = $(this).attr('data-id');
        	var _this = $(this);
        	//ajax
        	$.ajax({
        		url:'{{url("/sms/destroy")}}',
        		data:{s_id:s_id},
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


        
       //搜索
      /* $('.search').click(function(evt){
       	evt.preventDefault();
       	var keyword = $('input[type="text"]').val();
       		//ajax
        	$.ajax({
        		url:'{{url("/sms/search")}}',
        		data:{keyword:keyword},
        		dataType:'json',
        		type:'post',
        		headers:{
        			'X-CSRF-TOKEN':'{{csrf_token()}}'
        		},
        		success:function(data){
        			if(data.code == 1){
        				
        			}
        		}
        	})
       })*/
    });
</script>
@endsection