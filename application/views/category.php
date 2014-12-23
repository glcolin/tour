<h3>分类 >> <?=$categoryName;?></h3>
<hr/>
<div id="content">
	<?if($routes):?>
		<?foreach($routes as $route):?>
			<div>
				<img src="<?=$route->CoverImage;?>" width="200" height="150" style="float:left;margin:30px;"/>
				<div style="float:left;margin:10px;width:600px;">
					<p>
						<h4><a href="<?=base_url('route/'.$route->RouteId);?>"><?=$route->Title;?></a></h4>
						编码: <?=$route->Code;?><br/>
						出发城市: <?=$route->Departures;?><br/>
						结束城市: <?=$route->Destinations;?><br/>
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
		<?endforeach;?>
	<?else:?>
		<p>数据库没有任何路线</p>
	<?endif;?>
</div>