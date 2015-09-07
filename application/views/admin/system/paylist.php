<?php include_once("right_head.php");?>
<div class="common">
    <table class="listTab" cellpadding="0" cellspacing="0" bordercolor="#e4e4e4" border="1">
        <form action="<?php echo base_url('admin/payaction/index')?>" method="post">
            <input type="hidden" name="act" value="edit">
        <tr height="39" style="font-size:13px;">
            <td width="5%">收款方式</td>
            <td width="5%">收款账户</td>
            <td width="10%">收款合作ID</td>
            <td width="10%">收款KEY</td>
        </tr>
            <?php
                if(!empty($payList)){
                    foreach($payList as $value){
            ?>
        <tr height="30">
            <td><?php echo $value->pay_name?></td>
            <td><input name="pay_amount" value="<?php echo $value->pay_amount?>" style="width: 200px"></td>
            <td><input name="pay_partner" value="<?php echo $value->pay_partner?>" style="width: 200px"></td>
            <td><input name="pay_key" value="<?php echo $value->pay_key?>" style="width: 300px"></td>

        </tr>
            <?php }}?>
        <tr>
            <td> <button>提交</button></td>
        </tr>
        </form>
    </table>

</div>
</body>
</html>