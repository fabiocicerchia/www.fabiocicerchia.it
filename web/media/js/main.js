/**
 * FABIO CICERCHIA - WEBSITE
 *
 * Copyright 2012 Fabio Cicerchia.
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
 * Copyright:  2012 Fabio Cicerchia.
 * License:    MIT <http://www.opensource.org/licenses/MIT>
 * Link:       http://www.fabiocicerchia.it
 */

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