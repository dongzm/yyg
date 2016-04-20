$(function() {
    var f = $("#hidGoodsID").val();
    var p = $("#hidCodeID").val();
    var m = $("#hidShowTime").val() == "1";
    if (m) {
        $("#divPic").addClass("pPicBor");
        Base.getScript(Gobal.Skin + "/js/mobile/GoodsTimeFun.js",
        function() {
            $("#divLotteryTime").StartTimeOut(p)
        })
    } else {
        var d = function(q) {
            $.PageDialog.fail(q)
        };
        var h = function(q) {
            $.PageDialog.ok("<s></s>" + q)
        };
        var l = function(r) {
		//alert(p)
		    GetJPData(Gobal.Webpath, "ajax", "addShopCart/" + p + "/" + 1,           
            function(s) {
                if (s.code == 0) {
                    if (r == 0) {
                        addNumToCartFun(s.num);
                        h("添加成功")
                    } else {
                        location.href = Gobal.Webpath+"/mobile/cart/cartlist"
                    }
                } else {
                    if (r == 0) {
                        d("添加失败")
                    } else {
                        d("添加失败，请重试")
                    }
                }
            })
        };
        var i = function() {
            var q = $("#btnBuyBox");
            q.children("a").eq(0).click(function() {
                l(1)
            });
            q.children("a").eq(1).click(function() {
                l(0)
            })
        };
        Base.getScript(Gobal.Skin + "/js/mobile/pageDialog.js", i);
        var g = $("#divAutoRTime");
        if (g.length > 0) {
            var o = g.attr("time");
            if (o) {
                var e = parseInt(o);
                g.html("<p><span>限时揭晓</span>剩余时间：<em>00</em>时<em>00</em>分<em>00</em>秒</p>");
                var k = function() {
                     //将页面换成已经揭晓的页面
					//window.location.replace(Gobal.Webpath+"mobile/mobile/item/"+p)
					
					//location.href =Gobal.Webpath+"mobile/mobile/item/"+p
                };
                Base.getScript(Gobal.Skin + "/js/mobile/CountdownFun.js",
                function() {
                    g.countdowntime(e, k)
                });
				//获取当前商品
                var n = function() {				
				    GetJPData(Gobal.Webpath, "ajax", "getCodeState/" + p ,                   
                    function(q) {
                        if (q.Code == 0) {
                            k()
                        }
                    })
                };
                setInterval(n, 30000)
            } else {
                var j = g.attr("timeAlt").split("-");
                g.html("<p><span>限时揭晓</span>揭晓时间：<em>" + j[0] + "</em>月<em>" + j[1] + "</em>日<em>" + j[2] + "</em>点</p>")
            }
        }
        var c = function(q) {
            if (q && q.stopPropagation) {
                q.stopPropagation()
            } else {
                window.event.cancelBubble = true
            }
        };
        var b = $("#prevPeriod");
        b.click(function() {
            location.href = Gobal.Webpath+"/mobile/mobile/dataserver/" + $(this).attr("codeid") 
        }).find("li.fl").click(function(q) {
            c(q);
            location.href = Gobal.Webpath+"/mobile/mobile/userindex/" + $(this).parent().attr("uweb")
        });
        b.find("em.blue").addClass("orange").click(function(q) {
            c(q);
            location.href = Gobal.Webpath+"/mobile/mobile/userindex/" + $(this).parent().parent().parent().attr("uweb")
        })
    }
    var a = function() {
        $("#divPeriod").touchslider();
        Base.getScript(Gobal.Skin + "/js/mobile/GoodsPicSlider.js?v=130826",
        function() {
            $("#sliderBox").picslider()
        })
    };
    Base.getScript(Gobal.Skin + "/js/mobile/PeriodSlider.js?v=130826", a)
});