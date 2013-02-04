<?php
/* 
 * 週間売筋ランキングクラス
 */
class SalesRanking extends SC_Plugin_Base {

	//const QUERY_SELECT_PLUGIN_ID_BASE = "(SELECT plugin_id FROM dtb_plugin WHERE plugin_code='?' LIMIT 1)";

    /**
     * コンストラクタ
     * プラグイン情報(dtb_plugin)をメンバ変数をセットします.
		 * @param array $arrSelfInfo dtb_pluginの情報配列
     * @return void
     */
    public function __construct(array $arrSelfInfo) {
        parent::__construct($arrSelfInfo);
    }

    /**
     * インストール時に実行される処理を記述します.
     * @param array $arrPlugin dtb_pluginの情報配列
     * @return void
     */
    function install($arrPlugin) {
    	$queSelPluginId = $arrPlugin['plugin_id'];
    	$queStrDir = "plugin/" . $arrPlugin['plugin_code'] . "/";
    	// dtb_blocに必要なカラムを追加します.
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        
        $objQuery->begin();
        try 
        {
			$id1 = $objQuery->nextVal('dtb_bloc_bloc_id');
			$id2 = $objQuery->nextVal('dtb_bloc_bloc_id');
			$id3 = $objQuery->nextVal('dtb_bloc_bloc_id');
			
			$insertIntoDtbBloc = "INSERT INTO dtb_bloc (device_type_id, bloc_id, bloc_name, tpl_path, filename, php_path, deletable_flg, plugin_id, create_date, update_date) VALUES ";
			
            $objQuery->query($insertIntoDtbBloc . "(1,  " . $id1 . ", '週間売筋ランキング', 'salesranking.tpl', 'salesranking', '" . $queStrDir . "SalesRankingPage.php',  1, " . $queSelPluginId . ", NOW(), NOW())");
            $objQuery->query($insertIntoDtbBloc . "(2,  " . $id2 . ", '週間売筋ランキング', 'salesranking.tpl', 'salesranking', '" . $queStrDir . "SalesRankingPage.php',  1, " . $queSelPluginId . ", NOW(), NOW())");
            $objQuery->query($insertIntoDtbBloc . "(10, " . $id3 . ", '週間売筋ランキング', 'salesranking.tpl', 'salesranking', '" . $queStrDir . "SalesRankingPage.php',  1, " . $queSelPluginId . ", NOW(), NOW())");

			// template値保存用テーブル作成 1.2.0~
			$tplStoredDir = "default";
			// tpl移動データ
			$mvFilePaths = array();
			$mvFilePaths["directories"] = 
				array(HTML_REALDIR . "user_data/packages/default/img/salesranking",
					  HTML_REALDIR . "user_data/packages/sphone/img/salesranking",);
			$mvFilePaths[] = 
				array("from" => PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/tpls/p/salesranking.tpl",
						"to" => DATA_REALDIR . "Smarty/templates/default/frontparts/bloc/salesranking.tpl",);
			$mvFilePaths[] = 
				array("from" => PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/tpls/m/salesranking.tpl",
						"to" => DATA_REALDIR . "Smarty/templates/mobile/frontparts/bloc/salesranking.tpl",);
			$mvFilePaths[] = 
				array("from" => PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/tpls/s/salesranking.tpl",
						"to" => DATA_REALDIR . "Smarty/templates/sphone/frontparts/bloc/salesranking.tpl",);
			$mvFilePaths[] = 
				array("from" => PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/imgs/p/tit_bloc_salesranking.jpg",
						"to" => HTML_REALDIR . "user_data/packages/default/img/title/tit_bloc_salesranking.jpg",);
            for ($i = 1; $i <= 5; $i++) {
				$mvFilePaths[] = 
					array("from" => PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/imgs/p/rank_" . $i . ".jpg",
							"to" => HTML_REALDIR . "user_data/packages/default/img/salesranking/rank_" . $i . ".jpg",);
				$mvFilePaths[] = 
					array("from" => PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/imgs/s/rank_" . $i . ".jpg",
							"to" => HTML_REALDIR . "user_data/packages/sphone/img/salesranking/rank_" . $i . ".jpg",);
            }
			
			$objQuery->query("CREATE TABLE dtb_salesranking_skins (id serial primary key, name VARCHAR(1024), kana_name VARCHAR(2048), mv_file_paths text)");
			$objQuery->query("INSERT INTO dtb_salesranking_skins (name, kana_name, mv_file_paths) VALUES ('" . $tplStoredDir . "', 'デフォルト', '" . serialize($mvFilePaths) . "')");

			// salesranking値保存用テーブル作成 1.1.0~
			$objQuery->query("CREATE TABLE dtb_salesranking (start_interval smallint, summary_week smallint, score_mark_status smallint, score_mark_date smallint, score_mark_point smallint, max_ranking smallint, category_flg smallint, disp_date_flg smallint, skin_id smallint)");
			$objQuery->query("INSERT INTO dtb_salesranking  (start_interval, summary_week, score_mark_status, score_mark_date, score_mark_point, max_ranking, category_flg, disp_date_flg, skin_id) VALUES (0, 1, 5, 1, 1, 5, 1, 1, (SELECT id FROM dtb_salesranking_skins WHERE name ='" . $tplStoredDir . "'))");
			
            // ロゴファイルをhtmlディレクトリにコピーします.
            copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/logo.png", PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/logo.png");
            copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/SalesRankingPage.php", PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/SalesRankingPage.php");
            mkdir(PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code'] . "/frontparts_bloc",	0755);
            mkdir(PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code'] . "/admin",				0755);
            mkdir(PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code'] . "/admin/contents",		0755);
            copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/html_plugin/frontparts_bloc/SalesRankingBloc.php", 					PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/frontparts_bloc/SalesRankingBloc.php");
            copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/html_plugin/admin/contents/SalesRankingSetting.php", 				PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/admin/contents/SalesRankingSetting.php");
            copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/html_plugin/admin/contents/LC_Page_Admin_Contents_SalesRanking.php", PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/admin/contents/LC_Page_Admin_Contents_SalesRanking.php");

			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/p/salesranking.tpl", 			DATA_REALDIR . "Smarty/templates/default/frontparts/bloc/salesranking.tpl");
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/m/salesranking.tpl", 			DATA_REALDIR . "Smarty/templates/mobile/frontparts/bloc/salesranking.tpl");
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/s/salesranking.tpl", 			DATA_REALDIR . "Smarty/templates/sphone/frontparts/bloc/salesranking.tpl");
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/a/contents/salesranking.tpl", 	DATA_REALDIR . "Smarty/templates/admin/contents/salesranking.tpl");

        
            mkdir(HTML_REALDIR . "user_data/packages/default/img/salesranking", 0755);
            mkdir(HTML_REALDIR . "user_data/packages/sphone/img/salesranking", 0755);
            for ($i = 1; $i <= 5; $i++) {
                copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/images/rank_" . $i . ".jpg", HTML_REALDIR . "user_data/packages/default/img/salesranking/rank_" . $i . ".jpg");
                copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/images/rank_" . $i . ".jpg", HTML_REALDIR . "user_data/packages/sphone/img/salesranking/rank_" . $i . ".jpg");
            }
            copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/images/tit_bloc_salesranking.jpg", HTML_REALDIR . "user_data/packages/default/img/title/tit_bloc_salesranking.jpg");
			
