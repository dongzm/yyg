<?php
/**
* 财付通支付接口
* 请求地址生成
*
* @param string $key - 商户密钥,由财付通分配
* @param string $desc - 商品名称
* @param int $mid - 商户编号,由财富通分配
* @param int $oid - 商家订单号(小于等于32位)
* @param int $pri - 商品金额(单位：分)
* @param int $url - 请求返回处理地址
* @param mixed $attach - 商户附加参数(用户完全自定义,任意格式,任意数据,财付通在回调时会原样返回)
* @param int $cs - 字符集编码(可保留默认,不同编码会导致显示乱码,对支付过程无任何影响,仅支持utf-8、gbk)
*
*/  
function makeUrl($key,$desc,$mid,$oid,$pri,$url,$attach='test',$cs='utf-8') {   
    $data = array();   
     # 任务代码   
    $data['cmdno'] = 1; 
     # 日期   
    $data['date'] = date('Ymd');   
     # 商户号   
    $data['bargainor_id'] = $mid;   
     # 财付通交易单号   
    $data['transaction_id'] = $mid.$data['date'].rand(1000000000,9999999999);   
     # 商家订单号   
    $data['sp_billno'] = $oid;   
     # 商品价格   
    $data['total_fee'] = $pri;   
     # 货币类型   
    $data['fee_type'] = 1;     
     # 返回 URL   
    $data['return_url'] = $url;   
     # 自定义参数(用户完全自定义，任意格式，任意数据)   
    $data['attach'] = $attach;   
     # 用户 IP   
    $data['spbill_create_ip'] = '';   
     # 商户密钥   
    $data['key'] = $key;   
	
    $data['sign'] = md5(urldecode(http_build_query(array_filter($data))));    
    $data['cs'] = !in_array(strtolower(strtr($cs,'-',null)),array('utf8','gbk')) ? 'utf-8': strtolower($cs);   
    $data['bank_type'] = 0;   
    $data['desc'] = $desc;     
    ksort($data);   
  
    $reqUrl = 'https://www.tenpay.com/cgi-bin/v1.0/pay_gate.cgi?'.http_build_query($data);   
  
    return $reqUrl;   
}   
  
