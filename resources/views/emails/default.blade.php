@include('emails.layout.mailheader')   
<tr>
<td style='color: #fff; font-weight: bolder; background-color: #00A4EF !important;' colspan='3' align='center'> {{$Subject}}</td>
</tr>
<tr>
<td style='color: #000; background-color: #fff;' colspan='3' align='left'>
    <p>
        {{$Body}}
    </p>
</td>
</tr>
@include('emails.layout.mailfooter')   