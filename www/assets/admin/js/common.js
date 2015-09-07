//多选
function checkAll(obj){
	if($(obj).is(':checked'))
	{	
		$('.checkSon').attr('checked',true);	
	}
	else
	{
		$('.checkSon').attr('checked',false);	
	}
	
};
//子复选框选择
function checkSon(){
	var checkedNum=$('.checkSon:checked').length;
	var checkNum=$('.checkSon').length;
	if(checkedNum==checkNum)
	{
		$('.checkAll').attr('checked',true);	
	}
	else
	{
		$('.checkAll').attr('checked',false);	
	}
};

window.onresize = function () {
    //登陆页
    if ($('#login').length > 0) {
        var winH = $(window).height();
        $('#login').css('padding-top', (winH - 701) / 2);
    }
}

$(function () {
	

	//显示图片
	$('.showPic').mouseover(function () {
		$(this).next().html('<img width="240" height="140" src="' + $(this).attr('rel') + '">');
		var top = $(this).offset().top;
		var left = $(this).offset().left;
		$(this).next().css({ 'top': top - 30, 'left': left + 17, 'display': 'block' });
	});
	//隐藏图片
	$('.showPic').mouseout(function () {
		$(this).next().css('display', 'none');
		$(this).next().html('');
	});
    
    //登陆页
    if ($('#login').length > 0) {
        var winH = $(window).height();
        $('#login').css('padding-top', (winH - 701) / 2);
    }

    if ($('.tkBox').length > 0) {
        var h = $('.tkBox').height();
        $('.tkBox').css('margin-top', -(h + 42) / 2);
    }

    var winHeight = $(window).height();
    $('#my_iframe').height(winHeight - 126);

    //tab切换

    $(".tabtitle li").click(function () {
        $(this).addClass('cur')
            .siblings().removeClass('cur')
            .end().parents('.tab').find('.tabchild').eq($(this).index()).show().siblings('.tabchild').hide();

    });

    /*左边栏目高度 start*/
    /*$('.left_nav,.main').height($(window).height()-99);
     $(window).resize( function(){
     $('.left_nav,.main').height($(window).height()-99);
     });*/

    /*左边栏导航*/
    $('.left_nav2').eq(0).addClass('open').find('ul').show();
    $('.left_nav2 h1').click(function () {
        $(this).siblings('ul').slideToggle(200)
            .end().parent().siblings().find('ul').slideUp(200);
        $(this).parent().addClass('open')
            .siblings().removeClass('open');
    });
    $('.left_nav2 li').click(function () {
        $('.left_nav2 li').removeClass('cur');
        $(this).addClass('cur');

    });
});

/*在线充值介绍显示*/
function onlinepayintroShow() {
    $('.onlinepayintro').toggle();
}

//在线充值弹框
function onlinePay() {
    $('#onlinePay,#layer').show();
}

/*关闭 在线充值弹框*/
function addGoodsClose(obj) {
    $(obj).parent().hide();
    $('#layer').hide();
}

//产品图片删除
function delgoodsphpto(dom, id, baseurl) {
    var url = "" + baseurl + "admin/sourceaction/delGoodsPhoto";
    var parmarr = {id: id};
    rel = ajaxMain(url, parmarr);
    if (rel) {
        dom.parent().parent().hide();
    }
}

//删除预约产品信息
function delGoodsSale(dom, id, baseurl) {
    var url = "" + baseurl + "admin/sourceaction/deleteGoodsSale";
    var parmarr = {id: id};
    rel = ajaxMain(url, parmarr);
    if (rel) {
        dom.parent().parent().hide();
    }
}

//删除门店管理
function delShopManage(dom, id, baseurl) {
    var url = "" + baseurl + "admin/articleaction/delShopManage";
    var parmarr = {id: id};
    rel = ajaxMain(url, parmarr);
    if (rel) {
        dom.parent().parent().hide();
    }
}

