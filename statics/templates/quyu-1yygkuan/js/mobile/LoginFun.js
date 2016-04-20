$(function() {
    var b = function() {
        var h = "_uName";
        var g = $("#txtAccount");
        var k = $("#txtPassword");
        var j = $("#showPWD");
        var e = $("#btnLogin");
        var m = false;
        var f = function(x) {
            var w = /^1\d{10}$/;
            return w.test(x)
        };
        var d = function(x) {
            var w = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
            return w.test(x)
        };
        var u = function(x) {
            var w = /^([\x00-\xff])+$/;
            return w.test(x)
        };
        var r = function(y) {
            var x = /^([\x00-\xff]){6,20}$/;
            var w = /^\S{6,20}$/;
            return x.test(y) && w.test(y)
        };
        var o = {
            txtStr: "请输入您的手机号码/邮箱",
            txtpwd: "请输入您的登录密码",
            errorU: "请输入正确的手机号/邮箱",
            errorP: "密码长度为6-20位字符",
            loginerr0: "登录帐号或密码不正确",
            loginerr1: "登录帐号未注册",
            loginerr2: "账号被冻结，请与客服联系",
            loginerr3: "失败次数超限，被冻结5分钟",
            loginerr4: "登录失败，请重试",
            showPWD: "显示密码",
            loginerr5: "必须输入帐号和密码",
            loginok: "登录成功"
        };
        var t = {
            txtStr: "登录",
            checkCode: "正在登录"
        };
        var v = function(w) {
            $.PageDialog.fail(w)
        };
        var i = function(x, w) {
            $.PageDialog.ok(x, w)
        };
        var q = function() {
            if (!isLoaded) {
                return
            }
            var y = g.val().trim();
            var w = k.val().trim();
            if (y == "" || y == o.txtStr) {
                v(o.txtStr);
                return
            } else {
                if (w == "" || w == o.txtpwd) {
                    v(o.txtpwd);
                    return
                } else {
                    if (!f(y) && !d(y)) {
                        v(o.errorU);
                        return
                    } else {
                        if (!r(w)) {
                            v(o.errorP)
                        } else {
                            var x = function(z) {
							//alert(z.state);
							//alert(z.num);
                                if (z.state == 0) {
                                    e.hide();
                                    /*$.cookie(h, y, {
                                        domain: "1yyg.com",
                                        expires: 1,
                                        path: "/"
                                    });*/
                                    GetJPData(Gobal.Webpath, "ajax", "loginok",
                                    function(A) {
									   if(A.Code==0){
											var B = function() {
												var C = $("#hidLoginForward").val();
												if (C.length == 0 || C.indexOf(Gobal.Webpath+"/mobile/user/login/") > 0) {
													C = Gobal.Webpath+"/mobile/mobile"
												}
												location.replace(C);
												return
											};
											i(o.loginok, B)
										}
                                    })
                                } else {
                                    if (z.state == 1 && z.num == -1) {
                                        v(o.loginerr0)
                                    } else {
                                        if (z.state == 1 && z.num == -2) {
                                            v(o.loginerr1)
                                        } else {
                                            if (z.state == 1 && z.num == -3) {
                                                v(o.loginerr2)
                                            } else {
                                                if (z.state == 3) {
                                                    v(o.loginerr3)
                                                } else {
                                                    v(o.loginerr4)
                                                }
                                            }
                                        }
                                    }
                                }
                                isLoaded = true;
                                e.html(t.txtStr).removeClass("grayBtn").bind("click", q)
                            };
                            isLoaded = false;
                            e.html(t.checkCode).addClass("grayBtn").unbind("click");
                            GetJPData(Gobal.Webpath, "ajax", "userlogin/" + y + "/" + base64encode(utf16to8(w)), x)
                        }
                    }
                }
            }
        };
        var n = "";
        var l;
        var p = function() {
            var w = l.val();
            if (n != w) {
                if (u(w) || w == "") {
                    n = w
                } else {
                    l.val(n).focus()
                }
            }
            if (m) {
                setTimeout(p, 200)
            }
        };
        g.bind("focus",
        function() {
            $(this).attr("style", "color:#666666");
            m = true;
            l = $(this);
            p()
        }).bind("blur",
        function() {
            m = false
        });
        k.bind("focus",
        function() {
            $(this).attr("style", "color:#666666");
            m = true;
            l = $(this);
            p()
        }).bind("blur",
        function() {
            m = false
        });
        var s = function() {
            var w = $.cookie(h);
            if (w != null) {
                g.val(w).attr("style", "color:#666666")
            }
        };
        s();
        e.bind("click", q);
        isLoaded = true
    };
    var a = function() {
        Base.getScript(Gobal.Skin + "/js/mobile/pageDialog.js", b)
    };
    Base.getScript(Gobal.Skin + "/js/mobile/Comm.js", a);


    var base64encodechars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
    var base64decodechars = new Array(
    -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
    -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
    -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63,
    52, 53, 54, 55, 56, 57, 58, 59, 60, 61, -1, -1, -1, -1, -1, -1,
    -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14,
    15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, -1, -1, -1, -1, -1,
    -1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40,
    41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1, -1, -1);
    function base64encode(str) {
        var out, i, len;
        var c1, c2, c3;
        len = str.length;
        i = 0;
        out = "";
        while (i < len) {
            c1 = str.charCodeAt(i++) & 0xff;
            if (i == len) {
                out += base64encodechars.charAt(c1 >> 2);
                out += base64encodechars.charAt((c1 & 0x3) << 4);
                out += "==";
                break;
            }
            c2 = str.charCodeAt(i++);
            if (i == len) {
                out += base64encodechars.charAt(c1 >> 2);
                out += base64encodechars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xf0) >> 4));
                out += base64encodechars.charAt((c2 & 0xf) << 2);
                out += "=";
                break;
            }
            c3 = str.charCodeAt(i++);
            out += base64encodechars.charAt(c1 >> 2);
            out += base64encodechars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xf0) >> 4));
            out += base64encodechars.charAt(((c2 & 0xf) << 2) | ((c3 & 0xc0) >> 6));
            out += base64encodechars.charAt(c3 & 0x3f);
        }
        return out;
    }
    function base64decode(str) {
        var c1, c2, c3, c4;
        var i, len, out;
        len = str.length;
        i = 0;
        out = "";
        while (i < len) {

            do {
                c1 = base64decodechars[str.charCodeAt(i++) & 0xff];
            } while (i < len && c1 == -1);
            if (c1 == -1)
                break;

            do {
                c2 = base64decodechars[str.charCodeAt(i++) & 0xff];
            } while (i < len && c2 == -1);
            if (c2 == -1)
                break;
            out += String.fromCharCode((c1 << 2) | ((c2 & 0x30) >> 4));

            do {
                c3 = str.charCodeAt(i++) & 0xff;
                if (c3 == 61)
                    return out;
                c3 = base64decodechars[c3];
            } while (i < len && c3 == -1);
            if (c3 == -1)
                break;
            out += String.fromCharCode(((c2 & 0xf) << 4) | ((c3 & 0x3c) >> 2));

            do {
                c4 = str.charCodeAt(i++) & 0xff;
                if (c4 == 61)
                    return out;
                c4 = base64decodechars[c4];
            } while (i < len && c4 == -1);
            if (c4 == -1)
                break;
            out += String.fromCharCode(((c3 & 0x03) << 6) | c4);
        }
        return out;
    }
    function utf16to8(str) {
        var out, i, len, c;
        out = "";
        len = str.length;
        for (i = 0; i < len; i++) {
            c = str.charCodeAt(i);
            if ((c >= 0x0001) && (c <= 0x007f)) {
                out += str.charAt(i);
            } else if (c > 0x07ff) {
                out += String.fromCharCode(0xe0 | ((c >> 12) & 0x0f));
                out += String.fromCharCode(0x80 | ((c >> 6) & 0x3f));
                out += String.fromCharCode(0x80 | ((c >> 0) & 0x3f));
            } else {
                out += String.fromCharCode(0xc0 | ((c >> 6) & 0x1f));

                out += String.fromCharCode(0x80 | ((c >> 0) & 0x3f));
            }
        }
        return out;
    }
    function utf8to16(str) {
        var out, i, len, c;
        var char2, char3;
        out = "";
        len = str.length;
        i = 0;
        while (i < len) {
            c = str.charCodeAt(i++);
            switch (c >> 4) {
                case 0: case 1: case 2: case 3: case 4: case 5: case 6: case 7:
                    // 0xxxxxxx
                    out += str.charAt(i - 1);
                    break;
                case 12: case 13:
                    // 110x xxxx   10xx xxxx
                    char2 = str.charCodeAt(i++);
                    out += String.fromCharCode(((c & 0x1f) << 6) | (char2 & 0x3f));
                    break;
                case 14:
                    // 1110 xxxx  10xx xxxx  10xx xxxx
                    char2 = str.charCodeAt(i++);
                    char3 = str.charCodeAt(i++);
                    out += String.fromCharCode(((c & 0x0f) << 12) |
                       ((char2 & 0x3f) << 6) |
                       ((char3 & 0x3f) << 0));
                    break;
            }
        }
        return out;
    }
    //base64 加密base64encode(utf16to8(value));
    //base64 解密utf8to16(base64decode(value));
});