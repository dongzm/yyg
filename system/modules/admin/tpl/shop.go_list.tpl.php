<?php defined('G_IN_ADMIN')or exit('No permission resources.'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台首页</title>
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
<link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
<style>
body{ background-color:#fff}
.a_button{color:#fff; font-weight:bold; cursor:pointer; text-decoration:none;border:1px solid #090;padding:5px; background-color:#0c0}
</style>
</head>
<body>
<div class="bk10"></div>
<div class="header-data lr10">
	<b>商品&nbsp;&nbsp;&nbsp;ID:</b><b style="color:red;padding-left:10px;"><?php echo $ginfo['id']; ?></b><br/>
    <b>商品期数:</b><b style="color:red; padding-left:10px;">第(<?php echo $ginfo['qishu']; ?>)期, 最大期数<?php echo $ginfo['maxqishu']; ?>期</b><br/>
    <b>商品标题:</b><b style="color:red;padding-left:10px;"><?php echo $ginfo['title']; ?></b><br/>
    <b>商品信息:</b><b style="color:red;padding-left:10px;"><?php 
		echo "总价格:".$ginfo['money']."&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "单价:".$ginfo['yunjiage']."&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "总需人次:".$ginfo['zongrenshu']."&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "参与人次:".$ginfo['canyurenshu']."&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "剩余人次:".$ginfo['shenyurenshu']."&nbsp;&nbsp;&nbsp;&nbsp;";

	?></b><br/>
    <b>开奖状态:</b><b style="color:red;padding-left:10px;">
		<?php if ( ($ginfo['q_uid'] || $ginfo['q_uid_a']) && ($ginfo['shenyurenshu']==0) ) {
					echo "已揭晓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					echo "中奖人: ".get_user_name($ginfo['q_uid'],'username','all')."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					echo "中奖云购码: ".$ginfo['q_user_code']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					echo "揭晓时间: ".date("Y-m-d H:i:s",$ginfo['q_end_time']);
		       }else if($ginfo['shenyurenshu']!=0 && $ginfo['xsjx_time'] == 0){
					echo "商品还在进行中...";
			   }else if($ginfo['shenyurenshu']==0 && $ginfo['xsjx_time'] != 0){
					echo "限时揭晓商品味道揭晓时间...";
			   }else if($ginfo['shenyurenshu']==0 && $ginfo['xsjx_time'] == 0){
				    echo "<a href='".G_MODULE_PATH."/content/goods_one_ok/".$ginfo['id']."' class='a_button'>手动揭晓</a>";
			   }
		?>
    
    </b>

    <!-- hyu-modify -->
    <br/>
    <b>指定奖码:</b>
    <b style="color:red;padding-left:10px;"><?php
	// hyu-debug
	//$postUname = $_POST["username"];
	//$postGcode = $_POST["goucode_assign"];
	//if ( strlen($postUname) > 0 ) {
        //  echo "[".$postUname."]&nbsp;[".$postGcode."]";
	//  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	//}

	$goucode_calc = $ginfo['q_user_code'];
        $goucode_assign = $ginfo['q_user_assign'];

        if ( strlen($goucode_assign) <= 0 ) {
	  echo "未指定";
	} else { 
	  echo "已指定";
	  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	  echo "中奖人： ".get_user_name($ginfo['q_uid_a'],'username','all');
	  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	  echo "中奖云购码： ".$goucode_assign;

	  if ( $ginfo['shenyurenshu'] > 0 ) {
	    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	    echo "<a href='javascript:FormClearAssign_Submit()' style='color:blue'>重置</a>";
	    echo "<p><form id='formclearassign' method='POST' action='".G_MODULE_PATH."/content/goods_go_one/".$ginfo['id']."'>";
	    echo "<input type='hidden' name='clearassign' value='clear' />";
	    echo "</form></p>";

	    echo "<script>";
	    echo "function FormClearAssign_Submit() {";
	    //echo "alert('FormClearAssign_Submit()')";
	    echo "document.forms['formclearassign'].submit()";
	    echo "}";
	    echo "</script>";
	  }
	} 
    ?>
    </b>

</div>
<div class="bk10"></div>
<div class="table-list lr10">
 <table width="100%" cellspacing="0">
     	<thead>
        		<tr>
                	<th width="10%">订单号</th>
                    <th width="20%">购买时间</th>        
                    <th width="10%">购买次数</th>    
                    <th width="25%"><?php
			// hyu-modify

			echo "<form method='POST' action='".G_MODULE_PATH."/content/goods_go_one/".$ginfo['id']."'>";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "购买人";
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo "<select name='userdisp' value='0'>";
		 	echo "<option value='0'>---</option>";

			$prev_uid = 0;
			foreach ( $go_list_alluser as $user ) {
			  if ( $prev_uid != $user['uid'] ) {
			    echo "<option value='".$user['uid']."'>".$user['username']."</option>";
			  }

			  $prev_uid = $user['uid'];
			}
	
			echo "</select>";
			echo "<input type='submit' value='Go' />"; 
			echo "</form>";
		    ?></th>             
                    <th width="15%">来自</th>

		    <!-- hyu-modify -->
		    <th width="20%"><?php
		      if ( $ginfo['q_uid'] && $ginfo['shenyurenshu']==0 ) {
			echo "中奖购码";
		      } else { 
		        echo "指定中奖购码";
		      } 
  		    ?></th>
		</tr>
        </thead>
        <tbody style="text-align:center">
        	<?php  foreach($go_list as $go){ ?>
        	<tr>
            	<td><?php echo $go['code']; ?></td>
                <td><?php echo date("Y-m-d H:i:s",$go['time']); ?></td>
                <td><?php echo $go['gonumber']; ?></td>
                <td><?php echo $go['username']; ?></td>
                <td><?php echo $go['ip']; ?></td>

		<!-- hyu-modify -->
		<td><?php 
		  //echo $go['goucode'];
		  $goucodeList = split( ',', $go['goucode'] );
		  sort( $goucodeList );

		  if ( $ginfo['q_uid'] && $ginfo['shenyurenshu']==0 ) {
		    foreach ( $goucodeList as $goucode ) {
		      if ( strlen($goucode_assign) > 0 ) {
			if ( $goucode == $goucode_assign ) {
			  echo $goucode;
			}
		      } elseif ( strlen($goucode_calc) > 0 ) {
			if ( $goucode == $goucode_calc ) {
			  echo $goucode;
			}
		      }
		    }
		  } else {
		    echo "<form method='POST' action='".G_MODULE_PATH."/content/goods_go_one/".$ginfo['id']."'>";
 		    echo "<select name='goucode_assign' value='".$goucodeList[0]."'>\n";
		    foreach ( $goucodeList as $goucode ) {
		      echo '<option value="'.$goucode.'">'.$goucode.'</option>\n';
		    }
		    echo "</select>\n";
		    echo "<input type='hidden' name='username' value='".$go['username']."'/>";
		    echo "<input type='hidden' name='uid' value='".$go['uid']."' />";
		    echo "<input type='submit' value='更改' />\n";
		    echo "</form>";
		  }
		?></td>

            </tr>
            <?php } ?>
            <?php if(!$go_list){ ?>
            <tr>
            	<td colspan="5">还没有购买记录！</td>
            </tr>
            <?php } ?>
        </tbody>
     </table>     


</div><!--table_list end-->
<div id="pages"><ul><li>共 <?php echo $total; ?> 条</li><?php echo $page->show('one','li'); ?></ul></div>
</body>
</html> 
