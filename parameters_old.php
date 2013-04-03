<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();


$rsIBlock = CIBlock::GetList(Array("NAME" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
/*
//Видерегистраторы
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["VIDEREG_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $reg4[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["VIDEREG_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $reg8[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["VIDEREG_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $reg16[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];


//Видеокамеры
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["VIDEOCAM_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $cam[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

//Кабель
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["CABEL_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $cabel[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

//Труба-гофрированная
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["TOUBE_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $toube[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

//Силовой кабель
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["CABELPOWER_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $cabelPower[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

//Кабель-канал
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["CABELBOX_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $cabelBox[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

//Коробка монтажная
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["BOX_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $box[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

//Блок резервного питания
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["REZERV_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $rezerv[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

//Разъем BNC
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["BNC_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $bnc[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

//Разъем питания
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["JACKP_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $jack[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

//Монитор
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["DISPALY_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $display[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

//Аккумулятор
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["ALKALINE_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $alkaline[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

//Жесткий диск
$db_res = CIBlockElement::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["HDD_ID"], "ACTIVE"=>"Y"));
while($arr=$db_res->Fetch()) $hdd[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
*/
$arProperty_UF = array();
$arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arCurrentValues["IBLOCK_ID"]."_SECTION");
foreach($arUserFields as $FIELD_NAME=>$arUserField)
	$arProperty_UF[$FIELD_NAME] = $arUserField["LIST_COLUMN_LABEL"]? $arUserField["LIST_COLUMN_LABEL"]: $FIELD_NAME;

$arComponentParameters = array(
	"GROUPS" => array(
      "VIDEREG" => array(
         "NAME" => "Видеорегистраторы"
      ),
      "CAMERA" => array(
         "NAME" => "Видеокамеры"
      ),
      "OTHER" => array(
         "NAME" => "Остальные комплектующие"
      ),
	),
	"PARAMETERS" => array(
		"SEF_FOLDER" => array(
			"PARENT" => "BASE",
			"NAME" => "Каталог ЧПУ (относительно корня сайта)",
			"TYPE" => "STRING"
		),
		"ID_SECTION" => array(
			"PARENT" => "BASE",
			"NAME" => "Корневой раздел",
			"TYPE" => "STRING"
		),
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => "Тип информационного блока",
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),

//Видерегистраторы	
		"VIDEREG_ID" => array(
         	"PARENT" => "VIDEREG",
			"NAME" => "Инфоблок с видерегистраторами",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),	
		"VIDEREG4" => array(
         	"PARENT" => "VIDEREG",
			"NAME" => "Видерегистратор 4х-канальный",
			"TYPE" => "LIST",
			"VALUES" => $reg4,
			"REFRESH" => "Y",
		),
		"VIDEREG8" => array(
         	"PARENT" => "VIDEREG",
			"NAME" => "Видерегистратор 8х-канальный",
			"TYPE" => "LIST",
			"VALUES" => $reg8,
			"REFRESH" => "Y",
		),
		"VIDEREG16" => array(
         	"PARENT" => "VIDEREG",
			"NAME" => "Видерегистратор 16х-канальный",
			"TYPE" => "LIST",
			"VALUES" => $reg16,
			"REFRESH" => "Y",
		),

//Видеокамеры
		"VIDEOCAM_ID" => array(
         	"PARENT" => "CAMERA",
			"NAME" => "Инфоблок с видекамерами",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"VIDEOCAM" => array(
         	"PARENT" => "CAMERA",
			"NAME" => "Видекамера(ы)",
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $cam,
			"REFRESH" => "Y",
		),

//Кабель
		"CABEL_ID" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Инфоблок с кабелем",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"CABEL" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Кабель",
			"TYPE" => "LIST",
			"VALUES" => $cabel,
			"REFRESH" => "Y",
		),

//Труба-гофрированная
		"TOUBE_ID" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Инфоблок с гофрирой",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"TOUBE" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Труба-гофрированная",
			"TYPE" => "LIST",
			"VALUES" => $toube,
			"REFRESH" => "Y",
		),

//Силовой кабель
		"CABELPOWER_ID" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Инфоблок с кабелем",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"CABELPOWER" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Силовой кабель",
			"TYPE" => "LIST",
			"VALUES" => $cabelPower,
			"REFRESH" => "Y",
		),

//Кабель-канал
		"CABELBOX_ID" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Инфоблок с кабель-каналом",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"CABELBOX" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Кабель-канал",
			"TYPE" => "LIST",
			"VALUES" => $cabelBox,
			"REFRESH" => "Y",
		),

//Коробка монтажная
		"BOX_ID" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Инфоблок с монтажная коробками",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"BOX" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Коробка монтажная",
			"TYPE" => "LIST",
			"VALUES" => $box,
			"REFRESH" => "Y",
		),

//Блок резервного питания
		"REZERV_ID" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Инфоблок с блоками резервного питания",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"REZERV" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Блок резервного питания",
			"TYPE" => "LIST",
			"VALUES" => $rezerv,
			"REFRESH" => "Y",
		),

//Разъем BNC
		"BNC_ID" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Инфоблок с разъемами BNC",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"BNC" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Разъем BNC",
			"TYPE" => "LIST",
			"VALUES" => $bnc,
			"REFRESH" => "Y",
		),

//Разъем питания
		"JACKP_ID" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Инфоблок с разъемами питания",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"JACKP" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Разъем питания",
			"TYPE" => "LIST",
			"VALUES" => $jack,
			"REFRESH" => "Y",
		),

//Монитор
		"DISPALY_ID" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Инфоблок с мониторами",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"DISPALY" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Монитор",
			"TYPE" => "LIST",
			"VALUES" => $display,
			"REFRESH" => "Y",
		),

//Аккумулятор
		"ALKALINE_ID" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Инфоблок с аккумуляторами",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"ALKALINE" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Аккумулятор",
			"TYPE" => "LIST",
			"VALUES" => $alkaline,
			"REFRESH" => "Y",
		),

//Жесткий диск
		"HDD_ID" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Инфоблок с жесткий диск",
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"HDD" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Жесткий диск",
			"TYPE" => "LIST",
			"VALUES" => $hdd,
			"REFRESH" => "Y",
		),






















		/*"SECTION_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCSL_SECTION_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => '={$_REQUEST["SECTION_ID"]}',
		),
		"SECTION_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCSL_SECTION_CODE"),
			"TYPE" => "STRING",
			"DEFAULT" => '',
		),
		"SECTION_URL" => CIBlockParameters::GetPathTemplateParam(
			"SECTION",
			"SECTION_URL",
			GetMessage("CP_BCSL_SECTION_URL"),
			"",
			"URL_TEMPLATES"
		),
		"COUNT_ELEMENTS" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("CP_BCSL_COUNT_ELEMENTS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => 'Y',
		),
		"TOP_DEPTH" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("CP_BCSL_TOP_DEPTH"),
			"TYPE" => "STRING",
			"DEFAULT" => '2',
		),
		"SECTION_FIELDS" => CIBlockParameters::GetSectionFieldCode(
			GetMessage("CP_BCSL_SECTION_FIELDS"),
			"DATA_SOURCE",
			array()
		),
		"SECTION_USER_FIELDS" =>array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("CP_BCSL_SECTION_USER_FIELDS"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arProperty_UF,
		),
		"ADD_SECTIONS_CHAIN" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("CP_BCSL_ADD_SECTIONS_CHAIN"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),*/
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
		/*"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BCSL_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),*/
	),
);
?>
