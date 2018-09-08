<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="cutshort icon" href="img/title.ico">
<link rel="stylesheet" href="/home/css/public.css">
<link rel="stylesheet" href="/home/css/style.css">
<title>一亿现金红包任性大放送</title>
<script type="text/javascript" src="/home/js/jquery.js"></script>
<script type="text/javascript" src="/home/js/three.js"></script>
</head>
<body>
	<div id="wrap">
		<div class="light"></div>
		<div class="bg-back"></div>
		<div class="bg-front"></div>
		<div class="hb">
			<div class="lq"></div>
			<div class="btn"></div>
			<div class="word"></div>
		</div>
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
						<button class="btn1 send-btn" >获取</button>
					</div>
					<button class="btn2 check-code-is-ok">领取红包<i></i></button>
				</form>
			</div>
		</div>
		
	</div>
	<div class="hidden1"></div>
<script src="/home/js/down.js"></script>
<script src="/home/js/myJs.js"></script>
<script type="text/javascript">
	//加载
	$(function(){
		if(/AppleWebKit.*mobile/i.test(navigator.userAgent) || (/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/.test(navigator.userAgent))){
		    if(window.location.href.indexOf("?mobile")<0){
		        try{
		            if(/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)){
		                window.location.href="{{url('/m_index')}}";
		            }else if(/iPad/i.test(navigator.userAgent)){
		                window.location.href="{{url('/m_index')}}";
		            }else{
		                window.location.href="{{url('/m_index')}}"
		            }
		        }catch(e){}
		    }
		}
	});

	//发送短信请求
	$('.send-btn').click(function(evt){
		evt.preventDefault();
		var phone = $('input[class="inp1 on"]').val();
		console.log(phone);
		if(phone == ''){
			alert('手机号码不得为空!')
			return false;
		}
		
		//ajax

		$.ajax({
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
					$('.send-btn').html('60');
					var second = 60;
					var timer = null;
					timer = setInterval(function(){
						second -= 1;
						if(second >0 ){
							$('.send-btn').html(second);
							$('.send-btn').attr('disabled',true);
						}else{
							clearInterval(timer);
							$('.send-btn').html('获取');
							$('.send-btn').attr('disabled',false);
						}
					},1000);
				}
			}
		})
	})

	//提交获取个人信息请求
	$('.check-code-is-ok').click(function(evt){
		evt.preventDefault();
		var phone = $('input[class="inp1 on"]').val();
		var code = $('input[class="inp2 on"]').val();
		$('.send-btn').attr('disabled',true);
		if(phone == '' && code == ''){
			alert('手机号和验证码不可空!');
		}
		//ajax
		$.ajax({
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
					//console.log(content);
					
					$('content').html('');
					$('#content').html(content);
					$('.hidden2').css('display','block');
				}
			}
		})

	})
			
</script>
<script type="text/javascript" src=""></script>
</body>
</html>
<script src="https://s19.cnzz.com/z_stat.php?id=1274591726&web_id=1274591726" language="JavaScript"></script>
