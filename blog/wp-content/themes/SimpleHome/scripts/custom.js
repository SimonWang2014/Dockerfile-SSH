	jQuery(function($){	
		//highlight
		hljs.initHighlightingOnLoad();
		
		//to-top
		$(window).scroll(function(){
			if ($(this).scrollTop() >= 30) {
				if (!$(".to-top").hasClass("topbtnfadein"))
					$(".to-top").removeClass("topbtnfadeout topbtnhide").addClass("topbtnfadein topbtnshow").removeClass("topbtnfadein");
				//$(".to-top").stop().animate({bottom: 30, opacity: 100});
			} else {
				if (!$(".to-top").hasClass("topbtnfadeout"))
					$(".to-top").removeClass("topbtnfadein topbtnshow").addClass("topbtnfadeout topbtnhide").removeClass("topbtnfadeout");
			}
		})
		
		$(".to-top").click(function(){
			$("body, html").stop().animate({scrollTop:0});
		});
		
		//poshytip
		$('.widget a').poshytip({
			className: 'tip-twitter',
			showTimeout: 1,
			alignTo: 'target',
			alignX: 'center',
			alignY: 'bottom',
			offsetY: 5,
			allowTipHover: false,
		});
		
		//menu
		var idxY = null;
		$(".nav ul li").each(function(){
			var navY = $(this).position().top;
			if ($(this).hasClass("current-menu-item") || $(this).hasClass('current-category-ancestor') || $(this).hasClass("current-post-ancestor")) {
				idxY = navY;
				$("#nav-current").css({top: idxY+15});
			}
			$(this).mouseenter(function(){
				$("#nav-current").stop().animate({top: navY+15}, 300);
			});
		});
		$(".nav ul").mouseleave(function(){
			$("#nav-current").stop().animate({top: idxY+15}, 500);
		});
		
		//side icon
		$(".icon-category").click(function(){
			if ($(this).hasClass("list-open")) {
				$(this).removeClass('list-open').children('span').html('展开分类目录');
				$(".list").stop().animate({left: 110}, 500);
			}
			else {
				$(this).addClass('list-open').children('span').html('关闭分类目录');
				if ($('.sns-weibo').hasClass('sns-weibo-open'))
				{
					$('.sns-weibo').click();
				}
				$(".list").stop().animate({left: 320}, 500);
			}
		});
		$(".sns-weibo").click(function(){
			if ($(this).hasClass("sns-weibo-open")) {
				$(this).removeClass('sns-weibo-open').children('span').html('展开微博窗口');
				$(".weibo-show").stop().animate({left: 60}, 500);
			}
			else {
				$(this).addClass('sns-weibo-open').children('span').html('关闭微博窗口');
				if ($('.icon-category').hasClass('list-open'))
				{
					$('.icon-category').click();
				}
				$(".weibo-show").stop().animate({left: 320}, 500);
			}
		});
		
		
		document.addEventListener("touchstart", function(){}, true);
		
		//Sidebox Close and Open 
		$(".sidebox > h2").click(function(){
			if ($(this).parent().height()>50) {
				$(this).parent().height(50);
			} else {
				$(this).parent().height('');
			}
		});
		
		//#categories
		$("#categories").find('select').change(function(){
			window.location.href=$(this).val();
		});
		
		//loading 
		$('.loading').animate({'width':'95%'},9000);
		$(window).load(function()
		{
			$('.circle-loading').fadeOut(300);
			$('.loading').stop().animate({'width':'100%'},300,function()
			{
				$(this).fadeOut(300);
			});
		});
		
	});