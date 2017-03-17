<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>

        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Cabinet</h1>

            <hr>

            <?php if ($sources): ?>

                <?php foreach ($sources as $source) : ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <?=$source->getId()?>
                            <a href="<?=$source->getSourceLink()?>" target="_blank">
                                <?=$source->getName()?>
                            </a>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <a href="<?=$source->getRssFeedLink()?>" target="_blank">
                            <?=$source->getRssFeedLink()?>
                        </a>
                        <form action="/cabinet/toggle/<?=$source->getId()?>" method="POST" class="pull-right">
                            <input type="hidden" value="<?=abs($source->isActive() - 1)?>">
                            <?php if($source->isActive()): ?>
                                <button type="submit" class="btn btn-primary">
                                    Disable
                                </button>
                            <?php else: ?>
                                <button type="submit" class="btn btn-default">
                                    Enable
                                </button>
                            <?php endif; ?>
                        </form>
                        </div>
                </div>
                <?php endforeach; ?>
            
            <?php else: ?>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">No items to show, add some</h3>
                    </div>
                </div>

            <?php endif; ?>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="/cabinet" method="POST" class="form-horizontal" role="form">
                        
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" id="name" class="form-control" value="" required="required" title="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="source_link" class="col-sm-2 control-label">Source Link:</label>
                            <div class="col-sm-10">
                                <input type="text" name="source_link" id="source_link" class="form-control" value="" required="required" title="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rss_feed_link" class="col-sm-2 control-label">RSS Feed Link:</label>
                            <div class="col-sm-10">
                                <input type="text" name="rss_feed_link" id="rss_feed_link" class="form-control" value="" required="required" title="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            

        </div>
        

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </body>
</html>
