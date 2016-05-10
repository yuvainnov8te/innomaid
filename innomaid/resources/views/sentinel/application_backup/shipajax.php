<?php

/*========================================================================================

#							SunArc Technologies (P) Ltd.								

#===================================================================================== 

		@ Module    : shipajax.php																

		@ Purpose   : To group all the functions that load different ComboBoxes and result listings with the help of Ajax technology using xajax framework 

		@ Developer : Teena Goswami												  

		@ Date      : 18 October 2006 															  

#=====================================================================================# */

@include_once "../../common/db_class.php";

@include_once "../../common/nonecho_function_file.php";

@include_once "../../common/.php";



ini_set('session.cache_limiter', 'private');

$Module="shipajax.php";

/*==================================================================

@	Function Name			 :			FillSubSegCombo

@	PurPose					 :			fills subsegment combo box  according to the value of segment

Parameters

@	SubSegdiv				 :			Name of div in which the response will be assigned

@	CtrNam					 :			Name of ComboBox being filled

@	ShipWyNum				 :			Ship's shipwynum primary key of ship table to fetch subsegment at the time of edit and send it to other functions being called from it

@	PreSelectedValue		 :			Value to be selected at the loading time of the combo(default is '')

@	OnChange				 :			String used for determining which function to be called or any other job that has to be done on the on change event of combo box(default is '')

@ Calling Module			 :	 		Ship Add/Edit,ship/order search



//==================================================================*/

//==============================================================================================//

       //@changes by vasim

	   //       1.   Added making easier row viewing (changing Row color on click).

	   //       2.   Attechment field by vasim.

	   //       3.   Showing of Ships with needs to followp form status page.

	   //       4.   Showing Commercial hostory dierctly from clicking on shipyard name on table. 

	   //@Changed by Swati Vyas

	   //		5.function FillSubSegComboMultiple added by swati vyas on 1-April-2010 according to msg [29130] 

//===============================================================================================//	   

   

function FillSubSegCombo($SubSegdiv,$SegVal,$CtrNam,$ShipWyNum='',$PreSelectedValue='',$OnChange='',$OnKeyPress='',$DesignBlock=false)

