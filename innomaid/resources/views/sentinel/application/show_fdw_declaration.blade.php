
		<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>Innomaid</title>
<meta name="generator" content="Bootply" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<?php  
$path = public_path();
$root_path = $_SERVER['DOCUMENT_ROOT'];
?>
<style type="text/css">

body {
    color: #000;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
	clear:both;
	
}
.h3, h3 {
    font-size: 14px;
	
}
.h1, .h2, .h3, h1, h2, h3 {
    margin-bottom: 10px;
    margin-top: 20px;
}
.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
    color:#000;
    line-height: 1.1;
    height: 0;
}
.fkm-heading {
    float: left;
}
.fkm-heading h4, h5 {
    color: #f00;
    font-size: 20px;
    font-style: italic;
    font-weight: bold;
    text-align: center;
}
.personal-info-2 label {
    width: 100%;
}
label {
    display: inline-block;
    font-weight: 700;
    margin-bottom: 5px;
    max-width: 100%;
}

.notbold {
    font-weight: 100;
}
.table-bordered {
    border: 1px solid #000;
	border-collapse:collapse;

}
.table {
	margin-top:20px;
    margin-bottom: 20px;
	width:100%;

	
}

.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #000;
	border-right:1px solid #000;
}

.page-break {
    page-break-after: always;
}
.table.table-bordered.notbold tr td
{
	height:30px;
}
.table.table-bordered.mytst tr td
{
	height:20px;
}
</style>
<body style="background:white;">
	<div>
		<?php $maid_details[] = json_decode($maid_employer->maid_json_data);
				$employer_details[] =json_decode($maid_employer->employer_json_data);
				$from = new DateTime($maid_details[0]->date_of_birth);
			$to   = new DateTime('today');
			 $diff =date_diff( new DateTime(),$from); //print_r($diff); exit;
			$age=$diff->y;
				//print_r($employer_details);
			
		?>	
		<h1 style="font-size:13px;font-weight:bold;margin-top:30px;text-align:center;"><span style="color:#ccc; font-size:20px;">{{ucfirst($user_data[0]->company_name)}}</span><br/><span style="font-weight:bold;">{{ucfirst($user_data[0]->address)}}</span><br/>
		<span style="font-weight:500;">Tel:{{$user_data[0]->telephone}}@if($user_data[0]->fax) Fax: {{$user_data[0]->fax}}@endif
		@if($user_data[0]->website)website:{{$user_data[0]->website}}@endif email:{{$user_data[0]->email}}      License No.:{{$user_data[0]->license_no}}</span>
		</h1>
			<p style="  margin-top: 65px;"><span style="padding-top:20px;">Date:</span><br/>
								<p>Dear Sir/Madam</p>
								<p> <span style="font-weight:bold;">RE</span>
									<span style="font-weight:bold;padding-left: 50px;">:DECLARATION FORM FOR FOREIGN DOMESTIC WORKER</span><br/><span style="font-weight:bold;padding-left: 77px;">( SURAT PERNYATAAN UNTUK TENAGA KERJA )</span>
								</p>
								<p style="padding-top: 30px;line-height:1.7;">I, <span style="border-bottom:1px solid #000;padding-right:120px;margin-left:5px;">{{ucfirst($maid_details[0]->name)}}</span>,holder of Passport No:<span style="border-bottom:1px solid #000;padding-right:120px;margin-left:5px;">{{$maid_details[0]->passport_number}}</span>,WP No: <span style="border-bottom:1px solid #000;padding-right:80px;margin-left:5px;">
								<?php if(isset($maid_details[0]->work_permit_no)) 
									echo $maid_details[0]->work_permit_no;?></span>,<br/> 
									Date Of Birth:<span style="border-bottom:1px solid #000;padding-right:100px;margin-left:5px;">{{$maid_details[0]->date_of_birth}}</span>, Age:<span style="border-bottom:1px solid #000;padding-right:80px;margin-left:5px;">{{$age}}</span>.</p>
								<p>I declare that all my particulars given are true and correct and I hereby declare that my age is true and confirmed that I shall not make any false statements or submit any documents which I know it's false. </p>
								<p>I also understand that If I breach any above mentioned conditions, my work permit will be revoked and I could be prosecuted in court . </p>
								<table class = "table table-bordered" style="margin-top:4px !important;margin-bottom:0px !important;">
								<tr>
									<th>S/N</th>
									<th>ITEMS</th>
									<th>DESCRIPTION</th>
									<th>AMOUNT</th>
								</tr>
								<?php $sno = 1;?>
								@foreach($fdwdeclarationitem as $item => $item_value)
								<tr>
									<td style="text-align:center;">{{ $sno }}</td>
									<td style="text-align:center;">{!!ucfirst($item_value->item_name) !!}</td>
									<td style="text-align:center;">{!! ucfirst($item_value->description) !!}</td>
									<td style="text-align:center;">{!! $item_value->amount !!}</td>
								</tr>
								<?php $sno++; ?>
								@endforeach
								</table>
			<p style="padding-top: 20px;line-height:1.7;">Saya,<span style="border-bottom:1px solid #000;padding-right:120px;margin-left:5px;">{{ucfirst($maid_details[0]->name)}}</span>,Nomor Paspor:<span style="border-bottom:1px solid #000;padding-right:120px;margin-left:5px;">{{$maid_details[0]->passport_number}}</span>,WP No:<span style="border-bottom:1px solid #000;padding-right:80px;margin-left:5px;">
								<?php if(isset($maid_details[0]->work_permit_no)) 
									echo $maid_details[0]->work_permit_no;?></span>,<br/>Tanggal Lahir:<span style="border-bottom:1px solid #000;padding-right:100px;margin-left:5px;">{{$maid_details[0]->date_of_birth}}</span>,Usia:<span style="border-bottom:1px solid #000;padding-right:80px;margin-left:5px;">{{$age}}</span>.</p>
			<p>Saya Menyatakan bahawa infomasi semua yang diatas adalah benar dan disini saya menyatakan usia saya yang diatas adalah benar dan pasti.Saya Faham saya tidak boleh buat pernyataan yang salah atau memberikan infomasi yang tidak benar.</p>
			<p>Saya juga Faham jikalu saya memberikan infomasi yang palsu, kartu saya akan dibatalkan dan saya akan dihukum sesuai dengan undang dari Singapura.</p>
			<table class = "table" style="margin-top:70px !important;margin-bottom:0px !important;line-height: 2;">
								<tr>
									<td width='25%'style="vertical-align:top;" >
										<span >
											<span style="border-top:1px solid #000;padding-right:15px;">Employer's Signature</span><br/>
											<span >Tandatangan Majikan </span><br/>
											
										</span>
									</td>
									<td style="vertical-align:top;padding-left:50px;">
										<span><span style="border-top:1px solid #000;padding-right:25px;">Maid's Signature</span><br/>
										<span style="padding-right:100px;">Tandatangan TKW</span><br/>
										</span>
									</td>
									<td style="vertical-align:top;">
										<span style="border-top:1px solid #000;padding-right:25px;">Witness's Signature</span><br/>
										<span style="padding-right:100px;">Tandatangan Saksi</span><br/>

									</td>
								</tr>
							</table>						
		</div>
</body>
</html>		
