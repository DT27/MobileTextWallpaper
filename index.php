<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>手机文字壁纸生成</title>
		<meta name="keywords" content="iPhone5s文字壁纸生成,手机文字壁纸,iphone5s文字壁纸,手机壁纸,手机文字壁纸生成"/>
		<meta name="description" content="给喜欢的壁纸加上个性文字，励志名言，表达爱意，展示心情，想写什么就写什么的文字控神器！程序正在开发初期，以后还会支持字体选择~希望大家都能够拥有自己喜欢的个性文字壁纸~~~" />
		<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no" />
		<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
		<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<script type="text/javascript">
			if(document.location!="http://dt27.cn/5s/")
				window.location.href="http://dt27.cn/5s/";
		</script>
		<script type="text/javascript" src="js/head.load.min.js"></script>
		<script>
			//var startTime = new Date().getTime();
			head.load({plugins:"js/plugins.js"});
			head.ready("plugins",function() {
				head.load("js/script.js");
			});
		</script>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
	</head>

	<body>
		<img src="img/screen.jpg" width="415" height="369" style=" position:absolute;top:-500px;" />
		<ol class="breadcrumb">
			<li><a href="http://tieba.baidu.com/p/2862988715" target="_blank">贴吧互动</a></li>
			<li><a href="javascript:$('#issuesModal').modal('show');">问题反馈</a></li>
		</ol>
		<!-- style="display:none;"
		-->
		<form class="form-signin" role="form" id="form1" action="uJ6Yvus8nGwH6.php" enctype="multipart/form-data" method="post" target="ifm">
			<div class="container" id="top">
		<div class="alert-danger" align="left">　　程序还不完善，如果发现任何问题，请点击右上角的“问题反馈”提交问题，我会尽快修复。<br />
		　　图片上传速度取决于您的网络。不建议使用移动流量生成图片，每生成一次图片会耗费0.5-1.5MB流量。<br />
		　　样式正在不断添加，程序也在改进中，现在每到整点程序自动删除上个整点之前的图片，如果某个时间段程序生成的图片太多，会导致空间不足，无法生成或上传图片，等下个整点再试就可以了。等以后，我买新的服务器就不会有这问题了。
        <br />
		　　最进比较忙，所以一直没更新，抱歉~</div>
				<!--
				-->
				<div class="panel-group" id="accordionSizeInfo">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" href="#sizeInfo">
									iPhone5s壁纸尺寸说明
								</a>
							</h4>
						</div>
						<div id="sizeInfo" class="panel-collapse collapse">
							<div class="panel-body" align="left">	　　iPhone5s的动态效果会使壁纸有立体效果，原理是将壁纸放大，屏幕默认显示的只是壁纸中间部分，当手机转动时，系统会向反方向移动壁纸，产生立体效果。<br />	　　所以，5s自带壁纸尺寸都是744x1392，而不是屏幕分辨率的640x1136。如果你用640x1136的壁纸，还想壁纸全部显示在屏幕上，就必须到设置>辅助功能里开启减少动态效果。<br />　　样式里默认的尺寸全部是744x1392，不受动态效果开关影响。
							</div>
						</div>
					</div>
				</div>
				<p class="alert-warning"  id="tieba">贴吧客户端直接打开页面不能保存图片<br />
					请到手机浏览器里输入<a href="http://dt27.cn/5s"><span class="import">dt27.cn/5s</span></a>访问</p>
				<p class="bg-primary" id="chooseType">①样式选择<br /> <img src="img/p2.jpg" alt="样式2" class="img-thumbnail type" id="type1" onclick="ChangeType(1);">
					<img src="img/p3.jpg" alt="样式1" class="img-thumbnail type" id="type3" onclick="ChangeType(3);"> <img src="img/p4.jpg" alt="样式3" class="img-thumbnail type" id="type4" onclick="ChangeType(4);"> <img src="img/p5.jpg" alt="样式5" class="img-thumbnail type" id="type5" onclick="ChangeType(5);"> <img src="img/p6.jpg" alt="样式6" class="img-thumbnail type" id="type6" onclick="ChangeType(6);"> <img src="img/p7.jpg" alt="样式7" class="img-thumbnail type" id="type7" onclick="ChangeType(7);"></p>
			</div>
			<div class="container" id="t1">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a href="#imgbg" data-toggle="tab">使用背景图片</a></li>
					<li><a href="#colorbg" data-toggle="tab">使用纯色背景</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane" id="colorbg">
						<p class="alert-info colorBg" id="colorBg">背景颜色：<span class="input-group-addon">#</span><input type="text" class="input-sm iColorPicker " id="colorPickerT1" name="colorT1" value="e4d7c7" maxlength="6" onclick="iColorShow('colorPickerT1','icp_colorPickerT1')">
						</p>
					</div>
					<div class="tab-pane active" id="imgbg">
						<div class="alert bg-info" id="chooseBg">
							<div class="panel-group" id="accordion">
								<div class="panel panel-info">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
												使用模板背景图片
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
										<div class="panel-body">
											<img src="img/p2.jpg" alt="..." class="img-thumbnail type" id="type11" onclick="ChangeType(11);"> <img src="img/p11.jpg" alt="..." class="img-thumbnail type" id="type12" onclick="ChangeType(12);"> <img src="img/p13.jpg" alt="..." class="img-thumbnail type" id="type13" onclick="ChangeType(13);"> <img src="img/p14.jpg" alt="..." class="img-thumbnail type" id="type14" onclick="ChangeType(14);"> <img src="img/p15.jpg" alt="..." class="img-thumbnail type" id="type15" onclick="ChangeType(15);"> <img src="img/p16.jpg" alt="..." class="img-thumbnail type" id="type16" onclick="ChangeType(16);"> <img src="img/p17.jpg" alt="..." class="img-thumbnail type" id="type17" onclick="ChangeType(17);"> <img src="img/p18.jpg" alt="..." class="img-thumbnail type" id="type18" onclick="ChangeType(18);"> <img src="img/p19.jpg" alt="..." class="img-thumbnail type" id="type19" onclick="ChangeType(19);"> <img src="img/p20.jpg" alt="..." class="img-thumbnail type" id="type20" onclick="ChangeType(20);"> <img src="img/p22.jpg" alt="..." class="img-thumbnail type" id="type22" onclick="ChangeType(22);"> <img src="img/p23.jpg" alt="..." class="img-thumbnail type" id="type23" onclick="ChangeType(23);"> <img src="img/p24.jpg" alt="..." class="img-thumbnail type" id="type24" onclick="ChangeType(24);"> <img src="img/p25.jpg" alt="..." class="img-thumbnail type" id="type25" onclick="ChangeType(25);"> <img src="img/p26.jpg" alt="..." class="img-thumbnail type" id="type26" onclick="ChangeType(26);">
										</div>
									</div>
								</div>
								<div class="panel panel-info">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
												使用自定义背景图片
											</a>
										</h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
										<div class="panel-body">
											<p class="alert alert-danger">
												上传744*1392的图片会原尺寸生成，其他尺寸会缩放填充或裁剪到744*1392</p>
											<div class="btn btn-success fileinput-button">
												<i class="icon-plus icon-white"></i>
												<span>选择图片</span>
												<!-- The file input field used as target for the file upload widget -->
												<input id="upfilet1" type="file" name="upfilet1" style="width:155px; height:37px;">
											</div>
											<button type="submit" id="triggerUpload" class="btn btn-primary"><i class="icon-upload icon-white"></i> 立即上传</button>
											<iframe id='ifm' name='ifm' style="display:none"></iframe>
											<input type="hidden" value="img/11.png" name="bgImgt1" id="bgImgt1" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="logo" id="logo" value="2" />
				<div class="btn-group btn-group-sm" id="logoGroup">
					<button type="button" class="btn btn-default" onclick="$('#logo').val(0);$('#logoGroup button').removeClass('active');$(this).addClass('active');$('#logoImg').hide();">不显示</button>
					<button type="button" class="btn btn-default" onclick="$('#logo').val(1);$('#logoImg').attr('src','img/iphone5s_title.png').show();$('#logoGroup button').removeClass('active');$(this).addClass('active');">黑5s</button>
					<button type="button" class="btn btn-default active" onclick="$('#logo').val(2);$('#logoImg').attr('src','img/iphone5s_title_white.png').show();$('#logoGroup button').removeClass('active');$(this).addClass('active');">白5s</button>
					<button type="button" class="btn btn-default" onclick="$('#logo').val(3);$('#logoImg').attr('src','img/apple_logo.png').show();$('#logoGroup button').removeClass('active');$(this).addClass('active');"><i class="icon-apple-black"></i></button>
					<button type="button" class="btn btn-default" onclick="$('#logo').val(4);$('#logoImg').attr('src','img/apple_logo_white.png').show();$('#logoGroup button').removeClass('active');$(this).addClass('active');"><i class="icon-apple-white"></i></button>
				</div>
				<h2><img id="logoImg" src="img/iphone5s_title_white.png" width="80%" /> </h2>
				<p class="alert-info" id="colorText">文字颜色：<span class="input-group-addon">#</span><input type="text" class="input-sm iColorPicker " id="colorPickerTText" name="colorTText" value="fff" maxlength="6" onclick="iColorShow('colorPickerTText','icp_colorPickerTText')">
				</p>
				<input type="text" name="text" class="form-control" placeholder="你他妈吃天胆了" value="你他妈吃天胆了">
				<input type="text" name="text0" class="form-control" placeholder="敢动老子的手机" value="敢动老子的手机">
				<input type="text" name="text3" class="form-control" value="">
				<input type="hidden" name="finger" id="finger" value="1" />
				<div class="btn-group btn-group-sm" id="fingerGroup">
					<button type="button" class="btn btn-default" onclick="$('#finger').val(0);$('#fingerGroup button').removeClass('active');$(this).addClass('active');$('#fingerImg').hide();">不显示</button>
					<button type="button" class="btn btn-default active" onclick="$('#finger').val(1);$('#fingerGroup button').removeClass('active');$(this).addClass('active');$('#fingerImg').attr('src','img/finger.png').show();">指纹</button>
					<button type="button" class="btn btn-default" onclick="$('#finger').val(2);$('#fingerImg').attr('src','img/apple.png').show();$('#fingerGroup button').removeClass('active');$(this).addClass('active');$('#fingerImg').show();"><i class="icon-apple-black"></i></button>
					<button type="button" class="btn btn-default" onclick="$('#finger').val(3);$('#fingerImg').attr('src','img/apple_white.png').show();$('#fingerGroup button').removeClass('active');$(this).addClass('active');$('#fingerImg').show();"><i class="icon-apple-white"></i></button>
				</div>
				<h2><img id="fingerImg" src="img/finger.png" width="20%" /> </h2>
				<input type="text" name="text1" class="form-control" placeholder="不要问我密码" value="不要问我密码">
				<input type="text" name="text2" class="form-control" placeholder="我这是5S，指纹解锁" value="我这是5S，指纹解锁">
			</div>
			<!-- /container -->

			<div class="container" id="t3">

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" id="myTabt3">
					<li class="active"><a href="#colorBgt3" data-toggle="tab">使用纯色背景</a></li>
					<li><a href="#chooseBgt3" data-toggle="tab">使用图片背景</a></li>
				</ul>
                <!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="colorBgt3">
                                        <div class="alert-info">
					②背景颜色：<span class="input-group-addon">#</span><input type="text" class="input-sm iColorPicker " id="colorPickerT3" name="colorT3" value="f1e9de" maxlength="6" onclick="iColorShow('colorPickerT3','icp_colorPickerT3')">
				</div>
                                        </div>
				<!-- Tab panes -->
					<div class="tab-pane panel-info" id="chooseBgt3">
											<div class="alert-info">
                                            <p class="alert-info">
												上传744*1392的图片会原尺寸生成，其他尺寸会缩放填充或裁剪到744*1392</p>
											<div class="btn btn-success fileinput-button">
												<i class="icon-plus icon-white"></i>
												<span>选择图片</span>
												<!-- The file input field used as target for the file upload widget -->
												<input id="upfilet3" type="file" name="upfilet3" style="width:155px; height:37px;">
											</div>
											<button type="submit" id="triggerUpload" class="btn btn-primary"><i class="icon-upload icon-white"></i> 立即上传</button>
											<iframe id='ifm' name='ifm' style="display:none"></iframe>
											<input type="hidden" value="" name="bgImgt3" id="bgImgt3" />
									</div></div>