{	

	$DB = new DBConnect();

	$Combo='';

	$objResponse = new xajaxResponse();

	$Module="shipajax.php";

	///$objResponse->addAlert($OnChange);

	//$OnChange='';

	/*if($ShipWyNum!='')

	{;showEEDI(this.value),

		$DesVal=$DB->FetchObject("select designwynum from ship where shipwynum='".$ShipWyNum."'");

	}*/

	

	if($OnChange=='descombo')//======================string to check whether to fill only design combo

	{	

		$OnChange='xajax_FillDesignCombo(\'descombodiv\',this.value,\'designwynum\',\'\',\'\',\'\',\'\',\''.$OnKeyPress.'\',\''.$DesignBlock.'\')';//========call function to fill design combo only.specificaly at the time of ship/order at admin site,parameter (id of the div,value of subseg,name of the control)

	//$objResponse->addAlert($OnChange);

	}

	if($OnChange=='descombosubspecfld')//===========================called from shipadd/edit to fill both design combo and load specific fields

	{



				$OnChange='showEnpOsvUpgradeRepair(this.value);showEEDI(this.value);StoreTempSubSeg(this.value),

			xajax_FillDesignCombo(\'descombodiv\',this.value,\'designwynum\',\''.$ShipWyNum.'\',\'\',\'furtherdetails\'

			,PrevSubSeg,\''.$OnKeyPress.'\',\''.$DesignBlock.'\'),xajax_ShowSpecField(\'subspeccombodiv\',this.value,\''.$ShipWyNum.'\'),

			xajax_ShowFurtherDetails(\'furtherdetailsdiv\',SizNotMandat,this.value,\'\',\''.$ShipWyNum.'\'),

			xajax_StoreSizeLimit(this.value)';

	//$objResponse->addAlert($OnChange);

/*			$OnChange='StoreTempSubSeg(this.value),

			xajax_FillDesignCombo(\'descombodiv\',this.value,\'designwynum\',\''.$ShipWyNum.'\',\'\',\'furtherdetails\'

			,PrevSubSeg,\''.$OnKeyPress.'\',\''.$DesignBlock.'\'),xajax_ShowSpecField(\'subspeccombodiv\',this.value,\''.$ShipWyNum.'\'),

			xajax_ShowFurtherDetails(\'furtherdetailsdiv\',SizNotMandat,this.value,\'\',\''.$ShipWyNum.'\'),

			xajax_StorePrevValues(FurFldOnLoad,FurValOnLoad,SpecFldOnLoad,SpecValOnLoad,CommFldOnLoad,CommValOnLoad,

			ChangedFldNam,ChangedFldVal,\'\',this.value,\''.$ShipWyNum.'\',\''.$OnKeyPress.'\'),xajax_StoreSizeLimit(this.value)';

*/			//===========functions called to reselt imo count to maintain imontn display on/off property,fill design combo and load specific fields

	}

	//$objResponse->addAlert($SegVal);

	$Qry = "select wytypid,typnam from shiptype where segnam='".$SegVal."' order by desorder desc";

	$QryRes=$DB->Select($Qry,"fetch_segnam",$Module);	

	$Combo.='<select name="'.$CtrNam.'" id="'.$CtrNam.'" onchange="'.$OnChange.'" onkeypress="'.$OnKeyPress.'" tabindex="1">';

    $Combo.='<option value="">Please select</option>';

	while($Row=@mysql_fetch_object($QryRes))

	{

		$Combo.='<option value="'.$Row->wytypid.'"';

		if($Row->wytypid==$PreSelectedValue)

			$Combo.='selected';

		$Combo.='>'.$Row->typnam.'</option>';

		

	}

	$Combo.='</select>';

	$objResponse->addAssign($SubSegdiv,'innerHTML',$Combo);

		

	return $objResponse;	 

}



/*==================================================================

@	Function Name			 :			FillDesignCombo

@	PurPose					 :			fills design combo box  according to the value of segment Parameter.

@	Desdiv 					 :			Name of div in which the response will be assigned

@	SubSegVal				 :			id of the subsegment according to which designs will be filled

@	CtrNam					 :			Name of the control	

@	ShipWyNum				 :			Ship's shipwynum primary key of ship table to fetch designwynum applied to the ship at

										the time of edit to get designs preselected values and 

										send it to other functions being called from it

@	PreSelectedValue		 :			Value to be selected at the loading time of the combo(default is '')

@	OnChange				 :			String used to determine which function to be called or any other job that has to be 

										done on the on change event of combo box(default is '')

@ Calling Module			 :	 		Ship Add/Edit,ship/order search

//==================================================================*/

function FillDesignCombo($Desdiv,$SubSegVal,$CtrNam,$ShipWyNum='',$PreSelectedValue='',$OnChange='',$TempSubSeg='',$OnKeyPress='',$Disable="false")

{	

	$DB = new DBConnect();

	$Combo='';

	$objResponse = new xajaxResponse();

///$objResponse->addalert($CtrNam);

	$Module="shipajax.php";

	if($OnChange=='furtherdetails' )//to load the further details block of ship having the values coming from design

	{

		if($SubSegVal!='')//=====just for validating whether the subseg val is coming or not to prevent from the query failure

		{

			if($ShipWyNum!='')//====================if calling from ship edit where shipwynum is present

			{

			$PreSelValues=$DB->FetchObject("select enginemak,enginemak2,enginetyp,enginetyp2 from ship where shipwynum='".$ShipWyNum."'",

			"OtherValues_Qry",$Module);

			//====================query to fetch enginemake and engintype values according to the design

			}

			//if($TempSubSeg==$SubSegVal) //new Array()

			{



					$OnChange='xajax_StorePrevValues(FurFldOnLoad,FurValOnLoad,SpecFldOnLoad,SpecValOnLoad,

					CommFldOnLoad,CommValOnLoad,ChangedFldNam,ChangedFldVal,this.value,\''.$SubSegVal.'\',\''.$ShipWyNum.'\',\''.$OnKeyPress.'\')';

			}

			

		/*	else

			{

			

				///////$OnChange='ResetImoClickCount(),xajax_ShowFurtherDetails(\'furtherdetailsdiv\'

			,\''.$SubSegVal.'\',this.value,\''.$ShipWyNum.'\'),xajax_ShowSpecField(\'subspeccombodiv\',\''.$SubSegVal.'\',

			\''.$ShipWyNum.'\',this.value),xajax_FillCommonFields(\'commonflddiv\',\''.$ShipWyNum.'\',this.value),

			xajax_FillEnginMakCombo(\'enginemakcombodiv\',\'enginemak\',this.value,\''.$PreSelValues->enginemak.'\',

			\'enginetyp\'),xajax_FillEnginTypCombo(\'enginetypcombodiv\',\'enginetyp\',\''.$PreSelValues->enginemak.'\',

			this.value,\''.$PreSelValues->enginetyp.'\'),xajax_StorePrevValues(FurFldOnLoad,FurValOnLoad,SpecFldOnLoad,

			SpecValOnLoad,CommFldOnLoad,CommValOnLoad,ChangedFldNam,ChangedFldVal,this.value,\''.$SubSegVal.'\')';/////////

			$OnChange='xajax_ShowFurtherDetails(\'furtherdetailsdiv\'

			,\''.$SubSegVal.'\',this.value,\''.$ShipWyNum.'\'),xajax_ShowSpecField(\'subspeccombodiv\',\''.$SubSegVal.'\',

			\''.$ShipWyNum.'\',this.value),xajax_StorePrevValues(FurFldOnLoad,FurValOnLoad,SpecFldOnLoad,

			SpecValOnLoad,CommFldOnLoad,CommValOnLoad,ChangedFldNam,ChangedFldVal,this.value,\''.$SubSegVal.'\')';

			}

			//======on change string contains functions to be called for resetting imo count,load specific field block,load common

			//block,engine make combo,engine type combo according to the changed designwynum*/

		}



		else

			 $OnChange='';

	}

		$ResQry=false;//================================to avoid query failures

		if($SubSegVal!='')

		{

			$ResQry = $DB->Select("select designwynum, designnam, gennam, shiptyp from shipdesign where deleted!='Y' and 

			shiptyp='".$SubSegVal."' order by gennam ","Select_StandardDesign", $Module);//========select id and name to be 

			//filled in  design combo

		}	

		$DisableCombo='';			

		if($Disable=="true")		

			$DisableCombo='disabled';

		$Combo.='<select name="'.$CtrNam.'" '.$DisableCombo.' id="'.$CtrNam.'" onkeypress="'.$OnKeyPress.'"   onchange="'.$OnChange.'" tabindex="1">';

		$Combo.='<option value="">Please select</option>';

		if($ResQry!=false)

		{

			while($Row=@mysql_fetch_object($ResQry))

			{

				$Combo.='<option value="'.$Row->designwynum.'"';

				if($Row->designwynum==$PreSelectedValue)

					$Combo.='selected';

				$Combo.='>'.$Row->gennam.'</option>';

			}

		}	

	$Combo.='</select>';//<b>'.$OnChange.'</b>';

	

	//$objResponse->addAlert($Combo); 

	

	$objResponse->addAssign($Desdiv,'innerHTML',$Combo);

				

	return $objResponse;	  

}

/*==================================================================

@	Function Name			 :			FillSYCombo

@	PurPose					 :			fills ship yard combo box  according to the value of shipbuilder

@	SYdiv 					 :			Name of div in which the response will be assigned

@	SBVal					 :			id of the shipbuilder according to which ship yard will be filled

@	CtrNam					 :			Name of the control	

@	PreSelectedValue		 :			Value to be selected at the loading time of the combo(default is '')

@	OnChange				 :			String used to determine which function to be called or any other job that has to be 

										done on the on change event of combo box(default is '')

@ Calling Module			 :	 		Ship Add/Edit,ship/order search

//==================================================================*/

function FillSYCombo($SYdiv,$SBVal,$CtrNam,$PreSelectedValue='',$OnChange='',$OnKeyPress='')

{

	$Combo='';

	$Where='';

	$Module="shipajax.php";

	$objResponse = new xajaxResponse();

    //$objResponse->addalert($CtrNam);

	$Where.="where deleted!='Y' and sbwynum='".$SBVal."' order by synam";

	if($OnChange=='faccombo')

	{	

		$OnChange='xajax_FillFaciltyCombo("faccombodiv",this.value,"fcwynum","","","'.$OnKeyPress.'")';//====function called to fill facility combo 

		//according to the shipyard

		

	}

	

	if($CtrNam == 'sywynum')

	{

	$FacComboReset=PopulateSelectAjax("fcwynum","facility","facnam","fcwynum","where deleted!='Y' and

	 sywynum='".$PreSelectedValue."' order by facnam",""," onkeypress='".$OnKeyPress."'");//function to reset the facility combo if the shipyard combo is reset

	}

	 

	$Combo=PopulateSelectAjax($CtrNam,"shipyard","synam","sywynum",$Where,$PreSelectedValue,"onchange='".$OnChange."' onkeypress='".$OnKeyPress."'");

	//=======function to fill shipyard combo

		

	if($CtrNam == 'sywynum')

		$objResponse->addAssign("faccombodiv",'innerHTML',$FacComboReset);//==========assign reset facility combo

		

	//$objResponse->addAlert('SYSYSY == '.$CtrNam.$Combo);	

	$objResponse->addAssign($SYdiv,'innerHTML',$Combo);//======================assign ship yard combo

	return $objResponse;	

}



/*==================================================================

@	Function Name			 :			FillFaciltyCombo

@	PurPose					 :			fills facility combo box  according to the value of shipyard

@	Facdiv 					 :			Name of div in which the response will be assigned

@	SYVal					 :			id of the shipyard according to which ship yard will be filled

@	CtrNam					 :			Name of the control	

@	PreSelectedValue		 :			Value to be selected at the loading time of the combo(default is '')

@	OnChange				 :			String used to determine which function to be called or any other job that has to be 

										done on the on change event of combo box(default is '')

@ Calling Module			 :	 		Ship Add/Edit

//==================================================================*/

function FillFaciltyCombo($Facdiv,$SYVal,$CtrNam,$PreSelectedValue='',$OnChange='',$OnKeyPress='')

{

	$Combo='';

	$objResponse = new xajaxResponse();  

	$Combo=PopulateSelectAjax($CtrNam,"facility","facnam","fcwynum","where deleted!='Y' and sywynum='".$SYVal."' order by facnam",$PreSelectedValue," onkeypress='".$OnKeyPress."'");

	$Module="shipajax.php";

// $objResponse->addAlert("FAcCombo".$Combo);

	$objResponse->addAssign($Facdiv,'innerHTML',$Combo);

	return $objResponse;	

}

/*==================================================================

@	Function Name			 :			FillEnginMakCombo

@	PurPose					 :			fills engine make combo box  according to the value of designwynum or preselected value

@	EnginMakCombodiv		 :			Name of div in which the response will be assigned

@	CtrNam					 :			Name of the control	

@   DesignWyNum				 :			Designwynum to get engine make value according to design

@	PreSelectedValue		 :			Value to be selected at the loading time of the combo(default is '')

@	OnChange				 :			String used to determine which function to be called or any other job that has to be 

										done on the on change event of combo box(default is '')

@ Calling Module			 :	 		Ship Add/Edit

@ Last modified on 24h feb to add second engine in to the system.Now the control name and on change are decided dynamically accor-

@ ding to the parameters passed

//==================================================================*/

function FillEnginMakCombo($EnginMakCombodiv,$CtrNam,$DesignWyNum='',$PreSelectedValue='',$OnChange='',$OnKeyPress='')

{

	$DB = new DBConnect();

	$Combo='';

	$Val='';

	$Module="shipajax.php";

	$objResponse = new xajaxResponse(); 

	//$objResponse->addAlert($PreSelectedValue);

	if($OnChange=='enginetyp')//=================string to check whether the enginetyp combo to be filled

		$OnChange='xajax_FillEnginTypCombo(\'enginetypcombodiv\',\'enginetyp\',this.value,\'\',\'\',\'\',\''.$OnKeyPress.'\'),

		storeArrOnChange(this.name,this.value,this.type),'.$OnKeyPress;

	elseif($OnChange=='enginetyp2')

		$OnChange='xajax_FillEnginTypCombo(\'enginetypcombodiv2\',\'enginetyp2\',this.value,\'\',\'\',\'\',\''.$OnKeyPress.'\'),

		storeArrOnChange(this.name,this.value,this.type),'.$OnKeyPress;

		elseif($OnChange=='enginetyp3')

		$OnChange='xajax_FillEnginTypCombo(\'enginetypcombodiv3\',\'enginetyp3\',this.value,\'\',\'\',\'\',\''.$OnKeyPress.'\'),

		storeArrOnChange(this.name,this.value,this.type),'.$OnKeyPress;

		elseif($OnChange=='enginetyp4')

		$OnChange='xajax_FillEnginTypCombo(\'enginetypcombodiv4\',\'enginetyp4\',this.value,\'\',\'\',\'\',\''.$OnKeyPress.'\'),

		storeArrOnChange(this.name,this.value,this.type),'.$OnKeyPress;

		elseif($OnChange=='enginetyp5')

		$OnChange='xajax_FillEnginTypCombo(\'enginetypcombodiv5\',\'enginetyp5\',this.value,\'\',\'\',\'\',\''.$OnKeyPress.'\'),

		storeArrOnChange(this.name,this.value,this.type),'.$OnKeyPress;

		elseif($OnChange=='enginetyp6')

		$OnChange='xajax_FillEnginTypCombo(\'enginetypcombodiv6\',\'enginetyp6\',this.value,\'\',\'\',\'\',\''.$OnKeyPress.'\'),

		storeArrOnChange(this.name,this.value,this.type),'.$OnKeyPress;

		elseif($OnChange=='enginetyp7')

		$OnChange='xajax_FillEnginTypCombo(\'enginetypcombodiv7\',\'enginetyp7\',this.value,\'\',\'\',\'\',\''.$OnKeyPress.'\'),

		storeArrOnChange(this.name,this.value,this.type),'.$OnKeyPress;

		elseif($OnChange=='enginetyp8')

		$OnChange='xajax_FillEnginTypCombo(\'enginetypcombodiv8\',\'enginetyp8\',this.value,\'\',\'\',\'\',\''.$OnKeyPress.'\'),

		storeArrOnChange(this.name,this.value,this.type),'.$OnKeyPress;

		elseif($OnChange=='enginetyp9')

		$OnChange='xajax_FillEnginTypCombo(\'enginetypcombodiv9\',\'enginetyp9\',this.value,\'\',\'\',\'\',\''.$OnKeyPress.'\'),

		storeArrOnChange(this.name,this.value,this.type),'.$OnKeyPress;

		elseif($OnChange=='enginetyp10')

		$OnChange='xajax_FillEnginTypCombo(\'enginetypcombodiv10\',\'enginetyp10\',this.value,\'\',\'\',\'\',\''.$OnKeyPress.'\'),

		storeArrOnChange(this.name,this.value,this.type),'.$OnKeyPress;

		elseif($OnChange=='enginetyp11')

		$OnChange='xajax_FillEnginTypCombo(\'enginetypcombodiv11\',\'enginetyp11\',this.value,\'\',\'\',\'\',\''.$OnKeyPress.'\'),

		storeArrOnChange(this.name,this.value,this.type),'.$OnKeyPress;

		elseif($OnChange=='enginetyp12')

		$OnChange='xajax_FillEnginTypCombo(\'enginetypcombodiv12\',\'enginetyp12\',this.value,\'\',\'\',\'\',\''.$OnKeyPress.'\'),

		storeArrOnChange(this.name,this.value,this.type),'.$OnKeyPress;

	if($PreSelectedValue!='')

		$SelectedVal=$PreSelectedValue;

	else if($DesignWyNum!='')	//===============get the engine make value according to the design

		{

		$Qry="select ".$CtrNam." from designspecific where designwynum='".$DesignWyNum."'";

		$Res=$DB->Select($Qry);

		$Val=mysql_fetch_object($Res);

		$SelectedVal=$Val->$CtrNam;

		}

	$Combo=PopulateSelectAjax($CtrNam,"enginemak","engmak","engmakid", " where deleted!='Y' order by

	engmak",$SelectedVal,"onChange=\"".$OnChange."\" onkeypress=\"".$OnKeyPress."\"");

	// $objResponse->addAlert("enginemak".$Combo);	

	$objResponse->addAssign($EnginMakCombodiv,'innerHTML',$Combo);

	return $objResponse;	

}

/*==================================================================

@	Function Name			 :			FillEnginTypCombo

@	PurPose					 :			fills engine type combo box  according to the value of designwynum or shipwyynum or

									    enginemake value

@	EngineTypComboDiv		 :			Name of div in which the response will be assigned

@	CtrNam					 :			Name of the control	

@	EngineMakVal			 :			Value of engine make according to which engine typ will be changed

@   DesignWyNum				 :			Designwynum to get engine type value according to design

@	PreSelectedValue		 :			Value to be selected at the loading time of the combo(default is '')

@	OnChange				 :			String used to determine which function to be called or any other job that has to be 

										done on the on change event of combo box(default is '')

@ Calling Module			 :	 		Ship Add/Edit

//==================================================================*/

function FillEnginTypCombo($EngineTypComboDiv,$CtrNam,$EngineMakVal='',$DesignWyNum='',$PreSelectedValue='',$OnChange='',$OnKeyPress='')

{

	$Combo='';

	$objResponse = new xajaxResponse();

	$DB = new DBConnect();

	$Module="shipajax.php";

	$Val=$PreSelectedValue;	

	//$objResponse->addAlert($OnKeyPress);

	if($EngineMakVal!='')

	{	

		$EngMVal=$EngineMakVal;//=====preexisting value

	}

	else if($DesignWyNum!='')	

		{

			

			$Row=$DB->FetchObject("select ".$CtrNam." from designspecific where designwynum='".$DesignWyNum."'",

			"select_enginemake_design",$Module);//=get engine type value according to design

			$EngMVal=$Row->$CtrNam;

			if($Val=='')//=======if the value is blank then only it will change according to design

			{

				$EnginTypRow=$DB->FetchObject("select ".$CtrNam." from designspecific where designwynum='".$DesignWyNum."'","select_engintyp_design",$Module);

				$Val=$EnginTypRow->$CtrNam;

				

			}

		

		}

	

	//$objResponse->addAlert("VAL ".$Val." Engmak ".$EngMVal);	

	//if($EngMVal!='')

	$Combo=PopulateSelectAjax($CtrNam,"enginetyp","engtyp","engtypid", " where deleted!='Y' and engmakid='".$EngMVal."'

	  order by engtyp",$Val,'OnClick="storeArrOnChange(this.name,this.value,this.type)" onkeypress="'.$OnKeyPress.'"');

		

	//$objResponse->addAlert($Combo);

	$objResponse->addAssign($EngineTypComboDiv,'innerHTML',$Combo);

	return $objResponse;	

}

/*==================================================================

@	Function Name			 :			Shiplist

@	PurPose					 :			listing of ship search result

@	Shiplistdiv		         :			Name of div in which the response will be assigned

@	SearchParam				 :			search parameters name value string pair separated by separator string

										

@	PageCounter				 :			Value of page counter for pagination

@   NewOrderDays			 :			No of days to determine whether a orderdate is in past 15 days to put the image for 'New'

@	KeySearchOpt 			 :			To determine whether the search is keywordsearch or non keywordsearch

@	OrderBy					 :			order by field name to use in order by clause for sorting purpose

@ Calling Module			 :	 		Ship/Order search

//==================================================================*/

function Shiplist($Shiplistdiv,$SearchParam,$PageCounter,$NewOrderDays,$KeySearchOpt,$OrderBy='',$ROLEID='')

{

	

		$DB=new DBConnect();

		$objResponse = new xajaxResponse(); //$objResponse->addalert("START SHIPLIST FUNCTION");

		$Module="shipajax.php";

	   // $objResponse->addAlert($SearchParam);

	    $massButtonRight=" select uj.rightid,uj.parentid ,ur.name from utjoinr uj

 							left join urightmaster ur on ur.rightid=uj.rightid where typeid='".$ROLEID."'";

	    $massButtonRightObject=$DB->Select($massButtonRight,'$massButtonRight',$Module);

	    

	    $massButton = '';

	    while($rightRows=mysql_fetch_object($massButtonRightObject))

	    {

	        if($rightRows->rightid == 96 and $rightRows->parentid == 4)

	        {

				$massButton='&nbsp; <input type=button style="width:250px" name="modifyshipnam" value="'.$rightRows->name.'" onClick="MassmodifyDeldat(\'N\')"; />';

				break;

	        }

				

	    }



	    

		$SearchStr=substr($SearchParam,15,strlen($SearchParam));//============================to remove first 15 characters that

		// is first separator string from the front of search string 

//	$objResponse->addAlert($SearchStr);

		

		$FirstArr=explode('||wy||com||wy||',$SearchStr);//===========store rest of the search string parameter separated by

		//separator string into array by breaking the string in to pieces separated by second separtor string

		//print_r($FirstArr);

		//echo is_array($FirstArr);

		//exit();

	//	$objResponse->addAlert($FirstArr); 

		if(count($FirstArr)>1)//===================if array contains more than 1 element because foreach doesn't work on single element

		//array

		{

				$NameArr=array();//=============parameter name

				$ValArr=array();//==============parameter's value

				foreach($FirstArr as $KeyF=>$ValF)

				{

					

					$NameArr[]=substr($ValF,0,strpos($ValF,'|'));//============assigning name from array element string before the first 

					

					//character of the separator string

					$ValArr[]=substr($ValF,strrpos($ValF,'|')+1,strlen($ValF));//=========assigning value from array element string

					// after the last character of the separator string

					

				}

				

				foreach($NameArr as $Key=>$Val)

				{

		//	$objResponse->addAlert($Key."   :    ".$Val."   :   ".$ValArr[$Key]);

					$_REQUEST[$Val]=$ValArr[$Key];//==================putting array name-value pair into request variables

				} //print_r($NameArr); print_r($ValArr);

		}

		else//===================array contains single element

		{

			//echo $FirstArr[0];

			$Name=substr($FirstArr[0],0,strpos($FirstArr[0],'|'));//=================extract name from 0th element of the array

			$Val=substr($FirstArr[0],strrpos($FirstArr[0],'|')+1,strlen($FirstArr[0]));	//=================extract value from 0th element of the array

			$_REQUEST[$Name]=$Val;//==============assigning value to the request variable

		}

		$responseStr='';

		//$responseStr.=$massButtonRight;

//echo $_REQUEST[$Name];

		//print_r($_REQUEST);

		//exit();

		//echo 'PC Zero'.$PageCounter=0;

		//=========================================================================================

		//This is PAGINATION HANDLING

		//=========================================================================================

		//=========================================================================================

			if($_REQUEST['hidrecnum'] == '')

				$_REQUEST['hidrecnum'] = 100;

			$PageRecords = $_REQUEST['hidrecnum']; //getOnePageNumRecords();

			################################################################################*/

//===================PAGINATION ENDS HERE======================================

//===============================================================

	if($OrderBy=='')

		$orderby='s.length desc';

	else 

		$orderby=$OrderBy;

//=============================================================

		//FATCHING TOTAL owner RECORDS FROM DATA BASE

		//NEEDED FOR PAGINATION

//=============================================================

//=============================================================

			//====================select fields from database to get capacity of a ship =======================================

			$SelectSizeField = "select distinct sizfldnam from shiptype";

			$SizeResult = $DB->Select($SelectSizeField, 'Select_Size', $Module);

			if(@mysql_num_rows($SizeResult) > 0)

			{

				$SizeFields = '';

				while($RowSize = @mysql_fetch_object($SizeResult))

					$SizeFields.= ','.$RowSize->sizfldnam;

			}

			else

				$SizeFields = '';

		//========================================================================================================================

		//==========to get delivery date for order by ==========================

			$WYDELIVERYDATESQL = GetAllDelDateToSort('s');

			

		//========================================================================================================================

	/*$FromClause = "select s.shipnam,s.imonum,s.hullnum, s.shipwynum, s.sensitiv,

					if(current_date <= date_add(s.orderdat, interval $NewOrderDays day) AND s.statuscod='O',1,0) as NewFlag , 

					s.saltyp, if(s.deldat != '', s.deldat, if(s.adjdeldat != '', s.adjdeldat, s.condeldat)) as deldat, 

					if(s.deldat != '', s.deldatflag, if(s.adjdeldat != '', s.adjdelflag, s.condelflag)) as deldatflag, s.statuscod, 

					owcou.nation, st.typnam, st.sizfldnam, st.sizunit, if(ow.ownshortnam !='', ow.ownshortnam, owcou.nation) as theowner, 

					sy.synam, shst.statusnam,".$WYDELIVERYDATESQL."".$SizeFields." 

					FROM ship as s LEFT JOIN shipspecific as sp ON s.shipwynum = sp.shipwynum LEFT JOIN shiptype as st ON s.wytypid = 

					st.wytypid LEFT JOIN owner as ow ON s.benownwynum = ow.ownwynum LEFT JOIN shipyard as sy ON sy.sywynum = s.sywynum 

					LEFT JOIN shipstatus as shst ON shst.statuscod = s.statuscod LEFT JOIN country as owcou ON s.benowncoucod = 

					owcou.coucod ";*/

			//*********************************************************************************************************************

			//ADDED BELOW CODE BY GANESH ON 06-05-06 FOR SHOWING THE RESULT OF ALL DELIVERY SHIP.

		

	/*$SisterOrder="select distinct s.shipwynum,count(s.shipwynum)-1 as ordercount,

 GROUP_CONCAT( s.shipwynum) as groupordercount, 

 s.imonum,s.adjdeldat,s.condeldat,

       s.statuscod,

                st.typnam,

                sb.sbnam,

               ow.ownnam,  

                s.capacityval,

                s.orderdat       

         FROM ship as s

           LEFT JOIN shiptype as st ON s.wytypid = st.wytypid

              LEFT JOIN owner as ow ON s.benownwynum = ow.ownwynum

              LEFT JOIN shipbuilder sb on s.sbwynum = sb.sbwynum and sb.deleted

               = 'N'

              WHERE  s.statuscod='O' and

       s.deleted='N'  and

      ((st.forsearch='Y' and st.keyranknooff='Y') or st.forsearch='N')

	 

      and  ( s.orderdat=s.orderdat

      and ow.ownnam= ow.ownnam and sb.sbnam= sb.sbnam 

and st.typnam= st.typnam and s.capacityval= s.capacityval)

 group by st.typnam, sb.sbnam, ow.ownnam ,

 s.capacityval, s.orderdat

  having ordercount>0 order by s.shipwynum";	*/	

  

/*if(($_REQUEST['statusflag']=='DatGone') || ($_REQUEST['statusflag']=='DatOfShGone') || ($_REQUEST['statusflag']=='DatGoneStale'))

{*/

 

/*$SisterOrder="select distinct s.shipwynum,count(s.shipwynum)-1 as ordercount,

 if(((

left (s.adjdeldat, 6) != '' and left (s.adjdeldat, 6) <= '201003') or (

left (s.adjdeldat, 6) = '' and

      left (s.condeldat, 6) <= '201003')),GROUP_CONCAT(s.shipwynum),'no') as groupordercount,

 

 s.imonum,s.adjdeldat,s.condeldat,

       s.statuscod,

                st.typnam,

                sb.sbnam,

               ow.ownnam,  

                s.capacityval,

                s.orderdat       

         FROM ship as s

           LEFT JOIN shiptype as st ON s.wytypid = st.wytypid

              LEFT JOIN owner as ow ON s.benownwynum = ow.ownwynum

              LEFT JOIN shipbuilder sb on s.sbwynum = sb.sbwynum and sb.deleted

               = 'N'

              WHERE  s.statuscod='O' and

       s.deleted='N'  and

      ((st.forsearch='Y' and st.keyranknooff='Y') or st.forsearch='N')

      

      and  ( s.orderdat=s.orderdat

      and ow.ownnam= ow.ownnam and sb.sbnam= sb.sbnam 

and st.typnam= st.typnam and s.capacityval= s.capacityval)

 group by st.typnam, sb.sbnam, ow.ownnam ,

 s.capacityval, s.orderdat  having groupordercount!='no' and ordercount>0  order by s.shipwynum";

 

	$Result= $DB->Select($SisterOrder, "FetchShips", $Module); 			

	while($ExRow=@mysql_fetch_object($Result))

	{

		$Stale_GroupArr[$ExRow->shipwynum]=$ExRow->groupordercount;

		$Stale_Arr[$ExRow->shipwynum]=$ExRow->ordercount;

	}			

}	



$Staleorders=("select distinct s.shipwynum FROM ship as s WHERE  s.statuscod='O' and s.deleted='N' and ((left (s.adjdeldat, 6) != '' and left (s.adjdeldat, 6) <= '201003') or (left (s.adjdeldat, 6) = '' and left (s.condeldat, 6) <= '201003'))");

$ResultStaleorders= $DB->Select($Staleorders, "FetchShips", $Module); 	

while($rowStaleorders = mysql_fetch_object($ResultStaleorders))

  {

  		 $KeyStale_Arr[$rowStaleorders->shipwynum]=$rowStaleorders->shipwynum;

  }*/

  $Stale_order=array();

  $staleyear=(date('Y')-1).date('m');

if(($_REQUEST['statusflag']=='DatGone') ||($_REQUEST['statusflag']=='DatGoneStale'))

{

$SisterOrder=" select distinct s.shipwynum,count(s.shipwynum)-1 as ordercount,

 GROUP_CONCAT( s.shipwynum) as groupordercount, 

 s.imonum,s.adjdeldat,s.condeldat,

       s.statuscod,

                st.typnam,

                sb.sbnam,

               ow.ownnam,  

                s.capacityval,

                s.orderdat       

         FROM ship as s

           LEFT JOIN shiptype as st ON s.wytypid = st.wytypid

              LEFT JOIN owner as ow ON s.benownwynum = ow.ownwynum

              LEFT JOIN shipbuilder sb on s.sbwynum = sb.sbwynum and sb.deleted

               = 'N'

              WHERE  s.statuscod='O' and

       s.deleted='N'  and

      ((st.forsearch='Y' and st.keyranknooff='Y') or st.forsearch='N')

	 

      and  ( s.orderdat=s.orderdat

      and ow.ownnam= ow.ownnam and sb.sbnam= sb.sbnam 

and st.typnam= st.typnam and s.capacityval= s.capacityval)

 group by st.typnam, sb.sbnam, ow.ownnam  ,

 s.capacityval, s.orderdat

  having ordercount>0 order by s.shipwynum";

  $Result= $DB->Select($SisterOrder, "FetchShips", $Module);

while($row1 = mysql_fetch_object($Result))

 { 	

		$stalegrouporder[$row1->shipwynum]=$row1->groupordercount;

		$staleordercount[$row1->shipwynum]=$row1->ordercount;

}



	$staleorder="select distinct s.shipwynum FROM ship as s WHERE  s.statuscod='O' and s.deleted='N' and ((left (s.adjdeldat, 6) != '' and left (s.adjdeldat, 6) <= '".$staleyear."') or (left (s.adjdeldat, 6) = '' and left (s.condeldat, 6) <= '".$staleyear."'))";

	  

 $staleorderResult= $DB->Select($staleorder, "FetchShips", $Module);	  

while($row = mysql_fetch_object($staleorderResult))

  {

  		 $Stale_order[$row->shipwynum]=$row->shipwynum;

  }

 

  $actualsisterorder=array_intersect_key($stalegrouporder,$Stale_order);

  $actualsisterordercount=array_intersect_key($staleordercount,$Stale_order);

}



else if($_REQUEST['statusflag']=='DatOfShGone')

{

$SisterOrder=" select distinct s.shipwynum,count(s.shipwynum)-1 as ordercount,

 GROUP_CONCAT( s.shipwynum) as groupordercount, 

 s.imonum,s.adjdeldat,s.condeldat,

       s.statuscod,

                st.typnam,

                sb.sbnam,

               ow.ownnam,  

                s.capacityval,

                s.orderdat       

         FROM ship as s

           LEFT JOIN shiptype as st ON s.wytypid = st.wytypid

              LEFT JOIN owner as ow ON s.benownwynum = ow.ownwynum

              LEFT JOIN shipbuilder sb on s.sbwynum = sb.sbwynum and sb.deleted

               = 'N'

              WHERE  s.statuscod='O' and

      s.deleted !='Y' and st.forsearchwoy='Y' and st.keyranknooff='N'

      and  ( s.orderdat=s.orderdat

      and ow.ownnam= ow.ownnam and sb.sbnam= sb.sbnam 

and st.typnam= st.typnam and s.capacityval= s.capacityval)

 group by st.typnam, sb.sbnam, ow.ownnam ,

 s.capacityval, s.orderdat

  having ordercount>0 order by s.shipwynum";

 // echo $SisterOrder;

  $Result= $DB->Select($SisterOrder, "FetchShips", $Module);

while($row1 = mysql_fetch_object($Result))

 { 	

		$stalegrouporder[$row1->shipwynum]=$row1->groupordercount;

		$staleordercount[$row1->shipwynum]=$row1->ordercount;

}



	$staleorder="select distinct s.shipwynum FROM ship as s WHERE  s.statuscod='O' and s.deleted='N' and ((left (s.adjdeldat, 6) != '' and left (s.adjdeldat, 6) <= '".$staleyear."') or (left (s.adjdeldat, 6) = '' and left (s.condeldat, 6) <= '".$staleyear."'))";

	  

 $staleorderResult= $DB->Select($staleorder, "FetchShips", $Module);	  

while($row = mysql_fetch_object($staleorderResult))

  {

  		 $Stale_order[$row->shipwynum]=$row->shipwynum;

  }

 

  $actualsisterorder=array_intersect_key($stalegrouporder,$Stale_order);

  $actualsisterordercount=array_intersect_key($staleordercount,$Stale_order);

}

else if($_REQUEST['statusflag']=='DatGonetc')

{

$SisterOrder=" select distinct s.shipwynum,count(s.shipwynum)-1 as ordercount,

 GROUP_CONCAT( s.shipwynum) as groupordercount, 

 s.imonum,s.adjdeldat,s.condeldat,

       s.statuscod,

                st.typnam,

                sb.sbnam,

               ow.ownnam,  

                s.capacityval,

                s.orderdat       

         FROM ship as s

           LEFT JOIN shiptype as st ON s.wytypid = st.wytypid

              LEFT JOIN owner as ow ON s.benownwynum = ow.ownwynum

              LEFT JOIN shipbuilder sb on s.sbwynum = sb.sbwynum and sb.deleted

               = 'N'

              WHERE    s.statuscod in ('MT','C') and s.showinob='Y' and

       s.deleted='N'  and

      ((st.forsearch='Y' and st.keyranknooff='Y') or st.forsearch='N')

	 

      and  ( s.orderdat=s.orderdat

      and ow.ownnam= ow.ownnam and sb.sbnam= sb.sbnam 

and st.typnam= st.typnam and s.capacityval= s.capacityval)

 group by st.typnam, sb.sbnam, ow.ownnam ,

 s.capacityval, s.orderdat

  having ordercount>0 order by s.shipwynum";

  $Result= $DB->Select($SisterOrder, "FetchShips", $Module);

while($row1 = mysql_fetch_object($Result))

 { 	

		$stalegrouporder[$row1->shipwynum]=$row1->groupordercount;

		$staleordercount[$row1->shipwynum]=$row1->ordercount;

}



	$staleorder="select distinct s.shipwynum FROM ship as s WHERE  s.statuscod in ('MT','C') and s.showinob='Y'and s.deleted='N' and ((left (s.adjdeldat, 6) != '' and left (s.adjdeldat, 6) <= '".$staleyear."') or (left (s.adjdeldat, 6) = '' and left (s.condeldat, 6) <= '".$staleyear."'))";

	  

 $staleorderResult= $DB->Select($staleorder, "FetchShips", $Module);	  

while($row = mysql_fetch_object($staleorderResult))

  {

  		 $Stale_order[$row->shipwynum]=$row->shipwynum;

  }

 $actualsisterorder=array_intersect_key($stalegrouporder,$Stale_order);

  $actualsisterordercount=array_intersect_key($staleordercount,$Stale_order);



}



			$StatusDatGoneVal='';

			

			if(($_REQUEST['statusflag']=='DatGone') || ($_REQUEST['statusflag']=='DatOfShGone') || ($_REQUEST['statusflag']=='DatGoneStale') || ($_REQUEST['statusflag']=='DatGonetc'))

			{

				

				$StatusDatGoneVal="if((s.adjdeldat!='' and s.adjdeldat is not null ),s.adjdeldat,s.condeldat) as thedeldat,

									if((s.adjdeldat!='' and s.adjdeldat is not null ),s.adjdelflag,s.condelflag) as thedelflag,";

			}

		

		if($_REQUEST['hullcountry'] !='')

		{

			$join= " LEFT JOIN shipbuilder sb on s.hulsbwynum=sb.sbwynum and sb.deleted='N' ";

		}

		else

		{

			$join=" LEFT JOIN shipbuilder sb on s.sbwynum=sb.sbwynum and sb.deleted='N' ";

		}

		

		$FromClause = "select  distinct s.shipwynum,s.hulsbwynum,s.hulsywynum,s.shipnam,s.chineseshipnam,

		s.hascontracted,DATE_FORMAT(s.orderdat,'%d-%m-%Y') as orderdat,sty.socnam,".$StatusDatGoneVal." 

		despec.designwynum,if(des.designnam!='',des.designnam,des.gennam)as desnam,s.chineseshipnam,

					s.shipnam,s.imonum,trim(s.hullnum) as hullnum, s.sensitiv,s.length,

					s.breadth,s.depth,s.showinob,s.price,s.estprice,

					if(current_date <= date_add(s.orderdat, interval $NewOrderDays day) AND s.statuscod='O',1,0) as NewFlag , 
					s.saltyp, if(s.deldat != '' && s.statuscod in('S','D','TL'), s.deldat, if(s.adjdeldat != '' && s.statuscod != 'S',
					s.adjdeldat, s.condeldat)) as deldat, sb.sbnam,
					if(s.deldat != '', s.deldatflag, if(s.adjdeldat != '', s.adjdelflag, s.condelflag)) as deldatflag, 
					s.statuscod, 
					owcou.nation, st.typnam,st.segnam, st.sizfldnam, st.sizunit, 
					if(ow.ownshortnam !='', ow.ownshortnam, owcou.nation)
					as theowner,s.bogrpid,s.grptyp,sy.synam,sy.yardstat,m.marinenam, s.conversionconfirm,s.constartdate,s.further_confirmation,
					s.conenddate,shst.statusnam,
					s.capacityval,s.converted,s.hasdummy,s.estorderdat,s.haspending, ".$WYDELIVERYDATESQL."
					FROM ship as s left join designspecific as despec on s.designwynum=despec.designwynum
					LEFT JOIN shipdesign des on s.designwynum=des.designwynum
					LEFT JOIN shipspecific as sp ON s.shipwynum = sp.shipwynum 

					 LEFT JOIN shiptype as st ON s.wytypid = st.wytypid 

					 LEFT JOIN owner as ow ON s.benownwynum = ow.ownwynum 

					 $join

					 LEFT JOIN shipyard as sy ON sy.sywynum = s.sywynum 

					 LEFT JOIN shipstatus as shst ON shst.statuscod = s.statuscod 

					 LEFT JOIN society as sty On s.socwynum=sty.socwynum



					 LEFT JOIN convertship con on s.shipwynum=con.shipwynum

					 LEFT JOIN country as owcou ON s.benowncoucod =owcou.coucod

					 left join shipformername fn on s.shipwynum=fn.shipwynum

					 LEFT JOIN marinecontractor m on s.marinewynum=m.marinewynum";

		//echo $FromClause;

			 

	/*$FromClause = "select ".$StatusDatGoneVal." despec.designwynum,if(des.designnam!='',des.designnam,des.gennam)as desnam,s.shipnam,s.imonum,trim(s.hullnum) as hullnum, s.shipwynum, s.sensitiv,s.length,s.breadth,s.depth,

					if(current_date <= date_add(s.orderdat, interval $NewOrderDays day) AND s.statuscod='O',1,0) as NewFlag , 

					s.saltyp, if(s.deldat != '', s.deldat, if(s.adjdeldat != '', s.adjdeldat, s.condeldat)) as deldat, 

					if(s.deldat != '', s.deldatflag, if(s.adjdeldat != '', s.adjdelflag, s.condelflag)) as deldatflag, s.statuscod, 

					owcou.nation, st.typnam, st.sizfldnam, st.sizunit, if(ow.ownshortnam !='', ow.ownshortnam, owcou.nation) as theowner, 

					sy.synam, shst.statusnam,s.capacityval,designships.totship, ".$WYDELIVERYDATESQL." 

					FROM ship as s left join designspecific as despec on s.designwynum=despec.designwynum LEFT JOIN shipdesign des on s.designwynum=des.designwynum left join 

					(select count(shipwynum) totship,designwynum from ship where statuscod='S' and deleted='N' group by designwynum)as designships on s.designwynum=designships.designwynum 

					LEFT JOIN shipspecific as sp 

					ON s.shipwynum = sp.shipwynum LEFT JOIN shiptype as st ON s.wytypid = 

					st.wytypid LEFT JOIN owner as ow ON s.benownwynum = ow.ownwynum LEFT JOIN shipyard as sy ON sy.sywynum = s.sywynum 

					LEFT JOIN shipstatus as shst ON shst.statuscod = s.statuscod LEFT JOIN country as owcou ON s.benowncoucod = 

					owcou.coucod ";*/

				if(date('m')>=3)

				 $year=date('Y')."03";

				 else

			  	$year=(date('Y')-1)."03";				

	if($_REQUEST['statusflag']=='DatGone')

	{

		$WhereClause = " where s.statuscod='O' and s.deleted !='Y' and((st.forsearch='Y' and st.keyranknooff='Y') or st.forsearch='N') ";

	}

	else if ($_REQUEST['statusflag']=='DatGoneStale')

	{

		$WhereClause = " where ((left (s.adjdeldat, 6) != '' and left (s.adjdeldat, 6) <= '".$staleyear."')

                or (left (s.adjdeldat, 6) = '' and left (s.condeldat, 6) <= '".$staleyear."')) 

                and s.statuscod='O' and s.deleted !='Y' 

                and((st.forsearch='Y' and st.keyranknooff='Y') or st.forsearch='N') ";

		}

		

	else if($_REQUEST['statusflag']=='DatOfShGone')

	{

		$WhereClause = " where s.deleted !='Y' and st.forsearchwoy='Y' and st.keyranknooff='N' ";

	}

	else if($_REQUEST['statusflag']=='DatGonetc')

	{

	$WhereClause = "	where   s.statuscod in ('MT','C') and s.showinob='Y' and

				 ((

				left (s.adjdeldat, 6) != '' and

					  left (s.adjdeldat, 6) <= '".$year."') or (

				left (s.adjdeldat, 6) = '' and

					  left (s.condeldat, 6) <= '".$year."'))

					  and s.deleted='N' and 

					  ((st.forsearch='Y' and st.keyranknooff='Y') or st.forsearch='N') ";

	}

	else if($_REQUEST['statusflag']=='DatGonetcoff')

	{

	$WhereClause = "	where   s.statuscod in ('MT','C') and s.showinob='Y' and

				 ((

				left (s.adjdeldat, 6) != '' and

					  left (s.adjdeldat, 6) <= '".$year."') or (

				left (s.adjdeldat, 6) = '' and

					  left (s.condeldat, 6) <= '".$year."'))

					  and s.deleted='N' and 

					  (st.forsearchwoy='Y' and st.keyranknooff='N') ";

	}

	/* changes done according to msg no. 82702 by Deepali Gupta*/

	else if($_REQUEST['statusflag']=='furtherConfirm')

	{

		$WhereClause = "  where s.further_confirmation='Y' and s.deleted='N'";

	}

	else

	{

		$WhereClause = " where s.deleted ='N'";

	}

	

//	$objResponse->addAlert($WhereClause);

	

	$Canceltoinservice="select s.shipwynum,ts.statuscod from ship as s left join latestupdate as lt on s.shipwynum=lt.shipwynum left join trackshipchange as ts on lt.changeid=ts.changeid where s.statuscod='S' and (ts.statuscod  = 'MT' or ts.statuscod  ='C' or ts.statuscod ='FC')

						and s.deleted='N'";

								

	$ResCtoinservice=$DB->Select($Canceltoinservice);

	

	$Cnt=mysql_num_rows($ResCtoinservice);



	while($RowCtoInservice=@mysql_fetch_object($ResCtoinservice))

	{

		$Cancelledtoship[$RowCtoInservice->shipwynum]=$RowCtoInservice->shipwynum; 

		$Statusbeforeship[$RowCtoInservice->shipwynum]=$RowCtoInservice->statuscod;

	}		





//$_REQUEST['searchwhere']." : ".$_REQUEST['search']." : ".$_REQUEST['searchkeyword'];

if($_REQUEST['searchwhere']=='' || (isset($_REQUEST['search'])) || (isset($_REQUEST['searchkeyword'])))

{



	//echo 'if'.$PageCounter=0;	//for first page

	//=============================basic query===============================================

	$FirstOrNextCriteria = 1;

	if($KeySearchOpt=='nonkeyword')

	{

		$SearchHeader ="";

		//========For date================

		if($_REQUEST['datetype'] == 'deldat')

		{

			/* $objResponse->addAlert("here");

			return $objResponse; */

		 //Commented by Bajrang on 16-Sep-2010 [Because there are many records in the database which have not values in ship.deldatflag field but value available in ship.deldate field ]

			//$WhereClause.= " and ".AllDeliveryDateSearch(DateToMySql($_REQUEST['datefrom']),DateToMySql($_REQUEST['dateto']),'All','s');	  

			FormSearchHeading($SearchHeader,'delivery date', $_REQUEST['datefrom'],1, $_REQUEST['dateto'] );



			    		

		//Added By Kusum Modi 12 Feb 2011  for adjustment delivery date in where clause

			$datefrom=date('Ymd',strtotime($_REQUEST['datefrom']));

			$dateto=date('Ymd',strtotime($_REQUEST['dateto']));

		    $Dto=substr($dateto,0,8);

		    $Mto=substr($dateto,0,6);

		    $Yto=substr($dateto,0,4);

		    $Dfrom=substr($datefrom,0,8);

		    $Mfrom=substr($datefrom,0,6);

		    $Yfrom=substr($datefrom,0,4);

		/*[56456] Added by Bajrang on 11-June-2012 for putting delivery date condition in where clause for 

			      Orders with adjusted delivery date and contractul delivery date.

				  Ships with only delivery date.*/

		    



				$deldateCondition =   

			   "(( if(CHAR_LENGTH(s.deldat)=8,s.deldat >= '$Dfrom',false) or

	               if(CHAR_LENGTH(s.deldat)=6,s.deldat >= '$Mfrom',false) or

	               if(CHAR_LENGTH(s.deldat)=4,s.deldat >= '$Yfrom',false)

	             )   AND

	      

	             ( if(CHAR_LENGTH(s.deldat)=8,s.deldat <= '$Dto',false) or        

	               if(CHAR_LENGTH(s.deldat)=6,s.deldat <= '$Mto',false) or

	               if(CHAR_LENGTH(s.deldat)=4,s.deldat <= '$Yto',false)                     

	             ))";

							 

				  $adjdeldateCondition = "

					((if(CHAR_LENGTH(s.adjdeldat)=8,s.adjdeldat >= '$Dfrom',false) or

	               if(CHAR_LENGTH(s.adjdeldat)=6,s.adjdeldat >= '$Mfrom',false) or

	               if(CHAR_LENGTH(s.adjdeldat)=4,s.adjdeldat >= '$Yfrom',false)

	               )   AND

	      

	              ( if(CHAR_LENGTH(s.adjdeldat)=8,s.adjdeldat <= '$Dto',false) or        

	               if(CHAR_LENGTH(s.adjdeldat)=6,s.adjdeldat <= '$Mto',false)  or

	               if(CHAR_LENGTH(s.adjdeldat)=4,s.adjdeldat <= '$Yto',false)                    

	              )) ";

				  if($_REQUEST['statuscod'] == 'O')		

				  {	 

				   $condeldatCondition = "

			    if(s.adjdeldat='',((if(CHAR_LENGTH(s.condeldat)=8,s.condeldat >= '$Dfrom',false) or

	               if(CHAR_LENGTH(s.condeldat)=6,s.condeldat >= '$Mfrom',false) or

	               if(CHAR_LENGTH(s.condeldat)=4,s.condeldat >= '$Yfrom',false)

	               )   AND



	               ( if(CHAR_LENGTH(s.condeldat)=8,s.condeldat <= '$Dto',false) or        

	               if(CHAR_LENGTH(s.condeldat)=6,s.condeldat <= '$Mto',false)  or

	               if(CHAR_LENGTH(s.condeldat)=4,s.condeldat <= '$Yto',false)                    

	              )),'') ";	

				  }

				  else

				  {			  

				  $condeldatCondition = "

			    if(s.adjdeldat='',((if(CHAR_LENGTH(s.condeldat)=8,s.condeldat >= '$Dfrom',false) or

	               if(CHAR_LENGTH(s.condeldat)=6,s.condeldat >= '$Mfrom',false) or

	               if(CHAR_LENGTH(s.condeldat)=4,s.condeldat >= '$Yfrom',false)

	               )   AND



	               ( if(CHAR_LENGTH(s.condeldat)=8,s.condeldat <= '$Dto',false) or        

	               if(CHAR_LENGTH(s.condeldat)=6,s.condeldat <= '$Mto',false)  or

	               if(CHAR_LENGTH(s.condeldat)=4,s.condeldat <= '$Yto',false)                    

	              )),'') ";				  

				}

				 //If the statustcod is in service then match only with actual delivery date. Make false other dates 

			    if($_REQUEST['statuscod'] == 'S')

			    	$adjdeldateCondition = $condeldatCondition = 'false';

			    	

				$WhereClause.=" and (

		        if(s.deldat != '', $deldateCondition,

		        if(s.adjdeldat != '' and  s.statuscod NOT in ('S','D'),$adjdeldateCondition,

		        if(s.condeldat != '' and  s.statuscod NOT in ('S','D'),$condeldatCondition,false))) 

		        )";			

				    	
			//	Commented by Aishwarya vyas
		    
		   /* $WhereClause.=" and ( 

		         $deldateCondition OR

	             $adjdeldateCondition OR

	             $condeldatCondition ) ";
								

             

			//$objResponse->addalert($adjdeldateCondition);

			/*

			$objResponse->addalert($Mfrom);

			$objResponse->addalert($Yfrom);			    

			$objResponse->addalert($Dto);

			$objResponse->addalert($Mto);

			$objResponse->addalert($Yto);*/

		

		/*	$test=AllDeliveryDateSearch(DateToMySql($_REQUEST['datefrom']),DateToMySql($_REQUEST['dateto']),'All','s');

			$objResponse->addAssign($Shiplistdiv,'innerHTML',$_REQUEST['statuscod']); 

	        return $objResponse;*/

	        

		}

		elseif($_REQUEST['datetype'] == 'condat')

		{

			if($_REQUEST['datefrom'] != '')

				$RangeDateFrom = " UNIX_TIMESTAMP('".DateToMySql($_REQUEST['datefrom'])."') ";

			if($_REQUEST['dateto'] != '')

				$RangeDateTo = " UNIX_TIMESTAMP('".DateToMySql($_REQUEST['dateto'])."') ";

				

			$WhereClause = AddMTRangeSearchCriteria($FromClause, $WhereClause, " UNIX_TIMESTAMP(con.".$_REQUEST['datetype'].") ", 

					$RangeDateFrom,$RangeDateTo, $FirstOrNextCriteria);	

			FormSearchHeading($SearchHeader,'date', $_REQUEST['datefrom'],1, $_REQUEST['dateto'] );

		

		}

		elseif($_REQUEST['datetype'] != '')

		{

			if($_REQUEST['datefrom'] != '')

				$RangeDateFrom = " UNIX_TIMESTAMP('".DateToMySql($_REQUEST['datefrom'])."') ";

			if($_REQUEST['dateto'] != '')

				$RangeDateTo = " UNIX_TIMESTAMP('".DateToMySql($_REQUEST['dateto'])."') ";

				

			$WhereClause = AddMTRangeSearchCriteria($FromClause, $WhereClause, " UNIX_TIMESTAMP(s.".$_REQUEST['datetype'].") ", 

					$RangeDateFrom,$RangeDateTo, $FirstOrNextCriteria);	

			FormSearchHeading($SearchHeader,'date', $_REQUEST['datefrom'],1, $_REQUEST['dateto'] );

		}

		//Add on 14-2-06 by ganesh

		if($_REQUEST['designlink'] =="Yes")

		{

			$WhereClause.= " and despec.designwynum !='' ";

			FormSearchHeading($SearchHeader,"design linked", $_REQUEST['designlink']);

		}

		elseif($_REQUEST['designlink'] =="No")

		{

			#Corrected by Kailash Pati to fix a bug on 09 June 2008

			#$WhereClause.= "  and despec.designwynum ='' or despec.designwynum is null";

			$WhereClause.= "  and (despec.designwynum ='' or despec.designwynum is null)";

			FormSearchHeading($SearchHeader,"design linked", $_REQUEST['designlink']);

		}

		

		//according to MsgNo:-[Chat/Alfred ]search marine contractor name add by Pooja

		if($_REQUEST['marinewynum'] !='')

		{

			$WhereClause.= " and m.marinewynum=s.marinewynum and m.marinewynum='".$_REQUEST['marinewynum']."'";

			FormSearchHeading($SearchHeader,"Marine Contractor",getMarineName($_REQUEST['marinewynum']));

		}

		//add by pooja for search hull builder accoring thier country according to MsgNo:-[31892 ]

		if($_REQUEST['hullcountry'] !='')

		{

			$WhereClause.= " and s.hulsbwynum=sb.sbwynum and sb.country='".$_REQUEST['hullcountry']."'";

			FormSearchHeading($SearchHeader,"Hull builder's country", getCountryName($_REQUEST['hullcountry']));

		}

		if($_REQUEST['hulsbwynum'] !='')

		{

			$WhereClause.= " and s.hulsbwynum='".$_REQUEST['hulsbwynum']."'";

			FormSearchHeading($SearchHeader,"Builder's [hull only]", getShipBuilder($_REQUEST['hulsbwynum']));

		}



//$objResponse->addAlert($_REQUEST['benownwynum']);

		//==============================================================================================

		$SearchOptCap=array("imonum"=>"IMO number","shipwynum"=>"WY number","hullnum"=>"Hull number","shipnam"=>"Ship name");

		//==========For search options=============

		if($_REQUEST['searchopt']=='shipnam')

		{

		

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, '(s.'.$_REQUEST['searchopt'].' REGEXP \''.addslashes(trim($_REQUEST['searchval'])).'\'' .' '.'or'.' '.'fn.'.$_REQUEST['searchopt'].' REGEXP \''.addslashes(trim($_REQUEST['searchval'])).'\''.')', $_REQUEST['searchval'], $FirstOrNextCriteria,1);	

		}

		else

		{

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, 's.'.$_REQUEST['searchopt'].' REGEXP \''.addslashes(trim($_REQUEST['searchval'])).'\'', $_REQUEST['searchval'], $FirstOrNextCriteria,1);	

		}

		FormSearchHeading($SearchHeader,$SearchOptCap[$_REQUEST['searchopt']]." like ", trim($_REQUEST['searchval']));

		//==========For segment =============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " st.segnam ", $_REQUEST['segnam'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"segment", $_REQUEST['segnam']);

		//==========For ship type=============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " st.wytypid ", $_REQUEST['wytypid'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"Sub-segment", getWyShipType($_REQUEST['wytypid']));

		//==========For standard designs=============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.designwynum ", $_REQUEST['designwynum'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"standard design ", getStDesignName($_REQUEST['designwynum']));

		//==========For shipbuilder =============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " sb.sbwynum ", $_REQUEST['sbwynum'], $FirstOrNextCriteria, 0);	

		FormSearchHeading($SearchHeader,"shipbuilder", getShipBuilder($_REQUEST['sbwynum']));

		//==========For beneficial owner =============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.benownwynum ", $_REQUEST['ownwynum'], $FirstOrNextCriteria);	

		

		FormSearchHeading($SearchHeader,"beneficial owner", getOwnerShortName($_REQUEST['ownwynum']));

		

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.legowncod ", $_REQUEST['legowner'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"legal / benificial Owner", getOwnerShortName($_REQUEST['legowner']));

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.disowncod ", $_REQUEST['disowner'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"Disponent Owner/ Long-Term Charterer", getOwnerShortName($_REQUEST['disowner']));

		if($_REQUEST['ownertyp']=='BO')

		{

				$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.benownwynum ", $_REQUEST['benownwynum'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"Beneficial owner", getOwnerShortName($_REQUEST['benownwynum']));

		}

		elseif($_REQUEST['ownertyp']=='O')

		{

			$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.bogrpid ", $_REQUEST['benownwynum'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"BO-Group", getBoGroupName($_REQUEST['benownwynum']));

		}

		elseif($_REQUEST['ownertyp']=='JV')

		{

			$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.bogrpid ", $_REQUEST['benownwynum'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"BO-JV", getBoGroupName($_REQUEST['benownwynum']));

		}



		/*if($_REQUEST['ownertyp']=='BO')

		{

			$OwnerQuery="select legowncod,benownwynum from ship where deleted='N' 

			and (legowncod='".$_REQUEST['benownwynum']."' or benownwynum ='".$_REQUEST['benownwynum']."')";

			$OwnerSelect=$DB->Select($OwnerQuery,'SelectOwnertype',$Module);

			$OwnerResult=mysql_fetch_object($OwnerSelect);

		

			//Query added by Swati Vyas on 7-Sep-2009 for fetch Owner type

		

			if(($OwnerResult->benownwynum==$_REQUEST['benownwynum']) and ($OwnerResult->legowncod==$_REQUEST['benownwynum']) )

			{

				$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, "s.benownwynum ", $_REQUEST['benownwynum'], $FirstOrNextCriteria);

				$OwnerTypeStr="Beneficial owner and Legal owner";

			}

			elseif($OwnerResult->benownwynum==$_REQUEST['benownwynum'])

			{

				$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.benownwynum ", $_REQUEST['benownwynum'], $FirstOrNextCriteria);

				$OwnerTypeStr="Beneficial owner";

			}

			elseif($OwnerResult->legowncod==$_REQUEST['benownwynum'])

			{

				$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, "s.legowncod ", $_REQUEST['benownwynum'], $FirstOrNextCriteria);

				$OwnerTypeStr="Legal owner";

			}

			else

			{

				$OwnerTypeStr="Owner";

			}

			FormSearchHeading($SearchHeader,$OwnerTypeStr, getOwnerShortName($_REQUEST['benownwynum']));

		}

		elseif($_REQUEST['ownertyp']=='O')

		{

			$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.bogrpid ", $_REQUEST['benownwynum'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"BO-Group", getBoGroupName($_REQUEST['benownwynum']));

		}

		elseif($_REQUEST['ownertyp']=='JV')

		{

			$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.bogrpid ", $_REQUEST['benownwynum'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"BO-JV", getBoGroupName($_REQUEST['benownwynum']));

		}*/



		//==========For flag=============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.flagcod ", $_REQUEST['flagcod'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"flag", GetFlagName($_REQUEST['flagcod']));

		//==========For shipbuilder's country=============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " sb.country ", $_REQUEST['country'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"Shipbuilder's country", getCountryName($_REQUEST['country']));

		

		//==========For owner's country=============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.benowncoucod ", $_REQUEST['coucod'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"nationality of beneficial owner", getNationality($_REQUEST['coucod']));

		//==========For ship status =============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.statuscod ", $_REQUEST['statuscod'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"ship status", getShipStatusName($_REQUEST['statuscod']));

		// Added by kusum according on msg no:-[56223] on 4 June 2012

			//==========For trade=============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.inttrade ", $_REQUEST['intrade'], $FirstOrNextCriteria);	

		if($_REQUEST['intrade']=='D') $trade="China Domestic only"; else if($_REQUEST['intrade']=='Y') $trade='International only ';else if($_REQUEST['intrade']=='DI') $trade='China domestic / International dual trading ';

		FormSearchHeading($SearchHeader,"trade", $trade);

		//============For Cancellation date=================//

		if($_REQUEST['statuscod']=='C')

		{

			if($_REQUEST['canceldatefrom'] != '')

				$RangeDateFrom = " UNIX_TIMESTAMP('".DateToMySql($_REQUEST['canceldatefrom'])."') ";

			if($_REQUEST['canceldateto'] != '')

				$RangeDateTo = " UNIX_TIMESTAMP('".DateToMySql($_REQUEST['canceldateto'])."') ";

				

			$WhereClause = AddMTRangeSearchCriteria($FromClause, $WhereClause, " UNIX_TIMESTAMP(s.cdate) ", 

					$RangeDateFrom,$RangeDateTo, $FirstOrNextCriteria);	

			FormSearchHeading($SearchHeader,'Cancellation date', $_REQUEST['canceldatefrom'],1, $_REQUEST['canceldateto'] );

		

		}

	/*	if($_REQUEST['statuscod']=='C' || $_REQUEST['statuscod']=='MT')

		{*/

		$OptArrVal = array("Y"=>"Remained in OrderBook","N"=>"Removed from OrderBook");

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause," s.showinob ",$_REQUEST['remaind_removed'], $FirstOrNextCriteria);	

	

	/*	if($_REQUEST['csrcomp']!='')

		$WhereClause.=" and s.wytypid in ( select wytypid from wyspecific where fldnam='csr' and enabled='Y') ";*/

		

		FormSearchHeading($SearchHeader,'', $OptArrVal[($_REQUEST['remaind_removed'])]);

/*			}*/

		//==========For shipyard =============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " sy1.sywynum ", $_REQUEST['sywynum'], $FirstOrNextCriteria, 0, " LEFT JOIN shipyard as sy1 ON sy1.sywynum = s.sywynum ");	

		FormSearchHeading($SearchHeader,'shipyard', $_REQUEST['shipyardstring']);

		//==========For sale/resale =============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.saltyp ", $_REQUEST['shipfor'], $FirstOrNextCriteria);

		$ShipFor = array('S'=>'Sale','R'=>'Resale');	

		FormSearchHeading($SearchHeader,'ship for', $ShipFor[$_REQUEST['shipfor']]);

		//==========For verify by =============

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.verifyby ", $_REQUEST['verifyby'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,"verified by", $_REQUEST['verifyby']);

		//==========For sensitive orders  =============

		

		$SensitiveArr = array('Y'=>'Yes','N'=>'No');

		if($_REQUEST['sensitive'] == 'N')

			$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.sensitiv in('N','S') ", $_REQUEST['sensitive'], $FirstOrNextCriteria,1);	

		elseif($_REQUEST['sensitive'] == 'Y')

			$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause, " s.sensitiv in('Y','C') ", $_REQUEST['sensitive'], $FirstOrNextCriteria,1);	

		FormSearchHeading($SearchHeader,"sensitive", $SensitiveArr[($_REQUEST['sensitive'])]);

		//==========For dwt =============

		if(strpos($_REQUEST['dwtfrom'],',')>0)

			$_REQUEST['dwtfrom']=str_replace(',','',$_REQUEST['dwtfrom']);

		if(strpos($_REQUEST['dwtto'],',')>0)

			$_REQUEST['dwtto']=str_replace(',','',$_REQUEST['dwtto']);			

		$WhereClause = AddMTRangeSearchCriteria($FromClause, $WhereClause, " s.dwt ", $_REQUEST['dwtfrom'], $_REQUEST['dwtto'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,'DWT', $_REQUEST['dwtfrom'],1, $_REQUEST['dwtto'] );

		//==========For gt =============

		if(strpos($_REQUEST['gtfrom'],',')>0)

			$_REQUEST['gtfrom']=str_replace(',','',$_REQUEST['gtfrom']);

		if(strpos($_REQUEST['gtto'],',')>0)

			$_REQUEST['gtto']=str_replace(',','',$_REQUEST['gtto']);

		$WhereClause = AddMTRangeSearchCriteria($FromClause, $WhereClause, " s.gt ", $_REQUEST['gtfrom'], $_REQUEST['gtto'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,'GT', $_REQUEST['gtfrom'],1, $_REQUEST['gtto'] );

		//==========For teu =============

		if(strpos($_REQUEST['teufrom'],',')>0)

			$_REQUEST['teufrom']=str_replace(',','',$_REQUEST['teufrom']);

		if(strpos($_REQUEST['teuto'],',')>0)

			$_REQUEST['teuto']=str_replace(',','',$_REQUEST['teuto']);		

		$WhereClause = AddMTRangeSearchCriteria($FromClause, $WhereClause, " sp.capteu ", $_REQUEST['teufrom'], $_REQUEST['teuto'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,'TEU', $_REQUEST['teufrom'],1, $_REQUEST['teuto'] );

		//==========For cbm =============

		// Below code added by Ganesh on 28-01-2006

		if(strpos($_REQUEST['cbmfrom'],',')>0)

			$_REQUEST['cbmfrom']=str_replace(',','',$_REQUEST['cbmfrom']);

		if(strpos($_REQUEST['cbmto'],',')>0)

			$_REQUEST['cbmto']=str_replace(',','',$_REQUEST['cbmto']);	

		$WhereClause = AddMTRangeSearchCriteria($FromClause, $WhereClause, " sp.capliquid ", $_REQUEST['cbmfrom'], $_REQUEST['cbmto'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,'CBM', $_REQUEST['cbmfrom'],1, $_REQUEST['cbmto'] );

		//==========For length =============



		if(strpos($_REQUEST['lengthfrom'],',')>0)

			$_REQUEST['lengthfrom']=str_replace(',','',$_REQUEST['lengthfrom']);

		if(strpos($_REQUEST['lengthto'],',')>0)

			$_REQUEST['lengthto']=str_replace(',','',$_REQUEST['lengthto']);	

		$WhereClause = AddMTRangeSearchCriteria($FromClause, $WhereClause, " s.length ", $_REQUEST['lengthfrom'], $_REQUEST['lengthto'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,'Length', $_REQUEST['lengthfrom'],1, $_REQUEST['lengthto'] );

		//==========For breadth =============

		if(strpos($_REQUEST['breadthfrom'],',')>0)

			$_REQUEST['breadthfrom']=str_replace(',','',$_REQUEST['breadthfrom']);

		if(strpos($_REQUEST['breadthto'],',')>0)

			$_REQUEST['breadthto']=str_replace(',','',$_REQUEST['breadthto']);			

		$WhereClause = AddMTRangeSearchCriteria($FromClause, $WhereClause, " s.breadth ", $_REQUEST['breadthfrom'], $_REQUEST['breadthto'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,'Breadth', $_REQUEST['breadthfrom'],1, $_REQUEST['breadthto'] );

		//==========For depth =============

		if(strpos($_REQUEST['depthfrom'],',')>0)

			$_REQUEST['depthfrom']=str_replace(',','',$_REQUEST['depthfrom']);

		if(strpos($_REQUEST['depthto'],',')>0)

			$_REQUEST['depthto']=str_replace(',','',$_REQUEST['depthto']);	

		$WhereClause = AddMTRangeSearchCriteria($FromClause, $WhereClause, " s.depth ", $_REQUEST['depthfrom'], $_REQUEST['depthto'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,'Depth', $_REQUEST['depthfrom'],1, $_REQUEST['depthto'] );

		//==========For BHP =============

		if(strpos($_REQUEST['bhpfrom'],',')>0)

			$_REQUEST['bhpfrom']=str_replace(',','',$_REQUEST['bhpfrom']);

		if(strpos($_REQUEST['bhpto'],',')>0)

			$_REQUEST['bhpto']=str_replace(',','',$_REQUEST['bhpto']);	

		$WhereClause = AddMTRangeSearchCriteria($FromClause, $WhereClause, " sp.bhp ", $_REQUEST['bhpfrom'], $_REQUEST['bhpto'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,'BHP', $_REQUEST['bhpfrom'],1, $_REQUEST['bhpto'] );

		///====================for no of cars (Added by Kusum according to msg no:[62639])================================================================

		if(strpos($_REQUEST['numcarfrom'],',')>0)

			$_REQUEST['numcarfrom']=str_replace(',','',$_REQUEST['numcarfrom']);

		if(strpos($_REQUEST['numcarto'],',')>0)

			$_REQUEST['numcarto']=str_replace(',','',$_REQUEST['numcarto']);		

		$WhereClause = AddMTRangeSearchCriteria($FromClause, $WhereClause, " sp.numcar ", $_REQUEST['numcarfrom'], $_REQUEST['numcarto'], $FirstOrNextCriteria);	

		FormSearchHeading($SearchHeader,'No of Cars', $_REQUEST['numcarfrom'],1, $_REQUEST['numcarto'] );



		

		//*****************************************************************************

		//============for CSR Compliant===========//

		$OptArrVal = array("Y"=>"Yes","N"=>"No");

		$WhereClause = AddMTSearchCriteria($FromClause, $WhereClause," sp.csr ",$_REQUEST['csrcomp'], $FirstOrNextCriteria);	

		if($_REQUEST['csrcomp']!='')

		$WhereClause.=" and s.wytypid in ( select wytypid from wyspecific where fldnam='csr' and enabled='Y') ";

		

		FormSearchHeading($SearchHeader,'CSR Compliant', $OptArrVal[($_REQUEST['csrcomp'])]);



		//=======================================

		//============for CSR Compliant===========//

		

		

		//=======================================		

		

		if($SearchHeader != '')

			$SearchHeader = " for ".$SearchHeader;

			

	}

	elseif($KeySearchOpt=='keyword')	//========for keyword search==============

	{



		$SearchHeader="";

		//==========For keyword=============

		//Added by ganesh on 07-03-06 for owner name search by keyword

		//' REGEXP \''.addslashes(trim($_REQUEST['searchval'])).'\''

		//$objResponse->addAlert($_REQUEST['ownersearch']);

		if($_REQUEST['keyword']!='' && $_REQUEST['ownersearch'] != '')

		{

			$KeyWord = trim($_REQUEST['keyword']);

			$OwnerNam=addslashes(trim($_REQUEST['ownersearch']));

			$WhereClause.= " and (s.shipnam REGEXP \"['".$KeyWord."']\" or 

			s.hisnam  REGEXP \"['".$KeyWord."']\" or fn.shipnam REGEXP \"['".$KeyWord."']\") 

			  and (ow.ownshortnam REGEXP \"['".$OwnerNam."']+\" or

			 owcou.nation REGEXP \"['".$OwnerNam."']+\")";

			FormSearchHeading($SearchHeader,"under owner keyword", $OwnerNam);

		}

		else if($_REQUEST['ownersearch'] != '')

		{

			$OwnerNam=addslashes(trim($_REQUEST['ownersearch']));

			$WhereClause.= " and (ow.ownshortnam like '%$OwnerNam%' or owcou.nation like '$OwnerNam%') ";

			FormSearchHeading($SearchHeader,"under owner keyword", $OwnerNam);

		}

		else if($_REQUEST['keyword']!='')

		{

			$KeyWord = trim($_REQUEST['keyword']);

			$OwnerNam=trim($_REQUEST['ownersearch']);

			/*$WhereClause.= " and (s.shipnam REGEXP \"['".$KeyWord."']\" or  s.wycom REGEXP \"['".$KeyWord."']\" or s.hisnam REGEXP \"['".$KeyWord."']\"

			or fn.shipnam REGEXP \"['".$KeyWord."']\")";*/

			$WhereClause.= " and (s.shipnam REGEXP \"['".$KeyWord."']\" or s.hisnam  REGEXP \"['".$KeyWord."']\"

			 or fn.shipnam REGEXP \"['".$KeyWord."']\")";

			FormSearchHeading($SearchHeader,"keyword", $KeyWord);

		}

	}

		$SearchWhere = $FromClause.$WhereClause;

	//echo $FromClause;

/*       $objResponse->addAssign($Shiplistdiv,'innerHTML',$SearchWhere." order by $orderby");

	   return $objResponse;   
		
*/}

else

{

	$SearchWhere = urldecode($_REQUEST['searchwhere']);

	 $SearchHeader = urldecode($_REQUEST['searchheader']);

} 

  /* $objResponse->addAssign($Shiplistdiv,'innerHTML',$SearchWhere); return $objResponse; exit; */ //blc

//=======================================================================================================================

	// this block executes when clicked on UPCOMING IN NEXT 30 DAYS in Status page (FOR : going to delivery orders in 30 days)

		if($_REQUEST['statusflag']!='' and $_REQUEST['statusflag']!='ST_Need')

		{	

		

			

			$FromClause = $FromClause.$WhereClause;

		//$objResponse->addAssign($Shiplistdiv,'innerHTML',$FromClause." order by $orderby");

			//return $objResponse;

			@include_once "statpageorder.php"; // this page is included when the request comes from status page

			/*$objResponse->addAssign($Shiplistdiv,'innerHTML',$FromClause);

			return $objResponse;*/

			$SearchWhere = $FromClause;

	        

		}	

	//=======================================================================================================================

	//=======================================================================================================================	

 

	$HavinClause="";

	if($_REQUEST['statusflag']=='ST_Need' or $_REQUEST['hasdummy']=='Y' )

	{

		$HavinClause=" having hasdummy='Y'";
		FormSearchHeading($SearchHeader,"Needs follow up",$OptArrVal[$_REQUEST['hasdummy']]);	

	}	

	elseif($_REQUEST['hasdummy']=='N')

	{

		$HavinClause=" having hasdummy='N'";	
		FormSearchHeading($SearchHeader,"Needs follow up",$OptArrVal[$_REQUEST['hasdummy']]);	

	

	}	

	if($_REQUEST['statusflag']=='ST_Pending' )

	{

		$HavinClause=" having s.haspending='Y'";
		FormSearchHeading($SearchHeader,"with Pending Status",$OptArrVal[$_REQUEST['haspending']]);	

	}	

	$SearchWhere.=$HavinClause;

	if($_REQUEST['SearchHeader'] !="" &&  $SearchHeader == "" )

		$SearchHeader= urldecode($_REQUEST['SearchHeader']);

		//$objResponse->addAlert($SearchWhere." order by $orderby");

		//$objResponse->addAssign($Shiplistdiv,'innerHTML',$SearchWhere." order by $orderby");

		//return $objResponse;

		if($_REQUEST['statusflag']=='ST_Need' )

		{

		$orderby=segnam;

	    $SearchHeader.="Needs to Follow Up";

		}

		if($_REQUEST['statusflag']=='ST_Pending' )

		{

		$orderby=segnam;

	    $SearchHeader.="for Keep In View";

		//$SearchHeader.="with Pending Status";

		}

		//echo $SearchWhere;

		$ResultObj=$DB->Select($SearchWhere." order by $orderby",'select_ship',$Module);	

		

/*			$objResponse->addAssign($Shiplistdiv,'innerHTML',$SearchWhere." order by $orderby");

	return $objResponse;*/

	    $TotalCount = @mysql_num_rows($ResultObj);

		

		//echo $SearchWhere;exit;		

//=============================================================

	//FETCHING countrymap RECORDS FROM DATA BASE FOR CURRENT PAGE ONLY

//=============================================================

//=============================================================

	$RecordsFrom = $PageRecords * $PageCounter;



	$Queryforxl=$SearchWhere." order by $orderby";

	//GetPaginationData(&$RecordsFrom,&$PageRecords,$PageCounter);

	 $SelectCurrentShip = $SearchWhere." order by $orderby LIMIT $RecordsFrom,$PageRecords";

	     				

			//$objResponse->addalert($SelectCurrentShip);

			//  $objResponse->addAssign($Shiplistdiv,'innerHTML',$SelectCurrentShip); return $objResponse; exit;  //blc

			//$objResponse->addAlert($SelectCurrentShip);

	//$objResponse->addAssign($Shiplistdiv,'innerHTML',$SearchWhere." order by $orderby");

	//return $objResponse;	

	//echo $SelectCurrentShip;

	

	//#############################################################################################################

	//###########...... Edited by Anita..use same recordset in place of fetching a new one...for optimization........

	//#############################################################################################################

				//echo $PageRecords;

				$CountStartFrom = $PageCounter * $PageRecords;

				if(($TotalCount - ($PageCounter * $PageRecords)) > $PageRecords)

					$CurrentCount = $PageRecords;

				else

					$CurrentCount = $TotalCount - ($PageCounter * $PageRecords);

				if(! @mysql_data_seek($CurrentObj,$CountStartFrom) && $TotalCount > 0)

				{	

					$CurrentObj=$DB->Select($SelectCurrentShip,'select_currentship',$Module);	

					//$CurrentObj=$DB->Select($SelectCurrentShip,'select_currentship',$Module);	

					$CurrentCount = @mysql_num_rows($CurrentObj);

					

				}	

	//#############################################################################################################

	/*$CurrentObj=$DB->Select($SelectCurrentShip,'select_currentship',$Module);	

	$CurrentCount = @mysql_num_rows($CurrentObj);



	$CountStartFrom = $PageCounter 	* $PageRecords;*/



	//Query echo here.			

   //$responseStr.=$SearchWhere;

				

	if($TotalCount >= $RecordsFrom + $PageRecords)

		$CountUpTo = $PageCounter * $PageRecords + $PageRecords;

	else

		if(!($TotalCount < $RecordsFrom))

			$CountUpTo = $PageCounter * $PageRecords + ($TotalCount - $PageCounter * $PageRecords);

			

	$total = $CountUpTo - $CountStartFrom;



//=============================result display starts here=====================================//



if($_REQUEST['searchwhere']=='' || (isset($_REQUEST['search'])) || (isset($_REQUEST['searchkeyword'])))

{

$responseStr.='<table width="95%" align="center" cellpadding="0" cellspacing="0" style="border:white 1px solid" >';

if($TotalCount >0)

{

    //$responseStr.=$SelectCurrentShip;

	$responseStr.='<tr>

 

		<td width="30%" height="20"><font color="#A8211E">&nbsp;[&nbsp;<img src="../../member/img/new_or.gif" align="absmiddle"  alt="New Order"> 

		  ] &nbsp;New Order (Ordered with in last 15 days)</font></td>

		<td width="50%"><font color="#A8211E">&nbsp;[&nbsp;<img src="../../member/img/sen.gif"  align="absmiddle"  alt="Sensitive Order"> 

		  ] &nbsp;Sensitive Order</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#A8211E">&nbsp;[&nbsp;<img src="../../member/img/jvorder.gif"  align="absmiddle"  alt="Joint Venture"> 

		  ] &nbsp;Joint Venture</font></td>

		<td height="20">&nbsp;</td>

	  </tr>';

  

  }

 

  $responseStr.='<tr> 

    <td colspan="2">&nbsp;'; 

    

	// this block executes when clicked on UPCOMING IN NEXT 30 DAYS in Status page (FOR : going to delivery orders in 30 days)

/*		if($_REQUEST['statusflag']!='' )

		{

		    if($_REQUEST['statusflag']!='ST_Need' && $_REQUEST['statusflag']!='ST_Pending')

			if($TotalCount > 0 ) {$responseStr.=$TotalCount; if($TotalCount > 1) $responseStr.=' orders'; else $responseStr.=" order"; $responseStr.=" found whose ".$SearchHeader ; }

			if($_REQUEST['statusflag']=='ST_Need') {$responseStr.=$TotalCount; if($TotalCount > 1) $responseStr.=" ships"; else $responseStr.=" ship";$responseStr.=" found ".$SearchHeader ; }

			if($_REQUEST['statusflag']=='ST_Pending') {$responseStr.=$TotalCount; if($TotalCount > 1) $responseStr.=" orders"; else $responseStr.=" order";$responseStr.=" found ".$SearchHeader ; }

		}

		else	

			if( $TotalCount > 0 )   {$responseStr.=$TotalCount; if($TotalCount > 1) $responseStr.=" ships"; else $responseStr.=" ship";$responseStr.=" found ".$SearchHeader ; }*/

	$HedStr='';		

	if($_REQUEST['statusflag']!='' )

	{

		if($_REQUEST['statusflag']!='ST_Need' && $_REQUEST['statusflag']!='ST_Pending' && $_REQUEST['statusflag']=='DatOfShGone')

		{

			if($TotalCount > 0) 

			{

			//$objResponse->addAlert('block1');

				$responseStr.=$TotalCount; 

				if($TotalCount > 1) 

				{

					$responseStr.=' Offshore orders'; 

					$HedStr=" Offshore orders  ".$SearchHeader;

				}

				else 

				{

					$responseStr.=" order"; 

					$HedStr=" Offshore order  ".$SearchHeader;

				}

				$responseStr.=" found  ".$SearchHeader ; 

			

			}

		}	

		if($_REQUEST['statusflag']!='ST_Need' && $_REQUEST['statusflag']!='ST_Pending' && $_REQUEST['statusflag']!='DatOfShGone')

		{

			

			if($_REQUEST['statuscod']=='O')

			$Record="Order";

			else if($_REQUEST['statuscod']=='S')

			$Record="Ship";

			else

			$Record="Record";

			if($TotalCount > 0 ) 

			{

				$responseStr.=$TotalCount; 

				if($TotalCount > 1) 

				{

					$responseStr.=" ".$Record."s"; 

					$HedStr=" ".$Record."s ".$SearchHeader;

				}

				else 

				{	

					$responseStr.=" ".$Record;  

					$HedStr= $Record." ".$SearchHeader;

				}

					$responseStr.=" found  ".$SearchHeader ; 

			

			}

		}	

			

		    /*if($_REQUEST['statusflag']!='ST_Need' && $_REQUEST['statusflag']!='ST_Pending')

			if($TotalCount > 0 ) {$responseStr.=$TotalCount; if($TotalCount > 1) $responseStr.=' orders'; else $responseStr.=" order"; $responseStr.=" found whose ".$SearchHeader ; }*/

			if($_REQUEST['statusflag']=='ST_Need') 

			{



				$responseStr.=$TotalCount; 

				if($TotalCount > 1) 

				{

					$responseStr.=" ships"; 

					$HedStr=" Ships ".$SearchHeader;

				}

				else 

				{

					$responseStr.=" ship";

					$HedStr=" Ship".$SearchHeader;

				}

				$responseStr.=" found ".$SearchHeader ; 

			

			}

			if($_REQUEST['statusflag']=='ST_Pending') 

			{

				

				$responseStr.=$TotalCount; 

				if($TotalCount > 1) 

				{

					$responseStr.=" orders"; 

					$HedStr=" Orders ".$SearchHeader;

				}

				else 

				{

					$responseStr.=" order";

					$HedStr=" Order ".$SearchHeader;

				}

				$responseStr.=" found ".$SearchHeader ; 

			

			}

		}

		else	

		{	

		if( $TotalCount > 0 )   

		{

	

			$responseStr.=$TotalCount; 

				if($TotalCount > 1) 

				{

					$responseStr.=" ships";

					$HedStr=" Ships".$SearchHeader;

				}

				 else 

				 {

				 	$responseStr.=" ship";

				 	$HedStr=" Ship ".$SearchHeader;

				 }

				 $responseStr.=" found ".$SearchHeader ; 

			}

		}



  	$responseStr.='</td>

    <td width="20%" height="25" align="right" onMouseOver="this.style.cursor=\'hand\'" onClick="SubmitSecureForm(document.frmlist,document.frmlist.action,\'shipadd.php\')" style="padding-right:10">Add 

      new ship / order </td>';

	 /* $objResponse->addAlert('</td>

    <td width="20%" height="25" align="right" onMouseOver="this.style.cursor=\'hand\'" onClick="location.href=\'shipadd.php?searchparam=document.getElementById(\"searchparam\").value&keywordsearch=document.getElementById(\"keywordsearch\").value&backfrom=\"backfrom\"\';" style="padding-right:10">Add 

      new ship / order </td>');*/

 $responseStr.='</tr>';	  

	  if($TotalCount > 0 )

	  {

	  $responseStr.='<tr> 

		<td width="30%" height="20" colspan="3" align="right"><font color="#A8211E">* The letters <b>S</b>,<b>R</b>,<b>C</b>,<b>V</b>,<b>E/D</b> refer to <b>Sale</b>,<b>Resale</b>,<b>Conversion/Contractual Revision</b>,<b>View</b> and <b>Edit/Delete</b> respectively.</font></td>';

  	

  $responseStr.=' </tr>';

  }

  

$responseStr.='</table> ';

//=============================================================================================================================

if($TotalCount == 0 )

{

//No record found....

	if(strpos($headersms,'for'))

		$Emptysms = substr($headersms,strpos($headersms,'for')); 

	else

		$Emptysms='';

  $responseStr.='<table width="70%" border="0" align="center" cellpadding="0" cellspacing="1" >

    <tr> 

      

    <td height="25" align="center" valign="middle">No ship / order exists'.$SearchHeader.'</td>

    </tr>

</table>

  <br>';



}

else

{

$responseStr.='<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="1">';

  

// echo strpos($SearchHeader,"shipbuilder")."<BR>";

//  echo strpos($SearchHeader,"ship status")."<BR>";

 // echo substr_count($SearchHeader,",")."<BR>";

 	if(strpos($SearchHeader,"shipbuilder")>0 && strpos($SearchHeader,"ship status")>0 && substr_count($SearchHeader,"]")==2)

	{

 $responseStr.=' <tr> 

    <td height="20" colspan="11"> <span style="cursor:pointer;padding-left:10px" onClick="ExportXLS()" onMouseOut="document.forms[0].action=\'shiplist.php\'">Send 

      to excel</span></td>

  </tr>

  <tr> ';

   

  }

  

   $responseStr.='<th height="20" colspan="2">S. no. </th>';

   $SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

   $SortingTxt='WYDeliveryDate asc';

    if(substr($orderby,0,14)=='WYDeliveryDate') 

	{

					

		if (strpos($orderby,' desc')>0) 

		{	

			$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

			$SortingTxt="WYDeliveryDate asc";

		}							

		else

		{ 

			 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

			 $SortingTxt="WYDeliveryDate desc";

		}	 

	}

     $responseStr.='<th width="6%" 

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');" 

	onMouseOver="this.style.cursor=\'hand\'">Built/Delivery date ';

    if(substr($orderby,0,14)=='WYDeliveryDate') 

		$responseStr.=$SortingImg;

	 $responseStr.='</th>';



	  $SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='imonum, shipwynum ';

	    if(substr($orderby,0,17)=='imonum, shipwynum') 

					{ 

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="imonum asc, shipwynum asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="imonum desc, shipwynum desc";

						}	 

						

					}

	 

		

    $responseStr.='<th width="8%"

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');"

	 onMouseOver="this.style.cursor=\'hand\'">IMO num / WY num

      <font style="font-size:9px;font-weight:normal;color:khaki">WY No in red and Invalid IMO/WY no in brown</font> ';

	 if(substr($orderby,0,17)=='imonum, shipwynum') 

	 	$responseStr.=$SortingImg; 

	 

    $responseStr.='</th>';

	

	 $SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='shipnam';

	  	     if(substr($orderby,0,7)=='shipnam') 

					{ 

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="shipnam asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="shipnam desc";

						}	 

					}

	$responseStr.='<th width="10%" 

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');"  

	onMouseOver="this.style.cursor=\'hand\'"> 

     Ship Name - English ';

	 if(substr($orderby,0,7)=='shipnam') 

	 	$responseStr.=$SortingImg;

		

	 $responseStr.='</th>';

	 /*added by kusum according to msg no 44458 on 8 june 2011*/

	$responseStr.='<th width="10%">Ship Name - Chinese</th>';

	

	

	  $SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='segnam';

	  	     if(substr($orderby,0,6)=='segnam') 

					{ 

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="segnam asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="segnam desc";

						}	 

					}

	$responseStr.='<th width="10%" 

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');"  

	onMouseOver="this.style.cursor=\'hand\'"> 

     Segment ';

	 if(substr($orderby,0,6)=='segnam') 

	 	$responseStr.=$SortingImg;

		

	 $responseStr.='</th>';

	 

	  $SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='typnam';

     if(substr($orderby,0,6)=='typnam') 

					{ 

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="typnam asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="typnam desc";

						}	 

					}

    $responseStr.='<th width="10%" 

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');"  

	onMouseOver="this.style.cursor=\'hand\'"> 

     Sub-segment';

	 if(substr($orderby,0,6)=='typnam') 

	  $responseStr.=$SortingImg;



    $responseStr.='</th>';

	

	 $SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='hullnum';

   	if(substr($orderby,0,9)=='hullnum') 

					{ 

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="hullnum asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="hullnum desc";

						}	 

					}

					

    $responseStr.='<th width="3%" 

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');" 

	 onMouseOver="this.style.cursor=\'hand\'">Hull num';

   	if(substr($orderby,0,9)=='hullnum') 

			$responseStr.=$SortingImg;

  $responseStr.='</th>';



  $SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='capacityval ';

   	if(substr($orderby,0,11)=='capacityval') 

					{ 

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="capacityval asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="capacityval desc";

						}	 

					}

					

    $responseStr.='<th width="5%"onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');" 

	 onMouseOver="this.style.cursor=\'hand\'">Capacity ';

	if(substr($orderby,0,11)=='capacityval') 

		$responseStr.=$SortingImg;

	 $responseStr.='</th>';

	 

    $SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='theowner ';

   	if(substr($orderby,0,8)=='theowner') 

					{      

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="theowner asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="theowner desc";

						}	 

					}

					

