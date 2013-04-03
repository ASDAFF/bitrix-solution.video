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

//Видерегистраторы	
		"VIDEREG4" => array(
         	"PARENT" => "VIDEREG",
			"NAME" => "Видерегистратор 4х-канальный",
			"TYPE" => "STRING"
		),
		"VIDEREG8" => array(
         	"PARENT" => "VIDEREG",
			"NAME" => "Видерегистратор 8х-канальный",
			"TYPE" => "STRING"
		),
		"VIDEREG16" => array(
         	"PARENT" => "VIDEREG",
			"NAME" => "Видерегистратор 16х-канальный",
			"TYPE" => "STRING"
		),

//Видеокамеры
		"VIDEOCAM" => array(
         	"PARENT" => "CAMERA",
			"NAME" => "Видекамера(ы)",
			"MULTIPLE" => "Y",
			"ADDITIONAL_VALUES" => "Y",
			"TYPE" => "STRING"
		),

//Кабель
		"CABEL" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Кабель",
			"TYPE" => "STRING"
		),

//Труба-гофрированная
		"TOUBE" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Труба-гофрированная",
			"TYPE" => "STRING"
		),

//Силовой кабель
		"CABELPOWER" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Силовой кабель",
			"TYPE" => "STRING"
		),

//Кабель-канал
		"CABELBOX" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Кабель-канал",
			"TYPE" => "STRING"
		),

//Коробка монтажная
		"BOX" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Коробка монтажная",
			"TYPE" => "STRING"
		),

//Блок резервного питания
		"REZERV" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Блок резервного питания",
			"TYPE" => "STRING"
		),

//Разъем BNC
		"BNC" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Разъем BNC",
			"TYPE" => "STRING"
		),

//Разъем питания
		"JACKP" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Разъем питания",
			"TYPE" => "STRING"
		),

//Монитор
		"DISPALY" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Монитор",
			"TYPE" => "STRING"
		),

//Аккумулятор
		"ALKALINE" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Аккумулятор",
			"TYPE" => "STRING"
		),
//Жесткий диск
		"HDD" => array(
         	"PARENT" => "OTHER",
			"NAME" => "Жесткий диск",
			"TYPE" => "STRING"
		),
//Жесткий диск
		"UPS" => array(
         	"PARENT" => "OTHER",
			"NAME" => "ИБП",
			"TYPE" => "STRING"
		),


//Колличество аккумуляторов
		"COUNT_ALKALINE" => array(
         	"PARENT" => "BASE",
			"NAME" => "Колличество аккумуляторов",
			"TYPE" => "STRING",
			"DEFAULT"=>1
		),
//Колличество мониторов
		"COUNT_DISPLAY" => array(
         	"PARENT" => "BASE",
			"NAME" => "Колличество мониторов",
			"TYPE" => "STRING",
			"DEFAULT"=>1
		),
//Колличество блоков резервного питания
		"COUNT_REZERV" => array(
         	"PARENT" => "BASE",
			"NAME" => "Колличество блоков резервного питания",
			"TYPE" => "STRING",
			"DEFAULT"=>1
		),
//Колличество жестких дисков
		"COUNT_HDD" => array(
         	"PARENT" => "BASE",
			"NAME" => "Колличество жестких дисков",
			"TYPE" => "STRING",
			"DEFAULT"=>1
		),

		"COUNT_UPS" => array(
         	"PARENT" => "BASE",
			"NAME" => "Колличество ИПБ",
			"TYPE" => "STRING",
			"DEFAULT"=>1
		),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000)
	),
);
?>
