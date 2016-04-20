(function(a) {
    a.picslider = function(e, c) {
        var f = a(e),
        g = a.extend({},
        a.picslider.defaults, c),
        h = ("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch,
        d = (h) ? "touchend": "click",
        b = {};
        a.data(e, "picflexslider", f);
        b = {
            init: function() {
                f.animating = false;
                f.currentSlide = g.startAt;
                f.animatingTo = f.currentSlide;
                f.containerSelector = g.selector.substr(0, g.selector.search(" "));
                f.slides = a(g.selector, f);
                f.container = a(f.containerSelector, f);
                f.count = f.slides.length;
                f.viewMaxW = g.viewMaxW;
                f.prop = "marginLeft";
                f.padding = 0;
                f.x = 0;
                f.args = {};
                f.transitions = (function() {
                    var l = document.createElement("div"),
                    k = ["perspectiveProperty", "WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"];
                    for (var j in k) {
                        if (l.style[k[j]] !== undefined) {
                            f.pfx = k[j].replace("Perspective", "").toLowerCase();
                            f.prop = "-" + f.pfx + "-transform";
                            return true
                        }
                    }
                    return false
                } ());
                if (g.controlsContainer !== "") {
                    f.controlsContainer = a(g.controlsContainer).length > 0 && a(g.controlsContainer)
                }
                f.doMath();
                f.setup();
                if (g.directionNav) {
                    b.directionNav.setup()
                }
                if (h && g.touch) {
                    b.touch()
                }
                a(window).bind("resize focus", b.resize)
            },
            directionNav: {
                setup: function() {
                    var i = a('<ul class="direction-nav"><li class="prev"></li><li class="next"></li></ul>');
                    if (f.controlsContainer) {
                        a(f.controlsContainer).append(i);
                        f.directionNav = a(".direction-nav li", f.controlsContainer)
                    } else {
                        f.append(i);
                        f.directionNav = a(".direction-nav li", f)
                    }
                    b.directionNav.update();
                    f.directionNav.bind(d,
                    function(j) {
                        j.preventDefault();
                        if (f.direction == "touch") {
                            return
                        }
                        var k = (a(this).hasClass("next")) ? f.getTarget("next") : f.getTarget("prev");
                        f.flexAnimate(k, true)
                    })
                },
                update: function() {
                    f.directionNav.hide().width((f.w - g.itemW) / 2 - 5).fadeIn("fast")
                }
            },
            touch: function() {
                var p, n, l, q, t, j, r, k, o = true;
                e.addEventListener("touchstart", m, false);
                function m(u) {
                    if (f.animating) {
                        u.preventDefault()
                    } else {
                        if (u.touches.length === 1) {
                            q = f.computedW;
                            j = 0;
                            l = (f.currentSlide + f.cloneOffset) * q - f.padding;
                            p = u.touches[0].pageX;
                            n = u.touches[0].pageY;
                            e.addEventListener("touchmove", i, false);
                            e.addEventListener("touchend", s, false)
                        }
                    }
                }
                function i(u) {
                    t = p - u.touches[0].pageX;
                    o = (Math.abs(t) < Math.abs(u.touches[0].pageY - n));
                    if (!o) {
                        f.direction = "touch";
                        u.preventDefault();
                        if (Math.abs(t - j) > 3) {
                            j = t;
                            if (f.transitions) {
                                f.setProps(l + t, "setTouch")
                            }
                        }
                    }
                }
                function s(w) {
                    w.preventDefault();
                    if (f.animatingTo === f.currentSlide && !o && !(t === null)) {
                        var v = t,
                        u = (v > 0) ? f.getTarget("next") : f.getTarget("prev");
                        if (f.canAdvance(u)) {
                            f.flexAnimate(u, true)
                        } else {
                            f.flexAnimate(f.currentSlide, true, true)
                        }
                        f.direction = ""
                    }
                    e.removeEventListener("touchmove", i, false);
                    e.removeEventListener("touchend", s, false);
                    p = null;
                    n = null;
                    t = null;
                    l = null
                }
            },
            resize: function() {
                f.doMath();
                f.setProps(f.computedW, "setTotal");
                b.directionNav.update()
            }
        };
        f.flexAnimate = function(o, q, j) {
            if (!f.animating && (f.canAdvance(o) || j) && f.is(":visible")) {
                f.animating = true;
                f.animatingTo = o;
                f.slides.removeClass("active-slide").eq(o).addClass("active-slide");
                var m = f.computedW,
                l, k, i, n = true,
                p;
                if (f.currentSlide === 0 && o === f.count - 1 && f.direction !== "next") {
                    k = f.x - f.count * m;
                    p = f.count * m
                } else {
                    if (f.currentSlide === f.last && o === 0 && f.direction !== "prev") {
                        k = f.x + f.count * m;
                        p = m
                    } else {
                        k = (o + f.cloneOffset) * m;
                        n = false
                    }
                }
                if (n) {
                    f.setProps( - k, "init", 0);
                    setTimeout(function() {
                        f.setProps(p, "", g.animationSpeed)
                    },
                    100)
                } else {
                    f.setProps(k, "", g.animationSpeed)
                }
                if (f.transitions) {
                    f.animating = false;
                    f.currentSlide = f.animatingTo;
                    f.container.unbind("webkitTransitionEnd transitionend");
                    f.container.bind("webkitTransitionEnd transitionend",
                    function() {
                        f.wrapup(m)
                    })
                }
            }
        };
        f.wrapup = function(i) {
            if (f.currentSlide === 0 && f.animatingTo === f.last) {
                f.setProps(i, "jumpEnd")
            } else {
                if (f.currentSlide === f.last && f.animatingTo === 0) {
                    f.setProps(i, "jumpStart")
                }
            }
            f.animating = false;
            f.currentSlide = f.animatingTo
        };
        f.canAdvance = function(i) {
            return (i === f.currentSlide) ? false: true
        };
        f.getTarget = function(i) {
            f.direction = i;
            if (i === "next") {
                return (f.currentSlide === f.last) ? 0 : f.currentSlide + 1
            } else {
                return (f.currentSlide === 0) ? f.last: f.currentSlide - 1
            }
        };
        f.setProps = function(l, i, j) {
            var k = (function() {
                var m = (function() {
                    switch (i) {
                    case "setTotal":
                        return (f.currentSlide + f.cloneOffset) * l - f.padding;
                    case "setTouch":
                        return l;
                    case "init":
                        return l;
                    case "jumpEnd":
                        return f.count * l - f.padding;
                    case "jumpStart":
                        return l - f.padding;
                    default:
                        return l - f.padding
                    }
                } ());
                f.x = m * -1;
                return f.x + "px"
            } ());
            if (f.transitions) {
                k = "translate3d(" + k + ",0,0)";
                j = (j !== undefined) ? (j / 1000) + "s": "0s";
                f.container.css("-" + f.pfx + "-transition-duration", j)
            }
            f.args[f.prop] = k;
            if (f.transitions || j === undefined) {
                f.container.css(f.args)
            }
        };
        f.setup = function() {
            f.viewport = a('<div class="flex-viewport"></div>').css({
                overflow: "hidden",
                position: "relative"
            }).appendTo(f).append(f.container);
            f.cloneCount = 0;
            f.cloneOffset = 0;
            f.cloneCount = 2;
            f.cloneOffset = 1;
            f.container.append(f.slides.first().clone().addClass("clone")).prepend(f.slides.last().clone().addClass("clone"));
            f.newSlides = a(g.selector, f);
            f.newSlides.css({
                width: f.computedW,
                "float": "left",
                display: "block"
            });
            var j = f.currentSlide + f.cloneOffset;
            f.container.width((f.count + f.cloneCount) * 100 + "%");
            var i = parseInt((f.viewMaxW - f.w) / 2);
            f.setProps(i, "init");
            setTimeout(function() {
                f.find("div.loading").remove();
                f.container.show()
            },
            100)
        };
        f.doMath = function() {
            f.w = f.parent().width();
            if (f.w > f.viewMaxW) {
                f.w = f.viewMaxW
            }
            f.width(f.w);
            f.padding = (f.w - g.itemW) / 2;
            f.pagingCount = f.count;
            f.last = f.count - 1;
            f.computedW = g.itemW
        };
        b.init()
    };
    a.picslider.defaults = {
        selector: ".slides > li",
        startAt: 0,
        slideshowSpeed: 5000,
        animationSpeed: 400,
        itemW: 210,
        viewMaxW: 630,
        touch: true,
        directionNav: true,
        prevText: "",
        nextText: "",
        controlsContainer: "",
    };
    a.fn.picslider = function(b) {
        b = b || {};
        return this.each(function() {
            var d = a(this);
            if (b.selector === undefined) {
                b.selector = ".slides > li"
            }
            var c = d.find(b.selector);
            if (c.length === 0) {
                return
            } else {
                if (c.length === 1) {
                    d.find("div.loading").remove();
                    c.parent().fadeIn(400)
                } else {
                    if (d.data("picslider") === undefined) {
                        new a.picslider(this, b)
                    }
                }
            }
        })
    }
})(jQuery);