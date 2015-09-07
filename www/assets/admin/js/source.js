
/*拆分地址*/
function autoChangeAddress(a,baseUrl){
    var aList       = a.split("，");
    var aList_3     = aList[3].split(" ");
    $("#name").val(aList[0]);
    $("#tel").val(aList[1]);
    $("#phone").val(aList[2]);
    $("#addDet").val(aList_3[3]);
    $("#sfdq_tj").val(aList_3[0].substr(0,(aList_3[0].length-1)));
    $("#csdq_tj").val(aList_3[1]);
    $("#qydq_tj").val(aList_3[2]);
    $("#sfdq_title").html(aList_3[0].substr(0,(aList_3[0].length-1)));
    $("#csdq_title").html(aList_3[1]);
    $("#qydq_title").html(aList_3[2]);
    $("#zip").val(aList[4]);
    changeExpressCost($('#expressId').val(),$('#sfdq_tj').val(),$('#buy_goods_sku_weight').val(),baseUrl);
}

/*修改订单差异*/
function changeOrderDifference(a,orderId,baseUrl){
    var url         = baseUrl+"admin/orderaction/changeOrderDifference";
    var parmarr     = {orderId:orderId,diff:$(a).val()};
    rel             = ajaxMain(url,parmarr);
    location.reload();
}

/*改变运费信息*/
function changeExpressCost(expressId,endProvince,weight,baseUrl){
    var url         = baseUrl+"admin/orderaction/getExpressCost";
    var parmarr     = {expressId:expressId,endProvince: endProvince,weight:weight,num:$("#goodsNum").val()};
    rel             = ajaxMain(url,parmarr);
    $('#express_cost').html(rel);
    $('.express_cost').val(rel);
}

/*删除运费信息*/
function delExpressCost(a,costId,baseUrl){
    var url         = baseUrl+"admin/sourceaction/delExpressCost";
    var parmarr     = {costId:costId};
    rel             = ajaxMain(url,parmarr);
    a.parent().parent().hide();
}

/*增加运费信息*/
function addExpressLine(expressId,baseUrl){
    //数据库增加对应项目
    var url             = baseUrl+"admin/sourceaction/addExpressCost";
    var parmarr         = {expressId:expressId};
    var rel             = $.parseJSON(ajaxMain(url,parmarr));//数据转换成json格式

    var thisHtml        = $("#addroute").clone();
    thisHtml.html(thisHtml.html().replace(/newCostId/gm,rel)).attr('id','');
	
    //页面元素增加
    $('#addroute_btn').before(thisHtml);
    thisHtml.show();
}

/*添加快递公司*/
function addExpress(a,act,baseUrl){
    var url         = baseUrl+"admin/sourceaction/express";
    var parmarr     = {act:act,expressName:a.val()};
    var rel         = $.parseJSON(ajaxMain(url,parmarr));//数据转换成json格式

    if(!isNaN(rel.id)){
        location.reload();
//        var str         = '';
//        str             += "" +
//            "<li>"+
//            "<span onclick=\"sourceAjaxGetData('"+rel.id+"','"+baseUrl+"')\">"+rel.name+"</span>"+
//            "<a href='javascript:;' onclick=\"javascript:if(confirm('删除快递将导致所有用户有关该快递的运费设置丢失，确认删除？')){deleteExpress($(this),"+rel.id+",\'"+baseUrl+"\');}\" class='expressul_dele'>删除</a>"+
//            "</li>";
//        a.hide();
//        $(".expressul").append(str);
    }else{
        tips(rel.id,1000);
    }
}

/*删除快递公司*/
function deleteExpress(a,id,baseUrl){
    var url         = baseUrl+"admin/sourceaction/delExpress";
    var parmarr     = {id:id};
    rel             = ajaxMain(url,parmarr);
    a.parent().hide();
}

