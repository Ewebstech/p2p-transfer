@include('emails.layout.mailheader')   
<tr>
<td style='color: #fff; font-weight: bolder; background-color: #00A4EF !important;' colspan='3' align='center'> {{$Subject}}</td>
</tr>
<tr>
<td style='color: #000; background-color: #fff;' colspan='3' align='left'>
    <p>
   Hello {{$Name}},
    </p>
    <p>You have successfully updated your profile on MobileMedicalAid.com</p>
    <p>If you did not perform this operation, please contact us now.</p>
   
    <p>Please do have nice day.</p>
</td>
</tr>
@include('emails.layout.mailfooter')   