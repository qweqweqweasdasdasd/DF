	//发送短信请求
	$('.send-btn').click(function(evt){
		evt.preventDefault();
		var phone = $('input[class="inp1 on"]').val();
		console.log(phone);
		if(phone == ''){
			alert('手机号码不得为空!')
			return false;
		}
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
					var username = data.info.username;
					var password = data.info.password;
					var tpasspwd = data.info.tpasspwd;
					var sum = data.info.sum;
					var link = data.info.link;
					var content = '<div class="hidden2"><ul>';
						content += '<li><span>会员账号:</span><span>' + username + '</span></li>';
						content	+= '<li><span>登录密码:</span><span>' + password + '</span></li>';
						content	+= '<li><span>提款密码:</span><span>' + tpasspwd + '</span></li>';
						content	+= '<li><span>账户余额:</span><span>' + sum + '</span></li>';
						content	+= '<li><span>登录连接:</span><a target="_blank" href="'+ link + '"> '+ link +' </a></li>';

						content	+= '<li><span>客服链接:</span><span><a target="_blank" href="https://vf9000.livechatvalue.com/chat/chatClient/chatbox.jsp?companyID=900003&configID=54524&jid=2293225118&skillId=3070&s=1">咨询在线客服</a></span></li>';
						content	+= '<li><span>APP下载:</span><span><a target="_blank" href="https://dashboard.applivery.com/5wk">前往下载页面</a></span></li>';
						content	+= '<li><span>红包规则:</span><span>现金红包会直接派发到您在该网站</span></li>';
						content	+= '<li><span></span><span>的账户上，您可以直接进行游戏（一倍流水，无</span></li>';
						content	+= '<li><span></span><span>游戏限制，,提款上限1888），满100即可提款。</span></li>';
						content	+= '<li><span></span><span>（如本身余额高于68元则无法获取红包赠送）</span></li>';
						content	+= '<li><span>介绍:</span><span>金沙娱乐城，打造线上博彩第一品牌，提</span></li>';
						content	+= '<li><span></span><span>供百家乐、老虎机,捕鱼、彩票、棋牌、体育等</span></li>';
						content	+= '<li><span></span><span>多种玩法类型！</span></li>';

						content += '</ul></div>';
					$('content').html('');
					$('#content').html(content);
					$('.hidden2').css('display','block');
					console.log(content);
				}
			}
		})

	})