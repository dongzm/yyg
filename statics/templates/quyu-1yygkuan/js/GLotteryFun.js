				function gg_show_Time_fun(times,objc,uhtml,data){		
					time = times - (new Date().getTime());
					i =  parseInt((time/1000)/60);
					s =  parseInt((time/1000)%60);
					ms =  String(Math.floor(time%1000));
					ms = parseInt(ms.substr(0,2));
					if(i<10)i='0'+i;
					if(s<10)s='0'+s;
					if(ms<0)ms='00';
					objc.html('<b class="minute">'+i+'</b>:<b class="second">'+s+'</b>:<b class="millisecond">'+ms+'</b>');				
	
					if(time<=0){
						
						var obj = objc.parent().parent();							
							obj.find(".u-time").html('<b class="lateron">正在计算,请稍后…</b>');	
							 setTimeout(function(){
								obj.html(uhtml);						
								obj.attr('class',"new_li");
								$.ajaxSetup({
									async : false
								});								
								$.post(data['path']+"/api/getshop/lottery_shop_set/",{'lottery_sub':'true','gid':data['id']},null);
							},5000);							 
							return;						
					}
					
					 setTimeout(function(){										 	
							gg_show_Time_fun(times,objc,uhtml,data);				 
					 },30); 
				
				}
				function gg_show_time_add_li(div,path,info){	
				
					var html = '';
					html+='<li class="current">';
						html+='<dl class="m-in-progress">';
						html+='<dt>';
						html+='<a href="'+path+'/dataserver/'+info.id+'.html" target="_blank" class="pic">';
							html+='<img src="'+info.upload+'/'+info.thumb+'">';
						html+='</a>';
						html+='</dt>';
						html+='<dd class="u-name">';
					html+='<a href="'+path+'/dataserver/'+info.id+'.html" target="_blank" class="name">'+info.title+'</a>';
						html+='</dd>';
						html+='<br />';
					html+='<dd class="u-time" id="dd_time">';
						html+='<em>揭晓倒计时</em>';
						html+='<span class="shi"><b class="minute">0</b>:<b class="second">0</b>:<b class="millisecond">0</b></span>';
					html+='</dd>';
					html+='<s></s>';
					html+='</dl>';
					html+='</li>';
					var uhtml = '';
						uhtml += '<li>';
						uhtml += '<dl>';
						uhtml += '<dt>';
						uhtml += '<a href="'+path+'/dataserver/'+info.id+'.html" target="_blank" class="pic">';
							uhtml +='<img src="'+info.upload+'/'+info.thumb+'">';
						uhtml +='</a>';
						uhtml +='</dt>';
						uhtml +='<dd class="f-gx">';
						uhtml +='<div class="f-gx-user">';
						uhtml +='<span>恭喜</span><span class="blue">';
						uhtml+=info.user;
						uhtml+='</span>';
						uhtml+='<span>获得</span>';
						uhtml+='</div>';
						uhtml+='</dd>';
						uhtml+='<br />';
						uhtml+='<dd class="u-name"><a href="'+path+'/dataserver/'+info.id+'.html" target="_blank" class="name">'+info.title+'</a></dd>';
					uhtml+='</dl>';
					uhtml+='<cite style="display: inline;"></cite>';
					uhtml+='</li>';

					var divl = $("#"+div).find('li');
					var len = divl.length;			
					if(len==4 && len  >0){
						var this_len = len - 1;
						//divl[this_len].remove();
						divl.eq(this_len).remove();
					}			
					$("#"+div).prepend(html);					
					//var div_li_obj = $(".current").eq(0).find(".shi");
					var div_li_obj = $(".current .shi").eq(0);
					//setInterval(function(){gg_show_Time_fun(div_obj,info.times);},123);
					var data = new Array();
						data['id'] = info.id;
						data['path'] = path;							
					info.times = (new Date().getTime())+(parseInt(info.times))*1000;					
					gg_show_Time_fun(info.times,div_li_obj,uhtml,data,info.id);				
				}//	
				
				function gg_show_time_init(div,path,gid){	
					window.setTimeout("gg_show_time_init()",5000);	
					if(!window.GG_SHOP_TIME){	
						window.GG_SHOP_TIME = {
							gid : '',
							path : path,
							div : div,
							arr : new Array()
						};
					}
					$.get(GG_SHOP_TIME.path+"/api/getshop/lottery_shop_json/"+new Date().getTime(),{'gid':GG_SHOP_TIME.gid},function(indexData){																									
							var info = jQuery.parseJSON(indexData);		
							
							if(info.error == '0' && info.id != 'null'){							
								if(!GG_SHOP_TIME.arr[info.id]){
											GG_SHOP_TIME.gid =  GG_SHOP_TIME.gid +'_'+info.id;		
											GG_SHOP_TIME.arr[info.id] = true;											
											gg_show_time_add_li(GG_SHOP_TIME.div,GG_SHOP_TIME.path,info);							
								}			
							}			
					});	
						
				}