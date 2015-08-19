<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/1/27
 * Time: 下午8:40
 */

class XMLDataBase extends DomDocument{
    var $dbname; //属性 数据库文件名 同根元素名称
    var $dbpath; //属性 数据库路径
    //var $debug;  //属性 调试标志
    var $debug=true;//开启调试模式
    public function XMLDataBase($dbname,$dbpath){ //构造函数
        if(empty($dbname)){
            if($this->debug)echo "创建数据库文件失败，请检查实例参数";
            return false;
        }else{
            $this->dbname = $dbname; //将数据库命名为指定名称
            $this->dbpath = $dbpath; //为数据指定路径
            if(!file_exists($dbpath."/".$this->dbname.".xml")){ //如果没有数据库文件
                $xmlstr = '<?xml version="1.0" encoding="utf-8"?><'.$this->dbname.' sn="0"/>';
                $this->loadXML($xmlstr);
                $this->save($dbpath."/".$this->dbname.".xml"); //创建数据库文件
            }
            $this->load($dbpath."/".$this->dbname.".xml"); //加载数据库文件
        }
        return true;
    }

    //插入数据
    public function insert_xml($myfields,$values,$mytype){
        if(empty($mytype)){ //如果类型为空，返回跟节点
            $Root = $this->documentElement;
        }else{
            $Root = $this->getElementsByTagName($mytype); //取得$mytype节点
            $Root = $Root->item(0);
            if(empty($Root->nodeValue)){ //判断$mytype节点为空则建立之, empty() 这个变量存在吗？不存在就对了！！
                $this->InserTabeNode($mytype);
                $Root = $this->getElementsByTagName($mytype);
                $Root = $Root->item(0);
            }
        }
        $arrfield = explode("#cut#", $myfields);
        $arrval = explode("#cut#", $values);
        //获取插入记录
        $AutoID = $this->AutoKey();
        $Node_AutoID= $this->createElement("autoid");
        $text= $this->createTextNode($AutoID);
        $Node_AutoID->appendChild($text);
        $i=0;
        foreach($arrfield as $myfield){
            ${"Node_".$myfield} = $this->createElement($myfield);
            $text = $this->createTextNode($arrval[$i]);
            ${"Node_".$myfield}->appendChild($text);
            $i++;
        }
        //建立一条记录
        $Node_record = $this->createElement("record");
        $Node_record->appendChild($Node_AutoID);
        foreach($arrfield as $fieldn){
            $Node_record->appendChild(${"Node_".$fieldn});
        }
        //加入到$dbtable结点下
        $Root->appendChild($Node_record);
        //更新 根节点SN
        $this->documentElement->setAttribute("sn","$AutoID");
        //保存
        $this->save($this->dbpath."/".$this->dbname.".xml");
        return true;
    }

    //修改记录
    public function update_xml($AutoID,$mytype){
        if(empty($mytype)){ //如果类型为空，返回跟节点
            $Root = $this->documentElement;
            $xpath = new DOMXPath($this);
            $Node_Record = $xpath->query("//record[autoid=$AutoID]");
        }else{
            $Root = $this->getElementsByTagName($mytype); //取得$mytype节点
            $Root = $Root->item(0);
            $xpath = new DOMXPath($this);
            $Node_Record = $xpath->query("/$this->dbname/$mytype/record[autoid=$AutoID]");
        }//end if

        if(empty($Node_Record->item(0)->nodeName)) echo "<p>没有查询到要修改的记录</p>\r\n";
        $K=0;
        foreach ($Node_Record->item($K)->childNodes as $articles){
            $Field[$K]=$articles->textContent;
            echo "<div>$articles->nodeName<input type=text name='$articles->nodeName' value='$Field[$K]' size=20></div>\r\n";
            $K++;
        }
    }

