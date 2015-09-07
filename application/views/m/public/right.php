<div class="uw_help">
                          <div class="uwh_title"><h3></h3><span><i></i>我的档期</span></div>
                            <div class="u_circle">
                              <a href="/m/schedule/"><h3>档期小助手</h3><p>方便 快捷 明确</p></a>
                            </div>
                        </div>
                        <div class="uw_help">
                          <div class="uwh_title"><h3></h3><span><i></i>热门推荐</span></div>
                            <div class="u_recom">
                              <ul class="clearfix">
                                <?php foreach ($rightlist as $key => $a):?>
                                  <li><a href="/i/<?=$a['id']?>"><img src="<?=_get_userlogo_url($a['userlogo'])?>"></a></li>
                                <?php endforeach;?>
                              </ul>
                            </div>
                        </div>