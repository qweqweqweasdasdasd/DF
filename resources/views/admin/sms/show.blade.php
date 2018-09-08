@extends('admin/common/master')
@section('title','激活用户列表')
@section('class','body')
@section('content')
<link rel="stylesheet" type="text/css" href="/admin/page.css">
<blockquote class="layui-elem-quote layui-text">
    导出数据建议日期不要太长:建议一周的时间
</blockquote>
<form class="layui-form" action="#">
	<!-- 工具集 -->
	<div class="my-btn-box">
	    <span class="fl">
	        <div class="layui-inline">
		      <label class="layui-form-label">日期范围</label>
		      <div class="layui-input-inline" style="width: 300px;">
		        <input type="text" class="layui-input" id="test6" placeholder="点击选择日期段"  value="">
		      </div>
		    </div>
		    <button class="layui-btn mgl-20 export">数据导出</button>
	    </span>
	   <!--  <span class="fr">
	        <span class="layui-form-label">搜索条件：</span>
	        <div class="layui-input-inline">
	            <input type="text" autocomplete="off" placeholder="请输入手机或者账号" class="layui-input" value="" name="keyword">
	        </div>
	        <button class="layui-btn mgl-20 search">查询</button>
	    </span> -->
	</div>
</form>
<table class="layui-table" lay-even lay-skin="line">
	<colgroup>
		<col width="50">
		<col>
		<col>
		<col>
		<col>
		<col width="150">
	</colgroup>
	<thead>
		<tr style="height: 38px;">
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<!-- <th>ID</th>
			<th>导出单号</th>
			<th>数量</th>
			<th>操作者</th>
			<th>导出时间</th>
			<th>状态</th>
			<th>操作</th> -->
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>
<span class="fr">

</span>
@endsection
@section('my-js')
<script>
    layui.use(['form', 'laydate'], function(){
        var form = layui.form
                ,layer = layui.layer
                ,laydate = layui.laydate
                ,$ = layui.$;


        //日期范围
		laydate.render({
		    elem: '#test6'
		    ,range: '至'
		    ,format: 'yyyy-MM-dd'
		    ,min: -7 //7天前
		    ,max: 7 //7天后
		});

 		//数据导出
 		$('.export').click(function(evt){
 			evt.preventDefault();
 			var _time = $('#test6').val();
 			if(_time == ''){
 				layer.alert('日期不可为空!');
 				return false;
 			}
 			//ajax
 			$.ajax({
 				url:'{{url("/sms/export")}}',
 				data:{range:_time},
 				type:'post',
 				dataType:'json',
 				headers:{
 					'X-CSRF-TOKEN':'{{csrf_token()}}'
 				},
 				success:function(data){
 					if(data){
 						window.location.href = data.data;
 					}
 				}
 			})
 		
 		})
    });
</script>
@endsection