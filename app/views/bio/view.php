<?php
use yii\helpers\Url;
?>

<div class="cat-wrap text-right">
  <?php foreach($years as $year) : ?>
      <a class="center-block <?=($year->slug == $news->slug) ? 'active' : '' ?>" href="<?= Url::to(['bio/year', 'slug' => $year->slug]) ?>">
          <?= $year->slug ?>
      </a><br/>
  <?php endforeach; ?>
</div>

<div class="main-wrap bio-wrap">

  <div class="gallery-wrap">

    <div class="item-wrap active pull-left bio-item">
      <h2 class="text-uppercase">Sergey's Story</h2>

      <div class="col-xs-12">
        <div class="row text-muted"><?= $news->text ?></div>
      </div>

      <div class="col-xs-12 photo-mob">
          <?php if ($news->short) : ?>
            <div class="col-xs-12" style="font-size:13px">
              <div class="row">
                <i><span style="font-size:60px;position:relative;top:25px;left:-10px;line-height:0;height:0">"</span>
                  <?= $news->short ?>"
                </i><br/><br/>
                <div class="text-right" style="font-size:13px">
                  <?php foreach ($news->tags as $tag) : ?>
                    <b><i><?= $tag ?></i></b>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

          <?php endif; ?>
          <?php if(count($news->photos)) : ?>
              <?php foreach($news->photos as $key => $photo) : ?>
                <?php if($key == 0 && count($news->photos) == 1) : ?>
                  <div class="pull-left bio-photo" style="margin-bottom:15px">
                    <div class="photo"><?= $photo->box(300, '', 'm') ?></div>
                  </div>
                <?php elseif ($key == 0 && count($news->photos) > 1) : ?>
                  <div class="pull-left bio-photo">
                    <div class="photo" style="opacity:0.25"><?= $photo->box(300, '', 'm') ?></div>
                    <div class="photo-count" onclick="$(this).parent().find('a').click();">
                      <i class="fa fa-camera"></i>
                      <?= count($news->photos) ?>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="hidden"><?= $photo->box(50, 50, 'm') ?></div>
                <?php endif; ?>
              <?php endforeach; ?>
          <?php endif; ?>
      </div>

    </div>

    <div class="col-xs-4 photo-desk" style="padding-top:54px">
      <?php if ($news->short) : ?>
        <div class="col-xs-12" style="font-size:13px">
          <i><span style="font-size:60px;position:relative;top:25px;left:-10px;line-height:0;height:0">"</span>
            <?= $news->short ?>"
          </i>
        </div>
        <div class="col-xs-12 text-right" style="font-size:13px">
          <?php foreach ($news->tags as $tag) : ?>
            <b><i><?= $tag ?></i></b>
          <?php endforeach; ?>
          <br/><br/><br/>
        </div>
      <?php endif; ?>

      <div class="col-xs-12">
        <?php if(count($news->photos)) : ?>
            <?php foreach($news->photos as $key => $photo) : ?>
              <?php if($key == 0) : ?>
                <div class="pull-left bio-photo" style="margin-bottom:15px">
                  <div class="photo"><?= $photo->box(350, '') ?></div>
                </div>
              <?php elseif (!$news->short && $key == 1) : ?>
                <div class="pull-left bio-photo" style="margin-bottom:15px">
                  <div class="photo jsonly" style="opacity:0.25"><?= $photo->box(350, '') ?></div>
                  <div class="photo-count jsonly" onclick="$(this).parent().find('a').click();">
                    <i class="fa fa-camera"></i>
                    <?= count($news->photos) ?>
                  </div>
                  <noscript>
                    <div class="photo"><?= $photo->box('', 300) ?></div>
                  </noscript>
                </div>
              <?php else: ?>
                <div class="hidden"><?= $photo->box(50, 50) ?></div>
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
      <a class="pull-left" href="/bio/year/<?=$years[$k-1]->slug?>">« <small>PREV</small></a>
    <?php endif; ?>
    <?php if ($years[$k + 1]) : ?>
      <a class="pull-right" href="/bio/year/<?=$years[$k+1]->slug?>"><small>NEXT</small> »</a>
    <?php endif; ?>
  </div>
</div>
