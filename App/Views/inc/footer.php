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

        <div class="uk-modal-body" id="privacy-body" uk-overflow-auto>

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
<script src="/js/app.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function(){
        document.getElementById('modal-privacy').addEventListener('click', function () {
        
            const getModalBody = async () => {
                try {
                    const response = await fetch('/api/privacy-policy');
                    if (response.ok) {
                        const html = await response.text();
                        document.getElementById('privacy-body').innerHTML = html;
                    }
                }
                catch (error) {
                    console.log(error);
                }
            }

            getModalBody();

        });
    });
</script>

</body>

</html>