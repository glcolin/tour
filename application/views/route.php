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
        <ul>
        	<li>
            	<label>请选择出发日期：</label> <a class="date-select">选择</a>
            	<input type="text" readonly="readonly" name="departure_date" id="departure_date" />
            </li>
            <li>
            	<label>请选择酒店房间：</label> <a class="room-select">选择</a>
                <div class="rooms-info" style="border:thin; background-color:#9CF; display:none;">
                      <div class="info-header">
                          房间：
                          <select class="room-number" name="product[room_total]">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15">15</option>
                              <option value="16">结伴拼房</option>
                          </select>
                          <span>如果是结伴同游，请您选择结伴拼房，所有结伴者需先完成注册。</span>
                      </div>
                      <div>
                          <span>成人</span>
                          <span>小孩</span>
                      </div>
                      <div class="info-content">
                      </div>
                      <div class="info-footer">
                          <a class="btn ok">确定</a>
                          <a class="btn cancel">取消</a>
                      </div>
                </div>
                <div class="rooms-status">
                	<p class="room-item"></p>
                </div>
            </li>
        </ul>
        <div class="total-price"></div>
        <div class="price-detail">
        	<table>
            	<thead>
                	<tr>
                    	<td width="100px">双人一间</td>
                        <td width="100px">三人一间</td>
                        <td width="100px">四人一间</td>
                        <td width="100px">单人一间</td>
                        <td width="100px">单人配房</td>
                        <td width="100px">小孩</td>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                	<?php  
						foreach($rooms_price as $key=>$value){
							echo '<td>'.$value.'</td>';
						}
					?>
                    </tr>
                </tbody>
            </table>
        </div>
	</div>
</div>

<!--set default js variable-->
<script type="text/javascript">
var total_price = 0;
var date = '';
var rooms = {"number":1,"info":[{"adult":1,"kid":0,"pair":"N"}]};
var rooms_price = <?=json_encode($rooms_price);?>;
</script>

<!--departure date-->
<link rel="stylesheet" href="<?=base_url('asset/datepicker/css/datepicker.css');?>" type="text/css" />
<script type="text/javascript" src="<?=base_url('asset/datepicker/js/datepicker.js');?>"></script>
<script type="text/javascript">
(function($){
	Date.prototype.Format = function (fmt) { //author: meizz 
		var o = {
			"M+": this.getMonth() + 1, //月份 
			"d+": this.getDate(), //日 
			"h+": this.getHours(), //小时 
			"m+": this.getMinutes(), //分 
			"s+": this.getSeconds(), //秒 
			"q+": Math.floor((this.getMonth() + 3) / 3), //季度 
			"S": this.getMilliseconds() //毫秒 
		};
		if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
		for (var k in o)
		if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
		return fmt;
	}
	
	var appointed_days = <?=json_encode($departure_date)?>;
	var departure_date = $('#departure_date').val();
	departure_date = departure_date?departure_date:false;
	$('.date-select').DatePicker({
			date: departure_date,
			current: '',
			format: 'Y-m-d',
			calendars: 1,
			onRender: function(date) {				
				var fdate = new Date(date.valueOf()).Format('yyyyMMdd');
				return { 
					disabled: ($.inArray(fdate,appointed_days)==-1),
				}
			},
			onChange: function(formated, dates){
				$('#departure_date').val(formated);
				getTotalPrice();
			},
			starts: 0
		});
	
})(jQuery)	
</script>
<!--departure date end-->

