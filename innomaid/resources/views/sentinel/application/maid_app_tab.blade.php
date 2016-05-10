@section('maid_app_tab')
<script type="text/javascript">
function getagreementform() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab4') }}";
  }
function getfdwagreementform() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab5') }}";
  }
function getemployermaid() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab0') }}";
  }
  function getservicefee() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab1') }}";
  }
  function getrestday() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab2') }}";
  }
  function getloanpayment() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab3') }}";
  }
  function gethandling() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab6') }}";
  }
  function getjob() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/edit?tab=tab7') }}";
  } 
  function getsecuritybond() { 
    window.location = "{{ url('/application/'.$maid_employer->id.'/securitybond') }}";
  }
  function getauthorisation() { 
    window.location = "{{ url('/application/'.$maid_employer->id.'/authorisationworkpass') }}";
  }
  function getsafety() { 
    window.location = "{{ url('/application/'.$maid_employer->id.'/safetyagreement') }}";
  }
  function getworkpermit() {
    window.location = "{{ url('/application/'.$maid_employer->id.'/workpermit') }}";
  }
  function getincometax() { 
     window.location = "{{ url('/application/'.$maid_employer->id.'/incometaxdeclaration') }}";
  }
  
</script>
<div id="tabs">
    <ul>
      <li><a onclick="return getemployermaid()" href="#tabs-1" style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Employer & Maid</span></a></li>
      <li><a onclick="return getservicefee()" href="#tabs-2"  style=" padding: 0.3em 0.6em;" ><span style="font-size:0.8em">Service & fees</span></a></li>
      <li><a onclick="return getrestday()" href="#tabs-8"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Rest Days</span></a></li>
	  <li><a onclick="return getloanpayment()" href="#tabs-3"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Loan & payment</span></a></li>  
      <li><a onclick="return getagreementform('Service_Employer_and_Agency')" href="#tabs-4"  style=" padding:0.3em 0.6em;"><span style="font-size:0.8em">Agreement B/w employer & agency</span></a></li>
      <li><a onclick="return getfdwagreementform('Service_Employer_and_Fdw')" href="#tabs-5"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Agreement B/w FDW & Employer</span></a></li>
      <li><a onclick="return gethandling()"href="#tabs-6"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Handling & Take Over</span></a></li>
      <li><a onclick="return getjob()"href="#tabs-7"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em">Job Scope</span></a></li>
	  <li> <a onclick="return getauthorisation()" href="#tabs-9"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Authorisation Work Pass Transaction</span></a></li>  
	   <li><a onclick="return getsecuritybond()" href="#tabs-10"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Security Bond </span></a></li>  
	    <li><a onclick="return getsafety()" href="#tabs-11"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Safety Agreement B/w FDW & Employer</span></a></li>
		<li><a onclick="return getworkpermit()" href="#tabs-12"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> FDW Work Permit</span></a></li>  
		<li><a  href="#tabs-13" onclick="return getgiro()"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> GIRO Form </span></a></li>  
		<li><a href="#tabs-14" onclick="return getincometax()"  style=" padding: 0.3em 0.6em;"><span style="font-size:0.8em"> Employer and Spouse Income Tax Declaration </span></a></li>  
    </ul>
 	<div id="tabs-1">
		<div class="authorisation agreementdiv"> 
		</div>
	</div>
	<div id="tabs-2">
		<div class="bond"> 
		</div>
	</div>
	<div id="tabs-3">
		<div class="safety"> 
		</div>
	</div>
	<div id="tabs-4">
		<div class="workpermit"> 
		</div>
	</div>
	<div id="tabs-5">
		<div class="workpermit"> 
		</div>
	</div>
	<div id="tabs-6">
		<div class="incometax"> 
		</div>
	</div>
	 	<div id="tabs-7">
		<div class="authorisation agreementdiv"> 
		</div>
	</div>
	<div id="tabs-8">
		<div class="bond"> 
		</div>
	</div>
	<div id="tabs-9">
		<div class="bond"> 
		</div>
	</div>
	<div id="tabs-10">
		<div class="safety"> 
		</div>
	</div>
	<div id="tabs-11">
		<div class="workpermit"> 
		</div>
	</div>
	<div id="tabs-12">
		<div class="workpermit"> 
		</div>
	</div>
	
	<div id="tabs-14">
		<div class="incometax"> 
		</div>
	</div>
	@stop