var xmlhttp,cnt=0,rowind=0,cntalias=0,rowindalias=0,cntsms=0,rowsmsind=0,grp_id=Array(),sgroup_cnts=Array(),cboitem=Array(),acbosbg=Array();
function null_chk(obj,msg){if(obj.value==null||obj.value==''){alert(msg);obj.focus();return true;}else{return false;}};
function alpha_chk(obj,msg){var txtPatrn=/^([a-zA-Z])([a-zA-Z_0-9])*$/;if(!txtPatrn.test(obj.value)){alert(msg);obj.focus();return false;}else{return true;}};
function alphaid_chk(obj,msg){var txtPatrn=/^([a-zA-Z0-9])([a-zA-Z_0-9])*$/;if(!txtPatrn.test(obj.value)){alert(msg);obj.focus();return false;}else{return true;}};
function alphanum_chk(obj,msg){var txtPatrn=/^([a-zA-Z0-9])([a-zA-Z0-9])*$/;if(!txtPatrn.test(obj.value)){alert(msg);obj.focus();return false;}else{return true;}};
function num_chk(obj,msg){var txtPatrn=/^(\d){1,5}$/;if(!txtPatrn.test(obj.value)){alert(msg);obj.focus();return false;}else{return true;}};
function num_chk_list(obj,msg){var txtPatrn=/^(\d){1,6}$/;if(!txtPatrn.test(obj.value)){alert(msg);obj.focus();return false;}else{return true;}};
function text_chk(obj,msg){var txtPatrn=/^(\w).*$/;if(window.RegExp(txtPatrn) && !txtPatrn.test(obj.value)){alert(msg);obj.focus();return false;}else{return true;}};
function plen_chk(obj,lval,rval){if(obj.value.length<lval){alert("Plz Enter Password Atleast "+lval+" Character!");obj.focus();return false;}else if(obj.value.length>rval){alert("Plz Enter Password Upto "+rval+" Character!");obj.focus();return false;}else{return true;}};
function dt_chk(obj,msg){var txtPatrn=/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;if(window.RegExp(txtPatrn) && !txtPatrn.test(obj.value)){alert(msg);obj.focus();return false;}else{return true;}};
function num_cmp(numobj1,numobj2,msg){if(Number(numobj1.value)>Number(numobj2.value)){return true;}else{alert(msg);numobj2.focus();return false;}};
function dt_cmp(dtstr1,dtstr2,msg,obj){var timestamp1="",timestamp2="";var s_date=new Date();var e_date=new Date();var c_date=new Date();timestamp1=make_timestamp(s_date,dtstr1);if(dtstr2=='now'){timestamp2=c_date.getTime();}else{timestamp2=make_timestamp(e_date,dtstr2);}if(Number(timestamp1)>Number(timestamp2)){return true;}else{alert(msg);obj.focus();return false;}};
function make_timestamp(dtobj,dtstr){var dttmp=dtstr.split(/[\/]/);dtobj.setDate(dttmp[1]);dtobj.setMonth(dttmp[0]-1);dtobj.setFullYear(dttmp[2]); dtobj.setHours(dttmp[3]);dtobj.setMinutes(dttmp[4]);dtobj.getTime();return dtobj;};
function CountLeft(field, count, max) {if (field.value.length > max) field.value = field.value.substring(0, max);else count.value =field.value.length;}
function index_chk(thisform){with (thisform){if(null_chk(login,'Login name must be filled out!')==true||alpha_chk(login,'Name should starts with an alphabet. Spaces not allowed. Underscores are acceptable!')==false){return false;}else if(null_chk(password,'Login Password must be filled out!')==true||plen_chk(password,'6','12')==false){return false;}else {return true;}}};
function index_submit(){var obj=document.getElementById("index_form");if(index_chk(obj)){loadXMLDoc("validateuser.php?login="+obj.login.value+"&password="+obj.password.value);}else{return false;}};
function loadXMLDoc(url){xmlhttp=null;if (window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}else if (window.ActiveXObject){xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}if (xmlhttp!=null){xmlhttp.onreadystatechange=state_Change;xmlhttp.open('GET',url,true);xmlhttp.send(null);}else{alert("Your browser does not support XMLHTTP."); return 0;}};
function state_Change()	{if (xmlhttp.readyState==1){window.status="Loading...!";}else if(xmlhttp.readyState==2){window.status="Loading Completed...!";}else if (xmlhttp.readyState==4){if (xmlhttp.status==200){var match = xmlhttp.responseText;var pos = match.indexOf('|');if(pos<0){var objdiv=document.getElementById("error_msg");objdiv.style.display='block';objdiv.innerHTML=match;}else{	var temp = new Array();temp = match.split('|');document.getElementById("login_id").value=temp[0];document.getElementById("login").value=temp[1];document.getElementById("alertmsg").value=temp[2];document.getElementById("index_form").submit();}}else  {alert("Problem retrieving data:" + xmlhttp.statusText);return false;}}};
function radiochk(strobj,msg){var radval=document.getElementsByName(strobj),radvalLen=radval.length,radstrval=0;for(i=0;i<radvalLen;i++){if(radval[i].checked){radstrval=radval[i].value;};};if(!radstrval){alert(msg);}return radstrval;};
function chkrow(strid){var odiv=document.getElementById(strid),objtxt=document.getElementsByName("futtxt[]"),objlnk=document.getElementsByName("futlnk[]"),ln1=objtxt.length,valtxt=Array(),vallnk=Array(),i=0,ln=0;for(i=0;i<ln1;i++){ln=i+1;if(null_chk(objtxt[i],"Please Enter Contest Header Text "+ln+"!")==true||text_chk(objtxt[i],"Please Do not Use Special Character in Contest Header Text "+ln)==false){return false;}else if(null_chk(objlnk[i],"Please Enter Contest Header Link "+ln+"!")==true||text_chk(objlnk[i],"Please Do not Use Special Character in Contest Header Link "+ln)==false){return false;};}return true;};
function chkrowvoting(strid){var odiv=document.getElementById(strid),objtxt=document.getElementsByName("futtxt[]"),objlnk=document.getElementsByName("futlnk[]"),ln1=objtxt.length,valtxt=Array(),vallnk=Array(),i=0,ln=0;for(i=0;i<ln1;i++){ln=i+1;if(null_chk(objtxt[i],"Please Enter Voting Header Text "+ln+"!")==true||text_chk(objtxt[i],"Please Do not Use Special Character in Voting Header Text "+ln)==false){return false;}else if(null_chk(objlnk[i],"Please Enter Voting Header Link "+ln+"!")==true||text_chk(objlnk[i],"Please Do not Use Special Character in Contest Header Link "+ln)==false){return false;};}return true;};
function chkrowaliasvoting(strid){
	var odiv=document.getElementById(strid),objtxt=document.getElementsByName("aliastxt[]"),ln1=objtxt.length,valtxt=Array(),vallnk=Array(),i=0,ln=0;
	for(i=0;i<ln1;i++){ln=i+1;if(null_chk(objtxt[i],"Please Enter Voting Keyword Alias "+ln+"!")==true||text_chk(objtxt[i],"Please Do not Use Special Character in Voting Keyword Alias "+ln)==false){return false;};
	}
};
function addrow(strid,grw,strtxt,strlnk){var valtxt=Array(),vallnk=Array();if(addrow.arguments.length==2  && typeof(grw)=='number'){cnt=1;rowind=grw;}else if(addrow.arguments.length==2 && grw=='up'){cnt=cnt+1;}else if(addrow.arguments.length==2 && grw=='dwn'){cnt=cnt-1;}else if(addrow.arguments.length==4){valtxt=strtxt.split('|');vallnk=strlnk.split('|');cnt=valtxt.length;}else{cnt=0;};if(cnt){var odiv = document.getElementById(strid),objtxt=document.getElementsByName("futtxt[]"),objlnk=document.getElementsByName("futlnk[]"),ln1=objtxt.length,orow="",otext="";if(!valtxt.length){for(i=0;i<ln1;i++){valtxt[i]=objtxt[i].value;vallnk[i]=objlnk[i].value;};valtxt[i]="";vallnk[i]="";};otable="<table border='0' cellspacing='0' cellpadding='0' width='748px'><tr height='1px' bgcolor='#D9D9A8'><td width='230px'></td><td width='340px'></td><td width='178px'></td></tr>";for(var j=0;j<cnt; j++){otext="";orow1 = "<tr height='16px' bgcolor='#D9D9A8'>";for(var i=1; i<4; i++) {if(i==1){otext = otext+"<td align='right' class='WorkGreen'>Footer Text&nbsp;:&nbsp;</td>";}else if(i==2){otext = otext+"<td align='left' class='WorkGreen' colspan='2'><input type='text' name ='futtxt[]' class='input' value='"+valtxt[j]+"' tabindex='"+rowind+"'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Footer Link&nbsp;:&nbsp;";}else if(i==3){otext = otext+"<input type='text' name ='futlnk[]' class='input' value='"+vallnk[j]+"' tabindex='"+rowind+"'/></td>";}};orow=orow+orow1+otext+"</tr>";orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='3'></td></tr>";};lpt=orow.substr(0,orow.lastIndexOf('</td>')).lastIndexOf('</td>');if(cnt==1){orow=orow.substr(0,lpt)+"<a href=\"javascript:void('null');\" onclick=\"addrow('futdiv','up');\" tabindex='"+rowind+"'>Add</a>"+orow.substr(lpt);}else{orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addrow('futdiv','up');\" tabindex='"+rowind+"'>Add</a>|<a href=\"javascript:void('null');\" onclick=\"addrow('futdiv','dwn');\" tabindex='"+rowind+"'>Remove</a>"+orow.substr(lpt);};orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='3'></td></tr>";odiv.innerHTML=otable+orow+"</table>";};};
function addrowalias(strid,grw,strtxt1,strlnk1){var valtxt=Array(),vallnk=Array();if(addrowalias.arguments.length==2  && typeof(grw)=='number'){cntalias=1;rowindalias=grw;}else if(addrowalias.arguments.length==2 && grw=='up'){cntalias=cntalias+1;}else if(addrowalias.arguments.length==2 && grw=='dwn'){cntalias=cntalias-1;}else if(addrowalias.arguments.length==4){valtxt=strtxt1.split('|');vallnk=strlnk1.split('|');cntalias=valtxt.length;}else{cntalias=0;};if(cntalias){var odiv = document.getElementById(strid),objtxt=document.getElementsByName("aliastxt[]"),objlnk=document.getElementsByName("futlnk1[]"),ln1=objtxt.length,orow="",otext="";if(!valtxt.length){for(i=0;i<ln1;i++){valtxt[i]=objtxt[i].value;vallnk[i]=objlnk[i].value;};valtxt[i]="";vallnk[i]="";};otable="<table border='0' cellspacing='0' cellpadding='0' width='748px'><tr height='1px' bgcolor='#D9D9A8'><td width='230px'></td><td width='265px'></td><td width='252px'></td></tr>";for(var j=0;j<cntalias; j++){otext="";orow1 = "<tr height='16px' bgcolor='#D9D9A8'>";for(var i=1; i<4; i++) {if(i==1){otext = otext+"<td align='right' class='WorkGreen'>&nbsp;</td>";}else if(i==2){otext = otext+"<td align='right' class='WorkGreen'>Keyword Alias&nbsp;:&nbsp;<input size='15' type='text' name ='aliastxt[]' class='input' value='"+valtxt[j]+"' tabindex='"+rowindalias+"'/>";}else if(i==3){otext = otext+"<input type='hidden' name ='futlnk1[]' class='input' value='"+vallnk[j]+"' tabindex='"+rowindalias+"'/></td><td>&nbsp;</td><td align='left' class='WorkGreen'>";}};orow=orow+orow1+otext+"</tr>";orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='3'></td></tr>";};lpt=orow.substr(0,orow.lastIndexOf('</td>')).lastIndexOf('</td>');if(cntalias==1){orow=orow.substr(0,lpt)+"<a href=\"javascript:void('null');\" onclick=\"addrowalias('aliasdiv','up');\" tabindex='"+rowindalias+"'>Add</a>"+orow.substr(lpt);}else{orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addrowalias('aliasdiv','up');\" tabindex='"+rowindalias+"'>Add</a>|<a href=\"javascript:void('null');\" onclick=\"addrowalias('aliasdiv','dwn');\" tabindex='"+rowindalias+"'>Remove</a>"+orow.substr(lpt);};orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='3'></td></tr>";odiv.innerHTML=otable+orow+"</table>";};};
function addaliasrow(strid,grw,strtxt){var valtxt=Array();if(addaliasrow.arguments.length==3 && typeof(grw)=='number'){rowsmsind=grw;	valtxt=strtxt.split('|');cntsms=valtxt.length;}else if(addaliasrow.arguments.length==2 && typeof(grw)=='number'){cntsms=1;}else if(addaliasrow.arguments.length==2 && grw=='up'){cntsms=cntsms+1;}else if(addaliasrow.arguments.length==2 && grw=='dwn'){cntsms=cntsms-1;}else{cntsms=0;}if(cntsms){var odiv = document.getElementById(strid);objtxt=document.getElementsByName("aliastxt[]");ln1=objtxt.length;orow="";otext="";if(!valtxt.length){for(var i=0;i<ln1;i++){valtxt[i]=objtxt[i].value;};valtxt[i]="";};otable="<table border='0' cellspacing='0' cellpadding='0' width='748px'><tr height='1px' bgcolor='#D9D9A8'><td width='393px'></td><td width='355px'></td></tr>";for(var j=0;j<cntsms; j++){otext="";orow1 = "<tr height='16px' bgcolor='#D9D9A8'>";otext = otext+"<td align='right' class='WorkGreen'>Alias Keyword&nbsp;:&nbsp;</td>";otext = otext+"<td align='left' class='WorkGreen'><input type='text' name ='aliastxt[]' value='"+valtxt[j]+"' onchange=\"validatekey(document.getElementById('shortcode'),this,'2')\" size='15' maxlength='20' tabindex='"+rowind+"'";ttobj=objtxt[j];if(typeof(ttobj)=='object' && ttobj.className=='input1'){otext = otext+" class='input1'";}else{otext = otext+" class='input'";}otext = otext+"/></td>";orow=orow+orow1+otext+"</tr>";orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='2'></td></tr>";}lpt=orow.substr(0,orow.lastIndexOf('</td>')).lastIndexOf('</td>');if(cntsms==1){orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addaliasrow('futaliasdiv','up');\" tabindex='"+rowind+"'>Add</a>"+orow.substr(lpt);}else{orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addaliasrow('futaliasdiv','up');\" tabindex='"+rowind+"'>Add</a>|<a href=\"javascript:void('null');\" onclick=\"addaliasrow('futaliasdiv','dwn');\" tabindex='"+rowind+"'>Remove</a>"+orow.substr(lpt);};orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='2'></td></tr>";odiv.innerHTML=otable+orow+"</table>";}};
function validatekey(codeobj,keyobj,chkflg){keywordobj=keyobj;if(codeobj.value==null||keyobj.value==null||codeobj.value==''||keyobj.value==''){return false;}else{var urllink = "validkey.php?shortcode="+codeobj.value+"&keyword="+keyobj.value+"&chkflag="+chkflg;loadXMLKey(urllink,keyobj);}};
function loadXMLKey(url){xmlhttp=null;if (window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}else if (window.ActiveXObject){xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}if (xmlhttp!=null){xmlhttp.onreadystatechange=state_Change_Key;xmlhttp.open('GET',url,true);xmlhttp.send(null);}else{alert("Your browser does not support XMLHTTP."); return 0;}};
function state_Change_Key(){if (xmlhttp.readyState==1){window.status="Loading...!";}else if(xmlhttp.readyState==2){window.status="Loading Completed...!";}else if (xmlhttp.readyState==4){if (xmlhttp.status==200){var pos=xmlhttp.responseText;if(pos==1){keywordobj.className='input1';}else{keywordobj.className='input';}}else{alert("Problem retrieving data:" + xmlhttp.statusText);return false;}}};
function hostip_chk(obj,msg){var txtPatrn=/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/;if(obj.value=='localhost'){return true;}else if(window.RegExp(txtPatrn) && !txtPatrn.test(obj.value)){alert(msg);obj.focus();return false;}else{return true;}};
function cbo_group_chng(ind,tid,cbotxt,sind){var i,arrtemp,temp,thisform,x,strsgrp,sgrpids,sgrpnms,sgrptxt;if(cbo_group_chng.arguments.length==4){arrtemp = cbotxt.split('|');for(i=0;i<arrtemp.length;i++){temp=Array();temp=arrtemp[i].split('@');grp_id[i]=temp[0];sgroup_cnts[i]=temp[1];}}if(ind==""||ind==null){ind=0;}i=-1;for(x=0;x<grp_id.length;x++){if(grp_id[x]==ind){i=x;}}if(i>=0){sgrptxt="";strsgrp=sgroup_cnts[i].split(':');sgrpids=strsgrp[0].split(',');sgrpnms=strsgrp[1].split(',');for(i=0;i<sgrpids.length;i++){sgrptxt=sgrptxt+"<option value=\""+sgrpids[i]+"\" ";if(sind==sgrpids[i]){sgrptxt=sgrptxt+" selected=\"selected\"";} sgrptxt=sgrptxt+">"+sgrpnms[i]+"</option>";}}else{sgrptxt="";}document.getElementById(tid).innerHTML="<select name=\"cbo_sgroup\" class=\"input\"><option value=\"\">Select Sub Group Name</option>"+sgrptxt+"</select>";};
function chkcborow(){objcbo=document.getElementsByName("tarcbo[]");objopt=document.getElementsByName("opt[]");objtxt=document.getElementsByName("tartxt[]");ln=objcbo.length;for(i=0;i<ln;i++){ln1=i+1;if(null_chk(objcbo[i],"Please Choose Target Field "+ln1+"")==true){return false;}else if(null_chk(objopt[i],"Please Choose Target Field "+ln1+" Operator")==true){return false;}else if(null_chk(objtxt[i],"Please Enter Target Field "+ln1+" Matching String")==true||text_chk(objtxt[i],"Please Do Not Filled Space In Beginnig Of Target Field "+ln1+" Matching String")==false){return false;};}return true;};
function chkrowalias(strid){ var odiv=document.getElementById(strid),objtxt=document.getElementsByName("aliastxt[]"),ln1=objtxt.length,valtxt=Array(),i=0;ln=0;for(i=0;i<ln1;i++){ln=i+1;if(null_chk(objtxt[i],"Please Enter Contest Keyword Alias "+ln+"!")==true||alpha_chk(objtxt[i],"Please Do not Use Special Character in Voting Keyword Alias "+ln+"!")==false){return false;};}return true;};
function chkrept(skey,fkey,salias,falias){if(fkey.checked && skey.className=='input1'){alert('Please Do not Use Duplicate Keyword');skey.focus();return true;};if(fkey.checked && falias.checked){var odiv=document.getElementsByName(salias),ln=0,ln1=0,msg='',fsk='';ln1=odiv.length;for(i=0;i<ln1;i++){ln=i+1;if(odiv[i].className=='input1'){if(msg!=''){msg=msg+', '+ln;}else{fsk=i;msg=ln;}};}if(msg!=''){alert('Please Do not Use Duplicate Alias Keyword in '+msg);odiv[fsk].focus();return true;}};return false;};
function file_format(obj,msg){if(obj.value.substring(obj.value.indexOf('.')+1)=='csv'){return true;}else{alert(msg);obj.focus();return false;}};
function chkcbo(){objcbo=document.getElementsByName("tarcbo[]");objopt=document.getElementsByName("opt[]");objtxt=document.getElementsByName("tartxt[]");ln1=objcbo.length;valcbo="";valopt="";valtxt="";i=0;j=0;for(i=0;i<objcbo.length;i++){for(j=0;j<objcbo[i].options.length;j++){if(objcbo[i].options[j].selected==true){if(!valcbo){valcbo=objcbo[i].options[j].value;}else{valcbo=valcbo+','+objcbo[i].options[j].value;}j=objcbo[i].options.length;}}for(j=0;j<objopt[i].options.length;j++){if(objopt[i].options[j].selected==true){if(!valopt){valopt=objopt[i].options[j].value;}else{valopt=valopt+','+objopt[i].options[j].value;}j=objopt[i].options.length;}}if(!valtxt){valtxt=objtxt[i].value;}else{valtxt=valtxt+','+objtxt[i].value;}}return valcbo+'|'+valopt+'|'+valtxt;};
function addcbo(strid,grw,strcbo){var valcbo=Array(),valtxt=Array(),p=0,orow='',otext='',odiv=document.getElementById(strid),trg_chkd,opt_chkd,txt_chkd,tmp_chkd,opt_arr=Array(">","<","=");if(addcbo.arguments.length==2 && grw=='up'){cnt=cnt+1;}else if(addcbo.arguments.length==2 && grw=='dwn'){cnt=cnt-1;}else if(addcbo.arguments.length==2 && grw!='up' && grw!='dwn'){cnt=cnt+1;cboitem=grw.split(',');}else if(addcbo.arguments.length==3){cboitem=grw.split(',');tmp_chkd=strcbo.split('|');trg_chkd=tmp_chkd[0].split(',');opt_chkd=tmp_chkd[1].split(',');txt_chkd=tmp_chkd[2].split(',');cnt=trg_chkd.length;}else{cnt=0;};if(cnt>0 && cnt<cboitem.length){if(addcbo.arguments.length!=3){tmp_chkd=chkcbo();tmp_chkd=tmp_chkd.split('|');trg_chkd=tmp_chkd[0].split(',');opt_chkd=tmp_chkd[1].split(',');txt_chkd=tmp_chkd[2].split(',');}otable="<table border='0' cellspacing='0' cellpadding='0' width='748px'><tr height='1px' bgcolor='#D9D9A8'><td width='230px'></td><td width='340px'></td><td width='178px'></td></tr>";for(var j=0;j<cnt; j++){otext="";orow1 = "<tr height='16px' bgcolor='#D9D9A8'>";for(var i=1; i<4; i++) {if(i==1){otext = otext+"<td align='right' class='WorkGreen'>Select Field&nbsp;:&nbsp;</td>";}else if(i==2){otext = otext+"<td align='left' class='WorkGreen' colspan='2'><select name='tarcbo[]' class='input'><option value=''>Select Field</option>";var tempstr="";for(p=0;p<cboitem.length;p++){tempstr=tempstr+"<option value='"+cboitem[p]+"' ";if(trg_chkd[j]==cboitem[p]){tempstr=tempstr+"selected='selected'";}tempstr=tempstr+">"+cboitem[p]+"</option>";}otext = otext+tempstr+"</select>&nbsp;&nbsp;Operator&nbsp;:&nbsp;<select class='input' name='opt[]'><option value=''>Opt</option>";tempstr='';for(p=0;p<opt_arr.length;p++){tempstr=tempstr+"<option value='"+opt_arr[p]+"' ";if(opt_chkd[j]==opt_arr[p]){tempstr=tempstr+"selected='selected'";}tempstr=tempstr+">"+opt_arr[p]+"</option>";}otext = otext+tempstr+"</select>&nbsp;&nbsp;Value&nbsp;:&nbsp;";}else if(i==3){if(txt_chkd[j]==null||txt_chkd[j]==''){txt_chkd[j]='';}otext=otext+"<input type='text' name ='tartxt[]' class='input' value='"+txt_chkd[j]+"'/></td>";}};orow=orow+orow1+otext+"</tr>";orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='3'></td></tr>";};lpt=orow.substr(0,orow.lastIndexOf('</td>')).lastIndexOf('</td>');if(cnt<cboitem.length-1){orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addcbo('cbodiv','up');\">Add</a>|<a href=\"javascript:void('null');\" onclick=\"addcbo('cbodiv','dwn');\">Remove</a>"+orow.substr(lpt);}else{orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addcbo('cbodiv','dwn');\">Remove</a>"+orow.substr(lpt);}orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='3'></td></tr>";odiv.innerHTML=otable+orow+"</table>";}else if(!cnt){odiv.innerHTML='';document.getElementById('conadddiv').style.display='inline';}};
function dbase_chk(frmname){var thisform=document.getElementById(frmname);with (thisform){if(null_chk(host_ip,'IP Address must be filled out!')==true||hostip_chk(host_ip,'Please Enter Valid Host Ip in 000.000.000.000 Format or localhost!')==false){return false;}else if(null_chk(db_name,'Database name must be filled out!')==true||text_chk(db_name,'Please Do not Use Special Character in DataBase Name!')==false){return false;}else if(null_chk(db_user,'User name must be filled out!')==true||text_chk(db_user,'Please Do not Use Special Character in User Name Except Underscore.(_)!')==false){return false;}else if(null_chk(db_pwd,'DataBase Password must be filled out!')==true||plen_chk(db_pwd,'4','18')==false){return false;}else{return true;}}};
function dbase_conn(frmname){var thisform=document.getElementById(frmname);with (thisform){if(dbase_chk(frmname)){var objdiv=document.getElementById('connect');objdiv.style.display='inline';objdiv.innerHTML="<div id='connect_div' style='display;inline'><img src='images/prog0.gif' alt='connecting'/></div>";loadXMLDB("validateDB.php?host_ip="+host_ip.value+"&db_name="+db_name.value+"&db_user="+db_user.value+"&db_pwd="+db_pwd.value+"&login="+login.value);}else{return false;}}};
function loadXMLDB(url){var objdiv=document.getElementById("connect");objdiv.style.display='inline';xmlhttp=null;if (window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}else if (window.ActiveXObject){xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}if (xmlhttp!=null){xmlhttp.onreadystatechange=state_Change_Db;xmlhttp.open('GET',url,true);xmlhttp.send(null);}else{alert("Your browser does not support XMLHTTP."); return 0;}};
function state_Change_Db(){if (xmlhttp.readyState==1){window.status="Connecting...!";}else if(xmlhttp.readyState==2){window.status="Connection Completed...!";}else if (xmlhttp.readyState==4){if (xmlhttp.status==200){var match = xmlhttp.responseText;var pos = match.indexOf('|');var objdiv=document.getElementById("connect");objdiv.innerHTML="<div style='display:none;'><img src='images/prog0.gif' alt='connecting'/></div>";if(pos<0){objdiv.innerHTML=match;document.getElementById('makeconn').style.display='none';document.getElementById('page').value='1';document.getElementById("dbsatus").value="";}else{	var temp = new Array();temp = match.split('|');objdiv.innerHTML="Connection Successfull";document.getElementById("dbsatus").value=temp[1];document.getElementById('makeconn').style.display='inline';document.getElementById('page').value='2';}}else  {alert("Problem retrieving data:" + xmlhttp.statusText);document.getElementById('page').value='1';document.getElementById('makeconn').style.display='none';return false;}}};
function fillvalue(){objcbo=document.getElementsByName("tarcbo[]");objopt=document.getElementsByName("opt[]");objtxt=document.getElementsByName("tartxt[]");ln=objcbo.length;var clause="";for(i=0;i<ln;i++){if(!clause){clause=objcbo[i].value+":"+objopt[i].value+":"+objtxt[i].value;}else{clause=clause+"|"+objcbo[i].value+":"+objopt[i].value+":"+objtxt[i].value;}}return clause;};
function target_msisdn(frmname){var thisform=document.getElementById(frmname);with (thisform){if(dbase_chk(frmname)){if(chkcborow()==true){var clause=fillvalue();}	var objdiv=document.getElementById('conn_msisdn');objdiv.style.display='inline';objdiv.innerHTML="<div id='msisdn_div' style='display;inline'><img src='images/prog0.gif' alt='connecting'/></div>";loadXMLMsisdn("target_extdb.php?login="+login.value+"&trgt_name="+trgt_name.value+"&cbo_group="+cbo_group.value+"&cbo_sgroup="+cbo_sgroup.value+"&table_fld="+table_fld.value+"&msisdn="+msisdn.value+"&dailytarget="+dailytarget.checked+"&clause="+clause+"&sess_id="+sess_id.value+"&s_date="+s_date.value+"&s_hour="+s_hour.value+"&s_minute="+s_minute.value+"&date_field="+date_field.value);}else{return false;}}};
function loadXMLMsisdn(url){var objdiv=document.getElementById("conn_msisdn");objdiv.style.display='inline';xmlhttp=null;if (window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}else if (window.ActiveXObject){xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}if (xmlhttp!=null){xmlhttp.onreadystatechange=state_Change_Msisdn;xmlhttp.open('GET',url,true);xmlhttp.send(null);}else{alert("Your browser does not support XMLHTTP."); return 0;}};
function state_Change_Msisdn(){if (xmlhttp.readyState==1){window.status="Connecting...!";}else if(xmlhttp.readyState==2){window.status="Connection Completed...!";}else if (xmlhttp.readyState==4){if (xmlhttp.status==200){var match = xmlhttp.responseText;var objdiv=document.getElementById("conn_msisdn");objdiv.innerHTML="<div style='display:none;'><img src='images/prog0.gif' alt='connecting'/></div>";objdiv.innerHTML=match;document.getElementById("target_state").value="";if(match=='Traget Successfully Created'){document.getElementById("target_state").value=match;var tempsend=document.getElementById('target_create');tempsend.action="target.php";tempsend.submit();}}else{alert("Problem retrieving data:" + xmlhttp.statusText);return false;}}};
function dnd_submit(frmname){var thisform=document.getElementById(frmname);with (thisform){if(null_chk(cbo_group,"Select Group Name!")==true){return false;}else if (null_chk(cbo_sgroup,"Select Sub Group Name!")==true){return false;}else if (null_chk(file,"Please upload a msisdn csv file!")==true || file_format(file,"Should be Upload a Msisdn file in a CSV format!")==false){return false;}else{thisform.submit();}}};
function group_submit(frmname){var thisform=document.getElementById(frmname);with (thisform){if (null_chk(grp_name,"Enter the C name!")==true||alpha_chk(grp_name,'Name should starts with an alphabet. Spaces not allowed. Underscores are acceptable')==false){return false;}else if (null_chk(grp_desc,"Enter the description of the Group!")==true||text_chk(grp_desc,'Please do not filled space in beginnig of group description')==false){return false;}else{thisform.submit();}}	};
function login_submit(frmname)
{
	var thisform=document.getElementById(frmname);
	with (thisform)
	{
		if ( null_chk(login_name,"Enter the Login Name!")==true||alpha_chk(login_name,'Name should start with an alphabet. Spaces not allowed. Underscores are acceptable')==false)
		{
			return false;
		}
		else if ( null_chk(password,'Login Password must be filled out!')==true||plen_chk(password,'6','12')==false)
		{
			return false;
		}
		else if( null_chk(company_name,"Enter the Company Name!")==true)
		{
			return false;
		}
		else
		{
			thisform.submit();
		}
	}
};
function login_submit_modify(frmname){var thisform=document.getElementById(frmname);with (thisform){if (null_chk(login_name,"Enter the Login Name!")==true||alpha_chk(login_name,'Name should start with an alphabet. Spaces not allowed. Underscores are acceptable')==false){return false;}else if(null_chk(password,'Login Password must be filled out!')==true||plen_chk(password,'6','12')==false){return false;}else{thisform.submit();}}};
function subgroup_submit(frmname){var thisform=document.getElementById(frmname);with (thisform){if (null_chk(sgrp_name,"Please enter sub group name!")==true||alpha_chk(sgrp_name,'Name should starts with an alphabet. Spaces not allowed. Underscores are acceptable')==false){return false;}else if (null_chk(sgrp_desc,"Enter the description of the Sub Group!")==true||text_chk(sgrp_desc,'Please do not filled space in beginnig of sub group description')==false){return false;}else{thisform.submit();}}	};
//function addcbo_valuemap(strid,grw,strcbo){var valcbo=Array(),valtxt=Array(),p=0,orow='',otext='',odiv=document.getElementById(strid),trg_chkd,opt_chkd,txt_chkd,tmp_chkd,opt_arr=Array(">","<","=");if(addcbo_valuemap.arguments.length==2 && grw=='up'){cnt=cnt+1;}else if(addcbo_valuemap.arguments.length==2 && grw=='dwn'){cnt=cnt-1;}else if(addcbo_valuemap.arguments.length==2 && grw!='up' && grw!='dwn'){cnt=cnt+1;cboitem=grw.split(',');}else if(addcbo_valuemap.arguments.length==3){cboitem=grw.split(',');tmp_chkd=strcbo.split('|');trg_chkd=tmp_chkd[0].split(',');opt_chkd=tmp_chkd[1].split(',');txt_chkd=tmp_chkd[2].split(',');cnt=trg_chkd.length;}else{cnt=0;};if(cnt>0 && cnt<cboitem.length){if(addcbo_valuemap.arguments.length!=3){tmp_chkd=chkcbo();tmp_chkd=tmp_chkd.split('|');trg_chkd=tmp_chkd[0].split(',');opt_chkd=tmp_chkd[1].split(',');txt_chkd=tmp_chkd[2].split(',');}otable="<table border='0' cellspacing='0' cellpadding='0' width='748px'><tr height='1px' bgcolor='#D9D9A8'><td width='230px'></td><td width='340px'></td><td width='178px'></td></tr>";for(var j=0;j<cnt; j++){otext="";orow1 = "<tr height='16px' bgcolor='#D9D9A8'>";for(var i=1; i<4; i++) {if(i==1){otext = otext+"<td align='right' class='WorkGreen'>Select Field&nbsp;:&nbsp;</td>";}else if(i==2){otext = otext+"<td align='left' class='WorkGreen' colspan='2'><select name='tarcbo[]' class='input' onchange=\"loadXMLMsisdn('ValueMapTest.php?login='+login.value+'&host_ip='+host_ip.value+'&db_user='+db_user+'&db_name='+db_name.value+'&table_fld='+table_fld.value+'&msisdn='+find_field());\"><option value=''>Select Field</option>";var tempstr="";for(p=0;p<cboitem.length;p++){tempstr=tempstr+"<option value='"+cboitem[p]+"' ";if(trg_chkd[j]==cboitem[p]){tempstr=tempstr+"selected='selected'";}tempstr=tempstr+">"+cboitem[p]+"</option>";}otext = otext+tempstr+"</select>&nbsp;&nbsp;Operator&nbsp;:&nbsp;<select class='input' name='opt[]'><option value=''>Opt</option>";tempstr='';for(p=0;p<opt_arr.length;p++){tempstr=tempstr+"<option value='"+opt_arr[p]+"' ";if(opt_chkd[j]==opt_arr[p]){tempstr=tempstr+"selected='selected'";}tempstr=tempstr+">"+opt_arr[p]+"</option>";}otext = otext+tempstr+"</select>&nbsp;&nbsp;Value&nbsp;:&nbsp;";}else if(i==3){if(txt_chkd[j]==null||txt_chkd[j]==''){txt_chkd[j]='';}otext=otext+"<input type='text' name ='tartxt[]' class='input' value='"+txt_chkd[j]+"'/></td>";}};orow=orow+orow1+otext+"</tr>";orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='3'></td></tr>";};lpt=orow.substr(0,orow.lastIndexOf('</td>')).lastIndexOf('</td>');if(cnt<cboitem.length-1){orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addcbo_valuemap('cbodiv','up');\">Add</a>|<a href=\"javascript:void('null');\" onclick=\"addcbo_valuemap('cbodiv','dwn');\">Remove</a>"+orow.substr(lpt);}else{orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addcbo_valuemap('cbodiv','dwn');\">Remove</a>"+orow.substr(lpt);}orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='3'></td></tr>";odiv.innerHTML=otable+orow+"</table>";}else if(!cnt){odiv.innerHTML='';document.getElementById('conadddiv').style.display='inline';}};





function cbosibling(indx,cboname,content){
	var txtflg=0,i=0;
		if(cbosibling.arguments.length==3){
		temp=content.split('#');
		for(i=0;i<temp.length;i++){
			temp1=temp[i].split('||');
			acbosbg[temp1[0]]=temp1[1];
		}
	}
	objtext=document.getElementById(cboname);
	if(indx==null||indx==''){indx=0;}
	
	for(i in acbosbg){
		if(i==indx) {objtext.value=acbosbg[i];txtflg=1;};
	}
	if(!txtflg){objtext.value=""};
};

function dt_cmp1(dtstr1,dtstr2,msg,obj){

	var timestamp1="",timestamp2="";
	var s_date=new Date();
	var e_date=new Date();
	var c_date=new Date();
	var s_d = s_date.getDate();
	var s_m = s_date.getMonth();
	var s_min = s_date.getMonth();
	var s_sec = s_date.getMonth();
	s_m++;
	var s_y = s_date.getYear();

	var date_arr1 = dtstr1.split ("/");
	var date_arr2 = dtstr2.split ("/");
	var fnldtstr1 = date_arr1[0]+"/"+date_arr1[1]+"/"+date_arr1[2]; 
	var fnldtstr2 = date_arr2[0]+"/"+date_arr2[1]+"/"+date_arr2[2]; 
	var fnltimstr1 = date_arr1[3]+"/"+date_arr1[4]
	var fnltimstr2 = date_arr2[3]+"/"+date_arr2[4]
		
	var curr_date = s_m+"/"+s_d+"/"+s_y;
	
	if (Date.parse(fnldtstr1)<Date.parse(curr_date)){
		alert ("Start date should be greater than current date");
		s_date.focus();
		return false;
	}

	if (Date.parse(fnldtstr1)>Date.parse(fnldtstr2)){
		alert ("Start date should be less than end date");
		//document.list_create.s_date.focus();
		return false;
	}

	if ((parseInt(date_arr1[3]))>(parseInt(date_arr2[3]))){
		alert ("Start time should be less than end time");
		return false;
	}else if (((parseInt(date_arr1[3]))==(parseInt(date_arr2[3]))) && ((parseInt(date_arr1[4]))>(parseInt(date_arr2[4])))){
		alert ("Start time should be less than end time");
		return false;
	}
};


	function dt_cmp2(dtstr1,dtstr2,msg,obj)
	{

	var timestamp1="",timestamp2="";
	var s_date=new Date();
	var e_date=new Date();
	var c_date=new Date();
	var s_d = s_date.getDate();
	var s_m = s_date.getMonth();
	var s_min = s_date.getMonth();
	var s_sec = s_date.getMonth();
	s_m++;
	var s_y = s_date.getYear();

	//alert (dtstr2);
	
	var date_arr1 = dtstr1.split ("/");
	var date_arr2 = dtstr2.split ("/");
	var fnldtstr1 = date_arr1[0]+"/"+date_arr1[1]+"/"+date_arr1[2]; 
	var fnldtstr2 = date_arr2[0]+"/"+date_arr2[1]+"/"+date_arr2[2]; 
	
	if (date_arr1[3].length == 1){
		var hs = date_arr1[3];
	}else{
		var hs = Number(date_arr1[3].substring(2));
	}
	//alert ("hs="+hs);
	
	if (date_arr1[4].length == 1){
		var ms = date_arr1[4];
	}else{
		var ms = Number(date_arr1[4].substring(2));
	}
	//alert ("ms="+ms);



	if (date_arr2[3].length == 1){
		var he = date_arr2[3];
	}else{
		var he = Number(date_arr2[3].substring(2));
	}
	if (date_arr2[4].length == 1){
		var me = date_arr2[4];
	}else{
		var me = Number(date_arr2[4].substring(2));
	}
	var fnltimstr1 = date_arr1[3]+"/"+date_arr1[4]
	var fnltimstr2 = date_arr2[3]+"/"+date_arr2[4]
	var curr_date = s_m+"/"+s_d+"/"+s_y;
	
	if (Date.parse(fnldtstr1)<Date.parse(curr_date)){
		alert ("Start date should be greater than current date");
		document.list_create.s_date.focus();
		return false;
	}

	if (Date.parse(fnldtstr1)>Date.parse(fnldtstr2)){
		alert ("Start date should be less than end date");
		document.list_create.s_date.focus();
		return false;
	}

	if ((parseInt(hs))>(parseInt(he))){
		alert ("Start time should be less than end time");
		document.list_create.s_hour.focus();
		return false;
	}else if ((parseInt(hs)==(parseInt(he))) && ((parseInt(ms))>(parseInt(me)))){
		alert ("Start time should be less than end time");
		document.list_create.s_minute.focus();
		return false;
	}
	
};

function list_submit(frmname){
   var thisform=document.getElementById(frmname);
    with (thisform){

        if (null_chk(schlr_name,"Please enter Scheduler name!")==true||alpha_chk(schlr_name,'Name should starts with an alphabet. Spaces not allowed. Underscores are acceptable')==false){
            return false;
        }else if (null_chk(target_id,"Please enter target name!")==true){
            return false;
        }else if (null_chk(s_date,"Please enter scheduler start date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Scheduler Start Date')==false){
            return false;
        }else if (null_chk(e_date,"Please enter scheduler end date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Scheduler End Date')==false){
            return false;
        }else if(null_chk(s_hour,"Please select scheduler start hour!")==true){
            return false;
        }else if (null_chk(s_minute,"Please select scheduler start minute!")==true){
            return false;
        }else if (null_chk(e_hour,"Please select scheduler end hour!")==true){
            return false;
        }else if (null_chk(e_minute,"Please select scheduler end minute!")==true){
            return false;
        }else if ((action.value==1 && dt_cmp1(s_date.value+"/"+Number(s_hour.value)+"/"+Number(s_minute.value),e_date.value+"/"+Number(e_hour.value)+"/"+Number(e_minute.value),"Scheduler Start Date Should Be Greater Than Current Date11!",s_date)==false)||dt_cmp1(s_date.value+"/"+Number(s_hour.value)+"/"+Number(s_minute.value),e_date.value+"/"+Number(e_hour.value)+"/"+Number(e_minute.value),"Scheduler End Date Should Be Greater Than Scheduler Start Date22!",e_date)==false){
            return false;
        }else if (document.forms[0].elements[0].checked==false && document.forms[0].elements[1].checked==false){
            alert("Please Choose SMS Message Type");    	
            document.forms[0].elements[0].focus;
            return false;
        }
        else if (sms_type[0].checked && null_chk(sms_msg_id,"Please select Text SMS message!")==true){
            return false;
        }else if (sms_type[1].checked && null_chk(wap_title_id,"Please Select WAP Push SMS Title!")==true){
            return false;
        }else if (msgln.value<=0 && msgln.value != ""){
            alert ("Please enter number greate than 0!");		
            document.list_create.msgln.focus();
            return false;
        }else if (null_chk(msgln,"Please enter number of messages!")==true||num_chk_list(msgln,"Please Filled Only Number(s) 0 to 9 in Number of Messages!")==false){
            return false;
        }else if (null_chk(sender_id,"Please enter Sender Id!")==true||alphanum_chk(sender_id,'Enter only alpha-numeric char. Spaces not allowed.')==false){
            return false;
        }else{
            thisform.submit();
        }
    }	
};

function target_submit(frmname){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(trgt_name,"Enter Target Name!")==true||alpha_chk(trgt_name,'Name should starts with an alphabet. Spaces not allowed. Underscores are acceptable')==false){
		    return false;
		}else if (null_chk(trgt_selctn,"Select Selection Criteria!")==true){
		    return false;
		}else if(null_chk(cbo_group,"Select Group Name!")==true){
			return false;
		}else if (null_chk(cbo_sgroup,"Select Sub Group Name!")==true){
			return false;
		}else if (trgt_selctn.value==1 && null_chk(file,"Upload A Msisdn CSV File!")==true){
			return false;
		}else if (trgt_selctn.value==1 && file_format(file,"Uploaded MSISDN file should be in a CSV format!")==false){
			return false;
		}else if(trgt_selctn.value==2 && dbase_chk(frmname)==false){
			return false;
		}else if(trgt_selctn.value==2 && page.value==3 && null_chk(table_fld,"Select Database Table Name!")==true){
			return false;
		}else if(trgt_selctn.value==2 && page.value==4 && null_chk(msisdn,"Select Msisdn Field Name!")==true){
			return false;
		}else if(trgt_selctn.value==2 && page.value==4 && chkcborow()==false){
			return false;
		}else if(page.value==1){
			thisform.action="target_update.php";
			thisform.submit();
		}else if(page.value==2||page.value==3){
			thisform.action="target.php";
			thisform.submit();
		}else if(page.value==4){
			if(dailytarget.checked){
				if(null_chk(date_field,"Select Date Field!")==true){
					return false;
				}else if(null_chk(s_hour,"Select Hour!")==true){
					return false;
				}else if(null_chk(s_minute,"Select Minute!")==true){
					return false;
				}
				
			}	
			target_msisdn(frmname);
			}
	}	
}

function contest_submit(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(contest_name,"Please Enter Content Name!")==true||alpha_chk(contest_name,'Name should starts with an alphabet. Spaces not allowed. Underscores are acceptable')==false){
			return false;
		}else if (null_chk(welcome_msg,"Please Enter Content Introduction Message!")==true||text_chk(welcome_msg,'Please Do Not Filled Space In Beginnig Of Contest Introduction Message')==false){
			return false;
		}else if (null_chk(contest_type,"Please Select Contest Type!")==true){
			return false;
		}else if (null_chk(s_date,"Please Enter Contest Start Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Contest Start Date')==false){
			return false;
		}else if(null_chk(s_hour,"Please Select Contest Start Hour!")==true){
			return false;
		}else if (null_chk(s_minute,"Please Select Contest Start Minute!")==true){
			return false;
		}else if (null_chk(e_date,"Please Enter Contest End Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Contest End Date')==false){
			return false;
		}else if (null_chk(e_hour,"Please Select Contest End Hour!")==true){
			return false;
		}else if (null_chk(e_minute,"Please Select Contest End Minute!")==true){
			return false;
		}else if ((act==1 && dt_cmp(s_date.value+"/"+Number(s_hour.value)+"/"+Number(s_minute.value),locdt.value,"Contest Start Date Should Be Greater Than Current Date!",s_date)==false)||dt_cmp(e_date.value+"/"+Number(e_hour.value)+"/"+Number(e_minute.value),s_date.value+"/"+Number(s_hour.value)+"/"+Number(s_minute.value),"Contest End Date Should Be Greater Than Contest Start Date!",e_date)==false){
			return false;
		}else if(checksmskey.checked && (null_chk(shortcode,"Please Enter Contest Short Code!")==true||num_chk(shortcode,"Please Filled Only Number(s) 0 to 9 in Contest Short Code!")==false)){
			return false;
                }else if(checksmskey.checked && (null_chk(keyword,"Please Enter Contest Keyword!")==true||alpha_chk(keyword,"Please Do not Use Special Character in Contest Keyword!")==false)){
			return false;
                }else if(checksmsalias.checked && !chkrowalias('futaliasdiv')){
			return false;
		}else if(chkrept(keyword,checksmskey,'aliastxt[]',checksmsalias)){
		        return false;
		}else if (null_chk(score,"Please Enter Contest Score Per Correct Answer!")==true||num_chk(score,"Please Filled Only Number(s) 0 to 9 in Contest Score Per Correct Answer!")==false){
			return false;
		}else if (checkscore.checked && (null_chk(negscore,"Please Enter Contest Deduction Score Per Wrong Answer!")==true||num_chk(negscore,"Please Filled Only Number(s) 0 to 9 in Contest Deduction Score per Wrong Answer!")==false)){
			return false;
		}else if (checkscore.checked && num_cmp(score,negscore,"Please Filled Contest Score Per Correct Answer Should Be Greater Than Contest Deduction Score Per Wrong Answer!")==false){
			return false;
		}else if (checkbill.checked && (null_chk(app_id,"Please Enter Contest Application Id!")==true||alphaid_chk(app_id,"Please Filled Only Character,Number Followed By Under Score in Contest Application Id!")==false)){
			return false;
		}else if (checkbill.checked && (null_chk(price_pt,"Please Enter Contest Price Point!")==true||num_chk(price_pt,"Please Filled Only Number(s) 0 to 9 in Contest Price Point!")==false)){
			return false;
		}else if(checkbill.checked && !radiochk('bill_type','Please Choose Contest Payment Mode!')){
			return false;	
		}else if(!radiochk('ques_type','Please Choose Contest Question Mode!')){
			return false;	
		}else if(radiochk('ques_type','')==1 && null_chk(quetsno,"Please Enter Contest Questions limit!")==true){
			return false;	
		}else if(radiochk('ques_type','')==1 && num_chk(quetsno,"Please Filled Only Number(s) 0 to 9 in Contest Questions limit!")==false){
			return false;	
		}else if(radiochk('ques_type','')==1 && quetsno.value<=0){
			alert("Please Filled At Least One Contest Questions limit!");quetsno.focus();return false;	
		}else if (null_chk(max_option,"Please Select Contest Max Options Per Question!")==true){
			return false;
		}else if (null_chk(fut_msg,"Please Enter Contest Footer Message!")==true||text_chk(fut_msg,'Please Do Not Filled Space In Beginnig Of Contest Footer Message')==false){
			return false;
		}else if (futchk.checked && chkrow('futdiv')==false){
			return false;
		}else if (!radiochk('futsep','Please Choose Contest Footer Seperator!')){
			return false;
		}else if (null_chk(over_msg,"Please Enter End of Contest Message!")==true||text_chk(over_msg,'Please Do Not Filled Space In Beginnig Of End of Contest Message')==false){
			return false;
		}else if (null_chk(off_msg,"Please Enter Contest Expiry Message!")==true||text_chk(over_msg,'Please Do Not Filled Space In Beginnig Of Contest Expiry Message')==false){
			return false;
		}else if(act==1 && null_chk(header,"Please Upload The Header Image Zip File!")==true){
			return false;
		}else if(act==1 && null_chk(footer,"Please Upload The Footer Image Zip File!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};

function question_submit(frmname,opt){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(question,"Please Enter Contest Question!")==true||text_chk(question,'Please Do Not Filled Space In Beginnig Of Question')==false){
			return false;
		}else if (null_chk(opt_a,"Please Enter Option A!")==true||text_chk(opt_a,'Please Do Not Filled Space In Beginnig Of Option A')==false){
			return false;
		}else if(null_chk(opt_b,"Please Enter Option B!")==true||text_chk(opt_b,'Please Do Not Filled Space In Beginnig Of Option B')==false){
			return false;
		}else if (opt=='3'&&(null_chk(opt_c,"Please Enter Option C!")==true||text_chk(opt_c,'Please Do Not Filled Space In Beginnig Of Option C')==false)){
			return false;
		}else if (opt=='4'&&(null_chk(opt_d,"Please Enter Option D!")==true||text_chk(opt_d,'Please Do Not Filled Space In Beginnig Of Option D')==false)){
			return false;
		}
		thisform.submit();
	}	
}

function import_submit(){
	var thisform=document.getElementById("import_form");
	with (thisform){
		if (null_chk(cnts_id,"Please Select The Contest Name!")==true){
			return false;
		}else if (null_chk(qstn_type,"Please Select The Question Type!")==true){
			return false;
		}else if(null_chk(file,"Please Upload CSV Question File!")==true){
			return false;
		}
		thisform.submit();
	}	
}

function contest_archive(frmname){
	var thisform=document.getElementById(frmname);
	with (thisform){
		thisform.submit();
	}
}



function bulksms_submit(frmname){
    var thisform=document.getElementById(frmname);
    with (thisform){
    	if (document.forms[0].elements[0].checked==false && document.forms[0].elements[1].checked==false){
            alert("Please Choose SMS Message Type");    	
            document.forms[0].elements[0].focus;
            return false;
//        }else if (document.forms[0].elements[0].checked && (null_chk(lang_sms,"Please Select Language Type!")==true||null_chk(sms_msg,"Please Enter Text SMS Message")==true||text_chk(sms_msg,'Please Do Not Filled Space In Beginnig Of Text SMS Message')==false)){
   }else if (document.forms[0].elements[0].checked && (null_chk(lang_sms,"Please Select Language Type!")==true||null_chk(sms_msg,"Please Enter Text SMS Message")==true)){
            return false;
        }else if (document.forms[0].elements[1].checked==true && (null_chk(wap_title,"Please Enter WAP SMS Title")==true)){
            return false;
        }else if (document.forms[0].elements[1].checked==true && (null_chk(wap_url,"Please Enter WAP SMS Url")==true||text_chk(wap_url,'Please Do Not Filled Space In Beginnig Of WAP SMS Url')==false)){
            return false;
        }else{
            thisform.submit();
        }
    }	
};



function voting_submit(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(voting_name,"Please Enter Voting Name!")==true||alpha_chk(voting_name,'Name should starts with an alphabet. Spaces not allowed. Underscores are acceptable')==false){
			return false;
		}else if (null_chk(welcome_msg,"Please Enter Voting Introduction Message!")==true||text_chk(welcome_msg,'Please Do Not Filled Space In Beginnig Of Voting Introduction Message')==false){
			return false;
		}else if (null_chk(s_date,"Please Enter Voting Start Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Voting Start Date')==false){
			return false;
		}else if(null_chk(s_hour,"Please Select Voting Start Hour!")==true){
			return false;
		}else if (null_chk(s_minute,"Please Select Voting Start Minute!")==true){
			return false;
		}else if (null_chk(e_date,"Please Enter Voting End Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Voting End Date')==false){
			return false;
		}else if (null_chk(e_hour,"Please Select Voting End Hour!")==true){
			return false;
		}else if (null_chk(e_minute,"Please Select Voting End Minute!")==true){
			return false;
		}else if ((act==1 && dt_cmp(s_date.value+"/"+Number(s_hour.value)+"/"+Number(s_minute.value),locdt.value,"Voting Start Date Should Be Greater Than Current Date!",s_date)==false)||dt_cmp(e_date.value+"/"+Number(e_hour.value)+"/"+Number(e_minute.value),s_date.value+"/"+Number(s_hour.value)+"/"+Number(s_minute.value),"Voting End Date Should Be Greater Than Voting Start Date!",e_date)==false){
			return false;
		//}else if (checkkey.checked && (null_chk(keyword,"Please Enter Voting Keyword!")==true)){
		//	alert ("sdfd");
		//	return false;
		}else if (checkkey.checked && (null_chk(shortcode,"Please Enter Voting Short Code!")==true||num_chk(shortcode,"Please Filled Only Number(s) 0 to 9 in Voting Short Code!")==false)){
			return false;
		}else if (checkkey.checked && (null_chk(keyword,"Please Enter Voting Keyword!")==true||alphaid_chk(keyword,"Please Filled Only Character,Number Followed By Under Score in Voting Keyword!")==false)){
			return false;
		}else if (alischk.checked && chkrowaliasvoting('aliasdiv')==false){
			return false;
		}else if (checkbill.checked && (null_chk(app_id,"Please Enter Voting Application Id!")==true||alphaid_chk(app_id,"Please Filled Only Character,Number Followed By Under Score in Voting Application Id!")==false)){
			return false;
		}else if (checkbill.checked && (null_chk(price_pt,"Please Enter Voting Price Point!")==true||num_chk(price_pt,"Please Filled Only Number(s) 0 to 9 in Voting Price Point!")==false)){
			return false;
		}else if (null_chk(max_option,"Please Select Voting Max Options Per Question!")==true){
			return false;
		}else if (null_chk(fut_msg,"Please Enter Voting Footer Message!")==true||text_chk(fut_msg,'Please Do Not Filled Space In Beginnig Of Voting Footer Message')==false){
			return false;
		}else if (futchk.checked && chkrowvoting('futdiv')==false){
			return false;
		}else if (!radiochk('futsep','Please Choose Voting Footer Seperator!')){
			return false;
		}else if (null_chk(over_msg,"Please Enter End of Voting Message!")==true||text_chk(over_msg,'Please Do Not Filled Space In Beginnig Of End of Voting Message')==false){
			return false;
		}else if (null_chk(off_msg,"Please Enter Voting Expiry Message!")==true||text_chk(over_msg,'Please Do Not Filled Space In Beginnig Of Voting Expiry Message')==false){
			return false;
		}else if(act==1 && null_chk(header,"Please Upload The Header Image Zip File!")==true){
			return false;
		}else if(act==1 && null_chk(footer,"Please Upload The Footer Image Zip File!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};

function voting_question_submit(frmname,opt){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(question,"Please Enter Voting Question!")==true||text_chk(question,'Please Do Not Filled Space In Beginnig Of Question')==false){
			return false;
		}else if (null_chk(opt_a,"Please Enter Option A!")==true||text_chk(opt_a,'Please Do Not Filled Space In Beginnig Of Option A')==false){
			return false;
		}else if(null_chk(opt_b,"Please Enter Option B!")==true||text_chk(opt_b,'Please Do Not Filled Space In Beginnig Of Option B')==false){
			return false;
		}else if (opt=='3'&&(null_chk(opt_c,"Please Enter Option C!")==true||text_chk(opt_c,'Please Do Not Filled Space In Beginnig Of Option C')==false)){
			return false;
		}else if (opt=='4'&&(null_chk(opt_d,"Please Enter Option D!")==true||text_chk(opt_d,'Please Do Not Filled Space In Beginnig Of Option D')==false)){
			return false;
		}
		thisform.submit();
	}	
}

function voting_archive(frmname){
	var thisform=document.getElementById(frmname);
	with (thisform){
		thisform.submit();
	}
}


function contest_cdr(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if(null_chk(cnts_id,"Please Select Contest Name!")==true){
			return false;
		}else if(null_chk(year,"Please Select Contest Year!")==true){
			return false;
		}else if (null_chk(month,"Please Select Contest Month!")==true){
			return false;
		}else if(null_chk(shortcode,"Please Select Short Code!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};

function contest_cdr1(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if(null_chk(cnts_id,"Please Select Contest Name!")==true){
			return false;
		}else if(null_chk(year,"Please Select Contest Year!")==true){
			return false;
		}else if (null_chk(month,"Please Select Contest Month!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};



function contest_datewise1(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Date for MIS!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format')==false){
			return false;
		}else if(null_chk(cnts_id,"Please Select Contest Name!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};

function contest_datewise(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Date for MIS!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format')==false){
			return false;
		}else if(null_chk(cnts_id,"Please Select Contest Name!")==true){
			return false;
		}else if(null_chk(shortcode,"Please Select Short Code!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};


function voting_datewise1(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Date for MIS!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format')==false){
			return false;
		}else if(null_chk(cnts_id,"Please Select Voting Name!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};

function voting_datewise(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Date for MIS!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format')==false){
			return false;
		}else if(null_chk(cnts_id,"Please Select Voting Name!")==true){
			return false;
		}else if(null_chk(shortcode,"Please Select Short Code!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};



function contest_topscore(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Date for MIS!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format')==false){
			return false;
		}else if(null_chk(cnts_id,"Please Select Contest Name!")==true){
			return false;
		}else if(null_chk(topusers,"Please Select Top Score!")==true){
			return false;
		}else if(null_chk(shortcode,"Please Select Short Code!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};

function contest_topscore1(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Date for MIS!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format')==false){
			return false;
		}else if(null_chk(cnts_id,"Please Select Contest Name!")==true){
			return false;
		}else if(null_chk(topusers,"Please Select Top Score!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};


function voting_topscore(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Date for MIS!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format')==false){
			return false;
		}else if(null_chk(cnts_id,"Please Select Voting Name!")==true){
			return false;
		}else if(null_chk(topusers,"Please Select Top Score!")==true){
			return false;
		}else if(null_chk(shortcode,"Please Select Short Code!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};

function voting_topscore1(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Date for MIS!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format')==false){
			return false;
		}else if(null_chk(cnts_id,"Please Select Voting Name!")==true){
			return false;
		}else if(null_chk(topusers,"Please Select Top Score!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};


function contest_msisdn(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Contest Start Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Contest Start Date')==false){
			return false;
		}else if(null_chk(s_hour,"Please Select Contest Start Hour!")==true){
			return false;
		}else if (null_chk(s_minute,"Please Select Contest Start Minute!")==true){
			return false;
		}else if (null_chk(e_date,"Please Enter Contest End Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Contest End Date')==false){
			return false;
		}else if (null_chk(e_hour,"Please Select Contest End Hour!")==true){
			return false;
		}else if (null_chk(e_minute,"Please Select Contest End Minute!")==true){
			return false;
		}else if(null_chk(cnts_id,"Please Select Contest Name!")==true){
			return false;
		}else if(null_chk(shortcode,"Please Select Short Code!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};

function contest_msisdn1(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Contest Start Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Contest Start Date')==false){
			return false;
		}else if(null_chk(s_hour,"Please Select Contest Start Hour!")==true){
			return false;
		}else if (null_chk(s_minute,"Please Select Contest Start Minute!")==true){
			return false;
		}else if (null_chk(e_date,"Please Enter Contest End Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Contest End Date')==false){
			return false;
		}else if (null_chk(e_hour,"Please Select Contest End Hour!")==true){
			return false;
		}else if (null_chk(e_minute,"Please Select Contest End Minute!")==true){
			return false;
		}else if(null_chk(cnts_id,"Please Select Contest Name!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};

function scheduler_mis(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Contest Start Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Contest Start Date')==false){
			return false;
		}else if(null_chk(s_hour,"Please Select Contest Start Hour!")==true){
			return false;
		}else if (null_chk(s_minute,"Please Select Contest Start Minute!")==true){
			return false;
		}else if (null_chk(e_date,"Please Enter Contest End Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Contest End Date')==false){
			return false;
		}else if (null_chk(e_hour,"Please Select Contest End Hour!")==true){
			return false;
		}else if (null_chk(e_minute,"Please Select Contest End Minute!")==true){
			return false;
		}else if(null_chk(sch_id,"Please Select Scheduler Name!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};


function voting_msisdn(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Voting Start Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Contest Start Date')==false){
			return false;
		}else if(null_chk(s_hour,"Please Select Voting Start Hour!")==true){
			return false;
		}else if (null_chk(s_minute,"Please Select Voting Start Minute!")==true){
			return false;
		}else if (null_chk(e_date,"Please Enter Voting End Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Voting End Date')==false){
			return false;
		}else if (null_chk(e_hour,"Please Select Voting End Hour!")==true){
			return false;
		}else if (null_chk(e_minute,"Please Select Voting End Minute!")==true){
			return false;
		}else if(null_chk(cnts_id,"Please Select Voting Name!")==true){
			return false;
		}else if(null_chk(shortcode,"Please Select Short Code!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};

function voting_msisdn1(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Voting Start Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Voting Start Date')==false){
			return false;
		}else if(null_chk(s_hour,"Please Select Voting Start Hour!")==true){
			return false;
		}else if (null_chk(s_minute,"Please Select Voting Start Minute!")==true){
			return false;
		}else if (null_chk(e_date,"Please Enter Voting End Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Voting End Date')==false){
			return false;
		}else if (null_chk(e_hour,"Please Select Voting End Hour!")==true){
			return false;
		}else if (null_chk(e_minute,"Please Select Voting End Minute!")==true){
			return false;
		}else if(null_chk(cnts_id,"Please Select Voting Name!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};

function cbo_group_chng_kword(ind,tid,cbotxt,sind){
	var i,arrtemp,temp,thisform,x,strsgrp,sgrpids,sgrpnms,sgrptxt;
	if(cbo_group_chng_kword.arguments.length==4){
		arrtemp = cbotxt.split('|');
		for(i=0;i<arrtemp.length;i++){
			temp=Array();
			temp=arrtemp[i].split('@');
			grp_id[i]=temp[0];
			sgroup_cnts[i]=temp[1];
		}
	}
	if(ind==""||ind==null){
		ind=0;
	}i=-1;
	for(x=0;x<grp_id.length;x++){
		if(grp_id[x]==ind){i=x;}
	}
	if(i>=0){
		sgrptxt="";strsgrp=sgroup_cnts[i].split(':');sgrpids=strsgrp[0].split(',');sgrpnms=strsgrp[1].split(',');
		for(i=0;i<sgrpids.length;i++){
			sgrptxt=sgrptxt+"<option value=\""+sgrpnms[i]+"\" ";
			if(sind==sgrpids[i]){
				sgrptxt=sgrptxt+" selected=\"selected\"";
			} sgrptxt=sgrptxt+">"+sgrpnms[i]+"</option>";
		}
	}else{
		sgrptxt="";
	}
	document.getElementById(tid).innerHTML="<select name=\"cbo_sgroup\" class=\"input\"><option value=\"\">Select Keyword</option>"+sgrptxt+"</select>";
};

function contest_keyword(frmname,act){
	var thisform=document.getElementById(frmname);
	with (thisform){
		if (null_chk(s_date,"Please Enter Contest Start Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Contest Start Date')==false){
			return false;
		}else if(null_chk(s_hour,"Please Select Contest Start Hour!")==true){
			return false;
		}else if (null_chk(s_minute,"Please Select Contest Start Minute!")==true){
			return false;
		}else if (null_chk(e_date,"Please Enter Contest End Date!")==true||dt_chk(s_date,'Please Filled Date Like MM/DD/YYYY Format In Contest End Date')==false){
			return false;
		}else if (null_chk(e_hour,"Please Select Contest End Hour!")==true){
			return false;
		}else if (null_chk(e_minute,"Please Select Contest End Minute!")==true){
			return false;
		}else if(null_chk(cbo_group,"Please Select Short Code!")==true){
			return false;
		}else if(null_chk(cbo_sgroup,"Please Select Keyword!")==true){
			return false;
		}else{
			thisform.submit();
		}
	}
};



function addrow_valuemap(strid,grw,strtxt,strlnk)
{
var valtxt=Array(),vallnk=Array();
if(addrow_valuemap.arguments.length==2  && typeof(grw)=='number')
{
cnt=1;rowind=grw;}
else if(addrow_valuemap.arguments.length==2 && grw=='up')
{cnt=cnt+1;}else if(addrow_valuemap.arguments.length==2 && grw=='dwn')
{cnt=cnt-1;}else if(addrow_valuemap.arguments.length==4){valtxt=strtxt.split('|');vallnk=strlnk.split('|');cnt=valtxt.length;}
else{cnt=0;};if(cnt){
var odiv = document.getElementById(strid),
objtxt=document.getElementsByName("vmaptxt[]"),
objlnk=document.getElementsByName("maplnk[]"),
ln1=objtxt.length,orow="",otext="";
if(!valtxt.length)
{for(i=0;i<ln1;i++)
{valtxt[i]=objtxt[i].value;vallnk[i]=objlnk[i].value;};valtxt[i]="";vallnk[i]="";};
otable="<table border='0' cellspacing='0' cellpadding='0' width='748px'><tr height='1px' bgcolor='#D9D9A8'><td width='230px'></td><td width='340px'></td><td width='178px'></td></tr>";
for(var j=0;j<cnt; j++){otext="";orow1 = "<tr height='16px' bgcolor='#D9D9A8'>";
for(var i=1; i<4; i++) {
if(i==1){otext = otext+"<td align='right' class='WorkGreen'>Value&nbsp;:&nbsp;</td>";}
else if(i==2){otext = otext+"<td align='left' class='WorkGreen' colspan='2'><input type='text' name ='vmaptxt[]' class='input' value='"+valtxt[j]+"' tabindex='"+rowind+"'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Map With&nbsp;:&nbsp;";}
else if(i==3){otext = otext+"<input type='text' name ='maplnk[]' class='input' value='"+vallnk[j]+"' tabindex='"+rowind+"'/></td>";}};
orow=orow+orow1+otext+"</tr>";
orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='3'></td></tr>";};
lpt=orow.substr(0,orow.lastIndexOf('</td>')).lastIndexOf('</td>');
if(cnt==1){orow=orow.substr(0,lpt)+"<a href=\"javascript:void('null');\" onclick=\"addrow_valuemap('aliasdiv','up');\" tabindex='"+rowind+"'>Add</a>"+orow.substr(lpt);}
else{orow=orow.substr(0,lpt)+"&nbsp;&nbsp;<a href=\"javascript:void('null');\" onclick=\"addrow_valuemap('aliasdiv','up');\" tabindex='"+rowind+"'>Add</a>|<a href=\"javascript:void('null');\" onclick=\"addrow_valuemap('aliasdiv','dwn');\" tabindex='"+rowind+"'>Remove</a>"+orow.substr(lpt);};
orow=orow+"<tr height='8px' bgcolor='#D9D9A8'><td colspan='3'></td></tr>";odiv.innerHTML=otable+orow+"</table>";};};

function checkSelection()
{
var boxobj = document.getElementsByName('checkcnt[]');
var boxlen = boxobj.length,cnt=0;
for(var x=0; x<boxlen; x++){if(boxobj[x].checked){cnt=cnt+1;}}
if(cnt>0){return true;}else{alert('Please select atleast one checkBox!');return false;}
}
function closeWindow() {

window.open('','_self','');

window.close();

};


