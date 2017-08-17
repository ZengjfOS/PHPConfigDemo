<?php
    // 获取系统类型，X86，ARM
    $SystemType = exec ("uname -m");

    // 加载并解析ini配置文件
    $string  = file_get_contents("config/SystemInfo.json");
    $json_array = json_decode($string, true);

    foreach ($json_array["SystemInfo"] as $section => $section_value){
        // 获取section
        echo "section:".($section)."\n";

        foreach ($section_value as $key => $value){
            // 迭代输出section属性
            echo "\tkey:".$key.",    value:".$value."\n";

            // 检查当前循环的键值对是否是当前平台的，如果是，那么就执行对应的命令
            if ((strlen(trim(strstr($key, $SystemType))) >= strlen($SystemType) /* 查找$key中的$SystemType值对应的字符串 */)
                && isset($value)        /* 检查value是否存在值 */
                && (strlen($value) > 0) /* 检查value长度 */) {
                exec ($json_array["SystemInfo"][$section][$SystemType."_cmd"], $cpuInfo);
                echo "\t\texecute cmd:  ".$json_array["SystemInfo"][$section][$SystemType."_cmd"]."\n";
                foreach ( $cpuInfo as $line) {
                    echo "\t\t\t".$line."\n";
                }
            }

            // 这里一定要赋值一下
            $cpuInfo = "";
        }
    }

    echo "\n----------------------------------------------------\n\n";
    
    // parse json string and add attributes
    $string = 
    '{ 
        "a" : 1, 
        "b" : 2,
        "c" : 3,
        "d" : 4,
        "e" : 5
    }';

    $json_array = json_decode($string, true);
    $json_array["zengjf"] = "zengjf";
    // print_r($json_array);
    echo json_encode($json_array);
?>
