<?php
	function lastday($month = '', $year = '') {
	   if (empty($month)) {
		  $month = date('m');
	   }
	   if (empty($year)) {
		  $year = date('Y');
	   }
	   $result = strtotime("{$year}-{$month}-01");
	   $result = strtotime('-1 second', strtotime('+1 month', $result));
	   return date('Y-m-d', $result);
	}

	function firstDay($month = '', $year = '')
	{
		if (empty($month)) {
		  $month = date('m');
	   }
	   if (empty($year)) {
		  $year = date('Y');
	   }
	   $result = strtotime("{$year}-{$month}-01");
	   return date('Y-m-d', $result);
	}


	function new_curr_invoice($curr)
	{
		if($curr == 1) { $curr = 'USD';}
		elseif($curr == 2) { $curr = 'IDR';}
		elseif($curr == 3) { $curr = 'IDR';}

		return $curr;
	}

	function job_kasbonG1($kasbon)
	{
		if(strlen($kasbon) == 1) { $kasbon = '0000'.$kasbon;}
		elseif(strlen($kasbon) == 2) { $kasbon = '000'.$kasbon;}
		elseif(strlen($kasbon) == 3) { $kasbon = '00'.$kasbon;}
		elseif(strlen($kasbon) == 4) { $kasbon = '0'.$kasbon;}
		elseif(strlen($kasbon) == 5) { $kasbon = $kasbon;}

		return $kasbon;
	}

	function job_number($job_id)
	{
		$r = mysql_fetch_array(mysql_query('SELECT * FROM master_job WHERE job_id = '.$job_id.' AND job_is_active = 1 '));
		$job_group = $r['job_group'];
		$job_count_allgroup = $r['job_count_allgroup'];
		$job_count_group = $r['job_count_group'];
		$job_name = $r['job_name'];
		$job_month_create = $r['job_month_create'];
		$job_year_create = $r['job_year_create'];
		$job_date = $r['job_date'];

		if(strlen($job_count_group) == 1){$combine_number_job = '0000'.$job_count_group;}
		elseif(strlen($job_count_group) == 2){$combine_number_job = '000'.$job_count_group;}
		elseif(strlen($job_count_group) == 3){$combine_number_job = '00'.$job_count_group;}
		elseif(strlen($job_count_group) == 4){$combine_number_job = '0'.$job_count_group;}
		elseif(strlen($job_count_group) == 5){$combine_number_job = $job_count_group;}

		if(strlen($job_month_create) == 1)
		{
			$job_month_create = '0'.$job_month_create;
		}

		$job_number = substr($job_year_create,-2).''.$job_month_create.''.$job_name.''.$combine_number_job;

		return $job_number;
	}

	function job_numberG1($job_id)
	{
		$r = mysql_fetch_array(mysql_query('SELECT * FROM master_job WHERE job_id = '.$job_id.' AND job_is_active = 1 '));
		$job_group = $r['job_group'];
		$job_count_allgroup = $r['job_count_allgroup'];
		$job_count_group = $r['job_count_group'];
		$job_name = $r['job_name'];
		$job_month_create = $r['job_month_create'];
		$job_year_create = $r['job_year_create'];
		$job_date = $r['job_date'];

		if(strlen($job_count_group) == 1){$combine_number_job = '0000'.$job_count_group;}
		elseif(strlen($job_count_group) == 2){$combine_number_job = '000'.$job_count_group;}
		elseif(strlen($job_count_group) == 3){$combine_number_job = '00'.$job_count_group;}
		elseif(strlen($job_count_group) == 4){$combine_number_job = '0'.$job_count_group;}
		elseif(strlen($job_count_group) == 5){$combine_number_job = $job_count_group;}

		if(strlen($job_month_create) == 1)
		{
			$job_month_create = '0'.$job_month_create;
		}

		$job_number = $combine_number_job.' '.$job_name;

		return $job_number;
	}

	function hbl_number($hbl_number, $job_id)
	{
		$r = mysql_fetch_array(mysql_query('SELECT * FROM master_job WHERE job_id = '.$job_id.' AND job_is_active = 1 '));
		$job_name = $r['job_name'];

		if(strlen($hbl_number) == 1){$hbl_number = '0000'.$hbl_number;}
		elseif(strlen($hbl_number) == 2){$hbl_number = '000'.$hbl_number;}
		elseif(strlen($hbl_number) == 3){$hbl_number = '00'.$hbl_number;}
		elseif(strlen($hbl_number) == 4){$hbl_number = '0'.$hbl_number;}
		elseif(strlen($hbl_number) == 5){$hbl_number = $hbl_number;}

		$hbl_number = $job_name.''.$hbl_number;

		return $hbl_number;
	}

	function invoice_number($inv_id)
	{
		$r = mysql_fetch_array(mysql_query('SELECT * FROM master_invoice WHERE inv_id = '.$inv_id.' AND inv_is_active = 1 '));
		$inv_count = $r['inv_count'];
		$inv_code = $r['inv_code'];

		$count = count($inv_count);
		if($count == 1) { $inv_count = '00000'.$inv_count; }
		elseif($count == 2) { $inv_count = '0000'.$inv_count; }
		elseif($count == 3) { $inv_count = '000'.$inv_count; }
		elseif($count == 4) { $inv_count = '00'.$inv_count; }
		elseif($count == 5) { $inv_count = '0'.$inv_count; }

		$invoice_number = $inv_code.''.$inv_count;

		return $invoice_number;
	}

	function voucher_number($vch_id)
	{
		$r = mysql_fetch_array(mysql_query('SELECT * FROM master_voucher WHERE vch_id = '.$vch_id.''));
		$vch_count = $r['vch_count'];
		$vch_code = $r['vch_code'];

		if(strlen($vch_count) == 1){$vch_count = '00000'.$vch_count;}
		elseif(strlen($vch_count) == 2){$vch_count = '0000'.$vch_count;}
		elseif(strlen($vch_count) == 3){$vch_count = '000'.$vch_count;}
		elseif(strlen($vch_count) == 4){$vch_count = '00'.$vch_count;}
		elseif(strlen($vch_count) == 5){$vch_count = '0'.$vch_count;}

		$voucher_number = $vch_code.''.$vch_count;

		return $voucher_number;
	}

	function numberToCurrencyx($num, $country='id')
	{
		$num = number_format($num, 0, '',',');
		return($num);
	}

	function numberToCurrency($num, $country='id')
	{
		if($country=='id')
		{
			$num = number_format($num, 0, '','.');
			$num = $num.',-';
		}
		else
		{
			$num = number_format($number, 2, '.', '');
			$num = $num.',-';
		}
		return($num);
	}

	function numberToCurrency2($num, $country='id')
	{
		if($country=='id')
		{
			$num = number_format($num, 0, '','.');
		}
		else
		{
			$num = number_format($number, 2, '.', '');
		}
		return($num);
	}

	function numberToCurrency3($num, $country='id')
	{
		if($country=='id')
		{
			$num = number_format($num, 0, '',',');
		}
		else
		{
			$num = number_format($number, 2, ',', '');
		}
		return($num);
	}

	function Currency_Invoice($num)
	{
		$num = number_format($num, 0, '',',');
		$num = $num.'.00';
		return($num);
	}

	function Currency_Voucher($num)
	{
		$num = number_format($num, 0, '',',');
		$num = $num.'.00';
		return($num);
	}

	function currency_kasbon($num)
	{
		$num = number_format($num, 0, '',',');
		$num = $num.'.00';
		return($num);
	}
	function currency_kasbon_decimal($num)
	{
		$num = number_format($num, 0, '',',');
		return($num);
	}

	function menu_header()
	{
		?>
		<div style="height:51px;background-color:#e9e9e9;position:absolute;top:0px;left:0px;padding:0px;width:100%;">
		<div style="float:left"><img src="images/general_logo.jpg" style="position:relative;top:-1px;"></div>
		<div style="float:right;"><a href="logout.php" onclick="return confirm('Are You Sure Want To Log Out?')"><img src="images/general_buttonlogout.jpg"></a></div>
		<div style="float:right;margin-left:10px;margin-right:10px;position:relative;top:15px;font-size:20px;">
		<?php
		echo $_SESSION['u_name'];
		?>
		</div>
		<div style="float:right;position:relative;top:15px;"><img src="images/general_usericon.jpg"></div>
		</div>
	<?php
	}

	function dataheader($title,$width,$uselink,$link="")
	{
		$width1 = $width -30;
		if($uselink == 1) $display = 'inline'; else $display = 'none';
		?>
		<div style="width:<?php echo $width;?>px;position:relative;top:60px;margin:auto;background-color:#e9e9e9;">
			<div style="position:relative;height:50px;width:100%">
				<div class="text_header" style="position:relative;top:17px;left:25px;float:left"><?php echo $title;?></div>
				<div style="position:relative;float:right;top:10px;right:15px;display:<?php echo $display;?>">
					<a href="<?php echo $link;?>" alt="back" title="back"><img src="images/button_back.png" width="40"></a>
				</div>
			</div>
			<div><hr noshade></div>
			<div style="width:<?php echo $width1;?>px;margin:auto;">
		<?php
	}

	function datafooter()
	{
		echo '</div></div>';
	}

	function cost_voucher_code($type,$num)
	{
		if($type == 1)
		{
			$costvc = 'VOP '.str_pad($num,5,"0",STR_PAD_LEFT);
		}elseif($type == 2)
		{
			$costvc = 'VOR '.str_pad($num,5,"0",STR_PAD_LEFT);
		}
		return $costvc;
	}

	function kasbon_code($type,$num)
	{
		if($type == 1)
		{
			$kasbon = 'VKBO '.str_pad($num,5,"0",STR_PAD_LEFT);
		}elseif($type == 2)
		{
			$kasbon = 'VKRO '.str_pad($num,5,"0",STR_PAD_LEFT);
		}
		return $kasbon;
	}

	function datedfy($date)
	{
		$newdate = strtoupper(date('d F Y',mktime(0,0,0,substr($date,5,2),substr($date,8,2),substr($date,0,4))));
		return $newdate;
	}

	function month_name_full($month)
	{
		if($month == 1) {$month_name = 'JANUARY';}
		if($month == 2) {$month_name = 'FEBRUARY';}
		if($month == 3) {$month_name = 'MARCH';}
		if($month == 4) {$month_name = 'APRIL';}
		if($month == 5) {$month_name = 'MAY';}
		if($month == 6) {$month_name = 'JUNE';}
		if($month == 7) {$month_name = 'JULY';}
		if($month == 8) {$month_name = 'AUGUST';}
		if($month == 9) {$month_name = 'SEPTEMBER';}
		if($month == 10) {$month_name = 'OCTOBER';}
		if($month == 11) {$month_name = 'NOVEMBER';}
		if($month == 12) {$month_name = 'DECEMBER';}
		return $month_name;
	}

	function month_name_less($month)
	{
		if($month == 1) {$month_name = 'JAN';}
		if($month == 2) {$month_name = 'FEB';}
		if($month == 3) {$month_name = 'MAR';}
		if($month == 4) {$month_name = 'APR';}
		if($month == 5) {$month_name = 'MAY';}
		if($month == 6) {$month_name = 'JUN';}
		if($month == 7) {$month_name = 'JUL';}
		if($month == 8) {$month_name = 'AGS';}
		if($month == 9) {$month_name = 'SEP';}
		if($month == 10) {$month_name = 'OCT';}
		if($month == 11) {$month_name = 'NOV';}
		if($month == 12) {$month_name = 'DEC';}
		return $month_name;
	}

	function office_name($office)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM office WHERE office_code = '".$office."'"));
		return $r['office_name'];
	}


	function country_name($country)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM country WHERE id = '".$country."'"));
		return $r['name'];
	}

	function movement_name($movement)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM movement WHERE movement_id = '".$movement."'"));
		return $r['movement_name'];
	}

	function freight_name($freight)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM freight WHERE freight_id = '".$freight."'"));
		return $r['freight_name'];
	}

	function agent_name($agent)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM agent WHERE agent_id = '".$agent."'"));
		return $r['agent_name'];
	}

	function agent_city($agent)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM agent_city WHERE agent_city_id = '".$agent."'"));
		return $r['agent_contact_person'];
	}

	function agent_loc($agent)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM agent_city WHERE agent_city_id = '".$agent."'"));
		return $r['agent_address'];
	}

	function carrier_code($carrier)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM carrier WHERE carrier_id = '".$carrier."'"));
		return $r['carrier_code'];
	}

	function carrier_name($carrier)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM carrier WHERE carrier_id = '".$carrier."'"));
		return $r['name1'];
	}

	function point_name($point)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM point WHERE point_code = '".$point."'"));
		return $r['point_name'];
	}

	function vessel_name($vessel)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM vessel WHERE vessel_code = '".$vessel."'"));
		return $r['vessel_name'];
	}

	function customer_nickname($cus)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM customer WHERE customer_id = '".$cus."'"));
		return $r['customer_nickname'];
	}

	function customer_name($cus)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM customer WHERE customer_id = '".$cus."'"));
		return $r['customer_companyname'];
	}

	function customer_location($cus)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM customer WHERE customer_id = '".$cus."'"));
		return $r['customer_address'];
	}

	function location_name($loc_id)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM location WHERE location_id = '".$loc_id."'"));
		return $r['location_name'];
	}

	function pos_name($pos_id)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM pos WHERE pos_id = '".$pos_id."'"));
		return $r['pos_name'];
	}

	function source_name($source_id)
	{
		$r = mysql_fetch_array(mysql_query("SELECT * FROM source WHERE source_id = '".$source_id."'"));
		return $r['source_code'];
	}

	function loadComboBoxBulan($name='bulan',$month)
	{
	?>
		<select name='<?php echo $name;?>' id='<?php echo $name; ?>' class="form-control">
			<option value='01' <?php if($month==1)echo'selected="selected"';?>>JAN</option>
			<option value='02' <?php if($month==2)echo'selected="selected"';?>>FEB</option>
			<option value='03' <?php if($month==3)echo'selected="selected"';?>>MAR</option>
			<option value='04' <?php if($month==4)echo'selected="selected"';?>>APR</option>
			<option value='05' <?php if($month==5)echo'selected="selected"';?>>MEI</option>
			<option value='06' <?php if($month==6)echo'selected="selected"';?>>JUN</option>
			<option value='07' <?php if($month==7)echo'selected="selected"';?>>JUL</option>
			<option value='08' <?php if($month==8)echo'selected="selected"';?>>AGS</option>
			<option value='09' <?php if($month==9)echo'selected="selected"';?>>SEP</option>
			<option value='10' <?php if($month==10)echo'selected="selected"';?>>OCT</option>
			<option value='11' <?php if($month==11)echo'selected="selected"';?>>NOV</option>
			<option value='12' <?php if($month==12)echo'selected="selected"';?>>DEC</option>
		</select>
	<?
	}

	function loadComboBoxBulan_full($name='bulan',$month)
	{
	?>
		<select name='<?php echo $name;?>' id='<?php echo $name; ?>' class="form-control">
			<option value='01' <?php if($month==1)echo'selected="selected"';?>>JANUARY</option>
			<option value='02' <?php if($month==2)echo'selected="selected"';?>>FEBRUARY</option>
			<option value='03' <?php if($month==3)echo'selected="selected"';?>>MARCH</option>
			<option value='04' <?php if($month==4)echo'selected="selected"';?>>APRIL</option>
			<option value='05' <?php if($month==5)echo'selected="selected"';?>>MAY</option>
			<option value='06' <?php if($month==6)echo'selected="selected"';?>>JUNE</option>
			<option value='07' <?php if($month==7)echo'selected="selected"';?>>JULY</option>
			<option value='08' <?php if($month==8)echo'selected="selected"';?>>AUGUST</option>
			<option value='09' <?php if($month==9)echo'selected="selected"';?>>SEPTEMBER</option>
			<option value='10' <?php if($month==10)echo'selected="selected"';?>>OCTOBER</option>
			<option value='11' <?php if($month==11)echo'selected="selected"';?>>NOVEMBER</option>
			<option value='12' <?php if($month==12)echo'selected="selected"';?>>DECEMBER</option>
		</select>
	<?
	}

	function loadComboBoxTanggal($name='tanggal',$date)
	{
	?>
		<select name='<?php echo $name;?>' id='<?php echo $name; ?>' class="form-control">
		<?php
		for($i=1;$i<=31;$i++)
		{
		?>
			<option value='<?=$i?>' <?php if($date==$i) echo'selected="selected"';?> >
				<?=$i?>
			</option>
		<?
		}
		?>
		</select>
	<?
	}

	function loadComboBoxTanggal_invoice($name='tanggal',$date)
	{
	?>
		<select name='<?php echo $name;?>' id='<?php echo $name; ?>' class="form-control">
		<?php
		for($i=1;$i<=$date;$i++)
		{
		?>
			<option value='<?=$i?>' <?php if($date==$i) echo'selected="selected"';?> >
				<?=$i?>
			</option>
		<?
		}
		?>
		</select>
	<?
	}

	function loadComboBoxTahun($name='tahun',$year,$min = 5,$max = 5)
	{
	?>
        <select name='<?php echo $name;?>' id='<?php echo $name; ?>' class="form-control">
        <?
        $tahun = date("Y");
        $max = $tahun+$max;
        $min = $tahun-$min;
        for($i=$min;$i<=$max;$i++)
        {
        ?>
            <option value='<?=$i?>' <?php if($year==$i) echo'selected="selected"';?> >
            	<?=$i?>
            </option>
        <?
        }
        ?>
        </select>
	<?
	}

	function loadComboBoxTahun_invoice($name='tahun',$year,$min = 3,$max = 0)
	{
	?>
        <select name='<?php echo $name;?>' id='<?php echo $name; ?>' style="height:35px">
        <?
        $tahun = date("Y");
        $max = $tahun+$max;
        $min = $tahun-$min;
        for($i=$min;$i<=$max;$i++)
        {
        ?>
            <option value='<?=$i?>' <?php if($year==$i) echo'selected="selected"';?> >
            	<?=$i?>
            </option>
        <?
        }
        ?>
        </select>
	<?
	}

	function viewTanggalTime($tanggal)
	{
		$h = explode(' ', $tanggal);

		if (($h[0]=='0000-00-00') || ($h[0]==NULL) || ($h[0]==""))
		{
			$tanggal2 = "-";
		}
		else
		{
			$tahun = substr($h[0], 0, 4);
			$bulan = substr($h[0], 5, 2);
			$tgl = substr($h[0], 8, 2);

			switch($bulan)
			{
				case '01':
				{
					$bulan='JANUARY';
					break;
				}
				case '02':
				{
					$bulan='FEBRUARY';
					break;
				}
				case '03':
				{
					$bulan='MARCH';
					break;
				}
				case '04':
				{
					$bulan='APRIL';
					break;
				}
				case '05':
				{
					$bulan='MEI';
					break;
				}
				case '06':
				{
					$bulan='JUNE';
					break;
				}
				case '07':
				{
					$bulan='JULY';
					break;
				}
				case '08':
				{
					$bulan='AUGUST';
					break;
				}
				case '09':
				{
					$bulan='SEPTEMBER';
					break;
				}
				case '10':
				{
					$bulan='OCTOBER';
					break;
				}
				case '11':
				{
					$bulan='NOVEMBER';
					break;
				}
				case '12':
				{
					$bulan='DECEMBER';
					break;
				}
			}
			$tanggal1 = $tgl." ".$bulan." ".$tahun;
		}

		$tanggal2 = $tanggal1.' '.$h[1];

		return($tanggal2);
	}

	function viewTanggal($tanggal)
	{
		if (($tanggal=='0000-00-00') || ($tanggal==NULL) || ($tanggal==""))
		{
			$tanggal = "-";
		}

		else
		{
			$tahun = substr($tanggal, 0, 4);
			$bulan = substr($tanggal, 5, 2);
			$tgl = substr($tanggal, 8, 2);

			switch($bulan)
			{
				case '01':
				{
					$bulan='JANUARY';
					break;
				}
				case '02':
				{
					$bulan='FEBRUARY';
					break;
				}
				case '03':
				{
					$bulan='MARCH';
					break;
				}
				case '04':
				{
					$bulan='APRIL';
					break;
				}
				case '05':
				{
					$bulan='MEI';
					break;
				}
				case '06':
				{
					$bulan='JUNE';
					break;
				}
				case '07':
				{
					$bulan='JULY';
					break;
				}
				case '08':
				{
					$bulan='AUGUST';
					break;
				}
				case '09':
				{
					$bulan='SEPTEMBER';
					break;
				}
				case '10':
				{
					$bulan='OCTOBER';
					break;
				}
				case '11':
				{
					$bulan='NOVEMBER';
					break;
				}
				case '12':
				{
					$bulan='DECEMBER';
					break;
				}
			}
			$tanggal = $tgl." ".$bulan." ".$tahun;
		}

		return($tanggal);
	}

	function viewTanggal_nonyear($tanggal)
	{
		if (($tanggal=='0000-00-00') || ($tanggal==NULL) || ($tanggal==""))
		{
			$tanggal = "-";
		}

		else
		{
			$tahun = substr($tanggal, 0, 4);
			$bulan = substr($tanggal, 5, 2);
			$tgl = substr($tanggal, 8, 2);

			switch($bulan)
			{
				case '01':
				{
					$bulan='JANUARY';
					break;
				}
				case '02':
				{
					$bulan='FEBRUARY';
					break;
				}
				case '03':
				{
					$bulan='MARCH';
					break;
				}
				case '04':
				{
					$bulan='APRIL';
					break;
				}
				case '05':
				{
					$bulan='MEI';
					break;
				}
				case '06':
				{
					$bulan='JUNE';
					break;
				}
				case '07':
				{
					$bulan='JULY';
					break;
				}
				case '08':
				{
					$bulan='AUGUST';
					break;
				}
				case '09':
				{
					$bulan='SEPTEMBER';
					break;
				}
				case '10':
				{
					$bulan='OCTOBER';
					break;
				}
				case '11':
				{
					$bulan='NOVEMBER';
					break;
				}
				case '12':
				{
					$bulan='DECEMBER';
					break;
				}
			}
			$tanggal = $tgl." ".$bulan;
		}

		return($tanggal);
	}

	function viewTanggal_simple($tanggal)
	{
		if (($tanggal=='0000-00-00') || ($tanggal==NULL) || ($tanggal==""))
		{
			$tanggal = "-";
		}

		else
		{
			$tahun = substr($tanggal, 0, 4);
			$bulan = substr($tanggal, 5, 2);
			$tgl = substr($tanggal, 8, 2);

			$jumlah = strlen($tgl);
			if($jumlah == 1)
			{
				$tgl = '0'.$tgl;
			}

			switch($bulan)
			{
				case '01':
				{
					$bulan='JAN';
					break;
				}
				case '02':
				{
					$bulan='FEB';
					break;
				}
				case '03':
				{
					$bulan='MAR';
					break;
				}
				case '04':
				{
					$bulan='APR';
					break;
				}
				case '05':
				{
					$bulan='MEI';
					break;
				}
				case '06':
				{
					$bulan='JUN';
					break;
				}
				case '07':
				{
					$bulan='JUL';
					break;
				}
				case '08':
				{
					$bulan='AGS';
					break;
				}
				case '09':
				{
					$bulan='SEP';
					break;
				}
				case '10':
				{
					$bulan='OCT';
					break;
				}
				case '11':
				{
					$bulan='NOV';
					break;
				}
				case '12':
				{
					$bulan='DEC';
					break;
				}
			}
			$tanggal = $tgl." ".$bulan." ".$tahun;
		}

		return($tanggal);
	}

	function convert_number_to_words($number)
	{
		$hyphen      = '-';
		$conjunction = ' and ';
		$separator   = ', ';
		$negative    = ' ';
		$decimal     = ' point ';
		$dictionary  = array(
			0                   => 'zero',
			1                   => 'one',
			2                   => 'two',
			3                   => 'three',
			4                   => 'four',
			5                   => 'five',
			6                   => 'six',
			7                   => 'seven',
			8                   => 'eight',
			9                   => 'nine',
			10                  => 'ten',
			11                  => 'eleven',
			12                  => 'twelve',
			13                  => 'thirteen',
			14                  => 'fourteen',
			15                  => 'fifteen',
			16                  => 'sixteen',
			17                  => 'seventeen',
			18                  => 'eighteen',
			19                  => 'nineteen',
			20                  => 'twenty',
			30                  => 'thirty',
			40                  => 'fourty',
			50                  => 'fifty',
			60                  => 'sixty',
			70                  => 'seventy',
			80                  => 'eighty',
			90                  => 'ninety',
			100                 => 'hundred',
			1000                => 'thousand',
			1000000             => 'million',
			1000000000          => 'billion',
			1000000000000       => 'trillion',
			1000000000000000    => 'quadrillion',
			1000000000000000000 => 'quintillion'
		);

		if (!is_numeric($number)) {
			return false;
		}

		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}

		if ($number < 0) {
			return $negative . convert_number_to_words(abs($number));
		}

		$string = $fraction = null;

		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}

		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . convert_number_to_words($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= convert_number_to_words($remainder);
				}
				break;
		}

		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}

		return $string;
	}

	function convertNumber($number)
	{
		list($integer, $fraction) = explode(".", (string) $number);

		$output = "";

		if ($integer{0} == "-")
		{
			$output = "negative ";
			$integer    = ltrim($integer, "-");
		}
		else if ($integer{0} == "+")
		{
			$output = "positive ";
			$integer    = ltrim($integer, "+");
		}

		if ($integer{0} == "0")
		{
			$output .= "zero";
		}
		else
		{
			$integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
			$group   = rtrim(chunk_split($integer, 3, " "), " ");
			$groups  = explode(" ", $group);

			$groups2 = array();
			foreach ($groups as $g)
			{
				$groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});
			}

			for ($z = 0; $z < count($groups2); $z++)
			{
				if ($groups2[$z] != "")
				{
					$output .= $groups2[$z] . convertGroup(11 - $z) . (
							$z < 11
							&& !array_search('', array_slice($groups2, $z + 1, -1))
							&& $groups2[11] != ''
							&& $groups[11]{0} == '0'
								? " and "
								: ", "
						);
				}
			}

			$output = rtrim($output, ", ");
		}

		if ($fraction > 0)
		{
			$output .= " point";
			for ($i = 0; $i < strlen($fraction); $i++)
			{
				$output .= " " . convertDigit($fraction{$i});
			}
		}

		return $output;
	}

	function convertGroup($index)
	{
		switch ($index)
		{
			case 11:
				return " decillion";
			case 10:
				return " nonillion";
			case 9:
				return " octillion";
			case 8:
				return " septillion";
			case 7:
				return " sextillion";
			case 6:
				return " quintrillion";
			case 5:
				return " quadrillion";
			case 4:
				return " trillion";
			case 3:
				return " billion";
			case 2:
				return " million";
			case 1:
				return " thousand";
			case 0:
				return "";
		}
	}

	function convertThreeDigit($digit1, $digit2, $digit3)
	{
		$buffer = "";

		if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
		{
			return "";
		}

		if ($digit1 != "0")
		{
			$buffer .= convertDigit($digit1) . " hundred";
			if ($digit2 != "0" || $digit3 != "0")
			{
				$buffer .= " and ";
			}
		}

		if ($digit2 != "0")
		{
			$buffer .= convertTwoDigit($digit2, $digit3);
		}
		else if ($digit3 != "0")
		{
			$buffer .= convertDigit($digit3);
		}

		return $buffer;
	}

	function convertTwoDigit($digit1, $digit2)
	{
		if ($digit2 == "0")
		{
			switch ($digit1)
			{
				case "1":
					return "ten";
				case "2":
					return "twenty";
				case "3":
					return "thirty";
				case "4":
					return "forty";
				case "5":
					return "fifty";
				case "6":
					return "sixty";
				case "7":
					return "seventy";
				case "8":
					return "eighty";
				case "9":
					return "ninety";
			}
		} else if ($digit1 == "1")
		{
			switch ($digit2)
			{
				case "1":
					return "eleven";
				case "2":
					return "twelve";
				case "3":
					return "thirteen";
				case "4":
					return "fourteen";
				case "5":
					return "fifteen";
				case "6":
					return "sixteen";
				case "7":
					return "seventeen";
				case "8":
					return "eighteen";
				case "9":
					return "nineteen";
			}
		} else
		{
			$temp = convertDigit($digit2);
			switch ($digit1)
			{
				case "2":
					return "twenty-$temp";
				case "3":
					return "thirty-$temp";
				case "4":
					return "forty-$temp";
				case "5":
					return "fifty-$temp";
				case "6":
					return "sixty-$temp";
				case "7":
					return "seventy-$temp";
				case "8":
					return "eighty-$temp";
				case "9":
					return "ninety-$temp";
			}
		}
	}

	function convertDigit($digit)
	{
		switch ($digit)
		{
			case "0":
				return "zero";
			case "1":
				return "one";
			case "2":
				return "two";
			case "3":
				return "three";
			case "4":
				return "four";
			case "5":
				return "five";
			case "6":
				return "six";
			case "7":
				return "seven";
			case "8":
				return "eight";
			case "9":
				return "nine";
		}
	}

	function konversi($x){

  $x = abs($x);
  $angka = array ("","satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";

  if($x < 12){
   $temp = " ".$angka[$x];
  }else if($x<20){
   $temp = konversi($x - 10)." belas";
  }else if ($x<100){
   $temp = konversi($x/10)." puluh". konversi($x%10);
  }else if($x<200){
   $temp = " seratus".konversi($x-100);
  }else if($x<1000){
   $temp = konversi($x/100)." ratus".konversi($x%100);
  }else if($x<2000){
   $temp = " seribu".konversi($x-1000);
  }else if($x<1000000){
   $temp = konversi($x/1000)." ribu".konversi($x%1000);
  }else if($x<1000000000){
   $temp = konversi($x/1000000)." juta".konversi($x%1000000);
  }else if($x<1000000000000){
   $temp = konversi($x/1000000000)." milyar".konversi($x%1000000000);
  }

  return $temp;
 }

 function tkoma($x){
  $str = stristr($x,",");
  $ex = explode(',',$x);

  if(($ex[1]/10) >= 1){
   $a = abs($ex[1]);
  }
  $string = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan",   "sembilan","sepuluh", "sebelas");
  $temp = "";

  $a2 = $ex[1]/10;
  $pjg = strlen($str);
  $i =1;


  if($a>=1 && $a< 12){
   $temp .= " ".$string[$a];
  }else if($a>12 && $a < 20){
   $temp .= konversi($a - 10)." belas";
  }else if ($a>20 && $a<100){
   $temp .= konversi($a / 10)." puluh". konversi($a % 10);
  }else{
   if($a2<1){

    while ($i<$pjg){
     $char = substr($str,$i,1);
     $i++;
     $temp .= " ".$string[$char];
    }
   }
  }
  return $temp;
 }

 function terbilang($x){
  if($x<0){
   $hasil = "minus ".trim(konversi(x));
  }else{
   $poin = trim(tkoma($x));
   $hasil = trim(konversi($x));
  }

if($poin){
   $hasil = $hasil;
  }else{
   $hasil = $hasil;
  }
  return $hasil;
 }
/*
 if($poin){
   $hasil = $hasil." koma ".$poin;
  }else{
   $hasil = $hasil;
  }
  return $hasil;
 }*/
?>
