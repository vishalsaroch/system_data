function newValueH(value){
	if (value == '1') {
		document.getElementById('extraFieldsH').innerHTML = '<hr><div id="passwordField"><div class="col-xs-12 col-sm-4">  <div class="form-group has-error"><label>Password</label><input type="password" name="password" class="form-control" maxlength="128" placeholder="Password" id="inputFirst" pattern="(?=.*\\d)(?=.*[A-Z]).{6,128}" onchange="this.setCustomValidity(this.validity.patternMismatch ? '+"'Must Have atleast 6 Characters and must contain at least one number and one uppercase letter'"+' : '+"''"+'); if(this.checkValidity()) form.inputLast.pattern=this.value;" required/>  </div></div><div class="col-xs-12 col-sm-4">  <div class="form-group has-error"><label>Confirm password</label><input type="password" name="password2" class="form-control" maxlength="128" placeholder="Confirm Password" id="inputLast" pattern="(?=.*\\d)(?=.*[A-Z]).{6,128}" onchange="this.setCustomValidity(this.validity.patternMismatch ? '+"'Please Enter the same password as entered'"+' : '+"''"+');" required/></div></div></div><div class="col-xs-12 col-sm-4"><div class="form-group has-error"><label>Power</label><select class="form-control" name="power" required><option value="">Select ...</option><option value="admin">Admin</option><option value="u">User</option></select></div></div>';
	}else{
		document.getElementById('extraFieldsH').innerHTML = '';
	}
}


$( "#tooltip" ).tooltip();

$('.aadharInput').on("keyup", function() {
    this.value = this.value.replace(/ /g,"");
    this.value = this.value.replace(/\B(?=(\d{4})+(?!\d))/g, " ");
});
