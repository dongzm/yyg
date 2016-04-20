(function(a) {
    a.flexslider = function(d, j) {
        var b = a(d),
        i = a.extend({},
        a.flexslider.defaults, j),
        f = i.namespace,
        h = ("ontouchstart" in window) || window.DocumentTouch && document instanceof DocumentTouch,
        c = (h) ? "touchend": "click",
        g = i.direction === "vertical",
        e = {};
        a.data(d, "flexslider", b);
        e = {
            init: function() {
                b.animating = false;
                b.currentSlide = i.startAt;
                b.animatingTo = b.currentSlide;
                b.atEnd = (b.currentSlide === 0 || b.currentSlide === b.last);
                b.containerSelector = i.selector.substr(0, i.selector.search(" "));
                b.slides = a(i.selector, b);
                b.container = a(b.containerSelector, b);
                b.count = b.slides.length;
                b.prop = (g) ? "top": "marginLeft";
                b.padding = i.paddingWidth;
                b.args = {};
                b.manualPause = false;
                b.transitions = (function() {
                    var m = document.createElement("div"),
                    l = ["perspectiveProperty", "WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"];
                    for (var k in l) {
                        if (m.style[l[k]] !== undefined) {
                            b.pfx = l[k].replace("Perspective", "").toLowerCase();
                            b.prop = "-" + b.pfx + "-transform";
                            return true
                        }
                    }
                    return false
                } ());
                if (i.controlsContainer !== "") {
                    b.controlsContainer = a(i.controlsContainer).length > 0 && a(i.controlsContainer)
                }
                if (i.randomize) {
                    b.slides.sort(function() {
                        return (Math.round(Math.random()) - 0.5)
                    });
                    b.container.empty().append(b.slides)
                }
                b.doMath();
                b.setup("init");
                if (i.controlNav) {
                    e.controlNav.setup()
                }
                if (i.directionNav) {
                    e.directionNav.setup()
                }
                if (i.slideshow) { (i.initDelay > 0) ? setTimeout(b.play, i.initDelay) : b.play()
                }
                if (h && i.touch) {
                    e.touch()
                }
                a(window).bind("resize focus", e.resize)
            },
            controlNav: {
                setup: function() {
                    e.controlNav.setupPaging()
                },
                setupPaging: function() {
                    var m = (i.controlNav === "thumbnails") ? "control-thumbs": "control-paging",
                    k = 1,
                    n;
                    var q = i.controlType == 0 ? "": '<div class="m-xs-line"></div><div class="m-ct-time"><ul></ul></div>';
                    b.controlNavSelector = i.controlType == 0 ? "a": "a";
                    b.controlNavScaffold = a('<article class="' + f + "control-nav " + f + m + '">' + q + "</article>");
                    if (b.pagingCount > 1) {
                        var p = parseInt(100 / b.pagingCount);
                        for (var l = 0; l < b.pagingCount; l++) {
                            if (i.controlType == 0) {
                                b.controlNavScaffold.append("<" + b.controlNavSelector + "/>")
                            } else {
                                var o = b.controlNavScaffold.find("ul");
                                o.append('<li style="width:' + p + '%"><a><b>' + b.slides.eq(l).attr("txt") + "</b><s></s></a></li>")
                            }
                            k++
                        }
                    } (b.controlsContainer) ? (i.controlPos == 0 ? a(b.controlsContainer).append(b.controlNavScaffold) : a(b.controlsContainer).prepend(b.controlNavScaffold)) : (i.controlPos == 0 ? b.container.after(b.controlNavScaffold) : b.container.before(b.controlNavScaffold));
                    e.controlNav.set();
                    e.controlNav.active();
                    if (i.controlType == 1) {
                        b.controlNav.bind(c,
                        function(r) {
                            r.preventDefault();
                            var t = a(this),
                            s = b.controlNav.index(t);
                            if (!t.hasClass(f + "active")) {
                                b.direction = (s > b.currentSlide) ? "next": "prev";
                                b.flexAnimate(s, i.pauseOnAction)
                            }
                        });
                        if (h) {
                            b.controlNav.bind("click touchstart",
                            function(r) {
                                r.preventDefault()
                            })
                        }
                    }
                },
                set: function() {
                    var k = (i.controlNav === "thumbnails") ? "img": b.controlNavSelector;
                    b.controlNav = a("." + f + "control-nav " + k, (b.controlsContainer) ? b.controlsContainer: b)
                },
                active: function() {
                    b.controlNav.removeClass(f + "active").eq(b.animatingTo).addClass(f + "active")
                },
                update: function(k, l) {
                    if (b.pagingCount > 1 && k === "add") {
                        b.controlNavScaffold.append(a("<" + b.controlNavSelector + "/>"))
                    } else {
                        if (b.pagingCount === 1) {
                            b.controlNavScaffold.find(b.controlNavSelector).remove()
                        } else {
                            b.controlNav.eq(l).closest(b.controlNavSelector).remove()
                        }
                    }
                    e.controlNav.set(); (b.pagingCount > 1 && b.pagingCount !== b.controlNav.length) ? b.update(l, k) : e.controlNav.active()
                }
            },
            directionNav: {
                setup: function() {
                    var k = a('<ul class="' + f + 'direction-nav"><li><a class="' + f + 'prev">' + i.prevText + '</a></li><li><a class="' + f + 'next">' + i.nextText + "</a></li></ul>");
                    if (b.controlsContainer) {
                        a(b.controlsContainer).append(k);
                        b.directionNav = a("." + f + "direction-nav li a", b.controlsContainer)
                    } else {
                        b.append(k);
                        b.directionNav = a("." + f + "direction-nav li a", b)
                    }
                    e.directionNav.update();
                    b.directionNav.bind(c,
                    function(l) {
                        l.preventDefault();
                        var m = (a(this).hasClass(f + "next")) ? b.getTarget("next") : b.getTarget("prev");
                        b.flexAnimate(m, i.pauseOnAction)
                    });
                    if (h) {
                        b.directionNav.bind("click touchstart",
                        function(l) {
                            l.preventDefault()
                        })
                    }
                },
                update: function() {
                    var k = f + "disabled";
                    if (!i.animationLoop) {
                        if (b.pagingCount === 1) {
                            b.directionNav.addClass(k)
                        } else {
                            if (b.animatingTo === 0) {
                                b.directionNav.removeClass(k).filter("." + f + "prev").addClass(k)
                            } else {
                                if (b.animatingTo === b.last) {
                                    b.directionNav.removeClass(k).filter("." + f + "next").addClass(k)
                                } else {
                                    b.directionNav.removeClass(k)
                                }
                            }
                        }
                    }
                }
            },
            touch: function() {
                var r, p, n, s, v, l, t, m, q = false;
                d.addEventListener("touchstart", o, false);
                function o(w) {
                    if (b.animating) {
                        w.preventDefault()
                    } else {
                        if (w.touches.length === 1) {
                            b.pause();
                            s = (g) ? b.h: b.computedW;
                            l = 0;
                            n = (b.currentSlide + b.cloneOffset) * s - b.padding;
                            r = (g) ? w.touches[0].pageY: w.touches[0].pageX;
                            p = (g) ? w.touches[0].pageX: w.touches[0].pageY;
                            d.addEventListener("touchmove", k, false);
                            d.addEventListener("touchend", u, false)
                        }
                    }
                }
                function k(w) {
                    v = (g) ? r - w.touches[0].pageY: r - w.touches[0].pageX;
                    q = (g) ? (Math.abs(v) < Math.abs(w.touches[0].pageX - p)) : (Math.abs(v) < Math.abs(w.touches[0].pageY - p));
                    if (!q) {
                        w.preventDefault();
                        if (Math.abs(v - l) > 3) {
                            l = v;
                            if (b.transitions) {
                                if (!i.animationLoop) {
                                    v = v / ((b.currentSlide === 0 && v < 0 || b.currentSlide === b.last && v > 0) ? (Math.abs(v) / s + 2) : 1)
                                }
                                b.setProps(n + v, "setTouch")
                            }
                        }
                    }
                }
                function u(y) {
                    if (b.animatingTo === b.currentSlide && !q && !(v === null)) {
                        var x = v,
                        w = (x > 0) ? b.getTarget("next") : b.getTarget("prev");
                        if (b.canAdvance(w)) {
                            b.flexAnimate(w, i.pauseOnAction)
                        } else {
                            b.flexAnimate(b.currentSlide, i.pauseOnAction, true)
                        }
                    }
                    y.preventDefault();
                    d.removeEventListener("touchmove", k, false);
                    d.removeEventListener("touchend", u, false);
                    r = null;
                    p = null;
                    v = null;
                    n = null;
                    if (i.slideshow && !b.playing) {
                        b.play()
                    }
                }
            },
            resize: function() {
                if (!b.animating && b.is(":visible")) {
                    b.doMath();
                    if (g) {
                        b.viewport.height(b.h);
                        b.setProps(b.h, "setTotal")
                    } else {
                        b.newSlides.width(b.computedW);
                        b.setProps(b.computedW, "setTotal")
                    }
                }
            }
        };
        b.flexAnimate = function(p, o, l) {
            if (!b.animating && (b.canAdvance(p) || l) && b.is(":visible")) {
                b.animating = true;
                b.animatingTo = p;
                if (i.controlNav) {
                    e.controlNav.active()
                }
                b.slides.removeClass(f + "active-slide").eq(p).addClass(f + "active-slide");
                b.atEnd = p === 0 || p === b.last;
                if (i.directionNav) {
                    e.directionNav.update()
                }
                if (p === b.last) {
                    if (!i.animationLoop) {
                        b.pause()
                    }
                }
                var n = (g) ? b.slides.filter(":first").height() : b.computedW,
                m,
                q,
                k;
                if (b.currentSlide === 0 && p === b.count - 1 && i.animationLoop && b.direction !== "next") {
                    q = 0
                } else {
                    if (b.currentSlide === b.last && p === 0 && i.animationLoop && b.direction !== "prev") {
                        q = (b.count + 1) * n
                    } else {
                        q = (p + b.cloneOffset) * n
                    }
                }
                b.setProps(q, "", i.animationSpeed);
                if (b.transitions) {
                    if (!i.animationLoop || !b.atEnd) {
                        b.animating = false;
                        b.currentSlide = b.animatingTo
                    }
                    b.container.unbind("webkitTransitionEnd transitionend");
                    b.container.bind("webkitTransitionEnd transitionend",
                    function() {
                        b.wrapup(n)
                    })
                }
            }
        };
        b.wrapup = function(k) {
            if (b.currentSlide === 0 && b.animatingTo === b.last && i.animationLoop) {
                b.setProps(k, "jumpEnd")
            } else {
                if (b.currentSlide === b.last && b.animatingTo === 0 && i.animationLoop) {
                    b.setProps(k, "jumpStart")
                }
            }
            b.animating = false;
            b.currentSlide = b.animatingTo
        };
        b.animateSlides = function() {
            if (!b.animating) {
                b.flexAnimate(b.getTarget("next"))
            }
        };
        b.pause = function() {
            clearInterval(b.animatedSlidesTimer);
            b.playing = false
        };
        b.play = function() {
            b.animatedSlidesTimer = setInterval(b.animateSlides, i.slideshowSpeed);
            b.playing = true
        };
        b.canAdvance = function(k) {
            return (k === b.currentSlide) ? false: (i.animationLoop) ? true: (b.atEnd && b.currentSlide === 0 && k === b.last && b.direction !== "next") ? false: (b.atEnd && b.currentSlide === b.last && k === 0 && b.direction === "next") ? false: true
        };
        b.getTarget = function(k) {
            b.direction = k;
            if (k === "next") {
                return (b.currentSlide === b.last) ? 0 : b.currentSlide + 1
            } else {
                return (b.currentSlide === 0) ? b.last: b.currentSlide - 1
            }
        };
        b.setProps = function(n, k, l) {
            var m = (function() {
                var o = (function() {
                    switch (k) {
                    case "setTotal":
                        return (b.currentSlide + b.cloneOffset) * n - b.padding;
                    case "setTouch":
                        return n;
                    case "jumpEnd":
                        return b.count * n - b.padding;
                    case "jumpStart":
                        return n - b.padding;
                    default:
                        return n - b.padding
                    }
                } ());
                return (o * -1) + "px"
            } ());
            if (b.transitions) {
                m = (g) ? "translate3d(0," + m + ",0)": "translate3d(" + m + ",0,0)";
                l = (l !== undefined) ? (l / 1000) + "s": "0s";
                b.container.css("-" + b.pfx + "-transition-duration", l)
            }
            b.args[b.prop] = m;
            if (b.transitions || l === undefined) {
                b.container.css(b.args)
            }
        };
        b.setup = function(k) {
            if (k === "init") {
                b.container.find("div.loading").remove();
                b.viewport = a('<div class="flex-viewport"></div>').css({
                    overflow: "hidden",
                    position: "relative"
                }).appendTo(b).append(b.container);
                b.cloneCount = 0;
                b.cloneOffset = 0
            }
            if (i.animationLoop) {
                b.cloneCount = 2;
                b.cloneOffset = 1;
                if (k !== "init") {
                    b.container.find(".clone").remove()
                }
                b.container.append(b.slides.first().clone().addClass("clone")).prepend(b.slides.last().clone().addClass("clone"))
            }
            b.newSlides = a(i.selector, b);
            var l = b.currentSlide + b.cloneOffset;
            if (g) {
                b.container.height((b.count + b.cloneCount) * 100 + "%").css("position", "absolute").width("100%");
                setTimeout(function() {
                    b.newSlides.css({
                        display: "block"
                    });
                    b.doMath();
                    b.viewport.height(b.h);
                    b.setProps(l * b.h, "init")
                },
                (k === "init") ? 100 : 0)
            } else {
                b.container.width((b.count + b.cloneCount) * 100 + "%");
                b.setProps(l * b.computedW, "init");
                setTimeout(function() {
                    b.doMath();
                    b.newSlides.css({
                        width: b.computedW,
                        "float": "left",
                        display: "block"
                    })
                },
                (k === "init") ? 100 : 0)
            }
            b.slides.removeClass(f + "active-slide").eq(b.currentSlide).addClass(f + "active-slide")
        };
        b.doMath = function() {
            var k = b.slides.first();
            b.w = b.width();
            b.h = k.height();
            b.boxPadding = b.padding * 2;
            b.itemW = b.w;
            b.pagingCount = b.count;
            b.last = b.count - 1;
            b.computedW = b.itemW - b.boxPadding
        };
        b.update = function(l, k) {
            b.doMath();
            if (l < b.currentSlide) {
                b.currentSlide += 1
            } else {
                if (l <= b.currentSlide && l !== 0) {
                    b.currentSlide -= 1
                }
            }
            b.animatingTo = b.currentSlide;
            if (i.controlNav) {
                if ((k === "add") || b.pagingCount > b.controlNav.length) {
                    e.controlNav.update("add")
                } else {
                    if ((k === "remove") || b.pagingCount < b.controlNav.length) {
                        e.controlNav.update("remove", b.last)
                    }
                }
            }
            if (i.directionNav) {
                e.directionNav.update()
            }
        };
        e.init()
    };
    a.flexslider.defaults = {
        namespace: "flex-",
        selector: ".slides > li",
        direction: "horizontal",
        animationLoop: true,
        startAt: 0,
        slideshow: true,
        slideshowSpeed: 5000,
        animationSpeed: 400,
        initDelay: 0,
        randomize: false,
        pauseOnAction: true,
        touch: true,
        controlNav: true,
        directionNav: false,
        prevText: "",
        nextText: "",
        controlType: 0,
        controlPos: 0,
        paddingWidth: 0,
        controlsContainer: "",
    };
    a.fn.flexslider = function(b) {
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
                    c.fadeIn(400)
                } else {
                    if (d.data("flexslider") === undefined) {
                        new a.flexslider(this, b)
                    }
                }
            }
        })
    }
})(jQuery);