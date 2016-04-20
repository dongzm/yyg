<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=7" />
        <title>phpcms V9 - 后台管理中心</title>
        <link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/global.css" type="text/css">
            <link rel="stylesheet" href="<?php echo G_GLOBAL_STYLE; ?>/global/css/style.css" type="text/css">
                <link href="<?php echo G_TEMPLATES_CSS; ?>/vote/table_form.css" rel="stylesheet" type="text/css" />

                <link rel="stylesheet" href="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar-blue.css" type="text/css"> 
                    <script type="text/javascript" charset="utf-8" src="<?php echo G_PLUGIN_PATH; ?>/calendar/calendar.js"></script>
                    <script src="<?php echo G_GLOBAL_STYLE; ?>/global/js/jquery-1.8.3.min.js"></script>

                    </head>
                    <body>
                        <style type="text/css">
                            html{_overflow-y:scroll}
                        </style>

                        <div class="header lr10">
                            <?php echo $this->headerment(); ?>
                        </div>
                        <div class="pad_10">
                            <form action="" method="post" enctype="multipart/form-data" id="myform">
                                <table class="table_form">

                                    <tr>
                                        <!--<th style="text-align:left;" width="10">卡号</th>-->
                                        <th style="text-align:left;" width="10"><a id="sckh" href="javascript:void(0);"  >生成卡号</a></th>
                                        <th style="text-align:left;" width="10"><a id="scmm" href="javascript:void(0);"  >生成密码</a></th>
                                        <!--<th style="text-align:left;">密码</th>-->
                                        <th style="text-align:left;">面值</th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" id="ka0" name="czknum[]"size="30" class="input-text"></td>
                                        <td><input type="text" id="mm0" name="password[]"size="30" class="input-text"></td>
                                        
										<td>
											<select name="mianzhi[]">
												<option value="1">1</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</td>
                                        <td>
											<select name="type[]">
												<option value="1">一次性</option>
												<option value="2">体验</option>
											</select>
										</td>
                                    </tr>		
                                    <tr>
                                        <td><input type="text" id="ka1" name="czknum[]"size="30" class="input-text"></td>
                                        <td><input type="text" id="mm1" name="password[]"size="30" class="input-text"></td>
                                        										<td>
											<select name="mianzhi[]">
												<option value="1">1</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</td>
										                                        <td>
											<select name="type[]">
												<option value="1">一次性</option>
												<option value="2">体验</option>
											</select>
										</td>
                                    </tr>		
                                    <tr>
                                        <td><input type="text" id="ka2" name="czknum[]"size="30" class="input-text"></td>
                                        <td><input type="text" id="mm2" name="password[]"size="30" class="input-text"></td>
                                        										<td>
											<select name="mianzhi[]">
												<option value="1">1</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</td>
										                                        <td>
											<select name="type[]">
												<option value="1">一次性</option>
												<option value="2">体验</option>
											</select>
										</td>
                                    </tr>		
                                    <tr>
                                        <td><input type="text" id="ka3" name="czknum[]"size="30" class="input-text"></td>
                                        <td><input type="text" id="mm3" name="password[]"size="30" class="input-text"></td>
                                        										<td>
											<select name="mianzhi[]">
												<option value="1">1</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</td>
										                                        <td>
											<select name="type[]">
												<option value="1">一次性</option>
												<option value="2">体验</option>
											</select>
										</td>
                                    </tr>		
                                    <tr>
                                        <td><input type="text" id="ka4" name="czknum[]"size="30" class="input-text"></td>
                                        <td><input type="text" id="mm4" name="password[]"size="30" class="input-text"></td>
                                        										<td>
											<select name="mianzhi[]">
												<option value="1">1</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</td>
										                                        <td>
											<select name="type[]">
												<option value="1">一次性</option>
												<option value="2">体验</option>
											</select>
										</td>
                                    </tr>		
                                    <tr>
                                        <td><input type="text" id="ka5" name="czknum[]"size="30" class="input-text"></td>
                                        <td><input type="text" id="mm5" name="password[]"size="30" class="input-text"></td>
                                        										<td>
											<select name="mianzhi[]">
												<option value="1">1</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</td>
										                                        <td>
											<select name="type[]">
												<option value="1">一次性</option>
												<option value="2">体验</option>
											</select>
										</td>
                                    </tr>		
                                    <tr>
                                        <td><input type="text" id="ka6" name="czknum[]"size="30" class="input-text"></td>
                                        <td><input type="text" id="mm6" name="password[]"size="30" class="input-text"></td>
                                        										<td>
											<select name="mianzhi[]">
												<option value="1">1</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</td>
										                                        <td>
											<select name="type[]">
												<option value="1">一次性</option>
												<option value="2">体验</option>
											</select>
										</td>
                                    </tr>		
                                    <tr>
                                        <td><input type="text" id="ka7" name="czknum[]"size="30" class="input-text"></td>
                                        <td><input type="text" id="mm7" name="password[]"size="30" class="input-text"></td>
                                        										<td>
											<select name="mianzhi[]">
												<option value="1">1</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</td>
										                                        <td>
											<select name="type[]">
												<option value="1">一次性</option>
												<option value="2">体验</option>
											</select>
										</td>
                                    </tr>		
                                    <tr>
                                        <td><input type="text" id="ka8" name="czknum[]"size="30" class="input-text"></td>
                                        <td><input type="text" id="mm8" name="password[]"size="30" class="input-text"></td>
                                        										<td>
											<select name="mianzhi[]">
												<option value="1">1</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</td>
										                                        <td>
											<select name="type[]">
												<option value="1">一次性</option>
												<option value="2">体验</option>
											</select>
										</td>
                                    </tr>		
                                    <tr>
                                        <td><input type="text" id="ka9" name="czknum[]"size="30" class="input-text"></td>
                                        <td><input type="text" id="mm9" name="password[]"size="30" class="input-text"></td>
                                        										<td>
											<select name="mianzhi[]">
												<option value="1">1</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</td>
										                                        <td>
											<select name="type[]">
												<option value="1">一次性</option>
												<option value="2">体验</option>
											</select>
										</td>
                                    </tr>		
                                    <tr>
                                        <td><input type="text" id="ka10" name="czknum[]"size="30" class="input-text"></td>
                                        <td><input type="text" id="mm10" name="password[]"size="30" class="input-text"></td>
                                        										<td>
											<select name="mianzhi[]">
												<option value="1">1</option>
												<option value="10">10</option>
												<option value="50">50</option>
												<option value="100">100</option>
											</select>
										</td>
										                                        <td>
											<select name="type[]">
												<option value="1">一次性</option>
												<option value="2">体验</option>
											</select>
										</td>
                                    </tr>		
                                    <td>

                                        <input type="submit" name="submit" id="submit" value=" 提交 "></td>


                                </table>
                            </form>
                        </div>
                    </body>
                    </html>

                    <script language="javascript" type="text/javascript">
                        function AdsType(adstype) {
                            $('#SizeFormat').css('display', 'none');
                            if (adstype == '0') {

                            } else if (adstype == '1') {
                                $('#SizeFormat').css('display', '');
                            }
                        }
                        $('#AlignBox').click(function () {
                            if ($('#AlignBox').attr('checked')) {
                                $('#PaddingLeft').attr('disabled', true);
                                $('#PaddingTop').attr('disabled', true);
                            } else {
                                $('#PaddingLeft').attr('disabled', false);
                                $('#PaddingTop').attr('disabled', false);
                            }
                        });
                    </script>

                    <script language="javascript">
                        var i = 1;
                        function add_option() {
                            //var i = 1;
                            var htmloptions = '';
                            htmloptions += '<div id=' + i + '><span><br><input type="text" name="option[]" size="40" msg="必填" value="" class="input-text"/><input type="button" value="删除"  onclick="del(' + i + ')" class="button"/><br></span></div>';
                            $(htmloptions).appendTo('#new_option');
                            var htmloptions = '';
                            i = i + 1;
                        }
                        function del(o) {
                            $("div [id=\'" + o + "\']").remove();
                        }

                        /* function load_file_list(id) {
                         $.getJSON('?m=admin&c=category&a=public_tpl_file_list&style='+id+'&module=vote&templates=vote_tp&name=vote_subject&pc_hash='+pc_hash, function(data){$('#show_template').html(data.vote_tp_template);});
                         } */
                    </script>
                        <script type="text/javascript">
                             //生成卡号
                            $('#sckh').click(function () {
								$.getJSON("/?/czk/vote_admin/sckh", function(data){
								  $.each(data, function(i,item){
                                        $(data).each(function (i, val) {
                                            $('#ka' + i).val(val);
                                        });
								  });
								});
                            });
                            //生成密码
                            $('#scmm').click(function () {
								$.getJSON("/?/czk/vote_admin/sckh", function(data){
								  $.each(data, function(i,item){
                                        $(data).each(function (i, val) {
                                            $('#mm' + i).val(val);
                                        });
								  });
								});
                            });
                        </script>