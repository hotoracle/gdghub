 
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
        <head>
                <title><?php echo $title_for_layout; ?></title>
                <style>

                        .threadList li{
                                list-style: none;
                                margin:0;
                                margin:4px;
                                border:1px solid #ddd;
                                font-weight:200;
                                box-shadow: 1px 1px 1px #eeeeff;
                        }
                        .threadList{
                                margin:0;
                                padding:0;
                        }
                        .threadList .threadBody{
                                padding:5px;
                        }
                        .threadList .threadName{
                                font-size:18px;
                                font-weight:200;

                        }
                        .threadList .threadName em{
                                font-size:12px;
                                font-weight:200;
                                color:#ccc;
                                display:block;
                        }


                        .threadList .threadLink{
                                font-size:90%;
                                background:#eee;
                        }


                        .threadList .threadLink a{
                                display:block;
                                text-align: right;
                                background:#eee;
                                padding:2px;
                        }

                </style>
        </head>
        <body  style="font-family:'Helvetica Neue',Helvetica;font-weight:200;font-size:14px;">
                <?php echo $content_for_layout; ?>
              <p>&nbsp;</p>
              <hr />
              <p style="color:#999">
              This mail was sent from <?php echo $this->Html->link(cRead('Application.safe_name'),$this->Html->url('/',true)); ?> @ <?php echo date('h:ia l F jS, Y'); ?>
              </p>
        </body>
</html>