<?php
use yii\helpers\Url;
?>

<div class="cat-wrap text-right">
  <?php foreach($years as $cata) : ?>
      <a class="center-block <?=($cata->title == $cat->model->title) ? 'active' : '' ?>" href="<?= Url::to(['exhibitions/year', 'slug' => $cata->slug]) ?>">
          <?= $cata->title ?>
      </a><br/>
  <?php endforeach; ?>
</div>

<div class="main-wrap exhib-wrap">

  <?php if(count($items)) : ?>

    <div class="gallery-wrap">

      <?php foreach($items as $key => $article) : ?>

        <div class="item-row a<?=$key?> <?= $key == 0 ? 'active' : '' ?>">

          <div class="item-wrap title-wrap">
            <h2 class="text-uppercase"><?= $article->title ?></h2>
            <small class="text-muted"><?= $article->date ?></small>&nbsp;
            <small class="text-uppercase"><i class="fa fa-map-marker"></i>
              <?php foreach ($article->tags as $tag) : ?>
                <?=$tag?><?=($tag != end($article->tags)) ? ', ' : '' ?>
              <?php endforeach; ?>
            </small><br/><br/>
          </div>

          <div class="item-wrap">

            <?php if(count($article->photos)) : ?>
              <?php foreach($article->photos as $k => $photo) : ?>
                <?php if ($k < 2) : ?>
                  <div class="pull-left photo-wrap jsonly" <?= ($k == 0) ? 'style="margin-left:0;display:block"' : '' ?>>
                    <input class="ratio" type="hidden" value="<?= 20 * getimagesize(Yii::getAlias('@webroot').$photo->image)[0] / getimagesize(Yii::getAlias('@webroot').$photo->image)[1] ?>" />
                    <div class="photo"><?= $photo->box('', 220) ?></div>
                  </div>
                <?php else: ?>
                  <div class="hidden"><?= $photo->box(50, 50) ?></div>
                <?php endif; ?>
              <?php endforeach; ?>

              <noscript>
              <?php foreach($article->photos as $k => $photo) : ?>
                <div class="pull-left photo-wrap">
                  <div class="photo"><?= $photo->box('', 220) ?></div>
                </div>
              <?php endforeach; ?>
              </noscript>

              <?php if(count($article->photos) > 1): ?>
                <div class="pull-left col-xs-2 photo-wrap count-wrap jsonly">
                  <div class="photo photo-count" onclick="$(this).closest('.item-wrap').find('a.easyii-box').click();">
                    <i class="fa fa-camera"></i>
                    <?= count($article->photos) ?>
                  </div>
                </div>
              <?php endif; ?>

              <?php $plugin ?>

            <?php endif; ?>

          </div><br/>

          <?php if(count($article->photos) > 1): ?>
            <div class="photo-show jsonly"><a onclick="$('.gallery-wrap .active').find('.photo-wrap:first-of-type').find('a').click();"><i class="fa fa-camera"></i>photo gallery</a></div>
          <?php endif; ?>

          <?php if ($article->short) : ?>
            <div class="photo-show jsonly">
              <a onclick="$.fancybox.open({content:'<iframe width=\'600\' height=\'350\' src=\'https://player.vimeo.com/video/<?= $article->short ?>?autoplay=1&byline=0&portrait=0\' frameborder=\'0\' allowfullscreen></iframe>'});"><i class="fa fa-video-camera"></i>video</a>
            </div><br/>
          <?php else : ?>
            <br/>
          <?php endif; ?>

        </div>

      <?php endforeach; ?>

    </div>

  <?php endif; ?>

</div>
