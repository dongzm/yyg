$(function() {
   // var b = "http://passport.1yyg.com";
    var a = function() {
        var i = $("#inpMobile");
        var o = i.attr("value").trim();		 
        var l = $("#mobileCode");
        var n = $("#btnGetCode");
        var f = $("#btnPostCode");
        var p = function(u) {
            var t = /^[0-9a-zA-Z]+$/;
            return t.test(u)
        };
        var j = function(u) {
            var t = /^1\d{10}$/;
            return t.test(u)
        };
        var m = function(u) {
            var t = /^[0-9a-zA-Z]{6,}$/;
            return t.test(u)
        };
        var h = {
            txtStr: "请输入手机验证码",
            error: "验证码输入不正确",
            outtime: "验证码错误或过期",
            many: "验证码请求次数过多，请稍后再试",
            sucess: "注册成功",
            retry: "验证码发送失败，请重试",
            codeerr: "验证码发送时间没超过120秒"
        };
        var c = {
            txtStr: "确认，下一步",
            checkCode: "正在验证"
        };
        var g = {
            txtStr: "重新发送",
            sending: "正在发送"
        };
        var e = function(t) {
            $.PageDialog.fail(t)
        };
        var d = function() {
            if (!isLoaded) {
                return
            }
            var u = l.val();
            if (u == "" || u == h.txtStr) {
                e(h.txtStr);
                return
            } else {
                if (!m(u)) {
                    e(h.error)
                } else {
                    var t = function(v) {
                        if (v.state == 0) {
						    e(h.sucess);
							location.href = Gobal.Webpath+"/mobile/mobile/";					
                            return
                        } else {
                            e(h.outtime);
                            f.html(c.txtStr).removeClass("grayBtn").bind("click", d)
                        }
                        isLoaded = true
                    };
                    isLoaded = false;
                    f.html(c.checkCode).addClass("grayBtn").unbind("click");                 
					GetJPData(Gobal.Webpath, "ajax", "mobileregsn/"+o+"/"+ u, t)
                }
            }
        };
        var k = function() {
            if (!isLoaded) {
                return
            }
            var t = function(u) {
                isLoaded = true;				
                if (u.state == 0) {
                    s();
                    return
                } else {
                    if (u.state == 2) {
                        e(h.many, 170)
                    }else if(u.state == 1){
					  e(h.codeerr,170)
					} else {
                      e(h.retry, 170)
                    }
                }
            };
			
            isLoaded = false;            
			GetJPData(Gobal.Webpath, "ajax", "sendmobile/"+o, t)
        };
        var s = function() {
            var v = n;
            v.unbind("click").addClass("grayBtn");
            var u = 120;
            var t = function() {
                if (u < 2) {				
                    v.bind("click", k).html(g.txtStr).removeClass("grayBtn");
                    return
                } else {
                    u--;
                    v.html(g.txtStr + "(" + u + ")")
                }
                setTimeout(t, 1000)
            };
            t()
        };
        var q = "";
        var r = function() {
            var t = l.val();
            if (q != t) {
                if (p(t) || t == "") {
                    q = t
                } else {
                    l.val(q).focus()
                }
            }
            if (checkSwitch) {
                setTimeout(r, 200)
            }
        };
        l.bind("focus",
        function() {
            $(this).attr("style", "color:#666666");
            checkSwitch = true;
            r()
        }).bind("blur",
        function() {
            checkSwitch = false
        });
        f.bind("click", d);
        n.bind("click", k);
        s();
        isLoaded = true
    };
    Base.getScript(Gobal.Skin + "/js/mobile/pageDialog.js", a)
});