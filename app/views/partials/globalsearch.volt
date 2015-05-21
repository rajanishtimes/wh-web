<div class="seach-overlay-box">
	<div class="close-icon"><i class="fa fa-times"></i></div><div class="clearfix"></div><br>
	<div class="section">
		<div class="container">
			<div class="row">
				<div class="search-box">
					{{ form('search/index/', 'id': 'searchForm', 'onbeforesubmit': 'return false') }}
							<div class="input-group">
								<input id="mainUrl" name="mainurl" type="hidden" value="<?php echo $baseUrl; ?>search/index">
								<input id="start" name="start" type="hidden" value="0">
								<input id="limit" name="limit" type="hidden" value="12">
								{{ searchform.render('search', ['class': 'form-control', 'id':'searchtextinput', 'placeholder':'Search...']) }}
								<span id="searchformbtn" class="input-group-addon"><i class="fa fa-search"></i></span>
							</div>
					</form>
				</div><div class="clearfix"></div>	
				<div id="searchallfeeds"></div><div class="clearfix"></div>
				<div class="loadmore"></div>
			</div>
		</div>
	</div>
	
		
	</form>
</div>