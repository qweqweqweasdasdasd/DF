<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/memcache',function(){
	$mem = new Memcache;
    $mem->connect("127.0.0.1", 11211);
    $mem->set('key', 'Hello test!', 0, 60);
    $val = $mem->get('key');
    echo $val;
});

Route::get('/','Admin\HomeController@index');
//发送短信接口
Route::post('/sms/send','Admin\SmsController@send');
//短信验证获取个人信息
Route::post('/sms/getinfo','Admin\SmsController@getinfo');

//移动端
Route::get('/m_index','Admin\SmsController@m_index');


//后台管理--显示登录页面
Route::get('/login','Admin\ManagerController@login')->name('login');
//后台管理--登录信息储存
Route::post('/storemanager','Admin\ManagerController@storemanager');

Route::group(['middleware'=>'auth:back'],function(){
	//后台管理--显示后台主页
	Route::get('/index/index','Admin\IndexController@index');
	//后台管理--显示welcome
	Route::get('/welcome','Admin\IndexController@welcome');
	//后台管理--退出登录
	Route::get('/logout','Admin\ManagerController@logout');
	//后台管理--修改密码
	Route::match(['get','post'],'/password','Admin\IndexController@password');

	//////////////////////////////////禁止翻墙///////////////////////////////////////
	Route::group(['middleware'=>'Fanqiang'],function(){

		//后台管理--显示权限列表
		Route::get('/permission/index','Admin\PermissionController@index');		//做了缓存 缓存驱动file
		//后台管理--显示添加权限
		Route::get('/permission/create','Admin\PermissionController@create');
		//后台管理--保存权限
		Route::post('/permission/store','Admin\PermissionController@store');
		//后台管理--显示编辑权限
		Route::get('/permission/show/{p_id}','Admin\PermissionController@show');
		//后台管理--保存编辑权限
		Route::post('/permission/save','Admin\PermissionController@save');
		//后台管理--删除权限
		Route::post('/permission/del','Admin\PermissionController@del');

		//后台管理--角色列表(用户组)
		Route::get('/role/index','Admin\RoleController@index');
		//后台管理--删除角色
		Route::post('/role/del','Admin\RoleController@del');
		//后台管理--显示添加用户组
		Route::get('/role/create','Admin\RoleController@create');
		//后台管理--添加保存
		Route::post('/role/store','Admin\RoleController@store');
		//后台管理--显示权限页面
		Route::get('/role/qxview/{r_id}','Admin\RoleController@qxview');
		//后台管理--保存分配权限
		Route::post('/role/qxsave','Admin\RoleController@qxsave');

		//后台管理--用户管理
		Route::match(['get','post'],'/manager/index','Admin\ManagerController@index');
		//后台管理--用户删除
		Route::post('/manager/del','Admin\ManagerController@del');
		//后台管理--用户修改状态
		Route::post('/manager/setstatus','Admin\ManagerController@setstatus');
		//后台管理--用户添加页面
		Route::get('/manager/create','Admin\ManagerController@create');
		//后台管理--用户添加保存
		Route::post('/manager/stroe','Admin\ManagerController@stroe');
		//后台管理--用户编辑显示
		Route::get('/manager/edit/{mg_id}','Admin\ManagerController@edit');
		//后台管理--用户编辑更新
		Route::post('/manager/update','Admin\ManagerController@update');
		//后台管理--超级用户给用户重置密码
		Route::match(['get','post'],'/manager/resetpwd/{mg_id?}','Admin\ManagerController@resetpwd');

		//后台管理--白名单
		Route::get('/whitelist','Admin\WhitelistController@index');
		//后台管理--保存白名单
		Route::post('/whitelist/store','Admin\WhitelistController@store');
		//后台管理--删除白名单
		Route::post('/whitelist/destroy','Admin\WhitelistController@destroy');

		///////////////////////////////////////////用户管理//////////////////////////////////////////////
		//后台管理--用户列表
		Route::get('/user/index','Admin\UserController@index');
		//后台管理--数据查询
		Route::post('/user/search','Admin\UserController@search');
		//后台管理--数据删除
		Route::post('/user/destroy','Admin\UserController@destroy');
		//后台管理--数据编辑
		Route::get('/user/edit/{u_id}','Admin\UserController@edit');
		//后台管理--数据编辑
		Route::post('/user/update','Admin\UserController@update');

		//后台管理--导入页面
		Route::get('/user/show','Admin\UserController@show');
		//后台管理--上传csv
		Route::post('/import','Admin\UserController@import');
		//后台管理--数据回滚
		Route::post('/rollback','Admin\UserController@rollback');

		//////////////////////////////////////////////短信管理/////////////////////////////////////////////////
		//短信激活用户列表显示
		Route::get('/sms/index','Admin\SmsController@index');
		//删除短信信息
		Route::post('/sms/destroy','Admin\SmsController@destroy');
		//查询短信信息
		//Route::post('/sms/search','Admin\SmsController@search');

		//数据导出显示
		Route::get('/sms/show','Admin\SmsController@show');
		//数据导出
		Route::post('/sms/export','Admin\SmsController@export');
		//laravel 自带下载方法
		Route::get('/sms/downloadfile/{file}', 'Admin\SmsController@DownloadFile')->name('download');

		////////////////////////////////////////////////模板管理////////////////////////////////////////////////////
		//模板列表
		Route::get('/template/index','Admin\TemplateController@index');
		//添加创建
		Route::get('/template/create','Admin\TemplateController@create');
		//添加保存
		Route::post('/template/store','Admin\TemplateController@store');
		//删除模板
		Route::post('/template/del','Admin\TemplateController@del');
		//编辑模板显示
		Route::get('/template/edit/{e_id}','Admin\TemplateController@edit');
		//模板数据更新
		Route::post('/template/update','Admin\TemplateController@update');
	});
});

