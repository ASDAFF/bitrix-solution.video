bitrix-solution.video
=====================

Готовое решение видео

Присер подключения компонента:

<?$APPLICATION->IncludeComponent(
	"mycomponent:solutions.video",
	".default",
	Array(
		"VIDEREG4" => "22243",
		"VIDEREG8" => "22232",
		"VIDEREG4_MOBILE" => "22243",
		"VIDEREG8_MOBILE" => "22232",
		"VIDEOCAM" => array("22120"),
		"CABEL" => "23132",
		"TOUBE" => "24195",
		"CABELBOX" => "23918",
		"REZERV" => "1",
		"BP" => "2",
		"BNC" => "22509",
		"JACKP" => "22520",
		"ALKALINE" => "3",
		"HDD_500" => "4",
		"HDD_750" => "5",
		"HDD_1T" => "6",
		"COUNT_ALKALINE" => "1",
		"COUNT_REZERV" => "1",
		"COUNT_HDD" => "1",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000"
	),
false,
Array(
	'ACTIVE_COMPONENT' => 'Y'
)
);?> 