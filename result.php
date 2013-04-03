<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once("calculate.php");


class solutionVideo extends solutionCalculate{
    
    function getListItems($arFilters, $arItems, $arParams){
    	//echo "123";
        foreach($arItems as $key=>$item){
        	//echo $key."<br>";
            switch($key){
                case "VIDEOCAM": 
                    if(is_array($item)){
                        foreach ($item as $k=>$videocam){
                    		$count=$arFilters["count_camera"]/count($item);
                    		if(($k+1)<=($arFilters["count_camera"]%count($item))) $count++;
                    		$result[]=Array(
                				"ID"=>$videocam,
                				"COUNT"=>$count
                			);
                        }
                    }else{
                    	$result[]=Array(
                			"ID"=>$item[0],
                			"COUNT"=>$arFilters["count_camera"]
                		);
                    }
                break;
                case "VIDEREG4": 
                    if($arFilters["count_camera"]==4&&!$arFilters["mobile_dev"]){
                        $result[]=Array(
                            "ID"=>$item,
                            "COUNT"=>1
                        );
                    }
                break;
                case "VIDEREG8": 
                    if($arFilters["count_camera"]==8&&!$arFilters["mobile_dev"]){
                        $result[]=Array(
                            "ID"=>$item,
                            "COUNT"=>1
                        );
                    }
                break;
                case "VIDEREG4_MOBILE": 
                    if($arFilters["count_camera"]==4&&$arFilters["mobile_dev"]){
                        $result[]=Array(
                            "ID"=>$item,
                            "COUNT"=>1
                        );
                    }
                break;
                case "VIDEREG8_MOBILE": 
                    if($arFilters["count_camera"]==8&&$arFilters["mobile_dev"]){
                        $result[]=Array(
                            "ID"=>$item,
                            "COUNT"=>1
                        );
                    }
                break;
                case "CABEL": 
                		$result[]=Array(
                			"ID"=>$item,
                			"COUNT"=>$arFilters['lenght_cabel']
                		);
                break;
                case "TOUBE": 
                	if(isset($item)&&$item!=''){
                		$result[]=Array(
                			"ID"=>$item,
                			"COUNT"=>$arFilters['lenght_gofra']
                		);
                	}
                break;
                case "CABELBOX": 
                	if(isset($item)&&$item!=''){
                		$result[]=Array(
                			"ID"=>$item,
                			"COUNT"=>$arFilters['lenght_cabelCanal']
                		);
                	}
                break;
                case "REZERV": 
                    if(isset($item)&&$item!=''&&$arFilters['uninterrupted']){
                        $result[]=Array(
                            "ID"=>$item,
                            "COUNT"=>$arParams['COUNT_REZERV']
                        );
                    }
                break;
                case "BP": 
                    if(isset($item)&&$item!=''&&!$arFilters['uninterrupted']){
                        $result[]=Array(
                            "ID"=>$item,
                            "COUNT"=>$arParams['COUNT_REZERV']
                        );
                    }
                break;
                case "BNC": 
                	if(isset($item)&&$item!=''){
                		$result[]=Array(
                			"ID"=>$item,
                			"COUNT"=>$arFilters['count_camera']*2
                		);
                	}
                break;
                case "JACKP": 
                	if(isset($item)&&$item!=''){
                		$result[]=Array(
                			"ID"=>$item,
                			"COUNT"=>$arFilters['count_camera']
                		);
                	}
                break;
                case "ALKALINE": 
                	if(isset($item)&&$item!=''&&$arFilters['uninterrupted']){
                		$result[]=Array(
                			"ID"=>$item,
                			"COUNT"=>$arParams['COUNT_ALKALINE']
                		);
                	}
                break;
                case "HDD_500": 
                    if(isset($item)&&$item!=''&&$arFilters['days_record']==7){
                        $result[]=Array(
                            "ID"=>$item,
                            "COUNT"=>$arParams['COUNT_HDD']
                        );
                    }
                break;
                case "HDD_750": 
                    if(isset($item)&&$item!=''&&$arFilters['days_record']==14){
                        $result[]=Array(
                            "ID"=>$item,
                            "COUNT"=>$arParams['COUNT_HDD']
                        );
                    }
                break;
                case "HDD_1T": 
                    if(isset($item)&&$item!=''&&$arFilters['days_record']==28){
                        $result[]=Array(
                            "ID"=>$item,
                            "COUNT"=>$arParams['COUNT_HDD']
                        );
                    }
                break;
            }
            //$result[]=$item;
        }

        return $result;        
    }
}


// Добавляем в корзину
if($_POST['action']=='addbascet'){
    echo "<div style='font-size: 14px; font-weight: bold;color: red;width: 100%;margin: 40px 0px 0px 0px;' align='center'>".GetMessage("NOT_ADD_CART")."</div>";
    solutionVideo::addToBascket($_POST['items']);
}

//Вывод списка товаров
if($_POST['action']=='getTable'){
    $arItems=solutionVideo::getListItems($_POST['filters'],$_POST['items'],$_POST['count']);
    solutionVideo::getTableItems($arItems);
    foreach ($arItems as $key => $value) {
        if($value['COUNT']>0)
            $arResult['POST_DATE'].=$key.": {ID: '".$value['ID']."', COUNT: '".$value['COUNT']."'},";
    }
}
?>

<script>
    $(document).ready(function(){

        $('#buy').click(function (){
            var request={
                items: {<?=$arResult["POST_DATE"]?>},
                action: 'addbascet'
            };
            $("#resultbuy").load("<?=$_POST['path'].'result.php'?>", request);
        });
    });
</script>