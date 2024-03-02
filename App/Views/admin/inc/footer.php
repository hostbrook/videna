
    <!-- OFFCANVAS -->
    <div id="offcanvas-nav" data-uk-offcanvas="flip: true; overlay: true">
        <div class="uk-offcanvas-bar uk-offcanvas-bar-animation uk-offcanvas-slide">
            <button class="uk-offcanvas-close uk-close uk-icon" type="button" data-uk-close></button>
            <ul class="uk-nav uk-nav-default">
                <li class="uk-active"><a href="#">Active</a></li>
                <li class="uk-parent">
                    <a href="#">Parent</a>
                    <ul class="uk-nav-sub">
                        <li><a href="#">Sub item</a></li>
                        <li><a href="#">Sub item</a></li>
                    </ul>
                </li>
                <li class="uk-nav-header">Header</li>
                <li><a href="#js-options"><span class="uk-margin-small-right uk-icon" data-uk-icon="icon: table"></span>
                        Item</a></li>
                <li><a href="#"><span class="uk-margin-small-right uk-icon" data-uk-icon="icon: thumbnails"></span>
                        Item</a></li>
                <li class="uk-nav-divider"></li>
                <li><a href="#"><span class="uk-margin-small-right uk-icon" data-uk-icon="icon: trash"></span> Item</a>
                </li>
            </ul>
            <h3>Title</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat.</p>
        </div>
    </div>
    <!-- /OFFCANVAS -->

    <!-- MODAL -->
    <div id="modal-hello" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <h2 class="uk-modal-title">Videna</h2>
            <p>Hello
                <?= $user->name ?>!
            </p>
            <p>This is just a blank example of a control panel built on <a href="https://getuikit.com"
                    target="_blank">UIKit</a> and based on free templates source created by <a
                    href="https://github.com/zzseba78/Kick-Off" target="_blank">KickOff</a>.</p>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Ok</button>
            </p>
        </div>
    </div>
    <!-- /MODAL -->

    <script>
        function deleteAccount() {

            const deleteAccount = async () => {
                const data = JSON.stringify({<?= $csrf->json ?>});
                try {
                    const response = await fetch('/webapp/delete-account', {
                        method: 'DELETE',
                        body: data,
                        headers: {
                            'Content-type': 'application/json'
                        }
                    });
                    
                    if (response.ok) {
                        window.location.replace("/");
                    }
                    else {
                        UIkit.notification({
                            message: 'Invalid response from server.',
                            status: 'danger',
                            pos: 'bottom-center'
                        });
                    }
                }
                catch (error) {
                    console.log(error);
                }
            }

            deleteAccount();
        }
    </script>

    <!-- JS FILES -->
    <script src="/js/app.min.js"></script>

</body>

</html>