

<?php
    require_once("perpage.php");    
    require_once("dbcontroller.php");
    $db_handle = new DBController();
    
    $title = "";
    $domain = "";
    if(isset($_GET['select']))
    {
    $select=$_GET['select'];
    }
    $queryCondition = "WHERE type = 'FREE' AND status = 'ACTIVE'";
    if(!empty($_POST["search"])) 
    {
        foreach($_POST["search"] as $k=>$v)
        {
            if(!empty($v)) 
            {

                $queryCases = array("title","domain");
                if(in_array($k,$queryCases)) 
                {
                    if(!empty($queryCondition)) 
                    {
                        $queryCondition .= " AND ";
                    } 
                    else 
                    {
                        $queryCondition .= " WHERE ";
                    }
                }
                switch($k) 
                {
                    case "title":
                        $title = $v;
                        $queryCondition .= "title LIKE '" . $v . "%'";
                        break;
                    case "domain":
                        $domain = $v;
                        $queryCondition .= "domain LIKE '" . $v . "%'";
                        break;
                }
            }
        }
    }
    $orderby = " ORDER BY pid desc"; 
    $sql = "SELECT * FROM proj " . $queryCondition;
    $href = 'projects.php';                    
        
    $perPage = 3; 
    $page = 1;
    if(isset($_POST['page']))
    {
        $page = $_POST['page'];
    }
    $start = ($page-1)*$perPage;
    if($start < 0) $start = 0;
        
    $query =  $sql . $orderby .  " limit " . $start . "," . $perPage; 
    $result = $db_handle->runQuery($query);
    
    if(!empty($result)) 
    {
        $result["perpage"] = showperpage($sql, $perPage, $href);
    }
