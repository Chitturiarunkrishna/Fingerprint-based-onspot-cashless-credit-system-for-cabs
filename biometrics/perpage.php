<?php
	function perpage($count, $per_page = '10',$href) {
		$output = '';
		$paging_id = "link_perpage_box";
		if(!isset($_POST["page"])) $_POST["page"] = 1;
		if($per_page != 0)
		$pages  = ceil($count/$per_page);
		if($pages>1) {
			
			if(($_POST["page"]-3)>0) {
				if($_POST["page"] == 1)
					$output = $output . '<span id=1 class="current-page btn btn-default">1</span>';
				else				
					$output = $output . '<input type="submit" name="page" class="perpage-link btn btn-default" value="1" />';
			}
			if(($_POST["page"]-3)>1) {
					$output = $output . '...';
			}
			
			for($i=($_POST["page"]-2); $i<=($_POST["page"]+2); $i++)	
			{
				if($i<1) continue;
				if($i>$pages) break;
				if($_POST["page"] == $i)
					$output = $output . '<span id='.$i.' class="current-page btn btn-default" >'.$i.'</span>';
				else				
					$output = $output . '<input type="submit" name="page" class="perpage-link btn btn-danger" value="' . $i . '" />';
			}
			
			if(($pages-($_POST["page"]+2))>1) 
			{
				$output = $output . '...';
			}
			if(($pages-($_POST["page"]+2))>0) {
				if($_POST["page"] == $pages)
					$output = $output . '<span id=' . ($pages) .' class="current-page btn btn-default">' . ($pages) .'</span>';
				else				
					$output = $output . '<input type="submit" name="page" class="perpage-link btn btn-danger" value="' . $pages . '" />';
			}
			
		}
		return $output;
	}
	
	function showperpage($sql, $per_page = 10, $href) {
	    require_once("dbcontroller.php");
	    $db_handle = new DBController();
	    $count   = $db_handle->numRows($sql);
		$perpage = perpage($count, $per_page,$href);
		return $perpage;
	}
?>