<?php
/**
 * Read CSV file and return array.
 * @param $filename
 * @param string $delimiter
 * @param $search_key_index
 * @param $search_string
 * @return array|bool
 */
function readCSVFileAndConvertToArray($filename, $delimiter = "\t", $search_string='', $search_key_index='')
{
    if(!file_exists($filename) || !is_readable($filename))
    {
        return false;
    }

    $header = null;
    $data = [];

    if (($handle = fopen($filename, 'r')) !== false)
    {
        $header_temp = fgetcsv($handle, 1000, $delimiter);
        $header_temp = preg_replace('/[^(\x20-\x7F)]*/', '', $header_temp);

        foreach($header_temp as $header_temp_item)
        {
            $header[] = changeIndexToUsableIndex($header_temp_item);
        }

        $count_of_header = count($header);
        while (($row = fgetcsv($handle, NULL, $delimiter)))
        {
            //$row = preg_replace('/[^(\x20-\x7F)]*/', '', $row);
            try
            {
                if(empty(array_filter($row)))
                {
                    continue;
                }
                if($count_of_header < count($row) )
                {
                    $new_row = array_splice($row, ($count_of_header - 1) );
                    $row [] = implode(',',$new_row);
                }

                $required_row = array_combine($header, $row);

                $data[] = $required_row;
                if($search_key_index != '' && ! empty($search_string) && $required_row[$search_key_index] == $search_string)
                {
                    break;
                }
            }
            catch (\Exception $e)
            {
                continue;
            }
        }
        fclose($handle);
    }
    return $data;
}

/**
 * For Array Index
 * @param $index_string
 * @return mixed|string
 */
function changeIndexToUsableIndex($index_string)
{
    $index_string = strtolower($index_string);
    $index_string = str_replace(['.', ':', '(', ')', '?'], '', $index_string);
    $index_string = str_replace(' ', '_', $index_string);
    return $index_string;
}