?>
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="xmlrpc.php">

		<title>KNOW HUB</title>

		<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2&appId=334725317381263&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

		<meta name="twitter:card" content="summary_large_image" />


		<link rel='dns-prefetch' href='http://platform-api.sharethis.com/' />
		<link rel='dns-prefetch' href='http://fionna-chan.neocities.org/' />
		<link rel='dns-prefetch' href='http://fonts.googleapis.com/' />
		<link rel='dns-prefetch' href='http://s.w.org/' />

		<style type="text/css">

		

		img.wp-smiley,
		img.emoji {
			display: inline !important;
			border: none !important;
			box-shadow: none !important;
			height: 1em !important;
			width: 1em !important;
			margin: 0 .07em !important;
			vertical-align: -0.1em !important;
			background: none !important;
			padding: 0 !important;
		}
		</style>
		<link rel='stylesheet' id='share-this-share-buttons-sticky-css'  href='wp-content/plugins/sharethis-share-buttons/css/mu-style5010.css?ver=4.9.8' type='text/css' media='all' />
		<link crossorigin="anonymous" rel='stylesheet' id='bloggerz-fonts-css'  href='https://fonts.googleapis.com/css?family=Lato%3A400%2C400italic%2C700%2C700italic&amp;subset=latin%2Clatin-ext' type='text/css' media='all' />
		<link rel='stylesheet' id='normalize-css'  href='wp-content/themes/bloggerz/css/normalize19ce.css?ver=3.0.3' type='text/css' media='all' />
		<link rel='stylesheet' id='font-awesome-css'  href='wp-content/themes/bloggerz/css/font-awesome/css/font-awesome.min4698.css?ver=4.6.3' type='text/css' media='all' />
		<link rel='stylesheet' id='bloggerz-style-css'  href='wp-content/themes/bloggerz/style19f6.css?ver=1.0.7' type='text/css' media='all' />
		<style id='bloggerz-style-inline-css' type='text/css'>

		            .logo a, .wp-menu > li > a{
		                    color: #4a88c2;
		            }
		</style>
		<link rel='stylesheet' id='wpgdprc.css-css'  href='wp-content/plugins/wp-gdpr-compliance/assets/css/front8704.css?ver=1548227071' type='text/css' media='all' />
		<style id='wpgdprc.css-inline-css' type='text/css'>

		            div.wpgdprc .wpgdprc-switch .wpgdprc-switch-inner:before { content: 'Yes'; }
		            div.wpgdprc .wpgdprc-switch .wpgdprc-switch-inner:after { content: 'No'; }
		        
		</style>
		<link rel='stylesheet' id='learn-press-css'  href='wp-content/plugins/learnpress/assets/css/learnpress97dd.css?nocache=1548697969.7902&amp;ver=3.2.5.1' type='text/css' media='all' />
		<link rel='stylesheet' id='jquery-scrollbar-css'  href='wp-content/plugins/learnpress/assets/js/vendor/jquery-scrollbar/jquery.scrollbar97dd.css?nocache=1548697969.7902&amp;ver=3.2.5.1' type='text/css' media='all' />
		<script type='text/javascript' src='../platform-api.sharethis.com/js/sharethis.js#property=5beeb6077c3c810011b38b86&#038;product=inline-share-buttons-wp'></script>
		<script type='text/javascript' src='wp-includes/js/jquery/jqueryb8ff.js?ver=1.12.4'></script>
		<script type='text/javascript' src='wp-includes/js/jquery/jquery-migrate.min330a.js?ver=1.4.1'></script>
		<script type='text/javascript' src='wp-content/themes/bloggerz/js/navigation5152.js?ver=1.0'></script>
		<script type='text/javascript' src='../fionna-chan.neocities.org/js/fSlider5152.html?ver=1.0'></script>
		<script type='text/javascript' src='wp-content/plugins/wp-gdpr-compliance/assets/vendor/micromodal/micromodal.min8704.js?ver=1548227071'></script>
		<script type='text/javascript' src='wp-content/plugins/learnpress/assets/js/vendor/watch97dd.js?nocache=1548697969.7902&amp;ver=3.2.5.1'></script>
		<script type='text/javascript' src='wp-content/plugins/learnpress/assets/js/vendor/jquery.alert97dd.js?nocache=1548697969.7902&amp;ver=3.2.5.1'></script>
		<script type='text/javascript' src='wp-content/plugins/learnpress/assets/js/vendor/circle-bar97dd.js?nocache=1548697969.7902&amp;ver=3.2.5.1'></script>
		<script type='text/javascript' src='wp-includes/js/underscore.min4511.js?ver=1.8.3'></script>

		<script type='text/javascript' src='wp-content/plugins/learnpress/assets/js/global97dd.js?nocache=1548697969.7902&amp;ver=3.2.5.1'></script>
		<script type='text/javascript' src='wp-content/plugins/learnpress/assets/js/vendor/jquery-scrollbar/jquery.scrollbar97dd.js?nocache=1548697969.7902&amp;ver=3.2.5.1'></script>
		<script type='text/javascript' src='wp-content/plugins/learnpress/assets/js/frontend/learnpress97dd.js?nocache=1548697969.7902&amp;ver=3.2.5.1'></script>

		<script type='text/javascript' src='wp-content/plugins/learnpress/assets/js/frontend/course97dd.js?nocache=1548697969.7902&amp;ver=3.2.5.1'></script>
		<script type='text/javascript' src='wp-content/plugins/learnpress/assets/js/vendor/jquery.scrollTo97dd.js?nocache=1548697969.7902&amp;ver=3.2.5.1'></script>
		<script type='text/javascript' src='wp-content/plugins/learnpress/assets/js/frontend/become-teacher97dd.js?nocache=1548697969.7902&amp;ver=3.2.5.1'></script>
		<link rel='https://api.w.org/' href='wp-json/index.html' />
		<link rel="EditURI" type="application/rsd+xml" title="RSD" href="xmlrpc0db0.php?rsd" />
		<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="wp-includes/wlwmanifest.xml" /> 
		<meta name="generator" content="WordPress 4.9.8" />
		<script async src="../pagead2.googlesyndication.com/pagead/js/f.txt"></script>
</head>