</div>

				<p class="bg-info">③文字颜色：<span class="input-group-addon">#</span><input type="text" class="input-sm iColorPicker " id="colorPickerT3Text" name="colorT3Text" value="000" maxlength="6" onclick="iColorShow('colorPickerT3Text','icp_colorPickerT3Text')" />
				</p>
				<p class="alert alert-danger">文字最佳个数<br />中文不超过10个，英文不超过25个<br />以后会改进为根据字数自动更改文字大小</p>
				<input type="text" name="lovetext" class="form-control" placeholder="我会想你" value="我会想你" />
				<input type="text" name="lovetext0" class="form-control" placeholder="I will think of you" value="I will think of you" />
				<input type="text" name="lovetext1" class="form-control" placeholder="在漫漫长路的每一步" value="在漫漫长路的每一步" />
				<input type="text" name="lovetext2" class="form-control" placeholder="every step of the way" value="every step of the way" />
				<input type="text" name="lovetext3" class="form-control" placeholder="中文" value="" />
				<input type="text" name="lovetext4" class="form-control" placeholder="English" value="" />
				<h4 class="info">&nbsp;</h4>
                <p class="alert-info">生成后个别字无法显示的选择雅黑即可</p>
				<div class="row" id="t3Names">
					<div class="col-xs-5"><div class="btn-group btn-group-sm" id="fontGroup">
                    	名字字体：<br />
                    <input type="hidden" name="font" id="font" value="0" />
					<button type="button" class="btn btn-default active" onclick="$('#font').val(0);$('#fontGroup button').removeClass('active');$(this).addClass('active');">手写体</button>
					<button type="button" class="btn btn-default" onclick="$('#font').val(1);$('#fontGroup button').removeClass('active');$(this).addClass('active');">雅黑</button>
				</div></div>
					<div class="col-xs-3">
						<input type="text" name="loveName1" id="loveName1" class="form-control" placeholder="张三" value="" title="只输入一个名字自动居中" />
					</div>
					<div class="col-xs-3">
						<input type="text" name="loveName2" id="loveName2" class="form-control" placeholder="李四四" value="" title="只输入一个名字自动居中" />
					</div>
					<div></div>
				</div>
			</div>
			<div class="container" id="t4">
				<p class="alert-info">请输入最少两个汉字，最多六个汉字，不需要第二行直接留空就行了。</p>
				<input type="text" name="t41" class="form-control" placeholder="" value="贴吧专属神机" />
				<input type="text" name="t42" class="form-control" placeholder="" value="" />
			</div>
			<!-- /container -->
			<div class="container" id="t5">
				<input type="hidden" name="sex" id="sex" value="0" />
				<div class="btn-group btn-group-sm" id="sexGroup">
					<button type="button" class="btn btn-default active" onclick="$('#sex').val(0);$('#sexGroup button').removeClass('active');$(this).addClass('active');$('#t5').css('background-color','#ffd2c3');">女生版</button>
					<button type="button" class="btn btn-default" onclick="$('#sex').val(1);$('#sexGroup button').removeClass('active');$(this).addClass('active');$('#t5').css('background-color','#a3c9e6');">男生版</button>
				</div>
				<div class="loversRow">
					<div class="col-xs-6">
						<div class="input-group"> <span class="input-group-addon">女</span>
							<input type="text" name="t51" class="form-control" value="">
						</div>
						<!-- /input-group -->
					</div>
					<!-- /.col-lg-6 -->
					<div class="col-xs-6">
						<div class="input-group"> <span class="input-group-addon">男</span>
							<input type="text" name="t52" class="form-control" value="">
						</div>
						<!-- /input-group -->
					</div>
					<!-- /.col-lg-6 -->

				</div>
				<!-- /.row -->
			</div>
			<!-- /container -->
			<!-- /container t5 -->
			<div class="container" id="t6">
				<!--
				<div class="alert alert-danger">此样式测试中，暂时无法正常使用。<br />预计完成时间：先吃晚饭。。。</div>
				-->
				<div class="btn-group btn-group-sm" id="sexGroup6">
					<input type="hidden" name="sex6" id="sex6" value="2" />
					<button type="button" class="btn btn-default active" onclick="$('#sex6').val(2);$('#sexGroup6 button').removeClass('active');$(this).addClass('active');$('#t6').css('background','url(img/62.jpg)');">合体版</button>
					<button type="button" class="btn btn-default" onclick="$('#sex6').val(0);$('#sexGroup6 button').removeClass('active');$(this).addClass('active');$('#t6').css('background','url(img/60.jpg) center no-repeat');">女生版</button>
					<button type="button" class="btn btn-default" onclick="$('#sex6').val(1);$('#sexGroup6 button').removeClass('active');$(this).addClass('active');$('#t6').css('background','url(img/61.jpg) center no-repeat');">男生版</button>
				</div>

				<input type="text" name="t6" class="form-control" placeholder="" value="在一起，永远" />
			</div>
			<!-- /container t6 -->

			<div class="container" id="t7">
				<p class="alert-info">第一行最多6个汉字，第二行最多11个</p>
				<input type="text" name="t71" class="form-control" placeholder="" value="我想念你的吻" />
				<input type="text" name="t72" class="form-control" placeholder="" value="和嘴角冰淇淋的味道" />
			</div>
			<!-- /container t7 -->
			<div class="container" id="bottom">
				<!-- -->
				<p class="alert alert-success pay"><span> 欢迎赞助  </span><a href="https://me.alipay.com/dt27" target="_blank">支付宝:</a> dragonet1943@gmail.com</p>
				<input type="hidden" name="type" id="type" value="11" />
				<button type="button" class="btn btn-lg btn-primary btn-block" data-toggle="modal" data-target="#myModal" id="create">End ☞ 生成 </button>
				<!-- JiaThis Button BEGIN --><div class="alert alert-success">
					<div class="jiathis_style_32x32">
						<span style="float:left; line-height:32px; font-size:22px;">&nbsp;分享&nbsp;</span><a class="jiathis_button_qzone"></a>
						<a class="jiathis_button_tsina"></a>
						<a class="jiathis_button_tqq"></a>
						<a class="jiathis_button_renren"></a>
						<a href="http://www.jiathis.com/share?uid=895611" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank"></a>
						<a class="jiathis_counter_style"></a>
					</div></div>
				<!-- JiaThis Button END -->

			</div>
			<!-- /container t4 -->
		</form>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<p class="alert-info" id="loadInfo">复杂背景加载较慢，请耐心等待</p>
					<div class="modal-body" style="text-align:center;"><button type="submit" class="btn btn-lg btn-success btn-block" data-dismiss="modal">返回</button> <img id="result" src="img/loading.gif" width="145"/> <button type="submit" class="btn btn-lg btn-success btn-block" data-dismiss="modal">返回</button> </div>
                    <div class="modal-footer" id="bottom">&nbsp;</div>
				</div>
			</div>
		</div>

		<!-- 反馈 Start -->
		<div class="modal fade bs-example-modal-lg" id="issuesModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">问题反馈</h4>
					</div>
					<div class="modal-body"><div class="form-group">
							<label for="issuesTitle">标题</label>
							<input type="text" class="form-control" placeholder="必填" name="issuesTitle" id="issuesTitle" autocomplete="off" /></div><div class="form-group">
							<label for="issuesContent">描述</label>
							<textarea class="form-control" rows="6" name="issuesContent" id="issuesContent"></textarea>
							<button type="button" id="issuesCreate" class="btn btn-primary">提交问题</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade bs-example-modal-sm" id="bugSuccess" style="display: none;">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header"></div>
					<div class="modal-body alert">
						提交成功！</div></div>
			</div>
		</div>
		<!-- 反馈 End -->

		<script type="text/javascript" src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
		<div style="display:none">
			<script type="text/javascript" src="http://s13.cnzz.com/stat.php?id=5811191&web_id=5811191"></script>
			<script type="text/javascript" src="http://hm.baidu.com/h.js?c543867e51d60fd3dd4dea992c7cee4b"></script>
		</div>
		<!--
		-->
		<script type="text/javascript" >
			var jiathis_config={
				data_track_clickback:false,
				summary:"",
				shortUrl:true,
				hideMore:false
			};
		</script>
		<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js?uid=895611" charset="utf-8"></script>
	</body>
</html>