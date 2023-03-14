<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=us-ascii">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 15">
<meta name=Originator content="Microsoft Word 15">
<link rel=File-List href="2023-03-10%20(5)_files/filelist.xml">

<link rel=themeData href="2023-03-10%20(5)_files/themedata.thmx">
<link rel=colorSchemeMapping
href="2023-03-10%20(5)_files/colorschememapping.xml">

<style>

</head>

<body lang=EN-US style='tab-interval:.5in'>

<div class=WordSection1>

<h2 align=center style='text-align:center'><span style='mso-fareast-font-family:
"Times New Roman"'>R &amp; G Home Health Care<o:p></o:p></span></h2>

<h2 align=center style='text-align:center'><span style='font-size:14.0pt;
mso-fareast-font-family:"Times New Roman"'>WEEKLY VISIT/TIME RECORD<o:p></o:p></span></h2>

<h2><span style='font-size:14.0pt;mso-fareast-font-family:"Times New Roman"'>Year:
<u>{{date("Y")}}<span style='mso-tab-count:1'> </span></u>Employee ID#:<u>
1117
</u><span
style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Employee Name
&amp; Title: <u>Jose A Garcia<o:p></o:p></u></span></h2>

<h2><span style='font-size:14.0pt;mso-fareast-font-family:"Times New Roman"'>Patient
Name: <u>
@if(count($visits) > 0)
{{$patient_array[$visits[0]->patient_id]->name}}
@endif
<span style='mso-tab-count:3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></u>Clinical
Record#:<u><span style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>HI2635<o:p></o:p></u></span></h2>

<h2><span style='font-size:14.0pt;mso-fareast-font-family:"Times New Roman"'>Patient
Address: <u>
@if(count($visits) > 0)
{{$patient_array[$visits[0]->patient_id]->address}}
@endif
<span style='mso-tab-count:4'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><o:p></o:p></u></span></h2>

<h2 align=center style='text-align:center'><span style='font-size:14.0pt;
mso-fareast-font-family:"Times New Roman"'>PLEASE SIGN FOR ONLY ONE VISIT AT A
TIME<o:p></o:p></span></h2>
<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 width="103%"
 style='width:103.14%;border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:26.45pt'>
  <td width=47 valign=top style='width:30.85pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>Day<o:p></o:p></span></p>
  </td>
  <td width=55 valign=top style='width:36.1pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>Date<o:p></o:p></span></p>
  </td>
  <td width=99 valign=top style='width:65.5pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>Visit
  Code<o:p></o:p></span></p>
  </td>
  <td width=92 valign=top style='width:60.8pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>N/C
  Code<o:p></o:p></span></p>
  </td>
  <td width=82 valign=top style='width:.75in;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>Time
  In<o:p></o:p></span></p>
  </td>
  <td width=95 valign=top style='width:63.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>Time
  Out<o:p></o:p></span></p>
  </td>
  <td width=68 valign=top style='width:45.0pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>Units<o:p></o:p></span></p>
  </td>
  <td width=192 valign=top style='width:126.95pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>Patient
  Signature<o:p></o:p></span></p>
  </td>
 </tr>
 <?php 
    $i = 0;
 ?>
 @foreach($visits as $visit)
<?php $i++ ?>
<tr style='mso-yfti-irow:1;height:26.45pt'>
  <td width=47 valign=top style='width:30.85pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>{{$visit->day}}<o:p></o:p></span></p>
  </td>
  <td width=55 valign=top style='width:36.1pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>{{$visit->date}}<o:p></o:p></span></p>
  </td>
  <td width=99 valign=top style='width:65.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>{{$visit->visit_code}}<o:p></o:p></span></p>
  </td>
  <td width=92 valign=top style='width:60.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=82 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>{{$visit->time_in}}<o:p></o:p></span></p>
  </td>
  <td width=95 valign=top style='width:63.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>{{$visit->time_out}}<o:p></o:p></span></p>
  </td>
  <td width=68 valign=top style='width:45.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=192 valign=top style='width:126.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman";
  mso-no-proof:yes'><img width=100 height=30 id="_x0000_i1029"
  src="{{route('getImage', ['id'=>$visit->id])}}"
  alt="{{route('getImage', ['id'=>$visit->id])}}"></span><span
  style='mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>
  </td>
 </tr>
@endforeach
@for(;$i<14;$i++)

<tr style='mso-yfti-irow:1;height:26.45pt'>
  <td width=47 valign=top style='width:30.85pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>
  </td>
  <td width=55 valign=top style='width:36.1pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>
  </td>
  <td width=99 valign=top style='width:65.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>
  </td>
  <td width=92 valign=top style='width:60.8pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=82 valign=top style='width:.75in;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>
  <o:p></o:p></span></p>
  </td>
  <td width=95 valign=top style='width:63.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'>
  <o:p></o:p></span></p>
  </td>
  <td width=68 valign=top style='width:45.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman"'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=192 valign=top style='width:126.95pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:26.45pt'>
  <p class=MsoNormal align=center style='mso-margin-top-alt:auto;mso-margin-bottom-alt:
  auto;text-align:center'><span style='mso-fareast-font-family:"Times New Roman";
  mso-no-proof:yes'></span><span
  style='mso-fareast-font-family:"Times New Roman"'><o:p></o:p></span></p>
  </td>
 </tr>
@endfor

 
</table>

<p class=MsoNormal><span style='mso-fareast-font-family:"Times New Roman"'><o:p>&nbsp;</o:p></span></p>

<p class=MsoNormal align=center style='text-align:center'><span
style='mso-fareast-font-family:"Times New Roman"'>Total Visits:<u><span
style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></u><span
style='mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Total
Units:<u><span style='mso-tab-count:2'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><o:p></o:p></u></span></p>

</div>

</body>

</html>
