<!-- FOOTER -->
<div class="uk-position-bottom-center uk-position-small">
    <span class="uk-text-small uk-text-center">
        Copyright © <a href="https://hostbrook.com" title="Developed by HostBrook">HostBrook</a>, <?= date("Y") ?>. <a href="#modal-privacy" id="modal-privacy" uk-toggle>Privacy Policy</a>
    </span>
</div>
<!-- /FOOTER -->

<!-- MODAL Privacy policy -->
<div id="modal-privacy" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Privacy Policy</h2>
        </div>

        <div class="uk-modal-body hb-privacy-body" uk-overflow-auto>

        </div>

        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">OK</button>
        </div>

    </div>
</div>
<!-- /MODAL Privacy policy -->

</div>
</div>

<!-- JS FILES -->
<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>

<script src="/js/videna-ajax.js?ver=211227"></script> <!-- ?ver=<?= rand(1, 999999) ?> -->

<script>
    $(document).ready(function() {
        $("#modal-privacy").on('click', function() {
            $.ajax({

                url: "/ajax/privacy-policy",
                dataType: 'json',

                success: function(data) {
                    $('.hb-privacy-body').html(data.view);
                },

                error: function(jqXHR, textStatus, errorThrown) {
                    jqXHRErrorHandler(jqXHR);
                }

            });
        });
    });
</script>

</body>

</html>