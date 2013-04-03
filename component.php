
<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
    function createForm($arFilters, $method="GET", $action=""){
        echo "<div style='display:block;'><div class='solutionlogo'></div>";//<img src='/bitrix/components/mycomponent/solutions.video/templates/.default/images/video.jpg' style='float:left' />";
        echo "<form action='".$action."' method='".$method."' name='fmcalc' style='margin-left:350px'>";
        echo "<table style='margin: 30px 10px 10px 10px; '>";
        foreach($arFilters as $element){
            echo "<tr><td style='padding-top:20px; padding-right:10px; text-align:right; color:#666;'>".$element["TITLE"]."</td><td>";
                switch($element["TYPE"]){
                    case "integer" :?>

<div class="textBx">
    <div class="fillColor">
        <div class="t_line"></div>
        <div class="l_line"></div>
        <input type='TEXT' size='3' id='<?=$element["NAME"]?>' value='<?=$element["DEFAULT"]?>' />
        <div class="r_line"></div>
        <div class="b_line"></div>
    </div>
    <SPAN class="plus" onclick="changeNum('<?=$element["NAME"]?>',10)"></SPAN>
    <SPAN class="minus" onclick="changeNum('<?=$element["NAME"]?>',-10)"></SPAN>
</div>

<script>
function changeNum(objName, step){
    var obj = $('#'+objName);
    var startNum = parseInt(obj.val());
    if (startNum+step>=0) {
        obj.val(startNum+step);
    }
}
</script>
                    <?
                    break;
                    case "textarea" : echo "<textarea id='".$element["NAME"]."'>".$element["DEFAULT"]."</textarea><br>"; break;
                    case "string" : echo "<input type='TEXT' size='3' id='".$element["NAME"]."' value='".$element["DEFAULT"]."'><br>"; break;
                    case "list" : ?>

    <div class="dropdown">
      <select id='<?=$element["NAME"]?>' class="dropdown-select">
        <?foreach ($element["VALUE"] as $option):?>
        <option value="<?=$option?>"><?=$option?></option>
        <?endforeach;?>
      </select>
    </div>


                     <?  /* echo "<select id='".$element["NAME"]."' style='border: 1px solid grey; background:#fff; text-align: right; width:107px; height:20px'>"; 
                        foreach($element["VALUE"] as $option){
                            echo "<option value='".$option."'>".$option."</option>";
                        }
                        echo "</select>";*/
                    break;
                }
            echo "</td></tr>";
        }
        echo "</table> </form></div>";
        //<input type='submit' name='calculate' value='Расчитать' style='margin-left:420px;'>        
    }
$arParams["PATH"] = $this->GetPath().'/';

//Поля формы
$arResult['FILTERS'] = Array(
    Array(
        "TITLE" => "Количество видеокамер, шт",
        "TYPE" => "list",
        "VALUE"=>Array(4,8,16),
        "NAME" => "count_camera",
        "DEFAULT" => "0"
    ),
    Array(
        "TITLE" => "Кабель радиочастотный комбинированный, м",
        "TYPE" => "integer",
        "NAME" => "lenght_cabel",
        "DEFAULT" => "0"
    ),
    Array(
        "TITLE" => "Провод ПВС, м",
        "TYPE" => "integer",
        "NAME" => "lenght_pvs",
        "DEFAULT" => "0"
    ),
);
if(isset($arParams['CABELBOX'])&&$arParams['CABELBOX']!=''){
	$arResult['FILTERS'][]=Array(
        "TITLE" => "Кабель-канал, м",
        "TYPE" => "integer",
        "NAME" => "lenght_cabelCanal",
        "DEFAULT" => "0"
    );
}if(isset($arParams['TOUBE'])&&$arParams['TOUBE']!=''){
	$arResult['FILTERS'][]=Array(
        "TITLE" => "Труба гофрированная, м",
        "TYPE" => "integer",
        "NAME" => "lenght_gofra",
        "DEFAULT" => "0"
    );
}
foreach ($arParams as $key => $param){
	if(substr ($key, 0, 5)=='COUNT'){
		$arResult['POST_COUNT'].=$key.": '".$param."',";
	}elseif(isset($param)&&$param!=''&&substr ($key, 0, 1)!='~'&&$key!='CACHE_TYPE'&&!in_array($key,Array('CACHE_TYPE','CACHE_TIME','PATH'))){
		if(is_array($param)){
            $arEl=Array();
			foreach ($param as $i=>$cur){
				if($cur!='') $arEl[]=$i.": '".$cur."'";
			}
			$arResult['POST_DATE'].=$key.": {".implode(',', $arEl)."},";	
		} 
		else $arResult['POST_DATE'].=$key.": '".$param."',";
	}
}

/*echo "<pre>";
print_r($arResult['POST_DATE']);
echo "</pre>";*/
$this->IncludeComponentTemplate();
?>