$.fn.StartTimeOut = function(b) {
    var a = $(this);
    GetJPData("http://dataserver.1yyg.com", "GetCodeLotteryTimeOut", "codeid=" + b,
    function(v) {
        var i = v.Code;
        var k = v.Seconds;
        if (i == 0) {
            var c = new Date();
            c.setSeconds(c.getSeconds() + k);
            var p = 0;
            var s = 0;
            var r = 0;
            var o = function() {
                var x = new Date();
                if (c > x) {
                    var y = parseInt((c.getTime() - x.getTime()) / 1000);
                    var w = y % 60;
                    p = parseInt(y / 60);
                    s = parseInt(w);
                    if (w >= s) {
                        r = parseInt((w - s) * 10)
                    } else {
                        r = 0
                    }
                    setTimeout(o, 3000)
                }
            };
            var j = a.find("b");
            var d = j.eq(0);
            var n = j.eq(1);
            var f = j.eq(2);
            var u = j.eq(3);
            var h = 9;
            var q = function() {
                h--;
                if (h < 0) {
                    h = 9
                }
                u.html(h);
                setTimeout(q, 10)
            };
            var e = function() {
                u.html("0");
                a.removeClass("clearfix").html('<div class="pCalculation"><h4>表着急！计算机正在努力计算中……</h4><div class="loading-progress"><span class="loading-pgbar"><span class="loading-pging"></span></span></div></div>');
                var x = null;
                var w = function() {
                    GetJPData("http://dataserver.1yyg.com", "getCodeState", "codeID=" + b,
                    function(y) {
                        if (y.Code == 0 && y.State == 3) {
                            location.replace("http://m.1yyg.com/Lottery/detail-" + b + ".html")
                        }
                    })
                };
                x = setInterval(w, 2000)
            };
            var m = function() {
                r--;
                if (r < 1) {
                    if (s < 1) {
                        if (p < 1) {
                            e();
                            return
                        } else {
                            p--
                        }
                        s = 59
                    } else {
                        s--
                    }
                    r = 9
                }
                setTimeout(m, 100)
            };
            var g = 0,
            t = 0;
            var l = function() {
                f.html(r);
                if (g != s) {
                    if (s < 10) {
                        n.html("0" + s)
                    } else {
                        n.html(s)
                    }
                    g = s
                }
                if (t != p) {
                    if (p < 10) {
                        d.html("0" + p)
                    } else {
                        d.html("00")
                    }
                    t = p
                }
                setTimeout(l, 100)
            };
            o();
            m();
            q();
            l()
        }
    })
};