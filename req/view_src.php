<?php switch ($teachInfo['type']):
    case 'audio': ?>
        <audio src="<?= $srvSrcPath ?>" controls></audio>
        <?php break; ?>
<?php endswitch; ?>