<div class="container">
    <h1 class="text-center">
        My News Feed
        <?php if ($logged) echo '<b>LOGGED</b>'; else echo '<b>NOT LOGGED</b>'; ?>
    </h1>

    <hr>

    <?php foreach ($items as $item) : ?>
    <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?=$item->getId()?>
                    <b><?=$item->getPubDate()?></b>:
                    <a href="<?=$item->getLink()?>" target="_blank">
                        <?=$item->getTitle()?>
                    </a>
                </h3>
            </div>
            <div class="panel-body">
                <?=$item->getDescription()?>
            </div>
    </div>
    <?php endforeach; ?>
    
</div>
