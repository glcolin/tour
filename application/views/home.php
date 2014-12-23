<h3>首页</h3>
<hr/>
<div id="content">
	<?if($categories):?>
	<ul>
		<?foreach($categories as $category):?>
			<li><a href="<?=base_url('category/'.$category->CategoryId);?>"><?=$category->CategoryName;?></a></li>
		<?endforeach;?>
	</ul>
	<?endif;?>
</div>