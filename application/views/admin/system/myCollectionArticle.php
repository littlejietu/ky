<?php include_once("right_head.php") ?>
<div class="common">
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <tr height="39" style="font-size:13px;">
            <td style="width: 10%;">编号</td>
            <td style="width: 20%;">用户名</td>
            <td style="width: 30%;">标题</td>
            <td style="width: 10%;">时间</td>
            <td style="width: 10%">操作</td>
        </tr>
        <?php
        if (!empty($collectList)) {
            foreach ($collectList as $key => $value) {
                ?>
                <tr height="30">
                    <td>[<?php echo($key + 1); ?>]</td>
                    <td><?php echo $value->user_name ?></td>
                    <td style="text-align: left;padding:0 0 0 10px;"><?php echo $value->goods_title ?></td>
                    <td><?php echo !empty($value->add_time)?date("Y-m-d",$value->add_time):""?></td>
                    <td>
                        <?php if ($key + 1 > 0) { ?>
                            <a style="cursor: pointer"
                               onclick="javascript:if(confirm('确认删除？')){deleteCollect($(this),<?php echo $value->ct_id ?>,'<?php echo base_url(); ?>');}">删除</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php
            }

        } ?>
    </table>
    <br>
    <div class="page">
        <?php echo $pageHtml; ?>
    </div>
</div>
</body>
</html>