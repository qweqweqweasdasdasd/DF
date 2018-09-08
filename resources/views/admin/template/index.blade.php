@extends('admin/common/master')
@section('title','模板列表')
@section('class','body')
@section('content')
<link rel="stylesheet" type="text/css" href="/admin/page.css">
<form>
<div class="my-btn-box">
    <span class="fl">
        <a class="layui-btn btn-add btn-default" id="btn-add"><i class="layui-icon">&#xe654;</i>添加模板</a>
        <a class="layui-btn btn-add btn-default" id="btn-refresh"><i class="layui-icon">&#x1002;</i></a>
    </span>
    <span class="fr">
        <span class="layui-form-label">搜索条件：</span>
        <div class="layui-input-inline">
            <input type="text" autocomplete="off" placeholder="请输入搜索条件" class="layui-input" name="k" value="{{@$k}}">
        </div>
        <button class="layui-btn mgl-20">查询</button>
    </span>
</div>
</form>
<table class="layui-table" lay-even lay-skin="line">
	<colgroup>
		<col width="50">
		<col >
		<col >
		<col >
		<col >
		<col >
		<col width="150">
	</colgroup>
	<thead>
		<tr>
			<th>ID</th>
			<th>标题</th>
			<th>客服连接</th>
			<th>App下载地址</th>
			<th>游戏规则</th>
			<th>活动描述</th>
			<!-- <th>创建时间</th> -->
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $v)
		<tr>
			<td>{{$v->e_id}}</td>
			<td>{{$v->title}}</td>
			<td>{{$v->kfline}}</td>
			<td>{{$v->appload}}</td>
			<td>{{$v->gamedesc}}</td>
			<td>{{$v->hdesc}}</td>
			<!-- <td>{{$v->created_at}}</td> -->
			<td>
				<div class="layui-inline">
					<button class="layui-btn layui-btn-mini layui-btn-normal  go-btn" data-id="{{$v->e_id}}" data-url="danye-detail.html"><i class="layui-icon">&#xe642;</i>编辑</button>
					<button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="{{$v->e_id}}" data-url="del.html"><i class="layui-icon">&#xe640;</i>删除</button>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
<span class="fr">
	{{ $data->appends(['k'=>$k])->links() }}
</span>
@endsection
@section('my-js')
<script type="text/javascript">
    // layui方法
    layui.use(['table', 'form', 'layer'], function () {

        // 操作对象
        var form = layui.form
                , table = layui.table
                , layer = layui.layer
                , $ = layui.jquery;

  
        // 刷新
        $('#btn-refresh').on('click', function () {
           window.location.href = window.location.href;
        });

        //添加模板
        $('#btn-add').click(function(){
        	var index =	layer.open({
			      type: 2,
			      title: '模板添加',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      //area: ['893px', '600px'],
			      content: '{{url("/template/create")}}'
			    });
        	layer.full(index);
        });

        //删除模板
        $('tbody').on('click','.del-btn',function(){
        	var e_id = $(this).attr('data-id');
        	var _this = $(this);
        	//ajax
        	$.ajax({
        		url:'{{url("/template/del")}}',
        		data:{e_id:e_id},
        		type:'post',
        		dataType:'json',
        		headers:{
        			'X-CSRF-TOKEN':'{{csrf_token()}}'
        		},
        		success:function(data){
        			if(data.code == 1){
        				_this.parent().parent().parent().remove();
        			}
        		}
        	})
        	//alert(e_id);
        })

        //编辑模板
        $('tbody').on('click','.go-btn',function(){
        	var e_id = $(this).attr('data-id');
        	var index = layer.open({
			      type: 2,
			      title: '编辑模板',
			      shadeClose: true,
			      shade: false,
			      maxmin: true, //开启最大化最小化按钮
			      //area: ['893px', '600px'],
			      content: '{{url("/template/edit")}}' +'/'+e_id
			    });
        	layer.full(index);
        })

    });
</script>
@endsection