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

    google.accounts.id.initialize({
        client_id: '478936046715-jtejjvl2nefkng5l4ja97qruhm7sfunq.apps.googleusercontent.com',
        callback: handleCredentialResponse
    });

    google.accounts.id.renderButton(
        document.getElementById("google-login"), 
        {
            type: "standard",
            theme: "filled_black",
            size: "large",
            logo_alignment: "left"
        }
    );

    function decodeJwtResponse (token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        return JSON.parse(jsonPayload);
    }
    
    /**
     * Click on Google Login button
     */
    function handleCredentialResponse(response) {     
        const responsePayload = decodeJwtResponse(response.credential);

        var userData = {
            'name': responsePayload.given_name,
            'last_name': responsePayload.family_name,
            'image_url': responsePayload.picture,
            'email': responsePayload.email,
            'network': 'Google'
        }

        SocialNetworkLogin(userData);
    }


    /**
     * Facebook Login initialization
     * To use Facebook login API you need create a Facebook App and generate App ID.
     * url: https://developers.facebook.com/apps/
     */
    window.fbAsyncInit = function() {
        FB.init({
            appId   : '1282007215635462', // your FB App ID
            cookie  : true, // enable cookies to allow the server to access the session
            xfbml   : true, // parse social plugins on this page
            version : 'v15.0' // use graph api version 12.0
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
     * Click on Facebook Login button
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
                        console.info('User cancelled login.');
                    }
        
                }, {scope: ''});
            }
        });
    });

    
    /**
     * Fetch the user profile data from facebook
     */
    function getFbUserData(){

        //  FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
        FB.api('/me', {locale: 'en_US', fields: 'first_name,last_name,email'},

        function (response) {
            // response.first_name
            // response.email
            // response.id
            // response.last_name
            // response.email
            // response.gender
            // response.locale
            // <img src="'+response.picture.data.url+'"/>
            // <a target="_blank" href="'+response.link+'">click to view profile</a>
        
            var userData = {
                'name': response.first_name,
                'last_name': response.last_name,
                //'image_url': response.picture.data.url,
                'email': response.email,
                //'network': 'Facebook'
            }

            return userData;
/*
            SocialNetworkLogin(userData);
            
            document.getElementById('facebook-login').removeAttribute("disabled");
        */
        });

    } // END Facebook Login
    
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

    console.log(user);

    try {
        const response = await fetch("/webapp/check-account-fb", {
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
                    message: 'Redirection to dashboard...',
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
                    jsonResponse.first_name + ', account linked with email ' + jsonResponse.email + ' is not found. Would you like to create a new account with Videna?'
                ).then(function() {
                    UIkit.notification({
                        message: 'Creating an account...',
                        pos: 'bottom-center',
                        status: 'primary'
                    });
                    setTimeout(function() {
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


/**
 * Check if user exists in Database:
 * - if user's email doesn't exist, ask to create account and if yes - sign-in the user
 * - if user's email exist - sign-in the user
 * 
 * @param {object} user Contains Name of social network and retrived user data
 */
 async function SocialNetworkLogin(user) {

    user.csrf_token = document.querySelector('meta[name="csrf_token"]').getAttribute("content");

    try {
        const response = await fetch("/webapp/check-account", {
            method: 'POST',
            body: JSON.stringify(user),
            headers: {
                'Content-type': 'application/json'
            }
        });

        if(response.ok) {

            const jsonResponse = await response.json();
            if (jsonResponse.statusCode != 200) throw Error(jsonResponse.response);
            
            if (jsonResponse.email_exists) {
                // email exists in database

                UIkit.notification({
                    message: 'Redirection to dashboard...',
                    pos: 'bottom-center',
                    status: 'success'
                });

                setTimeout(function() {
                    SignInUser(user);
                }, 500);

            } else {
                // email doesn't exist in database

                UIkit.modal.confirm(
                    user.name + ', account linked with email ' + user.email + ' is not found. Would you like to create a new account with Videna?'
                ).then(function() {
                    UIkit.notification({
                        message: 'Creating an account...',
                        pos: 'bottom-center',
                        status: 'primary'
                    });
                    setTimeout(function() {
                        SignInUser(user);
                    }, 1000);
                }, function () {
                    console.log('User discards of creating an account.')
                });
            };
        }

    } catch (error) {
        console.log(error);
    }
}


/**
 * Sign-in the existing user, creates a new account if doesn't exist
 * 
 * @param {object} user Contains Name of social network and retrived user data
 */
async function SignInUser(user) {

    user.csrf_token = document.querySelector('meta[name="csrf_token"]').getAttribute("content");

    try {
        const response = await fetch("/webapp/social-login", {
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