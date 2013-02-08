<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php
  if(isset($articleInfo)){
          echo $articleInfo['Article']['name'].' - ';
  }
  
  ?><?php echo Configure::read('Application.name') ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

<link href="https://plus.google.com/112227844855698647164" rel="publisher" />

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <style>
  body {
    padding-top: 60px;
    padding-bottom: 40px;
  }
  </style>
  <?php echo $this->Html->css('normalize.css') ?>
  <?php echo $this->Html->css('bootstrap-'.Configure::read('Layout.theme').'.min', null, array('data-extra' => 'theme')) ?>
  <?php echo $this->Html->css('bootstrap-responsive.min') ?>
  <?php echo $this->Html->css('style') ?>

  <?php
  if (is_file(WWW_ROOT . 'css' . DS . $this->params->controller . '.css')) {
  echo $this->Html->css($this->params->controller);
  }
  if (is_file(WWW_ROOT . 'css' . DS . $this->params->controller . DS . $this->params->action . '.css')) {
  echo $this->Html->css($this->params->controller . '/' . $this->params->action);
  }
  ?>


  <?php echo $this->Html->script('lib/modernizr') ?>
</head>
<body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
            <![endif]-->

            <div class="navbar navbar-fixed-top">
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <?php echo $this->Html->link( Configure::read('Application.name') ,"/",array('class' => 'brand')) ?>
                  <div class="nav-collapse">
                    <ul class="nav">
                            <li class="topPlusOne">
                                    <g:plusone></g:plusone>
                                </li>
                                <li>
                                        <?php echo $this->Html->link('Want to Help?',"/Dashboard/help"); ?>
                                </li>
                      
                    </ul>

             

                        </div><!--/.nav-collapse -->
                      </div>
                    </div>
                  </div>

                  <div class="container" role="main" id="main">

                    <?php echo $this->Session->flash();?>
                    <?php echo $this->fetch('content'); ?>

                    <hr>

                    <footer>
                      <p><?php echo Configure::read('Application.name') ?> </p>
                    </footer>

                  </div> <!-- /container -->

                  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
                  <script>window.jQuery || document.write('<script src="<?php echo $this->params->webroot ?>js/lib/jquery.min.js"><\/script>')</script>

                  <?php
                  if (is_file(WWW_ROOT . 'js' . DS . $this->params->controller . '.js')) {
                  echo $this->Html->script($this->params->controller);
                  }
                  if (is_file(WWW_ROOT . 'js' . DS . $this->params->controller . DS . $this->params->action . '.js')) {
                  echo $this->Html->script($this->params->controller . '/' . $this->params->action);
                  }
                  ?>

                  <?php echo $this->Html->script(
                    array(
                      'lib/bootstrap.min',
                      'src/scripts.js'
                      ));
                      ?>

                      <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<!--                      <script>
                      var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
                      (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
                        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
                        s.parentNode.insertBefore(g,s)}(document,'script'));
                      </script>
-->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

                    </body>
                    </html>