<!--select room-->
<style type="text/css">
.room-item {
    border: 1px solid #d5d5d5;
    line-height: 20px;
    margin: 4px 0;
    min-height: 20px;
    padding: 0 3px;
}
</style>
<script type="text/javascript">
(function($){
	$(".room-select").click(function(e){
		e.preventDefault();
		init_rooms_info();
		$(".rooms-info").show();
	});
	
	$(".rooms-info .cancel").click(function(e){
		e.preventDefault();
		$(".rooms-info").hide();
	});
	
	$(".rooms-info .ok").click(function(e){
		e.preventDefault();
		rooms.number = $('select[name="product[room_total]"]').val();
		rooms.info = [];
		$('.info-content .room-item').each(function(key,val){
			var adult_val = parseInt($(this).find(".adult select").val()),
				kid_val = parseInt($(this).find(".kid select").val()),
				pair_val = $(this).find(".pair input").attr('checked')==true?'Y':'N';
			
			adult_val = adult_val?adult_val:0;
			kid_val = kid_val?kid_val:0;
			
			var obj = {"adult":adult_val,"kid":kid_val,"pair":pair_val};
			rooms.info[key] = obj;
		})
		
		getTotalPrice();
		$(".rooms-info").hide();
	});
	
	$('.rooms-info').delegate('.room-item .adult select','change',function(){
		var element = $(this);
		var pelement = element.parent().parent();
		var kid_val = parseInt(pelement.find(".kid select").val());	
		var val = parseInt(element.val());
		var total_val = kid_val+val;
		if(total_val==1){
			pelement.find(".pair").show();
		}
		else{
			pelement.find(".kid select").val(0);
			pelement.find(".pair").hide();
		}
	})
	
	$('.rooms-info').delegate('.room-item .kid select','change',function(){
		var element = $(this);
		var pelement = element.parent().parent();
		var val = parseInt(element.val());
		var adult_val = parseInt(pelement.find(".adult select").val());	
		var total_val = adult_val+val;
		if(total_val==1){
			pelement.find(".pair").show();
		}
		else{
			pelement.find(".pair").hide();
		}
	})
	
	$('select[name="product[room_total]"]').change(function(){
		var room_number = $(this).val();
		var html = '';
		for(var i=1;i<=room_number;i++){
			var key = i-1;
			html += '<p class="room-item"><span class="room-number">房间 '+i+'</span><span class="adult"><select name="product[room_item]['+key+'][adult]"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></span><span class="kid"><select name="product[room_item]['+key+'][child]"><option selected="selected" value="0">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></span><span class="pair"><label style="cursor:pointer;"><input type="checkbox" name="product[room_item]['+key+'][pair]" value="Y">接受单人配房</label></span></p>';
		}
		$(".info-content").html(html);
	});
	
	window.getTotalPrice =function (){
		total_price = 0;
		$.each(rooms.info,function(key,val){
			var total_number = val.adult+val.kid,
				room_price = rooms_price[total_number],
				room_total_price = 0;
			
			if(val.kid){
				room_total_price = (total_number-val.kid)*room_price + val.kid*rooms_price[6];
			}
			else{
				if(val.pair=='Y' && total_number==1){
					room_total_price = total_number*rooms_price[5];
				}
				else{
					room_total_price = total_number*room_price;
				}
			}
				
			total_price += room_total_price;	
		})	
		$(".total-price").text('$'+total_price);
	}
	
	function init_rooms_info(){
		$('select[name="product[room_total]"]').val(rooms.number);
		var html = '';
		$.each(rooms.info,function(key,val){
			var room_number = key+1;
			var adult_html = kid_html = '';
			for(var i=1;i<=4;i++){
				adult_html += '<option value="'+i+'"'+(i==val.adult?' selected="selected"':'')+'>'+i+'</option>'; 
			}
			
			for(var i=0;i<=3;i++){
				kid_html += '<option value="'+i+'"'+(i==val.kid?' selected="selected"':'')+'>'+i+'</option>'; 
			}
			
			html += '<p class="room-item"><span class="room-number">房间 '+room_number+'</span><span class="adult"><select name="product[room_item]['+key+'][adult]">'+adult_html+'</select></span><span class="kid"><select name="product[room_item]['+key+'][child]">'+kid_html+'</select></span><span class="pair"><label style="cursor:pointer;"><input type="checkbox" '+(val.pair=="Y"?'checked="checked"':'')+' name="product[room_item]['+key+'][pair]" value="Y">接受单人配房</label></span></p>';
		});
		$(".info-content").html(html);
	}
})(jQuery)	
</script>
<!--select room end-->