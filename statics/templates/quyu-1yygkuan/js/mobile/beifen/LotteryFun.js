$(function() {
    var h = null;
    var f = 10;
    var a = 0;
    var j = {
        FIdx: 1,
        EIdx: f,
        isCount: 1
    };
    var d = $("#divLotteryLoading");
    var l = $("#btnLoadMore");
    var m = false;
    var c = function(o) {
        if (o && o.stopPropagation) {
            o.stopPropagation()
        } else {
            window.event.cancelBubble = true
        }
    };
    var b = function() {
        var o = function() {
            return "FIdx=" + j.FIdx + "&EIdx=" + j.EIdx + "&isCount=" + j.isCount
        };
        var p = function() {
            d.show();
            GetJPData("http://m.1yyg.com", "getLotteryList", o(),
            function(s) {			 
                if (s.code == 0) {
                    if (j.isCount == 1) {
                        a = s.count
                    }
                    var r = s.listItems;
                    var t = r.length;
                    for (var q = 0; q < t; q++) {
                        var v = '<ul id="' + r[q].codeID + '"><li class="revConL">' + (r[q].codeType == 1 ? '<span class="z-limit-tips">限时揭晓</span>': "") + '<img src="' + Gobal.LoadPic + '" src2="http://mimg.1yyg.com/goodspic/pic-200-200/' + r[q].codeGoodsPic + '"></li><li class="revConR"><dl><dd><img name="uImg" uweb="' + r[q].userWeb + '" src="http://faceimg.1yyg.com/UserFace/' + r[q].userPhoto + '"></dd><dd><span>获得者<strong>：</strong><a name="uName" uweb="' + r[q].userWeb + '" class="rUserName blue">' + r[q].userName + '</a></span>本期云购<strong>：</strong><em class="orange arial">' + r[q].codeRUserBuyCount + '</em>人次</dd></dl><dt>幸运云购码：<em class="orange arial">' + r[q].codeRNO + '</em><br/>揭晓时间：<em class="c9 arial">' + r[q].codeRTime + '</em></dt><b class="fr z-arrow"></b></li></ul>';
                        var u = $(v);
                        u.click(function() {
                            location.href = "/lottery/detail-" + $(this).attr("id") + ".html"
                        }).find('img[name="uImg"]').click(function(w) {
                            location.href = "/userpage/" + $(this).attr("uweb");
                            c(w)
                        });
                        u.find('a[name="uName"]').click(function(w) {
                            location.href = "/userpage/" + $(this).attr("uweb");
                            c(w)
                        });
                        d.before(u)
                    }
                    if (j.EIdx < a) {
                        m = false;
                        l.show()
                    }
                    loadImgFun()
                }
                d.hide()
            })
        };
        this.getInitPage = function() {
            p()
        };
        this.getNextPage = function() {
            j.FIdx += f;
            j.EIdx += f;
            p()
        }
    };
    l.click(function() {
        if (!m) {
            m = true;
            l.hide();
            h.getNextPage()
        }
    });
    h = new b();
    h.getInitPage();
    var e = ",";
    var n = false;
    var g = 0;
    var i = $("#divLottery");
    var k = function() {
        GetJPData("http://api.1yyg.com", "GetStartRaffleAllList", "time=" + g,
        function(p) {
            if (p.errorCode == 0) {
                o(p)
            }
            setTimeout(k, 5000)
        });
        var o = function(q) {
            g = q.maxSeconds;
            var p = function(t) {
                for (var r = t.length - 1; r > -1; r--) {
                    var s = t[r];
                    if (e.indexOf("," + s.codeID + ",") < 0) {
                        e += s.codeID + ",";
                        var u = $('<ul class="rNow rFirst" id="' + s.codeID + '"><li class="revConL"><img src="http://mimg.1yyg.com/goodspic/pic-200-200/' + s.goodsPic + '"></li><li class="revConR"><h4>(第' + s.period + "期)" + s.goodsSName + "</h4><h5>价值：￥" + CastMoney(s.price) + '</h5><p name="pTime"><s></s>揭晓倒计时 <strong><em>00</em> : <em>00</em> : <em>0</em><em>0</em></strong></p><b class="fr z-arrow"></b></li><div class="rNowTitle">正在揭晓</div></ul>');
                        u.click(function() {
                            location.href = "/product/" + $(this).attr("id") + ".html"
                        });
                        i.prepend(u);
                        u.next().removeClass("rFirst");
                        u.StartTimeOut(s.codeID, parseInt(s.seconds))
                    }
                }
            };
            if (n) {
                p(q.listItems)
            } else {
                Base.getScript(Gobal.Skin + "/DataServer/JS/LotteryTimeFun.js?v=130826",
                function() {
                    n = true;
                    p(q.listItems)
                })
            }
        }
    };
    Base.getScript(Gobal.Skin + "/JS/comm.js?v=130826", k)
});