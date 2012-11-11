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
        // バージョン1.0からのアップデート
        if($arrPlugin['plugin_version'] == "v1.0"){
           //plugin_update::update01($arrPlugin);
        }
    }
    
    /**
     * 1.0のアップデートを実行します.
     * @param type $param 
     */
    function update01($arrPlugin) {
        // 変更のあったファイルを上書きします.
        copy(DOWNLOADS_TEMP_PLUGIN_UPDATE_DIR . "/SalesRanking.php", PLUGIN_UPLOAD_REALDIR . $arrPlugin['plugin_code'] . "/SalesRanking.php");
        // dtb_pluhinを更新します.
        plugin_update::updateDtbPluginVersion($arrPlugin['plugin_id'], "1.1");
    }
    
    /**
     * dtb_pluginを更新します.
     * 
     * @param int $plugin_id プラグインID
     * @return void
     */
    function updateDtbPluginVersion ($plugin_id, $plugin_version) {
        $objQuery =& SC_Query_Ex::getSingletonInstance();
        $sqlval = array();
        $table = "dtb_plugin";
        $sqlval['plugin_version'] = $plugin_version;
        $sqlval['compliant_version'] = "2.12.2";
        $sqlval['update_date'] = 'CURRENT_TIMESTAMP';
        $where = "plugin_id = ?";
        $objQuery->update($table, $sqlval, $where, array($plugin_id));        
    }
}
?>