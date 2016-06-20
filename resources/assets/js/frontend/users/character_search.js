/**
 *
 * character_search.js
 * Used on the profile settings page
 * - Searches for a character
 */

 function checkCharacter(character_name, character_server) {

     $('.character_validation').fadeOut();

     character_name = $('input[name="character_name"]').val();
     character_server = $('select[name="character_server"]').find(":selected").val();

     // Do the ajax call
    $.get( "/character/"+character_server+"/"+character_name, function( data ) {

        console.log(data);

        var template = WEI.templates.characters.profile.small(data);

        $('.character_validation').html(template).fadeIn();

    });
 }

$(function(){
    $('input[name="character_name"]').change(function() {
        // If the input gets changed then we need to have a look
        checkCharacter();

    });
});
