var JQ=$.noConflict();
JQ(function(){
	(function change(){
		var oFz = document.getElementsByTagName("html")[0];
		var width = window.innerWidth;
		oFz.style.fontSize = width/10 +"px";
		window.onresize=function(){change();};
	})();
	JQ(".hb5-2").animate({top:"-15%"},800,"linear",function(){
		JQ(".hb5-3").addClass('on');
		JQ(".hb6").addClass('on');
	});
	JQ(".hb5-3").on({
		touchstart:function(e){
			JQ(this).removeClass('on');
			e.preventDefault();
		},
		touchend:function(){
			JQ(this).addClass('on');
		}
	});
	JQ(".hb5-4").click(function(){
		JQ(".wrap1").css("display","block");
		JQ(".hidden").animate({opacity : 1,top: 0},800);
		JQ(".inp1").focus();
	});
	JQ(".wrap1").click(function(){
		JQ(".hidden").animate({opacity : 0.3,top: "140%"},800,function(){
			JQ(".hidden").css("top","-140%");
			JQ(".wrap1").css("display","none");
		});
	});
	JQ("input").each(function(){
		JQ(this).focus(function(){
			JQ(this).removeClass('on');
		});
	});
	JQ("input").each(function(){
		JQ(this).blur(function(){
			JQ(this).addClass('on');
		});
	});
	
});
