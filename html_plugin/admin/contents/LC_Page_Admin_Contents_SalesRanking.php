<?php

// {{{ requires
require_once CLASS_EX_REALDIR . 'page_extends/admin/LC_Page_Admin_Ex.php';

/**
 * 週間売筋ランキング管理 のページクラス.
 *
 * @package Page
 * @author Takenori Kanazawa
 */
class LC_Page_Admin_Contents_SalesRanking extends LC_Page_Admin_Ex {

    // }}}
    // {{{ functions

    /**
     * Page を初期化する.
     *
     * @return void
     */
    function init() {
        parent::init();
        $this->tpl_mainpage		= 'contents/salesranking.tpl';
        $this->tpl_mainno		= 'contents';
        $this->tpl_subno		= 'salesranking';
        $this->tpl_maintitle	= 'コンテンツ管理';
        $this->tpl_subtitle		= '週間売筋ランキング管理';
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
        $objQuery =& SC_Query_Ex::getSingletonInstance();
		
        if ($this->getMode() == "regist") {
			// 商品を登録する。
			$objFormParam = new SC_FormParam_Ex();
			$objFormParam->addParam('集計期間1',			'start_interval',		INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
			$objFormParam->addParam('集計期間2',			'summary_week',			INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
			$objFormParam->addParam('スコア基準1',		'score_mark_status',	INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
			$objFormParam->addParam('スコア基準2',		'score_mark_date',		INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
			$objFormParam->addParam('スコア基準P',		'score_mark_point',		INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
			$objFormParam->addParam('ランキング最大',	'max_ranking',			INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
			$objFormParam->addParam('カテゴリ',			'category_flg',			INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
			$objFormParam->addParam('期間表示',			'disp_date_flg',		INT_LEN, 'n', array('EXIST_CHECK', 'NUM_CHECK', 'MAX_LENGTH_CHECK'));
			
			$objFormParam->setParam($_POST);
			$objFormParam->convParam();
			if ($this->updateSalesRankingData($objQuery,$objFormParam->getHashArray()))
			{
				$this->tpl_onload = "window.alert('更新が完了しました');";
			}
			else
			{
				$this->tpl_onload = "window.alert('更新に失敗しました');";
			}
        }
        $arrItem = $this->getSalesRankingData($objQuery);
		
        $this->arrItem = $arrItem;
		
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
     * 入力されたパラメーターのエラーチェックを行う。
     * @param Object $objFormParam
     * @return Array エラー内容
     */
    function lfCheckError(&$objFormParam) {
        $objErr = new SC_CheckError_Ex($objFormParam->getHashArray());
        $objErr->arrErr = $objFormParam->checkError();
        return $objErr->arrErr;
    }

    /**
     * 既に登録されている内容を取得する
	 * @param Object $objQuery queryオブジェクト
	 * 
     * @return Array $arrReturnProducts データベースに登録されている売筋ランキングの配列
     */
    function getSalesRankingData($objQuery) {
        $objQuery	= $objQuery =& SC_Query_Ex::getSingletonInstance();
        $col		= "*";
        $table		= "dtb_salesranking";
        $arrRow		= $objQuery->getRow($col, $table);
        return $arrRow;
    }

    /**
     * おすすめ商品の新規登録を行う。
	 * @param Object $objQuery queryオブジェクト
     * @param Array $arrPost POSTの値を格納した配列
	 * 
     * @return boole true=成功,false=失敗
     */
    function updateSalesRankingData($objQuery,$arrPost) {
        $sqlval = array();
		
        $sqlval['start_interval']		= $arrPost['start_interval'];
        $sqlval['summary_week']			= $arrPost['summary_week'];
        $sqlval['score_mark_status']	= $arrPost['score_mark_status'];
        $sqlval['score_mark_date']		= $arrPost['score_mark_status'] == 5 ? 1 : 0;
        $sqlval['score_mark_point']		= $arrPost['score_mark_point'];
        $sqlval['max_ranking']			= $arrPost['max_ranking'];
        $sqlval['category_flg']			= $arrPost['category_flg'];
        $sqlval['disp_date_flg']		= $arrPost['disp_date_flg'];
		
		try
		{
	        $objQuery->update('dtb_salesranking', $sqlval);
		}
		catch (Exception $e)
		{
			return false;
		}
		return true;
    }



}
