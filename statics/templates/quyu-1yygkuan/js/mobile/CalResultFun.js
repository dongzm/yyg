$(function() {
    var c = $("#hidCodeID").val();    
    var g = $("#calResult");
    GetJPData(Gobal.Webpath, "ajax","getCalResult/" + c ,	
    function(l) {	 
        if (l.code == 0) {		 
		  if(l.contcode==0){
            var k = '<div class="infoResult">';           
                k += '<ul class="result1">';                
                k += "</ul>"		 
                k += "<dl>截止揭晓时间【" + $("#hidRaffleTime").val() + "】最<em>后100条全站购买时间记录</em></dl>";
                o = l.itemlist;
                s = o.length;
            if (s > 0) {			
                k += '<ul class="result2"><li class="iTitle"><span>购买时间</span><span>转换数据</span><span>会员账号</span></li>';
                for (var m = 0; m < s; m++) {
                    k += "<li><span>" + o[m].time.replace(" ", "<dd>") + "</dd></span><span>" + o[m].timecode + "</span><span>" + o[m].username + '</span><p><b class="z-arrow"></b></p></li>'
                }
                k += "</ul>"
				
            }
			 
              k += "</div>";
		  
		     
            var r = $("#hidBaseNum").val();
            var j = $("#hidCodeQuantity").val();
            var p = $("#hidYuShu").val();
            var n = $("#hidCodeRno").val();
            var q = parseInt(p) + parseInt("10000001");
            k += '<div class="infoCount"><div class="infoCount2"><ul><li style="border:0 none;">取以上数值结果得：</li><li>1、求和：' + r + "<em>(上面100条购买记录时间取值相加之和)</em></li><li><p>2、取余：" + r + "<em>(100条时间记录之和)</em><br/>%" + j + "<em>(本商品总需参与人次)</em>=" + p + "<em>(余数)</em></p></li><li>3、计算结果：" + p + "<em>(余数)</em>+10000001=<span>" + q + "</span></p>" + (q != n ? '<li><p style="text-indent:-6.6em; padding-left:80px;">4、最终结果：' + q + " 未被购买，取差值最小的购买码 " + n + " 为幸运码</p></li>": "") + "</div></div>";
			}else{
			    var r = $("#hidBaseNum").val();
				var j = $("#hidCodeQuantity").val();
				var p = $("#hidYuShu").val();
				var n = $("#hidCodeRno").val(); 
				var q = parseInt(p) + parseInt("10000001");
				var k = '<div class="infoCount"><div class="infoCount2"><ul><li style="text-align:center;border:0 none;">未满100条计算结果</li><li ">取以上数值结果得：</li><li>1、求和：' + r + "<em>(上面100条购买记录时间取值相加之和)</em></li><li><p>2、取余：" + r + "<em>(100条时间记录之和)</em><br/>%" + j + "<em>(本商品总需参与人次)</em>=" + p + "<em>(余数)</em></p></li><li>3、计算结果：" + p + "<em>(余数)</em>+10000001=<span>" + q + "</span></p>" + (q != n ? '<li><p style="text-indent:-6.6em; padding-left:80px;">4、最终结果：' + q + " 未被购买，取差值最小的购买码 " + n + " 为幸运码</p></li>": "") + "</div></div>";
			
			}
 			//alert(k) 
            g.html(k)
        } else {
            g.html(Gobal.NoneHtml)
        }
    });
    var b = false;
    var e = false;
    var a = $("#btnCalMethod");
    var d = '<div class="infoRule"><p><em>01</em>取该商品最后购买时间前网站所有商品的最后100条购买时间记录；</p><p><em>02</em>每个时间记录按时、分、秒、毫秒依次排列取数值；</p><p><em>03</em>将这100个数值之和除以该商品总参与人次后取余数，余数加上10000000 即为“幸运码”。</p><b class="z-arrow"></b></div>';
    var f = function(i) {
        if (i && i.stopPropagation) {
            i.stopPropagation()
        } else {
            window.event.cancelBubble = true
        }
    };
    var h = $('<div class="cMask"></div>');
    a.click(function(i) {
        if (!b) {
            if (!e) {
                $(this).parent().after(d);
                g.prepend(h)
            } else {
                $(this).parent().next("div.infoRule").show()
            }
            h.show();
            e = true;
            b = true
        } else {
            $(this).parent().next("div.infoRule").hide();
            h.hide();
            b = false
        }
        f(i)
    });
    $("div.h5-1yyg-v1").click(function() {
        if (b) {
            a.parent().next("div.infoRule").hide();
            h.hide();
            b = false
        }
    })
});