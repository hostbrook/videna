<?php include PATH_VIEWS . 'inc/header.php' ?>

<!-- CONTENT -->
<div class="uk-container uk-container-small uk-flex-auto uk-text-center" data-uk-scrollspy="target: > .animate; cls: uk-animation-slide-bottom-small uk-invisible; delay: 300">

    <h1 class="uk-heading-primary animate uk-invisible" style="font-weight: 700;">Videna <?= $_['login'] ?></h1>

    <div class="uk-margin-medium-top animate uk-invisible" data-uk-margin data-uk-scrollspy-class="uk-animation-fade uk-invisible">

        <!-- Regular buttons: -->
        <!--<button id="google-login" class="uk-button uk-button-default uk-width-2-3 uk-width-auto@s" disabled title="Continue with Google"><span uk-icon="google"></span> Google</button>
        <button id="facebook-login" class="uk-button uk-button-default  uk-width-2-3 uk-width-auto@s" disabled title="Continue with Facebook"><span uk-icon="facebook"></span> Facebook</button>-->

        <!-- Social buttons with names: -->
        <button id="google-login" class="uk-button uk-button-default" style="padding:0;z-index:10;" title="Continue with Google">
            <div id="google-login-bkg" style="z-index:-1;position:relative;"></div>
        </button>
        <br>
        <!-- https://developers.facebook.com/docs/facebook-login/web/login-button/ -->
        <button id="facebook-login" class="uk-button uk-button-default" style="padding:0;" title="Continue with Facebook">
            <div
                class="fb-login-button"
                data-max-rows="1"
                data-size="large"
                data-button-type="continue_with"
                data-use-continue-as="true"
                style="z-index:-1;position:relative;">
            </div>
        </button>   

    </div>

</div>
<!-- /CONTENT -->

<script src="https://accounts.google.com/gsi/client"></script>
<script>
    const config = {
        "google": {
            "client_id": "<?= $config['google']['client_id'] ?>"
        },
        "facebook": {
            "appId": "<?= $config['facebook']['appId'] ?>",
            "appVersion": "<?= $config['facebook']['appVersion'] ?>",
        },
        "lang": {
            "redirection_to_dashboard": "<?= $_['redirection to dashboard'] ?>",
            "creating_an_account": "<?= $_['creating an account'] ?>",
            "account_not_found": "<?= $_['account not found'] ?>"
        }
    }
</script>
<script src="/js/videna-social.js" ></script> <!-- ?ver=<?= rand(1, 999999) ?> -->

<?php include PATH_VIEWS . 'inc/footer.php' ?>