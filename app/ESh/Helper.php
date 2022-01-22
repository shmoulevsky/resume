<?php

namespace App\ESh;


class Helper
{

    public static function translit($textcyr = null, $textlat = null)
    {
        $cyr = array(
            'ж', 'ч', 'щ', 'ш', 'ю', 'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
            'Ж', 'Ч', 'Щ', 'Ш', 'Ю', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я', ' ');
        $lat = array(
            'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'iy', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'ya',
            'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'YI', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'YA', '-');
        if ($textcyr) return strtolower(str_replace($cyr, $lat, $textcyr));
        else if ($textlat) return strtolower(str_replace($lat, $cyr, $textlat));
        else return null;
    }

    public static function convertDate($date, $format = 'Y-m-d H:i:s')
    {

        if ($arDate = date_parse_from_format($format, $date)) {
            $day = $arDate["day"];
            $month = $arDate["nonth"];
            $year = $arDate["year"];

            switch ($month) {
                case 1 :
                    $month = "Января";
                    break;
                case 2 :
                    $month = "Февраля";
                    break;
                case 3 :
                    $month = "Марта";
                    break;
                case 4 :
                    $month = "Апреля";
                    break;
                case 5 :
                    $month = "Мая";
                    break;
                case 6 :
                    $month = "Июня";
                    break;
                case 7 :
                    $month = "Июля";
                    break;
                case 8 :
                    $month = "Августа";
                    break;
                case 9 :
                    $month = "Сентября";
                    break;
                case 10 :
                    $month = "Октября";
                    break;
                case 11 :
                    $month = "Ноября";
                    break;
                case 12 :
                    $month = "Декабря";
                    break;

            }

            return $day . ' ' . strtolower($month) . " " . $year;


        }


    }

    public static function convertDateTime($date, $format = 'Y-m-d H:i:s')
    {

        if ($arDate = date_parse_from_format($format, $date)) {
            $day = $arDate["day"];
            $month = $arDate["month"];
            $year = $arDate["year"];

            $h = $arDate["hour"];
            $m = $arDate["minute"];


            switch ($month) {
                case 1 :
                    $month = "Января";
                    break;
                case 2 :
                    $month = "Февраля";
                    break;
                case 3 :
                    $month = "Марта";
                    break;
                case 4 :
                    $month = "Апреля";
                    break;
                case 5 :
                    $month = "Мая";
                    break;
                case 6 :
                    $month = "Июня";
                    break;
                case 7 :
                    $month = "Июля";
                    break;
                case 8 :
                    $month = "Августа";
                    break;
                case 9 :
                    $month = "Сентября";
                    break;
                case 10 :
                    $month = "Октября";
                    break;
                case 11 :
                    $month = "Ноября";
                    break;
                case 12 :
                    $month = "Декабря";
                    break;

            }

            $result[] = $day . ' ' . strtolower($month) . " " . $year;
            $result[] = $h . ':' . $m;

            return $result;


        }


    }

    public static function declOfNum($number, $titles = [])
    {

        $cases = array(2, 0, 1, 1, 1, 2);
        $format = $titles[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
        return sprintf($format, $number);

    }

    public static function checkNullArray($value): array
    {
        if ($value == null) {
            $value = [];
        }

        return $value;
    }

}
