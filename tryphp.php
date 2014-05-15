  function build()
    {
        $json =<<<EOS
            {"C000":{"Service_Code":"C000","Service_Type":"PACK","Service":"PICK & PACK","Rate":"$0.42 ","Unit":"PER ITEM","Cycle":"PER ITEM","Optional":"no"},"C001":{"Service_Code":"C001","Service_Type":"PACK","Service":"BOXC PACKAGING","Unit":"PER ITEM","Cycle":"PER ITEM","Optional":"no","options":[{"option":"C001-P01","name":"BOXC PACKAGING","rate":"$0.00 "},{"option":"C001-P02","name":"YOUR PACKAGING","rate":"$0.02 "},{"option":"C001-P03","name":"SUPER DUPER PACKAGING","rate":"$0.10 "}]},"C002":{"Service_Code":"C002","Service_Type":"SHIP","Service":"IMPORT","Rate":"$1.99 ","Unit":"PER ITEM","Cycle":"PER ITEM","Optional":"no"},"C003":{"Service_Code":"C003","Service_Type":"SHIP","Service":"US DELIVERY","Rate":"$3.99 ","Unit":"PER ITEM","Cycle":"PER ITEM","Optional":"no"},"C004":{"Service_Code":"C004","Service_Type":"SHIP","Service":"INSURANCE","Rate":"$0.00 ","Unit":"PER ITEM","Cycle":"PER ITEM","Optional":"yes"},"C005":{"Service_Code":"C005","Service_Type":"WAREHOUSE","Service":"STORAGE","Rate":"$0.13 ","Unit":"PER SKU","Cycle":"MONTHLY","Optional":"no"},"C006":{"Service_Code":"C006","Service_Type":"WAREHOUSE","Service":"PRODUCT PHOTOS","Rate":"$5.00 ","Unit":"PER SKU","Cycle":"ONCE","Optional":"yes"}}
EOS;
        $array = json_decode($json, TRUE);

        $display = array();
        foreach($array as $key=>$option)
        {
            if( isset($option['options'] ))
            {
                @$display[$option['Service_Type']]['html'] .= "<input type='checkbox' disabled checked> <b>{$option['Service']}</b><br>";
                foreach($option['options'] as $so)
                {
                    @$display[$option['Service_Type']]['html'] .= "&nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' checked> <b>{$so['name']}</b> {$so['rate']}<br>";
                }
            }
            else
            {
                @$display[$option['Service_Type']]['html'] .= "<input type='checkbox' disabled checked> <b>{$option['Service']}</b> {$option['Rate']}<br>";
            }
        }

        //dump($display);
        foreach($display as $key=>$item)
        {
            echo "<h3>$key</h3>";
            echo $item['html'];
        }
    }