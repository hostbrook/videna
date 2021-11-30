/**
 * Generic Ajax error processing
 * Videna MVC Micro-Framework
 * 
 * @license Apache License 2.0 (https://www.apache.org/licenses/LICENSE-2.0)
 * @author HostBrook <support@hostbrook.com>
 */


/**
 * Check if response from server is in JSON format
 * 
 * @param {json} AjaxResponse Response from server
 * @return {mixed} JSON (if data is JSON && response == 200) | false if error in response
 */
function validResponse(AjaxResponse) {

    let result;

    try {
        result = JSON.parse(AjaxResponse);
    } catch (e) {
        return false;
    }

    if (result.response != 200) {
        console.log('An error occurred during AJAX request execution:');
        console.log('Error status: ' + result.status);
        console.log('Error response: ' + result.response);
        return false;
    }

    return result;
}


/**
 * Ajax error description
 * 
 * @param {object} jqXHR Server response in case error during AJAX request
 * @returns {object} with error description and status
 */
function getErrorDescr(jqXHR) {

    switch(jqXHR.readyState) {
      case 0: var stateDescr = "XHR Object has been created. The request is not initialized yet."; break;
      case 1: var stateDescr = "XHR Object is ready to send a request to the server."; break;
      case 2: var stateDescr = "Request has been sent to the server, but no response has been received."; break;
      case 3: var stateDescr = "HTTP response header information has been received, but the body part of the message has not been fully received."; break;
      case 4: var stateDescr = "Request finished and response is completely received from server."; break;
      default: stateDescr = "Request status unknown";
    }
  
    let errDescr = {
        state: "XHR State #"+jqXHR.readyState+": "+stateDescr,
        status: 'Response status: N/A'
    };

    if (jqXHR.readyState == 4) {

        switch(jqXHR.status) {
            case 200: var statusDescr = "OK"; break;
            case 401: var statusDescr = "Unauthorized"; break;
            case 403: var statusDescr = "Forbidden"; break;
            case 404: var statusDescr = "Page not found"; break;
            case 419: var statusDescr = "Session expired"; break;
            case 429: var statusDescr = "Too Many Requests"; break;
            case 500: var statusDescr = "Internal Server Error"; break;
            case 503: var statusDescr = "Service Unavailable"; break;
            default: statusDescr = "";
        }

        errDescr.status = "Response status: " + jqXHR.statusText+" #"+jqXHR.status + " " + statusDescr;
    }
    
    return errDescr;
  
}


/**
 * Ajax requests error processing
 * 
 * @param {object} jqXHR a string describing the type of error that occurred
 * @param {mixed} output true|false|string flag if output in console is required
 * @returns void|object 
 *          void - if output in console is required
 *          object - if output in console is not required
 */
function jqXHRErrorHandler(jqXHR, output = true){
    let errorDescr = getErrorDescr(jqXHR);
    if (output) {
        if (output === true) {
            console.log('Error occurred during AJAX request:');
        } else console.log(output);
        console.log(errorDescr.state);
        console.log(errorDescr.status);
    }
    else return errorDescr;
}