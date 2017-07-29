<?php
    // 获取系统类型，X86，ARM
    $SystemType = exec ("uname -m");

    // 加载并解析ini配置文件
    $ini_array = parse_ini_file("config/SystemInfo.ini", true);
    while(current($ini_array)) {
        // 获取section
        $section = key($ini_array);
        echo "section:".$section."\n";

        // 迭代输出section属性
        foreach($ini_array[$section] as $key => $val) {
            echo "\tkey:".$key.",    "."value:".$val."\n";
        }

        next($ini_array);
    }
    echo "\n";

    // 直接获取命令并执行，获取输出信息
    exec ($ini_array["CPU"][$SystemType."_cmd"], $cpuInfo);
    foreach ( $cpuInfo as $line) {
        echo $line."\n";
    }
?>
