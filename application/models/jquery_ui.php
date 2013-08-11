<?php

	$CI=&get_instance();
	$CI->load->helper('url');
 
class Jquery_ui extends CI_Model{
	private static $JQ=array();
	
	public function __construct(){
		parent::__construct();
		$base_url=base_url()."css/base/";
		Jquery_ui::$JQ=array(
		"bgActiveRepeat"=>"repeat-x",
		"bgActiveXPos"=>"50%",
		"bgActiveYPos"=>"50%",
		"bgColorActive"=>"hsl(83, 100%, 51%)",
		"bgColorContent"=>"hsl(34, 78%, 20%)",
		"bgColorDefault"=>"hsl(83, 100%, 61%)",
		"bgColorError"=>"#ff0000",
		"bgColorHeader"=>"hsl(65, 100%, 80%)",
		"bgColorHighlight"=>"#fbf9ee",
		"bgColorHover"=>"#dadada",
		"bgColorFocus"=>"hsl(83, 100%, 51%)",
		"bgColorOverlay"=>"rgba(0,0,0,.7)",
		"bgColorShadow"=>"hsl(65, 100%, 80%)",
		"bgColorShadow2"=>"rgba(0,0,0,.7)",
		"bgColorShadow3"=>"hsl(34, 78%, 20%)",
		"bgContentRepeat"=>"repeat-x",
		"bgContentXPos"=>"50%",
		"bgContentYPos"=>"50%",
		"bgDefaultRepeat"=>"repeat-x",
		"bgDefaultXPos"=>"50%",
		"bgDefaultYPos"=>"50%",
		"bgErrorRepeat"=>"repeat-x",
		"bgErrorXPos"=>"50%",
		"bgErrorYPos"=>"50%",
		"bgHeaderRepeat"=>"repeat-x",
		"bgHeaderXPos"=>"50%",
		"bgHeaderYPos"=>"50%",
		"bgHighlightRepeat"=>"repeat-x",
		"bgHighlightXPos"=>"50%",
		"bgHighlightYPos"=>"50%",
		"bgHoverRepeat"=>"repeat-x",
		"bgHoverXPos"=>"50%",
		"bgHoverYPos"=>"50%",
		#"bgImgUrlActive"=>"url(images/ui-bg_glass_65_ffffff_1x400.png)",
		"bgImgUrlActive"=>"",
		#"bgImgUrlContent"=>"url(images/ui-bg_flat_75_ffffff_40x100.png)",
		"bgImgUrlContent"=>"",
		"bgImgUrlDefault"=>"linear-gradient(hsl(83, 100%, 71%) 48%,hsl(83, 100%, 51%) 52%)",
		#"bgImgUrlError"=>"url(images/ui-bg_glass_95_fef1ec_1x400.png)",
		"bgImgUrlError"=>"",
		#"bgImgUrlHeader"=>"url(images/ui-bg_highlight-soft_75_cccccc_1x100.png)",
		"bgImgUrlHeader"=>"linear-gradient(hsl(83, 100%, 71%),hsl(83, 100%, 51%))",
		"bgImgUrlHighlight"=>"url(".$base_url."images/ui-bg_glass_55_fbf9ee_1x400.png)",
		#"bgImgUrlHover"=>"url(images/ui-bg_glass_75_dadada_1x400.png)",
		"bgImgUrlHover"=>"linear-gradient(hsl(83, 100%, 81%) 48%,hsl(83, 100%, 51%) 62%)",
		#"bgImgUrlOverlay"=>"url(images/ui-bg_flat_0_aaaaaa_40x100.png)",
		"bgImgUrlOverlay"=>"",
		"bgImgUrlShadow"=>"url(".$base_url."images/ui-bg_flat_0_aaaaaa_40x100.png)",
		"bgOverlayRepeat"=>"repeat-x",
		"bgOverlayXPos"=>"50%",
		"bgOverlayYPos"=>"50%",
		"bgShadowRepeat"=>"repeat-x",
		"bgShadowXPos"=>"50%",
		"bgShadowYPos"=>"50%",
		"borderColorActive"=>"hsl(35, 80%, 10%)",
		"borderColorContent"=>"hsl(35, 80%, 10%)",
		"borderColorDefault"=>"hsl(35,80%,20%)",
		"borderColorError"=>"#cd0a0a",
		"borderColorHeader"=>"hsl(35, 80%, 10%)",
		"borderColorHighlight"=>"#fcefa1",
		"borderColorHover"=>"hsl(35, 80%, 10%)",
		"cornerRadius"=>"4px",
		"cornerRadiusShadow"=>"8px",
		"fcActive"=>"#212121",
		"fcContent"=>"hsl(83, 100%, 51%)",
		"fcDefault"=>"hsl(35, 80%, 20%)",
		"fcError"=>"pink",
		"fcHeader"=>"hsl(35,80%,20%)",
		"fcHighlight"=>"#363636",
		"fcHover"=>"#212121",
		"ffDefault"=>"Verdana,Arial,sans-serif",
		"fsDefault"=>".9em",
		"fwDefault"=>"normal",
		"iconsActive"=>"url(".$base_url."images/ui-icons_2D1C05_256x240.png)",
		"iconsContent"=>"url(".$base_url."images/ui-icons_222222_256x240.png)",
		"iconsDefault"=>"url(".$base_url."images/ui-icons_5b390a_256x240.png)",
		"iconsError"=>"url(".$base_url."images/ui-icons_cd0a0a_256x240.png)",
		"iconsHeader"=>"url(".$base_url."images/ui-icons_222222_256x240.png)",
		"iconsHighlight"=>"url(".$base_url."images/ui-icons_2e83ff_256x240.png)",
		"iconsHover"=>"url(".$base_url."images/ui-icons_2D1C05_256x240.png)",
		"offsetLeftShadow"=>"-8px",
		"offsetTopShadow"=>"-8px",
		"opacityFilterOverlay"=>"Alpha(Opacity=30)",
		"opacityFilterShadow"=>"Alpha(Opacity=30)",
		"opacityOverlay"=>".3",
		"opacityShadow"=>".3",
		"thicknessShadow"=>"8px"
	);
	}
	
	public function get_params(){
		return Jquery_ui::$JQ;
	}
	
}