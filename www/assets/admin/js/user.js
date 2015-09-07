/*重置登陆页*/
function resetLogin(){
	$(".user").val("");
	$(".pass").val("");
	$(".code").val("");
}
/*退出登录*/
function logout(baseUrl){
    var url         =  baseUrl+"admin/useraction/logout";
    var parmarr     = '';
    ajaxMain(url,parmarr);
    window.location.reload();
}
/*ajax登录*/
function ajaxLogin(baseUrl){
    $("#error_code").html("");
    $("#error_user").html("");
    $("#error_password").html("");
	var username    = parameterFilter($("#loginUser").val());
	var password    = parameterFilter($("#loginPassword").val());
	var code        = parameterFilter($("#loginCode").val());
	if(username && password){
        var url         =  baseUrl+"admin/useraction/ajaxLogin";
        var parmarr     = {username:username,password:password,code:code};
        rel             = ajaxMain(url,parmarr);
        if(rel != "success")
            $('#yzimg').attr('src','/util/captcha_admin?'+Math.random());
        if(rel == "code_error"){
			$(".error").html("验证码错误！");
			$(".error").show();
			setTimeout(
				function(){
					$(".error").html("");
					$(".error").hide(500);
				},500
			);
        }else if(rel == "no_user"){
            $(".error").html("不存在的用户！");
			$(".error").show();
			setTimeout(
				function(){
					$(".error").html("");
					$(".error").hide(500);
				},500
			);
        }else if(rel == "password_error"){
            $(".error").html("密码错误！");
			$(".error").show();
			setTimeout(
				function(){
					$(".error").html("");
					$(".error").hide(500);
				},500
			);
        }else if(rel == "is_lock"){
			$(".error").html("帐号已被锁定，请联系管理员！");
			$(".error").show();
			setTimeout(
				function(){
					$(".error").html("");
					$(".error").hide(500);
				},500
			);
        }else if(rel == "success"){
            window.location.href=baseUrl+"admin/indexaction";
        }
	}else{
        $(".error").html("用户名和密码不能为空！");
		$(".error").show();
		setTimeout(
			function(){
				$(".error").html("");
				$(".error").hide(500);
			},500
		);
    }
}

/*添加管理员*/
function addUser(baseUrl){
	var username = parameterFilter($("#username").val());
	var email = parameterFilter($("#email").val());
	var userpassword = parameterFilter($("#userpassword").val());
	var userpasswordreset = parameterFilter($("#userpasswordreset").val());
	var tel = parameterFilter($("#tel").val());
	var realname = parameterFilter($("#realname").val());
	var userpower = parameterFilter($("input:radio[name=userstep]:checked").val());
	if(username && userpassword && userpasswordreset && userpower){
        if(userpassword != userpasswordreset){
            alert('两次密码输入不一致！');
        }else{
            var url         =  baseUrl+"useraction/addUser";
            var parmarr     = {action:'adduser',username:username,password:userpassword,email:email,tel:tel,realname:realname,userpower:userpower};
            data            = ajaxMain(url,parmarr);
            switch(data){
                case "success":
                    alert('添加成功！');
                    break;
                case "false":
                    alert('该管理员已经存在！');
                    break;
            }
            window.location.href=baseUrl+"admin/useraction/addUser";
        }
	}
}

/*编辑管理员*/
function editUser(userId,baseUrl){
    var username = parameterFilter($("#username").val());
    var email = parameterFilter($("#email").val());
    var userpassword = parameterFilter($("#userpassword").val());
    var userpasswordreset = parameterFilter($("#userpasswordreset").val());
    var tel = parameterFilter($("#tel").val());
    var realname = parameterFilter($("#realname").val());
    var userpower = parameterFilter($("input:radio[name=userstep]:checked").val());
    if(username && userpower && userpasswordreset && userpower){
        if(userpassword != userpasswordreset){
            alert('两次密码输入不一致！');
        }else{
            var url         =  baseUrl+"admin/useraction/addUser";
            alert(url);
            var parmarr     = {action:'edit',username:username,password:userpassword,email:email,tel:tel,realname:realname,userpower:userpower,edit:1,userId:userId};
            data            = ajaxMain(url,parmarr);
            switch(data){
                case "success":
                    alert('修改成功！');
                    break;
                case "false":
                    alert('修改失败！');
                    break;
            }
        }

    }
}

/*改变管理员的锁定状态*/
function changeLock(lockType,userid){
    var lock        = $(lockType).attr("value");
    var url         =  "/admin/useraction/changeLock";
    var parmarr     = {lockType:lock,userId:userid};
    ajaxMain(url,parmarr);
    if(lock==0){
        $(lockType).html('否');
        $(lockType).attr('value','1');
    }else{
        $(lockType).html('是');
        $(lockType).attr('value','0');
    }
}

/*删除管理员*/
function delAdmin(userid){
    var url         =  "/admin/useraction/delAdmin";
    var parmarr     = {userId:userid};
    ajaxMain(url,parmarr);
    window.location.reload();
}

/*删除收藏*/
function deleteCollect(dom, id, baseurl){
    var url         =  "" + baseurl + "admin/useraction/deleteCollect";
    var parmarr     = {id:id};
    ajaxMain(url,parmarr);
    window.location.reload();
}

/*分配权限中 选中相邻元素的所有子元素*/
function selectNextAll(type){
    if(type.attr('checked') == 'checked'){
        type.parent().next().children().children().attr('checked','checked');
    }else{
        type.parent().next().children().children().attr('checked',false);
    }

}

/*分配权限中 选中任意子元素则选中父元素*/
function selectFirst(type){
    if(type.attr('checked') == 'checked'){
        type.parent().parent().prev().children().attr('checked','checked');
    }else{
        var isHaveCheck = 0;
        type.parent().parent().children().each(function(){
            if($(this).children().attr('checked')=='checked'){
                isHaveCheck = 1;
            }
        });
        if(isHaveCheck == 1){
            type.parent().parent().prev().children().attr('checked','checked');
        }else{
            type.parent().parent().prev().children().attr('checked',false);
        }
    }

}