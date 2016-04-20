<?php defined('G_IN_SYSTEM')or exit('No permission resources.'); ?><?php include templates("index","header");?>
<link rel="stylesheet" type="text/css" href="<?php echo G_TEMPLATES_CSS; ?>/ygRecord.css"/>
<link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
<script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
<div class="ygRecord">
	<h3><span>历史<?php echo _cfg('web_name_two'); ?>记录</span><p><a href="<?php echo WEB_PATH; ?>/buyrecordbai">查看最新<?php echo _cfg('web_name_two'); ?>记录&gt;&gt;</a></p></h3>
	<div class="border"></div>
	<div class="RecordSearch">
    	<form action="" method="post">
        <div class="from">
            <p>起止时间</p>
           <input value="<?php echo date("Y-m-d"); ?>" id="txtFirstT1" name="start_time_data" class="time" readonly="readonly" type="text">     
			<script type="text/javascript">
				date = new Date();
				Calendar.setup({
					inputField     :    "txtFirstT1",
					ifFormat       :    "%Y-%m-%d",
					showsTime      :    true,
					timeFormat     :    "24"
				});
			</script>	
           <select id="sltFirstT2" name="start_time_h">
				<?php 				
					for($i=0;$i<23;$i++){						
						if($i==($this_time_h-2)){
							$selecteds = ' selected="selected"';
						}else{
							$selecteds = '';
						}
						if($i<10)$i='0'.$i;
				 ?>
				<option value="<?php echo $i; ?>"<?php echo $selecteds; ?>><?php echo $i; ?></option>
				<?php  }  ?>
			</select>
            <p>时</p>
           <select id="sltFirstT3" name="start_time_i">
				<?php 								
					for($i=0;$i<60;$i++){		
						if($i==$this_time_i){
							$selecteds = ' selected="selected"';
						}else{
							$selecteds = '';
						}
						if($i<10)$i='0'.$i;
				 ?>
				<option value="<?php echo $i; ?>"<?php echo $selecteds; ?>><?php echo $i; ?></option>
				<?php  }  ?>
		  </select>
            <p>分&nbsp;&nbsp;&nbsp;至</p>
        </div>        
        <div class="over">
		   <input value="<?php echo date("Y-m-d"); ?>" name="end_time_data"  id="txtEndT1" class="time" readonly="readonly" type="text">	
           <script type="text/javascript">
				date = new Date();
				Calendar.setup({
					inputField     :    "txtEndT1",
					ifFormat       :    "%Y-%m-%d",
					showsTime      :    true,
					timeFormat     :    "24"
				});
			</script>	
            		
           <select id="sltEndT2" name="end_time_h">
				<?php 				
					for($i=0;$i<23;$i++){						
						if($i==$this_time_h){
							$selecteds = ' selected="selected"';
						}else{
							$selecteds = '';
						}
						if($i<10)$i='0'.$i;
				 ?>
				<option value="<?php echo $i; ?>"<?php echo $selecteds; ?>><?php echo $i; ?></option>
				<?php  }  ?>				
			</select>
            <p>时</p>
            <select id="sltEndT3" name="end_time_i">
				<?php 								
					for($i=0;$i<60;$i++){		
						if($i==$this_time_i){
							$selecteds = ' selected="selected"';
						}else{
							$selecteds = '';
						}
						if($i<10)$i='0'.$i;
				 ?>
				<option value="<?php echo $i; ?>"<?php echo $selecteds; ?>><?php echo $i; ?></option>
				<?php  }  ?>
			</select>
            <p>分</p>
        </div>
				<input id="btnQuery" class="Recordcx" value="查询"  name="dosubmit" type="submit">
				<span id="spanServerTime" style="display:none">2013-10-22 08:52:53</span>
	</div>
	<div id="recordList">
		<ul class="Record_title">
			<li class="time"><?php echo _cfg('web_name_two'); ?>时间</li>
			<li class="nem">会员账号</li>
			<li class="name"><?php echo _cfg('web_name_two'); ?>商品名称</li>
			<li class="much"><?php echo _cfg('web_name_two'); ?>人次</li>
		</ul>
        <?php $n=1; ?>    
        <?php $ln=1;if(is_array($RecordList)) foreach($RecordList AS $Record): ?>
        <?php 
        	$n++;
        	$Record['time'] = explode(".",$Record['time']);
            if($n%2==0){$class='Record_content';}else{$class='Record_contents';}
         ?>            
		<ul class="<?php echo $class; ?>">
			<li class="time"><?php echo date("Y-m-d H:i:s",$Record['time'][0]); ?>.<?php echo $Record['time']['1']; ?></li>
			<li class="nem"><a class="blue" href="<?php echo WEB_PATH; ?>/uname/<?php echo $Record['uid']; ?>" target="_blank"><?php echo $Record['username']; ?></a></li>
			<li class="name"><a href="<?php echo WEB_PATH; ?>/goods/<?php echo $Record['shopid']; ?>">（第<?php echo $Record['shopqishu']; ?>期）<?php echo _strcut($Record['shopname'],60,null); ?></a></li>
			<li class="much"><?php echo $Record['gonumber']; ?>人次</li>
		</ul>
        <?php  endforeach; $ln++; unset($ln); ?>   
        
         <div class="page_nav">
            <ul class="pageULEx">
            </ul>
         </div>
        
	</div>
</div>
<?php include templates("index","footer");?>