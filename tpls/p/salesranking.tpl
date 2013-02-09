<!--{if count($arrRankingItems) > 0}-->
    <style type="text/css">  
    <!-- 
    /************************************************
     ブロック用 salesranking
    ************************************************ */
    /* タイトルの背景 オレンジ */
    #salesranking_area h2 {
        padding: 5px 0 8px 10px;
        border-style: solid;
        border-color: #f90 #ccc #ccc;
        border-width: 1px 1px 0;
        background: url('<!--{$TPL_URLPATH}-->img/background/bg_btn_bloc_02.jpg') repeat-x left bottom #fef3d8;
    }

    /*============================================= */
    /* 共通
    ----------------------------------------------- */
    #salesranking_area .block_body {
        margin-bottom: 10px;
        padding: 10px 0 10px;
        border: none;
    }

   
    #salesranking_area .block_body p {
        margin: 0 0 5px 0;
    }

    #salesranking_area .block_body img {
        margin: 0 5px 0 0;
    }

    #salesranking_area .block_body h3 {
        font-size: 100%;
        font-weight: normal;
    }


    #salesranking_area .salesranking_product_item {
        clear: both;
        background: url('<!--{$TPL_URLPATH}-->img/background/line_dot_02.gif') repeat-x bottom;
    }
    #salesranking_area img.salesimage {
        border-radius: 20px;
    }
    #salesranking_area .block_body .productContents .price {
        font-style: italic; 
        color: white;
        text-shadow:
             3px  3px 0 #F00,
            -1px -1px 0 #F00,
             1px -1px 0 #F00,
            -1px  1px 0 #F00,
             1px  1px 0 #F00;  
    }       
    
    /* トップカラム */
    #topcolumn #salesranking_area .salesranking_product_item {
        height: 2px;
    }    
    #topcolumn #salesranking_area .block_body {
        background: url('<!--{$TPL_URLPATH}-->img/background/line_dot_01.gif') repeat-x bottom;
    }
    
    #topcolumn #salesranking_area .block_body .rankingImage {
        margin-top: 5px;
        width: 120px;
    }

    #topcolumn #salesranking_area .block_body .beforeRank {
        float: left;
        width: 120px;
    }    
    #topcolumn #salesranking_area .block_body .productImage {
        margin-right: 20px;
        margin-top: -30px;
        float: left;
    }
    
    #topcolumn #salesranking_area .block_body .productContents {
        float: left;
        margin-top: -30px;
        margin-bottom: 10px;
    }
    #topcolumn #salesranking_area img.salesimage {
        border-radius: 5px;
    }
    #topcolumn #salesranking_area .block_body .productContents h3 {
        font-size: 15px;
    }
    #topcolumn #salesranking_area .block_body .productContents .comment {
        font-size: 10px;
    }
    #topcolumn #salesranking_area .block_body .productContents .sale_price {
    }
    #topcolumn #salesranking_area .block_body .productContents .price {
        font-size: 17px;
    }    
    #topcolumn #salesranking_area img.salesimage {
        width: 60px;
    }
    
    #topcolumn #salesranking_area .salesrank {
        height: 35px;
    }
	#topcolumn .target_dates {
        text-align: right;
		font-size: 10px;
	}        
	#topcolumn .salesrankText {
        height: 35px;
		font-size: 20px;
	}
    /* メインカラム用 */
    .main_column #salesranking_area .block_body {
        background: url('<!--{$TPL_URLPATH}-->img/background/line_dot_01.gif') repeat-x bottom;
    }

    .main_column #salesranking_area .block_body .rankingImage {
        margin-bottom: 0px;
        float: left;
    }

    .main_column #salesranking_area .block_body .beforeRank {
        margin-bottom: 0px;
        clear: right;
        height: 110px;
    }
    
    .main_column #salesranking_area .block_body .productImage {
        margin-right: 20px;
        margin-bottom: 10px;
        float: left;
    }
    
    .main_column #salesranking_area .block_body .productContents {
        width :95%;
        height: 180px;
    }

    .main_column #salesranking_area .block_body .productContents h3 {
        font-size: 35px;
    }
    .main_column #salesranking_area .block_body .productContents .comment {
        font-size: 14px;
    }
   
    .main_column #salesranking_area .block_body .productContents .sale_price {
        margin-top: 50px;
        text-align: right;
    }
    .main_column #salesranking_area .block_body .productContents .price {
        font-size: 35px;
    }    
    .main_column #salesranking_area img.salesimage {
    }
    
    .main_column #salesranking_area .salesrank {
        
    }
	.main_column .target_dates {
        text-align: right;
		font-size: 10px;
	}    

	.main_column .salesrankText {
		font-size: 30px;
	}
	
    /* サイドカラム用 */
    .side_column #salesranking_area .block_body {
    }
    .side_column #salesranking_area .salesranking_product_item {
        margin-bottom: 10px;
    }
    .side_column #salesranking_area .block_body .beforeRank {
        margin-bottom: 0px;
        text-align: right;
    }    
    .side_column #salesranking_area .block_body .productImage {
        float: none;
        text-align: center;
        width: auto;
    }
    .side_column #salesranking_area .block_body .productContents {
        margin-bottom: 30px;
        clear: both;
    }
    .side_column #salesranking_area .block_body .productContents h3 {
        font-size: 18px;
        text-align: center;
    }
    .side_column #salesranking_area .block_body .productContents .comment {
        font-size: 10px;
    }
    .side_column #salesranking_area .block_body .productContents .sale_price {
        text-align: center;
    }
    .side_column #salesranking_area .block_body .productContents .price {
        font-size: 20px;
    }
    .side_column #salesranking_area img.salesrank {
        height: 55px;
    }
    .side_column #salesranking_area img.salesimage {
        width: 130px;
    }
    
	.side_column .target_dates {
        text-align: right;
		font-size: 7px;
	}
	.side_column .salesrankText {
		font-size: 20px;
	}
    -->  
    </style>  
    <div class="block_outer clearfix">
        <div id="salesranking_area">
            <h2><img src="<!--{$TPL_URLPATH}-->img/salesranking/tit_bloc_salesranking.jpg" alt="*" class="title_icon" /></h2>
            <div class="block_body clearfix">
                <!--{foreach from=$arrRankingItems item="arrProduct" name="sales_rankings"}-->
                    <div class="salesranking_product_item">
                        <div class="rankingImage">
                            <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->">
								<!--{if $smarty.foreach.sales_rankings.iteration < 6}-->
                                <img class="salesrank" src="<!--{$TPL_URLPATH}-->img/salesranking/rank_<!--{$smarty.foreach.sales_rankings.iteration}-->.jpg" alt="*"   />
								<!--{else}-->
								<div class="salesrankText">第<!--{$smarty.foreach.sales_rankings.iteration}-->位</div>
								<!--{/if}-->
                            </a>
                        </div>
                                
                        <div class="beforeRank">
                        (前回<!--{$arrProduct.before_rank}-->位)
                        </div>

                        <div class="productImage">
                            <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->">
                                <img class="salesimage" src="<!--{$smarty.const.ROOT_URLPATH}-->resize_image.php?image=<!--{$arrProduct.main_image|sfNoImageMainList|h}-->&amp;width=170&amp;height=170" alt="<!--{$arrProduct.name|h}-->" />
                            </a>
                        </div>
                        
                        <div class="productContents">
                            <h3>
                                <a href="<!--{$smarty.const.P_DETAIL_URLPATH}--><!--{$arrProduct.product_id|u}-->"><!--{$arrProduct.name|h}--></a>
                            </h3>
                            <p class="mini comment"><!--{$arrProduct.main_list_comment}--></p>
                            <p class="sale_price">
                                <span class="price">¥<!--{$arrProduct.price02_min_inctax|number_format}--></span>(税込)
                            </p>
                        </div>
                    </div>
                <!--{/foreach}-->
            </div>
			<!--{if $isDispDates}--><div class="target_dates">対象期間:<!--{$startDate|date_format:"%Y/%m/%d"}-->〜<!--{$endDate|date_format:"%Y/%m/%d"}--></div><!--{/if}-->
        </div>
    </div>
<!--{/if}-->
