<?
createForm($arResult['FILTERS']);
?>
<div class="solutionresult" id="resbutt"></div>
<div id="result">

</div>
<div id="resultbuy">

</div>

<script>
    $(document).ready(function(){
        
        //$("form").submit(function () { 
        $('#resbutt').click(function (){
            var request={
            	filters: {
                	count_camera: $('#count_camera').val(),
                    lenght_cabel: $('#lenght_cabel').val(),
                    days_record: $('#days_record').val(),
                    mobile_dev: ($('#mobile_dev').val()==GetMessage("LIST_YES")) ? true : false,
                    uninterrupted: ($('#uninterrupted').val()==GetMessage("LIST_YES")) ? true : false,
<?if(isset($arParams['CABELBOX'])&&$arParams['CABELBOX']!=''):?>
                	lenght_cabelCanal: $('#lenght_cabelCanal').val(),
<?endif;?>
<?if(isset($arParams['TOUBE'])&&$arParams['TOUBE']!=''):?>
                	lenght_gofra: $('#lenght_gofra').val(),
<?endif;?>
                },
                count: {<?=$arResult['POST_COUNT']?>},
                items: {<?=$arResult['POST_DATE']?>},
                path: '<?=$arParams["PATH"]?>',
                action: 'getTable'
            };
           $("#result").load("<?=$arParams['PATH'].'result.php'?>", request);
            return false; 
        });

        $('#buy').click(function (){
            alert('Добавить в корзину');
            var request={
                count_camera: $('#count_camera').val(),
                lenght_cabel: $('#lenght_cabel').val(),
<?if(isset($arParams['CABELBOX'])&&$arParams['CABELBOX']!=''):?>
                lenght_cabelCanal: $('#lenght_cabelCanal').val(),
<?endif;?>
<?if(isset($arParams['TOUBE'])&&$arParams['TOUBE']!=''):?>
                lenght_gofra: $('#lenght_gofra').val(),
<?endif;?>
                lenght_pvs: $('#lenght_pvs').val(),
                action: 'addbascet'
            };
            $("#result").load("<?=$arParams['PATH'].'result.php'?>", request);
        });
    });
</script>