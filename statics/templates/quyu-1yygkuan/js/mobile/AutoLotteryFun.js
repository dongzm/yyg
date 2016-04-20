$(document).ready(function() {
    var a = function() {
        var c = $("#divTimerItems");
        var f = c.find("div[name=timerItem]");
        if (f.length > 0) {
            var e = function() {
                f.each(function() {
                    var i = $(this);
                    var j = parseInt(i.attr("time"));
                    if (j > 0) {
                        var h = function() {
                            window.location.reload()
                        };
                        i.countdowntime(j, h)
                    }
                })
            };
            Base.getScript(Gobal.Skin + "/js/mobile/CountdownFun.js", e)
        }
        var b = c.find("div[name=waiterItem]");
        if (b.length > 0) {
            b.each(function() {
                var i = $(this);
                var j = parseInt(i.attr("time"));
                if (j > 0) {
                    var h = function() {
                        window.location.reload()
                    };
                    setTimeout(h, j * 1000)
                }
            })
        }
        var g = function() {
            var h = function(l) {
                $.PageDialog.fail(l)
            };
            var k = function(l) {
                $.PageDialog.ok("<s></s>" + l)
            };
            var j = function(m, l) {
			    
                GetJPData(Gobal.Webpath, "ajax", "addShopCart/" + m + "/" + l,
                function(n) {				     
                    if (n.code == 0) {
                        addNumToCartFun(n.num);
                        k("添加成功")
                    } else {
                        h("添加失败")
                    }
                })
            };
            $("a.z-cartBtn").click(function() {
			   
                j($(this).attr("id"), 1)
            });
            var i = function(m, l) {			   
                GetJPData(Gobal.Webpath, "ajax", "addShopCart/" + m + "/" + l,
                function(n) {
                    if (n.code == 0) {
                        location.href = Gobal.Webpath+"/mobile/cart/cartlist"
                    } else {
                        h("添加失败")
                    }
                })
            };
            $("a.z-ShoppingBtn").click(function() {			
                i($(this).attr("id"), 1)
            })
        };
        Base.getScript(Gobal.Skin + "/js/mobile/pageDialog.js", g);
        var d = function() {
            var h = parseInt($("#hdStartAt").val());
            $("#autoLotteryBox").flexslider({
                slideshow: false,
                animationLoop: false,
                controlType: 1,
                controlPos: 1,
                startAt: h,
                controlsContainer: "section.flexbox"
            })
        };
        Base.getScript(Gobal.Skin + "/js/mobile/Flexslider.js", d)
    };
    a()
});