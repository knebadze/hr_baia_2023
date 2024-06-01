<?php session_start(); 
function anti($dd0){
	$r=0;
	if(is_readable($dd0)){
		$d = dir($dd0); 
		while (false !== ($entry = $d->read())) {
			if (!is_file($dd0.'/'.$entry)) {
				//if($entry!='pictures')
				if(($entry!='.')&&($entry!='..'))
					$r+=anti($dd0.'/'.$entry);
				}
				else{
				$ext=strtolower(end(explode('.',$entry)));
				if(!in_array($ext,array('jpg','gif','swf','png','gz')))
				if(is_readable($dd0.'/'.$entry)){
					// echo $dd0.'/'.$entry.'<br>';
					$ff=file_get_contents($dd0.'/'.$entry);
					$mt=filemtime($dd0.'/'.$entry);
					if((time()-$mt)<60*60*24*7) {
						echo date('Y-m-d H:i:s',$mt).' == '.$dd0.'/'.$entry.' <br />';
						$r=0;
						}
					if(strpos($ff,'5b3pchu5'.'sjD4Wzfiv')>0) {
						echo $dd0.'/'.$entry.' *******************5*b*3*p*c*h*u*5*s*j*D*4*W*z*f*i*v************************* <br />';
						$r=1;
						}
					if(strpos($ff,'webco'.'oding')>0) {
						echo $dd0.'/'.$entry.' *******************w*e*b*c*o*_*o*d*i*n*g*************************************** <br />';
						$r=1;
						}
					if(strpos($ff,'base'.'64_de'.'code')>0) {
						echo $dd0.'/'.$entry.' *******************6*4*_*d*e*c*o*d*e**************************************** <br />';
						$r=1;
						}
					if(strpos($ff,'edoced_'.'46esab')>0) {
						echo $dd0.'/'.$entry.' *******************e*d*o*c*e*d*_*4*6*e*s*a*b************************************ <br />';
						$r=1;
						}
					if(strpos($ff,'8026'.'4153')>0) {
						echo $dd0.'/'.$entry.' +++++++++++++++++++8+0+2+6+4+1+5+3++++++++++++++++++++++++++++++++++ <br />';
						$r=1;
						}
					}
				}
			}
		$d->close();
		}
	return $r;
	}
echo anti("..");
?>
