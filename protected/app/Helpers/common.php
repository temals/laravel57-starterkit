<?php

function number($digit) {

	if(!empty($digit) && $digit > 0) {
		return number_format($digit,0,',','.');
	}

	return (!empty($digit) ? $digit : 0);
}

function getSetting() {
	return \App\Models\Setting::get()->pluck('value','key')->toArray();
}

function emailAdmin() {
	return 'temals.mulyadi@gmail.com';
}

function getAdmin() {
	return \App\Admin::first();
}

function handleUpload($inputName="image",$filename="",$path="/uploads") {

	$req = request();

    if($req->hasFile($inputName)):
        $file = $req->file($inputName);
        $ext = $file->extension();

        $filename = (!empty($filename) ? str_slug($filename).".".$ext : null);

        return \Storage::disk('local')->putFileAs(
            $path,$file,$filename
        );
    endif;
}

function handleMultipleUpload($inputName="image",$filename="",$path="/uploads",$allowReplace=false) {

	$req = request();
	$images = [];

    if($req->hasFile($inputName)):
        $files = $req->file($inputName);
        // $filename = (!empty($filename) ? str_slug($filename) : '');

        if(!is_array($files)):
        	$files = [$req->file($inputName)];
        endif;

        $newName = "";

    	$i=1;
    	foreach($files as $key=>$file):
    		$getExt = explode(".",$file->getClientOriginalName());
    		$ext = $getExt[count($getExt)-1];
    		// $ext = $file->extension();
    		if($filename == "KEY"):
    			$initName = $key;
    		elseif(!empty($filename)):
    			$initName = $filename;
    		else:
    			$initName = str_replace(".".$ext,"",$file->getClientOriginalName());
    		endif;

    		// $newName = $initName.$i.".".$ext;

    		if(!$allowReplace):
    		// cek agar tidak mereplace gambar yang exists
	    		do {
	    			// filename get original name
	    			$newName = $initName.$i.".".$ext;
	    			$i++;
	    		} while(file_exists(public_path($path.'/'.$newName)));
	    	else:
	    		$newName = $initName.".".$ext;
	    	endif;

    		if(!empty($newName)):
    			$images[$key] = \Storage::disk('local')->putFileAs(
	    		    $path,$file,$newName
	    		);
	    	endif;

	    	$i++;
    	endforeach;

    endif;

    return $images;
}


function formatDate($date,$type="local") {

	try {

		$date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$date);
		
		if($type == "local") {
			return $date->format('d F Y  H:i');
		} else if($type == "local-date") {
			return $date->format('d F Y');
		} else if($type == "local-time") {
			return $date->format('H:i');
		} else if($type == "human") {
			return $date->diffForHumans();
		}

		return $date;

	} catch(Exception $e) {
	  return $date;
	}

}

function formatTime($date,$type="local") {

	try {

		$date = \Carbon\Carbon::createFromFormat('H:i:s',$date);
		
		if($type == "local") {
			return $date->format('H:i');
		} else if($type == "human") {
			return $date->diffForHumans();
		}

		return $date;

	} catch(Exception $e) {
	  return $date;
	}

}

function extractStatistic($collections,$periode=false,$date="created_at") {
	$data = [];
	
	if(!empty($collections) && !$collections->isEmpty()) {
		foreach($collections as $collect):

			if(empty($collect->status)):
				$data['status']['all'][] = $collect;
			else:
				$status = strtolower($collect->status);
				if($periode && $collect->$date):
					$year = date("Y");
					for($i=0;$i<12;$i++):
						$month = str_pad(($i+1), 2, '0', STR_PAD_LEFT);
						$ym = $year."-".$month;
						if(is_numeric(strpos($collect->$date,$ym))):
							$data['periode'][$i+1][$status][] = $collect;
							$data['periode'][$i+1]['all'][] = $collect;
						endif;
					endfor;
				endif;

				$data['status'][$status][] = $collect;
				$data['status']['all'][] = $collect;
			endif;
		endforeach;
	}

	return $data;
}

function responseApi($collections) {

	$count = request()->get('count',20);
	$page = request()->get('page',1);
	$method = request()->method();

	if(request()->isMethod('post') || request()->isMethod('put')):

		$saved = $collections;
		if($saved):
			return [
				'message' => __('msg.save.success'),
				'object' => [],
				'last_slug' => []
			];
		endif;

		return [
			'errors' => [
				'code' => '',
				'message' => __('msg.save.fail')
			]
		];

	elseif(request()->isMethod('delete')):

		$deleted = $collections;

		if($deleted):
			return [
				'message' => __('msg.delete.success'),
			];
		endif;

		return [
			'errors' => [
				'code' => '',
				'message' => __('msg.delete.fail')
			]
		];
	endif;

	if(empty($collections->count())):
		return [
			'data' => $collections
		];
	endif;


	return [
		'data' => $collections->forPage($page,$count)->all(),
		'page' => $page,
		'count' => $count
	];
}