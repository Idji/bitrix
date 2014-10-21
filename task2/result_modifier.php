<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (defined('BX_COMP_MANAGED_CACHE') && is_object($GLOBALS['CACHE_MANAGER'])){
	$cp =& $this->__component;
	$GLOBALS['CACHE_MANAGER']->RegisterTag('tag_for_news_list_3');
	$GLOBALS['CACHE_MANAGER']->EndTagCache();
}

?>