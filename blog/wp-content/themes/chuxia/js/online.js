/// jquery显示几秒后自动隐藏
$('#alertDiv').show().delay(2000).hide(0);

/// home顶部图片show 
$(document).ready(function(){
	$(".sch,.iclose").click(function(){ $("#banner").fadeToggle(300); });
	$(".nav-m").click(function(){ $(".menu").fadeToggle(300); })
});

/// 返回顶部
$(document).ready(function() {
	var h = $(window).height();
    $(window).scroll(function () {
        if($(window).scrollTop()>=h*1) {
            $(".backtop").fadeIn(300);
        }else {
            $(".backtop").fadeOut(300);
        };
    });
    $(".backtop").click(function(event){   
        $('html,body').animate({scrollTop:0}, 500);
        return false;
    });
});

/// 网下拉缩小固定导航
$(document).on("scroll",function(){
	var mh = $(document).scrollTop();
	if(mh>200){ 
		$("#header").stop().removeClass('pt15').addClass('fixed');
	} else if(mh<=200) {
		$("#header").stop().addClass('pt15').removeClass('fixed');
	} else {
		$("#header").stop().addClass('pt15');
	}		
});

/// jQuery滚动隐藏/显示顶部标题 
$(function(){	
    var cubuk_seviye = $(document).scrollTop();
    var header_yuksekligi = $('.yapiskan').outerHeight();
    $(window).scroll(function() {
        var kaydirma_cubugu = $(document).scrollTop();
        if (kaydirma_cubugu > header_yuksekligi){$('.yapiskan').addClass('gizle');} 
        else {$('.yapiskan').removeClass('gizle');}
        if (kaydirma_cubugu > cubuk_seviye){$('.yapiskan').removeClass('sabit');} 
        else {$('.yapiskan').addClass('sabit');}				
        cubuk_seviye = $(document).scrollTop();	
     });
});

/// 浮动
$(document).ready(function(e) {			
	var th = $('.fd').offset().top;
	var fh = $('.fd').height(); 
	$(window).scroll(function(e){ 
		sh = $(document).scrollTop(); 
		if(sh > th - 10){
			$('.fd').css({"position":"fixed","top":"50px"});
		} else {
			$('.fd').css('position','');
		}
	})
});

/// 间隔指定时间刷新页面
/*var i=0,
timerId = setInterval(function(){
	if(i<=10){
		document.body.innerHTML=(10-i)+'秒后刷新页面，请稍候……';
		i++;
	}else{
		clearInterval(timerId);
		window.location.reload();//刷新了又继续了，呵呵……
	}
},1000);*/

/// 添加AJAX文章点赞功能
$(document).ready(function() {
    $.fn.postLike = function() {
        if ($(this).hasClass('done')) {
            return false;
        } else {
            $(this).addClass('done');
            var id = $(this).data("id"),
            action = $(this).data('action'),
            rateHolder = $(this).children('.count');
            var ajax_data = {
                action: "bigfa_like",
                um_id: id,
                um_action: action
            };
            $.post("/wp-admin/admin-ajax.php", ajax_data,
            function(data) {
                $(rateHolder).html(data);
            });
            return false;
        }
    };
    $(document).on("click", ".favorite",
    function() {
        $(this).postLike();
    });
});

/// 时间
function showLocale(objD){var str,colorhead,colorfoot;var yy=objD.getYear();if(yy<1900)yy=yy+1900;var MM=objD.getMonth()+1;if(MM<10)MM='0'+MM;var dd=objD.getDate();if(dd<10)dd='0'+dd;var hh=objD.getHours();if(hh<10)hh='0'+hh;var mm=objD.getMinutes();if(mm<10)mm='0'+mm;var ss=objD.getSeconds();if(ss<10)ss='0'+ss;var ww=objD.getDay();if(ww==0)colorhead="<font>";if(ww>0&&ww<6)colorhead="<font>";if(ww==6)colorhead="<font>";if(ww==0)ww="星期日";if(ww==1)ww="星期一";if(ww==2)ww="星期二";if(ww==3)ww="星期三";if(ww==4)ww="星期四";if(ww==5)ww="星期五";if(ww==6)ww="星期六";colorfoot="</font>";str=colorhead+yy+"-"+MM+"-"+dd+" "+hh+":"+mm+":"+ss+"  "+ww+colorfoot;return(str)};function tick(){var today;today=new Date();document.getElementById("localtime").innerHTML=showLocale(today);window.setTimeout("tick()",1000)};tick();

/// 高亮代码
$(document).ready(function() {
  $('pre code').each(function(i, block) {
    hljs.highlightBlock(block);
  });
});