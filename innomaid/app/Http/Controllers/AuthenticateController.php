<?php 
 /*****************Developed by :- Harendar Singh Tomar
                   Module       :- For All Mobile Web Services
***********************************************************************************/
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\User;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use PDF;
use App\Medicaldesieses as Medicaldesieses;

class AuthenticateController extends Controller
{   
    /**
     * Middelware to protect data from unauthorized requests.
     *
     * @return Response
     */
    public function __construct()
   {
    // $this->middleware('jwt.auth', ['except' => ['authenticate']]);
   }

   /**
     * Index function.
     *
     * @return Response
     */
    public function index()
    {
        

    }    
  
    /**
     * To authencticate user and return logged in user credentials.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {

        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success'=>'0','result' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['success'=>'0','result' => 'could_not_create_token'], 500);
        }
        $user_data = User::where('email', '=', $credentials['email'])->firstOrFail();

       // if no errors are encountered we can return a JWT
        return response()->json(['success' => 1,'token'=>$token,'user_details'=>$user_data]);
    }


	/**
	* To show all skills.
	*/
	 public function getallskills() 
	{
		$query = "select wa.* FROM work_area as wa WHERE wa.otherskill = 'N'";
		$skilldata = DB::select( DB::raw($query));
		if($skilldata)
		{
			return $response = response()->json(['success' => 1,'skillset'=>$skilldata]);
		}
		else
			return response()->json(['success' => 0,'message'=>'No record found']);
	}
	
