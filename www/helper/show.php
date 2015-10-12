<?php

if (!isset($profile["profileid"]))
{
    include($_SERVER['DOCUMENT_ROOT'].'/helper/read.php');
    $profileid = $_GET['profileid'];

    $path = $_SERVER['DOCUMENT_ROOT'].'/profiles/'.$profileid.'.json';
    $string = file_get_contents($path);
    $profile=json_decode($string, true);
}

foreach ($profiles as $path)
{
    $string = file_get_contents($path);
    $profile=json_decode($string, true);

    ?>

    <div class="tab-pane" id="user-<?php echo $profile["profileid"]; ?>">
        <?php if
            (
                !empty($profile["bread"])&&
                !empty($profile["size"])&&
                !empty($profile["meat"])
            ) { ?>
            <h3><?php echo $profile["vorname"]; ?> <?php echo $profile["nachname"]; ?></h3>

            <ul class="list-group">
                <?php if(isset($profile["bread"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Brot</span>
                        <p><?php echo $profile["bread"]; ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["size"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Größe</span>
                        <p><?php echo $profile["size"]; ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["meat"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Fleisch</span>
                        <p><?php echo $profile["meat"]; ?>
                            <?php if(isset($profile['doublemeat'])) { ?>
                                <span class="label label-default">Doppelt</span>
                            <?php } ?>
                        </p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["cheese"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Käse</span>
                        <p><?php print(implode( ', ', $profile["cheese"])); ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["salad"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Gemüse</span>
                        <p><?php print(implode( ', ', $profile["salad"])); ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["sauce"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Sauce</span>
                        <p><?php print(implode( ', ', $profile["sauce"])); ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($profile["extras"])) { ?>
                    <li class="list-group-item">
                        <span class="lead clearfix">Extras</span>
                        <p><?php print(implode( ', ', $profile["extras"])); ?></p>
                    </li>
                <?php } ?>
            </ul>
        
        
        <div><p><button id="LoadEditForm" type="button" class="btn btn-default pull-right clearfix" data-profileid="<?php echo $profile["profileid"]; ?>">Bearbeiten</button></p></div>
        <?php } else {
            include 'edit.php';
        } ?>
    </div>
<?php } ?>