/*显示商品详情*/
function showGoodsDetail(a,goodsId,baseUrl){
	if($(a).parent().parent().next('#goods_info').length == 0)
	{
        /*获取数据*/
        var url         = baseUrl+"admin/sourceaction/showGoodsDetail";
        var parmarr     = {goodsId:goodsId};
        var rel         = $.parseJSON(ajaxMain(url,parmarr));//数据转换成json格式

        $div='<tr id="goods_info"><td colspan="10" align="left">';
        for(i=0;i<rel.goodsSku.length;i++){
            $div+='<div class="goods_info_main">';

            //输出缩略图
            $div+='<div class="goods_info_left">';
            if(rel.goodsSku[i]['goods_thumb']){
                $div+='缩略图：<img src=" '+rel.goodsSku[i]['goods_thumb']+'" width="150">';
            }else{
                $div+='&nbsp;'
            }
            $div += '</div>';

            //输出color属性
            if(rel.goodsSku[i]['color_value']){
                $div+='<div class="goods_info_left">color：'+rel.goodsSku[i]['color_value']+'<br/>';
            }

            //输出size属性
            if(rel.goodsSku[i]['size_value']){
                $div+='size：'+rel.goodsSku[i]['size_value']+'<br/>';
            }

            //输出自定义属性
            if(rel.goodsSku[i]['customSku']){
                for(j=0;j<rel.goodsSku[i]['customSku'].length;j++){
                    for (key in rel.goodsSku[i]['customSku'][j]) {
                        $div+=key+'：'+rel.goodsSku[i]['customSku'][j][key]+'<br/>';
                    }
                }
            }

            //输出库存数量
            if(rel.market_price){
                $div+='库存：'+(Number(rel.goodsSku[i]['sku_number']))+'<br/>';
            }

            //输出商品市场价
            if(rel.market_price){
                $div+='<br/>市场价：'+(Number(rel.market_price))+'<br/>';
            }
            //输出商品价
            if(rel.market_price){
                $div+='售价：'+(Number(rel.shop_price))+'<br/>';
            }

            //输出属性价格
            if(rel.market_price){
                $div+='属性价：'+(Number(rel.goodsSku[i]['sku_price']))+'<br/>';
            }

            //输出折扣
            if(rel.discount){
                $div+='折扣：'+(Number(rel.discount))+'（折）<br/>';
            }

            //输出购买价格
            var shopPrice = 0;
            if(rel.shop_price>0){
                shopPrice = rel.shop_price;
            }else{
                shopPrice = rel.market_price*rel.discount/10;
            }
            $div+='<br/>购买价格：'+(Number(shopPrice)+Number(rel.goodsSku[i]['sku_price']))+'（商品价格*商品折扣+属性价格）<br/>';

            $div+='</div>';

            //加载购买FORM
            if(rel.goodsSku[i]['sku_number'] > 0){
                var weight          = 1.5;
                if(rel.goodsSku[i]['goods_weight']){
                    weight      = rel.goodsSku[i]['goods_weight'];
                }
               
            }

            $div+='<div class="clear"></div></div>';
        }
        $div+='</td></tr>';

        /*显示内容*/
		$('#goods_info').remove();
   		$(a).parent().parent().after($div);
    	$('#goods_info').slideDown();
	}
	else
	{
		$('#goods_info').remove();
	}
}

/*购买产品快递弹框*/
function addGoods(goodsId,goodsSkuId,goodsSkuWeight){
    $('#buy_goods_id').val(goodsId);
    $('#buy_goods_sku_id').val(goodsSkuId);
    $('#buy_goods_sku_weight').val(goodsSkuWeight);
    $('#addGoods').show();
	$('#layer').show();
}
/*关闭 购买产品快递弹框*/
function addGoodsClose(obj){
    $(obj).parent().hide();
    $('#layer').hide();
}

/*删除商品*/
function delBrand(a,id,baseUrl){
    var url         = baseUrl+"admin/sourceaction/delBrand";
    var parmarr     = {id:id};
    rel             = ajaxMain(url,parmarr);
    location.reload();
}

/*删除商品*/
function delGoods(a,id,baseUrl){
    var url         = baseUrl+"admin/sourceaction/delGoods";
    var parmarr     = {id:id};
    rel             = ajaxMain(url,parmarr);
    location.reload();
}

