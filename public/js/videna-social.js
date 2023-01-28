/**
 * Social Login processing
 * Videna MVC Micro-Framework
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */

document.addEventListener("DOMContentLoaded", function(){

    /**
     * Sign In With Google JavaScript API
     * API: https://developers.google.com/identity/gsi/web/reference/js-reference#click_listener
     * To use Sign In With Google API you need get credentials: https://console.cloud.google.com/apis/credentials
     * 1. get OAuth 2.0 Client IDs as for `Web application`
     * 2. Set URL in Authorized JavaScript origins that host your web application
     */

    /**
     * "Continue with Google" button background
     */
    
    google.accounts.id.initialize({
        client_id: config.google.client_id,
        //callback: handleCredentialResponse
    });
    google.accounts.id.renderButton(
        // https://developers.google.com/identity/gsi/web/reference/js-reference#width
        document.getElementById("google-login-bkg"), 
        {
            type: "standard",
            theme: "filled_blue",
            size: "large",
            logo_alignment: "left",
            text: "continue_with",
            width: 256
        }
    );
    

    // Uncomment for autetification:
    /*
    function decodeJwtResponse (token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        return JSON.parse(jsonPayload);
    }

    // Click on Google Login button
    
    function handleCredentialResponse(response) {     
        const responsePayload = decodeJwtResponse(response.credential);
        console.log(response);
        console.log(responsePayload);

        var userData = {
            'name': responsePayload.given_name,
            'last_name': responsePayload.family_name,
            'image_url': responsePayload.picture,
            'email': responsePayload.email,
            'network': 'Google'
        }

        //SocialNetworkLogin(userData);
    }
    */

    /**
     * Sign In With Google Identity Service (GIS)
     * To use Sign In With GSI you need:
     * - get credentials: https://console.cloud.google.com/apis/credentials
     * - get OAuth 2.0 Client IDs as for `Web application`
     * URL: https://developers.google.com/identity/oauth2/web/guides/migration-to-gis
     */

    var client;

    client = google.accounts.oauth2.initCodeClient({
        client_id: config.google.client_id,
        scope: 'https://www.googleapis.com/auth/userinfo.profile',
        ux_mode: 'popup',
        callback: handleGisResponse
    });

    document.getElementById('google-login').removeAttribute("disabled");


    /**
     * Click on "Continue with Google" button
     */

    document.getElementById('google-login').addEventListener('click', function () {
        document.getElementById('google-login').setAttribute("disabled", "");
        // Request authorization code and obtain user consent
        client.requestCode();
    })

    async function handleGisResponse(responseGSI) {

        responseGSI.csrf_token = document.querySelector('meta[name="csrf_token"]').getAttribute("content");
    
        try {
            const response = await fetch("/webapp/google-account", {
                method: 'POST',
                body: JSON.stringify(responseGSI),
                headers: {
                    'Content-type': 'application/json'
                }
            });
    
            if(response.ok) {
    
                const jsonResponse = await response.json();
                if (jsonResponse.statusCode != 200) throw Error(jsonResponse.response);
    
                console.info('App response: '+ jsonResponse.result);
    
                if (jsonResponse.result == 'user logined') {
                    // account exists in Videna database
    
                    UIkit.notification({
                        message: config.lang.redirection_to_dashboard,
                        pos: 'bottom-center',
                        status: 'success'
                    });
    
                    setTimeout(function() {
                        window.location.replace("/dashboard");
                    }, 500);
                    
                }
                else if (jsonResponse.result == 'user not exist') {
                    // account does not exist in Videna database
                    
                    UIkit.modal.confirm(
                        config.lang.account_not_found.replace("{name}",jsonResponse.first_name).replace("{email}",jsonResponse.email)
                    ).then(function() {
                        UIkit.notification({
                            message: config.lang.creating_an_account,
                            pos: 'bottom-center',
                            status: 'primary'
                        });
                        
                        setTimeout(function() {
                            CreateAccount({
                                "network": 'google',
                                "accessToken": jsonResponse.accessToken,
                                "csrf_token": document.querySelector('meta[name="csrf_token"]').getAttribute("content")
                            });
                        }, 1000);
                    }, function () {
                        console.log('User discarded creating an account.')
                        document.getElementById('google-login').removeAttribute("disabled");
                    });
                }
    
            }
    
        } catch (error) {
            console.log(error);
        }

    }

    /**
     * Facebook Login initialization
     * To use Facebook login API you need create a Facebook App and generate App ID.
     * url: https://developers.facebook.com/apps/
     */

    window.fbAsyncInit = function() {
        FB.init({
            appId   : config.facebook.appId,
            cookie  : true, // enable cookies to allow the server to access the session
            xfbml   : true, // parse social plugins on this page
            version : config.facebook.appVersion
        });
        FB.AppEvents.logPageView();

        document.getElementById('facebook-login').removeAttribute("disabled");
    };

    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "https://connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    

    /**
     * Click on "Continue with Facebook" button
     */
    document.getElementById('facebook-login').addEventListener('click', function () {

        document.getElementById('facebook-login').setAttribute("disabled", "");

        // Check whether the user already logged in
        FB.getLoginStatus(function(response) {

            if (response.status === 'connected') {
                // User already logged-in. Retrive user data:
                console.info('User is already logged into Facebook. Checking user data in app...');
                checkFbUserData(response.authResponse);
            }
            else {
                // User is not logged-in. Try to login.
                console.info('User is not logged into Facebook. Trying to login via FB modal window ...');
                FB.login(function (response) {

                    if (response.authResponse) {
                        // Retrive user data:
                        console.info('User logged successfully. Checking user data in app...');
                        checkFbUserData(response.authResponse);
                    } else {
                        // User cancelled login or did not fully authorized.
                        document.getElementById('facebook-login').removeAttribute("disabled");
                        console.info('User discarded creating an account.');
                    }
        
                }, {scope: ''});
            }
        });
    });
   
});


