 $(function () {
zxkd.page.autoMaxWidth();
})

var zxkd = {};
zxkd.namespace = function(str){
	var arr = str.split('.'),o=zxkd;
	for(i=(arr[0]=='zxkd') ? 1 : 0; i<arr.length; i++){		
		o[arr[i]] = o[arr[i]] || {};
		o = o[arr[i]];
	}
}
zxkd.namespace('page');

zxkd.page.autoMaxWidth = function () {
    var winW = $(window).width();
    if (winW < 953) {
        winW = 953;
    
    $('.m_w').each(function(){
        $(this).width(winW);
                
    });}else{
		
		    $('.m_w').each(function(){
        $(this).width("auto");
		});
}
}

 $(window).resize(function(){
        if (typeof indexSlides != 'undefined' && indexSlides.reformat) 
            indexSlides.reformat();
       zxkd.page.autoMaxWidth();
    });