(function(a) {
    a.touchslider = function(c) {
        var d = a(c),
        e = ("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch,
        b = {};
        a.data(c, "touchslider", d);
        b = {
            init: function() {
                d.container = a("ul.slides", d);
                d.slides = a("li", d.container);
                d.find("div.loading").remove();
                d.container.show();
                d.x = 0;
                d.switchs = true;
                a("a", d.slides).bind("click",
                function() {
                    var f = d.container.position().left;
                    if (Math.abs(f - d.x) > 5) {
                        d.setProps(Math.abs(f));
                        return false
                    }
                });
                d.prop = "marginLeft";
                d.args = {};
                d.transitions = (function() {
                    var h = document.createElement("div"),
                    g = ["perspectiveProperty", "WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"];
                    for (var f in g) {
                        if (h.style[g[f]] !== undefined) {
                            d.pfx = g[f].replace("Perspective", "").toLowerCase();
                            d.prop = "-" + d.pfx + "-transform";
                            return true
                        }
                    }
                    return false
                } ());
                d.doMath();
                d.setup();
                if (d.switchs) {
                    if (e) {
                        b.touch()
                    }
                    a(window).bind("resize focus", b.resize)
                }
            },
            touch: function() {
                var p, n, k, s, h, q, l, i, j, g, o = false;
                c.addEventListener("touchstart", m, false);
                function m(t) {
                    if (t.touches.length === 1) {
                        q = Number(new Date());
                        h = 0;
                        i = 0;
                        j = 0;
                        k = Math.abs(d.x);
                        p = t.touches[0].pageX;
                        n = t.touches[0].pageY;
                        c.addEventListener("touchmove", f, false);
                        c.addEventListener("touchend", r, false)
                    }
                }
                function f(v) {
                    s = p - v.touches[0].pageX;
                    o = (Math.abs(s) < Math.abs(v.touches[0].pageY - n));
                    if (!o) {
                        v.preventDefault();
                        var u = Number(new Date()) - q;
                        i += parseInt(Math.abs(s) * 100 / u) > 30 ? 50 : 20;
                        j++;
                        if (Math.abs(s - h) > 3) {
                            h = s;
                            var t = k + s;
                            if (d.transitions && t > -50 && Math.abs(t) < d.tw - d.w + 50) {
                                d.setProps(t, "setTouch")
                            }
                        }
                    }
                }
                function r(v) {
                    if (d.transitions) {
                        var t;
                        if (d.x > 0) {
                            t = 0
                        } else {
                            l = i / j;
                            var u = (Math.abs(d.x) - k) * (l > 30 ? parseInt(l / 10) : 1);
                            t = k + u
                        }
                        if (t < 0) {
                            t = 0;
                            u = -k
                        } else {
                            if (Math.abs(t) > d.tw - d.w) {
                                t = d.tw - d.w;
                                u = t - k
                            }
                        }
                        d.setProps(t, "setTouch", Math.abs(u))
                    }
                    c.removeEventListener("touchmove", f, false);
                    c.removeEventListener("touchend", r, false);
                    p = null;
                    n = null;
                    s = null;
                    k = null
                }
            },
            resize: function() {
                if (d.is(":visible")) {
                    d.doMath();
                    d.setProps(0, "setTotal", 400)
                }
            }
        };
        d.setProps = function(i, f, g) {
            var h = (function() {
                var j = (function() {
                    switch (f) {
                    case "setTotal":
                        return (Math.abs(d.x) > d.tw - d.w) ? (d.tw - d.w < 0 ? 0 : d.tw - d.w) : Math.abs(d.x);
                    case "setTouch":
                        return i;
                    default:
                        return i
                    }
                } ());
                d.x = j * -1;
                return d.x + "px"
            } ());
            if (d.transitions) {
                h = "translate3d(" + h + ",0,0)";
                g = (g !== undefined) ? (g / 1000) + "s": "0s";
                d.container.css("-" + d.pfx + "-transition-duration", g)
            }
            d.args[d.prop] = h;
            if (d.transitions || g === undefined) {
                d.container.css(d.args)
            }
        };
        d.setup = function() {
            d.viewport = a('<div class="flex-viewport"></div>').appendTo(d).append(d.container);
            d.w = d.viewport.width();
            d.container.width(d.tw + "px");
            var f = d.tw - d.w;
            if (f < 0) {
                d.x = 0;
                d.switchs = false;
                return
            } else {
                if (d.x >= f) {
                    d.x = f
                }
            }
            d.setProps(d.x, "init")
        };
        d.doMath = function() {
            if (d.viewport) {
                d.w = d.viewport.width()
            }
            d.tw = 0;
            d.slides.each(function() {
                if (a(this).attr("class") == "cur") {
                    d.x = d.tw
                }
                d.tw += a(this).outerWidth()
            })
        };
        b.init()
    };
    a.fn.touchslider = function() {
        return this.each(function() {
            new a.touchslider(this)
        })
    }
})(jQuery);