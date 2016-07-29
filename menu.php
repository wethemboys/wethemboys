<?php
$user_type = $_SESSION["theuser"]['Type'];
$myurl = basename($_SERVER['PHP_SELF']);
$page = substr($myurl, 0, strpos($myurl, "."));
$url_get = isset($_GET['m']) ?$_GET['m'] : '';
$csshidden = 'display:none;'
?>

<ul class="menu_bar">
    <li class="<?php echo $page=='index'? 'selected' : '';?> "><a href="index.php">Home</a></li>
    <li class="<?php echo $page=='projects'? 'selected' : '';?>"><a href="projects.php">Projects</a>
        <ul class="sub_menu">
            <li <?php echo $url_get=='inprogress'? 'selected' : '';?>><a href="projects.php?m=inprogress">In Progress</a></li>
            <li <?php echo $url_get=='completed'? 'selected' : '';?>><a href="projects.php?m=completed">Completed</a></li>
        </ul>
    </li>
    <li class="<?php echo $page=='resources'? 'selected' : '';?> " style="<?php echo $user_type=='client'? $csshidden : '';?>"><a href="resources.php">Resources</a></li>
    <li class="<?php echo $page=='clients'? 'selected' : '';?> " style="<?php echo $user_type !='admin'? $csshidden : '';?>"><a href="clients.php">Clients</a></li>
    <li style="position:absolute;right:10px;"><a id="mn_optbtn" style="outline-width:0px;cursor:pointer"><span class="glyphicon glyphicon-menu-hamburger" style="margin-right:5px;"></span> <span id="usr_menu_disp">Marvin Gaye</span></a></li>
</ul>