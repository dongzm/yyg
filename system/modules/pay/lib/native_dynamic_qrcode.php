<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>微信扫码支付</title>
    <link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE?>/css/Comm_weixin.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_STYLE?>/css/WeixinPay.css" />
    <script language="javascript" type="text/javascript" src="<?php echo G_GLOBAL_STYLE; ?>/global/js/weixin/JQuery132.js"></script>
    <script language="javascript" type="text/javascript">
        $(function () { var e = $("#qr_box"); var c = $("#guide"); c.css({ left: "50%", opacity: 0 }); e.hover(function () { c.css("display", "block").stop().animate({ marginLeft: "+156px", opacity: 1 }, 900, "swing", function () { c.animate({ marginLeft: "+143px" }, 300) }) }, function () { c.stop().animate({ marginLeft: "-101px", opacity: 0 }, "400", "swing", function () { c.hide() }) }); var d = $("#hidShopID").val(); var b = 0; var a = function () { $.getJSON("http://account.1yyg.com/JPData/API.ashx?action=getwxpayresult&id=" + d + "&fun=?", function (f) { if (f.state == 0) { if ($("#hidIsBuyPay").val() == "0") { location.replace("http://member.1yyg.com/userbalance.html") } else { location.replace("http://www.1yyg.com/mycart/shopok.html?id=" + d) } } else { b++; setTimeout(a, 3000 + parseInt(b / 20) * 1000) } }) }; setTimeout(a, 10000) });
    </script>	
</head>
<body>
    <input name="hidShopID" type="hidden" id="hidShopID" value="141027161101330617" />
    <input name="hidIsBuyPay" type="hidden" id="hidIsBuyPay" value="1" />
    <div class="wx_header">
        <div class="wx_logo"><img title="一元云购微信支付" alt="微信支付标志" src="<?php echo G_TEMPLATES_STYLE?>/images/wxlogo_pay.png" /></div>
    </div>
    <div class="weixin">
        <div class="weixin2">
            <b class="wx_box_corner left pngFix"></b><b class="wx_box_corner right pngFix"></b>
            <div class="wx_box pngFix">
                <div class="wx_box_area">
                    <div class="pay_box qr_default">
                        <div class="area_bd"><span class="wx_img_wrapper"  id="qr_box">
                           <div align="center" id="qrcode" class="ewm_wrapper"></div>
						   <div id="resmsgdiv"></div>
                            <img style="left: 50%; opacity: 0; display: none; margin-left: -101px;" class="guide pngFix" src="<?php echo G_TEMPLATES_STYLE?>/images/wxwebpay_guide.png" alt="" id="guide" />
                        </span>
                            <div class="msg_default_box"><i class="icon_wx pngFix"></i>
                                <p>
                                    请使用微信扫描<br/>
                                    二维码以完成支付
                                </p>
                            </div>
                            <div class="msg_box"><i class="icon_wx pngFix"></i>
                                <p><strong>扫描成功</strong>请在手机确认支付</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wx_hd">
                    <div class="wx_hd_img icon_wx"></div>
                </div>
                <div class="wx_money"><span>￥</span><?php echo $config['money'];?></div>
                <!--支付订单号-->
                <div class="wx_pay">
                    <p><span  class="wx_left">支付订单号</span>
					<span id="dingdan"  ddcode="<?php echo $config['code'];?>"  class="wx_right" ><?php echo $config['code'];?></span></p>
					 <p><span  class="wx_left">订单时间</span>
					<span  class="wx_right" ><?php echo date("Y-m-d H:i:s",time());?></span></p>
                    <p><span class="wx_left">商品名称</span><span class="wx_right">云购商品</span></p>
                </div>
                <div class="wx_kf">
                    <div class="wx_kf_img icon_wx"></div>
                    <div class="wx_kf_wz">
                        <p><?php echo _cfg('web_name');?></p>
                        <p><?php echo _cfg('cell');?></p>
                    </div>
                </div>
            </div>
        </div>
    </div> 

	<script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/weixin/qrcode.js"></script>
	<script>
		if(<?php echo $unifiedOrderResult["code_url"] != NULL; ?>)
		{
			var url = "<?php echo $code_url;?>";
			//参数1表示图像大小，取值范围1-10；参数2表示质量，取值范围'L','M','Q','H'
			var qr = qrcode(10, 'M');
			qr.addData(url);
			qr.make();
			var wording=document.createElement('p');
			wording.innerHTML = "支付完成前，请勿关闭此页面！";
			var code=document.createElement('DIV');
			code.innerHTML = qr.createImgTag();
			var element=document.getElementById("qrcode");
			element.appendChild(wording);
			element.appendChild(code);
		}
	</script>
    <script>
		var d=$("#dingdan").attr("ddcode");
			setInterval(function(){
			  $.ajax({
			    url:'<?php echo WEB_PATH;?>/pay/wxpay_url/houtai/',
				type: "post", 		 
				dataType: "json",  
				data: {out_trade_no:d},  				
				async : true,
				success: function(res){
				    if(res.code!=999){
						if(res.code==4){
						   $("#resmsgdiv").addClass("success1");
						   $("#resmsgdiv").text(res.msg);
						   setTimeout(function(){window.close();},5000);
							
						}else{
							$("#resmsgdiv").addClass("success1");
							$("#resmsgdiv").text(res.msg);
							setTimeout(function(){window.close();},5000);
						}
					}
					
				}			  
			  });			
			},5000);
		</script>	

</body>
</html>
