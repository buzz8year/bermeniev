<?php
use yii\easyii\modules\exhibitions\api\Article;
use yii\helpers\Url;

$this->title = $article->seo('title', $article->model->title);

$years = Article::cats();

?>

<style>
.bg-body {
  background-image: url('<?= count($article->photos) ? $article->photos[0]->image : '' ?>');
}
</style>

<a class="hidden share-fb" target="_blank" onclick="return Share.me(this);" href="http://www.facebook.com/sharer/sharer.php?s=100&p%5Btitle%5D=<?=$this->title?>&p%5Bsummary%5D=DESC&p%5Burl%5D=URL&p%5Bimages%5D%5B0%5D=IMG_PATH"></a>

<div class="cat-wrap text-right">
  <?php foreach($years as $cata) : ?>
      <a class="center-block <?=($cata->category_id == $cat) ? 'active' : '' ?>" href="<?= Url::to(['exhibitions/year', 'slug' => $cata->slug]) ?>">
          <?= $cata->slug ?>
      </a><br/>
  <?php endforeach; ?>
</div>

<?php foreach ($items as $key => $item) if ($item->id == $article->id) $k = $key; ?>

<div class="main-wrap exhib-wrap">

  <div class="gallery-wrap">

    <!-- <?php foreach ($items as $ke => $item) : ?>
      <?php if ($ke == $k - 1) : ?>
        <style> .cat-wrap { padding-top: 179px } </style>
        <div class="item-wrap">
          <div class="item-filter active" onclick="location.href='<?= Url::to(['exhibitions/view/', 'slug' => $item->slug]) ?>';"></div>
          <h2 class="text-uppercase"  style="cursor:pointer"><?= $item->title ?></h2>
          <small class="text-muted"><?= $item->date ?></small>&nbsp;
          <small class="text-uppercase"><i class="fa fa-map-marker"></i>
            <?php foreach ($item->tags as $tag) : ?>
              <?=$tag?><?=($tag != end($item->tags)) ? ', ' : ''?>
            <?php endforeach; ?>
          </small>
        </div>
      <?php endif; ?>
    <?php endforeach; ?> -->

    <div class="item-wrap active title-wrap">
        <h2 class="text-uppercase"><?= $article->title ?></h2>
        <small class="text-muted"><?= $article->date ?></small>&nbsp;
        <small class="text-uppercase"><i class="fa fa-map-marker"></i>
          <?php foreach ($article->tags as $tag) : ?>
            <?=$tag?><?=($tag != end($article->tags)) ? ', ' : ''?>
          <?php endforeach; ?>
        </small><br/><br/>
    </div>
    <div class="item-wrap active">
      <?php if(count($article->photos)) : ?>
        <?php foreach($article->photos as $ky => $photo) : ?>
          <?php if ($ky < 2) : ?>
              <div class="pull-left photo-wrap">
                <input type="hidden" value="<?= 20 * getimagesize(Yii::getAlias('@webroot').$photo->image)[0] / getimagesize(Yii::getAlias('@webroot').$photo->image)[1] ?>" />
                <div class="photo"><?= $photo->box('', 220) ?></div>
              </div>
          <?php else: ?>
            <div class="hidden"><?= $photo->box(50, 50) ?></div>
          <?php endif; ?>
        <?php endforeach; ?>
        <div class="pull-left col-xs-2 count-wrap">
          <div class="photo photo-count" onclick="$(this).closest('.item-wrap').find('a.easyii-box').click();">
            <i class="fa fa-camera"></i>
            <?= count($article->photos) ?>
          </div>
        </div>
        <?php Article::plugin() ?>
      <?php endif; ?>
    </div><br/>
    <div class="photo-show"><a href="javascript:" onclick="$('.gallery-wrap .active').find('.photo-wrap:first-of-type').find('a').click();"><i class="fa fa-camera"></i>photo gallery</a></div>
    <?php if ($article->short) : ?>
    <div class="photo-show">
      <a href="javascript:" onclick="$.fancybox.open({content:'<iframe width=\'600\' height=\'350\' src=\'https://player.vimeo.com/video/<?= $article->short ?>?autoplay=1&byline=0&portrait=0\' frameborder=\'0\' allowfullscreen></iframe>'});"><i class="fa fa-video-camera"></i>video</a>
    </div><br/>
    <?php else : ?>
    <br/>
    <?php endif; ?>

    <!-- <?php foreach ($items as $ke => $item) : ?>
      <?php if ($ke == $k + 1) : ?>
        <div class="item-wrap">
          <div class="item-filter active" onclick="location.href='<?= Url::to(['exhibitions/view/', 'slug' => $item->slug]) ?>';"></div>
          <h2 class="text-uppercase"  style="cursor:pointer"><?= $item->title ?></h2>
          <small class="text-muted"><?= $item->date ?></small>&nbsp;
          <small class="text-uppercase"><i class="fa fa-map-marker"></i>
            <?php foreach ($item->tags as $tag) : ?>
              <?=$tag?><?=($tag != end($item->tags)) ? ', ' : ''?>
            <?php endforeach; ?>
          </small><br/><br/>
        </div>
        <div class="item-wrap">
          <div class="item-filter active" onclick="location.href='<?= Url::to(['exhibitions/view/', 'slug' => $item->slug]) ?>';"></div>

          <?php if(count($item->photos)) : ?>
            <?php foreach($item->photos as $ku => $photo) : ?>
              <?php if ($ku < 2) : ?>
                <div class="pull-left photo-wrap" <?= ($ku == 0) ? 'style="margin-left:2px;display:block"' : '' ?>>
                  <input type="hidden" value="<?= 20 * getimagesize(Yii::getAlias('@webroot').$photo->image)[0] / getimagesize(Yii::getAlias('@webroot').$photo->image)[1] ?>" />
                  <div class="photo"><?= $photo->box('', 220) ?></div>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
            <div class="pull-left col-xs-2 count-wrap">
              <div class="photo photo-count">
                <i class="fa fa-camera"></i>
                <?= count($item->photos) ?>
              </div>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    <?php endforeach; ?> -->

  </div>

  <div class="col-xs-12 prev-next">
    <?php if ($items[$k - 1]) : ?>
      <a class="pull-left" href="/exhibitions/view/<?=$items[$k-1]->slug?>">« <small>PREV</small></a>
    <?php endif; ?>
    <?php if ($items[$k + 1]) : ?>
      <a class="pull-right" href="/exhibitions/view/<?=$items[$k+1]->slug?>"><small>NEXT</small> »</a>
    <?php endif; ?>
  </div>

</div>
