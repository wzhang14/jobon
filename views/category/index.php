<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
<h1 class="page-header" >Categories <a href="/index.php?r=category/create" class="btn btn-primary pull-right">Create</a> </h1>
<?php if(null !== Yii::$app->session->getFlash('success')) : ?>
    <div class="alert alert-success"><?php echo Yii::$app->session->getFlash('success') ?></div>
<?php endif; ?>
<ul class="list-group">
    <?php foreach($categories as $category) : ?>
        <li class="list-group-item" ><a href="/index.php?r=job&category=<?php echo $category->id; ?>"><?php echo $category->name; ?></a></li>
    <?php endforeach; ?>
</ul>

<?= LinkPager::widget(['pagination' => $pagination]); ?>