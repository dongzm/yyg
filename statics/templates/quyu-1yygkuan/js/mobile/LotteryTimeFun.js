$.fn.StartTimeOut = function(t, h) {
    var s = $(this);
    var a = new Date();
    a.setSeconds(a.getSeconds() + h);
    var m = 0;
    var p = 0;
    var o = 0;
    var l = function() {
        var v = new Date();
        if (a > v) {
            var w = parseInt((a.getTime() - v.getTime()) / 1000);
            var u = w % 60;
            m = parseInt(w / 60);
            p = parseInt(u);
            if (u >= p) {
                o = parseInt((u - p) * 10)
            } else {
                o = 0
            }
            setTimeout(l, 3000)
        }
    };
    var g = s.find("em");
    var b = g.eq(0);
    var k = g.eq(1);
    var d = g.eq(2);
    var r = g.eq(3);
    var f = 9;
    var n = function() {
        f--;
        if (f < 0) {
            f = 9
        }
        r.html(f);
        setTimeout(n, 10)
    };
    var c = function() {
        r.html("0");
        s.find("p[name='pTime']").html("正在计算,请稍后...");
        var v = null;
        var u = function() {
            GetJPData("http://dataserver.1yyg.com", "GetBarcodernoInfo", "codeID=" + t,
            function(w) {
                if (w.code == 0) {
                    var x = "";
                    if (w.codeType == 1) {
                        x = '<span class="z-limit-tips">限时揭晓</span>'
                    }
                    s.removeClass("rNow").removeClass("rFirst").html('<a href="/lottery/detail-' + t + '.html"></a><li class="revConL">' + x + '<img src="http://mimg.1yyg.com/goodspic/pic-200-200/' + w.goodsPic + '"></li><li class="revConR"><dl><dd><img src="http://faceimg.1yyg.com/UserFace/' + w.userPhoto + '"></dd><dd>获得者：<em class="blue">' + w.userName + '</em><br>购买：<em class="orange arial">' + w.buyCount + '</em>人次</dd></dl><dt>幸运码：<em class="orange arial">' + w.codeRNO + '</em><br>揭晓时间：<em class="c9 arial">' + w.codeRTime + '</em></dt><b class="fr z-arrow"></b></li>');
                    if (v != null) {
                        clearInterval(v);
                        v = null
                    }
                }
            })
        };
        v = setInterval(u, 2000)
    };
    var j = function() {
        o--;
        if (o < 1) {
            if (p < 1) {
                if (m < 1) {
                    c();
                    return
                } else {
                    m--
                }
                p = 59
            } else {
                p--
            }
            o = 9
        }
        setTimeout(j, 100)
    };
    var e = 0,
    q = 0;
    var i = function() {
        d.html(o);
        if (e != p) {
            if (p < 10) {
                k.html("0" + p)
            } else {
                k.html(p)
            }
            e = p
        }
        if (q != m) {
            if (m < 10) {
                b.html("0" + m)
            } else {
                b.html("00")
            }
            q = m
        }
        setTimeout(i, 100)
    };
    l();
    j();
    n();
    i()
};