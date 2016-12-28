<?php
/**
 * ------------------------------------------------------------------------
 * JA Fixel Template
 * ------------------------------------------------------------------------
 * Copyright (C) 2004-2011 J.O.O.M Solutions Co., Ltd. All Rights Reserved.
 * @license - Copyrighted Commercial Software
 * Author: J.O.O.M Solutions Co., Ltd
 * Websites:  http://www.joomlart.com -  http://www.joomlancers.com
 * This file may not be redistributed in whole or significant part.
 * ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

define('FIXEL_GRID_TYPE', 'image');
define('FIXEL_GRID_SIZE', '1x1');
define('FIXEL_GRID_ANIMATE', 'none');
define('FIXEL_CATEGORY_COLOR', '');

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
jimport('joomla.image.image');

class FixelHelper {

	public static function getGrid($item, $metadata = 'metadata'){
		
		$data = $item->$metadata;
		if(is_string($data)){
			$data = new JRegistry;
			$data->loadString($item->$metadata);
		}

		if($data instanceof JRegistry){
			return array(
				'type' => $data->get('jcontent_type', FIXEL_GRID_TYPE),
				'size' => $data->get('jcontent_size', FIXEL_GRID_SIZE),
				'animate' => $data->get('jcontent_animate', FIXEL_GRID_ANIMATE),
				'color' => $data->get('jcontent_cat_color', FIXEL_CATEGORY_COLOR)
			);
		}
		
		return array(
			'type' => FIXEL_GRID_TYPE,
			'size' => FIXEL_GRID_SIZE,
			'animate' => FIXEL_GRID_ANIMATE,
			'color' => FIXEL_CATEGORY_COLOR
		);
	}

	public static function video($item){
		$result = '';
		
		if(preg_match_all('@<iframe\s[^>]*src=[\"|\']([^\"\'\>]+)[^>].*?</iframe>@ms', $item->introtext, $iframesrc) > 0){
			if(isset($iframesrc[1])){
				$vid = str_replace(
					array(
						'http:',
						'https:',
						'//youtu.be/',
						'//www.youtube.com/embed/',
						'//youtube.googleapis.com/v/'), '', $iframesrc[1][0]);
				
				$vid = preg_replace('@(\/|\?).*@i', '', $vid);
				
				if(!(empty($vid))){ 
					
					$result = 'http://img.youtube.com/vi/'.$vid.'/0.jpg';
					
					$item->introtext = str_replace($iframesrc['0'], '', $item->introtext);
				}
			}
		}

		return $result;
	}

	public static function gallery($item){
		
		$html = '';

		if($item->text && preg_match_all('#<img[^>]+>#iU', $item->text, $imgs)) {

			//remove the text
			$item->text = preg_replace('#<img[^>]+>#iU', '', $item->text);

			//collect all images
			$img_data = array();

			// parse image attributes
			foreach( $imgs[0] as $img_tag){
				$img_data[$img_tag] = JUtility::parseAttributes($img_tag);
			}

			$total = count($img_data);

			if($total > 0){

				$params = isset($item->params) ? $item->params : (isset($item->core_params) ? $item->core_params : null);
				$link = false;

				//tag does not have params (core_params)
				if (!$params || ($params->get('link_titles') && $params->get('access-view'))) {
					if(!$params && $item->core_state != 0){
						$link = JRoute::_(TagsHelperRoute::getItemRoute($item->content_item_id, $item->core_alias, $item->core_catid, $item->core_language, $item->type_alias, $item->router));
					} else {
						$link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catid));
					}
				}

				if(!isset($item->id) && isset($item->core_content_id)){
					$item->id = $item->core_content_id;
				}
				
				$html .= '<div id="fixel-carousel-' . $item->id . '" class="carousel slide">';
				$html .= '<ol class="carousel-indicators">';
				
				for($i = 0; $i < $total; $i++){
					$html .= '<li data-target="#fixel-carousel-' . $item->id . '" data-slide-to="' . $i . '"' . ($i == 0 ? ' class="active"' : '') . '></li>';
				}

				$html .= '</ol>';
				$html .= '<div class="carousel-inner">';
				
				$j = 0;

				foreach($img_data as $img => $attr){
					
					// gallery item
					$html .= '<div class="item' . ($j == 0 ? ' active' : '') . '">';

					if($link){
						$html .= '<a class="article-link" href="' . $link . '" title="">' . $img . '</a>'; 
					} else {
						$html .= $img;
					}

					// gallery description
					if((isset($attr['alt']) && $attr['alt']) || (isset($attr['title']) && $attr['title'])){

						$html .= '<div class="carousel-caption">';
						$html .= (isset($attr['title']) && $attr['title']) ? '<h4>' . htmlspecialchars_decode($attr['title']) . '</h4>' : '';
						$html .= (isset($attr['alt']) && $attr['alt']) ? '<p>' . htmlspecialchars_decode($attr['alt']) . '</p>' : '';

						$html .= '</div>';
					}

					$html .= '</div>';
					$j++;
				}

				$html .= '</div>';
				$html .= '<a class="carousel-control left" href="#fixel-carousel-'.$item->id.'" data-slide="prev">&lsaquo;</a>';
				$html .= '<a class="carousel-control right" href="#fixel-carousel-'.$item->id.'" data-slide="next">&rsaquo;</a>';
				$html .= '</div>';

				$html .= '<script type="text/javascript">
					(function($){
						$(document).ready(function($){
							$(\'#fixel-carousel-'.$item->id.'\').carousel();
						})
					})(jQuery);
				</script>';
			}
		}

		return $html;
	}

	public static function image($item){

		if(preg_match('/<img[^>]+>/i', $item->text, $imgs)){
			return JUtility::parseAttributes($imgs[0]);
		}

		return array();
	}

	public static function extractImage(&$text){
		//get images
		$image = '';
		
		if (preg_match ('/<img[^>]+>/i', $text, $matches)) {
			$image = $matches[0];
			$text = str_replace ($image, '', $text);
			$text = preg_replace('/<p>([\s]*?|(?R))<\/p>/imsU', '', $text); //remove empty tags
		}

		return $image;
	}
}