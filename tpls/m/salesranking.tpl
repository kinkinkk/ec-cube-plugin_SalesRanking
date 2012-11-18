<!--{strip}-->
    <!--{if count($arrRankingItems) > 0}-->
    <font color="#ff00ff">★</font>週間売筋ランキング<br>
        <!--{foreach from=$arrRankingItems item="arrProduct" name="sales_rankings"}-->

            &nbsp;&nbsp;第<!--{$smarty.foreach.sales_rankings.iteration}-->位&nbsp;(前回<!--{$arrProduct.before_rank}-->位)<br>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="<!--{$smarty.const.MOBILE_P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->">
                 
                 
            <!--{$arrProduct.name}--></a>&nbsp;&nbsp;¥<!--{$arrProduct.price02_min_inctax|number_format}-->&nbsp;
            <br>

        <!--{/foreach}-->
		<!--{if $isDispDates}-->対象期間:<br />　<!--{$startDate|date_format:"%Y/%m/%d"}-->〜<br />　<!--{$endDate|date_format:"%Y/%m/%d"}--></div><!--{/if}-->
        <hr>

    <!--{/if}-->
<!--{/strip}-->