	/**
	* To show all special skills.
	*/
	 public function getallspecialskills() 
	{
		$query = "select wa.* FROM work_area as wa WHERE wa.otherskill = 'Y'";
		$skilldata = DB::select( DB::raw($query));
		if($skilldata)
		{
			return $response = response()->json(['success' => 1,'skillset'=>$skilldata]);
		}
		else
			return response()->json(['success' => 0,'message'=>'No record found']);
	}
	
	
	/**
	* To show all maids with their all details.
	*/
	 public function getallmaids() {
		$httphost = $_SERVER['HTTP_HOST'];
		$documentroot = $_SERVER['DOCUMENT_ROOT'];
		$agency = $_GET['agency'];
		if(isset($_GET['country']))
		{
			$country = $_GET['country'];
			$countryis = 'md.users_agents_id ='.$agency.' and c.id in('.$country.') '; 
		}
		else
		{
			$countryis = 'md.users_agents_id ='.$agency; 
		}

		if(isset($_GET['agefrom']))
		{
			if(isset($_GET['agefrom']))
			{
				$agefrom = $_GET['agefrom'];
			}
			else
			{
				$agefrom = 1;
			}
			if(isset($_GET['ageto']))
			{
				$ageto = $_GET['ageto'];
			}
			else
			{
				$ageto = 100;
			}
			$filter_age = ' and YEAR(CURDATE()) - YEAR(md.date_of_birth) between '.$agefrom.' and '.$ageto.' ';
		}
		else
		{
			$filter_age = '';	
		}

		if(isset($_GET['type']))
		{
			$type = explode(',',$_GET["type"]);
			foreach($type as $typ)
			{
				if($typ!=''){
				$types[] = "'".$typ."'";}
			}
			$type= implode(',',$types);
			$filter_type = ' and md.type in('.$type.') ';
		}
		else
		{
			$filter_type = ' ';	
		}
		if(isset($_GET['skillid']))
		{
			$skillset = str_replace("-", "," ,$_GET['skillid']);
			$skillselecting = "wa.title as workareatitle, mss.work_area_id as skillSetWorkAreaId";
			$skillwhere = "mss.work_area_id in($skillset) and mss.deleted = 'N' and mss.willingness = 'Yes'";
			$query = "select md.id, md.name, md.expected_salary as maidSalary, md.date_of_birth,md.availability as maidAvailability,md.maid_reference_code as maidReferenceCode,md.rest_days_preference as maidRestDaysPreference,   md.profile_image as image,md.type, c.name as country_name, u.company_name, YEAR(CURDATE()) - YEAR(md.date_of_birth) AS age, e.title as education_level,md.height as maidHeight,md.weight as maidWeight,md.address as maidAddress,md.contact_number as maidContactnumber,md.marital_status as maidMaritialstatus,md.note_for_maid as maidNotes FROM maid_personal_details as md
			LEFT JOIN countries as c ON c.id = md.nationality
			LEFT JOIN users as u ON u.id = md.users_agents_id
			LEFT JOIN education_levels as e ON e.id = md.education_level
			LEFT JOIN maid_skill_set as mss ON md.id = mss.maid_id
			LEFT JOIN work_area as wa ON wa.id = mss.work_area_id
			WHERE md.deleted = 'N' and md.display_biodata = 'Yes'  and ".$countryis." and ".$skillwhere." ".$filter_type.$filter_age." GROUP BY mss.maid_id ";
		}
		else
		{
			$query = "select md.id, md.name, md.expected_salary as maidSalary, md.date_of_birth,md.availability as maidAvailability,md.maid_reference_code as maidReferenceCode,md.rest_days_preference as maidRestDaysPreference,  md.profile_image as image,md.type, c.name as country_name, u.company_name, YEAR(CURDATE()) - YEAR(md.date_of_birth) AS age, e.title as education_level,md.height as maidHeight,md.weight as maidWeight,md.address as maidAddress,md.contact_number as maidContactnumber,md.marital_status as maidMaritialstatus,md.note_for_maid as maidNotes FROM maid_personal_details as md
			LEFT JOIN countries as c ON c.id = md.nationality
			LEFT JOIN users as u ON u.id = md.users_agents_id
			LEFT JOIN education_levels as e ON e.id = md.education_level
			WHERE  md.display_biodata = 'Yes'  and md.deleted = 'N' ".$filter_type.$filter_age." and ".$countryis;
		}
		$user_data = DB::select( DB::raw($query));
	
		if($user_data)
		{
			foreach($user_data as $key => $udata)
			{
				$maid_image_url_100 = $httphost."/uploads/maid_image/".$udata->image;
				$maid_image_url_200 = $httphost."/uploads/maid_image_size_200/".$udata->image;
				$maid_image_url_300 = $httphost."/uploads/maid_image_size_300/".$udata->image;
				$no_image_url = "http://".$httphost."/public/front/images/img-not-found.jpg"; //URL to fetch maids no image url
				if($udata->image)
				{
					if(file_exists($documentroot."/uploads/maid_image_size_300/".$udata->image))
					{
						$maid_image_url = "http://".$httphost."/uploads/maid_image_size_300/".$udata->image;
					}
					else if(file_exists($documentroot."/uploads/maid_image_size_200/".$udata->image))
					{
						$maid_image_url = "http://".$httphost."/uploads/maid_image_size_200/".$udata->image;
					}
					else if(file_exists($documentroot."/uploads/maid_image/".$udata->image))
					{
						$maid_image_url = "http://".$httphost."/uploads/maid_image/".$udata->image;
					}
				}
				else 
				{
					$maid_image_url = $no_image_url;
				}

				$users_data[] = array(
					"id" => $udata->id,
					"name" => $udata->name,
					"type" => $udata->type,
					"image" => $udata->image,
/*					"imageurl" => $maid_image_url,
					"imageurl100X100" => $maid_image_url_100,
					"imageurl200X200" => $maid_image_url_200,
					"imageurl300X300" => $maid_image_url_300,
*/					"countryName" => $udata->country_name,
					"companyName" => $udata->company_name,
					"age" => $udata->age,
					"educationLevel" => $udata->education_level,
					"referenceCode" => $udata->maidReferenceCode,
					"salary" => $udata->maidSalary,
					"restDaysPreference" => $udata->maidRestDaysPreference,
					"availability" => $udata->maidAvailability,
					"date_of_birth" => $udata->date_of_birth,
					"maid_image_url" => $maid_image_url,
					"maid_height" => $udata->maidHeight,
					"maid_weight" => $udata->maidWeight,
					"maid_address" => $udata->maidAddress,
					"maritial_status" => $udata->maidMaritialstatus,
					"contact_number" => $udata->maidContactnumber,
					"note_for_maid" => $udata->maidNotes,
					);	
			}
			return $response = response()->json(['success' => 1,'user_details'=>$users_data]);
		}
		else
			return response()->json(['success' => 0,'message'=>'No record found']);
	}

