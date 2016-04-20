(function(a) {
    a.PageDialog = function(d, m) {
        var g = {
            W: 255,
            H: 45,
            obj: null,
            oL: 0,
            oT: 0,
            autoClose: true,
            autoTime: 1000,
            ready: function() {},
            submit: function() {}
        };
        var e = {
            obj: null,
            oL: 0,
            oT: 0,
            autoClose: true,
            autoTime: 1000,
            ready: function() {},
            submit: function() {}
        };
        m = m || e;
        a.extend(g, m);
        var c = g.autoClose;
        var j = function(q) {
            var n = q.get(0);
            n.addEventListener("touchstart", p, false);
            function p(s) {
                if (s.touches.length === 1) {
                    n.addEventListener("touchmove", o, false);
                    n.addEventListener("touchend", r, false)
                }
            }
            function o(s) {
                s.preventDefault()
            }
            function r(s) {
                n.removeEventListener("touchmove", o, false);
                n.removeEventListener("touchend", r, false)
            }
        };
        var l = a("#pageDialogBG");
        if (!c && l.length == 0) {
            l = a('<div id="pageDialogBG" class="pageDialogBG"></div>');
            l.appendTo("body");
            j(l)
        }
        var i = a("#pageDialog");
        if (i.length == 0) {
            i = a('<div id="pageDialog" class="pageDialog" />');
            i.appendTo("body");
            if (!c) {
                j(i)
            }
        }
        var b = a(window);
        if (g.obj != null) {
            if (g.obj.length < 1) {
                g.obj = null
            }
        }
        i.css({
            width: g.W + "px",
            height: g.H + "px"
        });
        i.html(d);
        var k = function() {
            var n, p, q;
            if (g.obj != null) {
                var o = g.obj.offset();
                n = o.left + g.oL;
                p = o.top + g.obj.height() + g.oT;
                q = "absolute"
            } else {
                n = (b.width() - g.W) / 2;
                p = (b.height() - g.H) / 2;
                q = "fixed"
            }
            i.css({
                position: q,
                left: n,
                top: p
            })
        };
        k();
        b.resize(k);
        var h = function() {
            b.unbind("resize");
            if (c) {
                i.fadeOut("slow")
            } else {
                i.hide();
                l.hide()
            }
        };
        var f = function() {
            g.submit();
            h()
        };
        if (c) {
            i.fadeIn(500)
        } else {
            l.show();
            i.show()
        }
        i.ready = g.ready();
        if (c) {
            window.setTimeout(f, g.autoTime)
        }
        this.close = function() {
            f()
        };
        this.cancel = function() {
            h()
        }
    };
    a.PageDialog.ok = function(c, b) {
        a.PageDialog('<div class="Prompt">' + c + "</div>", {
            submit: (b === undefined ?
            function() {}: b)
        })
    };
    a.PageDialog.fail = function(e, d, f, b, c) {
        a.PageDialog('<div class="Prompt">' + e + "</div>", {
            obj: d,
            oT: f,
            oL: b,
            autoTime: 2000,
            submit: (c === undefined ?
            function() {}: c)
        })
    };
    a.PageDialog.confirm = function(g, c, b) {
        var e = null;
        var d = '<div class="clearfix m-round u-tipsEject"><div class="u-tips-txt">' + g + '</div><div class="u-Btn"><div class="u-Btn-li"><a href="javascript:;" id="btnMsgCancel" class="z-CloseBtn">取消</a></div><div class="u-Btn-li"><a id="btnMsgOK" href="javascript:;" class="z-DefineBtn">确定</a></div></div></div>';
        var f = function() {
            a("#btnMsgCancel").click(function() {
                e.cancel()
            });
            a("#btnMsgOK").click(function() {
                e.close()
            })
        };
        e = new a.PageDialog(d, {
            H: (b === undefined ? 126 : b),
            autoClose: false,
            ready: f,
            submit: c
        })
    }
})(jQuery);