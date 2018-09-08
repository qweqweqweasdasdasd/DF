<?php

namespace App\Http\Controllers\Admin;

use Flc\Dysms\Client;
use Illuminate\Http\Request;
use Flc\Dysms\Request\SendSms;
use App\Repositories\SmsRepository;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
	//私有属性
	protected $smsRepository;
	
	//构造函数
	public function __construct(SmsRepository $smsRepository)
	{
		$this->smsRepository = $smsRepository;
	}
	
    //短信激活用户列表显示
    public function index(Request $request)
    {
    	$keyword = $request->input('keyword');
    	$data = $this->smsRepository->getMessageData($keyword);

    	return view('admin.sms.index',compact('data','keyword'));
    }

    //短信信息销毁
    public function destroy(Request $request)
    {
    	$z = $this->smsRepository->deleteMessage($request->get('s_id'));

    	return 	$z ? ['code'=>1]:['code'=>0];
    }

    //搜索功能的实现
    public function search(Request $request)
    {
    	return $this->smsRepository->searchMessage($request->get('keyword'));
    }

    //导出显示页面
    public function show()
    {
    	return view('admin.sms.show');
    }

    //导出激活的用户
    public function export(Request $request)
    {
        // 输出Excel文件头，可把user.csv换成你要的文件名
        $head = ['用户名','手机号码','状态'];
        $data = $this->smsRepository->getDataSms($request->get('range')); //数组
        
        $this->putCsv('./download/export.csv',$data,$head);
        $res['data'] = route('download', ['file' => 'export']);
        
        return $res;
    }

    //实现 put 数组到csv 文件
    public function putCsv($filename,$data,$head='')
    {
        $handle = fopen($filename,'w'); //写入的方式打开
        //写入表头
        if(!empty($head)){
            foreach ($head as $k => $v) {
                $h[$k] = iconv("utf-8","gbk//IGNORE",$v);
            }
            $rs = fputcsv($handle,$h);   //把表头写入文件
        }
        foreach ($data as $key => $v) {
            foreach ($v as $kk => $vv) {
                $v[$k] = iconv("utf-8","gbk//IGNORE",$vv);//对中文编码进行处理
            }
            $rs = fputcsv($handle, $v);
        }
    }

    //实现下载的方法
    public function DownloadFile(Request $request)
    {
        $file = public_path('/download/'.$request->route('file').'.csv');  
        
        return response()->download($file);
    }

    //短信发送
    public function send(Request $request)
    {
        $phone = $request->get('phone');
        if(!$this->smsRepository->is_exist($phone)){

            return ['code'=>0,'error'=>'您不在特邀用户范围内，无法参与该活动哦!'];
        };
        $config = [
            'accessKeyId'    => 'LTAI00Ns6YntXQgM',  //LTAIcwKI7qttaSnl
            'accessKeySecret' => 'OWYRCrSn126aKLU7RTwfYbTkZiyP1K', //36HC18Hfeqgxbavjm0203lVGSUzyOO
        ];

        $message = rand(100000, 999999);
        $client  = new Client($config);
        $sendSms = new SendSms;
        $sendSms->setPhoneNumbers($phone);  //ok 
        $sendSms->setSignName('就是我');
        $sendSms->setTemplateCode('SMS_143715724');
        $sendSms->setTemplateParam(['code' => $message]);
        $sendSms->setOutId('demo');

        if($client->execute($sendSms)->Message != 'ok'){
            $error = $client->execute($sendSms)->Code;

            switch ($error) {
                 case 'isv.MOBILE_NUMBER_ILLEGAL':
                     return ['code'=>0,'error'=>'您的手机号码不对哦'];
                     
                 case 'isv.MOBILE_COUNT_OVER_LIMIT':
                     return ['code'=>0,'error'=>'手机号码超出限制'];
                
                 case 'isv.SMS_TEMPLATE_ILLEGAL':
                     return ['code'=>0,'error'=>'短信模板不合法']; 

                 case 'isv.AMOUNT_NOT_ENOUGH':
                     return ['code'=>0,'error'=>'账户余额不足']; 
             } 
            
        }
	//dd($client->execute($sendSms)->Message);
        //发送成功  验证码入库 ,, u_id ,, s_count ,, 修改username表激活的字段
        $s_message = $message;
        $s_count = '1';
        $u_id = $this->smsRepository->getInfoByPhone($phone)['u_id'];
        $this->smsRepository->rememberMessage($s_message,$s_count,$u_id);
        return ['code'=>1];
    }

    //提交code获取info
    public function getinfo(Request $request)
    {
        $u_id = $this->smsRepository->getInfoByPhone($request->get('phone'))['u_id'];
        
        if($request->code != $this->smsRepository->getcode($u_id)){
            return ['code'=>0,'error'=>'验证码不一致,以最后一个验证为准!'];
        }

        //修改用户的状态
        $this->smsRepository->setUserStatus($request->get('phone'));
        $info = $this->smsRepository->getInfoByPhone($request->get('phone'));
        
        $html = $this->createHtml($info);

        return ['code'=>1,'info'=>$html];
    }

    //拼接字符串
    public function createHtml($d)
    {
        $html = '<div class="hidden2"><ul>';
        $html .= '<li><span>会员账号:</span><span>' . $d->username . '</span></li>';
        $html .= '<li><span>登录密码:</span><span>' . $d->password . '</span></li>';
        $html .= '<li><span>提款密码:</span><span>' . $d->tpasspwd . '</span></li>';
        $html .= '<li><span>账户余额:</span><span>' . $d->sum . '</span></li>';
        $html .= '<li><span>登录连接:</span><a target="_blank" href="'. $d->link . '"> '. $d->link .' </a></li>';

        $html .= '<li><span>客服链接:</span><span><a target="_blank" href="'. $d->kflink .'">咨询在线客服</a></span></li>';
        $html .= '<li><span>APP下载:</span><span><a target="_blank" href="'. $d->appload .'">前往下载页面</a></span></li>';
        $html .= '<li class="active"><span>红包规则:</span><span>'.$d->gamedesc.'</span></li>';
        $html .= '<li class="active"><span>红包介绍:</span><span>'.$d->hdesc.'</span></li></ul></div>';

        return $html;
    }

    //移动端
    public function m_index($value='')
    {
        return view('admin.home.m_index');
    }
  
}


