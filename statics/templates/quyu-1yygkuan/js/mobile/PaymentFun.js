$(function() {
 
    var a = false;
    var b = function() {
        var x = parseInt($("#hidShopMoney").val());
        var ffdk = parseInt($("#pointsbl").val());
        var d = $("#hidBalance").val();
        var t = parseInt($("#hidPoints").val());
        var c = $("#spPoints");
        var p = $("#spBalance");
        var h = null;
        var m = $("#bankList");
        var shopnum = parseInt($("#shopnum").val());		 
        var r = "支付宝";
        //var g = parseInt(t / 100) > x ? x: parseInt(t / 100);
        var g = ffdk > x ? x: ffdk;
        var w = 0;
        var e = 0;
		var checkpay='nosel';//选择支付方式
		var banktype='nobank';
		 
        if (g < x) {		 
            var j = parseInt(d);			 
            if (j > 0) {
                var i = x - g;
                if (j >= i) {
                    w = i
                } else {
                    w = j;
                    e = i - j
                }
            } else {			
                e = x - g
            }
        }
		
        var q = function(y) {
            g = y;
            if (y > 0) {
                c.parent().removeClass("z-pay-grayC");
                c.attr("sel", "1").attr("class", "z-pay-mentsel").next("span").html('福分支付<em class="orange">' + y + ".00</em>元（您的福分：" + t + "）")
				checkpay='fufen';
				banktype='nobank';
            } else {
                c.attr("sel", "0").attr("class", "z-pay-ment").next("span").html('福分支付<em class="orange">0.00</em>元（您的福分：' + t + "）")
            }
        };
        var f = function(y) {
		     
            w = y;
            if (y > 0) {
			 
                p.parent().removeClass("z-pay-grayC");
                p.attr("sel", "1").attr("class", "z-pay-mentsel").next("span").html('余额支付<em class="orange">' + y + ".00</em>元（账户余额：" + d + " 元）")
				checkpay='money';
				banktype='nobank';
            } else {
                p.attr("sel", "0").attr("class", "z-pay-ment").next("span").html('余额支付<em class="orange">0.00</em>元（账户余额：' + d + " 元）")
            }
        };
        var k = function(y) {
            e = y;			 
            if (y > 0) {
                h.html('<s class="z-arrow"></s>选择' + (r == "网银" ? "网银": '<b class="z-mlr">' + r + "</b>") + "支付" + ((g > 0 || w > 0) ? "剩余": "") + '<em class="orange">' + e + ".00</em>元");
                h.removeClass("z-pay-grayC").nextAll().show();
                o = true
				checkpay='bank'
				if(r=='易宝支付'){
				  banktype='CCB-WAP';
				}else if(r=='支付宝'){
				  banktype='CMBCHINA-WAP';
				}else if(r=='微信支付m'){
				  banktype='ICBC-WAP';
				}
				
            } else {
                h.addClass("z-pay-grayC").html('<s class="z-arrow"></s>选择网银支付').nextAll().hide();
                o = false
            }
        };
        if (ffdk > 0) {		 
            c.parent().click(function() {
                k(0);
                if (c.attr("sel") == 1) {
                    q(0);
                    n(x)
                } else {
                    var y = ffdk;
                    if (y > 0) {
                        q(y >= x ? x: y);
                        n(y >= x ? 0 : x - y)
                    } else {
                        n(x)
                    }
                }
            });
            var n = function(z) {
                if (p.attr("sel") == 1) {
                    var y = parseInt(d) - z;
                    if (y > 0) {
                        f(z)
                    } else {
                        f(parseInt(d));
                        k( - y)
                    }
                } else {
                    k(z)
                }
            }
        }
        if (parseInt(d) > 0) {
            p.parent().click(function() {
			 
                k(0);
                if (p.attr("sel") == 1) {
                    f(0);
                    l(x)
                } else {
                    var y = parseInt(d);
                    if (y > 0) {
                        f(y >= x ? x: y);
                        l(y >= x ? 0 : x - y)
                    } else {
                        l(x)
                    }
                }
            });
            var l = function(z) {
                if (c.attr("sel") == 1) {
                    var y = ffdk - z;
                    if (y > 0) {
                        q(z)
                    } else {
                        q(ffdk);
                        k( - y)
                    }
                } else {
                    k(z)
                }
            }
        }
        var o = false;
        var v = 1;
        $("li", m).each(function(y) {		  
            var z = $(this);
			 
            if (y == 0) {
                h = z;
                h.click(function() {
                    if (!h.hasClass("z-pay-grayC")) {
                        if (!o) {
                            h.nextAll().show();
                            o = true
                        } else {
                            h.nextAll().hide();
                            o = false
                        }
                    }
                })
            } else {			 
                z.click(function() {				 
                    v = y;
                    r = z.text();
                    z.children("i").attr("class", "z-bank-Roundsel");
                    z.siblings().each(function() {
                        $(this).children("i").attr("class", "z-bank-Round")
                    });
                    h.html('<s class="z-arrow"></s>选择<b class="z-mlr">' + r + "</b>支付" + ((g > 0 || w > 0) ? "剩余": "") + '<em class="orange">' + e + ".00</em>元")
					checkpay='bank'
					//banktype=r;
				if(r=='易宝支付'){
				  banktype='CCB-WAP';
				}else if(r=='支付宝'){
				  banktype='CMBCHINA-WAP';
				}else if(r=='微信支付m'){
				  banktype='ICBC-WAP';
				}
                })
            }
        });		 
        if (e > 0) {		 
            h.removeClass("z-pay-grayC").html('<s class="z-arrow"></s>选择<b class="z-mlr">' + r + "</b>支付" + ((g > 0 || w > 0) ? "剩余": "") + '<em class="orange">' + e + ".00</em>元").nextAll().show();
            o = true
			banktype='CMBCHINA-WAP';
			checkpay='bank'
        } else {		 
            h.addClass("z-pay-grayC").nextAll().hide();
            o = false
        }
        var s = $("#btnPay");
        var u = function() { 
             
			var submitcode = Path.submitcode
			if(!this.cc){
				this.cc = 1;			
			}else{		
				alert("不可以重复提交订单!")
				return false;
			}
						
            if(checkpay=='nosel' && banktype=='nobank'){
			  alert("请选择一种支付方式！");
			  if(this.cc){
				this.cc = false;
			  }
			  return
			}		
            if (!a) {
                return
            }
            if (w + g >= x) {			 
                a = false;
                s.unbind("click").addClass("dis");
			    if (shopnum != -1) {
					if (shopnum == 0) {					
						location.replace(Gobal.Webpath+"/mobile/cart/paysubmit/"+checkpay+"/"+banktype+"/"+x+"/"+t+"/"+submitcode)
					} else {
						if (shopnum == 1) {
							alert("亲，您的购物车中没有商品哦，去选购一些吧。");
							location.replace(Gobal.Webpath+"/mobile/cart/cartlist")
						} else {
							if (shopnum == 10) {
								location.reload()
							}
						}
					}
				}
				s.bind("click", u).removeClass("dis");
				a = true
            } else {			 
                if (e > 0) {
                    if (v == 1 || v == 2 || v == 3) {                           
                           location.href = Gobal.Webpath+"/mobile/cart/paysubmit/"+checkpay+"/"+banktype+"/"+x+"/"+t
                    } 
                }
            }
        };
        s.bind("click", u);
        a = true
    };
    Base.getScript(Gobal.Skin + "/js/mobile/pageDialog.js", b)
});