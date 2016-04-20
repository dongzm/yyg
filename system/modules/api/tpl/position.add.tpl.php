<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
tr{height:40px;line-height:40px}
</style>
</head>
<body>
<div class="header lr10">
	<?php echo $this->headerment();?>
</div>
<div class="bk10"></div>
<div class="table-list lr10">
<!--start-->
<form name="myform" action="" method="post">
  <?php if(ROUTE_A == 'add'): ?>
  <table width="100%" cellspacing="0">
  	<tr>
		<td width="220" align="right"><font color="red">*</font>推荐位模型：</td>
		<td>
      		<select name="pos_model">
            	<option value="0">请选择模型</option>
                <?php foreach($models as $model): ?>
                <option value="<?php echo $model['modelid']?>"><?php echo $model['name']?></option>
                <?php endforeach; ?>
            </select>        
        </td>
	</tr>
  	<tr>
		<td width="220" align="right"><font color="red">*</font>推荐位名称：</td>
		<td><input type="text" name="pos_name" value=""  class="input-text wid200"></td>
	</tr>
  	 <tr>
			<td width="220" align="right"><font color="red">*</font>显示条数：</td>
			<td><input type="text" name="pos_num" class="input-text wid80">
            <span> 该推荐位前端显示多少条数据 不能超过最大保存条数</span>
            </td>
	</tr>
    <tr>
			<td width="220" align="right"><font color="red">*</font>最大保存条数：</td>
			<td><input type="text" name="pos_maxnum" class="input-text wid80">
            	<span> 该推荐位最多能保存多少条数据 不能超过 250</span>
            </td>
	</tr>	
    <tr>
        	<td width="220" align="right"></td>
            <td><input type="submit" class="button" name="dosubmit"  value=" 添加推荐位 " ></td>
   </tr>
</table>
<?php else: ?>
  <table width="100%" cellspacing="0">
  	<tr>
		<td width="220" align="right"><font color="red">*</font>推荐位模型：</td>
		<td>
      		<select name="pos_model">
            	<option value="0">请选择模型</option>
                <?php foreach($models as $model): ?>     
                 <?php if($model['modelid'] == $posinfo['pos_model']): ?>
                 <option value="<?php echo $model['modelid']; ?>" selected><?php echo $model['name']?></option>
                 <?php endif; ?>         
                <option value="<?php echo $model['modelid']; ?>"><?php echo $model['name']?></option>
                <?php endforeach; ?>                
            </select>        
        </td>
	</tr>
  	<tr>
		<td width="220" align="right"><font color="red">*</font>推荐位名称：</td>
		<td><input type="text" name="pos_name" value="<?php echo $posinfo['pos_name']; ?>"  class="input-text wid200"></td>
	</tr>
  	 <tr>
			<td width="220" align="right"><font color="red">*</font>显示条数：</td>
			<td><input type="text" name="pos_num" value="<?php echo $posinfo['pos_num']; ?>" class="input-text">
            <span> 该推荐位前端显示多少条数据 不能超过最大保存条数</span>
            </td>
	</tr>
    <tr>
			<td width="220" align="right"><font color="red">*</font>最大保存条数：</td>
			<td><input type="text" name="pos_maxnum" value="<?php echo $posinfo['pos_maxnum']; ?>" class="input-text">
            	<span> 该推荐位最多能保存多少条数据 不能超过 250</span>
            </td>
	</tr>	
    <tr>
        	<td width="220" align="right"></td>
            <td><input type="submit" class="button" name="dosubmit"  value=" 修改推荐位 " ></td>
   </tr>
</table>
<?php endif; ?>
</form>

</div><!--table-list end-->

<script>	
</script>
</body>
</html> 