if(($_REQUEST['statusflag']=='DatGone') || ($_REQUEST['statusflag']=='DatOfShGone') || ($_REQUEST['statusflag']=='DatGoneStale') || ($_REQUEST['statusflag']=='DatGonetc'))

{

					$responseStr.='<th width="8%">Sister Orders'; 

	 $responseStr.='</th>';

    /* if(substr($orderby,0,6)=='ordercount') 

			$responseStr.= $SortingImg;

   */

    /*$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='ordercount';

   	if(substr($orderby,0,6)=='ordercount') 

					{ 

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="ordercount asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="ordercount desc";

						}	 

					}*/

}					

     $responseStr.='<th width="8%" 

	 onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');" 

	 onMouseOver="this.style.cursor=\'hand\'">Beneficial owner / Group / JV'; 

     if(substr($orderby,0,8)=='theowner') 

			$responseStr.= $SortingImg;

   $responseStr.='</th>';

   

       $SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='synam';

   	if(substr($orderby,0,5)=='synam') 

					{ 

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="synam asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="synam desc";

						}	 

					}

					

     $responseStr.='<th width="15%" colspan="2"

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');"  onMouseOver="this.style.cursor=\'hand\'">* Shipyard ';

    if(substr($orderby,0,5)=='synam') 

		$responseStr.=$SortingImg;

	$responseStr.='</th>';

	

	$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='statusnam ';

   	if(substr($orderby,0,9)=='statusnam') 

					{ 

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="statusnam asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="statusnam desc";

						}	 

					}

					

    $responseStr.='<th width="6%" 

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');"  onMouseOver="this.style.cursor=\'hand\'">Ship 

      status ';

      if(substr($orderby,0,9)=='statusnam') 

		 $responseStr.=$SortingImg;

    $responseStr.='</th>';

	

	$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='orderdat ';

   	if(substr($orderby,0,8)=='orderdat') 

					{ 

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="orderdat asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="orderdat desc";

						}	 

					}

					

    $responseStr.='<th width="6%" 

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');"  onMouseOver="this.style.cursor=\'hand\'">Order Date ';

      if(substr($orderby,0,8)=='orderdat') 

		 $responseStr.=$SortingImg;

    $responseStr.='</th>';

	

	

	$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='socnam ';

   	if(substr($orderby,0,6)=='socnam') 

					{ 

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="socnam asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="socnam desc";

						}	 

					}

					

    $responseStr.='<th width="6%" 

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');"  onMouseOver="this.style.cursor=\'hand\'">Classification Society';

      if(substr($orderby,0,6)=='socnam') 

		 $responseStr.=$SortingImg;

    $responseStr.='</th>';

/* comented by kusum according to msg no 44458	

$responseStr.='<th width="3%">Ship for</th>';*/

	

	$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='length ';

   	if(substr($orderby,0,6)=='length') 

					{ 

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="length asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="length desc";

						}	 

					}

					

	$responseStr.='<th width="4%"

	 onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');"  onMouseOver="this.style.cursor=\'hand\'">LOA';

	if(substr($orderby,0,6)=='length')

	{

	$responseStr.=$SortingImg;

	 }

	

	$responseStr.='</th>';

	$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='breadth ';

   	if(substr($orderby,0,7)=='breadth') 

					{ 

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="breadth asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="breadth desc";

						}	 

					}



	$responseStr.='<th width="5%" 

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');" onMouseOver="this.style.cursor=\'hand\'">Breadth';

	

	if(substr($orderby,0,7)=='breadth')

	{

		$responseStr.=$SortingImg;

	 }

	$responseStr.='</th>';

	

	$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='depth ';

   	if(substr($orderby,0,5)=='depth') 

					{ 

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="depth asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="depth desc";

						}	 

					}



	$responseStr.='<th width="4%" 

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');" onMouseOver="this.style.cursor=\'hand\'">Depth';

	

	if(substr($orderby,0,5)=='depth')

	{

		$responseStr.=$SortingImg;

	 }

$responseStr.='</th>';



    $responseStr.='<th width="4%">Sale / resale</th>';

	

	$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>';

	  $SortingTxt='desnam ';

   	if(substr($orderby,0,6)=='desnam') 

					{ 

					

						if (strpos($orderby,' desc')>0) 

						{	

							$SortingImg='<img src=\'../img/down.gif\' align=\'absmiddle\'>'; 

							$SortingTxt="desnam asc";

						}							

						else

						{ 

							 $SortingImg='<img src=\'../img/up.gif\' align=\'absmiddle\'>'; 

							 $SortingTxt="desnam desc";

						}	 

					}

	$responseStr.='<th width="4%" 

	onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,\''.$PageCounter.'\',\''.$NewOrderDays.'\',\''.$KeySearchOpt.'\',\''.$SortingTxt.'\',\''.$ROLEID.'\');" onMouseOver="this.style.cursor=\'hand\'">Design linked';

	

	if(substr($orderby,0,6)=='desnam')

	{

		 $responseStr.=$SortingImg;

	 }

$responseStr.='</th>

      <th width="3%">Conversion/ Revision</th>

	  <th width="3%">Conversion/ Revision date</th>

	  <th width="2%">View</th>

	 <!--  comented by kusum according to msg no 44458	

	<th width="7%" title="Attachments">A</th>  -->

    <th width="2%">Edit/Delete</th>

  </tr>';



//=================================================================================================

//========================display ships searched according to criteria=============================

//=================================================================================================

$ArrStatus = array('M'=>'<img src=../../member/img/C.gif align=absmiddle alt="Active Merchant">', 

							'NM'=>'<img src=../../member/img/N.gif align=absmiddle  alt="Active Non Merchant">', 

							'F'=>'<img src=../../member/img/F.gif align=absmiddle  alt="Former Names">', 

							'H'=>'<img src=../../member/img/H.gif align=absmiddle  alt="Historical ">',

							'D'=>'<img src=../../member/img/D.gif align=absmiddle  alt="Dormant ">',

							'U'=>'<img src=../../member/img/U.gif align=absmiddle  alt="Under construction">',

							'A'=>'<img src=../../member/img/A.gif align=absmiddle  alt="Alias">',

							'B'=>'<img src=../../member/img/B.gif align=absmiddle  alt="Block factory">');

$Counter = $RecordsFrom +1;

		$CurRecCounter = 0;

	$XCounter=0;

while($Row = @mysql_fetch_object($CurrentObj))