/**
 * Send request to the server to check user data using provided by FB API token.
 * At the server retrive user data from FB and:
 * - if user exists in App DB, login user and return response with successful 
 *   with next step is redirect to the user page login
 * - if user doesn't exists in App DB, return response and ask if user want to 
 *   be registered at the App
 */
    
async function checkFbUserData(user) {

    user.csrf_token = document.querySelector('meta[name="csrf_token"]').getAttribute("content");

    try {
        const response = await fetch("/webapp/facebook-account", {
            method: 'POST',
            body: JSON.stringify(user),
            headers: {
                'Content-type': 'application/json'
            }
        });

        if(response.ok) {

            const jsonResponse = await response.json();
            if (jsonResponse.statusCode != 200) throw Error(jsonResponse.response);

            console.info('App response: '+ jsonResponse.result);

            if (jsonResponse.result == 'user logined') {
                // account exists in database

                UIkit.notification({
                    message: config.lang.redirection_to_dashboard,
                    pos: 'bottom-center',
                    status: 'success'
                });

                setTimeout(function() {
                    window.location.replace("/dashboard");
                }, 500);
                
            }
            else if (jsonResponse.result == 'user not exist') {
                // account does not exist in database
                
                UIkit.modal.confirm(
                    config.lang.account_not_found.replace("{name}",jsonResponse.first_name).replace("{email}",jsonResponse.email)
                ).then(function() {
                    UIkit.notification({
                        message: config.lang.creating_an_account,
                        pos: 'bottom-center',
                        status: 'primary'
                    });
                    setTimeout(function() {
                        user.network = 'facebook';
                        CreateAccount(user);
                    }, 1000);
                }, function () {
                    console.log('User discards of creating an account.')
                });
            }

        }

    } catch (error) {
        console.log(error);
    }
}



async function CreateAccount(user) {

    try {
        const response = await fetch("/webapp/create-account", {
            method: 'POST',
            body: JSON.stringify(user),
            headers: {
                'Content-type': 'application/json'
            }
        });

        if(response.ok) {
            
            const jsonResponse = await response.json();
            if (jsonResponse.statusCode != 200) throw Error(jsonResponse.response);

            setTimeout(function() {
                window.location.replace("/dashboard");
            }, 500);

        }
    } catch (error) {
        console.log(error);
    }
}