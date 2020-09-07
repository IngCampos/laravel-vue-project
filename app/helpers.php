<?php
function FormatDate($datetime)
{
    // input(from database) : 2020-04-28 13:50:22
    $d = explode('-', explode(' ', $datetime)[0]);
    $h = explode(':', explode(' ', $datetime)[1]);
    $y = $d[0][2] . $d[0][3];
    return $h[0] . ':' . $h[1] . ' ' . $d[2] . '/' . $d[1] . '/' . $y;
    // output(like Javascript function) : 00:12 24/4/20
}
