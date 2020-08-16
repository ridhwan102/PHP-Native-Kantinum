<?php
    function transposeArray($data)
    {
        if(is_object($data))
            $data = get_object_vars($data);

        if(!is_array($data))
            return $data;

        $new_data = array();
        var_dump($data);
        foreach ($data as $key=>$record)
            foreach ($record as $index=>$value)
                $new_data[$index][$key] = $value;
        var_dump($new_data);
        return $new_data;
    }

    function  countNotZero($data) {
        if(is_object($data))
            $data = get_object_vars($data);

        if(!is_array($data))
            return $data;

        $sum = 0;
        foreach ($data as $x) {
            if($x > 0.0) {
                $sum++;
            }
        }

        return $sum;
    }