$( function() {
  // By default show the login form
  if( $('fieldset.login').is( ':visible' ) ) {
    $('fieldset.registration').hide()
  }
  
  // Button to alternate between account creation and registration forms
  function setLoginButtonText( $button, $loginform ) {
    $button.text(
      $loginform.is( ':visible' )
        ? 'Create An Account'
        : 'Login'
    );
  }
  var $loginform = $('fieldset.login');
  var $button = ( $('<a id="logintoggle"/>')
                  .click( function( event ) {
                    $loginform.slideToggle( function() {
                      $button.fadeOut( 'fast', function() {
                        setLoginButtonText( $button, $loginform );
                        $button.fadeIn( 'fast' );
                      } )
                    } )
                    $('fieldset.registration').slideToggle();
                  } )
                  .button() )
  $loginform.after( $button );
  setLoginButtonText( $button, $loginform )

  // Add classes to theme interface
  $('fieldset').addClass( 'ui-widget-content' );
  $('input:text, input:password').addClass( 'ui-state-highlight' );


  // Theme the error field
  $('#error')
    .addClass( 'ui-state-error ui-corner-all' )
    .prepend( $('<span/>')
                .addClass( 'ui-icon ui-icon-alert' )
                .css( {
                  float : 'left',
                  'margin-right' : '.3em',
                } ) )

  $( 'button, input:submit' ).button();
} )
