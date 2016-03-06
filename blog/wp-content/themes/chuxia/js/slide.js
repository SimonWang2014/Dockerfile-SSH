window.onload = function(){
	// 幻灯
	TouchSlide({ 
		slideCell: "#slideBox",
		autoPage: true, // 自动分页
		titCell: ".hd ul", // 先开启autoPage:true， 导航元素对象
		mainCell: ".bd ul", // 切换元素的包裹层对象
		effect: "leftLoop", // 效果 || left：左滚动；|| leftLoop：左循环滚动；
		autoPlay: true, // 自动播放
		delayTime: 350, // 毫秒；切换效果持续时间（执行一次效果用多少毫秒）。
		interTime: 3000, // 毫秒；自动运行间隔（隔多少毫秒后执行下一个效果）
		prevCell: ".prev",
		nextCell: ".next"
	});
};