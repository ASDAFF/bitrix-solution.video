<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();


$rsIBlock = CIBlock::GetList(Array("NAME" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

$arProperty_UF = array();
$arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arCurrentValues["IBLOCK_ID"]."_SECTION");
foreach($arUserFields as $FIELD_NAME=>$arUserField)
	$arProperty_UF[$FIELD_NAME] = $arUserField["LIST_COLUMN_LABEL"]? $arUserField["LIST_COLUMN_LABEL"]: $FIELD_NAME;

$arComponentParameters = array(
	"GROUPS" => array(
      "VIDEREG" => array(
         "NAME" => GetMessage("VIDEREG")
      ),
      "CAMERA" => array(
         "NAME" => GetMessage("CAMERA")
      ),
      "OTHER" => array(
         "NAME" => GetMessage("OTHER")
      ),
	),
	"PARAMETERS" => array(

//Видерегистраторы	
		"VIDEREG4" => array(
         	"PARENT" => "VIDEREG",
			"NAME" => GetMessage("VIDEREG4"),
			"TYPE" => "STRING"
		),
		"VIDEREG8" => array(
         	"PARENT" => "VIDEREG",
			"NAME" => GetMessage("VIDEREG8"),
			"TYPE" => "STRING"
		),	
		"VIDEREG4_MOBILE" => array(
         	"PARENT" => "VIDEREG",
			"NAME" => GetMessage("VIDEREG4_MOBILE"),
			"TYPE" => "STRING"
		),
		"VIDEREG8_MOBILE" => array(
         	"PARENT" => "VIDEREG",
			"NAME" => GetMessage("VIDEREG8_MOBILE"),
			"TYPE" => "STRING"
		),

//Видеокамеры
		"VIDEOCAM" => array(
         	"PARENT" => "CAMERA",
			"NAME" => GetMessage("VIDEOCAM"),
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "Y",
			"TYPE" => "STRING"
		),

//Комбинированый кабель
		"CABEL" => array(
         	"PARENT" => "OTHER",
			"NAME" => GetMessage("CABEL"),
			"TYPE" => "STRING"
		),

//Труба-гофрированная
		"TOUBE" => array(
         	"PARENT" => "OTHER",
			"NAME" => GetMessage("TOUBE"),
			"TYPE" => "STRING"
		),

//Кабель-канал
		"CABELBOX" => array(
         	"PARENT" => "OTHER",
			"NAME" => GetMessage("CABELBOX"),
			"TYPE" => "STRING"
		),

//Блок питания с аккумулятором
		"REZERV" => array(
         	"PARENT" => "OTHER",
			"NAME" => GetMessage("REZERV"),
			"TYPE" => "STRING"
		),
//Блок питания без аккумулятора
		"BP" => array(
         	"PARENT" => "OTHER",
			"NAME" => GetMessage("BP"),
			"TYPE" => "STRING"
		),

//Разъем BNC
		"BNC" => array(
         	"PARENT" => "OTHER",
			"NAME" => GetMessage("BNC"),
			"TYPE" => "STRING"
		),

//Разъем питания
		"JACKP" => array(
         	"PARENT" => "OTHER",
			"NAME" => GetMessage("JACKP"),
			"TYPE" => "STRING"
		),

//Аккумулятор
		"ALKALINE" => array(
         	"PARENT" => "OTHER",
			"NAME" => GetMessage("ALKALINE"),
			"TYPE" => "STRING"
		),
//Жесткий диск
		"HDD_500" => array(
         	"PARENT" => "OTHER",
			"NAME" => GetMessage("HDD_500"),
			"TYPE" => "STRING"
		),
		"HDD_750" => array(
         	"PARENT" => "OTHER",
			"NAME" => GetMessage("HDD_750"),
			"TYPE" => "STRING"
		),
		"HDD_1T" => array(
         	"PARENT" => "OTHER",
			"NAME" => GetMessage("HDD_1T"),
			"TYPE" => "STRING"
		),


//Колличество аккумуляторов
		"COUNT_ALKALINE" => array(
         	"PARENT" => "BASE",
			"NAME" => GetMessage("COUNT_ALKALINE"),
			"TYPE" => "STRING",
			"DEFAULT"=>1
		),
//Колличество блоков питания
		"COUNT_REZERV" => array(
         	"PARENT" => "BASE",
			"NAME" => GetMessage("COUNT_REZERV"),
			"TYPE" => "STRING",
			"DEFAULT"=>1
		),
//Колличество жестких дисков
		"COUNT_HDD" => array(
         	"PARENT" => "BASE",
			"NAME" => GetMessage("COUNT_HDD"),
			"TYPE" => "STRING",
			"DEFAULT"=>1
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000)
	),
);
?>
