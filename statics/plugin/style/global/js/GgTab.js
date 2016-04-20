(function(window){
		  
 var
	document = window.document,
	$Id=function(id){       
        return typeof id==='string'? document.getElementById(id):id;
    },
	
    $TagName=function(tag,name){        
        if(-[1,])
            return document.getElementsByName(name);
        else
        var returns = new Array();
        var e = document.getElementsByTagName(tag);
        for(var i = 0; i < e.length; i++){
            if(e[i].getAttribute("name") == name){
                returns[returns.length] = e[i];
            }
        }
        return returns;
    },
    $AddClass=function(obj,str){
        if(!obj.className.match(new RegExp('(\\s|^)' + str + '(\\s|$)'))){          
             obj.className += ' ' + str;
        }
    },
    $DelClass=function(obj,str){
        if(obj.className.match(new RegExp('(\\s|^)' + str + '(\\s|$)'))){   
             var reg = new RegExp('(\\s|^)' + str + '(\\s|$)'),newClass = obj.className.replace(reg, ' ');
             obj.className = newClass.replace(/^\s+|\s+$/g, '');
        }
    },
    $IsType=function(obj){
        return (type === "Null" && obj === null) || 
        (type === "Undefined" && obj === void 0 ) || 
        (type === "Number" && isFinite(obj)) || 
        Object.prototype.toString.call(obj).slice(8,-1) === type; 
    },
    $IsArray=function(obj){
        return Object.prototype.toString.call(obj) === '[object Array]'; 
    },
    $IsJson=function(obj){
         return typeof(obj) == "object" && Object.prototype.toString.call(obj).toLowerCase() == "[object object]" && !obj.length; 
    },	
	$demo=function(s){alert(s);}
	Gg=function(){return new Gg.Construct(arguments);};
	/*Gg.prototype={	
			demo:$demo,
			id:$Id,
			tagname:$TagName,
			addclass:$AddClass,
			delcalss:$DelClass,
			istype:$IsType,
			isarray:$IsArray,
			isjson:$IsJson,
	};*/
	Gg.demo=$demo;
    Gg.Tab=function(){

        var ts=this;
        if(!$IsJson(arguments[0])) return;
        var str=arguments[0];
        if($IsArray(str.i))
            ts.Config.i=str.i;
        else
            ts.Config.i=this.GetObjList(str.i,'i');
        if($IsArray(str.o))
            ts.Config.o=str.o;
        else
            ts.Config.o=this.GetObjList(str.o,'o');
  
        if(str.num!=null){ts.Config.num=str.num-1;}     
        if(str.events!=null && str.events!='')ts.Config.events=str.events;  
           
        if(this.Config.style['i']!==undefined)
            if(ts.Config.i[ts.Config.num]!==undefined)
                $AddClass(ts.Config.i[ts.Config.num],this.Config.style['i']);
        for (var j = 0;j < this.Config.o.length; j++){           
            ts.Config.o[j].style.display='none';
        }
        if(ts.Config.o[ts.Config.num]!==undefined)
            ts.Config.o[ts.Config.num].style.display='block';
        if(this.Config.style['o']!==undefined)  
            if(ts.Config.o[ts.Config.num]!==undefined)
                $AddClass(ts.Config.o[ts.Config.num],this.Config.style['o']);
        if(str.events=='click'){
               for (var k = 0;k < this.Config.i.length; k++){
                    ts.Config.i[k].setAttribute('WgTabn',k);
                    ts.Config.i[k].onclick=function(){ts.fn(this);}
               }
        }
        return this;
    };  
    Gg.GetObjList=function(string,name){ 
        var _tempA=Array(); 　　    
        var _tempD=string;
            _tempD=_tempD.replace(/(^\s*)|(\s*$)/g,"");
            _tempD=_tempD.replace(/(~$)/g,"");
            _tempD=_tempD.replace(/(^\s*)|(\s*$)/g,"");
            _tempA=_tempD.split(' ');           
        if(_tempA[2]!==undefined){
            _tempD=_tempA[2].replace(/(^~)/g,"");
            _tempD=_tempD.replace(/(\|$)/g,"");
            _tempD=_tempD.replace(/(\|)/g," ");
            this.Config.style[name]=_tempD; 
        }else{
            this.Config.style[name]=null;
        }
        return $TagName(_tempA[0],_tempA[1]);
           
    };  
    Gg.fn=function(t){
         var n=t.getAttribute('WgTabn');    
         for (var j = 0;j < this.Config.i.length; j++){
             $DelClass(this.Config.i[j],this.Config.style['i']);
         }
         $AddClass(t,this.Config.style['i']);
         for (var i = 0;i < this.Config.o.length; i++){
             this.Config.o[i].style.display='none';
         }
         if(this.Config.o[n]!==undefined){
            this.Config.o[n].style.display='block';
            $AddClass(this.Config.o[n],this.Config.style['o']);}        
           
    };
    Gg.Construct=function(){		
		arguments=arguments[0]; 
        var  d=document; var obj = Array; 
        var  x=arguments[0].charAt(0);
        var  c=arguments[0].substr(1);
        //var  l=d.getElementsByTagName('*');   
        return this;
    };
    Gg.Config={events:'click',style:Array,num:1};
    Gg.version='1.2'; 
	window.Gg = Gg;	
})(window);

/*
(function(Gg){
	Gg.extend.al=function(){
		alert(Gg.prototype.name);	
	}  
		  
})(Gg)
*/