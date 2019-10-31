<?php
namespace App\Tool;
use DateTime;

class ToolHeper {
    public function getThumbnail($filename, $suffix = '_thumb') {
        if ($filename) {
//            2017-04/b2d497b69515658e67d80d135b7d0b54.png
            return preg_replace("/(.*)\.(.*)/i", "$1{$suffix}.$2", $filename);
        }
        return '';
    }

    public function getCurrencyVN($number, $symbol = 'VND', $isPrefix = false) {
        if ($isPrefix) {
            return $symbol . number_format($number, 0, ',', '.');
        } else {
            return number_format($number, 0, ',', '.' ) . $symbol;
        }
    }

    function time_elapsed_string_2($datetime, $full = false)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = new DateTime();
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        if ($diff->days > 6) return $datetime;

        $string = array(
            'y' => 'năm',
            'm' => 'tháng',
            'w' => 'tuần',
            'd' => 'ngày',
            'h' => 'giờ',
            'i' => 'phút',
            's' => 'giây',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? ' trước ' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . '' : 'vừa đăng';
    }
}
