<input type="button" value="คำนวนราคางวด" id="btn-calngod"> 
<input type="button" value="สรุปห้อง" id="btn-addroom">
<input type="button" value="เปรียบเทียบราคา" id="btn-compare">
<input type="button" value="Back Office" id="btn-backoffice" class="btn_hide">
<input type="button" value="IoT" id="btn-iot" class="btn_hide">
<span style="float:right;"><?php echo $total_result_t;?></span>

<div style="display:none;" id="">---------------------</div>

<div style="display:none;" id="cduprice"><?php echo $cdu_cost*1.1;?></div>
<div style="display:none;" id="coolerprice"><?php echo $cooler_cost*1.1;?></div>
<div style="display:none;" id="install_price"><?php echo $install_price;?></div>
<div style="display:none;" id="controlprice"><?php echo $controlprice;?></div> 
<div style="display:none;" id="shipcost"><?php echo $shipcost;?></div>

<div style="display:none;" id="">---------------------</div>


<div style="display:none;" id="foams_type"><?php echo $foams;?></div>
<div style="display:none;" id="foaminch"><?php echo $foaminch;?></div>
<div style="display:none;" id="costfoam"><?php echo $wall_price;?></div>

<div style="display:none;" id="sqmwall"><?php echo $sqmwall;?></div>
<div style="display:none;" id="sqmpedan"><?php echo $sqmpedan;?></div>
<div style="display:none;" id="sqmfloor"><?php echo $sqmfloor;?></div>
<div style="display:none;" id="sqm-isowall-sum"><?php echo number_format($sqmsum, 2, '.', ',');?></div> 
<div style="display:none;" id="foam_sum_price"><?php echo number_format($foam_sum_price, 2, '.', ',');?></div>

<div style="display:none;" id="wall_and_door"><?php echo number_format($wall_and_door, 2, '.', ',');?></div> 
<div style="display:none;" id="kumrai"><?php echo number_format($kumrai, 2, '.', ',');?></div>
<div style="display:none;" id="vats"><?php echo number_format($vats, 2, '.', ',');?></div>
<div style="display:none;" id="kaivat"><?php echo number_format($kaivat, 2, '.', ',');?></div>