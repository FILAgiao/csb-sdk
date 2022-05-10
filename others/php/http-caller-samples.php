<!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>
    <body>        
       <?php  require 'http-caller.php';
       
        // 使用phpSDK  HttpCalle的测试参考代码  
        echo "<br>PHP SDK Usage to invoke http-API provided by CSB:";
           
        echo "<hr>";
        // java集成包里的地址
        $url =  "http://41.190.17.18:8086/CSB";
        // 和民警注册应用时生成的requestId和ak,sk
        $requestId ="***************";
        $ak = 'ak'; 
        $sk = 'sk';
        // 版本就是1.0.0,不用变。
        
        $version = '1.0.0';
        // java集成包里的各个方法的服务标识
        $api =  "ST_JWZH_DEPT_001"; 
        //java集成包里的各个方法的xml输入参数
        $ndata  =  '<?xml version="1.0" encoding="utf-8"?><DATAS><REQUESTID>'.$requestId.'</REQUESTID><BEGINID>1</BEGINID><MAXROWS>10</MAXROWS></DATAS>';

        // data赋值
        $data = array('inxml'=>$ndata);
        
       echo '<br>';
       
       $phpCaller = new HttpCaller();
       
       //打印debug信息
       $phpCaller->PRINT_DEBUG = false;
       
       try{
         //测试GET调用
         echo "<br>Test Get....<br>";
         $result = $phpCaller->doGet($url, $data, $api, $version, $ak, $sk);
         echo "<br>result=".$result."<br>";
         echo "<hr>";
         
         //测试POST调用
         echo "<br>Test Post kvpairs....<br>";
         $result = $phpCaller->doPost($url, $data, $api, $version, $ak, $sk);
         echo "<br>result=".$result."<br>";
         echo "<hr>";
         
          //测试发送json串调用
         echo "<br>Test Post httpjsonbody....<br>";
         $url="http://11.239.187.178:8086/test?name=a&age=12&title=test";
         $jsonStr = "{\"a\":\"csb云服务总线\"}";
         $api = "httpjsonbody";
         $result = $phpCaller->doPostJsonString($url, $jsonStr, $api, $version, $ak, $sk);
         echo "<br>result=".$result."<br>";
         echo "<hr>";
         
         //测试发送二进制数组
         echo "<br>Test Post byte array....<br>";
         $url="http://11.239.187.178:8086/test?fileName=test.pdf&filePath=/home/admin/";
         $byteArray =  $phpCaller->readFileAsByteArray("/ltwork/csb-install/r.sh");
         $api = "httpfile";
         $result = $phpCaller->doPostByteArray($url, $byteArray, $api, $version, $ak, $sk);
         echo "<br>result=".$result."<br>";
         echo "<hr>";
         
         // 进行后续的结果处理
         // ...
      } catch (customException $e) 
      { 
         echo $e->errorMessage(); 
      } catch(Exception $e) 
      { 
         echo $e->getMessage(); 
      } 
    
    ?>
    </body>
</html>