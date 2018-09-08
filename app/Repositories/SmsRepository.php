<?php 
namespace App\Repositories;

use App\Username;
use App\Message;

class SmsRepository 
{
	//获取到所有发送短信的记录
	public function getMessageData($keyword)
	{
		return Message::select('message.*','username.username','username.tel','username.is_activate')
				->leftJoin('username','message.u_id','username.u_id')
				->where(function($query) use($keyword) {
					if(!empty($keyword)){
						$query->where('username.username',$keyword)
							->orwhere('username.tel',$keyword);
					}
				})
				->paginate(13);
	}

	//短信信息销毁

	public function deleteMessage($id)
	{
		
		return Message::where('s_id',$id)->delete();
	}

	//搜索功能
	public function searchMessage($keyword)
	{
		return Message::select('message.*','username.username','username.tel','username.is_activate')
				->leftJoin('username','message.u_id','username.u_id')
				->where('username.username',$keyword)
				->orwhere('username.tel',$keyword)
				->get()->toArray();
	}

	//获取在日期范围内的所有数据
	public function getDataSms($range)
	{
		$d = explode('至',$range);
		$min = trim($d[0]);
		$max = trim($d[1]);
		
		return Message::select('username.username','username.tel','username.is_activate')
				->leftJoin('username','message.u_id','username.u_id')
				->whereBetween('message.created_at',[$min,$max])
				->get()->toArray();
	}

	//用户是否在活动中
	public function is_exist($phone)
	{
		return Username::where('tel',$phone)->first();
	}

	//获取到一条客户的信息
	public function getInfoByPhone($phone)
	{
		return Username::leftJoin('event','username.e_id','event.e_id')->where('tel',$phone)->first();
	}

	//保存发送过的信息
	public function rememberMessage($s_message,$s_count,$u_id)
	{
		if(!Message::where('u_id',$u_id)->update(['s_message'=>$s_message,'s_count'=>$s_count])){

			return Message::create(['s_message'=>$s_message,'s_count'=>$s_count,'u_id'=>$u_id]);
		}
	}

	//获取code
	public function getcode($u_id)
	{
		return Message::where('u_id',$u_id)->value('s_message');
	}

	//修改状态
	public function setUserStatus($phone)
	{
		return Username::where('tel',$phone)->update(['is_activate'=>'1']);
	}
}
?>
