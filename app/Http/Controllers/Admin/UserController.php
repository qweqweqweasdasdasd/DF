<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ImportRepository;
use App\Repositories\TemplateRepository;

class UserController extends Controller
{
    //私有属性
    protected $importRepository;
    protected $templateRepository;

    //构造函数   
    public function __construct(ImportRepository $importRepository,TemplateRepository $templateRepository)
    {
        $this->importRepository = $importRepository;
        $this->templateRepository = $templateRepository;
    }
   
    //用户列表
    public function index()
    {
        $count = $this->importRepository->getUsernameCount();

    	return view('admin.user.index',compact('count'));
    }

    //数据查询
    public function search(Request $request)
    {
        $data = $this->importRepository->createSearchItem($request->get('keyword'));

        return $data ? ['code'=>1,'data'=>$data] : ['code'=>0];
    }

    //用户数据删除
    public function destroy(Request $request)
    {
        $z = $this->importRepository->destroyUsername($request->get('u_id'));

        return ['code'=>1];
    }

    //用户数据编辑
    public function edit(Request $request,$u_id)
    {
        $info = $this->importRepository->findUsername($u_id);

        return view('admin.user.edit',compact('info'));
    }

    //数据编辑
    public function update(Request $request)
    {
        $z = $this->importRepository->updateUsername($request->all());

        return $z ? ['code'=>1] : ['code'=>0];
    }

    //导入页面显示
    public function show()
    {
        $data = $this->importRepository->getImportData();
        $manager = $this->importRepository->getRoleData();
        $template = $this->templateRepository->getTemplateAndId();

    	return view('admin.user.show',compact('data','manager','template'));
    }

    //上传csv
    public function import(Request $request)
    {
        $template = $request->get('template');

        $rs = $this->checkSizeType($_FILES);
        if($rs['code'] == 0){
            return ['code'=>0,'error'=>$rs['error']];
        }
        //拼接服务器上的路径
        $file_path = './uploads' . '/import.' .$rs['error'];
        if(!move_uploaded_file($_FILES['file']['tmp_name'],$file_path)){
            return ['code'=>0,'error'=>'文件上传失败!'];
        };
        $this->csvDataCreateInsertToDB($file_path,$template);
        return ['code'=>1];

    }

    public function csvDataCreateInsertToDB($file_path,$template)
    {
        set_time_limit(0); //设置脚本最大执行时间,如果设置为0秒,则没有时间方面的限制.
        ignore_user_abort(true); //设置客户端断开连接时继续执行脚本
        ini_set('memory_limit','1024M');  
        $handle = fopen($file_path,'rb');
        //将文件一次性放到数组内
        $excelData = array();
        while ($row = fgetcsv($handle,1000,',')) {
            $excelData[] = $row;
        }
        $total = count($excelData);
        if($total >= 100000){        // 10万
            return false;
        }
        $chunkData = array_chunk($excelData, 5000); // 分割为5千的小数组
        $count = count($chunkData);
        $now = date('Y-m-d H:i:s',time());
        $order = 'i' . time();
        
        $values = array();
        for ($i=0; $i < $count; $i++) { 
            $insertRows = array();
            foreach ($chunkData[$i] as $v) {
                $username = mb_convert_encoding($v[0],'utf-8','gbk');
                $password = mb_convert_encoding($v[1],'utf-8','gbk');
                $tel = mb_convert_encoding($v[2],'utf-8','gbk');
                $tpasspwd = mb_convert_encoding($v[3],'utf-8','gbk');
                $sum = mb_convert_encoding($v[4],'utf-8','gbk');
                $link = mb_convert_encoding($v[5],'utf-8','gbk');
               /* $kflink = mb_convert_encoding($v[6],'utf-8','gbk');     //客服连接
                $appload = mb_convert_encoding($v[7],'utf-8','gbk');    //app 下载
                $gamedesc = mb_convert_encoding($v[8],'utf-8','gbk');   //活动描述
                $hdesc = mb_convert_encoding($v[9],'utf-8','gbk');   //红包描述*/

                $createtime = $now;

                $str = "('{$username}','{$password}','{$tel}','{$tpasspwd}','{$sum}','{$link}','{$createtime}','{$order}','{$template}')";
                $values[] = $str;
            }

            $data = implode(',', $values);
            //数据重复自动忽略
            DB::insert(" INSERT IGNORE INTO df_username (`username`,`password`,`tel`,`tpasspwd`,`sum`,`link`,`createtime`,`order`,`e_id`) VALUES {$data}");
            /*echo " INSERT IGNORE INTO df_username (`username`,`password`,`tel`,`tpasspwd`,`sum`,`link`,`createtime`,`order`,`kflink`,`appload`,`gamedesc`) VALUES {$data}";*/
        }
        //创建导入的数据信息
        $this->importRepository->createimport($order,$total,$now);
        
        return ['code'=>1];
    }

    //查询文件大小和类型
    public function checkSizeType($d)
    {
        $file_size = $d['file']['size'];
        if($file_size > 80*1024*1024){
            return ['code'=>0,'error'=>'文件过大,不能上传'];
        }
        $file_type = explode('.',$d['file']['name'])[1];
        if($file_type != 'csv'){
            return ['code'=>0,'error'=>'上传文件的格式为csv'];
        }
        return ['code'=>1,'error'=>$file_type];
    }

    //数据回滚
    public function rollback(Request $request)
    {
        $z = $this->importRepository->rollback($request->all('order'));
        
        return $z ? ['code'=>1] : ['code'=>0];
    }
}
