<!-- ▼売り上げランキング -->
<!--{if count($arrRankingItems) > 0}-->
    <style type="text/css">  
    <!-- 
    #salesranking_area {
        margin: 15px 10px 20px 10px;
        padding-top: 10px;
        border: #CCC solid 1px;
        border-radius: 8px;
        -webkit-border-radius: 8px;
        -moz-border-radius: 8px;
    }
    #salesranking_area h2 {
        font-size: 12px;
        margin-left: 10px;
    }
    
    .salesranking_block {
        width: 270px;
        padding: 5px 10px 5px 8px;
        margin: 0 auto;
        clear: both;
    }
    .salesranking_block img.salesrank {
        margin-top: 10px;
        margin-right: 7px;
        height: 27px;
        float: left;
    }
    .salesranking_block div.beforeRank {
        margin-top: 10px;
        font-size: 10px;
        height: 27px;
    }       
    

    .salesranking_block img.salesimage {
        width: 80px;
        float: left;
        border-radius: 10px;
    }       
    
    #salesranking_area .salesranking_block .productContents {
        float: left;
        margin-left: 10px;
        margin-bottom: 10px;
    }
    
    #salesranking_area .salesranking_block .productContents .comment {
        font-size: 10px;
    }
    #salesranking_area .salesranking_block .productContents .sale_price {
        font-size: 10px;
        color: red;
    }
    #salesranking_area .salesranking_block .productContents .price {
        font-size: 20px;
        font-style: italic; 
        color: white;
        text-shadow:
             3px  3px 0 #F00,
            -1px -1px 0 #F00,
             1px -1px 0 #F00,
            -1px  1px 0 #F00,
             1px  1px 0 #F00;          
    }
    -->  
    </style>  
    <div id="salesranking_area">
        <h2>週間売筋ランキング</h2>
        <ul>
            <!--{foreach from=$arrRankingItems item="arrProduct" name="sales_rankings"}-->
                <li id="salesranking_mainImage<!--{$smarty.foreach.sales_rankings.iteration}-->">
                    <div class="salesranking_block clearfix">
                        <img class="salesrank" src="<!--{$TPL_URLPATH}-->img/salesranking/rank_<!--{$smarty.foreach.sales_rankings.iteration}-->.jpg" alt="*"   />
                        <div class="beforeRank">
                        (前回<!--{$arrProduct.before_rank}-->位)
                        </div>

                        <img class="salesimage" src="<!--{$smarty.const.ROOT_URLPATH}-->resize_image.php?image=<!--{$arrProduct.main_list_image|sfNoImageMainList|h}-->&amp;width=80&amp;height=80" alt="<!--{$arrProduct.name|h}-->" />
                        <div class="productContents">
                            <h3><a rel="external" href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->"><!--{$arrProduct.name|h}--></a></h3>
                            <p class="mini comment"><!--{$arrProduct.main_list_comment}--></p>
                            <p class="sale_price">
                                <span class="mini"></span><span class="price">¥<!--{$arrProduct.price02_min_inctax|number_format}--></span>&nbsp;(税込)
                            </p>
                        </div>
                    </div>
                </li>
            <!--{/foreach}-->
        </ul>
    </div>
<!--{/if}-->
<!-- ▲おすすめ商品 -->
