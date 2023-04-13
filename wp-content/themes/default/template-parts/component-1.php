<?php //print_r($args);
if( $args['data'] ) { ?>
<div class="clearfix"></div>
<div id="tdi_13" class="tdc-row" style="margin-top:10px;margin-bottom:10px;"">
  <?php if(isset($args['args']['link']) && $args['args']['link']!='') {?>
  <div class="vc_column-inner">
    <div class="wpb_wrapper">
      <div class="td_block_wrap td_block_title tdi_113 td-pb-border-top td_block_template_5 td-fix-index" data-td-block-uid="tdi_113">
        <div class="td-block-title-wrap"> <a href="<?php echo $args['args']['link'];?>">
          <h2 class="td-block-title"><span class="td-pulldown-size"><?php echo $args['args']['lable'];?></span></h2>
          </a> </div>
      </div>
    </div>
  </div>
  <?php }else {?>
  <div class="vc_column-inner">
    <div class="wpb_wrapper">
      <div class="td_block_wrap td_block_title tdi_113 td-pb-border-top td_block_template_5 td-fix-index" data-td-block-uid="tdi_113">
        <div class="td-block-title-wrap">
          <h2 class="td-block-title"><span class="td-pulldown-size"><?php echo $args['args']['lable'];?></span></h2>
        </div>
      </div>
    </div>
  </div>
  <?php }?>
  <div class="vc_row tdi_14  wpb_row td-pb-row">
    <div class="vc_column tdi_16  wpb_column vc_column_container tdc-column td-pb-span12">
      <div class="wpb_wrapper">
        <div class="td_block_wrap td_block_big_grid_9 tdi_17 td-grid-style-1 td-hover-1 td-big-grids td-pb-border-top td_block_template_11" data-td-block-uid="tdi_17">
          <div id=tdi_17 class="td_block_inner">
            <div class="td-big-grid-wrapper">
              <?php for( $i=0; $i< count( $args['data'] ); $i++ ) { ?>
              <div class="td_module_mx15 td-animation-stack td-meta-info-hide td-big-grid-post-0 td-big-grid-post td-medium-thumb">
                <div class="td-module-thumb"><a href="<?php echo $args['data'][$i]['link']?>" rel="bookmark" class="td-image-wrap " title="<?php echo $args['data'][$i]['headline']?>"><img class="entry-thumb lazy" src="<?php echo DEFAULT_IMAGE_PLACEHOLDER_LARGE; ?>" alt="<?php echo $args['data'][$i]['headline']?>" title="<?php echo $args['data'][$i]['headline']?>" data-src="<?php echo $args['data'][$i]['largeImg'][0]?>" width="356" height="364" /></a></div>
                <div class="td-meta-info-container">
                  <div class="td-meta-align">
                    <div class="td-big-grid-meta"> <?php if(isset($args['data'][$i]['article_category_link']) && $args['data'][$i]['article_category_link']!='') {?>
                    <a href="<?php echo $args['data'][$i]['article_category_link']?>" class="td-post-category"><?php echo $args['data'][$i]['article_category_title']?></a>
                    <?php }?>
                      <h3 class="entry-title td-module-title"><a href="<?php echo $args['data'][$i]['link']?>" rel="bookmark" title="<?php echo $args['data'][$i]['headline']?>"><?php echo $args['data'][$i]['headline']?></a></h3>
                    </div>
                    <div class="td-module-meta-info"> </div>
                  </div>
                </div>
              </div>
              <?php }?>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
}
?>
