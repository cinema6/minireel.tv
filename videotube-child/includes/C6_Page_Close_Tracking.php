<?php
    // Script tag to be inserted in wp_head via:
    // add_action( 'wp_head', 'insert_tracking_code', 999 );
    // The Google Analytics plugin that inserts the window.__gaTracker dependency (Yoast),
    // loads with priority 8, so we're using 999
?>

<script>
    window._mrtvInitTime = (new Date()).getTime();
    window.onbeforeunload = function() {
        var img = new Image();
        var timestamp = new Date().getTime();
        var timeOnPage = timestamp - window._mrtvInitTime;
        img.src = 'http://portal.cinema6.com/collateral/etc/tracking/1x1-pixel.gif?' + toQueryParams({
            cb: timestamp,
            ct: 'Close',
            lb: timeOnPage,
            sc: 'mrtv'
        });
        window.__gaTracker('send', 'timing', {
            'timingCategory' : 'API',
            'timingVar'      : 'closePage',
            'timingValue'    : timeOnPage,
            'timingLabel'    : 'c6'
        });
    };

    function toQueryParams(object) {
        return Object.keys(object)
            .filter(function(key) {
                return object[key] !== undefined;
            })
            .map(function(key) {
                return [key, object[key]]
                    .map(encodeURIComponent)
                    .join('=');
            })
            .join('&');
    }
</script>