<body class="home blog">

	<!-- Add your site or application content here -->
	<div class="wrapper">
		<header class="headerWrapper">
			<div class="container">
						<div class="logo-container">
				<h1 class="logo">
					<a href="projects.php" rel="home" title="A Knowledge Sharing Platform">KNOW HUB</a>
				</h1>
			</div>
							<button class="menu-btn">
					<span class="bar"></span>
				</button>
					<ul id="menu-primary-menu" class="wp-menu">
						<li id="menu-item-206491" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-206491"><a href="projects.php?select=1">HOME</a></li>
						<li id="menu-item-206492" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-206491"><a href="uppro.php">UPLOAD YOUR PROJECT</a></li>
						<li id="menu-item-206577" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-206577"></li>
						<li id="menu-item-206580" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-206580"></li>
						<li id="menu-item-206583" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-206583">
							<a href="discuss.php">DISCUSSION FORUM</a>
						</li>
						<li id="menu-item-206586" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-206586">
							<a href="logout.php">LOGOUT</a>
						</li>
					</ul>			
				</div><!-- /.container -->
		</header>

	<div class="banner-section header-banner banner-bgc">
		<img src="wp-content/themes/bloggerz/img/banne_img_home.jpg" alt="">
		<div class="banner-txt-section"><h1>KNOW HUB</h1><p>A knowledge sharing platform</p></div><!--  .banner_txt_section -->

	</div><!-- /.banner-section -->
	<div class="container main-section">
		<div class="row">
            <div class="col-md-12">
            	<form name="frmSearch" class="form-group" method="post" action="projects.php?select=1"><br>
                    <input type="text" placeholder="TITLE" class="form-control" name="search[title]" /><br>
                    <input type="text" placeholder="DOMAIN" class="form-control" name="search[domain]" /><br>
                    <input type="submit" name="go" value="Search" class="btn btn-info">
                    <input type="reset" value="Reset" onclick="window.location='projects.php?select=1'" class="btn btn-warning"/>
                    <br><br>
                    <?php
                    if(isset($_GET['select']))
                    {
                    if($select==1)
                    {
                    ?>

                     <?php
                    if(!empty($result)) 
                    {
                        foreach($result as $k=>$v) 
                        {
                          if(is_numeric($k)) 
                          {
                    ?>

        <div class="row">
		  	<div class="col-md-12">
			  	<div class="panel panel-primary">
			        <div class="panel-heading">
				        <div class="panel-title">
				           <span class="text-justify text-uppercase"> <?php echo $result[$k]["title"]; ?> </span>
				        </div>
					</div>
			        <?php 
	                    $user = $result[$k]["user"];
	                    $year = $result[$k]["year"];
	                    $des = $result[$k]["des"];
	                    $tech = $result[$k]["tech"];
	                    $domain = $result[$k]["domain"];
	                    $pid = $result[$k]["pid"];
	        		?>

		   			<div class="panel-body overflow-x-auto">
				        <div class="col-xs-12 p-n">
				            <div class="col-xs-6 p-n">
				                <b>DOMAIN:</b>
				            </div>
				            <!-- /.col-md-6 -->
				            <div class="col-xs-6 p-n">
				               <span class="label label-success">
				               <?php echo $result[$k]["domain"]; ?>
				           	   </span>
				            </div>
				            <!-- /.col-md-6 -->
				        </div>
				        <!-- /.col-xs-12 -->
				        <div class="col-xs-12 p-n">
				            <div class="col-xs-6 p-n">
				                <b>YEAR:</b>
				            </div>
				            <!-- /.col-md-6 -->
				            <div class="col-xs-6 p-n">
				                <i class="fa fa-calendar" aria-hidden="true">
				                <?php echo $result[$k]["year"]; ?>
				            	</i>
				            </div>
				            <!-- /.col-md-6 -->
				        </div>
				        <!-- /.col-xs-12 -->
				        <div class="col-xs-12 p-n">
				            <div class="col-xs-6 p-n">
				                <b>TECHNOLOGIES USED:</b>
				            </div>
				            <!-- /.col-md-6 -->
				            <div class="col-xs-6 p-n">
				                <span class="label label-danger label-wide"><?php echo $result[$k]["tech"]; ?></span>
				            </div>
				            <!-- /.col-md-6 -->
				        </div>
				        <!-- /.col-xs-12 -->
				        <div class="col-xs-12 p-n">
				            <div class="col-xs-6 p-n">
				                <b>UPLOADER:</b>
				            </div>
				            <!-- /.col-md-6 -->
				            <div class="col-xs-6 p-n">
				               <i class="fa fa-users" aria-hidden="true">
				               	<?php echo $result[$k]["user"]; ?>
				           	   </i>
				            </div>
				            <br>
				             <div class="col-xs-6 p-n">
				           	   <div class="fb-share-button" data-href="https://aruntech.xyz/knowhub/" data-layout="button" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Faruntech.xyz%2Fknowhub%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
				           	</div>
				           	<div class="col-xs-6 p-n">
				           		<span class="label label-primary label-wide">
				           			<a href="know.php?pid=<?php echo $pid; ?>" style="text-decoration: hidden; color:white;">KNOW MORE</a>
				           		</span>
				           	</div>
				            <!-- /.col-md-6 -->
				            
				        </div>
				        <!-- /.col-xs-12 -->
				        	
				    </div>
		  		</div>
			</div>
		</div>
		  

		 <?php
                          }
                        }
                    }
                    if(isset($result["perpage"])) 
                    {
                    ?>
                    <br>
                    
                     <?php echo $result["perpage"]; ?>
                    
                    <?php }
                    }
                    }
                     ?>
	

        </form>    
            </div>
        </div>

      


		
	 <!--  .container main-section -->

	</div> <!-- #content -->

	

</div><!--  .wraper -->

<script type='text/javascript' src='wp-content/themes/bloggerz/js/vendor/modernizr-2.8.3.minf7ff.js?ver=2.8.3'></script>
<script type='text/javascript' src='wp-content/themes/bloggerz/js/main19f6.js?ver=1.0.7'></script>

<script type='text/javascript' src='wp-content/plugins/wp-gdpr-compliance/assets/js/front8704.js?ver=1548227071'></script>
<script type='text/javascript' src='wp-includes/js/wp-embed.min5010.js?ver=4.9.8'></script>

</body>

</html>