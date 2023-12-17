<?php require("connection_mmc.php"); //adding connection file
header("Content-type: text/html; charset=UTF-8");

function hheader($smenu){
	global $conn;
    global $sess_id,$login_form;
    global $questions_cnt, $question_id;
    $archivelnk="";
    if ($smenu==1) {
        $sqlquery = " select group_id,group_name from group_detail where archive!=1 and login='" . $login_form . "' order by group_id";
        $folderlevel="Create Group";
        $pagelink="group_create.php";
        $archivelnk="Archive Group";
        $unarchivelnk="UnArchive Group";
    }else if ($smenu==2) {
        $sqlquery = "select target_id,target_name from target_detail where archive!=1 and login='" . $login_form . "' order by target_id desc";
        $folderlevel="Create Target";
        $pagelink="target.php";
        $archivelnk="Archive Target";
        $unarchivelnk="UnArchive Target";
        $sublnk="DND Formulation";
        $sublnk1="View DND";
    }else if ($smenu==3) {
        $sqlquery = "select contest_id, contest_name from contest_detail where archive!=1 and login='" . $login_form . "' order by contest_id";
        $folderlevel="Create Contest";
        $pagelink="contest_engine.php";
        $archivelnk="Archive Contest";
        $unarchivelnk="UnArchive Contest";
    }else if ($smenu==4) {
        $sqlquery = "select sms_id,message,language from rules_detail where archive!=1 and login='" . $login_form . "' order by sms_id";
        $folderlevel="Create SMS Broadcast";
        $pagelink="bulksms_create.php";
        //$archivelnk="Archive Bulk SMS";
        $archivelnk="Archive SMS Broadcast";
        $unarchivelnk="UnArchive SMS Broadcast";
    }else if ($smenu==5) {
        $sqlquery = " select id,scheduler_name from list_detail where archive!=1 and login_created='" . $login_form . "' order by id";
        $folderlevel="Create Scheduler";
        $pagelink="list_create.php";
        $archivelnk="Archive Scheduler";
        $unarchivelnk="UnArchive Scheduler";
    }else if ($smenu==6) {
        $sqlquery = "select voting_id, voting_name from voting_detail where archive!=1 and login='" . $login_form . "' order by voting_id";
        $folderlevel="Create Voting";
        $pagelink="voting_engine.php";
        $archivelnk="Archive Voting";
        $unarchivelnk="UnArchive Voting";
    }else if ($smenu==7) {
        $sqlquery = "select id,scheduler_name from list_detail where archive!=1 and login_created='" . $login_form . "' order by id";
        $folderlevel="MIS";
        $pagelink="mmc_management.php";
        $archivelnk="Archive Scheduler";
        $unarchivelnk="UnArchive Scheduler";
    }else if ($smenu==8) {
        $sqlquery = "select target_id,target_name from target_detail where archive!=1 and login='" . $login_form . "' order by target_id desc";
        $folderlevel="Create Map";
        $pagelink="ValueMap.php";
        $archivelnk="Archive Map";
        $unarchivelnk="UnArchive Map";
        $viewmaplnk="View Map";
    }

    if ($smenu>=1 && $smenu<=8) {
        $result = mysql_query($sqlquery,$conn) or die('mysql error:' . mysql_error());
        $i = 0;
        while($row = mysql_fetch_row($result)){
            $cnts_id[$i] = $row[0];
            $cnts_name[$i] = $row[1];
            $lang_sms=$row[2];
            if($lang_sms=='Thai'){
            	$cnts_name[$i]=hexToStr($cnts_name[$i]);
            }
            $i = $i + 1;
        }
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html><head>
<title>Media Management Center <? echo date("l, M dS Y", mktime()); ?></title>
<meta name="Author" content="?">
<meta name="Keywords" content="?">
<meta name="Description" content="?">
<link rel="stylesheet" type="text/css" href="style/main.css" title="style">
<link rel="stylesheet" type="text/css" href="style/first.css" title="style">
<link rel="stylesheet" type="text/css" href="style/calendar.css" title="style">
<script src="script/ua.js"></script>
<script src="script/ftiens4.js"></script>
<script src="script/tooltip.js"></script>
<script src="script/client.js"></script>
<script src="script/newscript.js"></script>
<script src='script/choosedate_new.js'></script>

<style>
    SPAN.TreeviewSpanArea A {font-size: 11px;font-family: arial;align:left;text-decoration: none;color: #ffffff;}
    SPAN.TreeviewSpanArea A:hover {color: '#555753';}
    BODY {background-color: #F4F4E4;}
    TD {font-size: 11px;align:left;font-family: arial,verdana,helvetica;}
</style>
<SCRIPT>
//
// Copyright (c) 2006 by Conor O'Mahony.
// For enquiries, please email GubuSoft@GubuSoft.com.
// Please keep all copyright notices below.
// Original author of TreeView script is Marcelino Martins.
//
// This document includes the TreeView script.
// The TreeView script can be found at http://www.TreeView.net.
// The script is Copyright (c) 2006 by Conor O'Mahony.
//
//

USETEXTLINKS = 1
STARTALLOPEN = 0
USEFRAMES = 0
USEICONS = 0
WRAPTEXT = 1
PRESERVESTATE = 1
ADDEXTPARMVAL = "?login=<? echo  $login_form ?>&sess_id=<? echo  $sess_id ?>&smenu=<? echo  $smenu ?>"
FOLDERLEVEL="<? echo $folderlevel; ?>"
PAGELINK="<? echo $pagelink; ?>"
//
// The following code constructs the tree.  This code produces a tree that looks like:
//
// Tree Options
//  - Expand for example with pics and flags
//    - United States
//      - Boston
//      - Tiny pic of New York City
//      - Washington
//    - Europe
//      - London
//      - Lisbon
//  - Types of node
//    - Expandable with link
//      - London
//    - Expandable without link
//      - NYC
//    - Opens in new window
//


foldersTree = gFld("<b>"+FOLDERLEVEL+"</b>", "")
    foldersTree.treeID = "Frameless"
    <? if($archivelnk!="") { ?>
      <? if($smenu>=1){?>
			level1 = insFld(foldersTree, gFld("<? echo $archivelnk; ?> ", "archive.php"+ADDEXTPARMVAL))
    		level1 = insFld(foldersTree, gFld("<? echo $unarchivelnk; ?> ", "unarchive.php"+ADDEXTPARMVAL))
    	<?}else if ($smenu == 61){?>
    		level1 = insFld(foldersTree, gFld("<? echo $archivelnk; ?> ", "archive.php"+ADDEXTPARMVAL))
    		level1 = insFld(foldersTree, gFld("<? echo $unarchivelnk; ?> ", "unarchive.php"+ADDEXTPARMVAL))
    	<?}?>
    <?}?>
    <? if($sublnk!="") { ?>
    	level2 = insFld(foldersTree, gFld("<? echo $sublnk; ?> ", "dnd.php"+ADDEXTPARMVAL))
    	level2 = insFld(foldersTree, gFld("<? echo $sublnk1; ?> ", "view_dnd.php"+ADDEXTPARMVAL))
    <?}?>
    <? if($viewmaplnk!="") { ?>
    	level3 = insFld(foldersTree, gFld("<? echo $viewmaplnk; ?> ", "view_map.php"+ADDEXTPARMVAL))
    <?}?>



     aux1 = insFld(foldersTree, gFld(FOLDERLEVEL, PAGELINK+ADDEXTPARMVAL))
        <?
        if($smenu==1){
        	 for($i=0; $i<count($cnts_id); $i++){?>

        	    ADDEXTPARMVAL_MORE = "&grp_id=<? echo  $cnts_id[$i]; ?>"
                aux2 = insFld(aux1, gFld("<?echo $cnts_name[$i];?>", "group_view.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))

        		<?
        		$sublevel=chk_sublevel ($smenu,$cnts_id[$i]);
        		if($sublevel[0]['id']){
        		    for($k=0,$max=count($sublevel);$k<$max;$k++){?>
                        ADDEXTPARMVAL_MORE = "&grp_id=<? echo  $cnts_id[$i]; ?>&grp_name=<? echo  $cnts_name[$i]; ?>&sgrp_id=<? echo  $sublevel[$k]['id']; ?>"
        		        aux3 = insFld(aux2, gFld("<? echo substr($sublevel[$k]['cnt'],0,20); ?>", "subgroup_view.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
        		<?  }
        		}else{?>
                    ADDEXTPARMVAL_MORE = "&grp_id=<? echo  $cnts_id[$i]; ?>&grp_name=<? echo  $cnts_name[$i]; ?>"
                    aux3 = insFld(aux2, gFld("Add Sub Groups", "subgroup_create.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
        		<?}
             }
        }else if($smenu==2){
            for($i=0; $i<count($cnts_id); $i++){?>
                ADDEXTPARMVAL_MORE = "&target_id=<? echo  $cnts_id[$i] ?>"
                aux2 = insFld(aux1, gFld("<? echo substr($cnts_name[$i],0,20); ?>", "target_view.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
               <?
            }
        }else if($smenu==3){
            for($i=0; $i<count($cnts_id); $i++){?>
                ADDEXTPARMVAL_MORE = "&cnts_id=<? echo  $cnts_id[$i] ?>"
                aux2 = insFld(aux1, gFld("<?echo $cnts_name[$i];?>", "contest_view.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))

               <?
                $sublevel=chk_sublevel ($smenu,$cnts_id[$i]);
				if($sublevel[0]['id']){
                    for($k=0,$max=count($sublevel);$k<$max;$k++){?>
                        ADDEXTPARMVAL_MORE = "&cnts_id=<? echo  $cnts_id[$i]; ?>&question_id=<? echo  $sublevel[$k]['id']; ?>"
                        QNO = "<? echo $k+1;?>";
                        aux3 = insFld(aux2, gFld("Q"+QNO+":"+"<? echo substr($sublevel[$k]['cnt'],0,20); ?>", "question_view.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
                  <?}
                }else{?>
                    ADDEXTPARMVAL_MORE = "&cnts_id=<? echo  $cnts_id[$i]; ?>"
                    aux3 = insFld(aux2, gFld("Add Contest Questions", "contest_question.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
                <?}

            }
        }else if($smenu==4){
            for($i=0; $i<count($cnts_id); $i++){?>
                ADDEXTPARMVAL_MORE = "&sms_id=<? echo  $cnts_id[$i] ?>"
                aux2 = insFld(aux1, gFld("<? echo substr($cnts_name[$i],0,15); ?>", "bulksms_view.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
               <?
            }
        }else if($smenu==5){
             for($i=0; $i<count($cnts_id); $i++){?>
                 ADDEXTPARMVAL_MORE = "&list_id=<? echo  $cnts_id[$i] ?>"
                 aux2 = insFld(aux1, gFld("<?echo $cnts_name[$i];?>", "list_view.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
                <?
             }
 		}else if($smenu==6){
            for($i=0; $i<count($cnts_id); $i++){?>
                ADDEXTPARMVAL_MORE = "&cnts_id=<? echo  $cnts_id[$i] ?>"
                aux2 = insFld(aux1, gFld("<?echo $cnts_name[$i];?>", "voting_view.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))

               <?
                $sublevel=chk_sublevel ($smenu,$cnts_id[$i]);
				if($sublevel[0]['id']){
                    for($k=0,$max=count($sublevel);$k<$max;$k++){?>
                        ADDEXTPARMVAL_MORE = "&cnts_id=<? echo  $cnts_id[$i]; ?>&question_id=<? echo  $sublevel[$k]['id']; ?>"
                        QNO = "<? echo $k+1;?>";
                        aux3 = insFld(aux2, gFld("<? echo substr($sublevel[$k]['cnt'],0,20); ?>", "voting_question_view.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
                  <?}
                }else{?>
                    ADDEXTPARMVAL_MORE = "&cnts_id=<? echo  $cnts_id[$i]; ?>"
                    aux3 = insFld(aux2, gFld("Add Voting Question", "voting_question.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
                <?}

            }
 		}else if($smenu==7){
			?>
			ADDEXTPARMVAL_MORE = "&cnts_id="
			aux2 = insFld(aux1, gFld("Contest", "mmc_management.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
			ADDEXTPARMVAL_MORE = "&cnts_id=&question_id="
				aux3 = insFld(aux2, gFld("MSISDN Wise Report", "msisdnmis.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
				aux3 = insFld(aux2, gFld("Date Wise Score", "datewisescore.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
				aux3 = insFld(aux2, gFld("Keyword Wise Report", "keywordmis.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
				aux3 = insFld(aux2, gFld("Top Scorer", "topscore.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
				aux3 = insFld(aux2, gFld("CDR", "cdr.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))

			ADDEXTPARMVAL_MORE = "&cnts_id="
			aux2 = insFld(aux1, gFld("Voting", "mmc_management.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
			ADDEXTPARMVAL_MORE = "&$mistype=2"
				aux3 = insFld(aux2, gFld("MSISDN Wise Report", "vmsisdnmis.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
				//aux3 = insFld(aux2, gFld("Date Wise Score", "vdatewisescore.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
				//aux3 = insFld(aux2, gFld("Top Scorer", "vtopscore.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
				aux3 = insFld(aux2, gFld("CDR", "vcdr.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))

			//ADDEXTPARMVAL_MORE = "&cnts_id="
			//aux2 = insFld(aux1, gFld("View Scheduler", "mmc_management.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
            <?//for($i=0; $i<count($cnts_id); $i++){?>
                 //ADDEXTPARMVAL_MORE = "&list_id=<? echo  $cnts_id[$i] ?>"
                 //aux3 = insFld(aux2, gFld("<?echo $cnts_name[$i];?>", "scheduler_view.php"+ADDEXTPARMVAL+ADDEXTPARMVAL_MORE))
            <?//}
        }



?>
</SCRIPT>
</head>

<body bgcolor="#ebf3fa" text="#000000" link="#525200" vlink="#525200" alink="#525200" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
    <table border="0" cellspacing="0" cellpadding="0" width="960" align="center">
        <tr height="84px"><td align="center" valign="top"><img src="images/top_header1.gif" alt="banner" border="0" height="84" width="960px"/></td></tr>
        <tr>
            <td align="left" valign="top" background="images/top_header2.gif">
            <table border="0" cellspacing="0" cellpadding="0" width="960" align="center">
                <tr height="22">
                    <td align="left" class="WorkWht">&nbsp;&nbsp;&nbsp;&nbsp;Welcome <? echo ucfirst($login_form); ?></td>
                    <td align="right" class="WorkWht"> <? echo date("l, M dS Y", mktime()); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  class="item1" href="javascript:void(0)"; onClick="JavaScript:closeWindow();"/><? if($smenu=='login'){echo "Close";}else{echo "Logout";}?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
            </table></td>
        </tr>
<?if($login_form != ""){?>

        <tr>
            <td>
                <table border="0" cellspacing="0" cellpadding="0" width="960" align="center">
                    <tr height="32">
                        <td width="210" align="center" valign="middle" background="images/menu1.gif"><a class="item1" href="mmc_management.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>&smenu=1">Group Management</a></td>
                        <td width="210" align="center" valign="middle" background="images/menu1.gif"><a class="item1" href="mmc_management.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>&smenu=8">Map Field</a></td>
                        <td width="170" align="center" valign="middle" background="images/menu1.gif"><a class="item1" href="mmc_management.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>&smenu=2">Target Buildup</a></td>
<!--                        <td width="200" align="center" valign="middle" background="images/menu1.gif"><a class="item1" href="mmc_management.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>&smenu=3">Contest Management</a></td>
                        <td width="200" align="center" valign="middle" background="images/menu1.gif"><a class="item1" href="mmc_management.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>&smenu=6">Voting Management</a></td>-->
                        <td width="210" align="center" valign="middle" background="images/menu1.gif"><a class="item1" href="mmc_management.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>&smenu=4">Bulk SMS Broadcast</a></td> 
                        <td width="170" align="center" valign="middle" background="images/menu1.gif"><a class="item1" href="mmc_management.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>&smenu=5">Scheduler</a></td>
                        <!--<td width="170" align="center" valign="middle" background="images/menu1.gif"><a class="item1" href="mmc_management.php?login=<? echo $login_form; ?>&sess_id=<? echo $sess_id; ?>&smenu=7">MIS</a></td>-->
                    </tr>
                </table>
            </td>
        </tr>

<?}else{?>
        <tr>
            <td>
                <table border="0" cellspacing="0" cellpadding="0" width="960" align="left" id="menu1" class="ddm1">
                    <tr bgcolor="#525200" height="32"><td ALIGN="center">&nbsp;</td></tr>
<?}?>
                </table>
            </td>
        </tr>
<?
}    //close header


function tree_code(){
global $script_footer;
?>
        <tr><td>
                <table border="0" cellspacing="0" cellpadding="0" width="960" align="center">
                    <tr>
                        <td bgcolor="#F4F4E4" width="20%" valign="top">
                            <font size="-2"><a style="font-size:7pt;text-decoration:none;color:#F4F4E4" href="http://www.treemenu.net/" target=_blank></a></font>
                            <span class="WorkWht"><script>initializeDocument()</script><noscript>A tree for site navigation will open here if you enable JavaScript in your browser.</noscript></span>
                        </td>
<?}



/****''*****WorkTop New*********/
function workareatop_new(){
?>
            <TD bgcolor="#F4F4E4" align="left" width="70%" valign="top">
            <br><br>
<?
}

/****''*****WorkTop New*********/
function workareatop(){
?>
            <TD bgcolor="#F4F4E4" align="left" width="70%">

<?
}

/****''*****WorkBot*********/
function workareabottom()
{
    ?>
                <!-- End of Workarea -->
            </TD>
        </TR>
        </TABLE>
        </TD>
    </TR>
    <?
}


/****''*****Footer New*********/
function ffooter_new(){
?>

</table>
<div id="toolTipLayer" style="position:absolute; visibility: hidden;left:0;right:0">
<!-- <div id="TTipes" style="position:absolute;height:25px; z-index:1; display:none; background='#ff00ff'"></div> -->
<!--
<script type="text/javascript">
    var ddm1 = new DropDownMenu1('menu1');
    ddm1.position.top = -1;
    ddm1.init();
</script>
-->
</body>
</html>
<?
}



function ffooter(){
?>
    </table>
</body>
</html>
<?}




function getmonth($m=0) {
    return (($m==0 ) ? date("F") : date("F", mktime(0,0,0,$m)));
}

function getday($m=0) {
    return (($m==0 ) ? date("l") : date("l", mktime(0,0,0,$m)));
}

function ShowTime()

{
    $Day=date("d");
    $Month=date("m");

    //$DayName=date("D");
    //$MonthName=date("M");

    //$Year=date("y");
    $YearName=date("Y");

    $DateToShow= getday(date) . ", " . getmonth($Month) ." ". $Day .", ". $YearName ;

    //echo getday(date());

    //$ShowTime=$DateToShow;
    return  $DateToShow;
}

//Function used by the other bellow recursively to help to check
//if the folder that`s being opened is son of the one being displayed.


//Function used to check if the folder that`s being opened
//is son of the one being displayed.

    function openFolder($treeview_cod,$treeview_current)
    {
        checkParents($treeview_cod,$treeview_current,&$treeview_parents);

        if (in_array($treeview_current,$treeview_parents))
        {
            return true;
        }
    }

//This was the most difficult of all the functions cause it
//calculates and organize the hierarchy of the opened folders...
//A pain in the ass, literally. I had night mares and woke up
//in the middle of the night because of this son of a b*


    function checkParents($treeview_cod,$treeview_current,$treeview_parents)
    {
      	global $conn;
        $sql="select * from TAB_TREEVIEW where treeview_cod=".$treeview_cod." order by treeview_name";
        $rs=mysql_query($sql, $conn);
        if (mysql_num_rows($rs)!=0)
        {
            while($rows=mysql_fetch_array($rs))
            {
                  $treeview_parents[]=$rows["treeview_cod"];
                  checkParents($rows["treeview_parent_cod"],$treeview_current,&$treeview_parents);
            }

        }

    }


    function drawBlanksIntersecs($treeview_cod)
    {
       	global $conn;
            $sql="select * from TAB_TREEVIEW where treeview_cod=".$treeview_cod;
            if ($rs=mysql_query($sql,$conn))
               $row=mysql_fetch_array($rs);

            $sql2="select * from TAB_TREEVIEW where treeview_cod=".$row["treeview_parent_cod"];
            if ($rs2=mysql_query($sql2,$conn))
               $row2=mysql_fetch_array($rs2);

            $sql3="select * from TAB_TREEVIEW where treeview_parent_cod=".$row2["treeview_parent_cod"]." order by treeview_name";
            $rs3=mysql_query($sql3,$conn);

            $i=0;

            if (mysql_query($sql3,$conn))
            {
                  while ($row3=mysql_fetch_array($rs3))
                  {

                      $i++;

                      if ($row3["treeview_cod"]==$row["treeview_parent_cod"] && mysql_num_rows($rs3)==$i)
                      {
                           $is_last=1;
                      }
                      else
                      {
                           $is_last=0;
                      }
                  }
            }

            if ($row["treeview_parent_cod"]!=-1)
            {
                  drawBlanksIntersecs($row["treeview_parent_cod"]);

                  if ($is_last==1)
                  {
                      echo "<img src=images/trv_blank.gif height=18 width=18 border=0 vspace=0 hspace=0 align=left>";
                  }
                  else
                  {
                      echo "<img src=images/trv_nointersec.gif height=18 width=18 border=0 vspace=0 hspace=0 align=left>";
                  }
            }

    }

//Function that builds the tree from root to the last opened folder
//I`m very proud of it, `cause it works!!! Don`t care if it is too
//messy or has too many ifs. At least idention is right, so if you
//want go ahead and fix it yourself.

    function buildTreeView($action,$treeview_cod=0,$treeview_parent_cod=-1,$depth=0,$parent_last=0)
    {
        global $login_form,$conn;

        $login = $_REQUEST["login"];

        $sql="select * from TAB_TREEVIEW where treeview_parent_cod=".$treeview_parent_cod." order by treeview_cod";
        if ($rs=mysql_query($sql,$conn)){
            $depth++;
            $i=1;
            while ($parent=mysql_fetch_array($rs)){
                    echo "<tr valign=top>";
                    echo "<td nowrap colspan='3'>";

                    if ($parent["treeview_parent_cod"]!=-1)
                       drawBlanksIntersecs($parent["treeview_cod"]);

                    $sql2="select * from TAB_TREEVIEW where treeview_parent_cod=".$parent["treeview_cod"]." order by treeview_cod";
                    $rs2=mysql_query($sql2,$conn);
                    if (mysql_num_rows($rs2)!=0){
                         if ($action=="expand"&&openFolder($treeview_cod,$parent["treeview_cod"])){
                               echo "<b><a href=?action=expand&treeview_cod=".$parent["treeview_parent_cod"]."&login=".$login_form.">";
                               if (mysql_num_rows($rs)==$i){
                                   echo "<img src=".$dir."images/trv_intersecminus_end.gif height=18 width=18 border=0 vspace=0 hspace=0 align=left>";
                               }else{
                                   echo "<img src=".$dir."images/trv_intersecminus.gif height=18 width=18 border=0 vspace=0 hspace=0 align=left>";
                               }
                         }else{
                               echo "<a href=?action=expand&treeview_cod=".$parent["treeview_cod"]."&login=".$login_form.">";
                               if (mysql_num_rows($rs)==$i){
                                   echo "<img src=".$dir."images/trv_intersecplus_end.gif height=18 width=18 border=0 vspace=0 hspace=0 align=left>";
                               }else{
                                   echo "<img src=".$dir."images/trv_intersecplus.gif height=18 width=18 border=0 vspace=0 hspace=0 align=left>";
                               }
                         }
                    }else{
                         if (mysql_num_rows($rs)==$i){
                               echo "<img src=images/trv_end.gif height=18 width=18 border=0 vspace=0 hspace=0 align=left>";
                         }else{
                               echo "<img src=images/trv_intersec.gif height=18 width=18 border=0 vspace=0 hspace=0 align=left>";
                         }
                    }

                    if ($action=="expand"&&openFolder($treeview_cod,$parent["treeview_cod"])){
                         echo "<img src=images/trv_openfolder.gif height=18 width=18 border=0 vspace=0 hspace=0 align=left>";
                    }else{
                         echo "<img src=images/newtrv.gif height=9 width=9 border=0 vspace=0 hspace=0 align=left>";
                    }
                    echo "</a>";

                    //Here you can change where the link of the folder points too.
                    //You really should to edit it...

                    $url_path = getUrl($parent["treeview_cod"]);
                    echo "<a href=/mmcnew/gui/" . $url_path . "?login=$login&treeview_cod=".$parent["treeview_cod"]."&action=expand>";
                    //echo "<a href=http://202.186.147.79/mmcnew/gui/" . $url_path . "?treeview_cod=".$parent["treeview_cod"]." target=treeview_main>";
                    echo "&nbsp;&nbsp;".$parent["treeview_name"];
                    echo "</td>";
                    echo "</tr>";
                    if ($action=="expand"&&openFolder($treeview_cod,$parent["treeview_cod"])){
                         buildTreeView($action,$treeview_cod,$parent["treeview_cod"],$depth,$parent_last);
                    }
                    $i++;
            }
        }
    }



function getUrl($tree_code)
{
    global $conn;
    $sql="select * from TAB_TREEVIEW where treeview_cod=".$tree_code."";
    $rs=mysql_query($sql,$conn);
    if (mysql_num_rows($rs)!=0){
        while($rows=mysql_fetch_array($rs)){
              $tree_url=$rows["url"];
        }
    }
    return $tree_url;
}

function chk_sublevel ($level,$levelid)
{
    global $conn, $login_form;
    $sublevel=array();

  	if ($level==1) {
  		$sqlquery = "select subgroup_name,subgroup_id from subgroup_detail where group_id='" . $levelid . "' and login='" . $login_form . "' order by subgroup_id";
    }else if ($level==3) {
    	$sqlquery = "select question, id from contest_questions where contest_id='" . $levelid . "' and login='" . $login_form . "' order by ques_no";
    }else if ($level==6) {
    	$sqlquery = "select question, id from voting_questions where voting_id='" . $levelid . "' and login='" . $login_form . "' order by ques_no";
    }

    $result = mysql_query($sqlquery,$conn) or die('mysql error:' . mysql_error());
    $i = 0;
    while($row = mysql_fetch_row($result)){
        $sublevel[$i]["cnt"] = $row[0];
        $sublevel[$i]["id"] = $row[1];
        $i++;
    }
    return $sublevel;
}
?>
