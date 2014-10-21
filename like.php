<?include($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");
//CModule::IncludeModule("catalog");
//CModule::IncludeModule("sale");
global $USER;
//проверки
if(!$_GET['id']) echo '{"message":"Текст ошибки", "result":"error"}';
//пользователь ставит лайк / дизлайк
else{
	//берем всех пользователей, лайкнувших статью
	$list = CIBlockElement::GetProperty(
		3,
		$_GET['id'],
		array(),
		array('CODE'=>'likeUsers')
	);
	while($ob = $list->GetNext()){
		$usersList[] = $ob['VALUE'];
    }
    //проверяем лайк или дизлайк
    if(!in_array($USER->GetID(), $usersList)){ //это лайк
	    $usersList[] = (int) $USER->GetID();
	    $mes = "<p class='jsDel'>".$USER->GetLogin()."</p>";
	    $res = "add";
	}    
	else{ //дизлайк
		$key = array_search($USER->GetID(), $usersList);
		$mes = "";
		$res = "del";
		if($key)
 			unset($usersList[$key]);
	}
	//обновляем св-во
	CIBlockElement::SetPropertyValuesEx(
		$_GET['id'],
		3,
		array('likeUsers' => $usersList)
	);

	//обновляем кэш
	if (defined('BX_COMP_MANAGED_CACHE') && is_object($GLOBALS['CACHE_MANAGER'])){
		$GLOBALS['CACHE_MANAGER']->ClearByTag('tag_for_news_list_3');		
	}
	

	echo '{"message":'.json_encode($mes).', "result":"'.$res.'"}';
}