{

	$XCounter=0;

//=========================================added by vasim for attetchment colum in table on 28/4/2008=====================//

$FileToQuery="select count(if(shipwynum !='' or shipwynum is not null,1,null)) as totalattachment,group_concat(filnam) as shipfile from shipfiles

	where shipwynum='".$Row->shipwynum."' and removed='N'";

	$FileCountSelect=$DB->Select($FileToQuery,'Select_files',$Module);

	$ResultFetch=mysql_fetch_object($FileCountSelect);

	$DesFiles=$ResultFetch->shipfile;

	if($DesFiles!='')

	$DesArr=explode(',',$DesFiles);

	$DesStr='';

	$Cnt=1;

	if(is_array($DesArr))

	{

	foreach($DesArr as $Key=>$Val)

	{

	$DesStr.=$Cnt++.". ".$Val."\n";

	}

	}

	else

	$DesStr=$Cnt.". ".$$DesFiles;

//	$ResponseStr.='<tr>';

//	$ResponseStr.='<td height="20" align="center">'.$Counter++.'</td>';

	//==========================================================================================//

			if($CurRecCounter < $CurrentCount)

				$CurRecCounter++;

			else

				break;

	$TempVar = $Row->sizfldnam;

if(($_REQUEST['statusflag']=='DatGone') || ($_REQUEST['statusflag']=='DatOfShGone') || ($_REQUEST['statusflag']=='DatGoneStale')|| ($_REQUEST['statusflag']=='DatGonetc'))

{ 

 $TrIdForPaint = 'TrColor'.$Row->shipwynum; $TrIdForPaint = trim($TrIdForPaint); 

  $responseStr.='<tr align="center" title="'.$Row->shipnam.'" id="'.$TrIdForPaint.'"> 

    <td width="3%" id="mytd'.$Row->shipwynum.$XCounter++.'" > <input type="checkbox" class="checkbox" name="masscheck[]" id="masscheckid" value="'.$Row->shipwynum.'" onChange="AddNumForMassModification(this);">

    </td>

    <td width="2%" height="20" style="cursor:hand;" id="mytd'.$Row->shipwynum.$XCounter++.'" onClick="paint(\''.$TrIdForPaint.'\');">'.$Counter.'</td>

    <td style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">'; 

}

else

{

 $TrIdForPaint = 'TrColor'.$Row->shipwynum; $TrIdForPaint = trim($TrIdForPaint);

$responseStr.='<tr align="center" title="'.$Row->shipnam.'" id="'.$TrIdForPaint.'"> 

    <td width="3%" id="mytd'.$Row->shipwynum.$XCounter++.'" >  <input type="checkbox" class="checkbox" name="masscheck[]" id="masscheckid" value="'.$Row->shipwynum.'" onChange="AddNumForMassModification(this);">

    </td>

    <td width="2%" height="20" style="cursor:hand;" id="mytd'.$Row->shipwynum.$XCounter++.'" onClick="paint(\''.$TrIdForPaint.'\');">'.$Counter.'</td>

    <td style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">'; 

}



      // $responseStr.=$Row->deldat." ,<br> ";//.$Row->WYDeliveryDate;

 	  if($Row->deldat != '')      $responseStr.=MysqlToDelDat($Row->deldat, $Row->deldatflag,"N"); else $responseStr.=NODATE;

 	 

	   /// EDITED BY KISHOR ON 21.12.2005 FOR NEW ORDERS GIF IMPLEMENTATION =====================

	   if($Row->NewFlag==1)

	  	$responseStr.='&nbsp; &nbsp;<img src="../../member/img/new_or.gif" align=absmiddle alt="New Order">';

		 if(($Row->sensitiv!='N') && ($Row->sensitiv!= 'S'))

	  		$responseStr.='&nbsp;<img src="../../member/img/sen.gif" align=absmiddle  alt="Sensitive Order"> ';



		//Added by Kailash Pati on 01 March 2008 to show Joint Ventures

		 if($Row->statuscod=='JV')

	  		$responseStr.=' &nbsp;<img src="../../member/img/jvorder.gif" align=absmiddle  alt="Joint Venture"> ';

			

   $responseStr.='</td>';

   

   //added by teena for showing invalid IMO/WY number,considered to be invalid when the ship status is 'C'

		 if(($Row->imonum) !='' && trim($Row->imonum) != '0')

		 {

		 if($Row->statuscod=='C')

		  		  $LrWyStatus="<font color=\"brown\">".$Row->imonum."</font>";

		 else

		 		  $LrWyStatus=$Row->imonum;

		 }

		else if((trim($Row->shipwynum) !='' && trim($Row->shipwynum) != '0'))

		{

		if($Row->statuscod=='C')

			$LrWyStatus=("<font color=\"brown\">".$Row->shipwynum."</font>"); 

		else

			$LrWyStatus=("<font color=\"red\">".$Row->shipwynum."</font>"); 	

		}		  	  		  

		else

			$LrWyStatus=NOSTRDATA;

   

			

    $responseStr.='<td align="left" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'"> '.$LrWyStatus.'</td>';

  if(trim($Row->shipnam)!='' and trim($Row->shipnam) != '0')

  	$ShipNam=$Row->shipnam;

  else

  	$ShipNam=NOSTRDATA;



  $statusImg  = '';	

  if(trim($Row->statuscod) == 'UR')

    $statusImg='<img src="../../member/img/under_repair.GIF" alt="Under Repair"/>  &nbsp;';

  else if(trim($Row->statuscod) == 'U')

    $statusImg='<img src="../../member/img/undergoing_upgrading.GIF" alt="Undergoing Upgrading" /> &nbsp;';



  	

	if($Row->chineseshipnam!='') 

		$ChinesesName=$Row->chineseshipnam; 

	else 

		$ChinesesName=NOSTRDATA;

		

  $responseStr.=' <td align="left" style="padding-left:6;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">'.$statusImg.$ShipNam.'</td>

  

 	<td align="center" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'"> '.$ChinesesName.

      '</td>



     <td align="left" style="padding-left:6;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">'.$Row->segnam.'</td>

    <td align="left" style="padding-left:6;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">'.$Row->typnam.'</td>

	

    <td style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">';if($Row->hullnum != '' && $Row->hullnum != '0') $responseStr.=$Row->hullnum; else $responseStr.=NOSTRDATA;

	$responseStr.='</td>

	   <td style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">'.(CommaDisplay(round($Row->capacityval,2)).' '.$Row->sizunit).'</td>'; //td for capacity value

	   



if(($_REQUEST['statusflag']=='DatGone') || ($_REQUEST['statusflag']=='DatOfShGone') || ($_REQUEST['statusflag']=='DatGoneStale') ||  ($_REQUEST['statusflag']=='DatGonetc'))

{

	if($staleordercount[$Row->shipwynum] > 0 || $staleordercount[$Row->shipwynum] != '' || $staleordercount[$Row->shipwynum] != 0 )

	{

	 

	 $responseStr.='<td width="5%" style="cursor:hand" onClick="windowopen(\'sisterorder.php?groupcount='.$stalegrouporder[$Row->shipwynum].'&shipwynum='.$Row->shipwynum.'&imnum='.$Row->imonum.'&totalcount='.$staleordercount[$Row->shipwynum].'&statustype='.$_REQUEST['statusflag'].'&BackPage=shiplist.php&showClose=yes\')" id="mytd'.$Row->shipwynum.$XCounter++.'">';

		$responseStr.=$actualsisterordercount[$Row->shipwynum]; 

		$responseStr.='</td></a>';

	}

	

	else

	{

		$responseStr.='<td align="center" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">';

		$responseStr.="-";

		$responseStr.='</td>';

	}

	}



   $responseStr.=' <td align="left" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">';

    	   

	    if (($Row->benownwynum != '0') && $Row->grptyp == '')

	    {

	        if ((trim($Row->statusnam) == 'Cancelled' || $Row->statuscod == 'MT') && $Row->showinob == 'Y')

	            $Owgrpjvwynam = "Own Account by Default";

	        elseif ($Row->benownwynum != '' && $Row->benownwynum != '0')

	        {

	            if (getOwnerName($Row->benownwynum) != '')

	                $Owgrpjvwynam = getOwnerName($Row > benownwynum);

	        }

	    }

	    if ((trim($Row->statusnam) == 'Cancelled' || $Row->statuscod == 'MT') && $Row->showinob == 'Y')

	        $Owgrpjvwynam = "Own Account by Default";

	    else if (($Row->benownwynum == '' or $Row->benownwynum == '0') and ($Row->bogrpid != 0 and $Row->bogrpid != '') and $Row->grptyp != '')

		 $Owgrpjvwynam = getBoGroupName($Row->bogrpid);

	    elseif (getNationality($Row->benowncoucod) != '' && $Row->benowncoucod != '0')

	        $Owgrpjvwynam = getNationality($Row->benowncoucod) . "*";

	    else if ($Row->theowner != '')

	        $Owgrpjvwynam = $Row->theowner;

	    else if ($Row->hascontracted == 'Y' and ($Row->benownwynum == 0 || $Row->benownwynum == ''))

	        $Owgrpjvwynam = "Contracted for own account";

	    else

		

	        $Owgrpjvwynam = '';

			

			

	/*if((trim($Row->statusnam)=='Cancelled'  || $Row->statuscod=='MT') && $Row->showinob=='Y')

		$Owgrpjvwynam="<font color='brown'>Own Account by Default</font>";

	else if($Row->grptyp=='')

     	$Owgrpjvwynam=$Row->theowner;

	else

		$Owgrpjvwynam=getBoGroupName($Row->bogrpid);	*/

	 

	 $Owgrpjvwynam = stripslashes($Owgrpjvwynam);

	if($Owgrpjvwynam != '')  $responseStr.=($Owgrpjvwynam); else  $responseStr.=NOSTRDATA;

   $responseStr.= '</td>

    <td align="left" style="padding-left:2;padding-right:2;border-right:none;cursor:pointer"  id="mytd'.$Row->shipwynum.$XCounter++.'"  onClick="openWindow(\'comhistoryship.php?objwynum='.$Row->shipwynum.'&shipwynum='.$Row->shipwynum.'&sywynum='.$Row->synam.'&shipnam='.$Row->shipnam.'&imonum='.$Row->imonum.'&hullnum='.$Row->hullnum.'&showClose=yes\')"> ';

	

	if($Row->synam !='')  

	{

		$responseStr.=($Row->synam);

	}	

   else

   		$responseStr.= NOSTRDATA;

	

   $responseStr.=' </td>';

   $responseStr.='<td align="center" style="padding-left:2;padding-right:2;border-left:none"  id="mytd'.$Row->shipwynum.$XCounter++.'">';

   if($Row->synam !='')  

	{

		$responseStr.=$ArrStatus[$Row->yardstat];

		

	}	

   else

   		$responseStr.= '-';

	   $responseStr.=' </td>';

	 if($Row->statusnam=="On order" || (trim($Row->statusnam)=='Cancelled' && $Row->showinob=='Y') || ($Row->statuscod=='MT'  && $Row->showinob=='Y'))

	{

	  if($Row->statuscod=='MT' && $Row->showinob=='Y')

	  {

	 $responseStr.='<td align="left" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'"><font color="green">On &nbsp;<img src="img/t.gif" align=absmiddle alt="Termianted but remained order"><br>order</font>';

	 }

	 elseif(trim($Row->statusnam)=='Cancelled' && $Row->showinob=='Y')

	 {

	  $responseStr.='<td align="left" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'"><font color="green">On &nbsp;<img src="img/can.bmp" align=absmiddle alt="Cancelled but remained order"><br>order</font>';

	  }

	  elseif(trim($Row->statusnam)=='On order' && ($_REQUEST['statusflag']=='furtherConfirm' ||

	  $Row->further_confirmation =='Y'))

	  { 

		$responseStr.='<td align="left" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'"><font color="green">On &nbsp;<img src="img/NFC.gif" align=absmiddle alt="on order"><br>order</font>';

	  }

	 else

	 $responseStr.='<td align="left" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'"><font color="green">'.$Row->statusnam.'</font>';

	

	}

	elseif($Row->statusnam == "In service")

	{

		if(in_array($Row->shipwynum,$Cancelledtoship))

		{

			if($Statusbeforeship[$Row->shipwynum]=='C' || $Statusbeforeship[$Row->shipwynum]=='FC')

		 		$ImgStr='<img src="img/can.bmp" align=absmiddle>';

			else

				$ImgStr='<img src="img/t.gif" align=absmiddle>';

		$responseStr.='<td align="left" style="padding-left:2;padding-right:2;" id="mytd'.$Row->shipwynum.$XCounter++.'"><font color="blue"  >In '.$ImgStr.' <br>service</font>';	

		}

		else

	 $responseStr.='<td align="left" style="padding-left:2;padding-right:2;" id="mytd'.$Row->shipwynum.$XCounter++.'"><font color="blue"  >'.$Row->statusnam.'</font>';	

	}

	elseif($Row->statusnam == "Cancelled" && $Row->showinob=='N' )

	{

	   $responseStr.='<td align="left" id="mytd'.$Row->shipwynum.$XCounter++.'" style="padding-left:2;padding-right:2;">'.$Row->statusnam;	

	}

	else

	{

   	$responseStr.='<td align="left" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">'. $Row->statusnam;	}

	$responseStr.='</td>';

	

	if($Row->orderdat!='')

		$OrderdatStr=$Row->orderdat;

	else

		$OrderdatStr=NOSTRDATA;

	

	$responseStr.='<td align="left" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">'. $OrderdatStr;	

	$responseStr.='</td>';



	if($Row->socnam!='')

		$SocStr=$Row->socnam;

	else

		$SocStr=NOSTRDATA;

	

	$responseStr.='<td align="left" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">'. $SocStr;	

	$responseStr.='</td>';



/* /* commented by kusum according to msg no 44458

$responseStr.='	<td align="center" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'"> ';

     if($Row->saltyp =='R') $responseStr.='For resale'; elseif($Row->saltyp =='S')  $responseStr.='For sale'; else $responseStr.='-';

    $responseStr.='</td>*/

	 $responseStr.='<td align="center" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">';

	 

	 if($Row->length !='')

	 	$responseStr.= TruncDecimalZeros($Row->length);

	else

	$responseStr.=NOSTRDATA;	

    $responseStr.='</td> 

	<td align="center" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">';

	 if($Row->breadth !='')

	 	$responseStr.=TruncDecimalZeros($Row->breadth);

	else

	$responseStr.= NOSTRDATA;

	 

	$responseStr.='</td>  

	<td align="center" style="padding-left:2;padding-right:2;"  id="mytd'.$Row->shipwynum.$XCounter++.'">';

	

	 if($Row->depth !='')

	 	$responseStr.=TruncDecimalZeros($Row->depth);

	else

	$responseStr.=NOSTRDATA;

	  

	$responseStr.='</td>';

    

	if($Row->statuscod =='O' || ($Row->statuscod=='C' && $Row->showinob=='Y') || ($Row->statuscod=='MT'  && $Row->showinob=='Y'))

			{

			

   $responseStr.='<td 

   onClick="document.getElementById(\'PageCounter\').value=\''.$PageCounter.'\',document.getElementById(\'backfrom\').value=\'backfrom\',document.frmlist.initialstatus.value=\''.($Row->statuscod).'\',SubmitForPage(document.frmlist, document.frmlist.shipwynum,\''.$Row->shipwynum.'\',\'shipsale.php\');" style="cursor:hand;" id="mytd'.$Row->shipwynum.$XCounter++.'">'; 

       $responseStr.="R";			

			}

			elseif($Row->statuscod == 'S')

			{

			

    $responseStr.='<td 

	onClick="document.getElementById(\'PageCounter\').value=\''.$PageCounter.'\',document.getElementById(\'backfrom\').value=\'backfrom\',document.frmlist.initialstatus.value=\''.($Row->statuscod).'\',SubmitForPage(document.frmlist, document.frmlist.shipwynum,\''.($Row->shipwynum).'\',\'shipsale.php\');" style="cursor:hand;" id="mytd'.$Row->shipwynum.$XCounter++.'"> ';

     $responseStr.="S";

			}

			else

			{

			

    $responseStr.='<td id="mytd'.$Row->shipwynum.$XCounter++.'"> N/A';

			}

		

   $responseStr.='</td>';

	 

	

		if($Row->designwynum !='')

		{	

		$NumVessel=$DB->FetchObject("select count(shipwynum) totves from ship where designwynum='".$Row->designwynum."' and deleted='N' group by designwynum","get_design_numofvessel",$Module);

		//$objResponse->addAlert("select count(shipwynum) totves from ship where statuscod in ('S','O') and designwynum='".$Row->designwynum."' and deleted='N' group by designwynum");

		if($NumVessel->totves >1)

			$NumShip='Vessels';

		else 

			$NumShip='Vessel';				

		$responseStr.='<td style="color=green" title="'.$Row->desnam.' ('.$NumVessel->totves.' '.$NumShip.')" id="mytd'.$Row->shipwynum.$XCounter++.'">

		"Y"';

		}		

		else

		{

		$responseStr.='<td style="color=red" title="No design linked" id="mytd'.$Row->shipwynum.$XCounter++.'">

		"N"'; 

		}	

	$responseStr.='</td>';

 		if($Row->statuscod=='D' || $Row->statuscod=='DB')//=====demolished or doubtful

			$Disabled='disabled';

		else

			$Disabled='';		

		//	if($Row->statuscod == 'O')

			//{		

    $responseStr.='<td '.$Disabled.' 

	onClick="document.getElementById(\'PageCounter\').value=\''.$PageCounter.'\',document.getElementById(\'backfrom\').value=\'backfrom\',

	document.frmlist.mode.value=\'conversion\', document.frmlist.initialstatus.value=\''.$Row->statuscod.'\',SubmitForPage(document.frmlist, 

	document.frmlist.shipwynum,\''.$Row->shipwynum.'\',\'shipedit.php\');" style="cursor:hand;" id="mytd'.$Row->shipwynum.$XCounter++.'" ' ; 

    // $responseStr.="Conversion";

	//$objResponse->addAlert(" converted".$Row->converted);

	if($Row->statuscod=='O' && $Row->converted=='Y')

		$ConTitle="Revised";

	else if	($Row->statuscod=='O')

		$ConTitle="Revise";

	else if($Row->statuscod=='S' && $Row->converted=='Y')	

		$ConTitle="Converted";	

	else if(($Row->converted!='Y' && $Row->conversionconfirm=='Y') && (($Row->conenddate > date('Y-m-d') && ($Row->constartdate <= date('Y-m-d'))) ))	

		$ConTitle="On-going Conversion";

	else if(($Row->converted!='Y' && $Row->conversionconfirm=='Y') && (($Row->conenddate > date('Y-m-d') && ($Row->constartdate > date('Y-m-d'))) ))		

		$ConTitle="Future Conversion";	

	else 	

		$ConTitle="Conversion";	

	if($Row->converted=='Y' || ($Row->converted!='Y' && $Row->statuscod=='S' &&  $Row->conversionconfirm=='Y'))

	{

		$responseStr.=" ><font color='blue' ><b>".$ConTitle."</b></font>";

	}

	else

	  	$responseStr.=" ><font color='#AF4A38' ><b>".$ConTitle."</b></font>";

		//	}

		//	else

			//{

			

  // <td width="2%">

      

			//	echo "N/A";

		//	}

		

    $responseStr.='</td>';

    /*<!--td width="5%" style="cursor:hand" onClick="openWindow('shipdetailspagenew.php?<?php echo WYEncodeURL("shipwynum=".$Row->shipwynum."&RecordPointer=".($Counter)."&TotalRec=".($TotalCount)."&sql=".urlencode($PreNextPasQry)."&BackPage=shiplist.php&showClose=yes","Detail")?>')">View</td-->*/

	if($Row->converted=='Y' || ($Row->converted!='Y' && $Row->conversionconfirm=='Y') && (($Row->conenddate > date('Y-m-d') && ($Row->constartdate <= date('Y-m-d'))) ))

	{

		$Row->condat=getLatestConversionDate($Row->shipwynum);

		$responseStr.='<td  id="mytd'.$Row->shipwynum.$XCounter++.'">'.ConvertDate($Row->condat).'</td>';

	}	

	else

		$responseStr.='<td id="mytd'.$Row->shipwynum.$XCounter++.'">-</td>';

$responseStr.='<td width="5%" style="cursor:hand"

	 onClick="openWindow(\'shipdetailspagenew.php?shipwynum='.$Row->shipwynum.'&RecordPointer='.$Counter.'&TotalRec='.$TotalCount.'&sql='.urlencode($PreNextPasQry).'&BackPage=shiplist.php&showClose=yes\')" id="mytd'.$Row->shipwynum.$XCounter++.'">';

	 $responseStr.='<font color="#AF4A38" ><b>V</b></font>'; 

	//$responseStr.='<img src="../img/find.gif"></img>'; 

	$responseStr.='</td>';	

	/* commented by kusum according to msg no 44458

	if($ResultFetch->totalattachment==0 || $responseStr=='n/a')

	 { 

	

	 $responseStr.='<td height="20" align="center" title="" id="mytd'.$Row->shipwynum.$XCounter++.'">';

	  

	}

	

else

{

  

     $responseStr.='<td height="20" align="center" title="'.$DesStr.'" id="mytd'.$Row->shipwynum.$XCounter++.'">';



}	

	$ResultFetch->totalattachment!=0?$responseStr.=$ResultFetch->totalattachment:$responseStr.='n/a';

	if($ResultFetch->totalattachment!=0)

	{

	$ResponseStr.='<img src="../../img/Clip4.jpg"  title="'.$DesStr.'" ></img>';

	}

	$responseStr.='</td>';*/

	

    $responseStr.='<td width="6%" style="cursor:hand;" onClick="document.getElementById(\'PageCounter\').value=\''.$PageCounter.'\',document.getElementById(\'backfrom\').value=\'backfrom\',document.frmlist.mode.value=\'edit\', document.frmlist.initialstatus.value=\''.$Row->statuscod.'\',SubmitForPage(document.frmlist,document.frmlist.shipwynum,\''.$Row->shipwynum.'\', \'shipedit.php\');" id="mytd'.$Row->shipwynum.$XCounter++.'"

	><font color="#AF4A38" ><b>E/D</b></font>';

	/* $responseStr.='<td width="6%" style="cursor:hand;" 

	 onClick="document.getElementById(\'PageCounter\').value=\''.$PageCounter.'\',document.getElementById(\'backfrom\').value=\'backfrom\',document.frmlist.mode.value=\'edit\', document.frmlist.initialstatus.value=\''.$Row->statuscod.'\',SubmitForPage(document.frmlist,document.frmlist.shipwynum,\''.$Row->shipwynum.'\', \'shipedit.php\');">';

 	

	$responseStr.='<img src="../img/edit.gif"></img>'; */

	$responseStr.='</td></tr>';

$Counter++;

}

$responseStr.=' <tr>

			  <td colspan="26">* Click on shipyard to add commercial entry.</td></tr>

</table><br>';

//$CurrentCount;



	//=================================================

	//@include_once "../../common/pagination.php";

	//$Temp=$TotalCount."+".$CountUpTo."+".$CountStartFrom."+".$PageRecords."+".$PageCounter."+".$SearchParam."+".$NewOrderDays;

	//$objResponse->addAlert($Temp);



	$responseStr.=PaginateData($TotalCount, $CountUpTo, $CountStartFrom, $PageRecords, $PageCounter,$SearchParam,$NewOrderDays,$KeySearchOpt,$OrderBy,$ROLEID);

	$responseStr.='<center> &nbsp; 

			<input type=button name="checkall" value="Check all" onClick="CheckAllForMassModification(\''.$CurrentCount.'\');"> &nbsp; 

			<input type=button style="width:225px" name="modifyall" value="Modify details of selected ships/orders" onClick="Massmodification();"> &nbsp;

			<input type=button name="unchecktoall" value="Reset all checked" onClick="uncheckall(document.frmlist),document.frmlist.massmodifvalues.value=\'\';"> &nbsp;

			<input type=button style="width:250px" name="modifydeldat" value="Modify delivery dates of selected ships/ orders" onClick="MassmodifyDeldat(\'Y\');">

			'.$massButton.' 

			 

		</center><br>';

	$responseStr.='<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">

						<tr align"center">

							<td align="center">		   

							<img src="../../member/img/xlicon.gif" onClick="SubmitForm();" >

							   </td></tr></table>';



	$CancelledtoshipStr=serialize($Cancelledtoship);

	$CancelledtoshipStr=rawurlencode($CancelledtoshipStr);

	

	$StatusbeforeshipStr=serialize($Statusbeforeship);

	$StatusbeforeshipStr=rawurlencode($StatusbeforeshipStr);

	

	$excelsisterorder=serialize($actualsisterordercount);

	$actualexcelsisterorder=rawurlencode($excelsisterorder);	

	

	$responseStr.='<input type="hidden" name="excelsisterorder" value="'.$actualexcelsisterorder.'" >';

	$responseStr.='<input type="hidden" name="sisterorder" value="'.$SisterOrder.'" >';

	$responseStr.='<input type="hidden" name="xlquery" value="'.$Queryforxl.'" >';

	$responseStr.='<input type="hidden" name="cancelledtoshipStr" value="'.$CancelledtoshipStr.'" >';

	$responseStr.='<input type="hidden" name="statusbeforeshipStr" value="'.$StatusbeforeshipStr.'" >';

	$responseStr.='<input type="hidden" name="statusflag" value="'.$HedStr.'" >';

	$responseStr.='<input type="hidden" name="statustype" value="'.$_REQUEST['statusflag'].'" >';



}

}

else

{



/*

$responseStr.='<table width="70%" align="center" cellpadding="0" cellspacing="1" style="border:white 1px solid" >

  <tr> 

    <td height="25" align="right" onMouseOver="this.style.cursor=\'hand\'" onClick="location.href=\'shipadd.php\';" style="padding-right:10"> Add new ship / order </td>

  </tr>

</table>';*/



}



//$objResponse->addAlert($SearchWhere." order by $orderby");

//$objResponse->addAssign($Shiplistdiv,'innerHTML',$SearchWhere." order by $orderby");

//return $objResponse;	

//$objResponse->addAlert($NewOrderDays);



//$objResponse->addAssign($Shiplistdiv,'innerHTML',$SearchWhere." order by $orderby");

$objResponse->addAssign($Shiplistdiv,'innerHTML',$responseStr);

//$objResponse->addAssign($Shiplistdiv,'innerHTML',$SearchParam); // Only for parameter check



$objResponse->addScript("document.getElementById('dataload').style.display='none';");

$objResponse->addScript("document.getElementById('loadTR').style.display='none';");

return $objResponse;	  	

		

}



function GetPaginationData(&$RecordsFrom, &$PageRecords, $PageCounter)

{

	$DB = new DBConnect();

	//Block 001 Starts

	$Query="select recsearch,recperpage from configsettings";

	



	$ObjRec=$DB->Select($Query,'Select ConfigSettings', '');

	$Rec=@mysql_fetch_object($ObjRec);

	$PageRecords = $Rec->recperpage;



	$RecordsFrom = $PageRecords * $PageCounter;

	//Block 001 Ends

			

}

 

function PaginateData($TotalCount, $CountUpTo, $CountStartFrom, $PageRecords, $PageCounter,$SearchParam,$NewOrderDays,$KeySearchOpt,$OrderBy,$ROLEID='')

{

	$Str='';

	 if(($TotalCount > $CountUpTo) || ($CountStartFrom + 1 > $PageRecords))

		{

			$Str.='<table width="80%" border="0" cellspacing="0" bgcolor="#FFFFFF" class="pagination" align="center">

			

			  <tr valign="bottom" bordercolor="#FFFFFF"> 

				<td width="50" height="20" align="left" class="blanktd">&nbsp;'; 

				//===========================================================================



								//LINK FOR PREVIOUS PAGE.....

				//===========================================================================

				//===========================================================================

					//echo ' CountStartFrom : ' . $CountStartFrom . ' PageRecords : ' . $PageRecords . ' TotalCount : ' . $PageCounter;

					if($CountStartFrom + 1 > $PageRecords)

					{

						

					

						$Str.='<label  alt="Go to previous" onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,'.($PageCounter-1).','.$NewOrderDays.',\''.$KeySearchOpt.'\',\''.$OrderBy.'\',\''.$ROLEID.'\');"  onmouseover="this.style.cursor=\'hand\'">Previous</label> ';

					//	<!--img src=\'img/prev.gif\' alt="Go to previous" onClick="PrePage()"  onmouseover="this.style.cursor=\'hand\'"-->

					}

					$Str.='</td>

				<td  class="blanktd">&nbsp;</td>';

					//==============================================================================

													//INDIVIDUAL PAGE LINKS.....

					//==============================================================================

					//==============================================================================

				

						$i=1;

						$j=$PageCounter;

						if($j>=10)

							$i=$j-9;

						if($TotalCount > 2*$PageRecords)

						{

					//=========================================================================================================================

					//=========================================================================================================================

							for(;$i<=10+$PageCounter &&($TotalCount >($i-1)*$PageRecords) ;$i++)

							{

								if($i==$PageCounter+1)

								{ 

									//$ajaxResponse->addAlert('If');

								  $Str.='<a onclick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,'.$i.','.$NewOrderDays.',\''.$KeySearchOpt.'\',\''.$OrderBy.'\',\''.$ROLEID.'\');" onmouseover="this.style.cursor=\'hand\'" class="paginationbg1">

									<td  class="blanktd" height="20" width="23" align="center" background="file:///D|/common/img/bg2.gif" valign="middle" onmouseover="this.style.cursor=\'hand\'" style="color:#50BFC9 "><b>';

									$Str.=$i;

									$Str.='</b></td> </a> <td  class="blanktd" width="2"></td>';

								}

								else

								{

									//$ajaxResponse->addAlert('else');							

									$Str.='<a onclick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,'.($i-1).','.$NewOrderDays.',\''.$KeySearchOpt.'\',\''.$OrderBy.'\',\''.$ROLEID.'\');" onmouseover="this.style.cursor=\'hand\'" class="paginationbg2" >

									<td  class="blanktd" height="20" width="23" class="paginationbg2" valign="middle" align="center" background="../../../common/img/bg1.gif" onmouseover="this.style.cursor=\'hand\'" >';

									$Str.=$i;

										   $Str.='</td></a><td  class="blanktd" width="1"></td>';

								}

							}

					//=========================================================================================================================

					//=========================================================================================================================

						 }

						 $PageCounter=$j;

				

				$Str.='<td  class="blanktd">&nbsp;</td>

				<td  class="blanktd" width="50" height="20" align="right">&nbsp; ';

				//==============================================================================

												//NEXT PAGE LINK.....

				//==============================================================================

				//==============================================================================

						if($TotalCount > $CountUpTo)

						{

						

					$Str.='<label  alt="Go to Next" onClick="setDataLoad(),xajax_Shiplist(\'shiplistdiv\',document.getElementById(\'searchparam\').value,'.($PageCounter+1).','.$NewOrderDays.',\''.$KeySearchOpt.'\',\''.$OrderBy.'\',\''.$ROLEID.'\');"  onmouseover="this.style.cursor=\'hand\'">Next</label> ';

					//	  <!--img src=\'img/next.gif\' alt="Go to next" width="16" height="16" onClick="NextPage()" onmouseover="this.style.cursor=\'hand\'"-->'; 

						}

				$Str.='</td>

			  </tr>

			 

			</table>';

	}

	

		return $Str;

}



function ShowSpecField($SpecCombodiv,$WYType,$ShipWyNum='',$DesignWyNum='')

