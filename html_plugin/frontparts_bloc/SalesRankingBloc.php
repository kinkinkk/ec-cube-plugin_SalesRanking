<?php

// {{{ requires
require_once CLASS_EX_REALDIR . 'page_extends/frontparts/bloc/LC_Page_FrontParts_Bloc_Ex.php';

/**
 * 週間売筋ランキング のページクラス.
 *
 * @package Page
 * @author Takenori Kanazawa
 * @version $Id: SalesRankingBloc 21935 2012-09-17 10:30:41Z pineray $
 */
class SalesRankingBloc extends LC_Page_FrontParts_Bloc_Ex {

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
    }

    /**
     * Page のプロセス.
     *
     * @return void
     */
    function process() {
        $this->action();
        $this->sendResponse();
    }

    /**
     * Page のアクション.
     *
     * @return void
     */
    function action() {
        // 基本情報を渡す
        $objSiteInfo = SC_Helper_DB_Ex::sfGetBasisData();
        $this->arrInfo = $objSiteInfo->data;

        // 週間売筋ランキングをセット
        $this->arrRankingItems = $this->lfGetSalesRanking();
        
    }

    /**
     * デストラクタ.
     *
     * @return void
     */
    function destroy() {
        parent::destroy();
    }
    

    /**
     * 週間売筋ランキング取得.
     *
     * @return array $arrRankingItems 検索結果配列
     */
    function lfGetSalesRanking() {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objProduct = new SC_Product_Ex();

		$interval0 	= date("Y-m-d")							. " 00:00:00";
		$interval7 	= date("Y-m-d", strtotime("-7 day"))	. " 00:00:00";
		$interval14 = date("Y-m-d", strtotime("-14 day")) 	. " 00:00:00";
		
		$this->endDate		= $interval0;
		$this->startDate	= $interval7;
		
        $str = <<< __EOS__
SELECT 

	GR.product_id, 
	GR.summary,
	DP.name,
	DP.main_list_comment,
	DP.main_comment,
	DP.main_list_image,
	DP.main_image,
	DP.main_large_image,
	PR.price01_min,
	PR.price01_max,
	PR.price02_min,
	PR.price02_max,
	'--' AS before_rank
FROM 
	(
		SELECT product_id, SUM(quantity) as summary 
		FROM    
			(
				SELECT
					DOD.product_id,
					DOD.quantity
				FROM
					dtb_order as DD 
				INNER JOIN
					dtb_order_detail as DOD 
					ON 
					DOD.order_id = DD.order_id
				WHERE
						DD.del_flg = 0
					AND
						DD.status = 5
					AND
						DD.commit_date 
						BETWEEN 
							'$interval7' 
						AND 
							'$interval0' 
			) AS OG
		GROUP BY 
			OG.product_id
		LIMIT 5
	) AS GR
INNER JOIN 
	dtb_products AS DP ON GR.product_id = DP.product_id AND DP.del_flg = 0 AND DP.status = 1
INNER JOIN
	(
		SELECT 
			product_id,
			MIN(price01) AS price01_min,
			MAX(price01) AS price01_max,
			MIN(price02) AS price02_min,
			MAX(price02) AS price02_max
		FROM 
			dtb_products_class
		WHERE 
			del_flg = 0 
		GROUP BY 
			product_id
	) AS PR 
	ON
		PR.product_id = GR.product_id
ORDER BY GR.summary DESC
__EOS__;
        
        $arrRankingItems = $objQuery->getAll($str);
        
        $objProduct->setIncTaxToProducts($arrRankingItems);
        
        
        // ２週間前のランキング取得
        $str2 = <<< __EOS__
SELECT GR.product_id FROM 
(
SELECT 
	OG.product_id, 
	SUM(OG.quantity) as summary 
FROM    
	(
		SELECT
			DOD.product_id,
			DOD.quantity
		FROM
			dtb_order as DD 
		INNER JOIN
			dtb_order_detail as DOD 
			ON 
			DOD.order_id = DD.order_id
		WHERE
				DD.del_flg = 0
			AND
				DD.status = 5
			AND
				DD.commit_date 
				BETWEEN 
					'$interval14' 
				AND 
					'$interval7' 
	) AS OG
GROUP BY 
	OG.product_id
LIMIT 5
) GR
ORDER BY GR.summary DESC
__EOS__;
        
        $arrRankingItems2 = $objQuery->getAll($str2);        
        
        $beforeRank = 1;
        foreach ($arrRankingItems2 as $arrRankingItem2)
        {
            foreach ($arrRankingItems as $key => $arrRankingItem)
            {
                if ($arrRankingItem["product_id"] == $arrRankingItem2["product_id"])
                {
                    $arrRankingItems[$key]["before_rank"] = $beforeRank++;
                    break;
                }
            }
        }
        
        return $arrRankingItems;
    }

}
