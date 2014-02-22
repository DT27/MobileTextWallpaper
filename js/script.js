var filename="";
$(function(){
	if(document.referrer.indexOf('baidu')>=0)
		$('#tieba').show('slow');
	$('#t3Names input').poshytip({
		className: 'tip-twitter',
		showOn: 'focus',
		showTimeout: 1,
		alignTo: 'target',
		alignX: 'center',
		offsetY: 5,
		allowTipHover: false,
		fade: false,
		slide: false
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		//e.target // activated tab
		// e.relatedTarget // previous tab
		if(e.target.href.indexOf("color") >= 0 ) {
			ChangeType(10);
		}
		else{
			ChangeType(11);
		}
	});

	//ChangeType(parseInt($('#type').val()));

	$('#myModal').on('show.bs.modal', function (e) {
		$.ajax({
			url:'./iPhone5sBG.php', //提交给哪个执行
			type:'POST',
			data:$('input').serialize(), //序列化表单的值
			success: function(src){
				filename=src;
				var img = new Image();
				$('#result')[0].src='./'+src;
				$("img").load(function(){
					$('#result').width('100%');
					$('#loadInfo').html("手机浏览器长按图片保存 <br /> 若无法保存，请使用自带safari浏览器");
				});
			}   //操作成功后的操作！msg是后台传过来的值
		});
	})
	$('#myModal').on('hidden.bs.modal', function (e) {
		$.ajax({
			url:'./iPhone5sBG.php?type=0&filename='+filename,
			type:'GET'
		});
		var img = new Image();
		$('#result')[0].src='./img/loading.gif';
		$("img").load(function(){
			$('#result').width('145');
			$('#loadInfo').html("背景复杂的加载较慢，请耐心等待");
		});
	});
	$('#issuesCreate').click(function () {
		$.ajax({
			url:'./iPhone5sBG.php?type=999',
			type:'POST',
			data:{IP:returnCitySN['cip'],Address:returnCitySN['cname'],title:$('#issuesTitle').val(),content:$('#issuesContent').val()},
			success:function(){
				$('#issuesModal').modal('hide');
				$('#issuesTitle').val('');
				$('#issuesContent').val('');
				$('#bugSuccess').modal('show');
				setTimeout("$('#bugSuccess').modal('hide')",1000);
			}
		});
	});
});
function GetRandomNum(Min,Max)
{
	var Range = Max - Min;
	var Rand = Math.random();
	return(Min + Math.round(Rand * Range));
}
/**
* 当前日期加时间(如:2014-02-18 23:23)
*
*/
function CurentTime()
{
	var now = new Date();
	var year = now.getFullYear();       //年
	var month = now.getMonth() + 1;     //月
	var day = now.getDate();            //日
	var hh = now.getHours();            //时
	var mm = now.getMinutes();          //分
	var ss = now.getSeconds();     //获取当前秒数(0-59)
	var clock = year;
	if(month < 10)
		clock += "0";
	clock += month;
	if(day < 10)
		clock += "0";
	clock += day;
	if(hh < 10)
		clock += "0";
	clock += hh;
	if (mm < 10)
		clock += '0';
	clock += mm;
	if (ss < 10)
		clock += '0';
	clock += ss;
	return(clock);
}


function ChangeType(type){
	if($('#type').val()==type)return;
	$('#type').val(type);
	document.getElementById('t1').style.display='none';
	document.getElementById('t3').style.display='none';
	document.getElementById('t4').style.display='none';
	document.getElementById('t5').style.display='none';
	$('.type').css("borderColor","white");
	$('.type').css("backgroundColor","white");
	$('#type'+type).css("borderColor","red");
	$('#type'+type).css("backgroundColor","red");
	switch(type){
		case 1:
			$('#type11').css("borderColor","red");
			$('#type11').css("backgroundColor","red");
			document.getElementById('t1').style.display='block';
			$('#t1').css('background','url(./img/11bg.jpg) center no-repeat');
			document.getElementById('bgImg').value = "img/11.png";
			break;
		case 3:
		case 4:
		case 5:
		case 6:
			document.getElementById('t'+type).style.display='block';
			document.getElementById('bgImg').value = "";
			break;
		case 10:
			$('#type1').css("borderColor","red");
			$('#type1').css("backgroundColor","red");
			document.getElementById('t1').style.display='block';
			$('#t1').css("background",'none #'+$('#colorPickerT1').val());
			break;
		case 11:
		case 12:
		case 13:
		case 14:
			$('#type1').css("borderColor","red");
			$('#type1').css("backgroundColor","red");
			document.getElementById('t1').style.display='block';
			$('#t1').css('background','url(./img/'+type+'bg.jpg) center no-repeat');
			document.getElementById('bgImg').value = "img/"+type+".png";
			break;
		default:
			$('#type1').css("borderColor","red");
			$('#type1').css("backgroundColor","red");
			document.getElementById('t1').style.display='block';
			$('#t1').css('background','url(./img/'+type+'bg.jpg) center no-repeat');
			document.getElementById('bgImg').value = "img/"+type+".png";
			break;
	}
}