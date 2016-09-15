<?php
use yii\helpers\Url;
?>

<div class="cat-wrap text-right">

  <a class="center-block active">
      ALL&nbsp;
  </a><br/>

  <?php foreach($years as $lbm) : ?>
      <a class="center-block" href="<?= Url::to(['gallery/year', 'slug' => $lbm->slug]) ?>">
          <?= $lbm->title ?>
      </a><br/>
  <?php endforeach; ?>

</div>

<div class="main-wrap port-wrap">

  <?php if(count($photos)) : ?>

      <div class="gallery-wrap">

          <div class="item-wrap active">

            <noscript>
            <?php foreach($photos as $key => $photo) : ?>
                <div class="pull-left photo-wrap">
                    <?php if ($photo->description): ?>
                        <div class="photo-desc"><?= $photo->description ?></div>
                    <?php endif; ?>
                    <div class="photo">
                        <?= $photo->box('', 300, 'x') ?>
                    </div>
                </div>
            <?php endforeach;?>
            </noscript>

            <?php foreach($photos as $key => $photo) : ?>

              <?php if($key < 4): ?>

                <div class="pull-left photo-wrap jsonly">

                  <?php if(count($photos) > 3): ?>
                    <input class="ratio" type="hidden" value="<?= 80 * $ratio[$key] / $allwidth ?>" />
                  <?php elseif(count($photos) == 3): ?>
                    <input class="ratio" type="hidden" value="<?= 60 * $ratio[$key] / $allwidth ?>" />
                  <?php elseif(count($photos) == 2): ?>
                    <input class="ratio" type="hidden" value="<?= 45 * $ratio[$key] / $allwidth ?>" />
                  <?php elseif(count($photos) == 1): ?>
                    <input class="ratio" type="hidden" value="<?= (($ratio[$key] < 1) ? 20 : 40) * $ratio[$key] / $allwidth ?>" />
                  <?php endif; ?>

                  <div class="photo-desc"><?= $photo->description ?></div>

                  <div class="photo <?= ($key == 1) ? 'last mob' : (($key == 3) ? 'last' : '') ?>">

                    <?= $photo->box('', 300, 'x') ?>

                    <?php if ($key < 3) : ?>
                      <div class="photo-zoom" onclick="$(this).parent().find('a').click();"><i class="fa fa-search-plus" ></i></div>
                    <?php endif; ?>

                    <?php if ($key == 3) : ?>
                      <div class="photo-next" onclick="$('.gallery-wrap').find('.photo-wrap:nth-of-type(4)').find('a').click();"></div>
                    <?php endif; ?>

                    <?php if ($key == 1) : ?>
                      <div class="photo-next mob" onclick="$('.gallery-wrap').find('.photo-wrap:nth-of-type(2)').find('a').click();">
                        <div class="photo-count" onclick="$(this).parent().find('a').click();">
                          <i class="fa fa-camera"></i>
                          <?= count($photos) ?>
                        </div>
                      </div>
                    <?php endif; ?>

                  </div>

                </div>

              <?php else: ?>
                <div class="hidden"><?= $photo->box(50, 50, 'x') ?></div>
              <?php endif; ?>

            <?php endforeach;?>

          </div>

      </div>

      <?php if(count($photos) > 1): ?>
        <div class="photo-show jsonly"><a href="javascript:" onclick="$('.gallery-wrap').find('.photo-wrap:first-of-type').find('a').click();"><i class="fa fa-camera" style=""></i><small>slide show</small></a></div><br><br>
      <?php endif; ?>

  <?php endif; ?>

</div>