{

	$DB=new DBConnect();

	$objResponse = new xajaxResponse();

	$ResponseStr='';

	$PrevSubSeg=false;

	//$objResponse->addAlert($WYType);

//================================================================================

//=======================================================================================

//================================================================================

	$GetSpecificInfo = 0;

	if($WYType != '')

	{

		$GetSpecificInfo =1;

	}

//===============================================================================================================

	$IsSpecField = 0;

	

	if($GetSpecificInfo == 1)

	{

			$WYSpecSizeResult = $DB->FetchObject("select sizfldnam,keyranknooff from shiptype where wytypid = $WYType", 

			"sizfld_wyspecific", $Module);	

			$objResponse->addScript("document.getElementById('shipsizefield').value='".$WYSpecSizeResult->sizfldnam."'");		

			$CountSpecResult = $DB->FetchObject("select count(ws.fldnam) as TotalFields from wyspecific as ws where enabled = 'Y'

			 and wytypid = $WYType", "Count_wyspecific", $Module);			

			

			$SpecFieldsCount = $CountSpecResult->TotalFields;

			$WYSpecSizeField=$WYSpecSizeResult->sizfldnam;

			



//=======================Query to find all the specific field along with there option values and parent child relationship info

		$Query = "select ws.fldnam, ws.fldcap, ws.isopt,ws.fldid,op.optval,op.optcap,ws.fldsrnum,ws.parentfld,ws.superheading,ws.minval,ws.maxval

 				from wyspecific as ws LEFT JOIN optionfields as op ON op.fldnam = ws.fldnam and ws.isopt='Y' and op.deleted!='Y' 

				where wytypid =  $WYType  and ws.enabled='Y' 

				order by superheading,fldsrnum,parentfld,childsrnum,fldnam, op.optsort desc, op.optval desc";			 

		//===============order by plays a very important role in the above query

		

			$Result = $DB->Select($Query, "Select_wyspecific", $Module);

		

			$DependFld=array();//================array of fields dependent on other field

			$ParentField=array();//================array of fields parent of dependent fields

 			$IdxArr=array();

		

			//================fetch all specific fields having some parent field and their superheading

			$QrySpecApp="select wytypid,ws.fldnam as fldstr,ws.isopt,ws.parentfld as parentfld,superheading from wyspecific as ws where 

			wytypid = $WYType and ws.enabled='Y' and parentfld is not null and parentfld!='' order by superheading,ws.parentfld,ws.`childsrnum`,fldid";



			//============================fetch all specific fields which are not child fields and could be parents of any field.			

			$QryLbl="select wytypid,ws.fldnam as fldstr,superheading from wyspecific as ws where 

			wytypid = $WYType and ws.enabled='Y' and (parentfld is null or parentfld='') and superheading!='' and superheading is not null

			 order by superheading,ws.fldsrnum,fldid";

/*	

 			$objResponse->addAssign($SpecCombodiv,"innerHTML",$QrySpecApp);

			return $objResponse;*/

			

 			$ResApp=$DB->Select($QrySpecApp,"Get_child_Fields",$Module);

			$ResLab=$DB->Select($QryLbl,"Get_Parent_Fields",$Module);

			

			$PrevFld='';

			$Cnt1=0;

			$SupPrevHeading='';

			

			while($RowLab=mysql_fetch_object($ResLab))//============fields other than child fields having super heading.

			{

				//$objResponse->addAlert($RowLab->fldnam."   :   ".$RowLab->superheading);

					$SpecLab[$RowLab->fldstr]=$RowLab->superheading;

				

			}//===end of while

			while($RowApp=mysql_fetch_object($ResApp))//=========Child fields 

			{

				//$objResponse->addAlert($ResApp);

				if($RowApp->superheading!='' && !@array_key_exists($RowApp->parentfld,$SpecLab))//not same as parent's

				{

					if($RowApp->superheading!=$SupPrevHeading )//================put inside array			

					{

						$ChildStr[$RowApp->parentfld].=$RowApp->superheading.'||WY||';//=====================array containing superheading of child fields not same as parent

						// so that its display property can be set to on-off.Contains string for each parent to be passed ito js function

						$ChildOptStr[$RowApp->parentfld].='LAB||WY||';//=====Label to match if its only a caption not some field so as to reset or change its value acc to parent

					}

					//$objResponse->addAlert($ChildOptStr[$RowApp->parentfld]);

					//$objResponse->addAlert($RowApp->fldstr."  :  ".$RowApp->superheading);

					$SpecLab[$RowApp->fldstr]=$RowApp->superheading;

					$ChildLbl[$RowApp->parentfld]=$RowApp->superheading;//========only for childs to let the tr's display off an on

				}

				$DependFld[$RowApp->parentfld][]=$RowApp->fldstr;//===child array,first index is parent field and second is numeric

				//(all childs falling under single parent)

				$ChildStr[$RowApp->parentfld].=$RowApp->fldstr.'||WY||';//====string of child fields of a single parent.	

								

				$ChildOptStr[$RowApp->parentfld].=$RowApp->isopt.'||WY||';//====array containing type of child field (radio or text) string for each parent 

				//to be passed ito js function		

				if($PrevFld!=$RowApp->fldstr)//=========not a radio ctr.

					$ParentField[$RowApp->fldstr]=$RowApp->parentfld;//array of parent fields having child as its index.

				$PrevFld=$RowApp->fldstr;

			//	$ParentField[$RowApp->fldstr]=$RowApp->parentfld;//array of parent fields having child as its index.

				$SupPrevHeading=$RowApp->superheading;	

			}//===end of while

			

	



			//=============Get the total number of childs==========@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

			$TotChild=0;

			foreach($DependFld as $Key=>$Val) 

			{	

				foreach($Val as $K=>$V)

				{

					$TotChild++;//================total number of childs regardless of their parents

				}

			}

			

			$ParIndex=0;

				foreach($ParentField as $PKey=>$PVal)

				{

					$IdxArr[$ParIndex]=$PVal;//==============array to fetch index of parent field to be used to get the click count of the 

											//corresponding parent fieldname present at the same index in below js array as js doesn't provide associative arrays

					$objResponse->addScript('ParentFld['.$ParIndex.']="'.$PVal.'";');//js array for parent

					$objResponse->addScript('ParentFldCnt['.$ParIndex++.']=0;');//js array to maintain parent field's click count which toggles between 0 and 1

					

				}

		

			if($WYSpecSizeField == 'dwt' || $WYSpecSizeField == 'gt' || $WYSpecSizeField == 'powerhp')//==============if size field is one of the common fields,

																										//assign thevalue in the counter 

				$SpecCounter = 1;

			else

				$SpecCounter = 2;

				

			//=========Check added by Teena on 4th Sept,2006=============================================//

			

			if($SpecFieldsCount==1)//only single spec fld exists

			{

				while($SizRow=mysql_fetch_object($Result))

					//$objResponse->addAlert($SizRow->fldnam);

					$SizFld=$SizRow->fldnam;

			

					if($WYSpecSizeField==$SizFld)

					{

						$SpecFieldsCount=0;//make $SpecFieldsCount to zero so that no table is displayed

					

					}

				@mysql_data_seek($Result,0);//reset result row

			}

			//==================================================================================//

			

			if($SpecFieldsCount  > 0)//========if atleast or more than one field exist which is not size field

			{	

				

				//$objResponse->addAlert($Result);

				$ArrCnt=0;

				while($RowField= mysql_fetch_object($Result))

					{

						$ArrFld[$ArrCnt++]=$RowField->fldnam;//array with total specific fields applicable							

					}	

					mysql_data_seek($Result,0);

					$StrFld=implode(',',$ArrFld);//string for all specific fields



				if($ShipWyNum!='')

				{

					$PreviousSeg=$DB->FetchObject("select wytypid from ship where shipwynum = '".$ShipWyNum."'", "ship_wytypid", $Module);//========subsegment stored in the database for the ship

					

						$PrevSubSeg=true;//=============not in use currently.

						//#######################################################################################

						//..to display special characters in Heat Coil Description...following script added by

						//..Anita on Dec 21, 2006...............

						//#######################################################################################

							$FieldsToFetchStr = $StrFld;

					//		$FieldsToFetchStr = str_replace('heatcoildesc','CONVERT(heatcoildesc USING utf8) as heatcoildesc',$FieldsToFetchStr);

						//#######################################################################################

						$ShipRow=$DB->FetchObject("select ".$FieldsToFetchStr." from shipspecific where 

						shipwynum = '".$ShipWyNum."'", "ship_wyspecific", $Module);

								

				}//===end if 

				//$objResponse->addAlert($StrFld);

				if($DesignWyNum!='' && $DesignWyNum!='0')

				{

				//$objResponse->addAlert($DesignWyNum);

					$DesignRow=$DB->FetchObject("select ".$StrFld." from designspecific where designwynum = '".$DesignWyNum."'", "design_wyspecific", $Module);//get values from design.not in use for now		

				}

			

					foreach($ArrFld as $Key=>$Val)

					{

						$ShipRow->$Val = utf8_encode($ShipRow->$Val);//============fetch already saved values only in the ship tables

					}

		

			   $ResponseStr.='<table width="90%" id="mainTable"  border=0 align="center" cellpadding="0" cellspacing="1">

			   <tr align="center">

				 <th width="70%" height="20" colspan="4">Sub-segment specific details </th>

			   </tr>';

		

				$FldName = '';

				$Col = 0;

				$TempFld='';

				$DepenIdx=1;

				$Cnt=0;

				$ParDispIdx='';

				$SpecSizFlag=0;

				while($Row = mysql_fetch_object($Result))

				{

				//$objResponse->addAlert($StrFld);

				//HERE IS MAKING A STRING OF FIELD NAMES FOR THE USE OF CLEARING FIELD. 

				if($Row->isopt == 'Y')

				     $RadioFldNamStr.= $Row->fldnam.'radioBROKESTR';//.$C;//.$Row->isopt;

				else     

				     $TextFldNameStr.= $Row->fldnam.'textBROKESTR';//.$C;//.$Row->isopt;

				  // $objResponse->addAlert($TextFldNameStr);  

					$SpanColSpec = '';

					//=========if the field is ship size field, ignore it....as ship size field has been already displayed......

					if($WYSpecSizeField == $Row->fldnam)	//========if field name is matched with already appeared field, it points at different value of same field========

						{

							$SpecSizFlag=1;

							continue;

						}

						if(@array_key_exists($Row->fldnam,$ParentField) && @in_array($Row->fldnam,$DependFld[$ParentField[$Row->fldnam]])

						 && ($ShipWyNum!='') 

						 &&	($ShipRow->$ParentField[$Row->fldnam]=='Y' || $ShipRow->$ParentField[$Row->fldnam]=='external' || $ShipRow->$ParentField[$Row->fldnam]=='internal' ))//==============if one of the child index in the parent 

						 																 	  //==array and one of the child fields of the field's parent and value of the parent is 'Y'

						{

							$SpecDependStyle='display:inline';//=======display the tr of the child field

						}	

						else	

							$SpecDependStyle='display:none';//=====hide tr of the child	

							

				

					if($FieldName == $Row->fldnam)//===============if field is repeating(option field's option)

					{

							//=====set selected value

							$CheckRadio = '';

							$ConcatId='';

							if($Row->optval=='')

									$ConcatId='n/a';//==============if value is blank append 'n/a' in the id of the control to make it distinguishable from its name

								else

									$ConcatId=$Row->optval;//==========='Y' or 'N'

						

							if($ShipRow->$FieldName==$Row->optval)//===============if value in the ship matches with one ofthe options make it checked

							{

								$CheckRadio ='checked';	

								

										

								if(@array_key_exists($Row->fldnam,$ParentField) && @in_array($Row->fldnam,$DependFld[$ParentField[$Row->fldnam]]) && $ShipRow->$FieldName!='')//===========if repeating field is one of the child field with some value

									{



										$objResponse->addScript("document.getElementById('".$FieldName."ctr').value='".$FieldName.$ShipRow->$FieldName."';");//====assign the the name+value of the previous field in the control hidden variable 	

									}

							}	 

							$OnClickSpec='';	

						//==========display another option value of the field=================

									

							if($Row->fldnam == 'dh')

								$ResponseStr.=" <input type=radio name='".$Row->fldnam."' value='".$Row->optval."' id='".$Row->fldnam.$ConcatId."' class=checkbox 

								onClick='SetByDH(),storeArrOnChange(this.name,this.value,this.type)'".$CheckRadio." tabindex='1'> &nbsp; ".$Row->optcap." &nbsp; ";

											 

						   else if(@in_array($Row->fldnam,$ParentField))//============if field exists as parent of some ctr

						   {

								if(@is_array($IdxArr))//========if IdxArr consists of more than one element

									$ParentIdx=@array_search($Row->fldnam,$IdxArr);//==========search the index of the parent field

								else

									$ParentIdx=$IdxArr[1];//==================to get the very first index value corresponding to js arrays

									

								$OnClickSpec="SpecDependDisp(this,this.value,\"".$ChildStr[$Row->fldnam]."\",\"".$ParentIdx."\",\"".$ChildOptStr[$Row->fldnam]."\"

								,\"".$ChildLbl[$Row->fldnam]."\")

								,storeArrOnChange(this.name,this.value,this.type);";//===========string for calling the function

								

								$ResponseStr.=" <input type=radio name='".$Row->fldnam."'  value='".$Row->optval."' id='".$Row->fldnam.$ConcatId."'

								 class=checkbox tabindex='1' onClick='".$OnClickSpec."' ".$CheckRadio."> &nbsp; ".$Row->optcap." &nbsp; ";

							}	

							else if(count($DependFld[$ParentField[$Row->fldnam]])>0 && @in_array($Row->fldnam,$DependFld[$ParentField[$Row->fldnam]]))

							//======if there are child fields of some parent field and if the current field is one of the child fields of its parent

							{

								if($Row->isopt=='Y')//=======if field is some option field,StoreArrOnChange stores its value if maunally changed by the user,to track the changes done while edit transaction.

								{

									$ResponseStr.=" <input type=radio name='".$Row->fldnam."' value='".$Row->optval."' id='".$Row->fldnam.$ConcatId."'

									 onClick='storeArrOnChange(this.name,this.value,this.type),

									 document.getElementById(\"".$Row->fldnam."hid\").value=this.value,

									 document.getElementById(\"".$Row->fldnam."ctr\").value=this.id;' 

									 class=checkbox ".$CheckRadio." tabindex='1'> &nbsp; ".$Row->optcap." &nbsp; ";	

									/* $ResponseStr.="<select>

									<option value='1'>1</option>

									<option value='2'>2</option>

									<option value='3'>3</option>

									</select>";

									$objResponse->addAlert($ResponseStr);*/

								 }

								 else//========for text field@@@@@@@@@@@@@@@@@@@@doubtful

								 {

								 $ResponseStr.=" <input type=radio name='".$Row->fldnam."' value='".$Row->optval."' id='".$Row->fldnam.$ConcatId."'

								 onClick='storeArrOnChange(this.name,this.value,this.type);' 

								 class=checkbox ".$CheckRadio." tabindex='1'> &nbsp; ".$Row->optcap." &nbsp; ";	

								 }

							}	 

							else {

								$ResponseStr.=" <input type=radio name='".$Row->fldnam."' value='".$Row->optval."' id='".$Row->fldnam.$ConcatId."' 

								onClick='storeArrOnChange(this.name,this.value,this.type)' class=checkbox ".$CheckRadio." tabindex='1'> &nbsp; ".$Row->optcap." 

								&nbsp; ";

							}

					}

					else//==============first option field or text field otherwise

					{//$objResponse->addAlert($Row->isopt);

						$TempFld=$Row->fldnam;

						$objResponse->addScript('SpecFldOnLoad['.$Cnt.']="'.$Row->fldnam.'"');//====load field name in the array with values at loading time,to track if its value changed.

						$objResponse->addScript('SpecValOnLoad['.$Cnt++.']="'.$ShipRow->$TempFld.'"');//====load field value in the array with values at loading time,

																							//===both the arrays will be used to determine whether the value will be changed acc to the design or not.

					//$objResponse->addAlert($TempFld);

					//==============================================Code for Parent Fields =====================================================================

					//$objResponse->addAlert($ResponseStr);

						if(@in_array($Row->fldnam,$ParentField))//===============if Parent field 

						{

						//if($Row->fldnam!=$ParentField[$FieldName])//==========if not same as previous field's parent

							if($Col==0)

							{

							

								if($Row->superheading!='' && (($Row->superheading!=$SpecLab[$FieldName] && !@array_key_exists($FieldName,$ParentField))

								 || (@array_key_exists($FieldName,$ParentField) && $SpecLab[$ParentField[$FieldName]]!=$Row->superheading)))

								 //=======if not equal to previous field's super heading or if previous field is a child then it is not equal to the parent field's superheading

								{

									$ResponseStr.="</td></tr>

											<tr id='".$Row->superheading."tr'><td align=left width='16%' colspan=4 height='20' 

											style='padding-left:5px'>".$Row->superheading;//===========start the superheading from next row									

									

									//$Col=1;		

								}	

							/*	else if(array_key_exists($FieldName,$ParentField) && array_pop($DependFld[$ParentField[$FieldName]])==$FieldName)//========if the previous field was 

																																	//=the last fields of its parent	

								{

									$ResponseStr.="wwwww $Col</td><td>ttttt&nbsp;";										

									$Col=1;

								}	*/	

								//$objResponse->addAlert($Row->fldnam."    ::  ".$Row->superheading."  : :  ".$SpecLab[$FieldName]."   : :  ".$FieldName);																									

								$ResponseStr.="</td></tr><tr><td align=right width='16%'>";

							}

							else if($Col==1)

							{

								if($Row->superheading!='' && $Row->superheading!=$SpecLab[$FieldName])//=======if not equal to previous field's super heading

								{

									

									$ResponseStr.="</td><td colspan=2>&nbsp;</td></tr>

											<tr id='".$Row->superheading."tr'><td align=left width='16%' colspan=4 height='20' 

											style='padding-left:5px'>".$Row->superheading;									

									$ResponseStr.="</td></tr><tr><td align=right width='16%'>";		

									

											

								}	

								else 																											

								$ResponseStr.="</td><td colspan=2>&nbsp;</td></tr><tr><td align=right width='16%'>";	

								$Col=0;	

							}

							

						}

						//==============================================End of Parent Fields==============================================================	

						//==============================================Code for Child Fields==============================================================

						

						elseif(@array_key_exists($Row->fldnam,$ParentField))//=========if child field.

						{

						if($Col==0)

						{

							//if(count($DependFld[$ParentField[$Row->fldnam]])>0 &&  @in_array($Row->fldnam,$DependFld[$ParentField[$Row->fldnam]]))

							//=if child field of the current field's parent

							//{

								//if($Row->fldnam==$DependFld[$ParentField[$Row->fldnam]][0])//=================if first child,create a new tr			

									//{				

										

										if($Row->superheading!='' && $PrevSupHeading!=$Row->superheading)

										{

											$ResponseStr.="</td></tr>

											<tr id='".$Row->superheading."tr' style='".$SpecDependStyle."'><td align=left width='16%' colspan=4 height='20' 

											style='padding-left:5px'>".$Row->superheading."</td>";

											$ResponseStr.="</td></tr>

											<tr id='".$Row->fldnam."tr' style='".$SpecDependStyle."'><td align=right width='16%'>";

											$Col=1;

										}

									//}	

										else 

										{

										$ResponseStr.="</td></tr>

											<tr id='".$Row->fldnam."tr' style='".$SpecDependStyle."'><td align=right width='16%'>";

											

										}	

										

								/*	}

									else 

									{

										if($Row->superheading!='' && $PrevSupHeading!=$Row->superheading)

										{

											$ResponseStr.="hhhh $Col</td></tr>

											<tr id='".$Row->superheading."tr' style='".$SpecDependStyle."'><td align=left width='16%' colspan=4 height='20' 

											style='padding-left:5px'>".$Row->superheading."</td>";

											$ResponseStr.="jjjjj $Col</td></tr>

											<tr id='".$Row->fldnam."tr' style='".$SpecDependStyle."'><td align=right width='16%'>kkkk $Col";

											$Col=1;

										}

										else 

										{

										$ResponseStr.="lllllll $Col</td></tr><tr id='".$Row->fldnam."tr' style='".$SpecDependStyle."'><td align=right width='16%'>zzzz $Col";

										}	



										

									}*/

										

							}

						else if ($Col==1)							

						{

							if(count($DependFld[$ParentField[$Row->fldnam]])>0 &&  @in_array($Row->fldnam,$DependFld[$ParentField[$Row->fldnam]]))

							//=if child field of the current field's parent

							{

							//$objResponse->addAlert($Row->fldnam.'   :   '.$DependFld[$ParentField[$Row->fldnam]][0]);

								if($Row->fldnam==$DependFld[$ParentField[$Row->fldnam]][0])//=================if first child,create a new tr			

								{				

										

										if($Row->superheading!='' && $PrevSupHeading!=$Row->superheading)

										{

											$ResponseStr.="</td><td>&nbsp;</td></tr>

											<tr id='".$Row->superheading."tr' style='".$SpecDependStyle."'><td align=left width='16%' colspan=4 height='20' 

											style='padding-left:5px'>".$Row->superheading."</td>";

											$ResponseStr.="</td></tr>

											<tr id='".$Row->fldnam."tr' style='".$SpecDependStyle."'><td align=right width='16%'>";

											

										}

										else 

										{

										$ResponseStr.="</td><td colspan=2>&nbsp;</td></tr><tr id='".$Row->fldnam."tr' style='".$SpecDependStyle."'><td align=right width='16%'>";

										

										}	

										$Col=0;

								}

								else

									$ResponseStr.="</td><td align=right width='16%'>";	

													

							}

							elseif(count($DependFld[$ParentField[$Row->fldnam]])==1 && $DependFld[$ParentField[$Row->fldnam]][0]==$Row->fldnam && 

							 @in_array($Row->fldnam,$DependFld[$ParentField[$Row->fldnam]]))//===== if single element array

							{

								if($Row->superheading!='' && $PrevSupHeading!=$Row->superheading)

								{

									$ResponseStr.="</td><td>&nbsp;</td></tr>

									<tr id='".$Row->superheading."tr' style='".$SpecDependStyle."'><td align=left height='20' colspan=4 style='padding-left:5px' width='16%'>

									".$Row->superheading."</td></tr>";

									$ResponseStr.="<tr id='".$Row->fldnam."tr' style='".$SpecDependStyle."'><td align=right width='16%'>";

									//==if column value is 0 insert a new tr	

									

									

								}

								else												





									$ResponseStr.="</td><td>&nbsp;</td></tr><tr id='".$Row->fldnam."tr' style='".$SpecDependStyle."'><td align=right width='16%'>";

								$Col=0;

							}

						}

						

								if($Row->isopt=='Y')//=========if the field is option create 2 hidden variable for option control and its value

								{

								$Fld=$Row->fldnam;

									//$objResponse->addAlert($Row->fldnam."2value  :  ".$Row->fldnam.$ShipRow->$Fld);	

									

									$ResponseStr.="<input name='".$Row->fldnam."ctr' type='hidden' id='".$Row->fldnam."ctr' value='".$Row->fldnam.$ShipRow->$Fld."'>

									<input name='".$Row->fldnam."hid' type='hidden' id='".$Row->fldnam."hid' value='".$ShipRow->$Fld."'>";

									//$objResponse->addAlert("imontn 1: ".$Row->fldnam.  "  :  ".$ShipRow->$Fld."  :  ".$ShipRow->$Row->fldnam);	

								}

					}

						//=========================End of child======================

					else 

					{

						if($Col==0)

						{

								if($Row->superheading!='' && $PrevSupHeading!=$Row->superheading)

								{

									$ResponseStr.="</td></tr>

									<tr ><td align=left height='20' colspan=4 style='padding-left:5px' width='16%'>

									".$Row->superheading."</td></tr>";

									

									$ResponseStr.="<tr ><td align=right width='16%'>";

									//==if column value is 0 insert a new tr	

									//$Col=1;//====other than parent child

								}

								else												

									$ResponseStr.="</td></tr><tr><td align=right width='16%'>";

								

						}

						else if ($Col==1)

						{

								if($Row->superheading!='' && $PrevSupHeading!=$Row->superheading)

								{

								

									$ResponseStr.="</td><td colspan=2>&nbsp;</td><tr><td align=left height='20' colspan=4 style='padding-left:5px' width='16%'>

									".$Row->superheading."</td></tr>";

									$ResponseStr.="<tr id='".$Row->fldnam."tr' ><td align=right width='16%'>";

									//==if column value is 0 insert a new tr	

									$Col=0;

									

								}

								else if(@array_key_exists($FieldName,$ParentField))

									{

										$ResponseStr.="</td><td colspan=2>&nbsp;</td></tr><tr><td align=right width='16%'>";

										$Col=0;

									}

								else												

									$ResponseStr.="</td><td align=right width='16%'>";

								

						}

					}	

						

						

						$ResponseStr.=$Row->fldcap." : </td>";

						

						/*	if(in_array($Row->fldnam,$DependFld))

									$ResponseStr.="<td align=left $SpanColSpec width='34%'>";

							else

									$ResponseStr.="<td align=left $SpanColSpec width='34%'>";	*/

							

							$ResponseStr.="</td><td  align=left width='34%'>";

						//=============if the field has no option values, display textbox, else display radio buttons============

						if($Row->isopt == 'Y')

						{

							//=========================================================================================

								//=====set selected value

										$CheckRadio = '';

										$Fldnam=$Row->fldnam;



					//$ResponseStr.="$Row->fldnam |".$ShipRow->$Fldnam."'  and '".$Row->optval."' | ";

			 					if($ShipRow->$Fldnam==$Row->optval)	

								{		

									$CheckRadio='checked';

								}

								 $OnClickSpec='';	

							//$objResponse->addAlert($ShipRow->$Fldnam."====".$Row->optval);//==========================================================================================

						if($Row->fldnam == 'dh')

								$ResponseStr.=" <input type=radio name='".$Row->fldnam."' tabindex='1' value='".$Row->optval."'

								 id='".$Row->fldnam.$Row->optval."' class=checkbox onClick='SetByDH(),storeArrOnChange(this.name,this.value,this.type);' 

								 ".$CheckRadio.">&nbsp; ".$Row->optcap." &nbsp; ";

						/*	else if($Row->fldnam == 'imotyp')//=commented while merging

							{

							

								if($IfImoNtnApp)

									$OnClickImo='ImoDisplay(this.value),storeArrOnChange(this.name,this.value,this.type)';

								else 	

									$OnClickImo='storeArrOnChange(this.name,this.value,this.type)';

								$ResponseStr.=" <input type=radio name='".$Row->fldnam."' value='".$Row->optval."' tabindex='1' 

								id='".$Row->fldnam.$Row->optval."' class=checkbox onClick='".$OnClickImo."'".$CheckRadio."> &nbsp; ".$Row->optcap." &nbsp; ";	

							}	

							else if($Row->fldnam == 'imontn')





							{

								//$objResponse->addAlert($Row->optval);

								$ResponseStr.=" <input type=radio name='".$Row->fldnam."' value='".$Row->optval."' id='".$Row->fldnam.$Row->optval."' 

								onClick='document.getElementById(\"imontnhid\").value=this.value;document.getElementById(\"imontnctr\").value=this.id,

								storeArrOnChange(this.name,this.value,this.type)' class=checkbox ".$CheckRadio." tabindex='1'> &nbsp; ".$Row->optcap."

								 &nbsp; ";	

							}	*/

							else if(@in_array($Row->fldnam,$ParentField))

							{

								//$ParDispIdx=$Col;

								$ParDispIdx=$Col;			

								$ChildStr[$Row->fldnam]=substr($ChildStr[$Row->fldnam],0,strlen($ChildStr[$Row->fldnam])-6); 

								//$objResponse->addAlert($ChildStr[$Row->fldnam]);

								

								//$objResponse->addScript("for(var i=0;i<ParentFld.length;i++){if(ParentFld[i]=='".$Row->fldnam."'){ParIdx=i;break;}}");

									 

								if(@is_array($IdxArr))

									$ParentIdx=@array_search($Row->fldnam,$IdxArr);

								else

									$ParentIdx=$IdxArr[0];	

								//$objResponse->addAlert("here F ".$ParentIdx);

								$OnClickSpec="SpecDependDisp(this,this.value,\"".$ChildStr[$Row->fldnam]."\",\"".$ParentIdx."\",\"".$ChildOptStr[$Row->fldnam]."\",\"".$ChildLbl[$Row->fldnam]."\"),storeArrOnChange(this.name,this.value,this.type);";

								//$objResponse->addAlert($OnClickSpec);

								$ResponseStr.=" <input type=radio name='".$Row->fldnam."' value='".$Row->optval."' tabindex='1' 

								id='".$Row->fldnam.$Row->optval."' class=checkbox onClick='".$OnClickSpec."' ".$CheckRadio."> 

								&nbsp; ".$Row->optcap." &nbsp; ";

							}	

							else if(count($DependFld[$ParentField[$Row->fldnam]])>0 &&  @in_array($Row->fldnam,$DependFld[$ParentField[$Row->fldnam]]))

							{ 

								

								$ResponseStr.=" <input type=radio name='".$Row->fldnam."' value='".$Row->optval."' 

								id='".$Row->fldnam.$Row->optval."' 

								onClick='storeArrOnChange(this.name,this.value,this.type),document.getElementById(\"".$Row->fldnam."\"+\"hid\").value=this.value,

								 document.getElementById(\"".$Row->fldnam."\"+\"ctr\").value=this.id;' class=checkbox ".$CheckRadio." tabindex='1'> 

								&nbsp; ".$Row->optcap." &nbsp; ";	

								$DepenIdx++;

							}	

							else

								$ResponseStr.=" <input type=radio name='".$Row->fldnam."' tabindex='1' value='".$Row->optval."' id='".$Row->fldnam.$Row->optval."'

								 onClick='storeArrOnChange(this.name,this.value,this.type)'  class=checkbox ".$CheckRadio."> &nbsp; ".$Row->optcap." &nbsp; ";

						}

						else

						{

						if(count($DependFld[$ParentField[$Row->fldnam]])>0 &&  @in_array($Row->fldnam,$DependFld[$ParentField[$Row->fldnam]]))

							{

								$DepenIdx++;

							}

							

							$FldName=$Row->fldnam;

								 if($ShipRow->$FldName!='' && $ShipRow->$FldName!='0' && $ShipRow->$FldName!='0.00')

									$Val=$ShipRow->$FldName;	

								else 

									$Val='';	

							

							if($FldName=='capgrain' || $FldName=='capbal')

								$ResponseStr.="<input type=text name='".$Row->fldnam."' id='".$Row->fldnam."' size=30 tabindex='1' 

								onBlur='ChkMinMaxVal(this,\"".$Row->minval."\",\"".$Row->maxval."\"),storeArrOnChange(this.name,this.value,this.type)' value='".($Val)."'> (Cu. mts)";

							else{

							//==================== code for select box genration =======//	

					//

							if($Row->isopt=='S')

							{

							$field = $Row->fldnam;

							$Qryforselected = "select $field as fieldnam from shipspecific where shipwynum = '".$ShipWyNum."'";

							//$objResponse->addAlert($Qryforselected);

							$Qryselectfeild = "select optval,optcap from optionfields where fldnam='".$Row->fldnam."'";

	$QryRes=$DB->Select($Qryselectfeild,"fetch_select_option",$Module);

	$QryResselected=$DB->Select($Qryforselected,"fetch_selected_option",$Module);	

	$ResponseStr.='<select name="'.$Row->fldnam.'" id="'.$Row->fldnam.'"  tabindex="1">';

    $ResponseStr.='<option value="">Please select</option>';

	while($QryRowselected=@mysql_fetch_object($QryResselected))

	{

	$selected = $QryRowselected->fieldnam;

		//$objResponse->addAlert($selected);

		//print_r($QryRowselected);

	}

//	$objResponse->addAlert($selected);

	while($QryRow=@mysql_fetch_object($QryRes))

	{

		$ResponseStr.='<option value="'.$QryRow->optval.'"';

		

		if($selected==$QryRow->optval)	{

			$ResponseStr.='selected';

			}

		$ResponseStr.='>'.$QryRow->optcap.'</option>';

	//	$objResponse->addAlert($selected."==========".$QryRow->optval);

	}

	$ResponseStr.='</select>';

								/*$ResponseStr.="<select>

									<option value='1'>1</option>

									<option value='2'>2</option>

									<option value='3'>3</option>

									</select>";*/

							}

						//=============End================//

							//$objResponse->addAlert($ResponseStr);

							else{	$ResponseStr.="<input type=text name='".$Row->fldnam."' id='".$Row->fldnam."' size=30 tabindex='1' 

								onBlur='ChkMinMaxVal(this,\"".$Row->minval."\",\"".$Row->maxval."\"),storeArrOnChange(this.name,this.value,this.type)' value='".($Val)."'>";

								

								}

							}

								

						}

						//===========================================================================================================

						if($Col == 0)

							$Col = 1;

						else

							$Col = 0;

							

							

						$IsSpecField++;

					}

					/*if($ShipWyNum!='' && $Row->fldnam=='imotyp' && $Row->optval=='Y')

						{

								//echo $ShipRow->imotyp;

								$objResponse->addScript('xajax_SetImoNotTyp("imonottypdiv","imontn","'.$ShipRow->imotyp.'","'.$WYType.'",ImoClickCount,"'.$ShipWyNum.'","'.$DesignWYNum.'","'.$SpanColSpec.'");');

							

					}*/

					$FieldName = $Row->fldnam;

					$PrevSupHeading=$Row->superheading;

						



				}

				

				//THIS BUTTON IS ADDED BY BAJRANG FOR CLEAR THE VALUES OF SUB-SEGMENT SPECIFIC FIELDS.

				$RadioFldNamStr=addslashes($RadioFldNamStr); 

				$TextFldNameStr=addslashes($TextFldNameStr);



				$clearButton=" <tr align='center'><td colspan='4'>  <input type='button' name='clrspesificdetails' id='clrspesificdetails' value='  Clear  ' onclick=\"ClearSpesificDetails('$TextFldNameStr','$RadioFldNamStr','$WYSpecSizeField')\" /></td></tr>";

				if($Col==1)

					$ResponseStr.="</td><td colspan=2>&nbsp;</td></tr>$clearButton</table><br>";

				else	

					$ResponseStr.="</td></tr>$clearButton</table><br>";

				

						/*	if(($SpecFieldsCount == $Cnt && $Col==0 && $SpecFieldsCount%2==1) || $SpecFieldsCount == 1 )	//to span columns accordingly//===========change done

							{	

								$ResponseStr.="</td><td colspan=2>zxc $Col $SpecFieldsCount  $Cnt&nbsp;</td></tr></table><br>";

								

							}

							else if(($SpecFieldsCount == $Cnt && $Col==1 && $SpecFieldsCount%2==0) || $SpecFieldsCount == 1 )	//to span columns accordingly//===========change done

							{	

								$ResponseStr.="vcxvx</td><td colspan=2> erre $SpecFieldsCount $Col $Cnt ".($SpecFieldsCount%2)."&nbsp;</td></tr></table><br>";

								

							}

							else if(($SpecFieldsCount == $Cnt && $Col==1 && $SpecFieldsCount%2==1) || $SpecFieldsCount == 1 )	//to span columns accordingly//===========change done

							{	

$ResponseStr.="sfd $SpecFieldsCount $Col $Cnt ".($SpecFieldsCount%2)."</td></tr></table><br>";								

							}

							else if(($SpecFieldsCount == $Cnt && $Col==0 && $SpecFieldsCount%2==0) || $SpecFieldsCount == 1 )	//to span columns accordingly//===========change done

							{	

$ResponseStr.="$SpecFieldsCount $Col $Cnt ".($SpecFieldsCount%2)."cvx</td></tr></table><br>";								

							}

							else

							$ResponseStr.="$SpecFieldsCount $Col $Cnt ".($SpecFieldsCount%2)."dfsdf</td></tr></table><br>";*/

			

			//===================================

							if($SpecSizFlag)

							{

								$TotFldDisp=$IsSpecField+1;

								

							}

							else

								$TotFldDisp=$IsSpecField;

								

			

				

			}

		//==============================

		

	}

		$ResponseStr.="<input type=hidden name='offsegcheck' id='offsegcheck' size=30 tabindex='1' value=".$WYSpecSizeResult->keyranknooff.">";

		//==============================

	//================SELECT SHIP SPECIFIC FIELDS AND DISPLAY THEM====================

	//$objResponse->addScript("alert('from shipajax showspec :'+ImoClickCount)");

	//$objResponse->addAlert($ResponseStr);

	$objResponse->addAssign($SpecCombodiv,"innerHTML",$ResponseStr);

	return $objResponse; 



}





function ShowFurtherDetails($FurtherDetailsdiv,$SizNotMandat,$WyTypId='',$DesignWyNum='',$ShipWyNum='')

{

	$DB=new DBConnect();

	$objResponse = new xajaxResponse();

	$ResponseStr='';

	$SegChange=false;

	$SizeFieldQry='';

	$SizNotMandatFunc=array();

	$SizNotMandatFunc=$SizNotMandat;

	

	//Added by bajrang according to mail number 56732. wytypid=>MaxDwtValue.

	//$MaxDwtWytypidArr = array(43=>80000, 78=>80000); 

	

	//================================================================================

	//$DB=new DBConnect();

	//$objResponse = new xajaxResponse();

	//$ResponseStr='';

	

	if($ShipWyNum!='')

	{

		$PreviousSeg=$DB->FetchObject("select wytypid from ship where shipwynum = '".$ShipWyNum."'", "ship_wytypid", $Module);

		//$objResponse->addAlert($PreviousSeg);

		//$objResponse->addAlert($ShipWyNum .','. $PreviousSeg->wytypid .','. $WyTypId);

		if($PreviousSeg->wytypid==$WyTypId)

		{

			$SizeFieldQry="select wytypid,sizfldnam,sizunit,minsiz,maxsiz,segid from shiptype where wytypid='".$PreviousSeg->wytypid."'";

						

		}

		else

		{

				$SizeFieldQry="select wytypid,sizfldnam,sizunit,minsiz,maxsiz,segid from shiptype where wytypid='".$WyTypId."'";

				$SegChange=true;

				//$objResponse->addAlert("fdjshfjkhsf");

		}	

	}

	elseif($WyTypId!='')

	{

		$SizeFieldQry="select wytypid,sizfldnam,sizunit,minsiz,maxsiz,segid from shiptype where wytypid='".$WyTypId."'";

	}

	

	if($SizeFieldQry!='')

	{

		$SizeResult=$DB->Select($SizeFieldQry,'Select_sizefld',$Module);

		if(@mysql_num_rows($SizeResult) > 0)

		{

			$SizeRow = @mysql_fetch_object($SizeResult);

		}

	}	



	$SpecFldNam=$SizeRow->sizfldnam;

	$ShipSizeUnit=$SizeRow->sizunit;	

	$ShipResult=false;

	//====================================================================================

	if($ShipWyNum!='')

	{

		 $SelectShipValue = "select length,lbp,draft,draftdes,breadth,depth,cgt,dwt,dwtdes,ldt,gt,nt,capacityval as size  from ship join shipspecific on 

		 ship.shipwynum=shipspecific.shipwynum where ship.shipwynum = '".$ShipWyNum."'";

	   //$objResponse->addAlert($SelectShipValue);

		$ShipResult = $DB->Select($SelectShipValue, "Select_ship_values", $Module);

							

		if($ShipResult!=false)

		{

			$ShipRow = mysql_fetch_object($ShipResult);

		}

		

	}	

	if($DesignWyNum!='')

	{

	$SelectDesignValue = "select length,lbp,draft,draftdes,breadth,depth,cgt,dwt,dwtdes,ldt,gt,nt,size as size from shipdesign as s, designspecific as d where

	 s.designwynum = d.designwynum and s.deleted='N' and s.designwynum = '".$DesignWyNum."'";

	

					$DesignResult = $DB->Select($SelectDesignValue, "Select_design_values", $Module);

					if(mysql_num_rows($DesignResult) > 0)

					{

						$DesignRow = mysql_fetch_object($DesignResult);

					}

	}	//<table border="0" style="border-top-style:none

	if($WyTypId!='')

	{

	$FetchABVal=$DB->FetchObject("select aval,bval from cgtcalc where wytypid='".$WyTypId."'");

	$objResponse->addScript("document.getElementById('aval').value='".$FetchABVal->aval."'");

	$objResponse->addScript("document.getElementById('bval').value='".$FetchABVal->bval."'");

	}



	//================================================================================

/*$objResponse->addAlert($WyTypId);

	return $objResponse;

*/	

	 $ResponseStr.='<table width="90%"  border=0 style="border-top-style:none" align="center" cellpadding="0" cellspacing="1">';	

	 $ResponseStr.='<tr>';

	 $ResponseStr.='<td width="16%" height="20"  align="right">LOA : </td>

		<td width="34%" height="20"><input type="text" name="length" id="length" tabindex="1" size="10" maxlength="13" 

		onChange="isNumberField(this)"

		onblur="storeArrOnChange(this.name,this.value,this.type)" value="';

		

		if($ShipRow->length!='' && $ShipRow->length>0)

			$ResponseStr.=trim($ShipRow->length);

		else

			$ResponseStr.=trim($DesignRow->length);

	 $ResponseStr.='"  tabindex="1"> m '.MANDATORYMARK.'

     </td>';

	 	 $ResponseStr.='<td width="16%" height="20" align="right">LBP : </td>

        <td width="34%" height="20"><input type="text" name="lbp" id="lbp" size="10" maxlength="13" tabindex="1"

		 onblur="storeArrOnChange(this.name,this.value,this.type)" onChange="isNumberField(this)" value="';

		

		if($ShipRow->lbp!='' && $ShipRow->lbp>0)

			$ResponseStr.=trim($ShipRow->lbp);

		else

			$ResponseStr.=trim($DesignRow->lbp);

	 $ResponseStr.='"  tabindex="1"> m 

     </td>';

	 $ResponseStr.='</tr>';

     $ResponseStr.='<tr>';

	    $ResponseStr.='<td width="16%" height="22" align="right">Draft ( Scantling ) : </td>

        <td width="34%" align="left"><input name="draft" type="text" id="draft" size="15" maxlength="11" tabindex="1" 

		onblur="storeArrOnChange(this.name,this.value,this.type)" onChange="isNumberField(this)" value="';

		if($ShipRow->draft!='' && $ShipRow->draft>0)

			$ResponseStr.=trim($ShipRow->draft);

		else

			$ResponseStr.=trim($DesignRow->draft);

	 $ResponseStr.='"> (M)

         </td>';

		  $ResponseStr.='<td width="16%" height="22" align="right">Draft (Design) : </td>

        <td width="34%" align="left" ><input name="draftdes" type="text" id="draftdes" size="15" maxlength="11" tabindex="1" 

		onblur="storeArrOnChange(this.name,this.value,this.type)" onChange="isNumberField(this)" value="';

		if($ShipRow->draftdes!='' && $ShipRow->draftdes>0)

			$ResponseStr.=trim($ShipRow->draftdes);

		else

			$ResponseStr.=trim($DesignRow->draftdes);

	 $ResponseStr.='"> (M)

         </td>';

     $ResponseStr.='</tr>';

	 

	 $AddOnBlur='';

	 if($SizeRow->sizfldnam=='dwt')

	 {

		$AddOnBlur=",document.getElementById('size').value=this.value";

	 }	



/*	  $mxDwt = 0;

	 if($MaxDwtWytypidArr[$SizeRow->wytypid] > 0)

	    $mxDwt = $MaxDwtWytypidArr[$SizeRow->wytypid];

	 else

	    $mxDwt = MAXDWT;*/



	  $mxDwt = MAXDWT;  

	  //$objResponse->addalert($mxDwt);	     

	  $ResponseStr.='<tr> 

	    <td height="20" align="right" valign="middle">DWT (on scantling draft) : </td>

        <td  align="left" valign="middle"><input name="dwt" type="text" id="dwt" size="10" maxlength="7" tabindex="1" onChange="isIntegerField(this)" 

		onBlur="ValidateMax(this,\''.intval($mxDwt).'\',\''.number_format(intval($mxDwt)).'\'),storeArrOnChange(this.name,this.value,this.type)'.$AddOnBlur.'" value="';

		

		if($ShipRow->dwt!=''  && $ShipRow->dwt>0)

			$ResponseStr.=trim($ShipRow->dwt);

		else

			$ResponseStr.=trim($DesignRow->dwt);

			

	 	  $ResponseStr.='"  tabindex="1">'.MANDATORYMARK;

          /*<label id="dwtmand" <?php if($_POST['specfldnam'] =='dwt') echo "style='display:inline;'"; else echo "style='display:none;'";?>>          </label>*/

		 $ResponseStr.='</td>';

         $ResponseStr.='<td width="16%" height="20" align="right">DWT (on design draft) : </td> 

         <td> <input name="dwtdes" type="text" id="dwtdes" onChange="isIntegerField(this)" maxlength="7" tabindex="1" 

		 onBlur="ValidateMax(this,\''.intval($mxDwt).'\',\''.number_format(intval($mxDwt)).'\'),storeArrOnChange(this.name,this.value,this.type)" 

		 value="';

		if($ShipRow->dwtdes!='' && $ShipRow->dwtdes>0)

			$ResponseStr.=trim($ShipRow->dwtdes);

		else if($DesignRow->dwtdes!='' && $DesignRow->dwtdes>0)

			$ResponseStr.=trim($DesignRow->dwtdes);

		else

		    $ResponseStr.=''; 	

	 $ResponseStr.='"> 

         </td>';

      $ResponseStr.='</tr>';

     $ResponseStr.='<tr> ';

        $ResponseStr.='<td height="20" align="right">Beam : </td>

		<td>

		<input type="text" name="breadth" id="breadth" size="30" maxlength="255" tabindex="1"

		 onblur="storeArrOnChange(this.name,this.value,this.type)" onChange="isNumberField(this)" value="';

		if($ShipRow->breadth!='' && $ShipRow->breadth !='0.00' )

			$ResponseStr.=trim($ShipRow->breadth);

		else if($DesignRow->breadth!='' && $DesignRow->breadth !='0.00')

			$ResponseStr.=trim($DesignRow->breadth);

		



	 $ResponseStr.='" tabindex="12">

          m'.MANDATORYMARK.'</td>';

        $ResponseStr.='<td height="22" align="right">Depth : </td>

        <td align="left"><input name="depth" type="text" id="depth" size="15" maxlength="11" tabindex="1" 

		onblur="storeArrOnChange(this.name,this.value,this.type)" onChange="isNumberField(this)" value="';

		if($ShipRow->depth!='' && $ShipRow->depth>0)

			$ResponseStr.=trim($ShipRow->depth);

		else

			$ResponseStr.=trim($DesignRow->depth);

	 $ResponseStr.='">

          (M) </td>';

      $ResponseStr.='</tr>';

	  

	  $AddOnBlur='';

	 if($SizeRow->sizfldnam=='gt')

		$AddOnBlur=",document.getElementById('size').value=this.value";

		

	  $ResponseStr.='<tr><td height="20" align="right" valign="middle">GT : </td>

        <td  align="left" valign="middle" colspan="3"><input type="text" name="gt" size="15" maxlength="10" tabindex="1" 

		onblur="CGTCal(this.value,document.getElementById(\'aval\').value,document.getElementById(\'bval\').value,ABValAvail,\''.$WyTypId.'\'),storeArrOnChange(this.name,this.value,this.type)'.$AddOnBlur.'" onChange="isIntegerField(this)" value="';

		if($ShipRow->gt!='' && $ShipRow->gt>0)

			$ResponseStr.=trim($ShipRow->gt);

		else

			$ResponseStr.=trim($DesignRow->gt);

	 $ResponseStr.='" tabindex="1"> ';

         /* <label id="gtmand"  <?php if($_POST['specfldnam'] =='gt') echo "style='display:inline;'"; else echo "style='display:none;'";?>> </label>*/

         $ResponseStr.=MANDATORYMARK.'</td></tr>';

      $ResponseStr.='<tr valign="middle"> 

        <td height="20" align="right">LDT : </td>

        <td  align="left"><input name="ldt" type="text" id="ldt" size="10" maxlength="10" tabindex="1" onChange="isIntegerField(this)" 

		onblur="storeArrOnChange(this.name,this.value,this.type)" value="';

		if($ShipRow->ldt!='' && $ShipRow->ldt>0)

			$ResponseStr.=trim($ShipRow->ldt);

		else

			$ResponseStr.=trim($DesignRow->ldt);

	 $ResponseStr.='">

          (MT) </td>        

		 <td  height="20" align="right">CGT : </td>

        <td ><input name="cgt" type="text" id="cgt" tabindex="1" onChange="isIntegerField(this)" maxlength="6" 

		onBlur="ValidateMax(this,\''.intval(MAXCGT).'\',\''.number_format(intval(MAXCGT)).'\'),storeArrOnChange(this.name,this.value,this.type)"

		 value="';

		if($ShipRow->cgt!=''  && $ShipRow->cgt>0)

			$ResponseStr.=trim($ShipRow->cgt);

		else

			$ResponseStr.=trim($DesignRow->cgt);

	 $ResponseStr.='"> 

          '.MANDATORYMARK.'&nbsp;<a style="cursor:hand" onClick="OpenABVal(\'\')">Click to view A and B values</a></td>

      </tr>';

       $ResponseStr.='<tr valign="middle"> 

        <td height="20" align="right">NT : </td>

        <td height="20" colspan="3" ><input name="nt" type="text" id="nt" size="10" maxlength="10" tabindex="1" 

		onblur="storeArrOnChange(this.name,this.value,this.type)" onChange="isIntegerField(this)" value="';

		if($ShipRow->nt!='' && $ShipRow->nt>0)

			$ResponseStr.=trim($ShipRow->nt);

		else

			$ResponseStr.=trim($DesignRow->nt);

	 $ResponseStr.='"></td>

      </tr>';

	  if($SpecFldNam!='gt' && $SpecFldNam!='dwt' && $SpecFldNam!='length')

	  {

	  	$Display="style='display:inline;'";

	  }

	  else

	  {

	  	$Display="style='display:none;'";

	  }

	 if($SpecFldNam=='powerhp')

	  {

	  //	$objResponse->addAlert($ShipRow->size);

	  	$objResponse->addScript("document.getElementById('powerhp').value='".$ShipRow->size."';");

		//$objResponse->addScript("document.getElementById('powerhp').disabled=false;");

	  	$OnBlur="document.getElementById('powerhp').value=this.value";

	  }	

	  else

	  	$OnBlur="storeArrOnChange(this.name,this.value,this.type)";

		

       $ResponseStr.='<tr valign="middle" id="wyshipfld"'.$Display.'> ';

       $ResponseStr.='<td height="22" align="right">Size : </td>

        <td height="22" colspan="4" align="left" valign="middle"><input type="text" name="size" size="15"

		 onblur="'.$OnBlur.'" maxlength="10"  value="';

		if($SegChange==true)

			$ResponseStr.="";

		elseif($ShipRow->size!='' && $ShipRow->size>0)

			$ResponseStr.=$ShipRow->size;

		else

			$ResponseStr.=$DesignRow->size;

			

	 $ResponseStr.='" onChange="isNumberField(this)"  tabindex="1"> ';

      /* $ResponseStr.='<input type="text" name="'.$SpecFldNam.'" size="20" value="" readonly="true" style="border-bottom-width:0; border-left-width:0; border-right-width:0; border-top-width:0; ">';*/

	  

	    $ResponseStr.='<input type="hidden" name="specfldnam" value="'.$SpecFldNam.'" tabindex="1">';

		if((count($SizNotMandatFunc)>1 && @in_array($SpecFldNam,$SizNotMandatFunc))|| $SpecFldNam==$SizNotMandatFunc[0])

					$ResponseStr.=$ShipSizeUnit.' </td>';

					

		else			

			$ResponseStr.=$ShipSizeUnit.MANDATORYMARK.' </td>';

          

      $ResponseStr.='</tr>';

	$ResponseStr.='</table>';

	//$objResponse->addAlert($ResponseStr);

	$objResponse->addAssign($FurtherDetailsdiv,"innerHTML",$ResponseStr);

	return $objResponse;

}

//=======================================================================

function SetImoNotTyp($ImoNotTypDiv,$FldNam,$ImoTypVal,$SubSegVal,$ImoClickCnt,$ShipWyNum='',$DesignWyNum='',$ColSpan='')

{

	$DB=new DBConnect();

	$objResponse = new xajaxResponse();

	$IfApplicable=false;

	$Flag=false;

	if($SubSegVal!='')

	{

			$IfAppQry="select fldnam from wyspecific where wytypid='".$SubSegVal."'";

		

			$Res=$DB->Select($IfAppQry,"Select_Applicable",$Module);

		

		

		while($Row=mysql_fetch_object($Res))

		{

			if($Row->fldnam=='imontn')

			{

				$IfApplicable=true;

				break;

			}	

		 }

	}

	

	if($ImoClickCnt==0 && $IfApplicable && $ImoTypVal=='Y' && $Flag==false)

	{

		$NewTDStr = 'TR=mainTable.insertRow();TRInd=TR.rowIndex;	TD1=TR.insertCell();TD2=TR.insertCell();TD3=TR.insertCell();TD4=TR.insertCell();';//TD1.align=right;';

		$objResponse->addScript('xajax_SetImoNotTypResponse("TR=mainTable.insertRow();TRInd=TR.rowIndex;	TD1=TR.insertCell();TD2=TR.insertCell();TD3=TR.insertCell();TD4=TR.insertCell();")');

		

	//$objResponse->addScript();

	$Flag=true;



	}

	$ResponseStr='';

	//$objResponse->addAlert($ImoClickCnt."  : ".$IfApplicable." : ".$ImoTypVal);

	if($ImoTypVal=='Y' && $ImoClickCnt==0 && $IfApplicable && $Flag==true)

		{

			if($ShipWyNum!='')	

			{	

				//echo "select imontn from shipspecific where shipwynum='".$ShipWyNum."'";

//				exit();

				

				$OptValWy=$DB->FetchObject("select imontn from shipspecific where shipwynum='".$ShipWyNum."'","select_imontn_ship",$Module);

			}

			if($DesignWyNum!='')

			{

				$OptValDesign=$DB->FetchObject("select imontn from designspecific where designwynum='".$DesignWyNum."'","select_imontn_design",$Module);

			}

			$OptQry="select fldnam,optval,optcap from optionfields where fldnam='".$FldNam."'";

			//echo $OptQry;

			//exit();

			$OptRes=$DB->Select($OptQry,'Select_option_fld',$Module);

			$ResponseStr1.="Imo Notation Type :";

			$CheckRadio='';

			if($OptValWy->imontn=='')

				$OptValWy->imontn=$OptValDesign->imontn;

			while($Row=mysql_fetch_object($OptRes))

			{

				$CheckRadio='';

				if($OptValWy->imontn==$Row->optval)

					{

					$CheckRadio='checked';

					if($OptValWy->imontn=='Y')

					$objResponse->addScript("IncDecImoClick($ImoTypVal)");

					}

				

				else if($OptValWy->imontn=='' && $OptValDesign->imontn==$Row->optval)

					{

					$CheckRadio='checked';		

					if($OptValDesign->imontn=='Y')

					$objResponse->addScript("IncDecImoClick($ImoTypVal)");

					}

					

				$ResponseStr.=" <input type=radio name='".$Row->fldnam."' value='".$Row->optval."' id='".$Row->fldnam.$Row->optval."' class=checkbox ".$CheckRadio."> &nbsp; ".$Row->optcap." &nbsp; ";

				//$objResponse->addAlert($ResponseStr);

			}

			$ResponseStr.="</td></tr></table>";

			//$objResponse->addAlert("dsfhsfhsf".$ResponseStr);

			//$objResponse->addScript("var t=setTimeout('abc()',50000);");

			

			$objResponse->addScript('TD1.insertAdjacentHTML("afterBegin","'.$ResponseStr1.'");');

			$objResponse->addScript('TD2.insertAdjacentHTML("afterBegin","'.$ResponseStr.'");');

		///	$objResponse->addAlert("show timeout");

		//$objResponse->addScript('alert("show timeout");');

			

	}

	if(($ImoTypVal=='N' || $ImoTypVal=='') && $ImoClickCnt>0)

	{

		//$objResponse->addAlert("here");

		$objResponse->addScript('mainTable.deleteRow(TRInd);');

		$objResponse->addScript("IncDecImoClick($ImoTypVal)");

		$Flag=false;

	}		

			

	return $objResponse;

}

//=====================================================

//=======================================================================

function SetImoNotTypResponse($ResponseStr1)

{

	$DB=new DBConnect();

	$objResponse = new xajaxResponse();

			

			$objResponse->addScript($ResponseStr1);

			//$objResponse->addScript('alert("'.$ResponseStr1.'");');

			//$objResponse->addScript('TD2.insertAdjacentHTML("afterBegin","'.$ResponseStr.'");');

		///	$objResponse->addAlert("show timeout");

			

			

	return $objResponse;

}

//=====================================================

function FillCommonFields($CommonFldDiv,$ShipWyNum='',$DesignWyNum='')

{	

	$DB=new DBConnect();

	$objResponse = new xajaxResponse();

	$ResponseStr='';



	if($ShipWyNum!='')

	{

		$RowShip=$DB->FetchObject("select * from ship where shipwynum='".$ShipWyNum."'","select_commomfld_ship",$Module);

	}

	if($DesignWyNum!='')

	{

		//$RowDesign=$DB->FetchObject("select * from designspecific where designwynum='".$DesignWyNum."'","select_commonfld_design",$Module);

		$RowDesign=$DB->FetchObject("select * from shipdesign s left join designspecific sp on s.designwynum = sp.designwynum where s.designwynum='".$DesignWyNum."'","select_commonfld_design",$Module);

	}

		//$objResponse->addAlert("shipwynum :".$ShipWyNum."\n designwynum :".$DesignWyNum);

//====================================



      $ResponseStr.='<table width="90%"  border=0 style="border-bottom-style:none"  align="center" cellpadding="0" cellspacing="1">'; 

      

	$ResponseStr.='<td height="22"  width="16%" align="right">Power 1: </td>

        <td height="22" colspan="2" width="34%">&nbsp;HP : 

          <input name="powerhp" type="text" id="powerhp" size="10" maxlength="10" tabindex="1"  onBlur="storeArrOnChange(this.name,this.value,this.type)" 

		  onChange="isIntegerField(this);" value="';

	  if($RowShip->powerhp!='' && $RowShip->powerhp>0)

	  		$ResponseStr.=trim($RowShip->powerhp).'">';

	  else

			$ResponseStr.=$RowDesign->powerhp.'" >';	  		

      $ResponseStr.='&nbsp;KW : 

          <input name="powerkw" type="text" id="powerkw"  size="10"  tabindex="1" onBlur="storeArrOnChange(this.name,this.value,this.type)" maxlength="10" 

		  onChange="isIntegerField(this)" value="';

	  if($RowShip->powerkw!='')

	  		$ResponseStr.=trim($RowShip->powerkw).'">';

	  else

			$ResponseStr.=trim($RowDesign->powerkw).'">';	  		

      $ResponseStr.='</td>';

	  			

       $ResponseStr.='<td height="22"  width="16%" align="right">Power 2: </td>

        <td height="22" colspan="2" width="34%">&nbsp;HP : 

          <input name="powerhp2" type="text" id="powerhp2" tabindex="1" size="10" maxlength="10"  onBlur="storeArrOnChange(this.name,this.value,this.type)" 

		  onChange="isIntegerField(this);" value="';

	  if($RowShip->powerhp2!='' && $RowShip->powerhp2>0)

	  		$ResponseStr.=trim($RowShip->powerhp2).'">';

	  else

			$ResponseStr.=$RowDesign->powerhp2.'">';	  		

      $ResponseStr.='&nbsp;KW : 

          <input name="powerkw2" type="text" id="powerkw2"  size="10"  tabindex="1" onBlur="storeArrOnChange(this.name,this.value,this.type)" 

		  maxlength="10" onChange="isIntegerField(this)" value="';

	  if($RowShip->powerkw2!='')

	  		$ResponseStr.=trim($RowShip->powerkw2).'">';

	  else

			$ResponseStr.=trim($RowDesign->powerkw2).'">';	  		

      $ResponseStr.='</td>

      </tr>';

	    $ResponseStr.='<tr valign="middle"><td colspan="6"><div id="otherenginediv" ></div>';

		$ResponseStr.='</td></tr>';

      $ResponseStr.='<tr valign="middle">';

        $ResponseStr.='<td height="20" align="right" >RPM 1: </td>

        <td height="20" colspan="2"><input name="rpm" type="text"  tabindex="1" id="rpm" size="10" maxlength="10" onChange="isIntegerField(this)"

		 onBlur="storeArrOnChange(this.name,this.value,this.type)" value="';

	  if($RowShip->rpm!='')

	  		$ResponseStr.=trim($RowShip->rpm).'">';

	  else

			$ResponseStr.=trim($RowDesign->rpm).'">';	  		

      $ResponseStr.='</td>';

	    $ResponseStr.='<td height="20" align="right" >RPM 2: </td>

        <td height="20" colspan="2"><input name="rpm2" type="text"  tabindex="1" id="rpm2" size="10" maxlength="10" onChange="isIntegerField(this)"

		 onBlur="storeArrOnChange(this.name,this.value,this.type)" value="';

	  if($RowShip->rpm2!='')

	  		$ResponseStr.=trim($RowShip->rpm2).'">';

	  else

			$ResponseStr.=trim($RowDesign->rpm2).'">';	  		

      $ResponseStr.='</td></tr>';



	   $ResponseStr.='<tr valign="middle">';

	   $ResponseStr.='<td height="20" align="right" >Speed : </td>

        <td height="20" colspan="6"><input name="speed" type="text" id="speed" size="5"  maxlength="5"  tabindex="1"

		onBlur="storeArrOnChange(this.name,this.value,this.type)" onChange="isNumberField(this)" tabindex="1" value="';

	  if($RowShip->speed!='')

	  		$ResponseStr.=trim($RowShip->speed).'">';

	  else

			$ResponseStr.=trim($RowDesign->speed).'">';	  		

		

      $ResponseStr.='</td>';

     $ResponseStr.=' </tr>';

	 	  

	  $ResponseStr.='<tr valign="middle">';

	  $ResponseStr.='<td height="20" width="16%" align="right" style="border-top-color:#FFFFFF">DD : </td>

        <td colspan="2" align="left"  width="34%"><input name="dd" type="text" id="dd" tabindex="1" onBlur="storeArrOnChange(this.name,this.value,this.type)" size="30" maxlength="250" value="';

	  if($RowShip->dd!='' && $RowShip->dd>0)

	  		$ResponseStr.=trim($RowShip->dd).'"></td>';

	  else

			$ResponseStr.=trim($RowDesign->dd).'" ></td>';	

			 

       $ResponseStr.='<td height="20" align="right">SS : </td>';

       $ResponseStr.='<td height="20" colspan="2"><input name="ss" type="text" id="ss" size="30"  tabindex="1" onBlur="storeArrOnChange(this.name,this.value,this.type)" maxlength="250" value="';

	  if($RowShip->ss!='')

	  		$ResponseStr.=trim($RowShip->ss).'">';

	  else

			$ResponseStr.=trim($RowDesign->ss).'">';	  		

      $ResponseStr.='</td></tr>';

          

	

	  $ResponseStr.='<input name="bowthr" id="bowthr" type="hidden" value="'.$RowShip->bowthr.'">';

	    

	  $ResponseStr.='<tr valign="middle"> 

        <td height="20" align="right">Bow thrusters : </td>

        <td height="20" colspan="2"><input name="bowthr" id="bowthrY" type="radio" value="Yes" class="checkbox"  

		onClick="document.getElementById(\'bowthr\').value=this.value,storeArrOnChange(this.name,this.value,this.type);" tabindex="1"' ;

		

		$Idx=0;

	//$objResponse->addAlert($RowShip->ecodesign);

		$objResponse->addScript("CommValOnLoad[".$Idx."]='".$RowShip->bowthr."'");

		$objResponse->addScript("CommFldOnLoad[".$Idx++."]='bowthr'");

		

		

		if(trim($RowShip->bowthr)=='Yes')

	  		$ResponseStr.='checked >';

	    else if(trim($RowDesign->bowthr)=='Yes')

			$ResponseStr.='checked >';	  	

		else

			$ResponseStr.=' >';		

		$ResponseStr.='Yes';

          $ResponseStr.='<input name="bowthr" id="bowthrN" type="radio" class="checkbox" 

		  onClick="document.getElementById(\'bowthr\').value=this.value,storeArrOnChange(this.name,this.value,this.type);" value="No"';

		 if(trim($RowShip->bowthr)=='No')

	  		$ResponseStr.='checked >';

	     else if(trim($RowDesign->bowthr)=='No')

			$ResponseStr.='checked >';	

		else

			$ResponseStr.='>';	  	

          $ResponseStr.='No';

		 $ResponseStr.='<input name="bowthr" type="radio" id="bowthrNA" class="checkbox" 

		 onClick="document.getElementById(\'bowthr\').value=this.value,storeArrOnChange(this.name,this.value,this.type);" value=""';

		 if(trim($RowShip->bowthr)=='')

	  		$ResponseStr.='checked >';

	     else if(trim($RowShip->bowthr)=='' && trim($RowDesign->bowthr)=='')

			$ResponseStr.='checked >';	  

		else $ResponseStr.='>';		

          $ResponseStr.='N/A</td>';

     //-------add winterization and winterization_arctic in $key--\\//---added by harendar singh ---\\ 

	 

	  $ResponseStr.='<input name="winterization" id="winterization" type="hidden" value="'.$RowShip->winterization.'">';

	    

	 /* $ResponseStr.='<tr valign="middle"> 

        <td height="20" align="right">winterization : </td>

        <td height="20" colspan="2"><input name="winterization" id="winterizationY" type="radio" value="Yes" class="checkbox"  

		onClick="document.getElementById(\'winterization\').value=this.value,storeArrOnChange(this.name,this.value,this.type);" tabindex="1"' ;

		

		$Idx=0;*/

	//$objResponse->addAlert($RowShip->ecodesign);

		$objResponse->addScript("CommValOnLoad[".$Idx."]='".$RowShip->winterization."'");

		$objResponse->addScript("CommFldOnLoad[".$Idx++."]='winterization'");

		

	 $ResponseStr.='<input name="winterization_arctic" id="winterization_arctic" type="hidden" value="'.$RowShip->winterization_arctic.'">';

	 $objResponse->addScript("CommValOnLoad[".$Idx."]='".$RowShip->winterization_arctic."'");

		$objResponse->addScript("CommFldOnLoad[".$Idx++."]='winterization_arctic'");

		

	 /*

	  if(trim($RowShip->winterization)=='Yes')

	  		$ResponseStr.='checked >';

	    else if(trim($RowDesign->winterization)=='Yes')

			$ResponseStr.='checked >';	  	

		else

			$ResponseStr.=' >';		

		$ResponseStr.='Yes';

          $ResponseStr.='<input name="winterization" id="winterizationN" type="radio" class="checkbox" 

		  onClick="document.getElementById(\'winterization\').value=this.value,storeArrOnChange(this.name,this.value,this.type);" value="No"';

		 if(trim($RowShip->winterization)=='No')

	  		$ResponseStr.='checked >';

	     else if(trim($RowDesign->winterization)=='No')

			$ResponseStr.='checked >';	

		else

			$ResponseStr.='>';	  	

          $ResponseStr.='No';

		 $ResponseStr.='<input name="winterization" type="radio" id="winterizationNA" class="checkbox" 

		 onClick="document.getElementById(\'winterization\').value=this.value,storeArrOnChange(this.name,this.value,this.type);" value=""';

		 if(trim($RowShip->winterization)=='')

	  		$ResponseStr.='checked >';

	     else if(trim($RowShip->winterization)=='' && trim($RowDesign->winterization)=='')

			$ResponseStr.='checked >';	  

		else $ResponseStr.='>';		

          $ResponseStr.='N/A</td>';*/

   //  $ResponseStr.=' </tr>';

      //$ResponseStr.='<tr valign="middle"> ';

	  

	  

	   $ResponseStr.='<input name="shagen"  id="shagen" type="hidden" value="'.$RowShip->shagen.'">';

        $ResponseStr.='<td height="20" align="right">Shaft generator : </td>

        <td height="22" colspan="2"><input name="shagen" id="shagenY" type="radio" value="Yes" 

		onClick="document.getElementById(\'shagen\').value=this.value,storeArrOnChange(this.name,this.value,this.type);" 

		class="checkbox"  tabindex="1"';

		

		$objResponse->addScript("CommValOnLoad[".$Idx."]='".$RowShip->shagen."'");

		$objResponse->addScript("CommFldOnLoad[".$Idx++."]='shagen'");

		

		

		if(trim($RowShip->shagen)=='Yes')

	  		$ResponseStr.='checked >';

	    else if(trim($RowDesign->shagen)=='Yes')

			$ResponseStr.='checked >';	  		

		else 

			$ResponseStr.='>';	

		$ResponseStr.='Yes ';



          $ResponseStr.='<input name="shagen" id="shagenN" type="radio" class="checkbox" value="No"

		  onClick="document.getElementById(\'shagen\').value=this.value,storeArrOnChange(this.name,this.value,this.type)"';

		 if(trim($RowShip->shagen)=='No')

	  		$ResponseStr.='checked >';

	    else if(trim($RowDesign->shagen)=='No')

			$ResponseStr.='checked >';	

		else	  

			$ResponseStr.='>';	

          $ResponseStr.='No';

		 $ResponseStr.='<input name="shagen" id="shagenNA" type="radio" class="checkbox" value=""

		 onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'shagen\').value=this.value" ';

		 if(trim($RowShip->shagen)=='')

	  		$ResponseStr.='checked >';

	    else if(trim($RowShip->shagen)=='' && trim($RowDesign->shagen)=='')

			$ResponseStr.='checked >';	 

		else

			$ResponseStr.='>';	 	

          $ResponseStr.='N/A</td>';

		        

        /*<!--<td height="22" align="right">Consumption : </td>

        <td align="left" colspan="2"><input name="consum" type="text" id="consum" size="6" maxlength="6" onChange="isNumberField(this)" value="<?php //echo(trim($_POST['consum']));?>">

          (MT / day) </td>-->///////////////*/ 

          

		$ResponseStr.='</tr>';

		

		

		/* add type of fuel feature */

		

		 $ResponseStr.='<input name="fueltype"  id="fueltype" type="hidden" value="'.$RowShip->fueltype.'">';

        $ResponseStr.='<tr>

		<td height="20" align="right">Types Of Fuel : </td>

        <td height="22" colspan="5">

		<input name="fueltype" id="fueltype_marine" type="radio" value="marine" 

		onClick="document.getElementById(\'fueltype\').value=this.value,storeArrOnChange(this.name,

		this.value,this.type);" 

		class="checkbox"  tabindex="1"';

		

		/*** Commented by DEEPALI GUPTA since the field is already in CommFld array***/

		

		/*$objResponse->addScript("CommValOnLoad[".$Idx."]='".$RowShip->fueltype."'");

		$objResponse->addScript("CommFldOnLoad[".$Idx++."]='fueltype'"); */

		

		if(trim($RowShip->fueltype)=='marine')

	  		$ResponseStr.='checked >';

	    else if(trim($RowDesign->fueltype)=='marine')

			$ResponseStr.='checked >';	  		

		else 

			$ResponseStr.='>';	

		$ResponseStr.='Marine Fuel Oil ';



          $ResponseStr.='<input name="fueltype" id="fueltype_natural" type="radio" class="checkbox" 

		  value="natural"

		  onClick="document.getElementById(\'fueltype\').value=this.value,storeArrOnChange(this.name,this.value,this.type)"';

		 if(trim($RowShip->fueltype)=='natural')

	  		$ResponseStr.='checked >';

	    else if(trim($RowDesign->fueltype)=='natural')

			$ResponseStr.='checked >';	

		else	  

			$ResponseStr.='>';	

          $ResponseStr.='Natural Gas as Marine Fuel';

		 $ResponseStr.='<input name="fueltype" id="fueltype_duelfuel" type="radio" class="checkbox" value="dualfuel"

		 onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'fueltype\').value=this.value" ';

		 if(trim($RowShip->fueltype)=='dualfuel')

	  		$ResponseStr.='checked >';

	    else if(trim($RowDesign->fueltype)=='dualfuel')

			$ResponseStr.='checked >';	 

		else

			$ResponseStr.='>';	 	

          $ResponseStr.='Dual Fuel';

		   $ResponseStr.='<input name="fueltype" id="fueltype_duelfuel" type="radio" class="checkbox" value="methanol"

		 onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'fueltype\').value=this.value" ';

		 if(trim($RowShip->fueltype)=='methanol')

	  		$ResponseStr.='checked >';

	    else if(trim($RowDesign->fueltype)=='methanol')

			$ResponseStr.='checked >';	 

		else

			$ResponseStr.='>';	 	

          $ResponseStr.='Methanol Fuel as Marine Fuel';    

		 $ResponseStr.='<input name="fueltype" id="fueltype_biofuel" type="radio" class="checkbox" 

		  value="biofuel"

		  onClick="document.getElementById(\'fueltype\').value=this.value,storeArrOnChange(this.name,this.value,this.type)"';

		 if(trim($RowShip->fueltype)=='biofuel')

	  		$ResponseStr.='checked >';

	    else if(trim($RowDesign->fueltype)=='biofuel')

			$ResponseStr.='checked >';	

		else	  

			$ResponseStr.='>';	

          $ResponseStr.='Biofuel as Marine Fuel';

		

		$ResponseStr.='<input name="fueltype" id="fueltype_na" type="radio" class="checkbox" value=""

		 onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'fueltype\').value=this.value" ';    

		 if(trim($RowShip->fueltype)=='')

	  		$ResponseStr.='checked >';

	    else if(trim($RowShip->fueltype)=='' && trim($RowDesign->fueltype)=='')

			$ResponseStr.='checked >';	 

		else

			$ResponseStr.='>';	 	

          $ResponseStr.='N/A</td>';			   

        /*<!--<td height="22" align="right">Consumption : </td>

        <td align="left" colspan="2"><input name="consum" type="text" id="consum" size="6" maxlength="6" onChange="isNumberField(this)" value="<?php //echo(trim($_POST['consum']));?>">

          (MT / day) </td>-->///////////////*/

          

		$ResponseStr.='</tr>';

		

		/* end of this feature */	 

		

	 $subtrstyle = $lngengine = $tfde = $gt = $d = $dfe = $st = $cng ='';

	 if(trim($RowShip->typpropul)=='st' )

	 {

	 	$st = " checked ";

	 	$subtrstyle = "style='display:none;'";

	 }

	 else if(trim($RowShip->typpropul)=='dfe')

	 {

	 	$dfe = " checked ";

	 	$subtrstyle = "style='display:none;'";

	 }

	 

	 else if(trim($RowShip->typpropul)=='d' )

	 {

	 	$d = " checked ";

	 	$subtrstyle = "style='display:none;'";

	 }

	 else if(trim($RowShip->typpropul)=='gt')

	 {

	 	$gt = " checked ";

	 	$subtrstyle = "style='display:none;'";

	 }

	 else if(trim($RowShip->typpropul)=='tfde')

	 {

	 	$tfde = " checked ";

	 	$subtrstyle = "style='display:none;'";

	 }

	 else if(trim($RowShip->typpropul)=='lngengine')

	 {

	 	$lngengine = " checked ";

	 	$subtrstyle = "style='display:inline;'";

	 }

	  else if(trim($RowShip->typpropul)=='cng')

	 {

	 	$cng = " checked ";

	 	$subtrstyle = "style='display:none;'";

	 }

	 else if(trim($RowShip->typpropul)=='')

	 {

	 	$na = " checked ";

	 	$subtrstyle = "style='display:none;'";

	 }

 				

					

		$ResponseStr.='<tr><td align="right">Type of Propulsion</td> 

		                   <td colspan=5> 

		                   <input type="hidden" name="typpropul" id="typpropul" value="" />

		                   

		                   <input type="radio" name="typpropul" id="typpropulst" class="checkbox" '.$st.' value="st" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'typpropulst\').value=this.value,document.getElementById(\'lngretrofitTR\').style.display=\'none\'"/> Steam Turbine &nbsp;

		                    

		                   <input type="radio" name="typpropul" id="typpropuldfe" class="checkbox" '.$dfe.' value="dfe" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'typpropuldfe\').value=this.value,document.getElementById(\'lngretrofitTR\').style.display=\'none\'"/> Dual Fuel Diesel Electric &nbsp;

		                   

		                   <input type="radio" name="typpropul" id="typpropuld" class="checkbox" '.$d.' value="d" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'typpropuld\').value=this.value,document.getElementById(\'lngretrofitTR\').style.display=\'none\'"/> Diesel &nbsp;

		                   

		                   <input type="radio" name="typpropul" id="typpropulgt" class="checkbox" '.$gt.' value="gt" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'typpropulgt\').value=this.value,document.getElementById(\'lngretrofitTR\').style.display=\'none\'"/> Gas Turbine &nbsp;

		                   

		                   <input type="radio" name="typpropul" id="typpropultfde" class="checkbox" '.$tfde.' value="tfde" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'typpropultfde\').value=this.value,document.getElementById(\'lngretrofitTR\').style.display=\'none\'"/> TFDE &nbsp;

		                   

		                   <input type="radio" name="typpropul" id="typpropullngengine" class="checkbox" '.$lngengine.' value="lngengine" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'typpropullngengine\').value=this.value,document.getElementById(\'lngretrofitTR\').style.display=\'inline\'"/> LNG Engine &nbsp;

						   

						   <input type="radio" name="typpropul" id="typpropulcng" class="checkbox" '.$cng.' value="cng" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'typpropulcng\').value=this.value,document.getElementById(\'lngretrofitTR\').style.display=\'inline\'"/> CNG engine &nbsp;

		                   

		                   <input type="radio" name="typpropul" id="typpropulNA" class="checkbox" '.$na.' value="" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'typpropulNA\').value=this.value,document.getElementById(\'lngretrofitTR\').style.display=\'none\'"/> N/A &nbsp;		                   

		                   </td>

		               </tr>';



	

		

		/*=========================================

			 $fueltype = $marine = $natural = $dualfuel ='';

	 if(trim($RowShip->fueltype)=='marine')

	 {

	 	$marine = " checked ";

	 	$fueltype = "style='display:none;'";

	 }

	 else if(trim($RowShip->fueltype)=='natural')

	 {

	 	$natural = " checked ";

	 	$fueltype = "style='display:none;'";

	 }

	  else if(trim($RowShip->fueltype)=='dualfuel')

	 {

	 	$dualfuel = " checked ";

	 	$fueltype = "style='display:none;'";

	 }

	 else if(trim($RowShip->fueltype)=='' )

	 {

	 	$na = " checked ";

	 	$fueltype = "style='display:none;'";

	 }

					

		$ResponseStr.='<tr><td align="right">Fuel Type</td> 

		                   <td colspan=5> 

		                   <input type="hidden" name="fueltype" id="fueltype" value="" />

		                   

		                   <input type="radio" name="fueltype" id="fueltype_marine" class="checkbox" '.$marine.' value="marine" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'fueltype_marine\').value=this.value,document.getElementById(\'lngretrofitTR\').style.display=\'none\'"/> Marine Fuel Oil &nbsp;

						    <input type="radio" name="fueltype" id="fueltype_natural" class="checkbox" '.$natural.' value="natural" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'fueltype_natural\').value=this.value,document.getElementById(\'lngretrofitTR\').style.display=\'none\'"/> Natural Gas as Marine Fuel &nbsp;

		                    

		                   <input type="radio" name="fueltype" id="fueltype_dualfuel" class="checkbox" '.$dualfuel.' value="dualfuel" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'fueltype_dualfuel\').value=this.value,document.getElementById(\'lngretrofitTR\').style.display=\'none\'"/> Dual Fuel &nbsp;

		   <input type="radio" name="fueltype" id="fueltype_na" class="checkbox" '.$na.' value="" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'fueltypeNA\').value=this.value,document.getElementById(\'lngretrofitTR\').style.display=\'none\'"/> N/A &nbsp;		                   

		                   </td>

		               </tr>';

          

		  

			

		/*=========================================*/

		//Below Added by bajrang on 07 july 2013 according to message number 66729.		

		 $na = $N = $Y ='';

		 if(trim($RowShip->lngretrofit)=='Y' )

		 	$Y = " checked ";

		 else if(trim($RowShip->lngretrofit)=='N')

		 	$N = " checked ";

		 else

		 	$na = " checked ";

	 	

		$ResponseStr.='<tr id="lngretrofitTR" '.$subtrstyle.'>

		                   <td align="right">LNG Retrofit</td> 

		                   <td colspan=5> 



		                   <input type="hidden" name="lngretrofit" id="lngretrofit" value="" />

		                   

		                   <input type="radio" name="lngretrofit" id="lngretrofitY" class="checkbox" '.$Y.' value="Y" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'typpropulY\').value=this.value"/> Yes &nbsp;

		                    

		                   <input type="radio" name="lngretrofit" id="lngretrofitN" class="checkbox" '.$N.' value="N" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'lngretrofitN\').value=this.value"/> No &nbsp;

		                   

		                   <input type="radio" name="lngretrofit" id="lngretrofitNA" class="checkbox" '.$na.' value="" 

		                   onClick="storeArrOnChange(this.name,this.value,this.type),document.getElementById(\'lngretrofitNA\').value=this.value"/> N/A &nbsp;

		                   </td>

		               </tr>';		

 //======================ADDED BY TEENA ON 16 TH AUG 2006====================    //

 

	 $ResponseStr.='<tr>

	  	<td height="20" colspan="7">&nbsp;&nbsp;Consumption at Sea</td>

	</tr>';	

	 $ResponseStr.='<tr>

		 <td height="22" align="right">Main Engine : </td>

        <td align="left" colspan="2" ><input name="consum" type="text" id="consum"  size="6"  maxlength="6" 

		onBlur="storeArrOnChange(this.name,this.value,this.type)" tabindex="1" value="';

	  if($RowShip->consum!='')

	  		$ResponseStr.=($RowShip->consum).'"';

	  else

			$ResponseStr.=($RowDesign->consum).'"';	  		

      $ResponseStr.='onChange="isNumberField(this)">

          (MT / day) </td>';

	 $ResponseStr.='<td height="22" align="right">Fuel Grade ( Main Engine ) : </td>

        <td align="left" colspan="2"><input name="seamainfuelgrad" type="text" size="6"  maxlength="6" 

		onBlur="storeArrOnChange(this.name,this.value,this.type)" id="seamainfuelgrad"  tabindex="1" value="';

	  if($RowShip->seamainfuelgrad!='')

	  		$ResponseStr.=($RowShip->seamainfuelgrad).'"></td>';

	  else

			$ResponseStr.=($RowDesign->seamainfuelgrad).'"></td>';	  		

      $ResponseStr.='</tr>';

	  $ResponseStr.='<tr>

		 <td height="22" align="right">Auxiliary Engine : </td>

        <td align="left" colspan="2" ><input name="seaaux" type="text" 

		onBlur="storeArrOnChange(this.name,this.value,this.type)" id="seaaux"  tabindex="1" size="6"  maxlength="6"  value="';

	  if($RowShip->seaaux!='')

	  		$ResponseStr.=($RowShip->seaaux).'"';

	  else

			$ResponseStr.=($RowDesign->seaaux).'"';	  		

      $ResponseStr.='onChange="isNumberField(this)">

          (MT / day) </td>

		<td height="22" align="right">Fuel Grade ( Auxiliary Engine ) : </td>

        <td align="left" colspan="2"><input name="seaauxfuelgrad" type="text" id="seaauxfuelgrad"  tabindex="1"

		 onBlur="storeArrOnChange(this.name,this.value,this.type)" value="';

	  if($RowShip->seaauxfuelgrad!='')

	  		$ResponseStr.=($RowShip->seaauxfuelgrad).'">';

	  else

			$ResponseStr.=($RowDesign->seaauxfuelgrad).'">';	  		

      $ResponseStr.='</td> 

	  </tr>';

	 $ResponseStr.='<tr>

	  	<td height="20" colspan="7">&nbsp;&nbsp;Consumption in Port</td>

	</tr>';

		

	 $ResponseStr.='<tr>

		 <td height="22" align="right">Main Engine : </td>

        <td align="left" colspan="2" ><input name="portmain" type="text" id="portmain" size="6"  maxlength="6" 

		 onBlur="storeArrOnChange(this.name,this.value,this.type)" tabindex="1" value="';

	  if($RowShip->portmain!='')

	  		$ResponseStr.=($RowShip->portmain).'">';

	  else

			$ResponseStr.=($RowDesign->portmain).'">';	  		

      $ResponseStr.=' (MT / day)</td>';

		 $ResponseStr.='<td height="22" align="right">Fuel Grade ( Main Engine ) : </td>

        <td align="left" colspan="2"><input name="portmainfuelgrad" type="text" id="portmainfuelgrad"  tabindex="1" size="6"  maxlength="6" 

		 onBlur="storeArrOnChange(this.name,this.value,this.type)" value="';

	  if($RowShip->portmainfuelgrad!='')

	  		$ResponseStr.=($RowShip->portmainfuelgrad).'">';

	  else

			$ResponseStr.=($RowDesign->portmainfuelgrad).'">';	  		

      $ResponseStr.='</td> 

	  </tr>';

	  $ResponseStr.='<tr>

		 <td height="22" align="right" >Auxiliary Engine : </td>

        <td align="left" colspan="2" ><input name="portaux" type="text" id="portaux" tabindex="1" size="6"  maxlength="6" 

		onBlur="storeArrOnChange(this.name,this.value,this.type)" value="';

	  if($RowShip->portaux!='')

	  		$ResponseStr.=($RowShip->portaux).'">';

	  else

			$ResponseStr.=($RowDesign->portaux).'">';	  		

      $ResponseStr.=' (MT / day) </td>';

		 $ResponseStr.='<td height="22" align="right">Fuel Grade ( Auxiliary Engine ) : </td>

        <td align="left" colspan="2"><input name="portauxfuelgrad" type="text" id="portauxfuelgrad"

		onBlur="storeArrOnChange(this.name,this.value,this.type)" tabindex="1" value="';

	  if($RowShip->portauxfuelgrad!='')

	  		$ResponseStr.=($RowShip->portauxfuelgrad).'">';

	  else

			$ResponseStr.=($RowDesign->portauxfuelgrad).'">';	  		

      $ResponseStr.='</td> 

	  </tr></table>';

	 

	  $objResponse->addAssign($CommonFldDiv,'innerHTML',$ResponseStr);



	  $objResponse->addScript("getmoreEngine('$RowShip->numofengine');");

	

	  return $objResponse;

}

/*=========================================================================

Function to display comhistory of the ship

=====================================================================*/

function ShowComhistory($ComHistorydiv,$ShipWyNum)

{

	$DB=new DBConnect();

	$objResponse = new xajaxResponse();

	$ResponseStr='';

	

	$ComhistoryQry= "select * from development where objwynum='".$ShipWyNum."' and deleted='N'

	 order by devdat desc";

	//$objResponse->addAlert($ComhistoryQry);

	//$objResponse->addAlert($ComhistoryQry);

			//return $objResponse;

	

	

	$ComRes=$DB->Select($ComhistoryQry,"select_comhistory",$Module);

	$ResponseStr.='<table width="100%" border="0" style="border-top:none;border-right:none" cellspacing="1" cellpadding="0">



      <tr> 



        <td height="20" colspan="8" align="left">Commercial 



          history :</td>



      </tr>



      <tr> 



        <th width="5%" height="20">S. no</th>



        <th width="8%">Date</th>



        <th width="15%">For</th>



        <th width="52%">Details</th>



        <th width="10%">Entered by</th>



       

      </tr>';

			$CHCounter = 1;



			while($DevRow = @mysql_fetch_object($ComRes))



			{



			if($CHCounter==1)

			{

				$DevFor=$DevRow->devfor;

			}

			$ResponseStr.='<tr > 



        <td height="20" align="center">'.($CHCounter++).'</td>';



        $ResponseStr.='<td  align="center">'.ConvertDate($DevRow->devdat).'</td>';



        $ResponseStr.='<td align="center">'.$DevRow->devfor.'</td>';



        $ResponseStr.='<td >'.($DevRow->devdesc).'</td>';



        $ResponseStr.='<td align="center">'.($DevRow->enteredby).'</td>



        </tr>';



      

		}

    $ResponseStr.='</table>';

	/*$ShipNamCheckQry="select s.shipnam from ship s left join shipformername sf on s.shipwynum=sf.shipwynum and 

	s.deleted='N' where s.shipwynum='".$ShipWyNum."' and sf.shipwynum is null and s.shipnam=''";*/

	if($DevFor=='Resale')

	{

			 $ShipNamCheckQry="select resale.resaleid,shipnewnam from resale join (select max(resaleid) as resaleid from resale where

			 shipwynum='".$ShipWyNum."' and 

			deleted='N')as maxresale on resale.resaleid=maxresale.resaleid and shipnewnam=''"; 

			//$objResponse->addAlert($ComhistoryQry);

			//return $objResponse;

			$ResNamCheck=$DB->Select($ShipNamCheckQry,"shipname_check",$Module);

			

			

			if(mysql_num_rows($ResNamCheck)>0)

			{

				$objResponse->addConfirmCommands(1,"The new ship name is not added yet.Would you like to add shipname");

				//====alert for ship name	

				

				$objResponse->addScript("document.getElementById('newresalenamflag').value=true;");

				$objResponse->addScript("document.getElementById('shipnam').focus();");

				

			}	

	}

	$objResponse->addScript("document.getElementById('comhistorydiv').style.display='inline';");

	$objResponse->addAssign($ComHistorydiv,'innerHTML',$ResponseStr);

	return $objResponse;

}

//============================================================

/* function to store values of js array into php array*/

/*==================================================================

@	Function Name			 :			StorePrevValues

@	PurPose					 :			store values of js array stored at loading time or on change event of various controls

										into php array

Parameters

@	JsPrevFurtFldArr		 :			Array containing collection of name of fields coming under further details section at 

										loading time 

@	JsPrevFurtValArr		 :			Array containing collection of values of fields coming under further details section at 

										loading time 

@	JsPrevSpecFldArr		 :			Array containing collection of fields coming under specific fields section at 

										loading time 

@	JsPrevSpecValArr		 :			Array containing collection of values of fields coming under specific fields section at 

										loading time 

@	JsPrevCommFldArr		 :			Array containing collection of  fields coming under Common fields section at 

										loading time 

@	JsPrevCommValArr		 :			Array containing collection values of  fields coming under Common fields section at 

										loading time										

@	ChangedFldNam			 :			Array containing collection of  fields changed manully by the user



@	ChangedFldVal			 :			Array containing collection values of  fields changed manully by the user		

									

@ Calling Module			 :	 		On change events of various Ship Add/Edit controls

//==================================================================*/

//============================================================



/*

 * Changes with eedi and eeoi columns are done by bajrang acording to mail number 58744.

 * Please read the Message Number: 55963, before changing anything in this function.

 * */





    function StorePrevValues($JsPrevFurtFldArr, $JsPrevFurtValArr, $JsPrevSpecFldArr, $JsPrevSpecValArr, $JsPrevCommFldArr, $JsPrevCommValArr, $ChangedFldNam, $ChangedFldVal, $DesignWyNum, $WyTypId, $ShipWyNum = '', $OnKeyPress = '')

    {

        $ObjResponse = new xajaxResponse();

        $DB          = new DBConnect();

        

        $SpecPrevArr   = array(); //=============Associative array for specific fields to be filled containing fld name as key and fld value as value

        $FurPrevArr    = array(); //=============Associative array for further details 

        $CommPrevArr   = array(); //=============Associative array for common fields

        $ChangedValArr = array(); //=============Associative array for fields changed manully

        $SpecSize      = GetSizeUnitName($WyTypId, 'C'); //==============get subsegment's size field

        $ChangeSubSeg  = false;

     

        

  // $ObjResponse->addAlert(print_r($ChangedFldVal));

     

        //=================fields strings to be used in query

        $FurFld  = '';

        $SpecFld = '';

        $CommFld = '';

        //==============================================

        if ($ShipWyNum != '')

        {

            $PrevSubSeg = $DB->FetchObject("select wytypid from ship where shipwynum='" . $ShipWyNum . "'");

            

            if ($WyTypId != $PrevSubSeg->wytypid)

            {

                //$ObjResponse->addAlert("select fldnam from shiptype where wytypid='".$WyTypId."'");

                $NewSize      = $DB->FetchObject("select sizfldnam from shiptype where wytypid='" . $WyTypId . "'");

                $NewSizFld    = $NewSize->sizfldnam;

                //$ObjResponse->addAlert($NewSizFld);

                $ChangeSubSeg = true;

                //$ChangeSubSebaj = 'SubSegchanged';

            } //$WyTypId != $PrevSubSeg->wytypid

            else

                $ChangeSubSeg = false;

            

            

        } //$ShipWyNum != ''

        

        foreach ($JsPrevFurtValArr as $Key => $Val)

        {

            $FurFld .= $JsPrevFurtFldArr[$Key] . ",";

            $FurPrevArr[$JsPrevFurtFldArr[$Key]] = $Val; //==============stores loadtime further details	

            

        } //$JsPrevFurtValArr as $Key => $Val

        

        foreach ($JsPrevSpecValArr as $Key => $Val)

        {

            $SpecFld .= $JsPrevSpecFldArr[$Key] . ",";

          //  $ObjResponse->addAlert($JsPrevSpecFldArr[$Key]." : store prev Spec fields : ".$Val);

            $SpecPrevArr[$JsPrevSpecFldArr[$Key]] = $Val; //==============stores loadtime specific details

        } //$JsPrevSpecValArr as $Key => $Val

        

        foreach ($JsPrevCommValArr as $Key => $Val)

        {

       

      //$ObjResponse->addAlert($JsPrevCommFldArr." : Arr Load and  : ".$Val);

           // $CommPrevArr[$JsPrevCommFldArr[$Key]] = $Val; //==============stores loadtime common fields] /// comment by harendar according to msg no. 78714 (For Common fields, Do not overwrite)

			

            if($JsPrevCommFldArr[$Key] == 'typpropul')

            	$CommFld .= '';//s.'.$JsPrevCommFldArr[$Key] . ",";

            else

            	$CommFld .= $JsPrevCommFldArr[$Key] . ",";

				

/*				if($JsPrevCommFldArr[$Key] == 'fueltype')

            	$CommFld .= '';//s.'.$JsPrevCommFldArr[$Key] . ",";

            else

            	$CommFld .= $JsPrevCommFldArr[$Key] . ",";*/

        } 

		

		

		//$JsPrevCommValArr as $Key => $Val

        //$CommFld=substr($CommFld,0,strlen($CommFld)-1);//====remove trailing comma

 

      /* foreach ($CommPrevArr as $Key => $Val)

        {

            //if($Key == 'eedi' || $Key == 'ecodesign' ||$Key == 'typpropul')

			$ObjResponse->addAlert($Key." : Arr Load and  : ".$Val); 	

        }

           */   

        foreach ($ChangedFldVal as $Key => $Val)

        {

		//$ObjResponse->addAlert($Key." : Arr Load and  : ".$Val);

            $ChangedValArr[$ChangedFldNam[$Key]] = $Val; //=================stores values changed manually in an associative array 	

        } 

       // $ObjResponse->addAlert(print_r($ChangedValArr));

        

        $SelectFld = $FurFld . $SpecFld . $CommFld; //==============select string for query

        $SelectFld = substr($SelectFld, 0, strlen($SelectFld) - 1);

        

        	//$ObjResponse->addAlert(print_r($CommFld));

        

        /*$Query="select ".$SelectFld."

        from shipdesign as s, designspecific as d where s.designwynum = d.designwynum

        and s.deleted='N' and 	s.designwynum = '".$DesignWyNum."'";

        $ObjResponse->addAssign('descombodiv','innerHTML',$Query);

        return $ObjResponse;*/

        

        $ArrOpt = array(); //===========array containing all the option values in specific fields

        if ($DesignWyNum != '') //================prevents query failure

        {

            $DesignQry = $DB->FetchObject("select " . $SelectFld . ",s.polarclass,s.polarclasstype,s.typpropul,s.fueltype,enginemak3,enginetyp3,enginemak4,enginetyp4,enginemak5,enginetyp5,enginemak6,enginetyp6,enginemak7,enginetyp7,enginemak8,enginetyp8,powerhp3,powerkw3,powerhp4,powerkw4,powerhp5,powerkw5,powerhp6,powerkw6,powerhp7,powerkw7,powerhp8,powerkw8

		from shipdesign as s, designspecific as d where s.designwynum = d.designwynum

		and s.deleted='N' and 	s.designwynum = '" . $DesignWyNum . "'", "Get_DesignVal", $Module);

        } //$DesignWyNum != ''

		

        $SpecOpt = "select fldnam,isopt from wyspecific where wytypid='" . $WyTypId . "'"; //=query to find applicable option fields

     /* $ObjResponse->addAlert("select " . $SelectFld . ",s.polarclass,s.polarclasstype,s.typpropul,s.fueltype,enginemak3,enginetyp3,enginemak4,enginetyp4,enginemak5,enginetyp5,enginemak6,enginetyp6,enginemak7,enginetyp7,enginemak8,enginetyp8,powerhp3,powerkw3,powerhp4,powerkw4,powerhp5,powerkw5,powerhp6,powerkw6,powerhp7,powerkw7,powerhp8,powerkw8

		from shipdesign as s, designspecific as d where s.designwynum = d.designwynum

		and s.deleted='N' and 	s.designwynum = '" . $DesignWyNum . "'", "Get_DesignVal", $Module);*/

        $SpecOptQry = $DB->Select($SpecOpt, "GetOptFld", $Module);

        while ($Row = mysql_fetch_object($SpecOptQry))

        {

            if ($Row->isopt == 'Y')

                $ArrOpt[$Row->fldnam] = $Row->isopt; //============load option fields

        } //$Row = mysql_fetch_object($SpecOptQry)

        

        $ParQry = "select fldnam,superheading from wyspecific where wytypid='" . $WyTypId . "' and enabled='Y' 

				and fldnam in (select distinct parentfld from wyspecific where  wytypid='" . $WyTypId . "' and parentfld!='' and parentfld is not null)

				and superheading!='' and  superheading is not null";

        

        $ResParQry = $DB->Select($ParQry, "get_par_only", $Module);

        while ($RowPar = mysql_fetch_object($ResParQry))

        {

            $ParentLab[$RowPar->fldnam] = $RowPar->superheading;

        } //$RowPar = mysql_fetch_object($ResParQry)

        $ParChildQry = "select fldnam,isopt,parentfld,superheading from wyspecific where wytypid='" . $WyTypId . "' and enabled='Y' 

						and parentfld!='' and parentfld is not null order by parentfld,fldsrnum";

        

        $ResPCQry  = $DB->Select($ParChildQry, "get_parchild_forchange", $Module);

        $PreFldPar = '';

        $ParIdx;

        while ($RowPC = mysql_fetch_object($ResPCQry))

        {

            if ($PreFldPar != $RowPC->fldnam)

            {

                $ParentArr[$RowPC->fldnam] = $RowPC->parentfld;

                $IdxArr[$ParIdx]           = $RowPC->parentfld;

            } //$PreFldPar != $RowPC->fldnam

            $ChildArr[$RowPC->fldnam] = $RowPC->fldnam;

            if (!@array_key_exists($RowPC->parentfld, $ParentLab))

                $ChildLab[$RowPC->fldnam] = $RowPC->superheading;

            

            $PreFldPar = $RowPC->fldnam;

            

        } //$RowPC = mysql_fetch_object($ResPCQry)

        //============================================================

        

        foreach ($FurPrevArr as $Key => $Val) //===========fill further details

        {

            //$ObjResponse->addAlert("Now is size:".$Key);

            if ($DesignWyNum != '') //IF DISIGN COMBO WILL BE CHANGED THEN FILL FURTHER DETAILS ACCORDINGLY TO DB.

                $Val = '';

            

            if (@array_key_exists($Key, $ChangedValArr) && $ChangedValArr[$Key] != '' && $ChangedValArr[$Key] != '0' && $ChangedValArr[$Key] != 0)

            {

                $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . ($ChangedValArr[$Key]) . "'");

                if ($Key == 'gt' && $ChangedValArr[$Key] != '')

                {

                    $ObjResponse->addScript("if(document.getElementById('aval').value!='' && document.getElementById('bval').value!='') ABValAvail=true;");

                    $ObjResponse->addScript("CGTCal('" . $ChangedValArr[$Key] . "',document.getElementById('aval').value,document.getElementById('bval').value,ABValAvail,'" . $WyTypId . "');");

                } //$Key == 'gt' && $ChangedValArr[$Key] != ''

            } 

            

            else if ($Val != '' && $Val != '0')

            {

                if ($Key == 'size' && $ChangeSubSeg == true)

                {

                    //$ObjResponse->addAlert("Now is size:".$Key);

                    $ObjResponse->addScript("document.getElementById('" . $Key . "').value=document.getElementById('" . $NewSizFld . "').value");

                } //$Key == 'size' && $ChangeSubSeg == true

                else if ($Key == 'cgt')

                    $ObjResponse->addScript("CGTCal(document.getElementById('gt').value,document.getElementById('aval').value,document.getElementById('bval').value,'" . $WyTypId . "')");

                else

                    $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . ($Val) . "'");

            } //$Val != '' && $Val != '0'

            else

            {

                //$ObjResponse->addAlert("further : ".$Key."  :  ".$DesignQry->$Key);

                $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . ($DesignQry->$Key) . "'");

                if ($Key == 'gt' && $DesignQry->$Key != '')

                    $ObjResponse->addScript("CGTCal('" . $DesignQry->$Key . "',document.getElementById('aval').value,document.getElementById('bval').value,'" . $WyTypId . "')");

            }

            

        } //$FurPrevArr as $Key => $Val

        

        foreach ($SpecPrevArr as $Key => $Val)

        {

            /*if($DesignWyNum!='')//IF DISIGN COMBO WILL BE CHANGED THEN FILL FURTHER DETAILS ACCORDINGLY TO DB.

            $Val = '';*/

            if (@array_key_exists($Key, $ArrOpt))

            {

                if (@array_key_exists($Key, $ChangedValArr) && $ChangedValArr[$Key] != '')

                //if(@array_key_exists($Key,$ChangedValArr))

                {

                    $ConcatId = '';

                    if ($ChangedValArr[$Key] == '')

                        $ConcatId = 'n/a';

                    else

                        $ConcatId = $ChangedValArr[$Key];

                    

                    //$ObjResponse->addScript("alert('".$Key.$ConcatId."'+document.getElementById('".$Key.$ConcatId."').checked)");

                    

                    /*if($Key=='imotyp' && $ChangedValArr[$Key]=='Y' && array_key_exists('imontn',$ArrOpt))

                    {

                    	$ObjResponse->addScript('document.getElementById("imontntr").style.display="inline",ImoClickCount=1;');	

                    }*/

                    

                    if (@in_array($Key, $ParentArr) && $ChangedValArr[$Key] == 'Y')

                    {

                        if (@is_array($IdxArr))

                            $ParentIdx = @array_search($Key, $IdxArr);

                        else

                            $ParentIdx = $IdxArr[0];

                        $Child = @array_keys($ParentArr, $Key);

                        /*$ObjResponse->addScript('document.getElementById("'.array_keys($ParentArr,$Key).'tr").style.display="none",ParentFldCnt['.$ParentIdx.']=0,

                        document.getElementById("'.array_keys($ParentArr,$Key).'hid").value="";');	*/

                        if (isset($Child) && count($Child) > 1)

                        {

                            foreach ($Child as $CK => $CV)

                            {

                                //if($CK%2==0)

                                {

                                    $ObjResponse->addScript('if(document.getElementById("' . $CV . 'tr")!=null)

										document.getElementById("' . $CV . 'tr").style.display="inline";');

                                    

                                    $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$CV] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$CV] . 'tr").style.display="inline";');

                                }

                                //$ObjResponse->addScript('document.getElementById("'.$CV.'hid").value="";');	

                                $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=0');

                            } //$Child as $CK => $CV

                        } //isset($Child) && count($Child) > 1

                        else if (isset($Child))

                        {

                            //$ObjResponse->addAlert($Child[0]);

                            $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'tr").style.display="inline"');

                            $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$Child[0]] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$Child[0]] . 'tr").style.display="inline";');

                            

                            //$ObjResponse->addScript('document.getElementById("'.$Child[0].'hid").value="";');	

                            $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=0');

                        } //isset($Child)

                    } //@in_array($Key, $ParentArr) && $ChangedValArr[$Key] == 'Y'

                    

                    /*else if(in_array($Key,$ParentArr) && $ChangedValArr[$Key]=='N')//===tobe checked

                    {

                    if(is_array($IdxArr))

                    $ParentIdx=array_search($Key,$IdxArr);

                    else

                    $ParentIdx=$IdxArr[0];

                    $ObjResponse->addScript('document.getElementById("'.array_keys($ParentArr,$Key).'hid").value=""');	

                    }*/

                    $ObjResponse->addScript("document.getElementById('" . $Key . $ConcatId . "').checked=true;");

                    

                    

                } //@array_key_exists($Key, $ChangedValArr) && $ChangedValArr[$Key] != ''

                else if (@array_key_exists($Key, $ChangedValArr) && $ChangedValArr[$Key] == '')

                {

                    //$ObjResponse->addAlert("here");

                    if ($DesignQry->$Key != '')

                    {

                        if (@in_array($Key, $ParentArr) && $DesignQry->$Key == 'Y')

                        {

                            if (@is_array($IdxArr))

                                $ParentIdx = @array_search($Key, $IdxArr);

                            else

                                $ParentIdx = $IdxArr[0];

                            $Child = @array_keys($ParentArr, $Key);

                            //$ObjResponse->addScript('document.getElementById("'.array_keys($ParentArr,$Key).'tr").style.display="none",ParentFldCnt['.$ParentIdx.']=0,

                            //document.getElementById("'.array_keys($ParentArr,$Key).'hid").value="";');	

                            if (isset($Child) && count($Child) > 1)

                            {

                                foreach ($Child as $CK => $CV)

                                {

                                    //if($CK%2==0)

                                    {

                                        $ObjResponse->addScript('if(document.getElementById("' . $CV . 'tr")!=null)

									             document.getElementById("' . $CV . 'tr").style.display="inline";');

                                        $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$CV] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$CV] . 'tr").style.display="inline";');

                                        

                                    }

                                    if (@array_key_exists($CV, $ArrOpt))

                                    {

                                        $ObjResponse->addScript('document.getElementById("' . $CV . 'hid").value="' . $DesignQry->$CV . '";');

                                        if ($DesignQry->$CV != '')

                                            $ObjResponse->addScript('document.getElementById("' . $CV . $DesignQry->$CV . '").checked=true;');

                                    } //@array_key_exists($CV, $ArrOpt)

                                    else

                                    {

                                        $ObjResponse->addScript('document.getElementById("' . $CV . '").value="' . utf8_encode($DesignQry->$CV) . '";');

                                    }

                                    

                                    

                                } //$Child as $CK => $CV

                            } //isset($Child) && count($Child) > 1

                            else if (isset($Child))

                            {

                                $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'tr").style.display="inline"');

                                

                                $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$Child[0]] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$Child[0]] . 'tr").style.display="inline";');

                                

                                if (@array_key_exists($Child[0], $ArrOpt))

                                {

                                    $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'hid").value="' . $DesignQry->$Child[0] . '";');

                                    if ($DesignQry->$Child[0] != '')

                                        $ObjResponse->addScript('document.getElementById("' . $Child[0] . $DesignQry->$Child[0] . '").checked=true;');

                                    

                                } //@array_key_exists($Child[0], $ArrOpt)

                                else

                                    $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'hid").value="' . utf8_encode($DesignQry->$Child[0]) . '";');

                                

                            } //isset($Child)

                            $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=0');

                        } //@in_array($Key, $ParentArr) && $DesignQry->$Key == 'Y'

                        $ObjResponse->addScript("document.getElementById('" . $Key . $DesignQry->$Key . "').checked=true");

                    } //$DesignQry->$Key != ''

                    else

                        $ObjResponse->addScript("document.getElementById('" . $Key . "n/a').checked=true");

                } //@array_key_exists($Key, $ChangedValArr) && $ChangedValArr[$Key] == ''

                else if (@array_key_exists($Key, $ParentArr) && !@array_key_exists($Key, $ChangedValArr) && @array_key_exists($ParentArr[$Key], $ChangedValArr))

                {

                    //$ObjResponse->addAlert($Key."  :  ".$Val." parent Present ");

                    if ($ChangedValArr[$ParentArr[$Key]] == 'N' || $ChangedValArr[$ParentArr[$Key]] == '')

                    {

                        if (@is_array($IdxArr))

                            $ParentIdx = @array_search($Key, $IdxArr);

                        else

                            $ParentIdx = $IdxArr[0];

                        $Child = @array_keys($ParentArr, $Key);

                        /*$ObjResponse->addScript('document.getElementById("'.array_keys($ParentArr,$Key).'tr").style.display="none",ParentFldCnt['.$ParentIdx.']=0,

                        document.getElementById("'.array_keys($ParentArr,$Key).'hid").value="";');	*/

                        if (isset($Child) && count($Child) > 1)

                        {

                            foreach ($Child as $CK => $CV)

                            {

                                //if($CK%2==0)

                                {

                                    $ObjResponse->addScript('if(document.getElementById("' . $CV . 'tr")!=null)

									document.getElementById("' . $CV . 'tr").style.display="none";');

                                    $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$CV] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$CV] . 'tr").style.display="none";');

                                    

                                }

                                $ObjResponse->addScript('document.getElementById("' . $CV . 'hid").value="";');

                                $ObjResponse->addScript('document.getElementById(document.getElementById("' . $CV . 'ctr").value).checked=false;');

                                //$ObjResponse->addScript('alert(document.getElementById(document.getElementById("'.$Child[0].'ctr").value).value)');

                                $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=0');

                            } //$Child as $CK => $CV

                        } //isset($Child) && count($Child) > 1

                        else if (isset($Child))

                        {

                            $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'tr").style.display="none"');

                            $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$Child[0]] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$Child[0]] . 'tr").style.display="none";');

                            

                            $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'hid").value="";');

                            //$ObjResponse->addScript('alert(document.getElementById(document.getElementById("'.$Child[0].'ctr").value).value)');

                            $ObjResponse->addScript('document.getElementById(document.getElementById("' . $Child[0] . 'ctr").value).checked=false;');

                            $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=0');

                        } //isset($Child)

                        //$ObjResponse->addAlert($Key."  : ".$Child[0]);			

                        

                    } //$ChangedValArr[$ParentArr[$Key]] == 'N' || $ChangedValArr[$ParentArr[$Key]] == ''

                    else

                    {

                        //$ObjResponse->addAlert($Key."  : ".$Key.$DesignQry->$Key);		

                        $ObjResponse->addScript("document.getElementById('" . $Key . "hid').value='" . ($DesignQry->$Key) . "'");

                        if ($DesignQry->$Key != '')

                            $ObjResponse->addScript("document.getElementById('" . $Key . $DesignQry->$Key . "').checked=true");

                    }

                   //$ObjResponse->addScript("document.getElementById('".$Key."').value=''");			

                    

                } //@array_key_exists($Key, $ParentArr) && !@array_key_exists($Key, $ChangedValArr) && @array_key_exists($ParentArr[$Key], $ChangedValArr)

                else if ($Val != '' && $Val != '0')

                {

                    //$ObjResponse->addAlert($Key."  :  ".$Val." Val not null ");

                    if (@in_array($Key, $ParentArr) && $Val == 'Y')

                    {

                        if (@is_array($IdxArr))

                            $ParentIdx = @array_search($Key, $IdxArr);

                        else

                            $ParentIdx = $IdxArr[0];

                        $Child = @array_keys($ParentArr, $Key);

                        /*$ObjResponse->addScript('document.getElementById("'.array_keys($ParentArr,$Key).'tr").style.display="none",ParentFldCnt['.$ParentIdx.']=0,

                        document.getElementById("'.array_keys($ParentArr,$Key).'hid").value="";');	*/

                        if (isset($Child) && count($Child) > 1)

                        {

                            foreach ($Child as $CK => $CV)

                            {

                                //if($CK%2==0)

                                {

                                    $ObjResponse->addScript('if(document.getElementById("' . $CV . 'tr")!=null)

											document.getElementById("' . $CV . 'tr").style.display="inline";');

                                    

                                    $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$CV] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$CV] . 'tr").style.display="inline";');

                                    

                                }

                                $ObjResponse->addScript('document.getElementById("' . $CV . 'hid").value="' . $SpecPrevArr[$CV] . '";');

                                $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=0');

                            } //$Child as $CK => $CV

                        } //isset($Child) && count($Child) > 1

                        else if (isset($Child))

                        {

                            //$ObjResponse->addAlert($Child[0]);

                            $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'tr").style.display="inline"');

                            

                            $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$Child[0]] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$Child[0]] . 'tr").style.display="inline";');

                            

                            $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'hid").value="' . $SpecPrevArr[$Child[0]] . '";');

                            $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=0');

                        } //isset($Child)

                    } //@in_array($Key, $ParentArr) && $Val == 'Y'

                    

                    $ObjResponse->addScript("document.getElementById('" . $Key . $Val . "').checked=true");

                    

                    

                    

                } //$Val != '' && $Val != '0'

                else if ($DesignQry->$Key == 'Y')

                {

                    //	$ObjResponse->addAlert($Key."  :  ".$DesignQry->$Key."  :  ".$Val." design not null ");				

                    if ((@in_array($Key, $ParentArr) && $DesignQry->$Key == 'Y'))

                    {

                        if (@is_array($IdxArr))

                            $ParentIdx = @array_search($Key, $IdxArr);

                        else

                            $ParentIdx = $IdxArr[0];

                        $Child = @array_keys($ParentArr, $Key);

                        /*$ObjResponse->addScript('document.getElementById("'.array_keys($ParentArr,$Key).'tr").style.display="none",ParentFldCnt['.$ParentIdx.']=0,

                        document.getElementById("'.array_keys($ParentArr,$Key).'hid").value="";');	*/

                        if (isset($Child) && count($Child) > 1)

                        {

                            foreach ($Child as $CK => $CV)

                            {

                                //if($CK%2==0)

                                {

                                    $ObjResponse->addScript('if(document.getElementById("' . $CV . 'tr")!=null)

										document.getElementById("' . $CV . 'tr").style.display="inline";');

                                    

                                    $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$CV] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$CV] . 'tr").style.display="inline";');

                                }

                                $ObjResponse->addScript('document.getElementById("' . $CV . 'hid").value="' . $DesignQry->$CV . '";');

                                $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=0');

                            } //$Child as $CK => $CV

                        } //isset($Child) && count($Child) > 1

                        else if (isset($Child))

                        {

                            //$ObjResponse->addAlert(" for imo checking  ".$Key."    :   ".$Child[0]."  :  ".$DesignQry->$Child[0]);				

                            //$ObjResponse->addScript('alert(document.getElementById("'.$Child[0].'hid").name)');

                            $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'tr").style.display="inline";');

                            $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$Child[0]] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$Child[0]] . 'tr").style.display="inline";');

                            $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'ctr").value="' . $Child[0] . $DesignQry->$Child[0] . '",

										document.getElementById("' . $Child[0] . 'hid").value="' . $DesignQry->$Child[0] . '";');

                            $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=0');

                        } //isset($Child)

                    } //(@in_array($Key, $ParentArr) && $DesignQry->$Key == 'Y')

                    

                    $ObjResponse->addScript("document.getElementById('" . $Key . $DesignQry->$Key . "').checked=true");

                } //$DesignQry->$Key == 'Y'

                else

                {

                    if (@in_array($Key, $ParentArr))

                    {

                        if (@is_array($IdxArr))

                            $ParentIdx = @array_search($Key, $IdxArr);

                        else

                            $ParentIdx = $IdxArr[0];

                        

                        $Child = @array_keys($ParentArr, $Key);

                        /*$ObjResponse->addScript('document.getElementById("'.array_keys($ParentArr,$Key).'tr").style.display="none",ParentFldCnt['.$ParentIdx.']=0,

                        document.getElementById("'.array_keys($ParentArr,$Key).'hid").value="";');	*/

                        if (isset($Child) && count($Child) > 1)

                        {

                            foreach ($Child as $CK => $CV)

                            {

                                //if($CK%2==0)

                                {

                                    $ObjResponse->addScript('if(document.getElementById("' . $CV . 'tr")!=null)

									document.getElementById("' . $CV . 'tr").style.display="none";');

                                    $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$CV] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$CV] . 'tr").style.display="none";');

                                }

                                if (@array_key_exists($CV, $ArrOpt))

                                {

                                    $ObjResponse->addScript('document.getElementById("' . $CV . '"+document.getElementById("' . $CV . 'hid").value).checked=false;');

                                    $ObjResponse->addScript('document.getElementById("' . $CV . 'hid").value="";');

                                    //bad

                                } //@array_key_exists($CV, $ArrOpt)

                                

                                else

                                {

                                    $ObjResponse->addScript('document.getElementById("' . $CV . '").value="";');

                                    //$ObjResponse->addScript('alert(document.getElementById("'.$CV.'").value);');

                                }

                                

                            } //$Child as $CK => $CV

                        } //isset($Child) && count($Child) > 1

                        else if (isset($Child))

                        {

                            $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'tr").style.display="none"');

                            $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$Child[0]] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$Child[0]] . 'tr").style.display="none";');

                            

                            

                            if (@array_key_exists($Child[0], $ArrOpt))

                            {

                                $ObjResponse->addScript('document.getElementById("' . $Child[0] . '"+document.getElementById("' . $Child[0] . 'hid").value).checked=false;');

                                $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'hid").value="";');

                                

                            } //@array_key_exists($Child[0], $ArrOpt)

                            else

                                $ObjResponse->addScript('document.getElementById("' . $Child[0] . '").value="";');

                            

                        } //isset($Child)

                    } //@in_array($Key, $ParentArr)

                   // $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=0');

                  //  $ObjResponse->addAlert($Key."  :  ".$DesignQry->$Key."  :  ".$Val." design is null ");	

                    if ($DesignQry->$Key == '')

                        $Id = 'n/a';

                    else

                        $Id = $DesignQry->$Key;

                    $ObjResponse->addScript("document.getElementById('" . $Key . $Id . "').checked=true");

                }

            } //@array_key_exists($Key, $ArrOpt)

            else

            {

                if (@array_key_exists($Key, $ChangedValArr) && $ChangedValArr[$Key] != '' && $ChangedValArr[$Key] != '0')

                {

                    if (@in_array($Key, $ParentArr) && $ChangedValArr[$Key] == 'Y')

                    {

                        if (@is_array($IdxArr))

                            $ParentIdx = @array_search($Key, $IdxArr);

                        else

                            $ParentIdx = $IdxArr[0];

                        $ObjResponse->addScript('document.getElementById("' . @array_keys($ParentArr, $Key) . 'tr").style.display="inline";');

                        $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$Key] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$Key] . 'tr").style.display="inline";');

                        $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=1;');

                    } //@in_array($Key, $ParentArr) && $ChangedValArr[$Key] == 'Y'

                    

                    elseif ($ChangedValArr[$Key] != '')

                        $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . ($ChangedValArr[$Key]) . "'");

                    else

                        $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . utf8_encode($DesignQry->$Key) . "'");

                    

                } //@array_key_exists($Key, $ChangedValArr) && $ChangedValArr[$Key] != '' && $ChangedValArr[$Key] != '0'

                

                /*else if(@array_key_exists($Key,$ChangedValArr) && ($ChangedValArr[$Key]=='' || $ChangedValArr[$Key]=='0') && $DesignQry->$Key=='Y')

                {

                if(@in_array($Key,$ParentArr) )

                {

                

                if(@is_array($IdxArr))

                $ParentIdx=array_search($Key,$IdxArr);

                else

                $ParentIdx=$IdxArr[0];

                $ObjResponse->addScript('document.getElementById("'.array_keys($ParentArr,$Key).'tr").style.display="inline",ParentFldCnt['.$ParentIdx.']=1;');	

                $Child=@array_keys($ParentArr,$Key);		

                $ObjResponse->addScript('document.getElementById("'.array_keys($ParentArr,$Key).'tr").style.display="none",ParentFldCnt['.$ParentIdx.']=0;');	

                if(isset($Child) && count($Child)>1)

                {

                foreach($Child as $CK=>$CV)

                {

                if($CK%2==0)

                

                $ObjResponse->addScript('document.getElementById("'.$CV.'tr").style.display="inline";');

                

                $ObjResponse->addScript('ParentFldCnt['.$ParentIdx.']=0');				

                }	

                }

                else if(isset($Child))

                {

                $ObjResponse->addScript('document.getElementById("'.$Child[0].'tr").style.display="inline";');	

                $ObjResponse->addScript('ParentFldCnt['.$ParentIdx.']=0');				

                }	

                }

                $ObjResponse->addScript("document.getElementById('".$Key."').value='".($DesignQry->$Key)."'");	

                }			*/

                else if (@array_key_exists($Key, $ParentArr) && !@array_key_exists($Key, $ChangedValArr) && @array_key_exists($ParentArr[$Key], $ChangedValArr))

                {

                    //$ObjResponse->addAlert($Key."here parent not null");	

                    if ($ChangedValArr[$ParentArr[$Key]] == 'N' || $ChangedValArr[$ParentArr[$Key]] == '' && $DesignQry->$ParentArr[$Key] == '')

                    {

                        if (@is_array($IdxArr))

                            $ParentIdx = @array_search($Key, $IdxArr);

                        else

                            $ParentIdx = $IdxArr[0];

                        

                        $Child = @array_keys($ParentArr, $Key);

                        /*$ObjResponse->addScript('document.getElementById("'.array_keys($ParentArr,$Key).'tr").style.display="none",ParentFldCnt['.$ParentIdx.']=0,

                        document.getElementById("'.array_keys($ParentArr,$Key).'hid").value="";');	*/

                        if (isset($Child) && count($Child) > 1)

                        {

                            foreach ($Child as $CK => $CV)

                            {

                                //if($CK%2==0)

                                {

                                    $ObjResponse->addScript('if(document.getElementById("' . $CV . 'tr")!=null)

									document.getElementById("' . $CV . 'tr").style.display="none";');

                                    $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$CV] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$CV] . 'tr").style.display="none";');

                                }

                                $ObjResponse->addScript('document.getElementById("' . $CV . '").value="";');

                                $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=0');

                            } //$Child as $CK => $CV

                        } //isset($Child) && count($Child) > 1

                        else if (isset($Child))

                        {

                            $ObjResponse->addScript('document.getElementById("' . $Child[0] . 'tr").style.display="none"');

                            

                            $ObjResponse->addScript('if(document.getElementById("' . $ChildLab[$Child[0]] . 'tr")!=null)

												document.getElementById("' . $ChildLab[$Child[0]] . 'tr").style.display="none";');

                            $ObjResponse->addScript('document.getElementById("' . $Child[0] . '").value="none";');

                            $ObjResponse->addScript('ParentFldCnt[' . $ParentIdx . ']=0');

                        } //isset($Child) 

                    } //$ChangedValArr[$ParentArr[$Key]] == 'N' || $ChangedValArr[$ParentArr[$Key]] == '' && $DesignQry->$ParentArr[$Key] == ''

                    else if ($Val == '' || $Val == '0')

                    {

                        $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . utf8_encode($DesignQry->$Key) . "'"); // updated by harendar singh tomar according to MSG NO.78714 

						

                    } //$Val == '' || $Val == '0'

                } //@array_key_exists($Key, $ParentArr) && !@array_key_exists($Key, $ChangedValArr) && @array_key_exists($ParentArr[$Key], $ChangedValArr)

                else if ($Val != '' && $Val != '0')

                {

                  //$ObjResponse->addAlert($Key."here val not null");		

                    $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . utf8_encode($DesignQry->$Key) . "'");

                } //$Val != '' && $Val != '0'

                else

                {

                   	

                    $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . utf8_encode($DesignQry->$Key) . "'");

                    

                }

            }

        } //$SpecPrevArr as $Key => $Val

      ///   $ObjResponse->addAlert(print_r($ChangedValArr) );

        foreach ($CommPrevArr as $Key => $Val)

        {// $ObjResponse->addAlert("Spec : ".$Key."   :   ".$Val .":".$ChangedValArr[$Key] );			

            /*if($DesignWyNum!='')//IF DISIGN COMBO WILL BE CHANGED THEN FILL FURTHER DETAILS ACCORDING TO DB.

            $Val = '';*/

            $OptArr = array(

                "bowthr",

                "shagen",

                "pspc",

                "iceclass",

                "tier",

                "tier3",

				"winterization",

				"winterization_arctic",

                "eedi",

                "eeoi",

                "typpropul",

                "polarclass",

                "polarclasstype",      

				"ecodesign",

            	"lngretrofit",

				"fueltype",

				

            );

            

			   

            //If the value has been changed manually then dont overwrite from shipdesign table.

            if (@array_key_exists($Key, $ChangedValArr) && trim($ChangedValArr[$Key]) != '' && $ChangedValArr[$Key] != '0')

            {

                //$ObjResponse->addAlert("Changed  : ".$Key."  :   ".$ChangedValArr[$Key]);	

                if (@array_search($Key, $OptArr) === false)

                {

                    $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . ($ChangedValArr[$Key]) . "'");

                } //@array_search($Key, $OptArr) === false

                else

                {

                    if ($Key == 'pspc' || $Key == 'iceclass')

                    {

                        if ($ChangedValArr[$Key] == 'Y')

                        {

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                            if ($Key == 'iceclass')

                            {

                                $ObjResponse->addScript("document.getElementById('icedesp').style.display = 'inline';");

                            } //$Key == 'iceclass'

                            

                        } //$ChangedValArr[$Key] == 'Y'

                        else if ($ChangedValArr[$Key] == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . $ChangedValArr[$Key] . "'");

                        

                    } //$Key == 'pspc' || $Key == 'iceclass'

                    else if ($Key == 'polarclass' )

                    {

                    	

                        if (trim($ChangedValArr[$Key]) == 'Y')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true;

                            document.getElementById('polarclasstype_div_lbl').style.display='inline';

                            document.getElementById('polarclasstype_div').style.display='inline';");

                        else if (trim($ChangedValArr[$Key]) == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true;

                            document.getElementById('polarclasstype_div_lbl').style.display='none';

                            document.getElementById('polarclasstype_div').style.display='none';");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true;

                            document.getElementById('polarclasstype_div_lbl').style.display='none';

                            document.getElementById('polarclasstype_div').style.display='none';");                    	

                    }

                    else if ($Key == 'polarclasstype')

                    {

                        $polarclasstypeArr = array('PC 1'=>'1','PC 2'=>'2','PC 3'=>'3','PC 4'=>'4','PC 5'=>'5','PC 6'=>'6','PC 7'=>'7',);

                    	//$ObjResponse->addAlert($Key ." = ". $DesignQry->$Key);

                    	

                        if (trim($ChangedValArr[$Key]) != '')

                        {

                            $ObjResponse->addScript("document.getElementById('polarclasstype" . $polarclasstypeArr[trim($ChangedValArr[$Key])] . "').checked=true");

                        }

                    	

                    }                   

                    else if ($Key == 'eedi' || $Key == 'eeoi')

                    {

                        if ($ChangedValArr[$Key] == 'Y')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                        else if ($ChangedValArr[$Key] == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                    } //$Key == 'eedi' || $Key == 'eeoi'

					else if( $Key == 'winterization')

					{

					if ($ChangedValArr[$Key] == 'Y')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                        else if ($ChangedValArr[$Key] == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

					}

					 

					else if( $Key == 'winterization_arctic')

					{

					if ($ChangedValArr[$Key] == 'Y')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                        else if ($ChangedValArr[$Key] == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

					}

                    else if ($Key == 'ecodesign')

                    {

                        if ($ChangedValArr[$Key] == 'Y')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                        else if ($ChangedValArr[$Key] == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                    } //$Key == 'eedi' || $Key == 'eeoi'

                    else if ($Key == 'typpropul')

                    {

                         //$ObjResponse->addAlert('ok');

                        if ($ChangedValArr[$Key] != '')

                            $ObjResponse->addScript("document.getElementById('" . $Key . $ChangedValArr[$Key] . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                    }

/*					else if ($Key == 'fueltype')

                    {

                         //$ObjResponse->addAlert('ok');

                        if ($ChangedValArr[$Key] != '')

                            $ObjResponse->addScript("document.getElementById('" . $Key . $ChangedValArr[$Key] . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                    }*/

                    else

                    {

                        if ($ChangedValArr[$Key] == 'Yes')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                        else if ($ChangedValArr[$Key] == 'No')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . $ChangedValArr[$Key] . "'");

                    }

                    

                    //if($ChangedValArr[$Key]=='')

                    //$ObjResponse->addAlert($Key);

                }

                

            } //@array_key_exists($Key, $ChangedValArr) && trim($ChangedValArr[$Key]) != '' && $ChangedValArr[$Key] != '0'

            

            //Its current existing values, that is not changed manually by the user.

            else if ($Val != '' && $Val != '0' && !@array_key_exists($Key, $ChangedValArr))

            {

                

                if (@array_search($Key, $OptArr) === false)

                {

                    

                    if ($Key == 'enginemak')

                    {

                        $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv','enginemak','','" . $Val . "',

					'enginetyp','" . $OnKeyPress . "')");

                    } //$Key == 'enginemak'

                    else if ($Key == 'enginetyp')

                    {

                        $EngMak = $CommPrevArr['enginemak'];

                        //$ObjResponse->addAlert($EngMak."val not null: ".$Val);

                        $ObjResponse->addScript("xajax_FillEnginTypCombo('enginetypcombodiv','enginetyp',

					'" . $EngMak . "','','" . $Val . "','','" . $OnKeyPress . "')");

                        //$ObjResponse->addScript("alert('now'+document.getElementById('enginetyp').value)");

                    } //$Key == 'enginetyp'

                    if ($Key == 'enginemak2')

                    {

                        $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv2','enginemak2','','" . $Val . "',

					'enginetyp2','" . $OnKeyPress . "')");

                    } //$Key == 'enginemak2'

                    else if ($Key == 'enginetyp2')

                    {

                        $EngMak = $CommPrevArr['enginemak2'];

                        

                        $ObjResponse->addScript("xajax_FillEnginTypCombo('enginetypcombodiv2','enginetyp2',

					'" . $EngMak . "','','" . $Val . "','','" . $OnKeyPress . "')");

                        //$ObjResponse->addScript("alert('now'+document.getElementById('enginetyp').value)");

                    } //$Key == 'enginetyp2'

                    

                    else

                    {

                        $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . ($Val) . "'");

                    }

                    

                } //@array_search($Key, $OptArr) === false

                else

                {

					//$ObjResponse->addAlert($Key ." = ". $Val);                    

                    if ($Key == 'pspc' || $Key == 'iceclass' || $Key == 'tier' || $Key == 'tier3'|| $Key == 'ecodesign' || $Key == 'winterization' || $Key =='winterization_arctic')

                    {

                        if ($Val == 'Y')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                        else if ($Val == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                        $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . $Val . "'");

                    }

                    else if ($Key == 'polarclass' )

                    {

                    	

                        if (trim($Val) == 'Y')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true;

                            document.getElementById('polarclasstype_div_lbl').style.display='inline';

                            document.getElementById('polarclasstype_div').style.display='inline';");

                        else if (trim($Val) == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true;

                            document.getElementById('polarclasstype_div_lbl').style.display='none';

                            document.getElementById('polarclasstype_div').style.display='none';");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true;

                            document.getElementById('polarclasstype_div_lbl').style.display='none';

                            document.getElementById('polarclasstype_div').style.display='none';");                    	

                    }

                    else if ($Key == 'polarclasstype')

                    {

                        $polarclasstypeArr = array('PC 1'=>'1','PC 2'=>'2','PC 3'=>'3','PC 4'=>'4','PC 5'=>'5','PC 6'=>'6','PC 7'=>'7',);

                    	//$ObjResponse->addAlert($Key ." = ". $DesignQry->$Key);

                    	

                        if (trim($Val) != '')

                        {

                            $ObjResponse->addScript("document.getElementById('polarclasstype" . $polarclasstypeArr[trim($Val)] . "').checked=true");

                        }

                    	

                    } 

                    else if ($Key == 'eedi' || $Key == 'eeoi')

                    {

                        if ($Val == 'Y')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                        else if ($Val == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                    } //$Key == 'eedi' || $Key == 'eeoi'

                    else if ($Key == 'ecodesign')

                    {

					//$ObjResponse->addAlert($Key ." = ". $Val);  

                        if ($Val == 'Y')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                        else if ($Val == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                    } //$Key == 'eedi' || $Key == 'eeoi' Js

                    else if ($Key == 'typpropul')

                    {

                        if ($Val != '')

                            $ObjResponse->addScript("document.getElementById('" . $Key . $Val . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                    }

/*					 else if ($Key == 'fueltype')

                    {

                        if ($Val != '')

                            $ObjResponse->addScript("document.getElementById('" . $Key . $Val . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                    }*/

                    else

                    {

                        if ($Val == 'Yes')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                        else if ($Val == 'No')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                            $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . $Val . "'");

                    }

                    

                }

                

            } //$Val != '' && $Val != '0' && !@array_key_exists($Key, $ChangedValArr)

            else //Store from shipdesign table.

            {

				//$ObjResponse->addAlert($Key ." = ". $DesignQry->$Key);  

                if ($Key == 'enginemak')

                {

                    $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv','enginemak','','" . $DesignQry->$Key . "',

				'enginetyp','" . $OnKeyPress . "')");

                } //$Key == 'enginemak'

                else if ($Key == 'enginetyp')

                {

                    $ObjResponse->addScript("xajax_FillEnginTypCombo('enginetypcombodiv','enginetyp',

				'" . $DesignQry->enginemak . "','','" . $DesignQry->$Key . "','','" . $OnKeyPress . "')");

                    

                } //$Key == 'enginetyp'

                if ($Key == 'enginemak2')

                {

                    $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv2','enginemak2','','" . $DesignQry->$Key . "',

				'enginetyp2','" . $OnKeyPress . "')");

                } //$Key == 'enginemak2'

                else if ($Key == 'enginetyp2')

                {

                    $ObjResponse->addScript("xajax_FillEnginTypCombo('enginetypcombodiv2','enginetyp2',

				'" . $DesignQry->enginemak2 . "','','" . $DesignQry->$Key . "','','" . $OnKeyPress . "')");

                    

                } //$Key == 'enginetyp2'

                

                else if (@array_search($Key, $OptArr) === false)

                    $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . utf8_encode($DesignQry->$Key) . "'");

                else

                {

                    if ($Key == 'pspc' || $Key == 'iceclass' || $Key == 'tier' || $Key == 'tier3' || $Key == 'winterization' || $Key =='winterization_arctic')

                    {

                        if (trim($DesignQry->$Key) == 'Y')

                        {

                            if ($Key == 'iceclass')

                            {

                                $ObjResponse->addScript("document.getElementById('icedesp').style.display = 'inline';");

                                //$ObjResponse->addScript("alert(document.getElementById('icedesp').style.display)"); 	

                            } //$Key == 'iceclass'

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true;");

                             

                            

                        } //trim($DesignQry->$Key) == 'Y'

                        else if (trim($DesignQry->$Key) == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        else if (trim($DesignQry->$Key) == '')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                        $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . utf8_encode($DesignQry->$Key) . "'");

                    } //$Key == 'pspc' || $Key == 'iceclass' || $Key == 'tier' || $Key == 'tier3'

                    else if ($Key == 'polarclass' )

                    {

                    	

                        if (trim($DesignQry->$Key) == 'Y')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true;

                            document.getElementById('polarclasstype_div_lbl').style.display='inline';

                            document.getElementById('polarclasstype_div').style.display='inline';");

                        else if (trim($DesignQry->$Key) == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true;

                            document.getElementById('polarclasstype_div_lbl').style.display='none';

                            document.getElementById('polarclasstype_div').style.display='none';");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true;

                            document.getElementById('polarclasstype_div_lbl').style.display='none';

                            document.getElementById('polarclasstype_div').style.display='none';");                    	

                    }

                    else if ($Key == 'polarclasstype')

                    {

                        $polarclasstypeArr = array('PC 1'=>'1','PC 2'=>'2','PC 3'=>'3','PC 4'=>'4','PC 5'=>'5','PC 6'=>'6','PC 7'=>'7',);

                    	//$ObjResponse->addAlert($Key ." = ". $DesignQry->$Key);

                    	

                        if ($polarclasstypeArr[trim($DesignQry->$Key)] != '')

                        {

                            $ObjResponse->addScript("document.getElementById('polarclasstype" . $polarclasstypeArr[trim($DesignQry->$Key)] . "').checked=true");

                        }

                    	

                    }                    

                    else if ($Key == 'eedi' || $Key == 'eeoi')

                    {

                        if (trim($DesignQry->$Key) == 'Y')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                        else if (trim($DesignQry->$Key) == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                        

                    } //$Key == 'eedi' || $Key == 'eeoi'

                    else if ($Key == 'ecodesign')

                    {

                        if ($DesignQry->$Key == 'Y')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                        else if ($DesignQry->$Key == 'N')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        else

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                    } //$Key == 'eedi' || $Key == 'eeoi'

                    else if ($Key == 'typpropul')

                    {

                        //$ObjResponse->addAlert($Key ." = ". $DesignQry->$Key);

                        if (trim($DesignQry->$Key) == 'lngengine')

                        {

                            $ObjResponse->addScript("document.getElementById('" . $Key . $DesignQry->$Key . "').checked=true");

                            

                            //Also display a sub row for Lng Type

                            $ObjResponse->addScript("document.getElementById('lngretrofitTR').style.display='inline'");

                            if(trim($DesignQry->lngretrofit) != '')

                            	$ObjResponse->addScript("document.getElementById('lngretrofit" . $DesignQry->lngretrofit . "').checked=true");

                            else	

                                $ObjResponse->addScript("document.getElementById('lngretrofitNA').checked=true");



                        }

                        else if (trim($DesignQry->$Key) != '')

                        {

                            $ObjResponse->addScript("document.getElementById('" . $Key . $DesignQry->$Key . "').checked=true");

                            

                            //Disabling the sub Lng Type row 

                            $ObjResponse->addScript("document.getElementById('lngretrofitTR').style.display='none'");

                            $ObjResponse->addScript("document.getElementById('lngretrofitNA').checked=true");

                        }

                        else //Disable NA option for puopulsion type.

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                    }

                    else

                    {

                        if (trim($DesignQry->$Key) == 'Yes')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'Y' . "').checked=true");

                        else if (trim($DesignQry->$Key) == 'No')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'N' . "').checked=true");

                        else if (trim($DesignQry->$Key) == '')

                            $ObjResponse->addScript("document.getElementById('" . $Key . 'NA' . "').checked=true");

                        $ObjResponse->addScript("document.getElementById('" . $Key . "').value='" . utf8_encode($DesignQry->$Key) . "'");

                        

                    }

                    //$ObjResponse->addAlert($Key); 

                }

                

            }

            

            //$ObjResponse->addAlert($Key ." = ". $DesignQry->$Key);

        } //$CommPrevArr as $Key => $Val

		

       // ==================Commented by harendar according to msg no.78714=================== 

       // $ObjResponse->addScript("getmoreEngine('$DesignQry->numofengine');");

        //$ObjResponse->addAlert($DesignQry->numofengine);

    /*    if ($DesignQry->numofengine == 4)

        {

            $ObjResponse->addScript("document.getElementById('numengine2').checked=true");

        } //$DesignQry->numofengine == 4

        else if ($DesignQry->numofengine == 6)

        {

            $ObjResponse->addScript("document.getElementById('numengine3').checked=true");

        } //$DesignQry->numofengine == 6

        else if ($DesignQry->numofengine == 8)

        {

            $ObjResponse->addScript("document.getElementById('numengine4').checked=true");

        } //$DesignQry->numofengine == 8

        else

        {

            $ObjResponse->addScript("document.getElementById('numengine1').checked=true");

        }*/

        

        /*if ($DesignQry->numofengine == 4)

            $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv3','enginemak3','','" . $DesignQry->enginemak3 . "','enginetyp3','" . $OnKeyPress . "')");

        $ObjResponse->addScript("xajax_FillEnginTypCombo('enginetypcombodiv3','enginetyp3',

				'" . $DesignQry->enginemak3 . "','','" . $DesignQry->enginetyp3 . "','','" . $OnKeyPress . "')");

        $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv4','enginemak4','','" . $DesignQry->enginemak4 . "','enginetyp4','" . $OnKeyPress . "')");

        $ObjResponse->addScript("xajax_FillEnginTypCombo('enginetypcombodiv4','enginetyp4',

				'" . $DesignQry->enginemak4 . "','','" . $DesignQry->enginetyp4 . "','','" . $OnKeyPress . "')");

        

        if ($DesignQry->numofengine == 6)

            $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv3','enginemak3','','" . $DesignQry->enginemak3 . "','enginetyp3','" . $OnKeyPress . "')");

        $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv5','enginemak5','','" . $DesignQry->enginemak5 . "','enginetyp5','" . $OnKeyPress . "')");

        $ObjResponse->addScript("xajax_FillEnginTypCombo('enginetypcombodiv5','enginetyp5',

				'" . $DesignQry->enginemak5 . "','','" . $DesignQry->enginetyp5 . "','','" . $OnKeyPress . "')");

        $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv6','enginemak6','','" . $DesignQry->enginemak6 . "','enginetyp6','" . $OnKeyPress . "')");

        $ObjResponse->addScript("xajax_FillEnginTypCombo('enginetypcombodiv6','enginetyp6',

				'" . $DesignQry->enginemak6 . "','','" . $DesignQry->enginetyp6 . "','','" . $OnKeyPress . "')");

        

        if ($DesignQry->numofengine == 8)

            $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv3','enginemak3','','" . $DesignQry->enginemak3 . "','enginetyp3','" . $OnKeyPress . "')");

        $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv5','enginemak5','','" . $DesignQry->enginemak5 . "','enginetyp5','" . $OnKeyPress . "')");

        $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv7','enginemak7','','" . $DesignQry->enginemak7 . "','enginetyp7','" . $OnKeyPress . "')");

        $ObjResponse->addScript("xajax_FillEnginTypCombo('enginetypcombodiv7','enginetyp7',

				'" . $DesignQry->enginemak7 . "','','" . $DesignQry->enginetyp7 . "','','" . $OnKeyPress . "')");

        $ObjResponse->addScript("xajax_FillEnginMakCombo('enginemakcombodiv8','enginemak8','','" . $DesignQry->enginemak8 . "','enginetyp8','" . $OnKeyPress . "')");

        $ObjResponse->addScript("xajax_FillEnginTypCombo('enginetypcombodiv8','enginetyp8',

				'" . $DesignQry->enginemak8 . "','','" . $DesignQry->enginetyp8 . "','','" . $OnKeyPress . "')");

        

        if ($DesignQry->numofengine == 4)

            $ObjResponse->addScript("document.getElementById('powerhp3').value='" . $DesignQry->powerhp3 . "'");

        $ObjResponse->addScript("document.getElementById('powerkw3').value='" . $DesignQry->powerkw3 . "'");

        $ObjResponse->addScript("document.getElementById('powerhp4').value='" . $DesignQry->powerhp4 . "'");

        $ObjResponse->addScript("document.getElementById('powerkw4').value='" . $DesignQry->powerkw4 . "'");

        

        if ($DesignQry->numofengine == 6)

            $ObjResponse->addScript("document.getElementById('powerhp3').value='" . $DesignQry->powerhp3 . "'");

        $ObjResponse->addScript("document.getElementById('powerhp5').value='" . $DesignQry->powerhp5 . "'");

        $ObjResponse->addScript("document.getElementById('powerkw5').value='" . $DesignQry->powerkw5 . "'");

        $ObjResponse->addScript("document.getElementById('powerhp6').value='" . $DesignQry->powerhp6 . "'");

        $ObjResponse->addScript("document.getElementById('powerkw6').value='" . $DesignQry->powerkw6 . "'");

        

        if ($DesignQry->numofengine == 8)

            $ObjResponse->addScript("document.getElementById('powerhp3').value='" . $DesignQry->powerhp3 . "'");

        $ObjResponse->addScript("document.getElementById('powerhp5').value='" . $DesignQry->powerhp5 . "'");

        $ObjResponse->addScript("document.getElementById('powerhp7').value='" . $DesignQry->powerhp7 . "'");

        $ObjResponse->addScript("document.getElementById('powerkw7').value='" . $DesignQry->powerkw7 . "'");

        $ObjResponse->addScript("document.getElementById('powerhp8').value='" . $DesignQry->powerhp8 . "'");

        $ObjResponse->addScript("document.getElementById('powerkw8').value='" . $DesignQry->powerkw8 . "'");*/

		

		//============================ Comment end msg no. 78714 ==========================================

		return $ObjResponse;

    }

