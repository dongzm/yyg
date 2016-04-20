var Gobal = new Object();
function GetJPData(d, c, a, b) {
 
//alert(d + "/mobile/" + c + "/" + a );
//alert(b);
    //$.getJSON(d + "/JPData?action=" + c + "&" + a + "&fun=?", b)
    $.getJSON(d + "/mobile/" + c + "/" + a , b)
}
function loadImgFun(c) {
    var b = $("#loadingPicBlock");
    if (b.length > 0) {
        var i = "src2";
        Gobal.LoadImg = b.find("img[" + i + "]");
        var a = function() {
            return $(window).scrollTop()
        };
        var e = function() {
            return $(window).height() + a() + 50
        };
        var h = function() {
            Gobal.LoadImg.each(function(j) {
                if ($(this).offset().top <= e()) {
                    var k = $(this).attr(i);
                    if (k) {
                        $(this).attr("src", k).removeAttr(i).show()
                    }
                }
            })
        };
        var d = 0;
        var f = -100;
        var g = function() {
            d = a();
            if (d - f > 50) {
                f = d;
                h()
            }
        };
        if (c == 0) {
            $(window).bind("scroll", g)
        }
        g()
    }
}
String.prototype.trim = function() {
    return this.replace(/(\s*$)|(^\s*)/g, "")
};
String.prototype.trims = function() {
    return this.replace(/\s/g, "")
};
var addNumToCartFun = null; (function() {
   // Gobal.Skin = "http://mskin.1yyg.com";

    Gobal.Skin = Path.Skin; 
    Gobal.Webpath = Path.Webpath; 
    Gobal.imgpath = Path.imgpath;  //上传图片地址
    
    Gobal.LoadImg = null;
    Gobal.LoadHtml = '<div class="loadImg">正在加载</div>';
    Gobal.LoadPic = Gobal.Skin + "/images/loading.gif";
	 
    Gobal.NoneHtml = '<div class="haveNot z-minheight"><s></s><p>暂无记录</p></div>';
    Gobal.unlink = "javascript:void(0);";
    $("#tBtnReturn").click(function() {
        history.go( - 1);
        return false
    });
    var d = Gobal.Webpath+"/login";
    loadImgFun(0);
    var a = $("#fLoginInfo");
    GetJPData(Gobal.Webpath, "ajax", "init",
    function(h) {       
        var g = '<span><a href="'+Gobal.Webpath+'/mobile/mobile">首页</a><b></b></span><span><a href='+Gobal.Webpath+'/mobile/mobile/about>新手指南</a><b></b></span>';
        if (h.code == 0) {		   
            g = g + '<span><a href="'+Gobal.Webpath+'/mobile/home" class="Member">' + h.username + '</a><a href="'+Gobal.Webpath+'/mobile/user/cook_end" class="Exit">退出</a></span>'
        } else {
            g = g + '<span><a href="'+Gobal.Webpath+'/mobile/user/login">登录</a><b></b></span><span><a href="'+Gobal.Webpath+'/mobile/register">注册</a></span>'
        }
		 
        a.html(g)
    });
	//购物车网页顶部
    var c = $("#btnCart");
    if (c.length > 0) {
        GetJPData(Gobal.Webpath,"ajax","cartnum",
        function(g) {		   
            if (g.code == 0 && g.num > 0) {
                c.html("<em>" + g.num + "</em>")
            }
        })
    }
    addNumToCartFun = function(g) {
        c.html("<em>" + g + "</em>")
    };
    var e = function(h) {
        var g = new Date();		 
        h.attr("src", h.attr("data")).removeAttr("id").removeAttr("data")
    };
    var f = $("#pageJS", "head");
	
    if (f.length > 0) {
        e(f)
    } else {
        f = $("#pageJS", "body");
        if (f.length > 0) {
            e(f)
        }
    }
    var b = $("#btnTop");
    if ($(window).scrollTop() == 0) {
        b.hide()
    }
    b.css("zIndex", "99").click(function() {
        $("body,html").animate({
            scrollTop: 0
        },
        0)
    });
    $(window).scroll(function() {
        if ($(this).scrollTop() > 0) {
            b.show()
        } else {
            b.hide()
        }
    })
})();