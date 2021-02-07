/**
 * Generic Ajax error processing
 */

function isJSON(str) {
  let out;
  try {
    out = JSON.parse(str);
  } catch (e) {
    console.log('An error occurred during AJAX request execution. No JSON data provided.');
    console.log(str);
    return false;
  }

  if (out.response != 200) {
    console.log('An error occurred during AJAX request execution: ' + out.text);
    return false;
  }

  return out;
}


function getErrorMessage(jqXHR){

  switch(jqXHR.readyState) {
    case 0: var status = "Request not initialized"; break;
    case 1: var status = "Server connection established"; break;
    case 2: var status = "Request received"; break;
    case 3: var status = "Processing request "; break;
    case 4: var status = "Request finished and response is ready"; break;
    case 5: var status = "Server connection established"; break;
    default: status = "Request status unknown";
  }

  if (jqXHR.readyState == 0) {
    var ErrorMessage = "Can't send request. ";
  } else var ErrorMessage = "ERROR: #" + jqXHR.status + " " + jqXHR.statusText;

  ErrorMessage += "STATE: #" + jqXHR.readyState + " " + status;

  return ErrorMessage;

}