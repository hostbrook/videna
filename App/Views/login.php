<?php include PATH_VIEWS . 'inc/header.php' ?>

<!-- CONTENT -->
<div class="uk-container uk-container-small uk-flex-auto uk-text-center" data-uk-scrollspy="target: > .animate; cls: uk-animation-slide-bottom-small uk-invisible; delay: 300">

    <h1 class="uk-heading-primary animate uk-invisible" style="font-weight: 700;">Videna <?= $_['login'] ?></h1>

    <div class="uk-margin-medium-top animate uk-invisible" data-uk-margin data-uk-scrollspy-class="uk-animation-fade uk-invisible">
        <button id="google-login" class="uk-button uk-button-default uk-button-large uk-width-2-3 uk-width-auto@s" disabled title="nue with Google"><span uk-icon="google"></span> Google</button>
        <button id="facebook-login" class="uk-button uk-button-default uk-button-large uk-width-2-3 uk-width-auto@s" title="Continue with Facebook"><span uk-icon="facebook"></span> Facebook</button>
    </div>

</div>
<!-- /CONTENT -->

<script src="https://apis.google.com/js/api.js"></script>
<script src="/js/videna-social.js?ver=220905"></script> <!-- ?ver=<?= rand(1, 999999) ?> -->

<?php include PATH_VIEWS . 'inc/footer.php' ?>