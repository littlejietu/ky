                            <table class="aut_tab profile" width="100%" border="0" cellspacing="0" cellpadding="0" id="tb-XT-info-base">
                              <tr>
                                <td width="86"><span class="tips">*</span>艺  名</td>
                                <td colspan="3">
                                  <?php if(!empty($o['nickname'])) 
                                          echo $o['nickname']; 
                                        else
                                          echo '<input name="nickname" type="text" class="txt" placeholder="请输入昵称"/>';

                                  ?>
                                  <?php //echo form_error('nickname');?>
                                  </td>
                              </tr>
                              <tr>
                                <td width="86">头  像</td>
                                <td colspan="3">
                                    <div id="previews" class="drsMoveHandle">
                                   	    <img id="show_userlogo" border=0 src='<?php echo $o['userlogo']? '/'.trim($o['userlogo'],'/') : _get_cfg_path('images').'imghead.jpg';?>'>
                                    </div>
                                    <div class="f_note">
                                        <p>尺寸：180×180像数</p>
                                        <input type="hidden"  name="userlogo" id="userlogo" value="<?=$o['userlogo']?>">
                                        <em><i class="icoPro16"></i>支持JPG,PNG，上传图片大小不能超过1M</em>
                                        <div class="file_but">
                                            <input id="userlogo_upload" name="userlogo_upload" value="选择照片" class="inp_file" type="file">
                                        </div>
                                    </div>
                                </td>
                              </tr>
                              <tr>
                                <td width="86"><span class="tips">*</span>真实姓名</td>
                                <td><input name="realname" type="text" value="<?=$o['realname']?>" class="txt" placeholder="请输入姓名"/></td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td>性别</td>
                                <td class="reg-sort">
                                	<p><input type="radio" name="sex" value="1" <?php if($o['sex']==1) echo 'checked';?> id="sort_1"/><label for="sort_1">男</label></p>
                        			<p><input type="radio" name="sex" value="2" <?php if($o['sex']==2) echo 'checked';?> id="sort_2"/><label for="sort_2">女</label></p>
                                </td>
                                <td><span class="tips">*</span>电话</td>
                                <td><input name="mobile" type="text" class="txt" value="<?=$o['mobile']?>" placeholder="请输入电话"/></td>
                              </tr>
                              <tr>
                                <td>所在城市</td>
                                <td colspan="3">
                                  <span id="divCity"></span>
                                  <input type="hidden" id="init_city_id" name="init_city_id" value="<?=$o['city_id'];?>">
                                  <input type="hidden" id="city" name="city" value="<?=$o['city'];?>">
                                </td>
                                
                              </tr>
                              
                               <tr>
                               	  <td colspan="4">个人说明</td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>个人介绍</font></p></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入个人介绍"  name="memo" cols="" rows=""><?=$o['memo']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>工作经历</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入工作经历"  name="brandtype" cols="" rows=""><?=$o['brandtype']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>合作品牌</font></p></td>
                                <td colspan="3"><textarea class="txt text" placeholder="请输入你拍摄过的品牌"  name="brand" cols="" rows=""><?=$o['brand']?></textarea></td>
                              </tr>
                              
                              <tr>
                                  <td colspan="4">工作说明</td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>工作费用</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder=""  name="fee" cols="" rows=""><?=$o['fee']?></textarea></td>
                              </tr>
                              <tr>
                                <td width="86" valign="top"><font>工作时间</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder=""  name="servicetime" cols="" rows=""><?=$o['servicetime']?></textarea></td>
                              </tr>
                              <tr style="border-bottom:none;">
                                <td width="86" valign="top"><font>工作说明</font></td>
                                <td colspan="3"><textarea class="txt text" placeholder="" name="takenote" cols="" rows=""><?=$o['takenote']?></textarea></td>
                              </tr>
                            </table>