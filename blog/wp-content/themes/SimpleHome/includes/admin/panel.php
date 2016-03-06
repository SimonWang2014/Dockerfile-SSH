<style>
	.wrap,textarea,em{font-family:'Century Gothic','Microsoft YaHei',Verdana;}
	fieldset{width:100%;border:1px solid #aaa;border-radius: 5px;padding-bottom:20px;margin-top:20px;-webkit-box-shadow:rgba(0,0,0,.2) 0px 0px 5px;-moz-box-shadow:rgba(0,0,0,.2) 0px 0px 5px;box-shadow:rgba(0,0,0,.2) 0px 0px 5px;}
	legend{margin-left:5px;padding:0 5px;color:#2481C6;background:#F1F1F1;cursor:pointer; font: normal 16px "Microsoft Yahei";}
	textarea{width:100%;font-size:11px;border:1px solid #aaa;background:none;-webkit-box-shadow:rgba(0,0,0,.2) 1px 1px 2px inset;-moz-box-shadow:rgba(0,0,0,.2) 1px 1px 2px inset;box-shadow:rgba(0,0,0,.2) 1px 1px 2px inset;-webkit-transition:all .4s ease-out;-moz-transition:all .4s ease-out;}
	textarea:focus{-webkit-box-shadow:rgba(0,0,0,.2) 0px 0px 8px;-moz-box-shadow:rgba(0,0,0,.2) 0px 0px 8px;box-shadow:rgba(0,0,0,.2) 0px 0px 8px;outline:none;}
</style>
<div class="wrap">
<h2>主题选项</h2>
<form method="post" action="">
	<fieldset>
	<legend><strong>首页SEO</strong></legend>
		<table class="form-table">
			<tr><td>
				<textarea name="keywords" id="keywords" rows="1" cols="70"><?php echo get_option('mytheme_keywords'); ?></textarea><br />
				<em>网站关键词（Meta Keywords），中间用半角逗号隔开。</em>
			</td></tr>
			<tr><td>
				<textarea name="description" id="description" rows="3" cols="70"><?php echo get_option('mytheme_description'); ?></textarea>
				<em>网站描述（Meta Description），针对搜索引擎设置的网页描述。</em>
			</td></tr>
		</table>
	</fieldset>
    <fieldset>
	<legend><strong>统计代码</strong></legend>
		<table class="form-table">
			<tr><td>
				<textarea name="analysis" id="analysis" rows="3" cols="70"><?php echo stripslashes(get_option('mytheme_analysis')); ?></textarea>
				<em>网站流量统计分析，推荐CNZZ,百度。</em>
			</td></tr>
		</table>
	</fieldset>
    <fieldset>
	<legend><strong>主题设置</strong></legend>
		<table class="form-table">
			<tr><td>
				<input type="text" name="owner" placeholder="Your Name" value="<?php echo get_option('mytheme_owner'); ?>" />
				<em>设置首页左侧栏主人名字</em>
			</td></tr>
			<tr><td>
				<input type="text" name="qq" placeholder="QQ Number" value="<?php echo get_option('mytheme_qq'); ?>" />
				<em>设置首页左侧栏QQ号</em>
			</td></tr>
            <tr><td>
				<input type="text" name="weichat" placeholder="WeiChat ID" value="<?php echo get_option('mytheme_weichat'); ?>" />
				<em>设置首页左侧栏微信号</em>
			</td></tr>
            <tr><td>
				<input type="text" name="weiboshow" placeholder="The Weibo Show URL" value="<?php echo get_option('mytheme_weiboshow'); ?>" />
				<em>设置首页左侧栏微博秀地址</em>
			</td></tr>
		</table>
	</fieldset>
    <fieldset>
	<legend><strong>主题颜色</strong></legend>
		<table class="form-table">
			<tr><td>
				<select name="skincolor">
                <?php
				$dir = TEMPLATEPATH.'/css/skin/'; //当前目录
				$list = scandir($dir); // 得到该文件下的所有文件和文件夹
				foreach($list as $file){//遍历
					$file_location=$dir."/".$file;//生成路径
					if(!is_dir($file_location) && $file!="." &&$file!=".."){ //判断是不是文件夹
						$value = str_replace(".css","",$file);
				?>
                	<option <?php if (get_option('mytheme_skincolor')==$value) echo "selected"; ?> value="<?=($value)?>"><?php echo $value; ?></option>
                <?php
					}
				}
				?>
                </select>
				<em>选择主题颜色</em>
			</td></tr>
		</table>
	</fieldset>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="保存设置" />
		<input type="hidden" name="mytheme_settings" value="save" style="display:none;" />
	</p>
</form>
</div>