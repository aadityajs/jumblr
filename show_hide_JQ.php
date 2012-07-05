<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>



</head>
<body>
<script type="text/javascript">

function editFields(linkElem){
	var parent=$(linkElem).parents('table');
	var parentId=parent.attr('id');
	parent.hide();
	$('#'+parentId+'Form').show();
	}


function cancelFields(linkElem){var parent=$(linkElem).parents('form');var parentId=parent.attr('id');var tableTextId=parentId.substring(0,parentId.length-4);parent.hide();$('#'+tableTextId).show();var textFields=parent.find('input[type="text"]');textFields.each(function(i){var span=$('span[id="'+$(this).attr('name')+'"]');if(span.size()==1){var value=span.text();$(this).val(value);}});if($('#editGenderField').size()==1){var name=$('#editGenderField').attr('name');$('#editGenderField').val($('span[id="'+name+'"]').attr('class'));}
if($('#jRegisterBirthdayDay').size()==1){var spanBirth=$('#birthday');$('select[name="birthDay"]').val(spanBirth.text().substring(0,2));$('select[name="birthMonth"]').val(spanBirth.attr('class'));$('select[name="birthYear"]').val(spanBirth.text().substring(6));}
clearPwdFields(parent);clearErrors(true);}

</script>

<table id="jAccProfileDataName" class="accProfileData" cellspacing="0" style="display: block; ">
							<tbody><tr class="firstRow">
								<td class="col1">Name:</td>
								<td class="col2">
									<span id="registerView.gender" class="MALE">Mr.</span>&nbsp;
	                                    <span id="registerView.firstName">Aditya Jyoti</span>&nbsp;<span id="registerView.lastName">Saha</span>
                                    <br><span id="birthday" class="FEBRUARY">25.02.1987</span>
									</td>
								<td class="col3">
									<a onclick="editFields(this); return false;" href="">(Edit)</a></td>
							</tr>
						</tbody>
</table>
<form action="" id="jAccProfileDataNameForm" style="display:none;">

name: <input type="text">

<a onclick="cancelFields(this); return false;" href="">(Close)</a>

</form>

</body>

</html>