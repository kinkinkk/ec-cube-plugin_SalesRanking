<?php
/**
 * プラグイン のアップデート用クラス.
 *
 * @package SalesRanking
 * @author Takenori Kanazawa
 * @version $Id: $
 */
class plugin_update{
   /**
     * アップデート
     * updateはアップデート時に実行されます.
     * 引数にはdtb_pluginのプラグイン情報が渡されます.
     * 
     * @param array $arrPlugin プラグイン情報の連想配列(dtb_plugin)
     * @return void
     */
    function update($arrPlugin) {
        // バージョン1.0.1からのアップデート
        if($arrPlugin['plugin_version'] == "v1.0.1"){
           plugin_update::update101($arrPlugin);
        }
    }
    
    /**
     * 1.0.1のアップデートを実行します.
     * @param type $param 
     */
    function update101($arrPlugin) {

        $objQuery =& SC_Query_Ex::getSingletonInstance();
		
		$objQuery->begin();
		try
		{
			// dtb_pluhinを更新します.
			plugin_update::updateDtbPluginVersion($objQuery, $arrPlugin['plugin_id'], "v1.1.0");

			plugin_update::insertDtbPluginHookpoint($objQuery, $arrPlugin['plugin_id']);
			
			
			mkdir(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/a", 0755);
			mkdir(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/a/contents", 0755);
			mkdir(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/html_plugin", 0755);
			mkdir(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/html_plugin/frontparts_bloc", 0755);
			mkdir(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/html_plugin/admin", 0755);
			mkdir(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/html_plugin/admin/contents", 0755);

			mkdir(PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/admin", 0755);
			mkdir(PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/admin/contents", 0755);

			plugin_update::remove_directory(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/frontparts_bloc");
			
			// 変更のあったファイルを上書きします.
			copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "SalesRanking.php",														PLUGIN_UPLOAD_REALDIR	. $arrPlugin['plugin_code'] . "/SalesRanking.php");
			copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "tpls/a/contents_subnavi_add_after.tpl",								PLUGIN_UPLOAD_REALDIR	. $arrPlugin['plugin_code'] . "/tpls/a/contents_subnavi_add_after.tpl");
			copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "tpls/a/contents/salesranking.tpl",										PLUGIN_UPLOAD_REALDIR	. $arrPlugin['plugin_code'] . "/tpls/a/contents/salesranking.tpl");
			copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "html_plugin/frontparts_bloc/SalesRankingBloc.php",						PLUGIN_UPLOAD_REALDIR	. $arrPlugin['plugin_code'] . "/html_plugin/frontparts_bloc/SalesRankingBloc.php");
			copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "html_plugin/admin/contents/SalesRankingSetting.php",					PLUGIN_UPLOAD_REALDIR	. $arrPlugin['plugin_code'] . "/html_plugin/admin/contents/SalesRankingSetting.php");
			copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "html_plugin/admin/contents/LC_Page_Admin_Contents_SalesRanking.php",	PLUGIN_UPLOAD_REALDIR	. $arrPlugin['plugin_code'] . "/html_plugin/admin/contents/LC_Page_Admin_Contents_SalesRanking.php");
			copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "tpls/p/salesranking.tpl",												PLUGIN_UPLOAD_REALDIR	. $arrPlugin['plugin_code'] . "/tpls/p/salesranking.tpl");
			copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "tpls/m/salesranking.tpl",												PLUGIN_UPLOAD_REALDIR	. $arrPlugin['plugin_code'] . "/tpls/m/salesranking.tpl");
			copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "tpls/s/salesranking.tpl",												PLUGIN_UPLOAD_REALDIR	. $arrPlugin['plugin_code'] . "/tpls/s/salesranking.tpl");
			
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/html_plugin/frontparts_bloc/SalesRankingBloc.php",					PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/frontparts_bloc/SalesRankingBloc.php");
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/html_plugin/admin/contents/SalesRankingSetting.php", 				PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/admin/contents/SalesRankingSetting.php");
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/html_plugin/admin/contents/LC_Page_Admin_Contents_SalesRanking.php", PLUGIN_HTML_REALDIR . $arrPlugin['plugin_code'] . "/admin/contents/LC_Page_Admin_Contents_SalesRanking.php");
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/p/salesranking.tpl",											DATA_REALDIR . "Smarty/templates/default/frontparts/bloc/salesranking.tpl");
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/m/salesranking.tpl",											DATA_REALDIR . "Smarty/templates/mobile/frontparts/bloc/salesranking.tpl");
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/s/salesranking.tpl",											DATA_REALDIR . "Smarty/templates/sphone/frontparts/bloc/salesranking.tpl");
			copy(PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/tpls/a/contents/salesranking.tpl", 									DATA_REALDIR . "Smarty/templates/admin/contents/salesranking.tpl");
			
			
			// 追記があればここへ追記
			// salesranking値保存用テーブル作成
			$objQuery->query("CREATE TABLE dtb_salesranking (start_interval smallint, summary_week smallint, score_mark_status smallint, score_mark_date smallint, score_mark_point smallint, max_ranking smallint, category_flg smallint, disp_date_flg smallint)");
			$objQuery->query("insert into dtb_salesranking  (start_interval, summary_week, score_mark_status, score_mark_date, score_mark_point, max_ranking, category_flg, disp_date_flg) values (0, 1, 5, 1, 1, 5, 1, 1)");
			
			
			$objQuery->commit();
			
			
			//exec("rm -rf " . str_replace(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR, "", getcwd()) . DATA_REALDIR . "Smarty/templates_c/admin/*.tpl.php");
		}
        catch (Exception $e)
        {
            $objQuery->rollback();
        }
    }
    
	/**
	 * ディレクトリ削除
	 */
	function remove_directory($dir) 
	{
		if ($handle = opendir("$dir")) 
		{
			while (false !== ($item = readdir($handle))) 
			{
				if ($item != "." && $item != "..") {
					if (is_dir("$dir/$item")) 
					{
						remove_directory("$dir/$item");
					} 
					else 
					{
						unlink("$dir/$item");
						//echo " removing $dir/$item<br>\n";
					}
				}
			}
			closedir($handle);
			rmdir($dir);
			//echo "removing $dir<br>\n";
		}
	}

    /**
     * dtb_pluginを更新します.
     * 
	 * @param DBobject 
     * @param int $plugin_id プラグインID
     * @param string $plugin_version プラグインバージョン
     * @return void
     */
    function updateDtbPluginVersion ($objQuery, $plugin_id, $plugin_version) {
        $sqlval = array();
        $table = "dtb_plugin";
        $sqlval['plugin_version'] = $plugin_version;
        $sqlval['compliant_version'] = "2.12.2";
        $sqlval['update_date'] = 'CURRENT_TIMESTAMP';
        $where = "plugin_id = ?";
        $objQuery->update($table, $sqlval, $where, array($plugin_id));        
    }
	
    /**
     * dtb_plugin_hookpointを追加します.
     * 
	 * @param DBobject 
     * @param int $plugin_id プラグインID
     * @return void
     */
    function insertDtbPluginHookpoint ($objQuery, $plugin_id) {

		$table = "dtb_plugin_hookpoint";
		
		if ($objQuery->count($table, "plugin_id =?", array($plugin_id)) == 0)
		{
			$id = $objQuery->nextVal('dtb_plugin_hookpoint_plugin_hookpoint_id');		

			$sqlval = array();
			$sqlval['plugin_hookpoint_id']	= $id;
			$sqlval['plugin_id']			= $plugin_id;
			$sqlval['hook_point']			= "prefilterTransform";
			$sqlval['callback']				= "prefilterTransform";
			$sqlval['create_date']			= 'CURRENT_TIMESTAMP';
			$sqlval['update_date']			= 'CURRENT_TIMESTAMP';
			$objQuery->insert($table, $sqlval);        
		}
    }
	
}
?>