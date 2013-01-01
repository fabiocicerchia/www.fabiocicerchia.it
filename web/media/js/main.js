/**
 * FABIO CICERCHIA - WEBSITE
 *
 * Copyright 2012 - 2013 Fabio Cicerchia.
 *
 * Permission is hereby granted, free of  charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction,  including without limitation the rights
 * to use,  copy, modify,  merge, publish,  distribute, sublicense,  and/or sell
 * copies  of the  Software,  and to  permit  persons to  whom  the Software  is
 * furnished to do so, subject to the following conditions:
 *
 * The above  copyright notice and this  permission notice shall be  included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE  IS PROVIDED "AS IS",  WITHOUT WARRANTY OF ANY  KIND, EXPRESS OR
 * IMPLIED,  INCLUDING BUT  NOT LIMITED  TO THE  WARRANTIES OF  MERCHANTABILITY,
 * FITNESS FOR A  PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO  EVENT SHALL THE
 * AUTHORS  OR COPYRIGHT  HOLDERS  BE LIABLE  FOR ANY  CLAIM,  DAMAGES OR  OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * Javascript
 *
 * Category:   Code
 * Package:    Site
 * Subpackage: Javascript
 * Author:     Fabio Cicerchia <info@fabiocicerchia.it>
 * Copyright:  2012 - 2013 Fabio Cicerchia.
 * License:    MIT <http://www.opensource.org/licenses/MIT>
 * Link:       http://www.fabiocicerchia.it
 */

function onLinkedInLoad() {
    // IN.User.logout(); // Used to reset the session...
    IN.Event.on(IN, "auth", onLinkedInAuth);
}

function onLinkedInAuth() {
    IN.API.Connections("me").fields("id", "pictureUrl", "public-profile-url").result(function(result) {
        url_connections = {};
        for (idx in result.values) {
            key = result.values[idx].id;
            url_connections[key] = {};
            url_connections[key]['photo'] = result.values[idx].pictureUrl;
            url_connections[key]['url'] = result.values[idx].publicProfileUrl;
        }

        IN.API.Raw('/people/~:(recommendations-received)').method('GET').result(function(result) {
            handleRecommendations(result);
        });
    });
}

function handleRecommendations(result) {
    recommendations = result.recommendationsReceived.values;

    jQuery('#reference_list').html('');

    for (idx in recommendations) {
        recommendation = recommendations[idx];
        user = url_connections[recommendation.recommender.id];

        elem_div = jQuery('<div></div>');
        elem_blockquote = jQuery('<blockquote></blockquote>');
        elem_blockquote.html(recommendation.recommendationText);
        elem_small = jQuery('<small></small>');
        recommender = recommendation.recommender.firstName + ' ' + recommendation.recommender.lastName;
        elem_small.html('by <a href="' + user.url + '" target="_blank">' + recommender + '</a>, as ' + recommendation.recommendationType.code + '.');
        elem_div.append(elem_blockquote);
        elem_div.append('<img src="' + user.photo + '" />');
        elem_div.append(elem_small);
        jQuery('#reference_list').append(elem_div);
    }
}

jQuery(document).ready(function() {
    // -------------------------------------------------------------------------
    // Navigation bar scrolling ------------------------------------------------
    // -------------------------------------------------------------------------
    var $win = jQuery(window)
        , $nav = jQuery('.subnav')
        , navHeight = jQuery('.navbar').first().height()
        , navTop = jQuery('.subnav').length && jQuery('.subnav').offset().top - navHeight
        , isFixed = 0;

    processScroll();

    $win.on('scroll', processScroll);

    function processScroll() {
        var i, scrollTop = $win.scrollTop();

        if (scrollTop >= navTop && !isFixed) {
            isFixed = 1;
            $nav.addClass('subnav-fixed');
        } else if (scrollTop <= navTop && isFixed) {
            isFixed = 0;
            $nav.removeClass('subnav-fixed');
        }
    }

    iframeMapHeight = jQuery(window).innerHeight() - jQuery('.navbar').outerHeight() - jQuery('h2').outerHeight() - parseInt(jQuery('h2').css('padding-top')) - jQuery('h3').outerHeight() - jQuery('footer').outerHeight() - parseInt(jQuery('footer').css('margin-top'));
    jQuery('#iframe_map').css('height', iframeMapHeight + 'px');
    jQuery(window).resize(function() {
        iframeMapHeight = jQuery(window).innerHeight() - jQuery('.navbar').outerHeight() - jQuery('h2').outerHeight() - parseInt(jQuery('h2').css('padding-top')) - jQuery('h3').outerHeight() - jQuery('footer').outerHeight() - parseInt(jQuery('footer').css('margin-top'));
        jQuery('#iframe_map').css('height', iframeMapHeight + 'px');
    });

    // -------------------------------------------------------------------------
    // Show more behaviour -----------------------------------------------------
    // -------------------------------------------------------------------------
    jQuery('a.show_hide').click(function(e) {
        e.preventDefault();
        jQuery(this).hide();
        jQuery(this).parents('div.vevent').find('div.hide').show();
    });

    // -------------------------------------------------------------------------
    // Awesome Cloud -----------------------------------------------------------
    // -------------------------------------------------------------------------
    tagCloudMaxWeight = 0;
    maxFontSize       = 35;
    minFontSize       = 8;

    differenceFont = maxFontSize - minFontSize;

    jQuery('#wordcloud span[data-weight]').each(function() {
        elemWeight        = parseInt(jQuery(this).attr('data-weight'));
        tagCloudMaxWeight = elemWeight > tagCloudMaxWeight
                            ? elemWeight
                            : tagCloudMaxWeight;
    });

    jQuery('#wordcloud span[data-weight]').each(function() {
        elemWeight = parseInt(jQuery(this).attr('data-weight'));
        percentage  = 100 / tagCloudMaxWeight * elemWeight;
        fontSize    = minFontSize + Math.round(differenceFont / 100 * percentage);
        jQuery(this).css('font-size', fontSize + 'px');
    });
});