    //保存记录
    public function besave_xml($AutoID,$values,$mytype){
        if(empty($mytype)){ //如果类型为空，返回跟节点
            $Root = $this->documentElement;
            $xpath = new DOMXPath($this);
            $Node_Record = $xpath->query("//record[autoid=$AutoID]");
        }else{
            $Root = $this->getElementsByTagName($mytype); //取得$mytype节点
            $Root = $Root->item(0);
            $xpath = new DOMXPath($this);
            $Node_Record = $xpath->query("/$this->dbname/$mytype/record[autoid=$AutoID]");
        }//end if
        if(empty($Node_Record->item(0)->nodeValue)){ //如果记录不存在
            if($this->debug)echo "<p>AutoID={$AutoID}的记录不存在于{$mytype}节点中，请检查传入参数！<p>";
            return false;
        }
        $Replace = explode("#cut#", $values);
        $temparr=array_reverse($Replace);
        //array_push($temparr,$AutoID);
        $temparr[]=$AutoID;  //用 array_push() 来给数组增加一个单元，还不如用 $array[] = ，因为这样没有调用函数的额外负担。 --By PHP Manual
        $Replace=array_reverse($temparr);
        $K=0;
        //修改
        foreach ($Node_Record->item(0)->childNodes as $articles){
            $Node_newText = $this->createTextNode($Replace[$K]);
            $articles->replaceChild($Node_newText,$articles->lastChild);//*************** 有点疑问
            $K++;
        }
        $this->save($this->dbpath."/".$this->dbname.".xml");
        return true;
    }

    //筛选或者统计
    public function select_xml($sfield,$keyword,$mytype,$rows,$isonly){
        //$sfield 指定字段 $mytype分类名称 $rows循环输出时指定记录条数 $isonly判断指定关键字记录是否存在
        if($sfield == '') $sfield='autoid'; //设定字段默认值
        //if($keyword=='') $keyword='1';
        $xpath = new DOMXPath($this);
        //if(empty($keyword)) return 0;
        if($mytype == ''){
            $querystr = "//record[contains($sfield,'$keyword')]";
            $Node_Record = $xpath->query($querystr);
        }else{
            $querystr = "/$this->dbname/$mytype/record[contains($sfield,'$keyword')]";
            $Node_Record = $xpath->query($querystr);
        }//end if
        $Node_Record_Length = $Node_Record->length; //取得记录总数
        if($isonly==1){
            if($Node_Record_Length>0) return 999;
        }

        //循环输出字段及其内容
        if($Node_Record_Length < 1) return 0;
        $rerows = array(); //记录集数组
        $rerow = array();  //单条记录数组
        for($i=0;$i<$Node_Record_Length;$i++){
            $K=0;
            foreach ($Node_Record->item($i)->childNodes as $articles){
                $Field[$K]=$articles->textContent;
                $rerow["$articles->nodeName"] = $Field[$K]; //节点名 => 节点值 推入数组
                $K++;
            }
            $rerows[$i]=$rerow;
        }//for end
        //不知道还有没有更好的方法反序结果
        $echorows=array_reverse($rerows); //反序排列返回的数组
        $countall=count($echorows);   //统计数组记录总数
        if($rows>0)$countall=$rows; //如果指定行数 更改数据总数
        if($rows>count($echorows))$countall=count($echorows); //如果指定行数大于总数 则总数不变
        $myrs=array(); //新建的记录集数组
        for($j=0;$j<$countall;$j++){ //循环反序以后的数组
            $myrs[$j]=$echorows[$j]; //推入新建的记录集数组
        }
        return $myrs;
    }

    public function delete_xml($AutoID,$mytype){ //根据分类 和ID删除记录
        if(empty($mytype)){ //如果类型为空，返回跟节点
            $Root = $this->documentElement;
            $xpath = new DOMXPath($this);
            $Node_Record = $xpath->query("//record[autoid=$AutoID]");
        }else{
            $Root = $this->getElementsByTagName($mytype); //取得$mytype节点
            $Root = $Root->item(0);
            $xpath = new DOMXPath($this);
            $Node_Record = $xpath->query("/$this->dbname/$mytype/record[autoid=$AutoID]");
        }
        //查询选择删除的记录
        if(empty($Node_Record->item(0)->nodeValue)){ //如果记录不存在
            if($this->debug)echo "<p>AutoID={$AutoID}的记录不存在于{$mytype}节点中，请检查传入参数！<p>"; //输出相应信息
            return false; //返回假
        }
        $Root->removeChild($Node_Record->item(0)); //在节点中移除
        $this->save($this->dbpath."/".$this->dbname.".xml");
        return true; //返回真
    }

    //插入类别节点
    public function InserTabeNode($mytype){
        $Root = $this->documentElement;
        $Node_record = $this->createElement($mytype);
        $Root->appendChild($Node_record);
        $this->save($this->dbpath."/".$this->dbname.".xml");
    }

    public function AutoKey(){ //产生自增流水号
        //读取根节点sn属性
        $Root = $this->documentElement;
        if($Root->hasAttributes()) $attributes = $Root->attributes;
        $AutoKey = $attributes->item(0)->nodeValue+1; //sn原值增加1
        return $AutoKey;
    }
}
?>