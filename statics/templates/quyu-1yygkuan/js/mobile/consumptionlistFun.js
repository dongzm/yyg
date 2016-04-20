$(function() {
    var a = function() {	 
        var l = $("#ulRechage");
        var i = $("#ulConsumption");
        var d = $("#divLoad");
        var c = $("#btnLoadMore");
        var b = $("#btnRecharge");
        var f = $("#btnConsumption");
        var u = false;
        var o = false;
        var g = 10;
        var h = null;
        var e = null;
        var m = 0;
        var p = false;
        var n = false;
        var k = false;
        var j = $("#loadDataType").val() === "1";
        var r = function() {
            var x = 0;
            var v = {
                FIdx: 0,
                EIdx: g,
                isCount: 1
            };
            var w = function() {
                return "/" + v.FIdx + "/" + v.EIdx + "/" + v.isCount
            };
            var y = function() {
                d.show();				 
               // GetJPData("http://m.1yyg.com", "getUserRecharge", w(),
				 GetJPData(Gobal.Webpath, "shopajax", "getUserRecharge"+w(),
                function(D) {
                    if (D.code == 0) {
                        var B = "";
                        if (v.isCount == 1) {
                            x = D.count;
                            v.isCount = 0;
                            B = '<li class="m-userMoneylst-tt"><span>充值时间</span><span>充值金额</span><span>充值渠道</span></li>'
                        }
                        var C = D.listItems;
                        var A = C.length;
                        for (var z = 0; z < A; z++) {
                            B += '<li class="' + (z + 1 == A ? "bornone": "") + '"><span>' + C[z].time + "</span><span>￥" + C[z].money + "</span><span>" + C[z].content + "</span></li>"
                        }
                        if (v.FIdx > 0) {
                            l.children("li").last().removeClass("bornone")
                        }
                        l.append(B);
                        if (v.EIdx < x) {
                            c.show()
                        } else {
                            n = true;
                            c.hide()
                        }
                    } else {
                        if (D.code == 10) {
                            location.reload()
                        } else {
                            if (v.FIdx == 0) {
                                n = true;
                                l.append(Gobal.NoneHtml);
                                c.hide()
                            }
                        }
                    }
                    d.hide();
                    u = true;
                    p = false
                })
            };
            this.initPage = function() {
                y()
            };
            this.getNextPage = function() {
                v.FIdx += g;
                v.EIdx += g;
                y()
            }
        };
        var t = function() {
            var x = 0;
            var v = {
                FIdx: 0,
                EIdx: g,
                isCount: 1
            };
            var w = function() {
                return "/" + v.FIdx + "/" + v.EIdx + "/" + v.isCount
            };
            var y = function() {
                d.show();				
                GetJPData(Gobal.Webpath, "shopajax", "getUserConsumption"+w(),
                function(D) {
                    if (D.code == 0) {
                        var B = "";
                        if (v.isCount == 1) {
                            v.isCount = 0;
                            x = D.count;							 
                            B = '<li class="m-userMoneylst-tt"><span>消费时间</span><span>消费金额</span></li>'
                        }
                        var C = D.listItems;
                        var A = C.length;
                        for (var z = 0; z < A; z++) {
                            B += '<li class="' + (z + 1 == A ? "bornone": "") + '"><span>' + C[z].time + "</span><span>￥" + C[z].money + "</span></li>"
                        }
                        if (v.FIdx > 0) {
                            i.children("li").last().removeClass("bornone")
                        }
                        i.append(B);						 
                        if (v.EIdx < x) {
                            c.show()
                        } else {
                            k = true;
                            c.hide()
                        }
                    } else {
                        if (D.code == 10) {
                            location.reload()
                        } else {
                            if (v.FIdx == 0) {
                                i.append(Gobal.NoneHtml);
                                k = true;
                                c.hide()
                            }
                        }
                    }
                    d.hide();
                    o = true;
                    p = false
                })
            };
            this.initPage = function() {
                y()
            };
            this.getNextPage = function() {
			  
                v.FIdx += g;
                v.EIdx += g;				 
                y()
            }
        };
        h = new r();
        e = new t();
        var q = function() {
            m = 0;
            b.removeClass("z-MoneyNav-crt02");
            f.addClass("z-MoneyNav-crt01");
            l.hide();
            i.show();
            if (!k) {
                c.show()
            } else {
                c.hide()
            }
            if (!o) {
                e.initPage()
            }
        };
        var s = function() {
            m = 1;
            b.addClass("z-MoneyNav-crt02");
            f.removeClass("z-MoneyNav-crt01");
            l.show();
            i.hide();
            if (!n) {
                c.show()
            } else {
                c.hide()
            }
            if (!u) {
                h.initPage()
            }
        };
        if (j) {
            s()
        } else {
            q()
        }
        f.click(q);
        b.click(s);
        c.click(function() {
            if (!p) {
                p = true;
                c.hide();
                if (m == 1) {
                    h.getNextPage()
                } else {
                    e.getNextPage()
                }
            }
        })
    };
    Base.getScript(Gobal.Skin + "/js/mobile/Comm.js", a)
});