//===========function to store the maximum and minimum values of size field of a subsegment into hidden variables 

	

function StoreSizeLimit($WyTypId)

{



	$ObjResponse = new xajaxResponse(); 

	$DB=new DBConnect();

	

	if($WyTypId!='')

	{

		$SizeFieldQry="select sizfldnam,sizunit,minsiz,maxsiz from shiptype where wytypid='".$WyTypId."'";

	}

	

	if($SizeFieldQry!='')

	{

		$SizeResult=$DB->Select($SizeFieldQry,'Select_sizefld',$Module);

		if(@mysql_num_rows($SizeResult) > 0)

		{

			$SizeRow = @mysql_fetch_object($SizeResult);

		}

	}

	

	$ObjResponse->addScript('document.getElementById("shipsizefield").value="'.$SizeRow->sizfldnam.'"');

	$ObjResponse->addScript('document.getElementById("sizfldcap").value="'.$SizeRow->sizunit.'"');

	$ObjResponse->addScript('document.getElementById("minsiz").value="'.$SizeRow->minsiz.'"');

	$ObjResponse->addScript('document.getElementById("maxsiz").value="'.$SizeRow->maxsiz.'"');

	$ObjResponse->addScript('document.getElementById("specfldnam").value="'.$SizeRow->sizfldnam.'"');

	

	return $ObjResponse;

}



