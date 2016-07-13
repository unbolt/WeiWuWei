$(function(){

    // Do the raid progress circles
    $(".raid-progress-circle").each(function() {
        // Do some calculations
        var bosses = $(this).attr('data-bosses');
        var kills = $(this).attr('data-kills');

        // Work out what percentage of bosses are killed
        var percentage = (kills / bosses);

        $(this).circleProgress({
            startAngle: -Math.PI / 2,
            value: percentage,
            thickness: 15,
            size: 120,
            fill: {
                color: '#468C58'
            }
        });
    });

    // Do the "read more" buttons
    $(".news-article .btn").click(function() {

        totalHeight = 0

        $el = $(this);
        $p  = $el.parent();
        $up = $p.parent();
        $ps = $up.find(":not('.read-more')");

        // measure how tall inside should be by adding together heights of all inside paragraphs (except read-more paragraph)
        $ps.each(function() {
            totalHeight += $(this).outerHeight();
        });

        $up
        .css({
          // Set height to prevent instant jumpdown when max height is removed
          "height": $up.height(),
          "max-height": 9999
        })
        .animate({
          "height": totalHeight
        });

        // fade out read-more
        $p.fadeOut();

        // prevent jump-down
        return false;

    });
});
