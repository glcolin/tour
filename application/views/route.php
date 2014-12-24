<h3>分类 >> <?=$route->CategoryName;?> >> <?=$route->Title;?></h3>
<hr/>
<div id="content">

	<div>
		<img src="<?=$route->CoverImage;?>" width="200" height="150" style="float:left;margin:30px;"/>
		<div style="float:left;margin:10px;width:600px;">
			<p>
				<h4><?=$route->Title;?></h4>
				编码: <?=$route->Code;?><br/>
				出发城市:<?=$departures;?><br/>
				结束城市:<?=$destinations;?><br/>
				出团时间:
					<?=datetime_print_route_dates($start,$end);?> 
					<?=datetime_print_weekdays($weekdays);?>
				<br/>
				天数: <?=$route->Duration;?><br/>
				原价: <span style="text-decoration:line-through;"><?=$route->OriginPrice;?></span><br/>
				特价: <?=$route->Price;?>
			</p>
			<p>
				行程简介:<br/>
				<?=$route->Content;?>
			</p>
		</div>
	</div>
	<div style="clear:both;"></div>
	<hr/>
	<div style="margin-left:260px;">
		<h1>订团表格在此</h1>
	</div>
</div>