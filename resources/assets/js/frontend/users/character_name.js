$(function(){
    /*
        This script will check for active character profiles on the page and format
        them according to data requested from the API.

        It caches data for... an amount of time TBD.
    */

    var cacheTTL = '86400000';

    $('.character-name').each(function() {
        // Check if this profile has a character name and server associated with it
        var characterName = $(this).attr('data-character-name');
        var characterServer = $(this).attr('data-character-server');

        if(characterName && characterServer) {
            // There is a name and a server
            // Check if cache exists for character
            var cacheName = 'char-'+characterName+'-'+characterServer;

            if(data = $.jStorage.get(cacheName)) {
                var template = WEI.templates.characters.profile.name(data);
                $(this).html(template);
            } else {
                // No cache found
                // Request the character data from the server

                // Need to store the element we're trying to update here
                var updateElement = $(this);

                $.get( "/character/"+characterServer+"/"+characterName, function( data ) {
                    if(data.name) {
                        // There's a char name so we presume everything else is fine
                        // Load the character template and replace the profile block with it
                        var template = WEI.templates.characters.profile.name(data);
                        updateElement.html(template);
                        // Write the data to the cache
                        $.jStorage.set(cacheName, data, {TTL: cacheTTL});
                    }
                });
            }
        }
    });
});
