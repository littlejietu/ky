<?php include_once("right_head.php") ?>
<div class="common">
    <div class="goodsList">
        <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
            <tr height="39" style="font-size:13px;">
                <td>编号</td>
                <td>用户名称</td>
                <td>商品名称</td>
                <td>金额</td>
                <td>缩略图</td>
                <td>时间</td>
                <td>操作</td>
            </tr>
            <?php
            if (!empty($collectList)) {
                foreach ($collectList as $key => $value) {
                    ?>
                    <tr>
                        <td>[<?php echo($key + 1); ?>]</td>
                        <td><?php echo $value->user_name; ?></td>
                        <td><?php echo $value->goods_title; ?></td>
                        <td><?php echo $value->goods_money; ?></td>
                        <td>
                            <?php
                            if ($value->goods_thumb) {
                                ?>
                                <img src="<?php echo $value->goods_thumb; ?>" width="100"
                                     style="padding: 10px 0px">
                            <?php } ?>
                        </td>
                        <td><?php echo !empty($value->add_time) ? date("Y-m-d", $value->add_time) : "" ?></td>
                        <td>
                            <a style="cursor: pointer" onclick="javascript:if(confirm('确认删除？')){deleteCollect(this,<?php echo $value->ct_id ?>,'<?php echo base_url() ?>');}">删除</a>
                        </td>
                    </tr>
                <?php }
            } ?>
        </table>
        <br>
        <div class="page">
            <?php echo $pageHtml; ?>
        </div>
    </div>
</div>
</body>
</html>