<?php

use elephantsGroup\like\assets\LikeAsset;

LikeAsset::register($this);
$module = \Yii::$app->getModule('like');
?>
<div>
	<div class="submit-review">
		<div class="fas fa-heart" aria-hidden="true"  onclick="post_like('<?= Yii::getAlias('@web') ?>/like/ajax/add', '<?= Yii::$app->request->csrfToken; ?>', <?= $service ?>, <?= $item ?>)" id="heart-like<?= $item ?>" style="display: <?= $is_like ? 'none' : 'block' ?>; cursor: pointer;"></div>
		<div class="fas fa-heart" aria-hidden="true"  onclick="post_unlike('<?= Yii::getAlias('@web') ?>/like/ajax/remove', '<?= Yii::$app->request->csrfToken; ?>', <?= $service ?>, <?= $item ?>)" id="heart-unlike<?= $item ?>" style="display: <?= !$is_like ? 'none' : 'block' ?>; color: red; cursor: pointer;"></div>
	</div>
</div>