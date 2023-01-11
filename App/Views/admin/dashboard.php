<!DOCTYPE html>
<html lang="<?= $view->lang ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= $view->description ?>">

    <title>
        <?= $view->title ?>
    </title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
    <link rel="shortcut icon" href="/favicon/favicon.ico">

    <!-- CSS FILES -->
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/dashboard.css">

    <style>
        .lead {
            font-size: 1.175em;
            font-weight: 300;
        }

        .uk-logo img {
            height: 28px;
        }
    </style>
</head>

<body>

    <!--HEADER-->
    <header id="top-head" class="uk-position-fixed">
        <div class="uk-container uk-container-expand uk-background-primary">
            <nav class="uk-navbar uk-light" data-uk-navbar="mode:click; duration: 250">
                <div class="uk-navbar-left">
                    <div class="uk-navbar-item uk-hidden@m">
                        <a class="uk-logo" title="Videna" href="<?= URL_ABS ?>"><img src="/img/videna-logo-white.png"
                                alt="Videna"></a>
                    </div>
                    <ul class="uk-navbar-nav uk-visible@m">
                        <li><a href="#">Accounts</a></li>
                        <li>
                            <a href="#">Settings <span data-uk-icon="icon: triangle-down"></span></a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li class="uk-nav-header">YOUR ACCOUNT</li>
                                    <li><a href="#"><span data-uk-icon="icon: info"></span> Summary</a></li>
                                    <li><a href="#"><span data-uk-icon="icon: refresh"></span> Edit</a></li>
                                    <li><a href="#"><span data-uk-icon="icon: settings"></span> Configuration</a></li>
                                    <?php if ($user->account < USR_ADMIN) : ?>
                                    <li class="uk-nav-divider"></li>
                                    <li><a href="javascript:deleteAccount();"><span data-uk-icon="icon: warning"></span> Delete Account</a></li>
                                    <?php endif; ?>
                                    <li class="uk-nav-divider"></li>
                                    <li><a href="/logout"><span data-uk-icon="icon: sign-out"></span> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    <div class="uk-navbar-item uk-visible@s">
                        <form action="dashboard.html" class="uk-search uk-search-default">
                            <span data-uk-search-icon></span>
                            <input class="uk-search-input search-field" type="search" placeholder="Search">
                        </form>
                    </div>
                </div>
                <div class="uk-navbar-right">
                    <ul class="uk-navbar-nav">
                        <li><a href="#" data-uk-icon="icon:user" title="Your profile" data-uk-tooltip></a></li>
                        <li><a href="#" data-uk-icon="icon: settings" title="Settings" data-uk-tooltip></a></li>
                        <li><a href="/logout" data-uk-icon="icon:  sign-out" title="Sign Out" data-uk-tooltip></a></li>
                        <li><a class="uk-navbar-toggle" data-uk-toggle data-uk-navbar-toggle-icon href="#offcanvas-nav"
                                title="Offcanvas" data-uk-tooltip></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--/HEADER-->

    <!-- LEFT BAR -->
    <aside id="left-col" class="uk-light uk-visible@m">
        <div class="left-logo uk-flex uk-flex-middle uk-flex-center">
            <a class="uk-logo" title="Videna" href="<?= URL_ABS ?>"><img src="/img/videna-logo-white.png"
                    alt="Videna"></a>
        </div>
        <div class="left-content-box  content-box-dark">
            <img src="https://www.gravatar.com/avatar/<?= md5($user->email) ?>" alt=""
                class="uk-border-circle profile-img">
            <h4 class="uk-text-center uk-margin-remove-vertical text-light">
                <?= $user->name ?>
            </h4>

            <div class="uk-position-relative uk-text-center uk-display-block">
                <p href="#" class="uk-text-small uk-text-muted uk-display-block uk-text-center"><?= $user->account < USR_ADMIN ? 'Registered User' : 'Admin' ?></p>
            </div>
        </div>

        <div class="left-nav-wrap">
            <ul class="uk-nav uk-nav-default uk-nav-parent-icon" data-uk-nav>
                <li class="uk-nav-header">ACTIONS</li>
                <li><a href="#"><span data-uk-icon="icon: comments" class="uk-margin-small-right"></span>Messages</a>
                </li>
                <li><a href="#"><span data-uk-icon="icon: users" class="uk-margin-small-right"></span>Friends</a></li>
                <li class="uk-parent"><a href="#"><span data-uk-icon="icon: thumbnails"
                            class="uk-margin-small-right"></span>Templates</a>
                    <ul class="uk-nav-sub">
                        <li><a title="Article" href="https://zzseba78.github.io/Kick-Off/article.html">Article</a></li>
                        <li><a title="Album" href="https://zzseba78.github.io/Kick-Off/album.html">Album</a></li>
                        <li><a title="Cover" href="https://zzseba78.github.io/Kick-Off/cover.html">Cover</a></li>
                        <li><a title="Cards" href="https://zzseba78.github.io/Kick-Off/cards.html">Cards</a></li>
                        <li><a title="News Blog" href="https://zzseba78.github.io/Kick-Off/newsBlog.html">News Blog</a>
                        </li>
                        <li><a title="Price" href="https://zzseba78.github.io/Kick-Off/price.html">Price</a></li>
                        <li><a title="Login" href="https://zzseba78.github.io/Kick-Off/login.html">Login</a></li>
                        <li><a title="Login-Dark" href="https://zzseba78.github.io/Kick-Off/login-dark.html">Login -
                                Dark</a></li>
                    </ul>
                </li>
                <li><a href="#"><span data-uk-icon="icon: album" class="uk-margin-small-right"></span>Albums</a></li>
                <li><a href="#"><span data-uk-icon="icon: thumbnails" class="uk-margin-small-right"></span>Featured
                        Content</a></li>
                <li><a href="#"><span data-uk-icon="icon: lifesaver" class="uk-margin-small-right"></span>Tips</a></li>
                <li class="uk-parent">
                    <a href="#"><span data-uk-icon="icon: comments" class="uk-margin-small-right"></span>Reports</a>
                    <ul class="uk-nav-sub">
                        <li><a href="#">Sub item</a></li>
                        <li><a href="#">Sub item</a></li>
                    </ul>
                </li>
            </ul>
            <div class="left-content-box uk-margin-top">

                <h5>Daily Reports</h5>
                <div>
                    <span class="uk-text-small">Traffic <small>(+50)</small></span>
                    <progress class="uk-progress" value="50" max="100"></progress>
                </div>
                <div>
                    <span class="uk-text-small">Income <small>(+78)</small></span>
                    <progress class="uk-progress success" value="78" max="100"></progress>
                </div>
                <div>
                    <span class="uk-text-small">Feedback <small>(-12)</small></span>
                    <progress class="uk-progress warning" value="12" max="100"></progress>
                </div>

            </div>

        </div>
        <div class="bar-bottom">
            <ul class="uk-subnav uk-flex uk-flex-center uk-child-width-1-5" data-uk-grid>
                <li>
                    <a href="#" class="uk-icon-link" data-uk-icon="icon: home" title="Home" data-uk-tooltip></a>
                </li>
                <li>
                    <a href="#" class="uk-icon-link" data-uk-icon="icon: settings" title="Settings" data-uk-tooltip></a>
                </li>
                <li>
                    <a href="#" class="uk-icon-link" data-uk-icon="icon: social" title="Social" data-uk-tooltip></a>
                </li>

                <li>
                    <a href="/logout" class="uk-icon-link" data-uk-tooltip="Sign out" data-uk-icon="icon: sign-out"></a>
                </li>
            </ul>
        </div>
    </aside>
    <!-- /LEFT BAR -->

    <!-- CONTENT -->
    <div id="content" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
            <div class="uk-grid uk-grid-divider uk-grid-medium uk-child-width-1-2 uk-child-width-1-4@l uk-child-width-1-5@xl"
                data-uk-grid>
                <div>
                    <span class="uk-text-small"><span data-uk-icon="icon:users"
                            class="uk-margin-small-right uk-text-primary"></span>New Users</span>
                    <h1 class="uk-heading-primary uk-margin-remove  uk-text-primary">2.134</h1>
                    <div class="uk-text-small">
                        <span class="uk-text-success" data-uk-icon="icon: triangle-up">15%</span> more than last week.
                    </div>
                </div>
                <div>

                    <span class="uk-text-small"><span data-uk-icon="icon:social"
                            class="uk-margin-small-right uk-text-primary"></span>Social Media</span>
                    <h1 class="uk-heading-primary uk-margin-remove uk-text-primary">8.490</h1>
                    <div class="uk-text-small">
                        <span class="uk-text-warning" data-uk-icon="icon: triangle-down">-15%</span> less than last
                        week.
                    </div>

                </div>
                <div>

                    <span class="uk-text-small"><span data-uk-icon="icon:clock"
                            class="uk-margin-small-right uk-text-primary"></span>Traffic hours</span>
                    <h1 class="uk-heading-primary uk-margin-remove uk-text-primary">12.00<small
                            class="uk-text-small">PM</small></h1>
                    <div class="uk-text-small">
                        <span class="uk-text-success" data-uk-icon="icon: triangle-up"> 19%</span> more than last week.
                    </div>

                </div>
                <div>

                    <span class="uk-text-small"><span data-uk-icon="icon:search"
                            class="uk-margin-small-right uk-text-primary"></span>Week Search</span>
                    <h1 class="uk-heading-primary uk-margin-remove uk-text-primary">9.543</h1>
                    <div class="uk-text-small">
                        <span class="uk-text-danger" data-uk-icon="icon: triangle-down"> -23%</span> less than last
                        week.
                    </div>

                </div>
                <div class="uk-visible@xl">
                    <span class="uk-text-small"><span data-uk-icon="icon:users"
                            class="uk-margin-small-right uk-text-primary"></span>Lorem ipsum</span>
                    <h1 class="uk-heading-primary uk-margin-remove uk-text-primary">5.284</h1>
                    <div class="uk-text-small">
                        <span class="uk-text-success" data-uk-icon="icon: triangle-up"> 7%</span> more than last week.
                    </div>
                </div>
            </div>
            <hr>
            <div class="uk-grid uk-grid-medium" data-uk-grid uk-sortable="handle: .sortable-icon">

                <!-- panel -->
                <div class="uk-width-1-2@l">
                    <div class="uk-card uk-card-default uk-card-small uk-card-hover">
                        <div class="uk-card-header">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-auto">
                                    <h4>Sales Chart</h4>
                                </div>
                                <div class="uk-width-expand uk-text-right panel-icons">
                                    <a href="#" class="uk-icon-link sortable-icon" title="Move" data-uk-tooltip
                                        data-uk-icon="icon: move"></a>
                                    <a href="#" class="uk-icon-link" title="Configuration" data-uk-tooltip
                                        data-uk-icon="icon: cog"></a>
                                    <a href="#" class="uk-icon-link" title="Close" data-uk-tooltip
                                        data-uk-icon="icon: close"></a>
                                </div>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <div class="chart-container">
                                <canvas id="chart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /panel -->
                <!-- panel -->
                <div class="uk-width-1-2@l">
                    <div class="uk-card uk-card-default uk-card-small uk-card-hover">
                        <div class="uk-card-header">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-auto">
                                    <h4>Predictions Chart</h4>
                                </div>
                                <div class="uk-width-expand uk-text-right panel-icons">
                                    <a href="#" class="uk-icon-link sortable-icon" title="Move" data-uk-tooltip
                                        data-uk-icon="icon: move"></a>
                                    <a href="#" class="uk-icon-link" title="Configuration" data-uk-tooltip
                                        data-uk-icon="icon: cog"></a>
                                    <a href="#" class="uk-icon-link" title="Close" data-uk-tooltip
                                        data-uk-icon="icon: close"></a>
                                </div>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <div class="chart-container">
                                <canvas id="chart1"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /panel -->
                <!-- panel -->
                <div class="uk-width-1-1 uk-width-1-3@l uk-width-1-2@xl">
                    <div class="uk-card uk-card-default uk-card-small uk-card-hover">
                        <div class="uk-card-header">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-auto">
                                    <h4>Activity Chart</h4>
                                </div>
                                <div class="uk-width-expand uk-text-right panel-icons">
                                    <a href="#" class="uk-icon-link sortable-icon" title="Move" data-uk-tooltip
                                        data-uk-icon="icon: move"></a>
                                    <a href="#" class="uk-icon-link" title="Configuration" data-uk-tooltip
                                        data-uk-icon="icon: cog"></a>
                                    <a href="#" class="uk-icon-link" title="Close" data-uk-tooltip
                                        data-uk-icon="icon: close"></a>
                                </div>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <div class="chart-container">
                                <canvas id="chart3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /panel -->
                <!-- panel -->
                <div class="uk-width-1-2@s uk-width-1-3@l uk-width-1-4@xl">
                    <div class="uk-card uk-card-default uk-card-small uk-card-hover">
                        <div class="uk-card-header">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-auto">
                                    <h4>Distribution Chart</h4>
                                </div>
                                <div class="uk-width-expand uk-text-right panel-icons">
                                    <a href="#" class="uk-icon-link sortable-icon" title="Move" data-uk-tooltip
                                        data-uk-icon="icon: move"></a>
                                    <a href="#" class="uk-icon-link" title="Configuration" data-uk-tooltip
                                        data-uk-icon="icon: cog"></a>
                                    <a href="#" class="uk-icon-link" title="Close" data-uk-tooltip
                                        data-uk-icon="icon: close"></a>
                                </div>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <div class="chart-container">
                                <canvas id="chart4"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /panel -->
                <!-- panel -->
                <div class="uk-width-1-2@s uk-width-1-3@l uk-width-1-4@xl">
                    <div class="uk-card uk-card-default uk-card-small uk-card-hover">
                        <div class="uk-card-header">
                            <div class="uk-grid uk-grid-small">
                                <div class="uk-width-auto">
                                    <h4>Population Chart</h4>
                                </div>
                                <div class="uk-width-expand uk-text-right panel-icons">
                                    <a href="#" class="uk-icon-link sortable-icon" title="Move" data-uk-tooltip
                                        data-uk-icon="icon: move"></a>
                                    <a href="#" class="uk-icon-link" title="Configuration" data-uk-tooltip
                                        data-uk-icon="icon: cog"></a>
                                    <a href="#" class="uk-icon-link" title="Close" data-uk-tooltip
                                        data-uk-icon="icon: close"></a>
                                </div>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <div class="chart-container">
                                <canvas id="chart5"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /panel -->
            </div>
            <footer class="uk-section uk-section-small uk-text-center">
                <hr>
                <p class="uk-text-small uk-text-center">Copyright 2019 - <a
                        href="https://github.com/zzseba78/Kick-Off">Created by KickOff</a> | Built with <a
                        href="http://getuikit.com" title="Visit UIkit 3 site" target="_blank" data-uk-tooltip><span
                            data-uk-icon="uikit"></span></a> </p>
            </footer>
        </div>
    </div>
    <!-- /CONTENT -->

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
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            UIkit.modal('#modal-hello').show();
        });
    </script>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script src="js/chartScripts.js"></script>
</body>

</html>