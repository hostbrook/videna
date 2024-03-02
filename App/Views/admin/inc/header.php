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
                        <a class="uk-logo" title="Videna" href="<?= env('APP_URL') ?>"><img src="/img/videna-logo-white.png"
                                alt="Videna"></a>
                    </div>
                    <ul class="uk-navbar-nav uk-visible@m">
                        <li><a href="/dashboard">Dashboard</a></li>
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
            <a class="uk-logo" title="Videna" href="<?= env('APP_URL') ?>"><img src="/img/videna-logo-white.png"
                    alt="Videna"></a>
        </div>
        <div class="left-content-box  content-box-dark">
            <img src="https://www.gravatar.com/avatar/<?= md5($user->email) ?>" alt=""
                class="uk-border-circle profile-img">
            <h4 class="uk-text-center uk-margin-remove-vertical text-light">
                <?= esc($user->name) ?>
            </h4>

            <div class="uk-position-relative uk-text-center uk-display-block">
                <p href="#" class="uk-text-small uk-text-muted uk-display-block uk-text-center"><?= $user->account < USR_ADMIN ? 'Registered User' : 'Admin' ?></p>
            </div>
        </div>

        <div class="left-nav-wrap">
            <ul class="uk-nav uk-nav-default uk-nav-parent-icon" data-uk-nav>
                <li class="uk-nav-header">ACTIONS</li>
                <?php if ($user->account >= USR_ADMIN) : ?>
                <li><a href="/show-log"><span data-uk-icon="icon: comments" class="uk-margin-small-right"></span>Log file</a>
                </li>
                <?php endif ?>
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

            <div class="left-content-box uk-margin-top">

                <p>APP v<?= $config['app version']?> / FWK v<?= FWK_VERSION ?></p>

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