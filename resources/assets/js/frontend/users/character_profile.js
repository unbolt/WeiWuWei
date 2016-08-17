$(function(){
    /*
        This script will check for active character profiles on the page and format
        them according to data requested from the API.

        It caches data for... an amount of time TBD.
    */

    var cacheTTL = '86400000';

    $('.character-profile').each(function() {
        // Check if this profile has a character name and server associated with it
        var characterName = $(this).attr('data-character-name');
        var characterServer = $(this).attr('data-character-server');
        var characterTag = $(this).attr('data-character-tag');

        if(characterName && characterServer) {
            // There is a name and a server
            // Check if cache exists for character
            var cacheName = 'char-'+characterName+'-'+characterServer;

            if(data = $.jStorage.get(cacheName)) {

                if ($(this).hasClass('character-profile-small')) {
                    // Add the profile fields to the data array so handlebars processes it properly
                    data.twitch = $(this).attr('data-character-twitch');
                    data.twitter = $(this).attr('data-character-twitter');
                    data.youtube = $(this).attr('data-character-youtube');
                    data.serverslug = $(this).attr('data-character-server');

                    var template = WEI.templates.characters.profile.roster(data);
                } else {

                    data.tag = characterTag;
                    var template = WEI.templates.characters.profile.side(data);
                }

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
                        if((updateElement).hasClass('character-profile-small')) {
                            // Add the profile fields to the data array so handlebars processes it properly
                            data.twitch = $(this).attr('data-character-twitch');
                            data.twitter = $(this).attr('data-character-twitter');
                            data.youtube = $(this).attr('data-character-youtube');
                            data.serverslug = $(this).attr('data-character-server');

                            var template = WEI.templates.characters.profile.roster(data);
                        } else {

                            data.tag = $(this).attr('data-character-tag');

                            var template = WEI.templates.characters.profile.side(data);
                        }

                        updateElement.html(template);
                        // Write the data to the cache
                        $.jStorage.set(cacheName, data, {TTL: cacheTTL});
                    }
                });
            }
        }
    });
});
