@include('emails.layout.mailheader')   
<tr>
<td style='color: #fff; font-weight: bolder; background-color: #9d3c19 !important;' colspan='3' align='center'> Account Confirmation</td>
</tr>
<tr>
<td style='color: #000; background-color: rgb(157,60,25,0.1);' colspan='3' align='left'>
    <p>
   Welcome {{$Name}},
    </p>
    <p>Your registration was successful. Please click below to activate your account</p>

    <p><a href="{{$Link}}">Click here to confirm/activate your account</a> </p> 

</td>
</tr>
@include('emails.layout.mailfooter')