//添加商品-属性信息-删除属性
function deleteNewSku(obj)
{
	var index=$(obj).parents('.goodsSkuTable').index();
	$('.goodsSkuTable:gt('+index+')').each(function(){
		var attrNum=$(this).find('.skuNo').text();
		var skuNo=attrNum-1;
		
		$(this).find('.skuNo').text(skuNo);
		var i=skuNo-1;
		var regS = new RegExp('skuname\\['+skuNo+'\\]','g');
		var html=$(this).html().replace(regS,'skuname['+i+']');//更改skuname[]数组编号
		var regS1 = new RegExp('goods_thumb_'+skuNo+'','g');
	    html= html.replace(regS1,'goods_thumb_'+i);//更改缩略图编号
		$(this).html(html)
		
	});
	$(obj).parents('.goodsSkuTable').remove();
	
};

//商品分类-编辑属性-验证是否为空
function addClassyProperty(){
	if($('.checkSon:checked').length==0)
	{
		tipsPop({title:'请至少选择一个属性！',buttons:{'确定':'closePop()'}});
		return false;
	}
};

/*左侧显示或者隐藏*/
function showOrHidden(str){
    if($(str).next("ul").is(":hidden")){
        $(str).next("ul").show();
    }else{
        $(str).next("ul").hide();
    }
}



/* 加载右侧数据 */
function loadRight(url){
    $("#my_iframe").attr("src",url);
	$('html, body').scrollTop(0);
}

/* 参数过滤 */
function parameterFilter(str){
	return str;
}

$(document).ready(function(e) {
    $('#addexpress_btn').click(function(){

		$('#addexpress').toggle();
	});
	
	$('.expressul li').hover(function(){
		$('.expressul_dele',this).show();
	},function(){
		$('.expressul_dele',this).hide();
	});
	
	$('#express_cost').on('click','.edit_text',function(){
		$(this).removeClass('edit_text');
	});
	
});

/*弹出框*/
function tips(tipsText){
	$error              = '<span class="error">'+tipsText+'</span>';
	$('.main',window.parent.document).append($error);
	setTimeout(
		function(){
			$('.error',window.parent.document).hide(500);
		},1000
	);
	setTimeout(
		function(){
			$('.error',window.parent.document).remove();
		},1500
	);	
}

function tipsPop(paras){//tipsPop({title:'',content:'',buttons:{'文本'：'执行函数','文本':'执行函数'},time:'1000',url:'跳转地址'})

	$div='<div id="tipsPop">';
	$div+='<div class="tipsPop_main">';
	if(paras.title){
		$div+='<div class="tipsPop_title">'+paras.title+'</div>';
	}
	if(paras.content){
		$div+='<div class="tipsPop_con">'+paras.content+'</div>';
	}
	$div+='</div>';
	
	var count=0;

	if(paras.buttons){
		$div+='<div class="tipsPop_btn">';	
		$.each(paras.buttons,function(i,n){
			$div+='<a href="javascript:;" onclick="'+n+'" >'+i+'</a>';
			count++;
		}); 
		if(count==2)
		{
			$div+='<div class="tipsPop_btn_line"></div>';
		}
		$div+='</div>';
	}
	
    $div+='</div><div id="layer" style="display:block;"></div>';
    $('body').append($div);
	$('.tipsPop_btn a').width(1/$('.tipsPop_btn a').length*100+'%')
	
	if(paras.time)//时间参数存在，自动跳转
	{
		setTimeout(
		function(){
			$('#tipsPop').hide(500);
			$('#layer').hide();
		},paras.time
		);
		setTimeout(
			function(){
				$('#tipsPop,#layer').remove();
				if(paras.url)
				{
                    location.href = paras.url;
				}
			},(parseInt(paras.time)+500)
		);	
		
	}
}
//关闭提示框
function closePop(){
	$('#tipsPop,#layer').remove();
}

//url跳转
function urlTips(url){
    location.href=url;
}




//表单验证空
function subForm(){
	var empty=0;
	$('[must*="ture"]').each(function(){
		
		var mustVal=$(this).val();
		if(mustVal=='')
		{
			$(this).next('.tips').text('*不能为空！');
			empty++;
		}
		else
		{
			$(this).next('.tips').text('*');
		}
		
	});
	
	
	if($('#tabchild1').length>0)
	{
		if($('#tabchild1').is(':visible'))
		{
			$('#tabchild2 .tips').each(function(){
				if($(this).text()=='*不能为空！')
				{
					tipsPop({title:'属性信息还未填写！',buttons:{'确定':'closePop()'}}); 
					return false;
				}
				
			});
		}
		else if($('#tabchild2').is(':visible'))
		{
			$('#tabchild1 .tips').each(function(){
				if($(this).text()=='*不能为空！')
				{
					tipsPop({title:'基本信息还未填写！',buttons:{'确定':'closePop()'}}); 
					return false;
				}
				
			});
			
		}
	}
	if(empty>0)
	{
		return false;
	}
}

//购买验证空
function buyForm(){
	if($('#expressId').val()=='请选择')
	{
		tips('请选择快递！');
		return false;
	}
	if($('#csdq_tj').val()=='' || $('#qydq_tj').val()=='' || $('#addDet').val()=='')
	{
		tips('请填写好地址信息！');
		return false;
	}
	if($('#zip').val()=='')
	{
		tips('请填写邮编号码！');
		return false;
	}
}