//删除订阅邮箱
function deleteSubscribeEmail(dom, id, baseurl) {
    var url = "" + baseurl + "admin/articleaction/delSubscribeEmail";
    var parmarr = {id: id};
    rel = ajaxMain(url, parmarr);
    if (rel) {
        dom.parent().parent().hide();
    }
}

//删除友情链接
function deleteFriendlyLinks(dom, id, baseurl) {
    var url = "" + baseurl + "admin/articleaction/delFriendlyLinks";
    var parmarr = {id: id};
    rel = ajaxMain(url, parmarr);
    if (rel) {
        dom.parent().parent().hide();
    }
}


//红包规则删除
function deleterdbagrule(dom, id, baseurl) {
    var url = "" + baseurl + "admin/activityaction/deleteRedbagrule";
    var parmarr = {id: id};
    rel = ajaxMain(url, parmarr);
    if (rel) {
        dom.parent().parent().hide();
    }
}

//红包删除
function deleteredaggift(dom, id, baseurl) {
    var url = "" + baseurl + "admin/activityaction/deleteRedbagrule";
    var parmarr = {id: id};
    rel = ajaxMain(url, parmarr);
    if (rel) {
        dom.parent().parent().hide();
    }
}

//优惠码规则删除
function deletediscountcoderule(dom, id, baseurl) {
    var url = "" + baseurl + "admin/activityaction/deleteDiscountCodeRule";
    var parmarr = {id: id};
    rel = ajaxMain(url, parmarr);
    if (rel) {
        dom.parent().parent().hide();
    }
}

//优惠码删除
function deleteactivitydiscountcodes(dom, id, baseurl) {
    var url = "" + baseurl + "admin/activityaction/deleteActivityDiscountCodes";
    var parmarr = {id: id};
    rel = ajaxMain(url, parmarr);
    if (rel) {
        dom.parent().parent().hide();
    }
}

//广告位删除
function deletespacs(dom, id, baseurl) {
    var url = "" + baseurl + "admin/advspacsaction/deleteAdvSpaces";
    var parmarr = {id: id};
    rel = ajaxMain(url, parmarr);
    if (rel) {
        dom.parent().parent().hide();
    }
}

//广告删除
function deleteAdvertiser(dom, id, baseurl) {
    var url = "" + baseurl + "admin/advspacsaction/deleteAdvertiser";
    var parmarr = {id: id};
    rel = ajaxMain(url, parmarr);
    if (rel) {
        dom.parent().parent().hide();
    }
}

//商品评论删除
function deleteReview(dom, id, baseurl) {
    var url = "" + baseurl + "admin/goodsreviewaction/delReview";
    var parmarr = {review_id: id};
    rel = ajaxMain(url, parmarr);
    if (rel) {
        dom.parent().parent().hide();
    }
}

//商品评论加精
function setCream(dom,id,baseUrl,creamNum){
    var url = "" + baseUrl + "admin/goodsreviewaction/setCream";
    var parmarr = {review_id: id,creamNum:creamNum};
    rel = ajaxMain(url, parmarr);
    if(creamNum==1){
        dom.parent().html('<a href="javasctipt:;" onclick="javascript:setCream($(this),'+id+',\''+baseUrl+'\',0)">是</a>');
    }else{
        dom.parent().html('<a href="javasctipt:;" onclick="javascript:setCream($(this),'+id+',\''+baseUrl+'\',1)">否</a>');
    }
}


/*文本框*/
function focusText(obj,tips,pwd)
{
	$(obj).addClass('focus');

    if($(obj).val() == tips)
	{
		$(obj).val('');	
	    if(pwd)
	    {
		   //	$(obj).attr('type','password');
		   if(pwd=='showpwd')
		   {
			   $(obj).hide();
			   $(obj).next('input').show().val('').focus();
		   }
		   
	    }
	}


	
};

function blurText(obj,tips,pwd)
{	
	if($(obj).val() == ''){
		$(obj).val(tips);	
		$(obj).removeClass('focus');
		if(pwd)
		{
			$(obj).hide();
		    $(obj).prev('input').show();
		}
	}
};
