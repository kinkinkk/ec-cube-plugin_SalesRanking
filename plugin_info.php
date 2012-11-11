<?php

/**
 * プラグイン の情報クラス.
 *
 * @package SalesRanking
 * @author Takenori Kanazawa
 * @version $Id: $
 */
class plugin_info{
    /** プラグインコード(必須)：プラグインを識別する為キーで、他のプラグインと重複しない一意な値である必要がありま. */
    static $PLUGIN_CODE       = "SalesRankingKNZTK";
    /** プラグイン名(必須)：EC-CUBE上で表示されるプラグイン名. */
    static $PLUGIN_NAME       = "週間売筋ランキング";
    /** プラグインバージョン(必須)：プラグインのバージョン. */
    static $PLUGIN_VERSION    = "v1.1.0";
    /** 対応バージョン(必須)：対応するEC-CUBEバージョン. */
    static $COMPLIANT_VERSION = "2.12.2";
    /** 作者(必須)：プラグイン作者. */
    static $AUTHOR            = "金沢 武範";
    /** 説明(必須)：プラグインの説明. */
    static $DESCRIPTION       = "週間売筋ランキングを好きなページに設置することができます。\r\n(管理画面のデザイン管理→レイアウト設定に「週間売筋ランキング」が表示されます。)\r\n本日〜７日前の対応状況が発送済みの分で集計を行います。";
    /** プラグインURL：プラグイン毎に設定出来るURL（説明ページなど） */
    static $PLUGIN_SITE_URL   = "";
    /** プラグイン作者URL：プラグイン毎に設定出来るURL（説明ページなど） */
    static $AUTHOR_SITE_URL   = "";
    /** クラス名(必須)：プラグインのクラス（拡張子は含まない） */
    static $CLASS_NAME       = "SalesRanking";
    /** フックポイント：フックポイントとコールバック関数を定義します */
    static $HOOK_POINTS       = array(
		array("prefilterTransform", 'prefilterTransform'),
		
		
	);
    /** ライセンス */
    static $LICENSE        = "LGPL";
}
?>