	/*************************************************************************************************************/
	/**
	* To get a single maids details.
	*/
	public function maiddetails() {
		$httphost = $_SERVER['HTTP_HOST'];
		$documentroot = $_SERVER['DOCUMENT_ROOT'];
		$id = $_GET['maid'];
		$agency = $_GET['agency'];
		$user_data = DB::table('maid_personal_details as md')->select('md.id as maidId', 'md.name as maidName', 'md.date_of_birth as maidDateOfBirth',
			'md.place_of_birth as maidPlaceOfBirth',
			'md.height as maidHeight',
			'md.weight as maidWeight',
			'md.nationality as maidNationality',
			'md.address as maidAddress',
			'md.port_name as maidPortName',
			'md.contact_number as maidContactNumber',
			'md.maid_reference_code as maidReferenceCode',
			'md.religion as maidReligion',
			'md.education_level as maidEducationLevel',
			'md.other_education as maidOtherEducation',
			'md.type as maidType',
			'md.availability as maidAvailability',
			'md.no_of_siblings as maidNoOfSiblings',
			'md.marital_status as maidMaritalStatus',
			'md.no_of_children as maidChildrenCount',
			'md.children_age as maidChildrenAge',
			'md.image as maidFullImage',
			'md.profile_image as maidThumbImage',
			'md.expected_salary as maidSalary',
			'md.allergies as maidAllergies',
			'md.allergy_description as maidAllergyDescription',
			'md.physical_disablity as maidPhysicalDisablity',
			'md.physical_disability_description as maidPhysicalDisabilityDescription',
			'md.dietary_restrictions as maidDietaryRestrictions',
			'md.dietary_restrictions_description as maidDietaryRestrictionsDescription', 
			'md.food_handling_prefrences as maidFoodHandlingPrefrences',
			'md.food_handling_preference_other as maidFoodHandlingPreferenceOther',
			'md.rest_days_preference as maidRestDaysPreference', 
			'md.medication_remarks as maidMedicationRemarks',
			'md.interviewed_by as maidInterviewedBy',
			'md.intro as maidIntroduction',
			'md.interview_method as maidInterviewMethod', 
			'md.available_for_interview as maidAvailableForInterview', 
			'md.can_be_interviewed_via as maidCanBeInterviewedVia',
			'md.overall_remarks as maidOverallRemarks', 
			'md.users_agents_id as maidUsersAgentsId',
			'md.users_agents_company_name as maidUsersAgentsCompanyName',
			'md.video_link as maidVideoLink',
			'md.profile_document as maidProfileDocument',
			'c.id as maidCountryId',
			'c.name as maidCountryName',
			'c.nationality as maidCountryNationality',
			'c.code as maidCountryCode',
			'u.first_name as maidFirstName',
			'u.last_name as maidLastName',
			'u.email as maidEmail',
			'u.company_name as maidCompanyName',
			'u.license_no as maidLicenseNo',
			'u.address as maidAddress',
			'u.telephone as maidTelephone',
			'u.fax as maidFax',
			'u.website as maidWebsite',
			'u.insurance_company as maidInsuranceCompany',
			'u.operating_days as maidOperatingDays',
			'u.operating_hrs_from as maidOperatingHrsFrom',
			'u.operating_hrs_to as maidOperatingHrsTo',
			'u.operating_hrs as maidOperatingHrs',
			'u.other_information as maidOtherInformaion',
			'u.role as maidRole',
			'u.remember_token as maidRememberToken',
			'e.title as maidEducationTitle',
			'e.description as maidEducationDecription',
			DB::Raw('YEAR(CURDATE()) - YEAR(md.date_of_birth) AS age'))
			->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
			->leftJoin('users as u', 'u.id', '=', 'md.users_agents_id')
			->leftJoin('education_levels as e', 'e.id', '=', 'md.education_level')
			->where('md.deleted','=','N')
			->where('md.id','=',$id)
			->where('md.users_agents_id','=',$agency)
			->where('md.display_biodata','=','Yes')
			->get();
					
		$no_image_url = "http://".$httphost."/public/front/images/img-not-found.jpg"; //URL to fetch maids no image url
		if($user_data[0]->maidThumbImage)
		{
			if(file_exists($documentroot."/uploads/maid_image_size_300/".$user_data[0]->maidThumbImage))
			{
				$maid_image_url = "http://".$httphost."/uploads/maid_image_size_300/".$user_data[0]->maidThumbImage;
			}
			else if(file_exists($documentroot."/uploads/maid_image_size_200/".$user_data[0]->maidThumbImage))
			{
				$maid_image_url = "http://".$httphost."/uploads/maid_image_size_200/".$user_data[0]->maidThumbImage;
			}
			else if(file_exists($documentroot."/uploads/maid_image/".$user_data[0]->maidThumbImage))
			{
				$maid_image_url = "http://".$httphost."/uploads/maid_image/".$user_data[0]->maidThumbImage;
			}
		}
		else 
		{
			$maid_image_url = $no_image_url;
		}
		$user_medical_illness =  DB::table('maid_medical_desieses as mmd')
			->select('mmd.maid_id as maidId','mmd.medical_desieses_id as medicalDesiesesId','mmd.description as otherDesieses','md.*')
			->leftJoin('medical_desieses as md', 'md.id', '=', 'mmd.medical_desieses_id')
			->leftJoin('maid_personal_details as maid', 'maid.id', '=', 'mmd.maid_id')
			->where('mmd.maid_id','=',$id)
			->where('mmd.deleted','=','N')
			->where('maid.users_agents_id','=',$agency)
			->get();
		
		$maid_special_skills = DB::table('maid_skill_set as mss')
			->select('wa.title as workareatitle',
				'mss.work_area_id as skillSetWorkAreaId',
				'mss.willingness as skillSetWillingness',
				'mss.experience as skillSetExperience',
				'mss.rating as skillSetRating',
				'mss.feedback_comment as skillSetFeedbackComment')
			->leftJoin('work_area as wa', 'wa.id', '=', 'mss.work_area_id')
			->leftJoin('maid_personal_details as maid', 'maid.id', '=', 'mss.maid_id')
			->where('mss.maid_id','=',$id)
			->where('mss.deleted','=','N')
			->where('mss.experience','=','Yes')
			->where('wa.otherskill','=','N')
			->where('maid.users_agents_id','=',$agency)
			->whereNotIn('mss.work_area_id', ['6', '17', '18'])
			->get();
		
		$maid_language_skills = DB::table('maid_skill_set as mss')
			->select('wa.title as workareatitle',
				'mss.work_area_id as skillSetWorkAreaId',
				'mss.willingness as skillSetWillingness',
				'mss.experience as skillSetExperience',
				'mss.rating as skillSetRating',
				'mss.feedback_comment as skillSetFeedbackComment')
			->leftJoin('work_area as wa', 'wa.id', '=', 'mss.work_area_id')
			->leftJoin('maid_personal_details as maid', 'maid.id', '=', 'mss.maid_id')
			->where('mss.maid_id','=',$id)
			->where('mss.deleted','=','N')
			->where('mss.experience','=','Yes')
			->where('wa.otherskill','=','N')
			->where('maid.users_agents_id','=',$agency)
			->where('mss.work_area_id', '=', '6')
			->get();
		
		$maid_preference_skills = DB::table('maid_skill_set as mss')
			->select('wa.title as workareatitle', 
				'wa.order_by as sequence',
				'mss.work_area_id as skillSetWorkAreaId',
				'mss.willingness as skillSetWillingness',
				'mss.experience as skillSetExperience',
				'mss.rating as skillSetRating',
				'mss.feedback_comment as skillSetFeedbackComment')
			->leftJoin('work_area as wa', 'wa.id', '=', 'mss.work_area_id')
			->leftJoin('maid_personal_details as maid', 'maid.id', '=', 'mss.maid_id')
			->where('mss.maid_id','=',$id)
			->where('mss.deleted','=','N')
			->where('mss.willingness','=','Yes')
			->where('wa.otherskill','=','N')
			->where('maid.users_agents_id','=',$agency)
			->whereNotIn('mss.work_area_id', ['6', '17', '18'])
			->orderBy('wa.order_by', 'ASC')
			->get();
				
		$maid_employment_history = DB::table('maid_employment_history as meh')
			->select('c.name as countryName',
				'meh.date_from as emplistDateFrom',
				'meh.date_to as emplistDateTo',
				'meh.country as emplistCountry',
				'meh.other_country as emplistOtherCountry',
				'meh.employer as emplistEmployer',
				'meh.employment_remarks as emplistEmploymentRemarks',
				'meh.employer_feedback as emplistEmployerFeedback',
				DB::Raw("GROUP_CONCAT(DISTINCT (wa.title) SEPARATOR ',') as workareaname"))
			->leftjoin('maid_employment_history_work_area as mehwa', 'mehwa.employment_history_id', '=', 'meh.id')
			->leftjoin('countries as c', 'c.id', '=', 'meh.country')
			->leftjoin('work_area as wa', 'wa.id', '=', 'mehwa.work_area_id')
			->where('maid_id', '=', $id)->groupby('employment_history_id')->get();
		
		$maid_other_skill = DB::table('maid_skill_set as mss')
			->select('wa.title as workareatitle',
				'mss.work_area_id as skillSetWorkAreaId',
				'mss.willingness as skillSetWillingness',
				'mss.experience as skillSetExperience',
				'mss.rating as skillSetRating',
				'mss.feedback_comment as skillSetFeedbackComment')
			->leftJoin('work_area as wa', 'wa.id', '=', 'mss.work_area_id')
			->leftJoin('maid_personal_details as maid', 'maid.id', '=', 'mss.maid_id')
			->where('mss.maid_id','=',$id)
			->where('mss.deleted','=','N')
			->where('mss.experience','=','Yes')
			->where('mss.willingness','=','Yes')
			->where('wa.otherskill','=','Y')
			->where('maid.users_agents_id','=',$agency)
			->whereNotIn('mss.work_area_id', ['6', '17', '18'])
			->get();

		$otherskillset =  DB::table('maid_skill_set')
			->leftjoin('work_area', 'work_area.id', '=', 'maid_skill_set.work_area_id')
			->select('work_area.title as workareatitle','work_area.otherskill as otherskill', "maid_skill_set.*")
			->where('maid_id', '=', $id)->where('otherskill', '=', 'Y')->where('maid_skill_set.deleted', '=', 'N')->get();
			
		$otherskilltitles =  DB::table('work_area')
			->select('title as workareatitle', 'order_by as sequence')
			->where('otherskill', '=', 'Y')->where('deleted', '=', 'N')
			->get();		
		
		$expeskilltitles =  DB::table('work_area')
			->select('title as workareatitle')
			->where('otherskill', '=', 'N')
			->where('deleted', '=', 'N')
			->orderBy('order_by', 'ASC')
			->whereNotIn('id', ['6', '17', '18'])
			->get();			

		if($user_data) 
			$user_data = $user_data; 
		
		if($user_medical_illness)
			$user_medical_illness = $user_medical_illness;
		
		if($maid_special_skills) 
			$maid_special_skills = $maid_special_skills; 
		
		if($maid_language_skills) 
			$maid_language_skills = $maid_language_skills; 
		
		if($maid_preference_skills) 
			$maid_preference_skills = $maid_preference_skills; 
		
		if($maid_employment_history)
			$maid_employment_history = $maid_employment_history; 

		$count = count($user_data);
		if($count > 0)
		{
			if($user_data[0]->maidProfileDocument)
				$maid_pdf_url = $httphost."/uploads/maid_document/".$user_data[0]->maidProfileDocument;
			else
				$maid_pdf_url = '';
			
			$userdata = array('user_data' => $user_data, 'maid_pdf_url'=>$maid_pdf_url, 'user_medical_illness'=>$user_medical_illness,'maid_special_skills'=>$maid_special_skills, 'maid_language_skills'=>$maid_language_skills, 'maid_preference_skills'=>$maid_preference_skills, 'maid_other_skills'=>$otherskillset,'maid_employment_history'=>$maid_employment_history,'maid_other_skills_titles'=>$otherskilltitles,'maid_expe_skills_titles'=>$expeskilltitles, 'maid_thumb_url' => $maid_image_url);
			return response()->json(['success' => 1,'user_details'=>$userdata]);
		} 
		else
			$userdata = "No Record Found";
			return response()->json(['success' => 0,'message'=>$userdata]);
	}

