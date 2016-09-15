<?php
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\easyii\modules\feedback\api\Feedback;

$this->beginContent('@app/views/layouts/base.php');
?>

<div class="bg-body <?=Yii::$app->controller->id == 'site' ? 'fsm' : '' ?>"></div>

<div class="vl"></div>
<div class="hl"></div>
<div class="xl"></div>
<div class="xx"></div>
<div class="cc"></div>

<div id="wrapper" class="container">
    <header>
        <nav class="navbar navbar-default">
            <div class="header-strp">
              <div class="pull-left jsonly menu-togg animated SlideInRight" onclick="$('#menu-modal').modal('show')" style="padding:0">
                <i class="fa fa-bars"></i>
                <span>MENU</span>
              </div>
              <div class="pull-right jsonly menu-togg" onclick="$('#menu-modal').modal('show')">
                <i class="fa fa-bars"></i>
                <span>MENU</span>
              </div>
              <div class="feed-strp jsonly">
                <a onclick="$('#feed-modal').modal('show');" title="Send a message">
                  <i class="fa fa-envelope-o"></i>
                </a>
                <a href="http://instagram.com/sergeybermeniev" target="_blank" title="http://instagram.com/sergeybermeniev">
                  <i class="fa fa-instagram"></i>
                </a>
                <a onclick="$('.share-fb').click();" title="https://facebook.com/sharer.php">
                  <i class="fa fa-facebook-square"></i>
                </a>
              </div>
              <div class="name-strp"><a href="/">SERGEY BERMENIEV</a></div>

              <?php if (Yii::$app->controller->id != 'site'): ?>
              <noscript>
                <div class="pull-left text-center text-muted">Please enable JavaScript in your browser for best experience. Some features can be unavailable as well.</div>
              </noscript>
              <?php endif; ?>

            </div>

            <div id="navbar-menu">
                <?= Menu::widget([
                    'options' => ['class' => 'nav navbar-nav'],
                    'items' => [
                        ['label' => 'Bio', 'url' => ['/bio']],
                        ['label' => 'Biblio', 'url' => ['/biblio']],
                        ['label' => 'Exhibitons', 'url' => ['/exhibitions']],
                        ['label' => 'Photo Portraits', 'url' => ['/gallery']],
                    ],
                ]); ?>
            </div>
        </nav>

    </header>
    <main>
        <?= $content ?>
    </main>
</div>

<div class="modal fade mobile" id="feed-modal">
    <div class="menu-close" onclick="$('#feed-modal').modal('hide')">
      <i class="fa fa-remove"></i>
    </div>
    <div class="modal-content float-none">
        <div class="modal-body">
            Please complete the form and click send button<br/><br/>
            <div class="float-none feedback" id="fdbck">
                <div class="text-center">
                    <?= Feedback::form() ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade mobile" id="feed-success">
    <div class="modal-content float-none">
        <div class="modal-body">
            <h4 class="text-center"><i class="fa fa-check text-success"></i> Congratulations! Message has been sent!</h4>
        </div>
    </div>
</div>

<div class="modal fade mobile" id="menu-modal">
    <div class="menu-close" onclick="$('#menu-modal').modal('hide')" style="z-index:100">
      <i class="fa fa-times"></i>
    </div>
    <div class="modal-content float-none">
        <div class="modal-body">
            <div class="menu-mob">
                <div class="socia-mob">
                  <i onclick="$('.share-fb').click();" title="https://facebook/sharer.php" class="fa fa-facebook-square"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                  <i onclick="window.open('http://instagram.com/sergeybermeniev', '_blank');" title="http://instagram.com/sergeybermeniev" class="fa fa-instagram"></i>
                </div>
                <?= Menu::widget([
                    'options' => ['class' => 'nav navbar-nav'],
                    'items' => [
                        ['label' => 'PHOTO PORTRAITS', 'url' => ['/gallery']],
                        ['label' => 'EXHIBITIONS', 'url' => ['/exhibitions']],
                        ['label' => 'BIBLIO', 'url' => ['/biblio']],
                        ['label' => 'BIO', 'url' => ['/bio']],
                    ],
                ]); ?>
                <div class="feed-mob" onclick="$('#menu-modal').modal('hide');$('#feed-modal').modal('show');">
                  SEND<br/>MESSAGE<br/>
                  <i class="fa fa-envelope-o"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<a class="hidden share-fb" target="_blank" onclick="return Share.me(this);" href="http://www.facebook.com/sharer.php?u=<?=Url::canonical()?>"></a>

<div id="fb-root"></div>

<?php $this->endContent(); ?>

<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<noscript>
  <style>
  html {
    cursor: default;
  }
  a, .menu-togg, .photo-count, .photo-next, .menu-close, .btn, .form-control, .fancybox-prev, .fancybox-next, .fancybox-prev span, .fancybox-next span, .fancybox-close {
    cursor: pointer;
  }
  .vl, .hl, .xl, .xx, .cc, .jsonly {
    display: none!important;
  }
  .cat-wrap {
    opacity: 1;
    min-height: 100%;
    height: auto;
  }
  .main-wrap {
    border-color: #444;
    padding-bottom: 90px;
  }
  .item-row, .gallery-wrap .photo-wrap, .photo-show, .header-pre, .header-post {
    opacity: 1;
  }
  .gallery-wrap .photo-wrap {
    padding: 0;
    margin: 0 5px 5px 0;
  }
  .photo-desc {
    margin-bottom: -20px;
    background-color: rgba(0, 0, 0, 0.5);
    position: relative;
    z-index: 1;
    opacity: 1!important;
  }
  .gallery-wrap .photo-wrap img {
    width: auto;
    height: 15vw;
    left: 0;
  }
  .gallery-wrap .item-wrap .photo:after, .bio-item:after {
    display: none;
  }
  .port-wrap .item-wrap {
    padding-left: 1.5vw;
  }
  .bg-body.fsm, header, .header-logo {
    -webkit-filter: none;
    -webkit-transition: none;
    transition: none;
  }
  #navbar-menu .navbar-nav {
    display: block!important;
  }
  .header-logo {
    border-color: rgba(255,255,255,0.1);
  }
  </style>
</noscript>
