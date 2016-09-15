<?php
use yii\helpers\Url;
?>

<div class="cat-wrap text-right">
  <?php foreach($years as $year) : ?>
      <a class="center-block <?=($year->slug == $news->slug) ? 'active' : '' ?>" href="<?= Url::to(['biblio/year', 'slug' => $year->slug]) ?>">
          <?= $year->slug ?>
      </a><br/>
  <?php endforeach; ?>
</div>

<div class="main-wrap bio-wrap">

  <div class="gallery-wrap">

    <div class="item-wrap active pull-left bio-item">
      <h2 class="text-uppercase"><?= $news->short ?></h2>

      <div class="col-xs-12">
        <div class="row text-muted"><?= $news->text ?></div>
      </div>

      <div class="col-xs-12 photo-mob">
          <?php if(count($news->photos)) : ?>
              <?php foreach($news->photos as $key => $photo) : ?>
                <?php if($key == 0 && count($news->photos) == 1) : ?>
                  <div class="pull-left bio-photo" style="margin-bottom:5px">
                    <div class="photo"><?= $photo->box('', 300, 'm') ?></div>
                  </div>
                <?php elseif ($key == 0 && count($news->photos) > 1) : ?>
                  <div class="pull-left bio-photo">
                    <div class="photo jsonly" style="opacity:0.25"><?= $photo->box('', 300, 'm') ?></div>
                    <div class="photo-count jsonly" onclick="$(this).parent().find('a').click();">
                      <i class="fa fa-camera"></i>
                      <?= count($news->photos) ?>
                    </div>
                    <noscript>
                      <div class="photo"><?= $photo->box('', 300) ?></div><br/>
                    </noscript>
                  </div>
                <?php else: ?>
                  <div class="hidden"><?= $photo->box(50, 50, 'm') ?></div>
                  <noscript>
                    <div class="pull-left bio-photo" style="margin-bottom:5px">
                      <div class="photo"><?= $photo->box('', 300) ?></div>
                    </div>
                  </noscript>
                <?php endif; ?>
              <?php endforeach; ?>
          <?php endif; ?>
      </div>

      <?php if(count($news->photos) > 1): ?>
        <div class="photo-show jsonly" style="position:absolute;bottom:-30px;left:0;padding-left:0"><a href="javascript:" onclick="$('.gallery-wrap .active').find('.photo-wrap:first-of-type').find('a').click();"><i class="fa fa-camera"></i>book gallery</a></div>
      <?php endif; ?>

    </div>

    <div class="col-xs-4 photo-desk" style="padding-top:68px">

      <div class="col-xs-12">
        <?php if(count($news->photos)) : ?>
            <?php foreach($news->photos as $key => $photo) : ?>
              <?php if($key == 0) : ?>
                <div class="pull-left bio-photo" style="margin-bottom:15px">
                  <div class="photo"><?= $photo->box('', 300, 'd') ?></div>
                </div>
              <?php elseif ($key == 1) : ?>
                <div class="pull-left bio-photo" style="margin-bottom:15px">
                  <div class="photo jsonly" style="opacity:0.25"><?= $photo->box('', 300, 'd') ?></div>
                  <div class="photo-count jsonly" onclick="$(this).parent().find('a').click();">
                    <i class="fa fa-camera"></i>
                    <?= count($news->photos) ?>
                  </div>
                  <noscript>
                    <div class="photo"><?= $photo->box('', 300) ?></div>
                  </noscript>
                </div>
              <?php else: ?>
                <div class="hidden"><?= $photo->box(50, 50, 'd') ?></div>
                <noscript>
                  <div class="pull-left bio-photo" style="margin-bottom:15px">
                    <div class="photo"><?= $photo->box('', 300) ?></div>
                  </div>
                </noscript>
              <?php endif; ?>
            <?php endforeach; ?>
            <?php $plugin ?>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <div class="col-xs-12 prev-next">
    <?php if ($years[$k - 1]) : ?>
      <a class="pull-left" href="/biblio/year/<?=$years[$k-1]->slug?>">« <small>PREV</small></a>
    <?php endif; ?>
    <?php if ($years[$k + 1]) : ?>
      <a class="pull-right" href="/biblio/year/<?=$years[$k+1]->slug?>"><small>NEXT</small> »</a>
    <?php endif; ?>
  </div>
</div>