    /**
     * To invalidate users token.
     *
     * @return Response
     */
    public function logout(Request $request)
    {
        JWTAuth::invalidate($request->input('token'));
         return response()->json(['success' => 'Logout successfully.'], 200);
    }   

	public function getmaidpdf() {
		$id = $_GET['maid'];
		$agency = $_GET['agency'];

		$user_data = DB::table('maid_personal_details as md')
			->select('md.*','c.name as country_name','c.nationality as nationality_name','u.company_name','u.username','u.image as agency_logo',DB::Raw('YEAR(CURDATE()) - YEAR(md.date_of_birth) AS age'),'e.title as education_level')
			->leftJoin('countries as c', 'c.id', '=', 'md.nationality')
			->leftJoin('users as u', 'u.id', '=', 'md.users_agents_id')
			->leftJoin('education_levels as e', 'e.id', '=', 'md.education_level')
			->where('md.deleted','=','N')
			->where('md.id','=',$id)
			->get();
			$medical_desieses = Medicaldesieses::lists('title','id');
			  
		$user_medical_illness =  DB::table('maid_medical_desieses as mmd')
			->select('mmd.maid_id as maid_id','mmd.medical_desieses_id as medical_desieses_id','mmd.description as other_desieses','md.*')
			->leftJoin('medical_desieses as md', 'md.id', '=', 'mmd.medical_desieses_id')
			->where('mmd.maid_id','=',$id)
			->where('mmd.deleted','=','N')
			->get();

		$maid_skills = DB::table('maid_skill_set as mss')
			->leftJoin('work_area as wa', 'wa.id', '=', 'mss.work_area_id')
			->select('wa.title as workareatitle', 'wa.otherskill',"mss.*")
			->where('mss.maid_id','=',$id)
			->where('wa.otherskill','=','N')
			->where('mss.deleted','=','N')
			->get();
		
		$maid_employment_history = DB::table('maid_employment_history as meh')
			->leftjoin('countries', 'countries.id', '=', 'meh.country')
			->leftjoin('maid_employment_history_work_area as mehwa', 'mehwa.employment_history_id', '=', 'meh.id')
			->leftjoin('work_area as wa', 'wa.id', '=', 'mehwa.work_area_id')
			->select('countries.name as countryname', "meh.*",DB::Raw("GROUP_CONCAT(DISTINCT (wa.title) SEPARATOR ',') as workareaname"))
			->where('maid_id', '=', $id)->groupby('employment_history_id')->get();
		$ispdf = 'yes';

		if($ispdf == 'yes'){
			$pdf = PDF::loadView('sentinel.fdws.fdwpdf',array('user_data' => $user_data,'user_medical_illness'=>$user_medical_illness,'maid_skills'=>$maid_skills,'maid_employment_history'=>$maid_employment_history,'medical_desieses'=>$medical_desieses));
			return $pdf->download($user_data[0]->maid_reference_code.'-'.$user_data[0]->name.'.pdf');
		}else{
			//echo "<pre>";	print_r($maid_employment_history); exit;
			return view('sentinel.fdws.show',compact('user_data','user_medical_illness','maid_skills','maid_employment_history'));
		}
	}
}
