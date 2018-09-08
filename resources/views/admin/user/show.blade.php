@extends('admin/common/master')
@section('title','导入')
@section('class','body')
@section('content')
<link rel="stylesheet" type="text/css" href="/admin/page.css">
<blockquote class="layui-elem-quote layui-text">
    导入csv格式: 账号,密码,电话号码,提款密码,余额,登录连接,客服地址,app下载地址,活动描述 (数据重复自动忽略,如果没有数据csv为空即可)
</blockquote>
<div class="my-btn-box">
    <span class="fl">
    	<div class="layui-form layui-form-pane layui-form-item">
	    	<div class="layui-input-inline">
	            <select name="template" id="template">
	                @foreach($template as $k => $v)
	                <option value="{{$k}}">{{$v}}</option>
	            	@endforeach
	            </select>
	        </div>
	        <button type="layui-btn test" class="layui-btn" id="test1">
			  <i class="layui-icon">&#xe67c;</i>导入CSV表格10w
			</button>
	        <button class="layui-btn btn-add btn-default" id="btn-refresh"><i class="layui-icon">&#x1002;</i></button>
    	</div>
    </span>
   <!--  <span class="fr">
        <span class="layui-form-label">搜索单号：</span>
        <div class="layui-input-inline">
            <input type="text" autocomplete="off" placeholder="请输入单号" class="layui-input">
        </div>
        <button class="layui-btn mgl-20">查询</button>
    </span> -->
</div>
<table class="layui-table" lay-even lay-skin="line">
	<colgroup>
		<col width="50">
		<col>
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
			<th>导入单号</th>
			<th>总数量</th>
			<th>操作者</th>
			<th>创建时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $v)
		<tr>
			<td>{{$v->i_id}}</td>
			<td>{{$v->order}}</td>
			<td>{{$v->count}} (条)</td>
			<td>{{@$manager[$v->mg_id]}}</td>
			<td>{{$v->created_at}}</td>
			<td>
				<div class="layui-inline">
					<button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="{{$v->order}}" data-i-id="{{$v->i_id}}"><i class="layui-icon">&#xe640;</i>数据回滚</button>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<span class="fr">
	{{ $data->links() }}
</span>
@endsection
@section('my-js')
<script type="text/javascript">

    // layui方法
    layui.use(['layer','upload','form'], function () {

        // 操作对象
        var layer = layui.layer
        		, form = layui.form
                , upload = layui.upload
                , $ = layui.jquery;

        var index = null;
        //执行实例
		var uploadInst = upload.render({
		    elem: '#test1' //绑定元素
		    ,url: '/import' //上传接口
		    ,accept: 'file'
		    ,method: 'post'
		    ,before: function(obj){ 
			    index = layer.load(1,{
			    	shade:[0.3,'#fff']	//0.1透明度的白色背景
			    });   //上传loading

			    //上传文件传递参数
			    this.data = {'template':$('#template option:selected').val()}; //关键代码
			}
		    ,done: function(res){
		      //上传完毕回调
		      if(res.code == 1){
		      	layer.close(index);
		      	layer.msg("上传成功");
		      }else if(res.code == 0){
		      	layer.close(index);
		      	layer.msg(res.error);
		      }
		    }
		    ,error: function(data){
		    	console.log(data);
		      //请求异常回调
		      layer.msg("请求异常回调");
		    }
		});

		//刷新
		$('#btn-refresh').click(function(){
			window.location.reload();
		});

		//数据回滚
		$('tbody').on('click','.del-btn',function(){
			var order = $(this).attr('data-id');
			var i_id = $(this).attr('data-i-id');
			var _this = $(this);
			var index = layer.confirm('请尽量不要使用数据回滚', function(){
			  //ajax
				$.ajax({
					url:'{{url("/rollback")}}',
					data:{order:order,i_id:i_id},
					dataType:'json',
					type:'post',
					headers:{
						'X-CSRF-TOKEN':'{{csrf_token()}}'
					},
					success:function(data){
						if(data.code == 1){
							_this.parent().parent().parent().remove();
							layer.close(index);
						}else if(data.code == 0){
							layer.alert('无数据');
						}
					}
				})
			});
		});
    });
</script>
@endsection