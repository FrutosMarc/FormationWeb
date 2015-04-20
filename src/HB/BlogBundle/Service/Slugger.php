<?php
 namespace HB\BlogBundle\Service;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Slugger
 *
 * @author Marc
 */
class Slugger {
/*
*	getSlug()
*	@action:return cleaned text of given string
*			Used to get url friendly title
*	@parameters:
*		$str: string to be cleaned
*		$replace: array of characters to be cleaned; default empty
*		$delimiter: delimiter to separate words; default is '-'
*	@return: string of given length
*	@modified : 19 September 2010
*	@modified by: Nilambar
*/
/**
 * 
 * @param string $str
 * @param array $replace
 * @param string $delimiter
 * @return string
 */
    function getSlug($str, $replace=array(), $delimiter='-') {
            //
            if( !empty($replace) ) {
                    $str = str_replace((array)$replace, ' ', $str);
            }
            $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);	
            $clean=strip_tags($clean);
            $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
            $clean = strtolower(trim($clean, '-'));
            $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
            return $clean;
    }
}
