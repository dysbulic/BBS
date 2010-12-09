$( function() {
  $('fieldset.registration').hide();
  $('fieldset').addClass( 'ui-widget-content' );
  $('input:text, input:password').addClass( 'ui-state-highlight' );

  $( 'fieldset.login' ).after(
    $('<a class="register">Create An Account</a>').css( {
      display : 'block',
      width : '12em',
      margin : '1em auto',
    } ).click( function( event ) {
      $('fieldset.login').slideToggle( function( evt ) {
        $(event.target).text(
          $(this).is( ':visible' )
            ? 'Create An Account'
            : 'Login'
        );
      } );
      $('fieldset.registration').slideToggle();
    } )
  );

  $( 'button, input:submit, a.register' ).button();
} )
