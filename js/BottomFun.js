var mainHttp = "http://123.biyour.com"; (function() {
    if (window.self != window.top) {
        var b = mainHttp;
        if (typeof(window.location) == "object") {
            b = window.location.href
        }
        var a = $("<form name='toTopUrl' method='get' action='" + b + "' target='_top'></form>");
        a.appendTo("body").ready(function() {
            a.submit()
        })
    }
})();
function GetJPData(d, c, a, b) {
    $.getJSON("/?/api/ajaxcount/buy_count/fun=?", b)
}
var loadImgFun = function() {
    var e = "src2";
    var b = $("#loadingPicBlock");
    if (b.length > 0) {
        var c = b.find("img");
        var d = function() {
            return Math.max(document.documentElement.scrollTop, document.body.scrollTop)
        };
        var a = function() {
            return document.documentElement.clientHeight + d() + 100
        };
        var f = d();
        var g = f;
        var h = function() {
            c.each(function() {
                if ($(this).parent().offset().top <= a()) {
                    var i = $(this).attr(e);
                    if (i) {
                        $(this).attr("src", i).removeAttr(e).show()
                    }
                }
            })
        };
        $(window).bind("scroll",
        function() {
            g = d();
            if (g - f > 50) {
                f = g;
                h()
            }
        });
        h()
    }
};
var _IsCartChanged = true;
var _IsBuySubmiting = false;
var _InsertIntoCart = function() {}; (function() {
    var L = mainHttp;
    var r = "http://api.1yyg.com";
    var c = function() {
        if ($.browser.msie && $(window).width() < 1190) {
            if (parseInt($.browser.version) < 9) {
                $("body").addClass("f-width-change")
            } else {
                $("body").removeClass("f-width-change")
            }
        } else {
            $("body").removeClass("f-width-change")
        }
    };
    var b = $("#ulHTotalBuy");
    var i = $("#spFundTotal");
    var S = 0;
    var ai = 2000;
    var f = function() {
        GetJPData(r, "totalBuyCount", "",
        function(aw) {
            if (aw.state == 0) {
                i.html("гд" + aw.fundTotal);
                if (S != aw.count) {
                    if (S == 0) {
                        S = aw.count;
                        b.children("li.num").each(function() {
                            var ay = '<cite style="top:24px;">';
                            for (var az = 9; az >= 0; az--) {
                                ay += '<em t="' + az + '">' + az + "</em>"
                            }
                            ay += "</cite><i></i>";
                            $(this).html(ay)
                        });
                        var at = aw.count.toString();
                        var av = at.length;
                        var au = at.split("");
                        b.find("cite").each(function(aB, ay) {
                            var aA = $(this);
                            var az = parseInt(au[aB]);
                            aA.animate({
                                top: "-" + (27 * (9 - az)) + "px"
                            },
                            {
                                queue: false,
                                duration: ai,
                                complete: function() {}
                            })
                        })
                    } else {
                        var ax = S.toString().split("");
                        var ar = aw.count.toString().split("");
                        S = aw.count;
                        b.find("cite").each(function(aD, aA) {
                            var aE = 0;
                            var aC = parseInt(ax[aD]);
                            if (ax[aD] <= ar[aD]) {
                                aE = parseInt(ar[aD]) - parseInt(ax[aD])
                            } else {
                                aE = 10 + parseInt(ar[aD]) - parseInt(ax[aD])
                            }
                            if (aE != 0) {
                                var aF = $(this).children('em[t="' + aC + '"]');
                                var az = aF.nextAll();
                                for (var aB = az.length - 1; aB > -1; aB--) {
                                    $(this).prepend($(az[aB]))
                                }
                                var ay = -(243 - aE * 27);
                                $(this).css({
                                    top: "24px"
                                }).animate({
                                    top: ay
                                },
                                {
                                    queue: false,
                                    duration: ai,
                                    complete: function() {}
                                })
                            }
                        })
                    }
                }
            }
        });
        setTimeout(f, 5000)
    };
    if (b.length > 0 || i.length > 0) {
        f()
    }
    var A = $("#ulRToolList");
    var o = A.children("li.f-cart");
    var ac = o.children("a").find("em");
    var ab = $("#divCartBox");
    A.children("li.f-top").click(function() {
        $("body,html").animate({
            scrollTop: 0
        },
        0);
        return false
    })
})();