/*删除商品属性*/
function delGoodsSku(id,type,baseUrl){
    var url         = baseUrl+"admin/sourceaction/delGoodsSku";
    var parmarr     = {id:id,type:type};
    rel             = ajaxMain(url,parmarr);
    location.reload();
}

/*快递显示或者隐藏*/
function expressShowOrHidden(str){
    if($(str).next("ul").is(":hidden")){
        $(str).next("ul").show();
    }else{
        $(str).next("ul").hide();
    }
}

/*修改邮费信息*/
function changeExpress(a,id,act,baseUrl){
	if(a.val()=="")
	{
		tips('不能为空！',1000)
	}
	else
	{
   		var url         = baseUrl+"admin/sourceaction/changeExpress";
    	var parmarr     = {act:act,value:a.val(),id:id};
    	var rel         = $.parseJSON(ajaxMain(url,parmarr));//数据转换成json格式
    	a.addClass('edit_text');
	}
	
}

/* 取邮费信息  */
function sourceAjaxGetData(expressId,baseUrl){
    if(expressId){
        $.ajax({
            type: "post",
            url: baseUrl+"admin/sourceaction/express/",
            dataType: "json",
            data:{id:expressId,act:'getdate'},
            success: function (data) {
                str                         = "<table class='listTab' cellpadding='0' cellspacing='0' bordercolor='#e4e4e4' border='1'><tr height='39' style='font-size:13px;'><td>出发省份</td><td>到达省份</td><td>首重(kg)</td><td>首重价格(元)</td><td>续重(kg)</td><td>续重价格(元)</td><td>操作</td></tr>";
                if(data != 'doNotHaveAnything'){
                    /*处理所有省份信息*/
                    var provinceList            = data['allProvince'];
                    $.each(data,function(index,val){
                        if(index != 'allProvince'){
                            str                     += "<tr height='40'>";
                            str                     += "<td width='20%'><select onchange=\"changeExpress($(this),'"+val.cost_id+"','changeStartProvince','"+baseUrl+"')\">";
                            var isSelect            = '';
                            for(i=0;i<provinceList.length;i++){
                                isSelect            = '';
                                if(val.start_province_id == provinceList[i].province_id){
                                    isSelect               = "selected='selected'";
                                }
                                str                     += "<option value='"+provinceList[i].province_id+"' "+isSelect+">"+provinceList[i].province_name+"</option>";
                            }
                            str                     += "</select></td>";
                            str                     += "<td width='20%'><select onchange=\"changeExpress($(this),'"+val.cost_id+"','changeEndProvince','"+baseUrl+"')\">";
                            for(i=0;i<provinceList.length;i++){
                                isSelect            = '';
                                if(val.end_province_id == provinceList[i].province_id){
                                    isSelect               = "selected='selected'";
                                }
                                str                     += "<option value='"+provinceList[i].province_id+"' "+isSelect+">"+provinceList[i].province_name+"</option>";
                            }
                            str                     += "</select></td>";
                            str                     += "<td width='10%'><input type='text' class='edit_text' value='"+val.first_height+"' onblur=\"changeExpress($(this),'"+val.cost_id+"','changeFirstHeightProvince','"+baseUrl+"')\"/></td>";
                            str                     += "<td width='10%'><input type='text' class='edit_text' value='"+val.first_height_cost+"' onblur=\"changeExpress($(this),'"+val.cost_id+"','changeFirstHeightCostProvince','"+baseUrl+"')\"/></td>";
                            str                     += "<td width='10%'><input type='text' class='edit_text' value='"+val.last_height+"' onblur=\"changeExpress($(this),'"+val.cost_id+"','changeLastHeightProvince','"+baseUrl+"')\"/></td>";
                            str                     += "<td width='10%'><input type='text' class='edit_text' value='"+val.last_height_cost+"' onblur=\"changeExpress($(this),'"+val.cost_id+"','changeLastHeightCostProvince','"+baseUrl+"')\"/></td>";
                            str                     += "<td width='10%'><a href='javascript:;' onclick=\"delExpressCost($(this),'"+val.cost_id+"','"+baseUrl+"')\">删除</a></td>"
                            str                     += "</tr>";
                        }
                    });
                    str                         += "</table>";
                }else{
                    str                         += "</table>";
                }
				 str+= "<div id='addroute_btn'><b><a href='javascript:;' onclick=\"addExpressLine("+expressId+",'"+baseUrl+"')\">新增快递路线</a></b></div>";
                $("#express_cost").html(str);

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }else{
        alert('参数错误！');
    }
}

//添加/编辑商品-添加属性
function addAttr(obj,num,skuNum){//obj-this,num-数组下表0或1,1指新加，0是编辑
    var attrNum=$('.skuNo').length;//已添加的属性个数
	$newTab=$('.goodsSkuTable').eq(0).clone();//复制一组属性
	var skuNo=attrNum+1;//新添加属性组的编号
	$newTab.find('.skuNo').text(skuNo);//更改属性编号
	$newTab.find('.deleteNewSku').append('<a href="javascript:;" class="color900" onclick="deleteNewSku(this)">删除</a>');//添加删除按钮
	if(num==1)//添加属性
	{
		
		$newTab=$newTab.html().replace(/skuname\[0\]/gm,'skuname['+attrNum+']');//更改skuname[]数组编号
		$newTab=$newTab.replace('goods_thumb_0','goods_thumb_'+attrNum);//更改缩略图编号
	}
	else//编辑属性
	{
		var regS = new RegExp('skuname\\['+skuNum+'\\]','g');
		$newTab.find('input[type="text"]').attr('value','');
		
		$newTab.find('img').remove();
		$newTab.find('input[type="file"]').attr('value','');
		$newTab=$newTab.html().replace(regS,'skuname['+attrNum+']');//更改skuname[]数组编号
		var regS1 = new RegExp('goods_thumb_'+skuNum+'','g');
		$newTab=$newTab.replace(regS1,'goods_thumb_'+attrNum);//更改缩略图编号
		
	}
	
	$newTab='<table class="goodsTable goodsSkuTable">'+$newTab+'</table>';
	$(obj).before($newTab);//添加属性
};


//支付
function Payment(orderId,orderMoney){
    $(".jsReplaceOrderId").val(orderId);
    $("#orderMoney").html('￥'+orderMoney+'（订单金额+订单差异金额）');
	$('#Payment,#layer').show();

}

//配送
function Distribution(orderId){
    $(".jsReplaceOrderId").val(orderId);
	$('#Distribution,#layer').show();
}

//确认收货
function receiveGoods(orderId,baseUrl){
    var url         = baseUrl+"admin/orderaction/receiveGoods";
    var parmarr     = {order_id:orderId};
    ajaxMain(url,parmarr);
    tipsPop({title:'提示信息',content:'操作成功！',time:'2000',url:baseUrl+'admin/orderaction/orderList'});
}

//确认收货 -- 重新配送
function receiveGoodsResend(orderId,baseUrl){
    var url         = baseUrl+"admin/orderaction/receiveGoods";
    var parmarr     = {order_id:orderId,order_type:8};
    ajaxMain(url,parmarr);
    tipsPop({title:'提示信息',content:'操作成功！',time:'2000',url:baseUrl+'admin/orderaction/orderList'});
}

//退货
function ReturnGoods(orderId){
    $(".jsReplaceOrderId").val(orderId);
	$('#ReturnGoods,#layer').show();

}

//换货
function ExchangeGoods(orderId){
    $(".jsReplaceOrderId").val(orderId);
	$('#ExchangeGoods,#layer').show();

}

//重新配送
function ReDistribution(orderId){
    $(".jsReplaceOrderId").val(orderId);
	$('#ReDistribution,#layer').show();
}

//退款
function Refund(orderId,reason,intro){
    $(".jsReplaceOrderId").val(orderId);
    $("#exitReason").html(reason);
    $("#exitIntro").html(intro);
	$('#Refund,#layer').show();
}

function addTkClose(obj){
	$(obj).parent().hide();
	$('#layer').hide();
}