			// 1.2.0~
			$mrDirPaths = array();
			$mrDirPaths["directories"] = 
				array(
					PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code'] . "/skins/",
					PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir,			
					PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/tpls/",
					PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/tpls/p",
					PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/tpls/m",
					PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/tpls/s",
					PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/imgs",
					PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/imgs/p",
					PLUGIN_HTML_REALDIR .  $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/imgs/s",);			
			foreach ($mrDirPaths["directories"] as $dir) {
				// ディレクトリ作成
				mkdir($dir,	0755);
			}
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/p/salesranking.tpl",			PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/tpls/p/salesranking.tpl");
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/m/salesranking.tpl",			PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/tpls/m/salesranking.tpl");
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/s/salesranking.tpl",			PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/tpls/s/salesranking.tpl");
            for ($i = 1; $i <= 5; $i++) {
                copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/images/rank_" . $i . ".jpg",		PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/imgs/p/rank_" . $i . ".jpg");
                copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/images/rank_" . $i . ".jpg",		PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/imgs/s/rank_" . $i . ".jpg");
            }
            copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/images/tit_bloc_salesranking.jpg",	PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/skins/" . $tplStoredDir . "/imgs/p/tit_bloc_salesranking.jpg");
			
			
            $objQuery->commit();
		}
        catch (Exception $e)
        {
            $objQuery->rollback();
			//$objQuery->query("UPDATE dtb_plugin SET plugin_description = 'エラーが発生した為、不完全な状態です。削除（アンインストール）してください！' WHERE plugin_id=" . $queSelPluginId);
			throw $e;
        }
        
    }

    /**
     * 削除時に実行される処理を記述します.
     * @param array $arrPlugin dtb_pluginの情報配列
     * @return void
     */
    function uninstall($arrPlugin) {
    	$queSelPluginId = $arrPlugin['plugin_id'];
    	
        // dtb_blocから不要なカラムを削除します.
    	$objQuery =& SC_Query_Ex::getSingletonInstance();
		
		$dbFactory = SC_DB_DBFactory::getInstance();
		
		$dropTableList = $dbFactory->findTableNames("dtb_salesranking");

		$objQuery->begin();		
		// salesranking値保存用テーブル削除
		$objQuery->query("DELETE FROM dtb_blocposition WHERE bloc_id IN (SELECT bloc_id FROM dtb_bloc WHERE plugin_id = ". $queSelPluginId . ")");
		$objQuery->query("DELETE FROM dtb_bloc WHERE plugin_id = ". $queSelPluginId);
		
		foreach ($dropTableList as $dropTable) {
			$objQuery->query("DROP TABLE " . $dropTable);
		}
        $objQuery->commit();

		
        unlink(DATA_REALDIR . "Smarty/templates/default/frontparts/bloc/salesranking.tpl");
        unlink(DATA_REALDIR . "Smarty/templates/mobile/frontparts/bloc/salesranking.tpl");
        unlink(DATA_REALDIR . "Smarty/templates/sphone/frontparts/bloc/salesranking.tpl");
        unlink(DATA_REALDIR . "Smarty/templates/admin/contents/salesranking.tpl");

        for ($i = 1; $i <= 5; $i++) {
            unlink(HTML_REALDIR . "user_data/packages/default/img/salesranking/rank_" . $i . ".jpg");
            unlink(HTML_REALDIR . "user_data/packages/sphone/img/salesranking/rank_" . $i . ".jpg");
        }
        rmdir(HTML_REALDIR . "user_data/packages/default/img/salesranking");
        rmdir(HTML_REALDIR . "user_data/packages/sphone/img/salesranking");
        unlink(HTML_REALDIR . "user_data/packages/default/img/title/tit_bloc_salesranking.jpg");
		
    }
    
    /**
     * 有効にした際に実行される処理を記述します.
     * @param array $arrPlugin dtb_pluginの情報配列
     * @return void
     */
    function enable($arrPlugin) {
    	$queSelPluginId = $arrPlugin['plugin_id'];

        // dtb_blocから不要なカラムを削除します.
    	$objQuery =& SC_Query_Ex::getSingletonInstance();
        $objQuery->query("UPDATE dtb_bloc SET deletable_flg = 0, update_date = now() WHERE plugin_id = ". $queSelPluginId);
    }

    /**
     * 無効にした際に実行される処理を記述します.
     * @param array $arrPlugin dtb_pluginの情報配列
     * @return void
     */
    function disable($arrPlugin) {
    	$queSelPluginId = $arrPlugin['plugin_id'];

        // dtb_blocから不要なカラムを削除します.
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $objQuery->query("UPDATE dtb_bloc SET deletable_flg = 1, update_date = now() WHERE plugin_id = ". $queSelPluginId);

    }


    /**
     * prefilterコールバック関数
     * テンプレートの変更処理を行います.
     *
     * @param string &$source テンプレートのHTMLソース
     * @param LC_Page_Ex $objPage ページオブジェクト
     * @param string $filename テンプレートのファイル名
     * @return void
     */
    function prefilterTransform(&$source, LC_Page_Ex $objPage, $filename) {
        // SC_Helper_Transformのインスタンスを生成.
        $objTransform = new SC_Helper_Transform($source);
        // 呼び出し元テンプレートを判定します.
        switch($objPage->arrPageLayout['device_type_id']){
            case DEVICE_TYPE_MOBILE: // モバイル
            case DEVICE_TYPE_SMARTPHONE: // スマホ
            case DEVICE_TYPE_PC: // PC
            case DEVICE_TYPE_ADMIN: // 管理画面
            default:
                // 管理画面コンテンツサブナビ
                if (strpos($filename, 'contents/subnavi.tpl') !== false) {
                    // divタグのclass=now_dir要素をプラグイン側で用意したテンプレートと置き換えます.
					$template_dir = PLUGIN_UPLOAD_REALDIR . $this->arrSelfInfo['plugin_code'] . '/tpls/a/';
                    $objTransform->select('#navi-contents-recommend')->insertAfter(file_get_contents($template_dir . 'contents_subnavi_add_after.tpl'));
                }
                break;
        }

        // 変更を実行します
        $source = $objTransform->getHTML();
    }


}
?>