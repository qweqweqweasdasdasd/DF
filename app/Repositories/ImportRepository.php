<?php 

namespace App\Repositories;

use App\Manager;
use App\Username;
use App\Import;

class ImportRepository 
{
	//创建导入的数据信息
	function createimport($order,$total,$now)
	{
		return Import::create(['order'=>$order,'mg_id'=>get_mg_id(),'created_at'=>$now,'count'=>$total]);
	}

	//获取到所有的导入信息
	function getImportData()
	{
		return Import::paginate(5);
	}

	//获取到所有角色信息
	function getRoleData()
	{
		return Manager::pluck('mg_name','mg_id');
	}

	//数据回滚
	function rollback($d)
	{
		Import::where('i_id',$d['i_id'])->delete();
		return Username::where('order',$d['order'])->delete();
	}

	//关键字查询
	public function createSearchItem($d)
	{
		if($data = Username::where('tel',$d)->first()){
			return $this->createTableTr($data);
		}
		return false;
	}

	//创建拼接 table 
	public function createTableTr($d)
	{
		$tr = '<tr><td>'.$d['u_id'].'</td>';
		$tr .= '<td>'.$d['username'].'</td>';
		$tr .= '<td>'.$d['password'].'</td>';
		$tr .= '<td>'.$d['tel'].'</td>';
		$tr .= '<td>'.$d['tpasspwd'].'</td>';
		$tr .= '<td>'.$d['sum'].' (元)</td>';
		$tr .= '<td>'.$d['link'].'</td>';
		$tr .= '<td>'.$d['desc'].'</td>';
		$tr .= '<td>'.$d['createtime'].'</td>';
		$tr .= '<td>
				<div class="layui-inline">
					<button class="layui-btn layui-btn-mini layui-btn-normal go-btn" data-id="'.$d['u_id'].'" >
					<i class="layui-icon">&#xe642;</i>编辑</button>
					<button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="'.$d['u_id'].'" >
					<i class="layui-icon">&#xe640;</i>删除</button>
				</div>
			   </td><tr>';
		return $tr;
	}

	//获取到用户总数量
	public function getUsernameCount()
	{
		return Username::count();
	}

	//删除用户
	public function destroyUsername($u_id)
	{
		return Username::where('u_id',$u_id)->delete();
	}

	//显示编辑用户
	public function findUsername($u_id)
	{
		return Username::find($u_id);
	}

	//保存编辑用户
	public function updateUsername($d)
	{
		$data = array_except($d,['username','password','tpasspwd','u_id']);
		
		return Username::where('u_id',$d['u_id'])->update($data);
	}
}
?>