//function FillSubSegComboMultiple added by swati vyas on 1-April-2010 according to msg [29130]

function FillSubSegComboMultiple($SubSegdiv,$SegVal,$CtrNam,$ShipWyNum='',$PreSelectedValue='',$OnChange='',$OnKeyPress='',$DesignBlock=false)

{	

	$DB = new DBConnect();

	$Combo='';

	$objResponse = new xajaxResponse();

	//$objResponse->addAlert("ok");

	$Module="shipajax.php";

$Qry = "select wytypid,typnam from shiptype where segnam='".$SegVal."' order by desorder desc";

	$QryRes=$DB->Select($Qry,"fetch_segnam",$Module);	

	$Combo.='<select name="'.$CtrNam.'" id="'.$CtrNam.'"  multiple="multiple"  onchange="'.$OnChange.'" onkeypress="'.$OnKeyPress.'" tabindex="1">';

    $Combo.='<option value="">Please select</option>';

	while($Row=@mysql_fetch_object($QryRes))

	{

		$Combo.='<option value="'.$Row->wytypid.'"';

		if($Row->wytypid==$PreSelectedValue)

			$Combo.='selected';

		$Combo.='>'.$Row->typnam.'</option>';

		

	}

	$Combo.='</select>';

	$objResponse->addAssign($SubSegdiv,'innerHTML',$Combo);

	return $objResponse;	 

}

