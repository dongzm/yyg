$(function() {
    var h = null;
    var f = 10;
    var a = 0;
    var j = {
        FIdx: 0,
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
            return "/" + j.FIdx + "/" + j.EIdx + "/" + j.isCount
        };
		 
        var p = function() {
            d.show();
            GetJPData(Gobal.Webpath, "ajax", "getLotteryList"+o(),
            function(s) {			 
                if (s.code == 0) {
                    if (j.isCount == 1) {
                        a = s.count						
                    }
                    var r = s.listItems;
                    var t = r.length;
                    for (var q = 0; q < t; q++) {
                        var v = '<ul id="' + r[q].id + '"><li class="revConL">' + (r[q].codeType == 1 ? '<span class="z-limit-tips">限时揭晓</span>': "") + '<img src="' + Gobal.LoadPic + '" src2="'+Gobal.imgpath+'/uploads/' + r[q].thumb + '"></li><li class="revConR"><dl><dd><img name="uImg" uweb="' + r[q].q_uid + '" src="'+Gobal.imgpath+'/uploads/' + r[q].userphoto + '"></dd><dd><span>获得者<strong>：</strong><a name="uName" uweb="' + r[q].q_uid + '" class="rUserName blue">' + r[q].q_user + '</a></span>本期购买<strong>：</strong><em class="orange arial">' + r[q].gonumber + '</em>人次</dd></dl><dt>幸运码：<em class="orange arial">' + r[q].q_user_code + '</em><br/>揭晓时间：<em class="c9 arial">' + r[q].q_end_time + '</em></dt><b class="fr z-arrow"></b></li></ul>';
                        var u = $(v);
                        u.click(function() {
                            location.href = Gobal.Webpath+"/mobile/mobile/item/" + $(this).attr("id")
                        }).find('img[name="uImg"]').click(function(w) {
                            location.href = Gobal.Webpath+"/mobile/mobile/userindex/" + $(this).attr("uweb");
                            c(w)
                        });
                        u.find('a[name="uName"]').click(function(w) {
                            location.href = Gobal.Webpath+"/mobile/mobile/userindex/" + $(this).attr("uweb");
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
        GetJPData(Gobal.Webpath, "ajax", "GetStartRaffleAllList/" + g,
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
                Base.getScript(Gobal.Skin + "/js/mobile/LotteryTimeFun.js",
                function() {
                    n = true;
                    p(q.listItems)
                })
            }
        }
    };
    Base.getScript(Gobal.Skin + "/js/mobile/comm.js", k)
});