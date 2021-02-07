/**
 * SPA processing
 */

// Load page in target tag
function loadPage(url){

  //let target='#spa-page';

  $.ajax({

    url: '/spa' + url,
    data: {lang: spaData.lang},

    success: function (JSONdata) {
      let out;
      if ( !(out = isJSON(JSONdata)) ) return false;

      // Show the page:
      $(spaData.target).html(out.html);

      // Change page title:
      $('title').html(out.title);

      // Change page description:
      $('meta[name=description]').remove();
      $('head').append( '<meta name="description" content="'+out.description+'">' );

    },

    error:  function(jqXHR, textStatus, errorThrown){ alert("ERROR: "+getErrorMessage(jqXHR)); }

  });

}

// Re-assign action when click on SPA link
function _navigate(e) {
  e.stopPropagation();
  e.preventDefault();

  let url = $(e.target).attr('href');
  loadPage(url);

  history.pushState({page: url}, '', url);
}
 
// Re-assign action when click back/forward buttons in the browser
function _popState(e) {
  page = (e.state && e.state.page) || false;
  if (page===false) {
    history.back();
  } else loadPage(page);
}


// Initialization of the SPA
$( document ).ready(function() {

  // Assign function when click SPA link:
  $('body').on('click', '.spa', _navigate);
  // Assign function when click back/forward buttons in the browser
  window.onpopstate = _popState;

});