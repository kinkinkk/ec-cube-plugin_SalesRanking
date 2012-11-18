<script type="text/javascript">
<!--
function lfnCheckSubmit( fm ){

	if(window.confirm("\u5185容を登録しても宜しいですか")){
		fm.submit();
		return true;
	}
}
//-->
</script>




<div id="admin-contents" class="contents-main">
	<form name="form_salesranking" method="post" action="?">
    <table class="list center" id="salesranking-table">
        <tr>
            <th>集計期間</th>
            <td>
				<select name="start_interval">
					<option value="0" <!--{if $arrItem.start_interval == 0}-->selected<!--{/if}-->>当日</option>
					<option value="1" <!--{if $arrItem.start_interval == 1}-->selected<!--{/if}-->>1日前</option>
					<option value="2" <!--{if $arrItem.start_interval == 2}-->selected<!--{/if}-->>2日前</option>
					<option value="3" <!--{if $arrItem.start_interval == 3}-->selected<!--{/if}-->>3日前</option>
				</select>から
				<select name="summary_week">
					<option value="1" <!--{if $arrItem.summary_week == 1}-->selected<!--{/if}-->>1週間分</option>
					<option value="2" <!--{if $arrItem.summary_week == 2}-->selected<!--{/if}-->>2週間分</option>
					<option value="3" <!--{if $arrItem.summary_week == 3}-->selected<!--{/if}-->>3週間分</option>
				</select>で算出する。
			</td>
		</tr>
        <tr>
            <th>スコア基準</th>
            <td>
				<select name="score_mark_status" id="score_mark_status">
					<option value="6" <!--{if $arrItem.score_mark_status == 6}-->selected<!--{/if}-->>入金済み</option>
					<option value="5" <!--{if $arrItem.score_mark_status == 5}-->selected<!--{/if}-->>発送済み</option>
				</select>より売上げとみなす。
				<hidden name="score_mark_date" id="score_mark_date" />
			</td>
		</tr>
        <tr>
            <th>ランキング数</th>
            <td>最大
				<select name="max_ranking">
					<option value="3" <!--{if $arrItem.max_ranking == 3}-->selected<!--{/if}-->>3位</option>
					<option value="4" <!--{if $arrItem.max_ranking == 4}-->selected<!--{/if}-->>4位</option>
					<option value="5" <!--{if $arrItem.max_ranking == 5}-->selected<!--{/if}-->>5位</option>
					<option value="6" <!--{if $arrItem.max_ranking == 6}-->selected<!--{/if}-->>6位</option>
					<option value="7" <!--{if $arrItem.max_ranking == 7}-->selected<!--{/if}-->>7位</option>
					<option value="8" <!--{if $arrItem.max_ranking == 8}-->selected<!--{/if}-->>8位</option>
					<option value="9" <!--{if $arrItem.max_ranking == 9}-->selected<!--{/if}-->>9位</option>
					<option value="10" <!--{if $arrItem.max_ranking == 10}-->selected<!--{/if}-->>10位</option>
				</select>まで表示する。
			</td>
		</tr>
        <tr>
            <th>該当期間の表示</th>
            <td>
				<input type="radio" name="disp_date_flg" id="disp_date_flg1" value="1" <!--{if $arrItem.disp_date_flg == 1}-->checked<!--{/if}--> /><label for="disp_date_flg1">表示する</label>
				<input type="radio" name="disp_date_flg" id="disp_date_flg0" value="0" <!--{if $arrItem.disp_date_flg == 0}-->checked<!--{/if}--> /><label for="disp_date_flg0">表示しない</label>
			</td>
		</tr>		
        <tr>
            <th>カテゴリランキング機能</th>
            <td>
				<input type="radio" name="category_flg" id="category_flg1" value="1" <!--{if $arrItem.category_flg == 1}-->checked<!--{/if}--> /><label for="category_flg1">使用する</label>
				<input type="radio" name="category_flg" id="category_flg0" value="0" <!--{if $arrItem.category_flg == 0}-->checked<!--{/if}--> /><label for="category_flg0">使用しない</label>
				<br />(カテゴリ一覧を表示した際、そのカテゴリ内の商品を対象としたランキング内容を表示します。)
			</td>
		</tr>
        <tr>
            <th>ポイント使用での商品売上げにて</th>
            <td>売筋ランキングの対象に
				<input type="radio" name="score_mark_point" id="score_mark_point1" value="1" <!--{if $arrItem.score_mark_point == 1}-->checked<!--{/if}--> /><label for="score_mark_point1">する</label>
				<input type="radio" name="score_mark_point" id="score_mark_point0" value="0" <!--{if $arrItem.score_mark_point == 0}-->checked<!--{/if}--> /><label for="score_mark_point0">しない</label>
			</td>
		</tr>
        <tr>
			<td colspan="2">
				<a class="btn-action" href="javascript:;" onclick="lfnCheckSubmit(document.form_salesranking); return false;"><span class="btn-next">この内容で更新する</span></a>
			</td>
		</tr>
    </table>
	<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />			
	<input type="hidden" name="mode" value="regist" />			
	</form>
</div>
