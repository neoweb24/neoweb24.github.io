<?php

// function limitStringLength($string = '', $abbr = false, $limit = 500, $dots = true) {
//     $string = trim($string);

//     if(strlen($string) > $limit) {
//         if($abbr) return "<abbr title='". $string ."'>". mb_substr($string, 0, $limit) ."</abbr>...";
//         $string = mb_substr($string, 0, $limit);
//         if($dots === true) $string .= '...';
//     }
//     return $string;
// } // func


function limitLength($string = '', $limit = 500, $dots = '', $droppedSide = 'right', $useAbbr = false) {
    $string = trim($string); if(!$string) return;
    $length = strlen($string);

    if($length > $limit) {
        // $dots = $dots ? '*' : '';
        switch($droppedSide) {
            case 'right':
                $shortString = mb_substr($string, 0, $limit) . $dots; break;
            case 'left':
                $shortString = $dots . mb_substr($string, $length - $limit, $length); break;
            default:
                return '[ Внимание! Передано некорректное значение (droppedSide в функцию '. debug_backtrace(2)[0]['function'] .') ]';
                break;
                
        // <div className="tooltip mb-10">
        // { isFilled1 && <div className="tooltiptext ml-90 mt-4">Заполните название</div> }
        // </div>
        }
        if(!$useAbbr) return $shortString;
        // $string = '<abbr title="'. $string .'">'. $shortString .'</abbr>';
        $string = '<div class="tooltip">'. $shortString .'<span class="tooltiptext">'. $string .'</span></div>';
        
    }
    return $string;
} // func