/**
 * Social Login processing
 * Videna MVC Micro-Framework
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */

 document.addEventListener("DOMContentLoaded", function(){

    /**
     * Google Login initialization
     * To use Google AUTH 2.0 you need get credentials: https://console.cloud.google.com/apis/credentials
     * 1. get OAuth client ID as for `Web application`
     * 2. get API key with restriction to Google+ API only
     */
    gapi.load('client:auth2', {
        callback: function() {
            // Initialize client library
            gapi.client.init({
                apiKey: 'AIzaSyDMHvQQvIKKJrP6AV_bS0cvk0tCTkmp_28',
                clientId: '478936046715-jtejjvl2nefkng5l4ja97qruhm7sfunq.apps.googleusercontent.com',
                scope: 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me'
            }).then(
                // On success
                function(success) {
                    // After library is successfully loaded then enable the login button
                    document.getElementById('google-login').removeAttribute("disabled");
                },
                // On error
                function(error) {
                    document.getElementById('google-login').removeAttribute("disabled");
                    UIkit.notification({
                        message: 'ERROR: Failed to Initialize client library (Google).',
                        status: 'danger',
                        pos: 'bottom-center'
                    });
                }
            );
        },
        onerror: function() {
            // Failed to load libraries
            document.getElementById('google-login').removeAttribute("disabled");
            
            UIkit.notification({
                message: 'ERROR: Failed to load client libraries (Google).',
                status: 'danger',
                pos: 'bottom-center'
            });
        }
    });


    /**
     * Click on Google Login button
     */
    document.getElementById('google-login').addEventListener('click', function () {

        document.getElementById('google-login').setAttribute("disabled", "");

        // API call for Google login
        GoogleAuth = gapi.auth2.getAuthInstance();
        GoogleAuth.signIn().then(

            // On success of Google Login
            function(success) {

                var GoogleUser = GoogleAuth.currentUser.get();

                if (GoogleUser.isSignedIn()) {
                    // User is signed-in 

                    var profile = GoogleUser.getBasicProfile();
                    //console.log('ID: ' + profile.getId());
                    //console.log('Full Name: ' + profile.getName());
                    //console.log('First Name: ' + profile.getGivenName());
                    //console.log('Last Name: ' + profile.getFamilyName());
                    //console.log('Image URL: ' + profile.getImageUrl());
                    //console.log('Email: ' + profile.getEmail());

                    var userData = {
                        'name': profile.getGivenName(),
                        'last_name': profile.getFamilyName(),
                        'image_url': profile.getImageUrl(),
                        'email': profile.getEmail(),
                        'network': 'Google'
                    }

                    SocialNetworkLogin(userData);

                } else {
                    // by some reasons user can not be signed-in
                    document.getElementById('google-login').removeAttribute("disabled");
                    
                    UIkit.notification({
                        message: 'ERROR: Failed to retrieve user data.',
                        status: 'danger',
                        pos: 'bottom-center'
                    });
                }

            },

            function(error) {
                // In the case if Google Login is Failed
                document.getElementById('google-login').removeAttribute("disabled");
                
                UIkit.notification({
                    message: 'User cancelled login',
                    status: 'warning',
                    pos: 'bottom-center'
                });
            }
        );

    }); // END Google Login


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
            version : 'v12.0' // use graph api version 12.0
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
                getFbUserData();
            }
            else {
                // User is not logged-in. Try to login.
                FB.login(function (response) {

                    if (response.authResponse) {
                        // Retrive user data:
                        getFbUserData();
                    } else {
                        // User cancelled login or did not fully authorized.
                        document.getElementById('facebook-login').removeAttribute("disabled");
                        
                        UIkit.notification({
                            message : 'User cancelled login',
                            status  : 'warning',
                            pos     : 'bottom-center'
                        });
                    }
        
                }, {scope: 'email'});
            }
        });
    });

    
    /**
     * Fetch the user profile data from facebook
     */
    function getFbUserData(){

        //  FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
        FB.api('/me', {locale: 'en_US', fields: 'first_name,last_name,email,picture'},

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
                'image_url': response.picture.data.url,
                'email': response.email,
                'network': 'Facebook'
            }

            SocialNetworkLogin(userData);
            
            document.getElementById('facebook-login').removeAttribute("disabled");
        
        });

    } // END Facebook Login
    

});


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