//function FillSubSegComboMultiple added by swati vyas on 1-April-2010 according to msg [29130]





function ShowJapCap($JapCapDiv,$SbWyNum,$StatusCod,$PreSelectVal='')

{

	$ObjResponse = new xajaxResponse(); 

	$DB=new DBConnect();

	$JapCapStr='';

	//$ObjResponse->addAssign($JapCapDiv,'innerHTML',"select coucod from shipbuilder sb join country c on sb.country=c.coucod where sb.sbwynum=$SbWyNum");

	//return $ObjResponse;

	

	$JapSbQuery=$DB->FetchObject("select coucod from shipbuilder sb join country c on sb.country=c.coucod where sb.sbwynum=$SbWyNum","select_sb_Country",$Module);

		//$ObjResponse->addAssign($JapCapDiv,'innerHTML',$JapCapStr);

	if($JapSbQuery->coucod=='173' && $StatusCod=='O')

	{

	

		$CapSbQuery=$DB->FetchObject("select capsig from news nw join newsjointo njt on nw.newsid=njt.newsid join shipbuilder sb on sb.sbwynum=njt.jointoid 

	and newsfor='SB' where sb.sbwynum=$SbWyNum and capsig='Y' limit 1","select_capsig_builder",$Module);

	$CapSigLink='';

	if($CapSbQuery->capsig=='Y')

		$CapSigLink="<a onMouseOver='this.style.cursor=\"hand\";' onclick='OpenDevelopment(\"".$SbWyNum."\")'>Capacity significant developments</a>";



	$Checked='';	

	if($PreSelectVal=='true')

			$Checked=" checked";

			

		$JapCapStr="<table style='padding:0px' width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>

		 <tr>

		<td align='right' width='16%'>Japanese Proforma Order  :</td><td width='34%'>

		<input name='jappro' id='jappro' class='checkbox' type='checkbox' value='Y' ".$Checked."

		 onclick='validateJapproRevert(this)'>&nbsp;&nbsp;&nbsp;".$CapSigLink."</td><td  width='50%'>&nbsp;</td></tr><table>";

		$ObjResponse->addScript("document.getElementById('japcapdiv').style.display='inline'");

		$ObjResponse->addScript("document.getElementById('japcaptr').style.display='inline'");

		$ObjResponse->addScript("document.getElementById('buildercountry').value='".$JapSbQuery->coucod."'");

		

		$ObjResponse->addAssign($JapCapDiv,'innerHTML',$JapCapStr);

	}	

	else if($StatusCod=='O' && $PreSelectVal=='Y' && $JapSbQuery->coucod!='173')

	{

		$ObjResponse->addScript("if(confirm('This is a Japanese Proforma order.Are you sure you want to revert it'))

		{

			document.getElementById('japcapdiv').style.display='none';

			document.getElementById('japcaptr').style.display='none';

			document.getElementById('buildercountry').value='';

			document.getElementById('jappro').checked=false;

		}");

	}

	else

	{

		$ObjResponse->addScript("document.getElementById('japcapdiv').style.display='none'");

		$ObjResponse->addScript("document.getElementById('japcaptr').style.display='none'");

		$ObjResponse->addScript("document.getElementById('buildercountry').value=''");

		$ObjResponse->addScript("document.getElementById('jappro').checked=false;");

	}		

			

	return $ObjResponse;

}

//Function added by Hrendar on 13 Jan 2015 to check SB is japanese or not  according to MsgNo:-[82702]

/*function Checksbcountry($Sb_id)

{	$ObjResponse = new xajaxResponse(); 

	$Combo='';

	

	$objResponse->addAlert('ook'); 

	//$Qry = "select country from shipbuilder where deleted='N' and sbwynum=$Sb_id";

	//$QryRes=$DB->Select($Qry,"fetch_Sb_country",$Module);	

	//$objResponse->addAlert($Qry); 

	/*while($Row=@mysql_fetch_object($QryRes))

	{

			if($Row->marinewynum==$PreSelected)

				   $Selected='selected';

				   else

				  $Selected='';

			$Combo .='<option value="'.$Row->marinewynum.'"'.$Selected.'>'.$Row->marinenam.'</option>';

			

	}

	

	 $objResponse->addAssign($Sb_japanese,'innerHTML',$Combo); //response being assigned to the combo

	return $objResponse;

}*/

/////==========================================//////////////

?>