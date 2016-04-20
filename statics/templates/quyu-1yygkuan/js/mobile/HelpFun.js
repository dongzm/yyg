$(function() {
    var a = [0, 0, 0, 0];
    $("div.helpInfo").each(function(b) {
        var d = $(this);
        a[b] = d.offset().top;
        var c = d.children().eq(0);
        var e = d.children().eq(1);
        c.click(function() {
            var f = c.find("i");
            if (f.hasClass("iOpen")) {
                c.removeClass("hShadow");
                f.removeClass("iOpen").addClass("iCollapse");
                e.hide();
                if (b == 3) {
                    c.css("border-bottom", "0 none")
                }
            } else {
                c.addClass("hShadow");
                if (b == 3) {
                    c.css("border-bottom", "")
                }
                f.removeClass("iCollapse").addClass("iOpen");
                e.show();
                d.siblings().each(function() {
                    var g = $(this);
                    g.children().eq(0).addClass("hShadow").find("i").removeClass("iOpen").addClass("iCollapse");
                    g.children().eq(1).hide()
                });
                $("body,html").animate({
                    scrollTop: a[b]
                },
                0)
            }
        })
    });
    $("#dd1").show()
});