$(function() {
    var a = function() {	 
        var h = $("#divPost");
        var n = $("#divUnPost");
        var l = h.children("ul");
        var s = n.children("ul");
        var m = $("#btnPost");
        var i = $("#btnUnPost");
        var e = $("#divPostLoad");
        var d = $("#btnLoadMore");
        var q = false;
        var g = 10;
        var j = null;
        var p = null;
        var k = 1;
        var o = false;
        var c = false;
        var f = false;
        var b = function() {
            var v = 0;
            var t = {
                FIdx: 0,
                EIdx: g,
                isCount: 1
            };
            var u = function() {
                return "/" + t.FIdx + "/" + t.EIdx + "/" + t.isCount
            };
			
            var w = function() {			 
                e.show();
                //GetJPData("http://m.1yyg.com", "getUserPostList", u(),
				GetJPData(Gobal.Webpath, "shopajax", "getUserPostList"+u(),
                function(D) {			
                    if (D.code == 0) {					
                        if (t.isCount == 1) {
                            v = D.postCount;							 
                            t.isCount = 0;
                            m.html("已晒单(" + v + ")");
                            if (D.unPostCount > 0) {
                                i.html("未晒单(" + D.unPostCount + ")")
                            }
                        }
                        var C = D.listItems;
                        var B = C.length;
                        var A = "";
                        for (var y = 0; y < B; y++) {
                            var z = 2;//C[y].postState;
                            var x = z == 2 ? Gobal.Webpath+"/mobile/mobile/item/" + C[y].id + "": Gobal.Webpath+"/mobile/home/PostSingleEdit/" + C[y].id + "";
                            A += '<li class="' + (y + 1 == B ? "bornone": "") + '" onclick="location.href=\'' + x + '\'"><a class="fl z-Limg" href="' + x + '"><img src="' + Gobal.LoadPic + '" src2="'+Gobal.imgpath+'/uploads/' + C[y].thumb + '" border=0 alt="" width=40></a><div class="u-sgl-r"><p class="z-sgl-tt"><a href="' + x + '" class="gray6">' + C[y].sd_title + '</a></p><p class="z-sgl-info gray9">' + C[y].sd_content + "</p><p>晒单时间：" + C[y].sd_time + "</p>";
                            /*if (z == 0) {
                                A += '<p>状态：<span class="">正在审核</span></p>'
                            } else {
                                if (z == 1) {
                                    A += '<p>状态：<span class="red">审核未通过</span> ' + C[y].postFailReason + '</p><p><a href="PostSingleEdit-' + C[y].postID + '.html" class="z-sgl-btn">修改</a></p>'
                                } else {
                                    if (z == 2) {
                                        A += '<p>状态：<span class="green">审核通过，奖励1000福分</span></p>'
                                    }
                                }
                            }*/
                            A += '</div><b class="z-arrow"></b></li>'
                        }
                        if (t.FIdx > 0) {
                            l.children("li").last().removeClass("bornone")
                        }
                        l.append(A);						
                        if (t.EIdx < v) {
                            d.show()
                        } else {
                            c = true;
                            d.hide()
                        }
                        loadImgFun()
                    } else {
                        if (D.code == 10) {
                            location.reload()
                        } else {
                            if (t.FIdx == 0) {
                                l.append(Gobal.NoneHtml);
                                c = true
                            }
                        }
                    }
                    e.hide();
                    o = false
                })
            };
            this.initPage = function() {
                w()
            };
            this.getNextPage = function() {
                t.FIdx += g;
                t.EIdx += g;
                w()
            }
        };
        var r = function() {
            var v = 0;
            var t = {
                FIdx: 0,
                EIdx: g,
                isCount: 1
            };
            var u = function() {
                return "/" + t.FIdx + "/" + t.EIdx + "/" + t.isCount
            };
            var w = function() {
                e.show();	 			
                //GetJPData("http://m.1yyg.com", "getUserUnPostList", u(),
				GetJPData(Gobal.Webpath, "shopajax", "getUserUnPostList"+u(),
                function(B) {
                    if (B.code == 0) {
                        if (t.isCount == 1) {
                            v = B.unPostCount							 
                        }
                        var A = B.listItems;
                        var z = A.length;
                        if (t.EIdx > 1) {
                            s.children("li").last().removeClass("bornone")
                        }
                        for (var x = 0; x < z; x++) {
                            var C = '<li class="' + (x + 1 == z ? "bornone": "") + '" id="' + A[x].id + '"><a class="fl z-Limg" href="'+Gobal.Webpath+'/mobile/mobile/item/' + A[x].id + '"><img src="' + Gobal.LoadPic + '" src2="'+Gobal.imgpath+'/uploads/' + A[x].thumb + '" border=0 alt=""></a><div class="u-sgl-r gray9"><p class="z-sgl-tt"><a href="'+Gobal.Webpath+'/mobile/mobile/item/' + A[x].id + '" class="gray6">' + A[x].title + "</a></p><p>幸运码：" + A[x].q_user_code + "</p><p>揭晓时间：" + A[x].q_end_time + '</p><p><a href="#" class="z-sgl-btn"></a></p></div><b class="z-arrow"></b></li>';
                            var y = $(C);
                            y.click(function() {
                                //location.href = Gobal.Webpath+"/mobile/home/postsingle/" + y.attr("id") 
                                location.href = Gobal.Webpath+"/mobile/mobile/item/" + y.attr("id") 
                            });
                            s.append(y)
                        }		
			
                        if (t.EIdx < v) {
                            d.show()
                        } else {
                            f = true;
                            d.hide()
                        }
                        loadImgFun(0)
                    } else {
                        if (B.code == 10) {
                            location.reload()
                        } else {
                            if (t.FIdx == 0) {
                                s.append(Gobal.NoneHtml);
                                f = true;
                                d.hide()
                            }
                        }
                    }
                    e.hide();
                    q = true;
                    o = false
                })
            };
            this.initPage = function() {
                w()
            };
            this.getNextPage = function() {
                t.FIdx += g;
                t.EIdx += g;
                w()
            }
        };
        j = new b();
        p = new r();
        j.initPage();
        m.click(function() {
            k = 1;
            m.parent().addClass("z-sgl-crt");
            i.parent().removeClass("z-sgl-crt");
            h.show();
            n.hide();
            if (!c) {
                d.show()
            }
        });
        i.click(function() {
            k = 0;
            m.parent().removeClass("z-sgl-crt");
            i.parent().addClass("z-sgl-crt");
            d.hide();
            h.hide();
            n.show();
            if (!q) {
                p.initPage()
            }
        });
        d.click(function() {
            if (!o) {
                o = true;
                d.hide();
                if (k == 1 && !c) {
                    j.getNextPage()
                } else {
                    if (!f) {
                        p.getNextPage()
                    }
                }
            }
        })
    };
    Base.getScript(Gobal.Skin + "/js/mobile/Comm.js", a)
});