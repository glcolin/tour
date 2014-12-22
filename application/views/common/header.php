<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=isset($title)?$title:'';?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link href="<?=base_url('asset/css/style.css');?>" rel="stylesheet" type="text/css" />

<?if(isset($style_sheets)):?>
	<?foreach($style_sheets as $style_sheet):?>
		<link href="<?=$style_sheet;?>" rel="stylesheet" type="text/css" />
	<?endforeach;?>
<?endif;?>

<?if(isset($js_scripts)):?>
	<?foreach($js_scripts as $js_script):?>
		<script src="<?=$js_script;?>"></script>
	<?endforeach;?>
<?endif;?>

</head>
<body>

<h1>USA4FUN</h1>

<hr/>