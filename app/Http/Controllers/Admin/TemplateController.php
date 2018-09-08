<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TemplateRepository;
use App\Http\Requests\StoreTemplateRequest;

class TemplateController extends Controller
{
	//私有属性
	protected $templateRepository;

	//构造函数

	public function __construct(TemplateRepository $templateRepository)
	{
		$this->templateRepository = $templateRepository;
	}
	
    //模板列表
    public function index(Request $request)
    {
    	$k = trim($request->input('k',''));
    	$data = $this->templateRepository->getTemplateData($k);

    	return view('admin.template.index',compact('data','k'));
    }

    //添加模板创建
    public function create()
    {
    	return view('admin.template.create');
    }

    //添加保存
    public function store(StoreTemplateRequest $request)
    {
    	$z = $this->templateRepository->storeTemplateData($request->all());

    	return $z ? ['code'=>1] : ['code'=>0];
    }

    //删除模板
    public function del(Request $request)
    {
    	$z = $this->templateRepository->delTemplate($request->get('e_id'));

    	return $z ? ['code'=>1] : ['code'=>0];
    }

    //编辑模板
    public function edit(Request $request)
    {
        $info = $this->templateRepository->delTemplateById($request->route('e_id'));

        return view('admin.template.edit',compact('info'));
    }

    //模板数据更新
    public function update(StoreTemplateRequest $request)
    {
        $z = $this->templateRepository->updateTemplateById($request->all());

        return $z ? ['code'=>1] : ['code'=>0];
    }
}
