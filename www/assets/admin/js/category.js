/*删除分类*/
function deleteClass(dom,id,baseUrl){
    var url         =  baseUrl+"/admin/ajax/categoryajaxaction/deleteClass";
    var parmarr     = {id:id};
    rel             = ajaxMain(url,parmarr);
    if(rel){
        dom.parent().parent().hide();
    }
}
/*修改分类排序*/
function changeClassSort(id,sort,baseUrl){
    var url         =  baseUrl+"/admin/ajax/categoryajaxaction/changeSort";
    var parmarr     = {id:id,sort:sort};
    rel             = ajaxMain(url,parmarr);
    if(rel=='OK'){
        window.location.reload();
    }
}
