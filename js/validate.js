function validate()
{
  if(document.getElementById('password').value == document.getElementById('password1'))
  {
    document.getElementById('errormsg').style.color = 'green';
    document.getElementById('errormsg').innerHTML = 'password matched';

    return true;
  }
  else {
    document.getElementById('errormsg').style.color = 'red';
    document.getElementById('errormsg').innerHTML = "password didn't match";

    return true;
  }
}
