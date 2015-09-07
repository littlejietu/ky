//ajax添加商品-获取属性
function getAttr(obj,baseUrl,goodsSku){
	var catId=$(obj).val();
	var url         = baseUrl+"admin/sourceaction/ajaxCategoryAttribute";
    var parmarr     = {catId:catId};
    //rel             = ajaxMain(url,parmarr);
	var rel             = $.parseJSON(ajaxMain(url,parmarr));//json格式转化成数组

    $oldGoodsSku=$('.goodsSku');//默认分类的属性
 	if(goodsSku)//编辑商品
	{
		//对比数据
		var array1=new Array();
		array1=goodsSku.split('|');	//goodsSku--原始属性数据
		var array1Length=array1.length;//原始有两组属性
		var num=array1Length;
		$('.goodsSkuTable').each(function(){
		    var index=$(this).index();//属性组序号

			var array2=new Array();
			for(k in array1)
			{
				array2[k]=array1[k].split(',');
			}

			if(index<array1Length)//原有的属性数组
			{
				$div='';
				for(i in rel)//选择的分类属性
				{
					$div+='<tr class="goodsSku"><td>'+rel[i].sku_key+'：</td><td><select class="normalSelect" name="skuname['+array2[index][0]+']['+rel[i].goods_sku_key_id+']">';
					for(j in rel[i].value)
					{
						$div+='<option value="'+rel[i].value[j].goods_sku_value_id+'"';

						for(l in array2[index])
						{
							if(rel[i].value[j].goods_sku_value_id==array2[index][l] && l>0){
								$div+='selected="true"';
							}
						}

						$div+='>'+rel[i].value[j].goods_sku_value+'</option>';
					}
					$div+='</select></td></tr>';
				}

			}
			else//新添加的属性数组
			{
			   $div='';
				for(i in rel)//选择的分类属性
				{
					$div+='<tr class="goodsSku"><td>'+rel[i].sku_key+'：</td><td><select class="normalSelect" name="skuname['+num+']['+rel[i].goods_sku_key_id+']">';
					for(j in rel[i].value)
					{
						$div+='<option value="'+rel[i].value[j].goods_sku_value_id+'">'+rel[i].value[j].goods_sku_value+'</option>';
					}
					$div+='</select></td></tr>';
				}
				num++;
			}


			$('.goodsSkuTitle',this).after($div);



		});
	}
	else//添加属性
	{
		$div='';
		$('.goodsSkuTable').each(function(){
			var no=$(this).index();
			var NoArray=new Array();
			for(i in rel)
			{
				$div+='<tr class="goodsSku"><td>'+rel[i].sku_key+'：</td><td><select class="normalSelect" name="skuname['+no+']['+rel[i].goods_sku_key_id+']">';
                    for(j in rel[i].value)
                    {
                        $div+='<option value="'+rel[i].value[j].goods_sku_value_id+'">'+rel[i].value[j].goods_sku_value+'</option>';
                    }
				$div+='</select></td></tr>';
			    }
            $('.goodsSkuTitle',this).after($div);
		});


	}
	$oldGoodsSku.remove()//将默认分类的属性删除
};


//ajax赠送红包
function sendRed(obj,baseUrl,type,user_id,id){
    tipsPop({title:'确认赠送红包？',buttons:{'确定':'sureSendRed(\''+baseUrl+'\',\''+type+'\',\''+user_id+'\',\''+id+'\')','取消':'closePop()'}})

};
function sureSendRed(baseUrl,type,user_id,id){
    closePop();
    var url         = baseUrl+"admin/activityaction/addRedbaggift";
    var parmarr     = {type:type,user_id:user_id,id:id};
    rel             = ajaxMain(url,parmarr);
	if(rel==1)
	{
		tipsPop({title:'赠送成功',time:'2000'});
	}
	else if(rel==2)
	{
		tipsPop({title:'赠送失败',time:'2000'});
	}
    else if(rel==3)
    {
        tipsPop({title:'活动未开始',time:'2000'});
    }
    else if(rel==4)
    {
        tipsPop({title:'活动已过期',time:'2000'});
    }
    else if(rel==5)
    {
        tipsPop({title:'不可重复赠送',time:'2000'});
    }

}

/*ajax删除会员*/
function delUser(a,baseUrl,userId){
    var url         = baseUrl+"admin/ucenteraction/delUser/";
    var parmarr     = {userId:userId};
    rel             = ajaxMain(url,parmarr);
    $(a).parent().parent().hide();
}


/*ajax会员锁定*/
function userLock(obj,baseUrl,userId){
	var lockType    = $(obj).attr('rel');
	var url         = baseUrl+"admin/ucenteraction/changeLock/";
    var parmarr     = {userId:userId,lockType:lockType};
    rel             = ajaxMain(url,parmarr);
	if(rel == '"success"')
	{
		if(lockType==1)
		{
			$(obj).attr('rel','0');
			$(obj).text('已锁定');
		}
		else
		{
			$(obj).attr('rel','1');
			$(obj).text('锁定');
		}
	}
	else
	{
		tipsPop({title:'锁定失败！',time:'3000'});
	}

};

/*ajax文章列表删除*/
function articleDelete(obj,artId,baseUrl){
	var url         = baseUrl+"admin/articleaction/delArticle";
    var parmarr     = {id:artId};
    rel             = ajaxMain(url,parmarr);
	$(obj).parents('tr').remove();
};

/*ajax获取验证码*/
function ajaxGetVerify(baseUrl){
    var url         = baseUrl+"admin/useraction/ajaxGetVerify";
    rel             = ajaxMain(url,'');
    $("#codeimg").html(rel);
}

/*ajax修改左侧排序*/
function changeSequence(sysValue,sysId){
    var url         = "/admin/ajax/ajaxaction/changeLeftSequence";
    var parmarr     = {sysId:sysId,sysValue:sysValue};
    rel             = ajaxMain(url,parmarr);
    if(rel == 'noPower'){
        alert('没有权限！');
    }else{
        location.reload();
    }
}

/*ajax删除左侧栏目*/
function delLeft(sysId){
    var url         = "/admin/ajax/ajaxaction/delLeft";
    var parmarr     = {sysId:sysId};
    rel             = ajaxMain(url,parmarr);
    location.reload();
}


/**
 * ajax通用方法（同步模式）
 *
 * @parm:       url--请求的地址（注意要用相对地址）
 *              parmArr--JOSN格式（{act:"getLeft",id:45,cid:145}）
 * @autor:      小鸟
 * @createtime: 2014-08-18
 */
function ajaxMain(url,parmArr){
     if(url != ''){
        var rel = $.ajax({
            type: "post",
            url: url,
            async:false,
            data:parmArr,
            success: function (data) {
                return data;
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown);
            }
        }).responseText;
    }
    return rel;
}