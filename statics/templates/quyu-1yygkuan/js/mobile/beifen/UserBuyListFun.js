$(function() {
    var d = 10;
    var g = {
        FIdx: 1,
        EIdx: d,
        isCount: 1,
        state: -1
    };
    var a = 0;
    var f = null;
    var e = $("#divGoodsLoading");
    var h = $("#btnLoadMore");
    var i = false;
    var b = false;
    var c = function() {
        var j = function() {
            return "FIdx=" + g.FIdx + "&EIdx=" + g.EIdx + "&isCount=" + g.isCount + "&state=" + g.state
        };
        var k = function() {
            e.show();
            GetJPData("http://m.1yyg.com", "getUserBuyList", j(),
            function(q) {
                if (q.code == 0) {
                    var n = q.listItems;
                    if (g.isCount == 1) {
                        a = q.count;
                        g.isCount = 0
                    }
                    var r = n.length;
                    var o = "";
                    var s = 0;
                    var t = 0;
                    var l = 0;
                    var u = 0;
                    for (var p = 0; p < r; p++) {
                        var m = parseInt(n[p].codeState);
                        o += "<li onclick=\"location.href='goodsbuyDetail-" + n[p].codeID + '.html\'"><a class="fl z-Limg">';
                        if (m == 1) {
                            o += '<span class="z-Imgbg z-ImgbgC01"></span><em class="z-Imgtxt">进行中...</em>'
                        } else {
                            if (m == 2) {
                                o += '<span class="z-Imgbg z-ImgbgC01"></span><em class="z-Imgtxt">已满员</em>'
                            } else {
                                if (m == 3) {
                                    o += '<span class="z-Imgbg z-ImgbgC02"></span><em class="z-Imgtxt">已揭晓</em>'
                                }
                            }
                        }
                        o += '<img src="' + Gobal.LoadPic + '" src2="http://mimg.1yyg.com/GoodsPic/pic-200-200/' + n[p].goodsPic + '" border=0 alt=""></a><div class="u-sgl-r gray9"><p class="z-sgl-tt"><a class="gray6">(第' + n[p].codePeriod + "期)" + n[p].goodsName + "</a></p>";
                        if (m == 1 || m == 2) {
                            s = parseInt(n[p].codeSales);
                            t = parseInt(n[p].codeQuantity);
                            l = parseInt(t - s);
                            u = parseInt(s * 100) / t;
                            u = s > 0 && u < 1 ? 1 : u;
                            o += '<p>已参与<em class="orange">' + n[p].buyNum + '</em>人次</p><div class="Progress-bar"><p class="u-progress">' + (s > 0 ? '<span style="width:' + u + '%;" class="pgbar"><span class="pging"></span></span>': "") + '</p><ul class="Pro-bar-li"><li class="P-bar01"><em>' + s + '</em>已参与</li><li class="P-bar02"><em>' + t + '</em>总需人次</li><li class="P-bar03"><em>' + l + "</em>剩余</li></ul></div>"
                        } else {
                            if (m == 3) {
                                o += '<p>获得者：<em class="blue">' + n[p].userName + '</em></p><p>揭晓时间：<em class="gray6">' + n[p].codeRTime + "</em></p>"
                            }
                        }
                        o += '</div><b class="z-arrow"></b></li>'
                    }
                    if (g.FIdx > 1) {
                        e.prev().removeClass("bornone")
                    }
                    e.before(o).prev().addClass("bornone");
                    if (g.EIdx < a) {
                        i = false;
                        h.show()
                    }
                    loadImgFun(0)
                } else {
                    if (g.FIdx == 1) {
                        if (g.state == -1) {
                            b = true
                        }
                        e.before(Gobal.NoneHtml)
                    }
                }
                e.hide()
            })
        };
        this.getInitPage = function() {
            g.FIdx = 1;
            g.EIdx = d;
            g.isCount = 1;
            k()
        };
        this.getNextPage = function() {
            g.FIdx += d;
            g.EIdx += d;
            k()
        }
    };
    $("#navBox").children("div").each(function() {
        var j = $(this);
        j.click(function() {
            g.state = j.attr("state");
            j.addClass("z-sgl-crt").siblings().removeClass("z-sgl-crt");
            if (!b) {
                h.hide();
                e.prevAll().remove();
                f.getInitPage()
            }
        })
    });
    h.click(function() {
        if (!i) {
            i = true;
            h.hide();
            f.getNextPage()
        }
    });
    f = new c();
    f.getInitPage()
});