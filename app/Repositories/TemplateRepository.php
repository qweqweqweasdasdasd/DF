<?php 
namespace App\Repositories;

use App\Template;

class TemplateRepository 
{
	//添加保存模板数据
	public function storeTemplateData($data)
	{
		return Template::create($data);
	}

	//获取到模板的所有信息
	public function getTemplateData($k)
	{
		return Template::where(function($query) use($k){
								if(!empty($k)){
									$query->where('title',$k);
								}
							})->paginate(2);
	}

	//删除模板
	public function delTemplate($e_id)
	{
		return Template::where('e_id',$e_id)->delete();
	}

	//获取到一条数据
	public function delTemplateById($e_id)
	{
		return Template::find($e_id);
	}

	//更新一条数据
	public function updateTemplateById($d)
	{
		return Template::where('e_id',$d['e_id'])->update(array_except($d,['e_id']));
	}

	//获取到模板的名字和id
	public function getTemplateAndId()
	{
		return Template::pluck('title','e_id');
	}
}
?>
