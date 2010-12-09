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
  $('input:text, input:password, textarea').addClass( 'ui-state-highlight ui-corner-all' );

  // Theme the error field
  $('#error')
   .addClass( 'ui-state-error ui-corner-all' )
   .prepend( $('<span/>')
              .addClass( 'ui-icon ui-icon-alert' )
              .css( {
                float : 'left',
                'margin-right' : '.3em',
              } ) )

  // Theme buttons
  $( 'button, input:submit' ).button();

  // Handle the new post dialog
  //$('form[action="new_post.php"').dialog( {
  /* Don't do as a dialog because there's a height limit
  var $postdialog = $('fieldset.post').parent( 'form' ).dialog( {
    autoOpen : false,
    height : $('fieldset.post').height(),
    width : $('fieldset.post').width(),
    modal : true,
    buttons : {
      'New Post' : function( event ) {
        $('fieldset.post').parent( 'form' ).submit()
      },
      Cancel : function( event ) {
        $(this).dialog( 'close' );
      },
    },
  } );
  */
  if( $('fieldset.post').is( ':visible' ) ) {
    $('fieldset.post').hide()
  } else {
    $('fieldset.post').slideDown()
  }

  $('#postmenu')
   .prepend( $('<li>New Thread</li>')
              .click( function( event ) {
                $('fieldset.post').slideDown()
              } ) );

  // Create post menu
  $('#postmenu li').button();

  // Add reply button
  $('#postlist th.content').hide();
  $('#postlist td.content').hide();
  $('#postlist tr').each( function() {
    var depth = $(this).attr( 'depth' );
    if( depth > 1 ) {
      //$(this).hide()
    }
  } );
} )
