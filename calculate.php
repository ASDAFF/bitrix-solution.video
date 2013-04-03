<?
//require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include.php");
if(!CModule::IncludeModule("sale")) return GetMessage("M_SALE_MISSING");
if(!CModule::IncludeModule("catalog")) return GetMessage("M_CATALOG_MISSING");

class solutionCalculate{
    function createForm($arFilters, $method="GET", $action=""){
        echo "<form action='".$action."' method='".$method."' name='fmcalc'>";
        echo "<table style='margin: 30px 10px 10px 10px; width: 70%'>";
        foreach($arFilters as $element){
            echo "<tr style='border-bottom: 1px solid red'><td style='padding-top:7px'>".$element["TITLE"]."</td><td>";
                switch($element["TYPE"]){
                    case "integer" : echo "<input style='border: 1px solid grey; text-align: right; padding:2px; width:100px; height:14px' type='TEXT' size='3' id='".$element["NAME"]."' value='".$element["DEFAULT"]."'><br>"; break;
                    case "textarea" : echo "<textarea id='".$element["NAME"]."'>".$element["DEFAULT"]."</textarea><br>"; break;
                    case "string" : echo "<input type='TEXT' size='3' id='".$element["NAME"]."' value='".$element["DEFAULT"]."'><br>"; break;
                    case "list" : 
                        echo "<select id='".$element["NAME"]."' style='border: 1px solid grey; background:#fff; text-align: right; width:107px; height:20px'>"; 
                        foreach($element["VALUE"] as $option){
                            echo "<option value='".$option."'>".$option."</option>";
                        }
                        echo "</select>";
                    break;
                }
            echo "</td></tr>";
        }
        echo "</table><input type='submit' name='calculate' value='".GetMessage("TITLE_CALCULATE")."'> </form>";        
    }
    
    function getTableItems($arItems){
        $sum=0;
        $num=0;
        echo "<table class='solutionList' style='margin-top:10px'>";
        echo "<tr><th class='listTitle'>".GetMessage("TITLE_NAME")."</th><th>".GetMessage("TITLE_PRICE")."</th><th>".GetMessage("TITLE_COUNT")."</th><th>".GetMessage("TITLE_SUMM")."</th></tr>";
        foreach($arItems as $item){
          $tovar=CCatalogProduct::GetByIDEx($item["ID"]);
          if(intval($item["COUNT"])>0){
            if(intval($item["COUNT"])<=$tovar["PRODUCT"]["QUANTITY"]){
                if($num%2==0) echo "<tr class='solutionDark'><td style='text-align:left;'>".$tovar["NAME"]."</td><td align='right' style='padding:3px'>".$tovar["PRICES"][2]["PRICE"].GetMessage("CURRENCY")." </td><td align='center' style='padding:3px'>".$item["COUNT"]."</td><td align='right' style='padding:3px'>".($tovar["PRICES"][2]["PRICE"]*$item["COUNT"]).GetMessage("CURRENCY")."</td></tr>";
                else echo "<tr class='solutionLight'><td style='text-align:left;'>".$tovar["NAME"]."</td><td align='right' style='padding:3px'>".$tovar["PRICES"][2]["PRICE"].GetMessage("CURRENCY")." </td><td align='center' style='padding:3px'>".$item["COUNT"]."</td><td align='right' style='padding:3px'>".($tovar["PRICES"][2]["PRICE"]*$item["COUNT"]).GetMessage("CURRENCY")."</td></tr>";
                $sum+=($tovar["PRICES"][2]["PRICE"]*$item["COUNT"]);
            }else{
                if($num%2==0) echo "<tr class='solutionDark'><td style='text-align:left;'>".$tovar["NAME"]."</td><td align='right' style='padding:3px'>".$tovar["PRICES"][2]["PRICE"].GetMessage("CURRENCY")." </td><td align='center' style='padding:3px'>".GetMessage("NOT_AVAILABLE")."</td><td align='right' style='padding:3px'> - </td></tr>";
                else echo "<tr class='solutionLight'><td style='text-align:left;'>".$tovar["NAME"]."</td><td align='right' style='padding:3px'>".$tovar["PRICES"][2]["PRICE"].GetMessage("CURRENCY")." </td><td align='center' style='padding:3px'>".GetMessage("NOT_AVAILABLE")."</td><td align='right' style='padding:3px'>".($tovar["PRICES"][2]["PRICE"]*$item["COUNT"]).GetMessage("CURRENCY")."</td></tr>";
                
            }
            $num++;    
          }
        }
        echo "<tr><td style='padding:5px;text-align:left;'><b>".GetMessage("TITLE_SUMM").":</b></td><td align='center' style='padding:5px'>-</td><td align='center' style='padding:5px'>-</td><td align='right' style='padding:5px'><b>".$sum.GetMessage("CURRENCY")."</b></td></tr>";
        echo "</table><div class='solutionbuy' id='buy'></div>";  
        //<input type='button' id='buy' value='Добавить в корзину'>      
    }
    
    function addToBascket($arItems){
        $num = 0;
        foreach($arItems as $item){
            $tovar=CCatalogProduct::GetByIDEx($item["ID"]);
            if(intval($item["COUNT"])<=$tovar["PRODUCT"]["QUANTITY"]&&intval($item["COUNT"])>0){
                Add2BasketByProductID($item["ID"],intval($item["COUNT"]));
                $num++;
            }
        }
       ?> 
       
       <script>
                
                $(".CartLink span").text('(<?=$num?>)');
                $('body,html').animate({scrollTop: 0}, 2);
       </script>

       <?
    }
    
    function getNmuBasket(){
        $dbBasketItems = CSaleBasket::GetList(
        array(
                "NAME" => "ASC",
                "ID" => "ASC"
                ),
        array(
                "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                "LID" => SITE_ID,
                "ORDER_ID" => "NULL"
                ),
        false,
        false,
        array()
        );
        $num=0;
        while($basket=$dbBasketItems->Fetch()) $num++;
        return $num;
    }
}
?>