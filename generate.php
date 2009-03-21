<?php
/********************************************************************************
 * Copyright (c) 2009 Jonathan Lucas Reddinger <lucas@wingedleopard.net>        *
 *                                                                              *
 * Permission to use, copy, modify, and distribute this software for any        *
 * purpose with or without fee is hereby granted, provided that the above       *
 * copyright notice and this permission notice appear in all copies.            *
 *                                                                              *
 * THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES     *
 * WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF             *
 * MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR      *
 * ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES       *
 * WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN        *
 * ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF      *
 * OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.               *
 ********************************************************************************/


$gen_fr_year = 2000;
$gen_to_year = 2020;


function convert_conceptual_date($ordinal, $day_of_week, $month, $year, $h=0, $m=0, $s=0) {
    if ($ordinal === 0) {
        for ($day = gmdate('t', gmmktime($h,$m,$s,$month,0,$year));
             $day_of_week != gmdate('w', $stamp = gmmktime($h,$m,$s,$month,$day,$year));
             $day--);
    } else {
        $day = 0;
        $i = 0;
        do {
            $day++;
            if ($day_of_week == gmdate('w', $stamp = gmmktime($h,$m,$s,$month,$day,$year))) $i++;
        } while ($ordinal > $i);
    };
    return $stamp;
};


$dst = array();


// eu dst scheme
$dst['eu'] = array();
// 1998 to now  --- last sunday in march until last sunday in october     --- +1 hour @ 01:00:00 UTC
for ($year = $gen_fr_year; $year <= $gen_to_year; $year++) {
    $dst['eu'][$year] = array('begin' => convert_conceptual_date(0, 0,  3, $year, 1),
                              'end'   => convert_conceptual_date(0, 0, 10, $year, 1),
                              'adj'   => 1*60*60);
};


var_export($dst);


?>
