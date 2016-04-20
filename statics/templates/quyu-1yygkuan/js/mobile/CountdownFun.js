$.fn.countdowntime = function(j, n) {
    var p = $(this);
    var d = new Date();
    d.setSeconds(d.getSeconds() + j);
    var h = 0;
    var g = 0;
    var e = 0;
    var l = function() {
        var r = new Date();
        if (d > r) {
            var s = parseInt((d.getTime() - r.getTime()) / 1000);
            var q = s % 60;
            h = parseInt(s / 3600);
            g = parseInt(s / 60) - h * 60;
            e = parseInt(q);
            setTimeout(l, 5000)
        }
    };
    var k = p.find("em");
    var b = k.eq(0);
    var o = k.eq(1);
    var c = k.eq(2);
    var m = function() {
        if (e < 1) {
            if (g < 1) {
                if (h < 1) {
                    setTimeout(n, 1000);
                    return
                } else {
                    h--
                }
                g = 59
            } else {
                g--
            }
            e = 59
        } else {
            e--
        }
        setTimeout(m, 1000)
    };
    var f = 0,
    a = 0;
    var i = function() {
        if (e < 10) {
            c.html("0" + e)
        } else {
            c.html(e)
        }
        if (f != g) {
            if (g < 10) {
                o.html("0" + g)
            } else {
                o.html(g)
            }
            f = g
        }
        if (a != h) {
            if (h < 10) {
                b.html("0" + h)
            } else {
                b.html(h)
            }
            a = h
        }
        setTimeout(i, 1000)
    };
    l();
    m();
    i()
};