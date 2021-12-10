<?php include PATH_VIEWS . 'inc/header.php' ?>

<!-- CONTENT -->
<div class="uk-container uk-container-small uk-flex-auto uk-text-center" data-uk-scrollspy="target: > .animate; cls: uk-animation-slide-bottom-small uk-invisible; delay: 300">
    <h1 class="uk-heading-primary animate uk-invisible" style="font-weight: 700;"><?= $title ?></h1>
    <div class="uk-width-4-5@m uk-margin-auto animate uk-invisible">
        <p class="lead"><?= $description ?></p>
    </div>
    <div class="uk-margin-medium-top animate uk-invisible" data-uk-margin data-uk-scrollspy-class="uk-animation-fade uk-invisible">
        <a class="uk-button uk-button-default uk-button-large uk-width-2-3 uk-width-auto@s" href="<?= URL_ABS ?>" title="Back to home"> <?= $_['home'] ?></a>
    </div>
</div>
<!-- /CONTENT -->

<?php include PATH_VIEWS . 'inc/footer.php' ?>